<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tickets = Ticket::orderBy("created_at", "desc")->paginate(10);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_level_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $ticket = Ticket::create($request->all('ticket_level_id', 'event_id', 'user_id', 'bought', 'order_id','qr_code','status'));
        //
    }

    // public function showEvent(Request $request, $event_id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'sortBy' => '',
    //         'sortOrder' =>  'string',
    //         'filter' => '',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     } //
    //     $event = Event::find($event_id);
    //     if (Gate::denies('isOwner', $event->user_id ?? 0))
    //         return $this->sendError('User not authorized.', [], 401);

    //     $tickets = Ticket::with('ticket_level')->with(['user' => function(Builder $query) use ($request){
    //         if($request->filter){
    //             $query->where('first_name', $request->filter)->orWhere('last_name', $request->filter);
    //         }
    //     }])->where('event_id', $event_id);

    //     if ($request->sortBy) {
    //         $tickets = $tickets->orderBy($request->sortBy, $request->sortOrder);
    //     } else
    //         $tickets = $tickets->orderBy('created_at', 'desc');

    //     if ($request->filter) {
    //         $tickets = $tickets->where('summary', 'like', '%' . $request->filter . '%');
    //     }

    //     $tickets = $tickets->paginate($request->paginate ?? 25);
    //     return $this->sendResponse($tickets, 'Here are the Recent Order');
    // }

    public function showEvent(Request $request, $event_id)
    {
        $event = Event::find($event_id);
        if (Gate::denies('isOwner', $event->user_id ?? 0) && Gate::denies('isSuperAdmin', $event->user_id ?? 0)) {
            return $this->sendError('User not authorized.', [], 401);
        }
        $tickets = Ticket::with('ticket_level')->with('user')->where('event_id', $event->id)->orderBy('created_at', 'DESC')->get();
        return $this->sendResponse($tickets, 'Here are the User Tickets');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('event')->findOrFail($id);
        if ($ticket)
            return $this->sendError('Ticket not found', [], 401);

        if (Gate::allows('isOwner', $ticket->event->user_id ?? 0))
            return $this->sendError('User not authorized.', [], 401);
        return $this->sendError('', [], 200);
    }

    public function scan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        try {
            $ticket = Ticket::with('event')->with('user')->with('ticket_level')->findOrFail($id);

            if ($ticket->event_id != $request->event_id) {
                return $this->sendError('Ticket not found', [], 401);
            }

            if (!Gate::allows('isOwner', $ticket->event->user_id ?? 0) || Gate::allows("isSuperAdmin") || $request->event_id != $ticket->event->id)
                return $this->sendError('Ticket not found', [], 401);

            if (!$ticket->is_scanned) {
                $ticket->scanned_at = date("d-m-y h:i:s");
                $ticket->is_scanned = 1;
                $ticket->save();
                return $this->sendResponse($ticket, 'Ticket is Okay and scanned');

            }
            return $this->sendError('Ticket has been scanned.', $ticket, 404);
            
        } catch (Exception $e) {
            return $this->sendError('Ticket not Found Error', [], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

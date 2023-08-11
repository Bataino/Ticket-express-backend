<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
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

        if (auth()->user()->role == 'admin') {
            $tickets = Ticket::where('event_id', auth()->user()->event_id)->get();
            return $this->sendResponse($tickets, "");
        }
        if (auth()->user()->role == 'super-admin') {
            $validator = Validator::make($request->all(), [
                'event_id' => 'integer|required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $tickets = Ticket::where('event_id', $request->input('event_id'))->get();
            return $this->sendResponse($tickets, "");
        }

        return $this->sendError([], "Unauthenticated", 401);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return $this->sendError([], 'Ticket not found');
        }
        if ($ticket->is_scanned) {
            return $this->sendError($ticket, 'Ticket has been used', 422);
        }
        if (!$ticket->is_scanned) {
            $ticket->is_scanned = 1;
            $ticket->save();
            return $this->sendResponse($ticket, 'Ticket scanned successfully');
        }
        //
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

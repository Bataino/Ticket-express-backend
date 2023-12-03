<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TicketLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'event_id' => 'required',
            'quantity' => 'integer|required',
            'price' => 'numeric|required',
            'limit' => 'integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all('event_id', 'title', 'quantity', 'limit', 'price');
        $level = TicketLevel::create($data);

        return $this->sendResponse($level,'Ticket Level created successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        if (Gate::denies('isOwner', $level->event->user_id ?? 0))
            return $this->sendError('User not authorized.', [], 401);
        $level = TicketLevel::where('event_id', $event_id)->get();
        return $this->sendResponse($level, 'Here are the Ticket details');
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
        $tickets = Ticket::where('ticket_level_id', $id)->count();
        $validator = Validator::make($request->all(), [
            'quantity' => 'integer|min:'.$tickets,
            'price' => 'numeric',
            'is_available' => 'boolean',
        ]);//

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        

        $data = $request->only('title', 'quantity', 'limit', 'is_available', 'price');
        $level = TicketLevel::with('event')->find($id);
        
        if (Gate::denies('isOwner', $level->event->user_id ?? 0))
                return $this->sendError('User not authorized.', [], 401);

        $level->update($data);
        return $this->sendResponse($level,'Ticket Level created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tickets = Ticket::where('ticket_level_id', $id)->get();
        $level = TicketLevel::with('event')->find($id);
        if($tickets){
            $this->sendError('Can not delete, already active',[]);
        }

        if ($level){
            if (Gate::denies('isOwner', $level->event->user_id ?? 0))
                return $this->sendError('User not authorized.', [], 401);
            $level->delete();
        }
        return $this->sendResponse($level, "Discount has been deleted");
         //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DiscountController extends Controller
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

    // get Active Discount
    public function get($event_id)
    {
        $event = Event::find($event_id);
        $discount = Discount::where('event_id', $event_id)->get();
        // dd($discount->event->id);  //

        return $this->sendResponse($discount,"Discount for Event".$event->name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     private function makeAllPassive(){
            Discount::where('status', 'active')->update(['status' => 'passive']);

     }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'percentage' => 'integer|required',
            'title' => 'required',
            'event_id' => 'required',
            'make_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = $request->all('event_id', 'title', 'percentage');
        $this->makeAllPassive();
        $data['status'] = 'active';

        if (!$request->make_active) {
            $data['status'] = 'passive';
        }
        $discount = Discount::create($data);

        return $this->sendResponse($discount, 'Discount has been created');
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
        $data = array_filter($request->all('title', 'percentage','status'));
        $discount = Discount::where('id',$id)->with('event')->first();
        // dd($discount->event->id);
        if (Gate::denies('isOwner', $discount->event->user_id ))
            return $this->sendError('User not authorized.', [], 401);
        
        if(@$data['status'] == 'active'){
            $this->makeAllPassive();
        }
        $discount->update($data);
        return $this->sendResponse($discount, "Discount has been updated"); //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::with('event')->find($id);
        // dd($discount);
        if ($discount){
            if (Gate::denies('isOwner', $discount->event->user_id))
                return $this->sendError('User not authorized.', [], 401);
            $discount->delete();
        }
        return $this->sendResponse($discount, "Discount has been deleted");//
    }
}

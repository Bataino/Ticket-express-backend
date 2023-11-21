<?php

namespace App\Http\Controllers;

use App\Events\OrderCompleted;
use App\Models\Discount;
use App\Models\Event;
use App\Models\Order;
use App\Models\TicketLevel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required',
            'event_id' =>  'integer|required'
        ]);

        if(!auth()->user())
        $validator->addRules([
            'email' => 'required',
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } //

        $items = $request->items;
        $tickets = [];
        $event = Event::find($request->event_id);
        $user = auth()->user() ?? User::create($request->all('email', 'phone', 'first_name', 'last_name'));
        $discount = Discount::where('event_id', $request->event_id)->where('status', 'active')->first();

        $totalPrice = 0;
        $prices = [];
        $summary = 'Tickets for' . $event->name . ' : ';
        $items = $items[0];
        // dd($items);
        foreach ($items as $tl => $qty) {
            try {
                $level = TicketLevel::with('event')->find($tl);
                if(!$level || $level->event->id != $event->id){
                    return $this->sendError('Invalid Order details',[]);
                }

                // dd($tl);
                array_push($tickets, $level);
                $price = $level->price * intval($qty);

                $disc = intval(@$discount->percentage)/100 ?? 1;
                $discountPrice = $disc * $price;
                // dd([@$discount->percentage, $level, $discountPrice]);
                $price -= $discountPrice;

                array_push($prices, $price);
                $totalPrice += $price;
                $summary = $summary . " " . $qty . " " . $level->title.";";
            } catch (Exception $e) {
                return $this->sendError($e->getMessage(), $e);
            }

            // dd($totalPrice);
            $order = Order::create([
                'items' => $items,
                "summary" => $summary,
                "price" => $totalPrice,
                "user_id" => $user->id
            ]);
            makeOrderPayment($order);
            event(new OrderCompleted($user, $order, $prices));
            // PROCESS PAYMENT AND RETURN LINK
            return $this->sendResponse($order, "Order has been created");
        }
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

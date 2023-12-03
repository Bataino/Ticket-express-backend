<?php

namespace App\Http\Controllers;

use App\Events\OrderCompleted;
use App\Models\Discount;
use App\Models\Event;
use App\Models\Order;
use App\Models\TicketLevel;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $events =  Event::where('user_id', $user->id)->get('id');
        if (Gate::allows('isSuperAdmin')){
            $orders = Order::orderBy('created_at','desc')->paginate(10);
            return $this->sendResponse($orders,"Recent Orders");
        }
            $order = Order::whereIn('event_id', $events)->orderBy('created_at','desc')->paginate($request->paginate ?? 25);
            return $this->sendResponse($order,"");
        
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

        if (!auth()->user())
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
                if (!$level || $level->event->id != $event->id) {
                    return $this->sendError('Invalid Order details', []);
                }

                // dd($tl);
                array_push($tickets, $level);
                $price = $level->price * intval($qty);

                $disc = intval(@$discount->percentage) / 100 ?? 1;
                $discountPrice = $disc * $price;
                // dd([@$discount->percentage, $level, $discountPrice]);
                $price -= $discountPrice;

                array_push($prices, $price);
                $totalPrice += $price;
                $summary = $summary . " " . $qty . " " . $level->title . ";";
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
    public function show(Request $request, $event_id)
    {
        $validator = Validator::make($request->all(), [
            'sortBy' => '',
            'sortOrder' =>  'string',
            'filter' => '',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } //

        $event = Event::find($event_id);
        if (Gate::denies('isOwner', $event->user_id ?? 0))
            return $this->sendError('User not authorized.', [], 401);

        $order = Order::with('user')->where('event_id', $event_id);
        if ($request->sortBy) {
            $order = $order->orderBy($request->sortBy, $request->sortOrder);
        } else
            $order = $order->orderBy('created_at', 'desc');

        if ($request->filter) {
            $order = $order->where('summary', 'like', '%' . $request->filter . '%');
        }

        $order = $order->paginate($request->paginate ?? 25);
        return $this->sendResponse($order, 'Here are the Recent Order');
    }

    public function summary(Request $request, $event_id)
    {

        $event = Event::find($event_id);
        if (Gate::denies('isOwner', $event->user_id ?? 0) && Gate::denies('isSuperAdmin'))
            return $this->sendError('User not authorized.', [], 401);

        $ord = Order::with('user')->where('created_at', '>=' ,Carbon::today())->where('event_id', $event_id);
        $ordersToday = $ord->get();
        $totalOrders = Order::where('event_id', $event_id)->sum('price');

        $data  = [
            'orders_today' => $ordersToday,
            'total_sale' => $totalOrders,
            'sale_today' => $ord->sum('price')
        ];

        return $this->sendResponse($data, 'Here are the Orders Summary');
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

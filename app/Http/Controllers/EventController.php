<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketLevel;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Gate;
use Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword') ?? '';
        $country = $request->input('country');
        $state = $request->input('state');
        $date = $request->input('date');
        $venue_id = $request->input('venue_id');
        // $end_date = $request->input('end_date');
        // Search Event by name, description,
        // Search Event by venue : address, country, city, title, state
        // filter by date, time_zone
        // Sort by date automatically,

        $events = Event::where(function ($query) use ($keyword) {
            return $query->where('description', 'LIKE', "%{$keyword}%");
        });

        $events = Event::where('title', 'ODS');
        if ($venue_id) {
            $events->where('venue_id', $venue_id);
        }
        if ($date) {
            $events->whereDate('created_at', $date);
        }

        // $events->whereHas('venue', function ($query) use($country, $state, $keyword) {
        //     if($country)
        //         $query->where('country', $country);
        //     if($state)
        //         $query->where('state', $state);

        //     $query->orWhere('title','like','%'.$keyword.'%')->orWhere('address','like','%'.$keyword.'%')->orWhere('state','like','%'.$keyword.'%');
        //     return $query->get();
        // });  

        // $events->orderBy('start', 'DESC');
        $events->get();

        return $this->sendResponse($events, "Search Result here");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'start' => 'required|date',
            // 'end' => 'required|date|after_or_equal:start',
            'description' => 'string|required',
            // 'venue_id' => 'integer|required',
            'files' => 'required',
            'attendees' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg,|max:2048',
            'time_zone' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();
        $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
        $data['end'] = date('Y-m-d H:i:s', strtotime($data['start']));

        $user =  auth()->user();
        $data['user_id'] = $user->id;
        $data['files'] = uploadImages($request, "files", "events-" . $user->id);
        // dd(uploadImages($request,"files", "events-".$user->id));

        $event = Event::create($data);
        $event->save();
        return $this->sendResponse($event, "Event has been created");
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'date',
            'venue_id' => 'integer',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg,mp4,3gp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->only(['title', 'start', 'end', 'description', 'is_publish', 'venue_id', 'time_zone']);
        $event = Event::find($id);

        // return $this->sendResponse([$event, $request->is_publish], "Event updated Successfully");
        // if ($request->is_publish == true) 
        //     $data["is_publish"] =  1;
        // else if($request->is_publish == false)
        //     $data["is_publish"] =  0;

        if ($request->file('files'))
            $data['files'] = uploadImages($request, "files", "events-" . $event->user_id);

        $data['start'] = date('Y-m-d H:i:s', strtotime(@$data['start'] ?? $event->start));
        $data['end'] = date('Y-m-d H:i:s', strtotime(@$data['end'] ?? $event->end));

        if (Gate::denies('isOwner', $event->user_id))
            return $this->sendError('User not authorized.', [], 401);

        $event->update($data);
        // this.update()
        return $this->sendResponse($event, "Event updated Successfully");
    }

    public function addImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg,mp4,3gp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $event = Event::find($id);
        $user = auth()->user();

        if (Gate::denies('isOwner', $event->user_id))
            return $this->sendError('User not authorized.', [], 401);

        $images = uploadImages($request, "files", "events-" . $event->user_id);
        // dd($event->files);
        $data["files"] = array_unique(array_merge($event->files, $images));


        $event->update($data);
        return $this->sendResponse([$event], "Event updated Successfully");
    }

    public function deleteImage($id, $index)
    {
        $event = Event::find($id);

        if (Gate::denies('isOwner', $event->user_id))
            return $this->sendError('User not authorized.', [], 401);
        $images = $event->files;
        if (count($images) <= 1)
            return $this->sendError("Event must have at least an image", [], 400);
        array_splice($images, $index, 1);

        $data["files"] = $images;
        $event->update($data);
        return $this->sendResponse([$event], "Event updated Successfully");
    }

    public function showUser()
    {
        $user = auth()->user();
        $event = Event::with('venue')->with('ticket_levels')->where('user_id', $user->id)->get();
        if (Gate::denies('isOwner', @$event[0]->user_id ?? 0) && Gate::denies("isSuperAdmin")) {
            return $this->sendResponse($event, "Got event by Id");
        }
        $events = Event::with('tickets')->with('orders')->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return $this->sendResponse($events, "Got event related to the User");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with('venue')->with('ticket_levels')->where('id',$id)->first();
        if (Gate::denies('isOwner', $event->user_id) && Gate::denies("isSuperAdmin")) {
            return $this->sendResponse($event, "Got event by Id");
        }
            // $ev = Event::with('tickets')->with('orders')->with('discounts')->with('ticket_levels')->with('venue');
            // $event = $ev->where('id', $id)->first();
            return $this->sendResponse($event, "Got event by Id , Access granted");
    }

    public function dashboard()
    {
        $orders = [];
        $user = auth()->user();
        $events =  Event::where('user_id', $user->id)->where('end', '<=', Carbon::today())->orderBy('created_at', 'DESC')->get();
        $total_orders  = []; //Total Orders for each Event
        $data  = [];
        $ticket_level = []; //Ticket Level Bought

        foreach ($events as $val) {
            $order = Order::where('event_id', $val->id);
            $ticket_levels = TicketLevel::where('event_id', $val->id)->get();


            $sum = $order->sum('price');
            // $get = $order->get('items');

            foreach ($ticket_levels as $level) {
                $ticket = Ticket::where('ticket_level_id', $level->id)->count();
                $ticket_level[$level->title] = $ticket;
            }


            $total_orders[] = [
                Event::find($val->id)->title =>  $sum
            ];
            // $data[Event::find($val->id)->title] = $order;
        }
        $data = [
            'orders' => $total_orders,
            'tickets' => $ticket_level
        ];
        // $order = Order::whereIn('event_id', $events)->orderBy('created_at','desc')->sum('p');
        return $this->sendResponse($data, "Got event by Id");
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return $this->sendError([], "Event not Found", 404);
        }
        // $tickets = Ticket::where('event_id', $id)->get();
        // foreach ($tickets as $ticket) {
        //     $ticket->delete();
        // }

        $ticket_levels = TicketLevel::where('event_id', $id)->get();
        foreach ($ticket_levels as $tl) {
            $ticket = Ticket::where('event_id', $tl->id)->get();
            if ($ticket)
                return $this->sendError($event, "Event could not be deleted", 400);
            $tl->delete();
        }
        $event->delete();
        return $this->sendResponse([], "Event has been deleted");
        //
    }
}

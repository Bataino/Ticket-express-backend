<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role != 'super-admin') {
            return $this->sendError([],"Unauthenticated", 401);
        }
        return $this->sendResponse(Event::where('id', '!=', null)->orderBy('created_at', 'DESC')->get(),""); //
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    function getValueFromHint(Array $arr, String $hint){
        $k = '';
        $newArr = array_filter($arr, function($key) use ($hint, &$k) {
            // $key = str_replace(" ","",$key);
            // $k = $key;
            return str_contains(strtolower($key), $hint);
        }, ARRAY_FILTER_USE_KEY );

        return array_values($newArr)[0];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(auth()->user()->role != 'super-admin') {
            return $this->sendError([],"Unauthenticated", 401);
        }
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:csv|required',
            'name' => 'string|required',
            'username' => 'string|required|unique:users,email',
            'password' => 'string|required|min:6'
        ]);

       
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $event = Event::create([
            'name' => $request->input('name')
        ]);
        $user = User::create([
            'email' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role' => 'admin',
            'event_id' => $event->id
        ]);

        if ($file = $request->file('file')) {
            $path = $file->move('public/files/images/orders');
            $tickets = $this->csvToArray(public_path($path->getPathname()));

            foreach ($tickets as $ticket) {

                // return  $this->sendResponse($this->getValueFromHint($ticket, "first"),"");
                $id = $this->getValueFromHint($ticket, "id");
                $newTicket = Ticket::firstOrNew([ 'id' => $id ]) ;
                // $newTicket = new Ticket();
                // $newTicket->id = $id;
                // return [$newTicket->id, $id];
                $newTicket->type = $this->getValueFromHint($ticket, "type");
                $newTicket->level = $this->getValueFromHint($ticket, "level");
                $newTicket->price = $this->getValueFromHint($ticket, "price");
                $newTicket->page_name = $this->getValueFromHint($ticket, "page");
                $newTicket->first_name = $this->getValueFromHint($ticket, "first");
                $newTicket->last_name = $this->getValueFromHint($ticket, "last");
                $newTicket->email = $this->getValueFromHint($ticket, "mail");
                $newTicket->phone = $this->getValueFromHint($ticket, "number");
                $newTicket->event_id = $event->id;
                $newTicket->save();
            }

            // $image_name = $file->getClientOriginalName();

            // print_r(url('').$path->getPathname());
        }
        //    return $this->sendResponse(["request"],"");
        return $this->sendResponse(['user' => $request->user()], "Ticket created Successfully");
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

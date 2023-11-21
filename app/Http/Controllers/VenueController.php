<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Validator;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venue = Venue::all();
        return $this->sendResponse($venue, "Venue has been created"); //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUser(Request $request)
    {
        $venue = Venue::where('user_id', auth()->user()->id)->get();
        return $this->sendResponse($venue, "All Venue"); //
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
            'title' => 'string|required',
            'country' => 'required|string',
            'state' => 'required|string',
            'address' => 'string|required',
            'setting' => 'json',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all('address', 'country', 'state', 'title', 'setting', 'lat', 'long', 'zip_code');
        $data['user_id'] = auth()->user()->id;
        $venue = Venue::create($data);

        return $this->sendResponse($venue, "Venue has been created");

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
        return $this->sendResponse(Venue::find($id), "Here is the Venue Id");  //
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

        $data = array_filter($request->all('address', 'country', 'state', 'title', 'setting', 'lat', 'long', 'zip_code'));
        $venue = Venue::find($id);
        if (Gate::denies('isOwner', $venue->user_id))
            return $this->sendError('User not authorized.', [], 401);
        $venue->update($data);

        return $this->sendResponse($venue, "Venue has been updated");

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
        $venue = Venue::find($id);
        if ($venue){
            if (Gate::denies('isOwner', $venue->user_id))
                return $this->sendError('User not authorized.', [], 401);
            $venue->delete();
        }
        return $this->sendResponse($venue, "Venue has been deleted"); //
    }
}

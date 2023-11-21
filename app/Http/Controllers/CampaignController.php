<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
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

    private function sendMailToUsers($campaign)
    {

        $campaign->update(['status' => 'sneding']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|integer',
            'mail_content' => 'required',
            'subject' => 'required',
            // 'users' => 'json',
            'send_now' => 'boolean',
        ]); //

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all('event_id', 'mail_content', 'subject', 'users');
        $data['users'] = $data['users'] ?? [];
        $campaign = Campaign::create($data);

        if ($request->send_now) {
            $this->sendMailToUsers($campaign);
        }

        return $this->sendResponse($campaign, 'Here is the Campaign details');
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
    public function show($event_id)
    {
        $campaigns = Campaign::with('event')->where('event_id', $event_id)->get();
        if (Gate::denies('isOwner', $campaigns[0]->event->user_id ?? []))
                return $this->sendError('User not authorized.', [], 401);  //

        return $this->sendResponse($campaigns, 'Campaigns for event'.$event_id);
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
        $campaign = Campaign::with('event')->find($id);

        if (Gate::denies('isOwner', $campaign->event->user_id))
                return $this->sendError('User not authorized.', [], 401);

        if ($campaign->status !=  'draft')
            return $this->sendResponse($campaign, 'Campaign cannot be edited');

        $validator = Validator::make($request->all(), [
            'event_id' => 'integer',
            'users' => 'json',
            'send_now' => 'boolean',
        ]); //

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } //

        $data = array_filter($request->all('event_id', 'mail_content', 'subject', 'users'));
        if ($request->send_now) {
            $this->sendMailToUsers($campaign);
        }

        $campaign->update($data);
        return $this->sendResponse($campaign, 'Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        if ($campaign) {
        if ($campaign->status !=  'draft')
            return $this->sendResponse($campaign, 'Campaign cannot be deleted');

        $campaign = Campaign::with('event')->find($id);
            if (Gate::denies('isOwner', $campaign->event->user_id))
                return $this->sendError('User not authorized.', [], 401);
            $campaign->delete();
        }
        return $this->sendResponse($campaign, "Campaign has been deleted");    //
    }
}

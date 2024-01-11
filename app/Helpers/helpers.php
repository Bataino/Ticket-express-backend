<?php

// use App\Http\Requests\Request;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketLevel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

function uploadImage(Request $request, $input, $filename = null, $folder = '')
{
    if ($file = $request->file($input)) {
        $filename = $filename . "." . $file->getClientOriginalExtension();
        $path = $file->move('public/images/' . $folder, $filename ?? $file->getClientOriginalName());
        return url($path->getPath() . "/" . $path->getFilename());
    }
}

function uploadImages(Request $request, $input, $folder)
{
    $images = [];
    // dd($request->file($input));
    foreach ($request->file($input) as $file) {
        $filename = $file->getClientOriginalName();
        $path = $file->move('public/images/' . $folder, $filename);
        array_push($images, url($path->getPath() . "/" . $path->getFilename()));
    }
    return $images;
}

function  generateQrCode($id)
{
    try {
        QrCode::backgroundColor(255, 255, 255)->margin(10)->format('png')->size(1000)->generate($id, '../public/public/images/tickets/ticket_' . $id . '.png');
    } catch (Exception $e) {
        return $e;
    }
    return url('/public/images/tickets/ticket_'.$id .'.png');
}

function makePayment($price)
{
    return true;
}
function makeOrderPayment(Order $order)
{
    $payment =  makePayment($order->price);

    if ($payment) {
        createTickets($order);
        $order->update([
            'payment_details' => 'Succeful Payment',
            'method' => 'paypal'
        ]);
    }
};
function createTickets($order)
{
    // dd($order);
    foreach ($order->items as $tl => $qty) {
        $ticket_level = TicketLevel::with('event')->find($tl);
        $event_id = $ticket_level->event->id;

        // dd([
        //     'id' => uuid_create(),
        //     'ticket_level_id' => $tl,
        //     'user_id' => $order->user_id,
        //     'event_id' => $event_id,
        //     'bought_at' => date('Y-m-d H:i:s'),
        //     'order_id' => $order,
        //     'qr_code' => ''
        // ]);
        # code...
        for ($x = 0; $x < $qty; $x++) {
            $ticket = Ticket::create([
                'id' => uuid_create(),
                'ticket_level_id' => $tl,
                'user_id' => $order->user_id,
                'event_id' => $event_id,
                'bought_at' => date('Y-m-d H:i:s'),
                'order_id' => $order->id,
                'qr_code' => ''
            ]);
            $ticket->qr_code = generateQrCode($ticket->id);
            $ticket->save();

            $remainingTicket = $ticket_level->bought + $qty;
            $ticket_level->update([
                'bought' => $remainingTicket
            ]);
        }

    }
}

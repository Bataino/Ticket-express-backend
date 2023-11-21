<div>
    {{$order->summary}}<br>
    @foreach($order->items as $tl => $qty)
    
    {{ $prices[$loop->index] }}<br>
    {{ $tl }}<br>
    {{$qty}}
    {{ App\Models\TicketLevel::find($tl)->title}}
    @endforeach()
</div>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use App\Models\Orer;
use App\Models\Ticket;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'description',
        'venue_id',
        'files',
        'user_id',
        'time_zone',
        'is_publish'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function venue() {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class)->orderBy('created_at','desc');
    }

    public function orders() {
        return $this->hasMany(Order::class)->orderBy('created_at','desc');
    }
    public function orders_today() {
        return $this->hasMany(Order::class)->where('created_at', '>=' ,Carbon::today())->orderBy('created_at','desc');
    }
    // public function total_orders() {
    //     return $this->hasMany(Order::class)->get(['price']);
    // }
    public function ticket_levels() {
        return $this->hasMany(TicketLevel::class)->orderBy('created_at','desc');
    }
    public function discounts(){
        return $this->hasMany(Discount::class)->orderBy('created_at','desc');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use App\Models\Orer;
use App\Models\Ticket;

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
        'time_zone'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function venue() {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}

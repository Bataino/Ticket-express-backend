<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketLevel extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'title', 'quantity', 'limit', 'is_available', 'price'];

    public function event(){
        return $this->belongsTo( Event::class, 'event_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['id','ticket_level_id', 'event_id', 'user_id', 'bought', 'order_id','qr_code','status'];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }

}

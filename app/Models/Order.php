<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['items',"summary","price","user_id", "event_id"];
    protected $casts = ['items' => 'array'] ;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function event() {
        return $this->belongsTo(Event::class);
    }
}

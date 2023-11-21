<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'event_id',
        'title',
        'status'
    ];

    public function event() {
        return $this->hasOne(Event::class,'id','event_id');
    }
}

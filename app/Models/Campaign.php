<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'mail_content', 'subject', 'users', 'status'];
    public $casts = ['users' => 'array'];

    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}

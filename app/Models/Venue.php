<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'title',
        'country',
        'state',
        'address',
        'venue_setting',
        'lat',
        'long',
        'city',
        'zip_code',
        'user_id'
    ];
    use HasFactory;
}

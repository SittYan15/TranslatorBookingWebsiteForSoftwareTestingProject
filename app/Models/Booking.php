<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'translator_id',
        'booking_date',
        'booking_start_time',
        'duration_hrs',
        'duration_mins',
        'status',
        'service_id',
        'location',
    ];
}

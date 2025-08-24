<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'translator_id',
        'language1_id',
        'language2_id',
        'price',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'ville',
        'capacity',
        'cuisine',
        'user_id',
    ];
}

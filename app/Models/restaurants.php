<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class restaurants extends Model
{
    protected $fillable = [
        'name',
        'ville',
        'capacity',
        'cuisine',
    ];
}

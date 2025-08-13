<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterGame extends Model
{
    protected $fillable = [
        'registration_id',
        'game_id',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'game_name',
        'created_at',
        'updated_at',
    ];
}

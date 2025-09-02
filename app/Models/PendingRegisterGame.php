<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegisterGame extends Model
{
    protected $table = 'pendingregistergame';
    protected $fillable = [
        'pending_registration_id',
        'game_id',
    ];
}

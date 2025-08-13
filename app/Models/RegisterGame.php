<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterGame extends Model
{
    protected $fillable = [
        'registration_id',
        'game_id',
    ];
// In your Registration model
public function registerGames()
{
    return $this->hasMany(RegisterGame::class, 'registration_id');
}
    
}

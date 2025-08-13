<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    protected $table = 'disability';
    protected $fillable = [
        'disability_name',
        'created_at',
        'updated_at',
    ];
    
}

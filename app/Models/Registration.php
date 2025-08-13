<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $fillable = [
        'surname',
        'athlete_name',
        'father_name',
        'dob',
        'percentage',
        'email',
        'phone',
        'address',
        'age_group',
        'gender',
        'disability',
    ];


    
}

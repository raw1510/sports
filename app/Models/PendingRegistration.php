<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    protected $table = 'pending_registration';
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

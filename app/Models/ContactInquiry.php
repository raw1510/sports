<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    //

    protected $fillable = [
        'full_name',
        'age',
        'disability_type',
        'contact_number',
        'information_request'
    ];

    // Define disability type options for validation
    public static function getDisabilityTypes()
    {
        return [
            'physical' => 'Physical Disability',
            'visual' => 'Visual Impairment',
            'intellectual' => 'Intellectual Disability',
            'hearing' => 'Hearing Impairment',
            'multiple' => 'Multiple Disabilities',
            'other' => 'Other'
        ];
    }
}

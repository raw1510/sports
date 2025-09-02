<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'registration_id',
        'document_path',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }

}

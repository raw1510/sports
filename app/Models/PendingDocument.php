<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingDocument extends Model
{
    protected $table = 'pending_documents';

    protected $fillable = [
        'pending_registration_id',
        'document_path',
    ];
}

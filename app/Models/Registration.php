<?php

namespace App\Models;
use Illuminate\Support\Facades\File;

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

// In your Registration model
public function registerGames()
{
    return $this->hasMany(RegisterGame::class, 'registration_id');
}

public function documents()
    {
        return $this->hasMany(Document::class, 'registration_id'); // Assuming your Document model is App\Models\Document
    }

     protected static function boot()
    {
        parent::boot();
        static::deleting(function ($registration) {
        foreach ($registration->documents as $document) {
            $documentPath = public_path($document->document_path);

            if (File::exists($documentPath)) {
                File::delete($documentPath);
                // Optional log
                // \Log::info("Deleted file: " . $documentPath);    
            }
        }
    });
    }

    
    
}

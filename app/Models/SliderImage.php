<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;

    protected $fillable = [
         'title',
        'description',
        'image_path',
        'is_active',
        'order_index',
    ];

    // Cast attributes to native types if needed
    protected $casts = [
        'is_active' => 'boolean',
        // 'order_index' is typically an integer, which Eloquent handles by default
    ];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderImage;

class HomepageController extends Controller
{
    //
    public function frontendSlider()
    {
        // Fetch all slider images, ordered by creation date (newest first) for the management table
        // Alternatively, you could order by order_index and then by active status for a more structured view
        $sliderImages = SliderImage::orderBy('created_at', 'desc')->take(3)->get();

        // Pass the data to the view
        return view('main.main', compact('sliderImages')); // Adjust view name as needed
    }
}

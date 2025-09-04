<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderImage;
use App\Models\Gallery;

class HomepageController extends Controller
{
    //
    public function frontendSlider()
    {
        // Fetch all slider images, ordered by creation date (newest first) for the management table
        // Alternatively, you could order by order_index and then by active status for a more structured view
        $sliderImages = SliderImage::whereNotNull('display_order')
                           ->orderBy('display_order', 'asc')
                           ->get();
        
        $galleries = Gallery::where('is_active', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
                            // dd($galleries); 

        // Pass the data to the view
        return view('main.main', compact('sliderImages','galleries')); // Adjust view name as needed
    }
}

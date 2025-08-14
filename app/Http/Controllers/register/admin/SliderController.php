<?php

namespace App\Http\Controllers\register\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderImage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    //

    public function index()
    {
        // Fetch all slider images, ordered by creation date (newest first) for the management table
        // Alternatively, you could order by order_index and then by active status for a more structured view
        $sliderImages = SliderImage::orderBy('created_at', 'desc')->get();

        // Pass the data to the view
        return view('main.slider', compact('sliderImages')); // Adjust view name as needed
    }
    

public function sliderPost(Request $request)
{
    // 1. Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // 2. Create the public/images/sliders directory if not exists
            $destinationPath = public_path('images/sliders');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // 3. Generate a unique filename
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // 4. Move the uploaded file to public/images/sliders
            $image->move($destinationPath, $filename);

            // 5. Get the path relative to public/
            $relativePath = 'images/sliders/' . $filename;

            // 6. Determine new order index
            $maxOrderIndex = SliderImage::where('is_active', true)->max('order_index') ?? 0;
            $newOrderIndex = $maxOrderIndex + 1;

            // 7. Save to DB
            $sliderImage = new SliderImage();
            $sliderImage->title = $request->input('title', '');
            $sliderImage->description = $request->input('description', '');
            $sliderImage->image_path = $relativePath; // now points to public folder path
            $sliderImage->is_active = false;
            $sliderImage->order_index = $newOrderIndex;
            $sliderImage->save();

            return redirect()->back()->with('success', 'Slider image uploaded successfully!');
        } else {
            return redirect()->back()->withErrors(['image' => 'No image file was uploaded.'])->withInput();
        }

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Failed to upload image. Please try again.'])->withInput();
    }
}


    //working images 
    // public function sliderPost(Request $request){
    //     // 1. Validate the incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         // 2. Handle the file upload
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
                
    //             // Define the storage path (e.g., 'public/images/sliders')
    //             // Ensure 'public/images/sliders' disk directory exists and is linked
    //             // Run `php artisan storage:link` if not already done
    //             $path = $image->store('images/sliders', 'public'); 
                
    //             // 3. Determine the initial order_index for the new image
    //             // Option 1: Place it at the end of the active list by default
    //             // Get the highest current order_index among active images, then add 1
    //             $maxOrderIndex = SliderImage::where('is_active', true)->max('order_index') ?? 0;
    //             $newOrderIndex = $maxOrderIndex + 1;
                
    //             // Option 2: Always add to the end of all images (regardless of active status)
    //             // $newOrderIndex = (SliderImage::max('order_index') ?? 0) + 1;

    //             // 4. Create a new SliderImage record in the database
    //             $sliderImage = new SliderImage();
    //             $sliderImage->title = $request->input('title', ''); // Use empty string if null
    //             $sliderImage->description = $request->input('description', '');
    //             $sliderImage->image_path = $path; // Store the relative path
    //             $sliderImage->is_active = false; // Initially inactive, user can activate later
    //             $sliderImage->order_index = $newOrderIndex;
    //             $sliderImage->save();

    //             // 5. Redirect back with success message
    //             return redirect()->back()->with('success', 'Slider image uploaded successfully!');
    //         } else {
    //             // This case ideally shouldn't happen due to validation, but good to handle
    //             return redirect()->back()->withErrors(['image' => 'No image file was uploaded.'])->withInput();
    //         }

    //     } catch (\Exception $e) {
    //         // Log the error for debugging (optional)
    //         // \Log::error('Slider image upload failed: ' . $e->getMessage());
            
    //         // Redirect back with error message
    //         return redirect()->back()->withErrors(['error' => 'Failed to upload image. Please try again.'])->withInput();
    //     }

    // }

}

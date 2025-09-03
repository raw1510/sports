<?php

namespace App\Http\Controllers\register\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderImage;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //

    public function index()
    {
        // Fetch all slider images, ordered by creation date (newest first) for the management table
        // Alternatively, you could order by order_index and then by active status for a more structured view
        //paginate upto 10
        $allSliderImages = SliderImage::orderBy('created_at', 'desc')->paginate(10);
        //  dd($allSliderImages);

    // Fetch the CURRENTLY SELECTED images for display in the management section (optional, for context)

        // Pass the data to the view
        return view('main.slider',  compact('allSliderImages')); // Adjust view name as needed
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
$sliderImage->is_active = false; // Or true, depending on your default
$sliderImage->order_index = $newOrderIndex; // Keep existing logic if needed
$sliderImage->display_order = null; // Explicitly set to null for new uploads
$sliderImage->save();
            // $sliderImage = new SliderImage();
            // $sliderImage->title = $request->input('title', '');
            // $sliderImage->description = $request->input('description', '');
            // $sliderImage->image_path = $relativePath; // now points to public folder path
            // $sliderImage->is_active = false;
            // $sliderImage->order_index = $newOrderIndex;
            // $sliderImage->save();

            Alert::success('Success', 'Slider image uploaded successfully!');
            return redirect()->back()->with('success', 'Slider image uploaded successfully!');
        } else {
            Alert::error('Error', 'No image file was uploaded.');
            return redirect()->back()->withErrors(['image' => 'No image file was uploaded.'])->withInput();
        }

    } catch (\Exception $e) {
        Alert::error('Error', 'Failed to upload image. Please try again.');
        return redirect()->back()->withErrors(['error' => 'Failed to upload image. Please try again.'])->withInput();
    }
}


    public function setDisplayOrder(Request $request)
    {
        // 1. Validate the incoming request data
        // We expect an array 'display_order' where keys are image IDs and values are 1, 2, 3, or null/empty string.
        $validatedData = $request->validate([
            'display_order' => 'required|array',
            'display_order.*' => 'nullable|integer|in:1,2,3', // Values must be 1, 2, 3, or null/empty
            // Note: Validating that keys are existing image IDs is more complex and often done implicitly
            // by the database query below (it will just ignore invalid IDs).
        ], [
            // Custom error messages (optional)
            'display_order.required' => 'No display order data was submitted.',
            'display_order.*.integer' => 'Display order must be a number (1, 2, or 3).',
            'display_order.*.in' => 'Display order must be 1, 2, or 3.',
        ]);
        // dd($request->all());
        try {
            // 2. Get the submitted data (associative array: [image_id => order])
            $submittedOrders = $request->input('display_order', []);
            // dd($submittedOrders);

            // 3. Reset all current display_orders in the DB to NULL
            // This clears any previously selected images.
            SliderImage::whereNotNull('display_order')->update(['display_order' => null]);

            // 4. Prepare data for batch insert/update (optional optimization)
            $updates = [];
            foreach ($submittedOrders as $imageId => $order) {
                // dd($order);
                // Ensure $imageId is an integer and $order is valid before proceeding
                if (is_numeric($imageId) && in_array($order, ["1", "2", "3"], true)) {
                    // Cast to int for safety
                    // dd($imageId);
                    $intImageId = (int) $imageId;
                    $intOrder = (int) $order;

                    // Check if the image ID actually exists (optional but good practice)
                    // This prevents errors if an ID was tampered with or is stale.
                    if (SliderImage::where('id', $imageId)->exists()) {
                        $updates[] = ['id' => $imageId, 'display_order' => $intOrder];
                    }
                }

                    

                // If $order is null/empty or $imageId is invalid, we just skip it
                // (because we already reset everything to null)
            }
            // 5. Update the display_order for the selected images
            // Use a loop for individual updates (simpler) or a batch update if you have many.
            foreach ($updates as $update) {
                SliderImage::where('id', $update['id'])->update(['display_order' => $update['display_order']]);
            }

            // Alternative batch update approach (if supported by your DB and Eloquent setup):
            // This might be slightly more efficient for many updates.
            /*
            foreach ($updates as $update) {
                DB::table('slider_images')
                    ->where('id', $update['id'])
                    ->update(['display_order' => $update['display_order']]);
            }
            */

            // 6. Redirect back with success message
            return redirect()->back()->with('success', 'Slider display order updated successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error updating slider display order: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            // 7. Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'Failed to update slider display order. Please try again.']);
        }
    }

public function destroy($id)
{
    try {
        // 1. Find the slider image by ID
        $sliderImage = SliderImage::findOrFail($id);

        // 2. Get the image path
        $imagePath = public_path($sliderImage->image_path);

        // 3. Delete the image file from the server
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // 4. Delete the database record
        $sliderImage->delete();

        // 5. Return a JSON response for AJAX
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('Error deleting slider image (ID: ' . $id . '): ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to delete slider image.'], 500);
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

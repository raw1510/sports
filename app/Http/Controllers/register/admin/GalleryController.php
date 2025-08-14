<?php

namespace App\Http\Controllers\register\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    //

    public function galleryPost(Request $request)
    {
        // 1. Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'gallery_title' => 'nullable|string|max:255',
            'gallery_description' => 'nullable|string',
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->hasFile('gallery_image')) {
                $image = $request->file('gallery_image');

                // 2. Create the public/images/gallery directory if not exists
                $destinationPath = public_path('images/gallery');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // 3. Generate a unique filename
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                // 4. Move the uploaded file to public/images/gallery
                $image->move($destinationPath, $filename);

                // 5. Get the path relative to public/
                $relativePath = 'images/gallery/' . $filename;

                // 6. Determine new order index (for active images)
                $maxOrderIndex = Gallery::where('is_active', true)->max('order_index') ?? 0;
                $newOrderIndex = $maxOrderIndex + 1;

                // 7. Save to DB
                $galleryImage = new Gallery();
                $galleryImage->title = $request->input('gallery_title', '');
                $galleryImage->description = $request->input('gallery_description', '');
                $galleryImage->image_path = $relativePath; // now points to public folder path
                $galleryImage->is_active = false; // Initially inactive
                $galleryImage->order_index = $newOrderIndex;
                $galleryImage->save();

                return redirect()->back()->with('gallery_success', 'Gallery image uploaded successfully!');
            } else {
                return redirect()->back()->withErrors(['gallery_image' => 'No image file was uploaded.'])->withInput();
            }

        } catch (\Exception $e) {
            // Log the error for debugging (optional)
            // \Log::error('Gallery image upload failed: ' . $e->getMessage());
            
            return redirect()->back()->withErrors(['gallery_error' => 'Failed to upload gallery image. Please try again.'])->withInput();
        }
    }

}

<?php

namespace App\Http\Controllers\contact\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewInquiryMail;

class ContactController extends Controller
{
    //
    public function ContactUsFormGet()
    {
        $pendingInquiries = ContactInquiry::where('status', 'pending')
            ->latest()
            ->paginate(10);

        // Fetch closed inquiries
        $closedInquiries = ContactInquiry::where('status', 'closed')
            ->latest()
            ->paginate(10);

        return view('admin.AdminContactUS', compact('pendingInquiries', 'closedInquiries'));
    }


    public function closeInquiry(Request $request, $id)
{
    $inquiry = ContactInquiry::findOrFail($id);
    $inquiry->status = 'closed';
    $inquiry->save();

    return redirect()->back()->with('success', 'Inquiry marked as closed.');
}



public function ContactUsFormPost(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'full_name' => 'required|string|max:255',
        'age' => 'required|integer|min:1|max:120',
        'disability_type' => 'required|in:' . implode(',', array_keys(ContactInquiry::getDisabilityTypes())),
        'contact_number' => 'required|digits:10',
        'information_request' => 'required|string|max:1000'
    ], [
        // Custom error messages
        'disability_type.in' => 'Please select a valid disability type.',
        'contact_number.digits' => 'Contact number must be exactly 10 digits.',
        'information_request.max' => 'Information request must not exceed 1000 characters.'
    ]);

    // Return validation errors as JSON for AJAX requests
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        // Save the contact inquiry to the database
        $inquiry = ContactInquiry::create([
            'full_name' => $request->full_name,
            'age' => $request->age,
            'disability_type' => $request->disability_type,
            'contact_number' => $request->contact_number,
            'information_request' => $request->information_request
        ]);

        Mail::to('mehtakrish1510@gmail.com')->send(new NewInquiryMail($inquiry));

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully. We will contact you soon.'
        ]);
        
    } catch (\Exception $e) {
        // Log error and return failure response
        Log::error('Contact form submission failed: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'There was a problem submitting your inquiry. Please try again.'
        ], 500);
    }
}

    // public function ContactUsFormPost(Request $request)
    // {
    //     // Validate the request data
    //     $validator = Validator::make($request->all(), [
    //         'full_name' => 'required|string|max:255',
    //         'age' => 'required|integer|min:1|max:120',
    //         'disability_type' => 'required|in:' . implode(',', array_keys(ContactInquiry::getDisabilityTypes())),
    //         'contact_number' => 'required|digits:10',
    //         'information_request' => 'required|string|max:1000'
    //     ], [
    //         // Custom error messages
    //         'disability_type.in' => 'Please select a valid disability type.',
    //         'contact_number.digits' => 'Contact number must be exactly 10 digits.',
    //         'information_request.max' => 'Information request must not exceed 1000 characters.'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         // Save the contact inquiry to the database
    //         $inquiry = ContactInquiry::create([
    //             'full_name' => $request->full_name,
    //             'age' => $request->age,
    //             'disability_type' => $request->disability_type,
    //             'contact_number' => $request->contact_number,
    //             'information_request' => $request->information_request
    //         ]);

    //          Mail::to('mehtakrish1510@gmail.com')->send(new NewInquiryMail($inquiry));

    //         // Show success message
    //         alert()->success('Thank You!', 'Your inquiry has been submitted successfully. We will contact you soon.');
            
    //         return redirect()->back();
            
    //     } catch (\Exception $e) {
    //         // Log error and show failure message
    //         Log::error('Contact form submission failed: ' . $e->getMessage());
    //         alert()->error('Error!', 'There was a problem submitting your inquiry. Please try again.');
    //         return redirect()->back()->withInput();
    //     }
    // }

}

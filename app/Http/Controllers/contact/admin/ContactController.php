<?php

namespace App\Http\Controllers\contact\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    //
    public function ContactUsFormGet()
    {
        $inquiries = ContactInquiry::latest()->paginate(10);
        return view('admin.AdminContactUS', compact('inquiries'));
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Save the contact inquiry to the database
            ContactInquiry::create([
                'full_name' => $request->full_name,
                'age' => $request->age,
                'disability_type' => $request->disability_type,
                'contact_number' => $request->contact_number,
                'information_request' => $request->information_request
            ]);

            // Show success message
            alert()->success('Thank You!', 'Your inquiry has been submitted successfully. We will contact you soon.');
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            // Log error and show failure message
            Log::error('Contact form submission failed: ' . $e->getMessage());
            alert()->error('Error!', 'There was a problem submitting your inquiry. Please try again.');
            return redirect()->back()->withInput();
        }
    }

}

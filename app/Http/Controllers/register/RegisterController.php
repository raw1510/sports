<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\PendingRegistration;
use App\Models\PendingRegisterGame;
use App\Models\PendingDocument;
use App\Models\RegisterGame;
use App\Models\Game;
use App\Models\Disability;
use App\Models\Document;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    //
    public function registerShow()
    {
        //get only game_name from the game table
        $games = Game::pluck('game_name', 'id');
        $disabilities = Disability::pluck('disability_name', 'id');
        // dd($disabilities,$games);
        return view('main.register2', compact('games', 'disabilities'));
    }

public function regitserPost(Request $request)
{
    // dd($request->all());
    $validated = $request->validate([
        'surname' => 'required|string|max:255',
        'athlete_name' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'dob' => 'required|date',
        'gender' => 'required|string|max:255',
        'age_group' => 'required|string|max:255',
        'address' => 'required|string',
        'percentage' => 'required|numeric',
        'phone' => ['required', 'regex:/^(\+91)?[0-9]{10}$/', 'unique:registrations,phone'], //unique
        'email' => 'required|email|unique:registrations,email', //unique

        'disability' => 'required',

        'games'   => 'required|array|min:1|max:3',
        'games.*' => 'exists:games,id', // ensures each game ID exists

        // Document validations - 300KB = 307200 bytes
        'aadhar_card' => 'required|file|mimes:jpg,jpeg,png,pdf|max:300',
        'disability_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:300',
        'bank_passbook' => 'required|file|mimes:jpg,jpeg,png,pdf|max:300',
        'passport_photo' => 'required|file|mimes:jpg,jpeg,png|max:300',
        'passport_pages' => 'nullable|file|mimes:pdf|max:300', // Optional
    ], [
        // Custom error messages
        'aadhar_card.required' => 'Aadhar card is required.',
        'aadhar_card.max' => 'Aadhar card file size must be under 300KB.',
        'aadhar_card.mimes' => 'Aadhar card must be in JPG, JPEG, PNG, or PDF format.',
        
        'disability_certificate.required' => 'Disability certificate is required.',
        'disability_certificate.max' => 'Disability certificate file size must be under 300KB.',
        'disability_certificate.mimes' => 'Disability certificate must be in JPG, JPEG, PNG, or PDF format.',
        
        'bank_passbook.required' => 'Bank passbook is required.',
        'bank_passbook.max' => 'Bank passbook file size must be under 300KB.',
        'bank_passbook.mimes' => 'Bank passbook must be in JPG, JPEG, PNG, or PDF format.',
        
        'passport_photo.required' => 'Passport size photo is required.',
        'passport_photo.max' => 'Passport photo file size must be under 300KB.',
        'passport_photo.mimes' => 'Passport photo must be in JPG, JPEG, or PNG format.',
        
        'passport_pages.max' => 'Passport pages file size must be under 300KB.',
        'passport_pages.mimes' => 'Passport pages must be in PDF format.',
    ], [
        'aadhar_card' => 'Aadhar Card',
        'disability_certificate' => 'Disability Certificate',
        'bank_passbook' => 'Bank Passbook',
        'passport_photo' => 'Passport Photo',
        'passport_pages' => 'Passport Pages',
    ]);

    // dd($validated['surname']);

    DB::transaction(function () use ($validated, $request) {
        // 1️⃣ Create main register record
        $register = Registration::create([
            'surname'      => $validated['surname'],
            'athlete_name' => $validated['athlete_name'],
            'father_name'  => $validated['father_name'],
            'email'        => $validated['email'],
            'dob'          => $validated['dob'],
            'gender'       => $validated['gender'],
            'age_group'    => $validated['age_group'],
            'address'      => $validated['address'],
            'percentage'   => $validated['percentage'],
            'phone'        => $validated['phone'],
            'disability' => $validated['disability'],
            'is_Approve' => false,
        ]);
        // dd($register);

        // 2️⃣ Create game associations
        foreach ($validated['games'] as $gameId) {
            RegisterGame::create([
                'registration_id' => $register->id,
                'game_id'     => $gameId,
            ]);
        }

        // 3️⃣ Handle document uploads
        $documentTypes = [
            'aadhar_card' => 'Aadhar Card',
            'disability_certificate' => 'Disability Certificate', 
            'bank_passbook' => 'Bank Passbook',
            'passport_photo' => 'Passport Photo',
            'passport_pages' => 'Passport Pages'
        ];

        foreach ($documentTypes as $fieldName => $documentType) {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                
                if ($file->isValid()) {
                    // Make sure folder exists
                    $destinationPath = public_path('uploads/documents');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    // Create a unique filename with document type prefix
                    $prefix = strtolower(str_replace(' ', '_', $documentType));
                    $extension = $file->getClientOriginalExtension();
                    $filename = $prefix . '_' . time() . '_' . $register->id . '.' . $extension;

                    // Move file to public/uploads/documents
                    $file->move($destinationPath, $filename);

                    // Save in database with document type
                    Document::create([
                        'registration_id' => $register->id,
                        'document_type' => $documentType,
                        'document_path' => 'uploads/documents/' . $filename,
                    ]);
                }
            }
        }
    });
    
    return back()->with('success', 'Registration submitted successfully with all documents!');
}

    //commented due to seperate document uploads ( this is working code for the multiple uploads)
// public function regitserPost(Request $request)
// {
//     // dd($request->all());
//     $validated = $request->validate([
//         'surname' => 'required|string|max:255',
//         'athlete_name' => 'required|string|max:255',
//         'father_name' => 'required|string|max:255',
//         'dob' => 'required|date',
//         'gender' => 'required|string|max:255',
//         'age_group' => 'required|string|max:255',
//         'address' => 'required|string',
//         'percentage' => 'required|numeric',
//         'phone' => ['required', 'regex:/^(\+91)?[0-9]{10}$/', 'unique:registrations,phone'], //unique
//         'email' => 'required|email|unique:registrations,email', //unique

//         'disability' => 'required',

//         'games'   => 'required|array|min:1|max:3',
//         'games.*' => 'exists:games,id', // ensures each game ID exists


//         'documents' => 'nullable|array',
//         'documents.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
//     ], [], [
//         'documents.*' => 'file', // Friendly name for all files
//     ]);

//     // dd($validated['surname']);

//     DB::transaction(function () use ($validated, $request) {
//         // 1️⃣ Create main register record
//         $register = PendingRegistration::create([
//             'surname'      => $validated['surname'],
//             'athlete_name' => $validated['athlete_name'],
//             'father_name'  => $validated['father_name'],
//             'email'        => $validated['email'],
//             'dob'          => $validated['dob'],
//             'gender'       => $validated['gender'],
//             'age_group'    => $validated['age_group'],
//             'address'      => $validated['address'],
//             'percentage'   => $validated['percentage'],
//             'phone'        => $validated['phone'],
//             'disability' => $validated['disability'],
//         ]);
//         // dd($register);

//         foreach ($validated['games'] as $gameId) {
//             PendingRegisterGame::create([
//                 'pending_registration_id' => $register->id,
//                 'game_id'     => $gameId,
//             ]);
//         }

//         // Handle multiple document uploads
//         if ($request->hasFile('documents')) {
//             foreach ($request->file('documents') as $file) { // Loop through each uploaded file
//                 if ($file->isValid()) { // Ensure the file is valid
//                     // Make sure folder exists
//                     $destinationPath = public_path('uploads/documents');
//                     if (!file_exists($destinationPath)) {
//                         mkdir($destinationPath, 0777, true);
//                     }

//                     // Create a unique filename
//                     $filename = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));

//                     // Move file to public/uploads/documents
//                     $file->move($destinationPath, $filename);

//                     // Save relative path in DB
//                     PendingDocument::create([
//                         'pending_registration_id' => $register->id,
//                         'document_path'        => 'uploads/documents/' . $filename, // Store relative path
//                     ]);
//                 }
//             }
//         }

//         // At this point, $register->id is available for linking with games/documents
//     });
//     return back()->with('success', 'Files uploaded successfully!');
// }


    // public function regitserPost(Request $request)
    // {

    //     // dd($request->all());
    //     $validated = $request->validate([
    //         'surname' => 'required|string|max:255',
    //         'athlete_name' => 'required|string|max:255',
    //         'father_name' => 'required|string|max:255',
    //         'dob' => 'required|date',
    //         'gender' => 'required|string|max:255',
    //         'age_group' => 'required|string|max:255',
    //         'address' => 'required|string',
    //         'percentage' => 'required|numeric',
    //         'phone' => ['required', 'regex:/^(\+91)?[0-9]{10}$/', 'unique:registrations,phone'], //unique
    //         'email' => 'required|email|unique:registrations,email', //unique

    //         'disability' => 'required',

    //         'games'   => 'required|array|min:1|max:3',
    //         'games.*' => 'exists:games,id', // ensures each game ID exists


    //         'documents' => 'nullable|array',
    //         'documents.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    //     ], [], [
    //         'documents.*' => 'file', // Friendly name for all files
    //     ]);

    //     // dd($validated['surname']);

    //     DB::transaction(function () use ($validated, $request) {
    //         // 1️⃣ Create main register record
    //         $register = Registration::create([
    //             'surname'      => $validated['surname'],
    //             'athlete_name' => $validated['athlete_name'],
    //             'father_name'  => $validated['father_name'],
    //             'email'        => $validated['email'],
    //             'dob'          => $validated['dob'],
    //             'gender'       => $validated['gender'],
    //             'age_group'    => $validated['age_group'],
    //             'address'      => $validated['address'],
    //             'percentage'   => $validated['percentage'],
    //             'phone'        => $validated['phone'],
    //             'disability' => $validated['disability'],
    //         ]);
    //         // dd($register);

    //         foreach ($validated['games'] as $gameId) {
    //             RegisterGame::create([
    //                 'registration_id' => $register->id,
    //                 'game_id'     => $gameId,
    //             ]);
    //         }

    //         if ($request->hasFile('documents')) {
    //             $file = $request->file('documents');

    //             // Make sure folder exists
    //             $destinationPath = public_path('uploads/documents');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0777, true);
    //             }

    //             // Create a unique filename
    //             $filename = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));

    //             // Move file to public/uploads/documents
    //             $file->move($destinationPath, $filename);

    //             // Save relative path in DB
    //             Document::create([
    //                 'register_id' => $register->id,
    //                 'document_path'        => $destinationPath . $filename,
    //             ]);
    //         }

    //         // At this point, $register->id is available for linking with games/documents
    //     });

    //     dd('hi');
    //     return back()->with('success', 'Files uploaded successfully!');
    // }
}

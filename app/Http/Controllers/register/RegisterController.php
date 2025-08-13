<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
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


        'documents' => 'nullable|array',
        'documents.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    ], [], [
        'documents.*' => 'file', // Friendly name for all files
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
        ]);
        // dd($register);

        foreach ($validated['games'] as $gameId) {
            RegisterGame::create([
                'registration_id' => $register->id,
                'game_id'     => $gameId,
            ]);
        }

        // Handle multiple document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) { // Loop through each uploaded file
                if ($file->isValid()) { // Ensure the file is valid
                    // Make sure folder exists
                    $destinationPath = public_path('uploads/documents');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    // Create a unique filename
                    $filename = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));

                    // Move file to public/uploads/documents
                    $file->move($destinationPath, $filename);

                    // Save relative path in DB
                    Document::create([
                        'registration_id' => $register->id,
                        'document_path'        => 'uploads/documents/' . $filename, // Store relative path
                    ]);
                }
            }
        }

        // At this point, $register->id is available for linking with games/documents
    });
    return back()->with('success', 'Files uploaded successfully!');
}


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

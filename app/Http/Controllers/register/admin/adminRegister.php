<?php

namespace App\Http\Controllers\register\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\RegisterGame;
use App\Models\Game;
use App\Models\Document;
use App\Models\Disability;

class adminRegister extends Controller
{
    //



    //working code before filtering
// public function adminRegistrations()
// {
//     // Step 1: Get all registrations
//     $registrations = Registration::orderBy('id', 'desc')->get();
//     $disability = Disability::pluck('disability_name','id');
//     $game = Game::pluck('game_name','id');
//     // dd($disability,$game);
//     // Step 2: Attach games & documents for each registration
//     foreach ($registrations as $registration) {
        
//         // Get game names for this user
//         $gameIds = RegisterGame::where('registration_id', $registration->id)
//                                ->pluck('game_id');

//         $games = Game::whereIn('id', $gameIds)->pluck('game_name')->toArray();

//         // Add games as comma separated string
//         $registration->games_list = implode(', ', $games);

//         // Get document paths for this user
//         $documents = Document::where('registration_id', $registration->id)->get();

//         // Prepare public URLs for documents
//         $registration->documents_list = $documents->map(function($doc) {
//             return asset('/' . $doc->document_path);
//         })->toArray();
//     }
//     // dd($registrations);
//     // Step 3: Pass data to the view
//     return view('main.admin', compact('registrations','disability','game'));
// }

}

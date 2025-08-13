<?php

namespace App\Http\Controllers\register\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\RegisterGame;
use App\Models\Game;
use App\Models\Document;
use App\Models\Disability;
use App\Exports\RegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;

class adminRegister extends Controller
{
    //

public function adminRegistrations(Request $request)
{

     if ($request->get('export') === 'excel') {
        return $this->exportToExcel($request);
    }
    // Get search query from request
    $search = $request->get('search');
    
    // Get filter values
    $disabilityFilter = $request->get('disability_filter');
    $gameFilter = $request->get('game_filter');
    
    // Step 1: Get all registrations with optional search filtering
    $registrationsQuery = Registration::orderBy('id', 'desc');
    
    // Apply search filter if provided
    if ($search) {
        $registrationsQuery->where(function($query) use ($search) {
            $query->where('athlete_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }
    
    // Apply disability filter if provided
    if ($disabilityFilter) {
        $registrationsQuery->where('disability', 'LIKE', "%{$disabilityFilter}%");
    }
    
    // Apply game filter if provided
    if ($gameFilter) {
        $registrationsQuery->whereHas('registerGames', function($query) use ($gameFilter) {
            $query->where('game_id', $gameFilter);
        });
    }
    
    // Paginate results (50 records per page)
    $registrations = $registrationsQuery->paginate(50)->appends($request->except('page'));
    
    // Get filter options
    $disability = Disability::pluck('disability_name','id');
    $game = Game::pluck('game_name','id');
    
    // Step 2: Attach games & documents for each registration
    foreach ($registrations as $registration) {
        
        // Get game names for this user through the register_game pivot table
        $gameIds = RegisterGame::where('registration_id', $registration->id)
                               ->pluck('game_id');

        $games = Game::whereIn('id', $gameIds)->pluck('game_name')->toArray();

        // Add games as comma separated string
        $registration->games_list = implode(', ', $games);

        // Get document paths for this user
        $documents = Document::where('registration_id', $registration->id)->get();

        // Prepare public URLs for documents
        $registration->documents_list = $documents->map(function($doc) {
            return asset('/' . $doc->document_path);
        })->toArray();
    }
    
    // Step 3: Pass data to the view
    return view('main.admin', compact('registrations', 'disability', 'game', 'search', 'disabilityFilter', 'gameFilter'));
}




//export to excel
private function exportToExcel(Request $request)
{
    // Get ALL filtered records WITHOUT pagination
    $registrationsQuery = Registration::orderBy('id', 'desc');
    
    // Apply SAME filters as pagination version
    $search = $request->get('search');
    $disabilityFilter = $request->get('disability_filter');
    $gameFilter = $request->get('game_filter');
    
    // Apply the same filtering logic
    if ($search) {
        $registrationsQuery->where(function($query) use ($search) {
            $query->where('athlete_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }
    
    if ($disabilityFilter) {
        $registrationsQuery->where('disability', 'LIKE', "%{$disabilityFilter}%");
    }
    
    if ($gameFilter) {
        $registrationsQuery->whereHas('registerGames', function($query) use ($gameFilter) {
            $query->where('game_id', $gameFilter);
        });
    }
    
    // GET ALL RECORDS (no pagination)
    $registrations = $registrationsQuery->get();
    
    // Process data same as pagination version
    foreach ($registrations as $registration) {
        // Get game names for this user through the register_game pivot table
        $gameIds = RegisterGame::where('registration_id', $registration->id)
                               ->pluck('game_id');

        $games = Game::whereIn('id', $gameIds)->pluck('game_name')->toArray();

        // Add games as comma separated string
        $registration->games_list = implode(', ', $games);

        // Get document paths for this user
        $documents = Document::where('registration_id', $registration->id)->get();

        // Prepare public URLs for documents
        $registration->documents_list = $documents->map(function($doc) {
            return asset('/' . $doc->document_path);
        })->toArray();
    }
    
    // Generate and return Excel file
    return Excel::download(new RegistrationsExport($registrations), 'registrations.xlsx');
}

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

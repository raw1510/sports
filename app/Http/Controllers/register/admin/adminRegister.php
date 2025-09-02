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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class adminRegister extends Controller
{
    //

public function adminApprovedRegistrations(Request $request)
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



//pending
    public function adminPendingRegistrations(Request $request)
    {
        // Get search query from request
        $search = $request->get('search');

        // Get filter values (example: filtering by disability for pending)
        $disabilityFilter = $request->get('disability_filter');
        // Add other filters as needed, e.g., 
        $gameFilter = $request->get('game_filter');

        // Step 1: Get pending registrations (where is_approved = 0) with optional search/filtering
        $registrationsQuery = Registration::where('is_Approve', 0) // <-- Key difference: filter for pending
                                          ->orderBy('id', 'desc');

        // Apply search filter if provided
        if ($search) {
            $registrationsQuery->where(function($query) use ($search) {
                $query->where('athlete_name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
                      // Add other searchable fields if necessary
            });
        }

        // Apply disability filter if provided
        if ($disabilityFilter) {
            $registrationsQuery->where('disability', 'LIKE', "%{$disabilityFilter}%");
        }

        // Apply other filters if needed (example for game filter)
        if ($gameFilter) {
            $registrationsQuery->whereHas('registerGames', function($query) use ($gameFilter) {
                $query->where('game_id', $gameFilter);
            });
        }

        // Paginate results (e.g., 50 records per page)
        $registrations = $registrationsQuery->paginate(50)->appends($request->except('page'));

        // Get filter options for the view
        // Fetching all disabilities for the filter dropdown
        $disability = Disability::pluck('disability_name', 'id'); // Assuming 'id' is the key
        // Fetching all games for potential game filter dropdown (if used)
        $game = Game::pluck('game_name', 'id'); // Assuming 'id' is the key

        // Step 2: Attach games & documents for each registration (same logic as approved)
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
                // Ensure document_path is correctly stored relative to public directory
                // asset() generates the full URL
                return asset('/' . ltrim($doc->document_path, '/')); // ltrim to avoid double slashes
            })->toArray();
        }

        // Step 3: Pass data to the pending registrations view
        // Make sure the view path matches where you saved the Blade file
        return view('main.pendingRegister', compact(
            'registrations',
            'disability',
            'game', // Pass game list even if not used in filter yet, for consistency or future use
            'search',
            'disabilityFilter'
            // 'gameFilter' // Pass if you add game filter
        ));
    }

//accept or reject pending registerations 

public function acceptOrReject(string $id, string $btn){
    try {
        // Find the registration (consider adding where('is_approved', 0) if needed)
        $registration = Registration::findOrFail($id); // Or where('is_approved', 0)->findOrFail($id);

        if($btn == 'accept'){
            $registration->is_approved = 1; // Make sure column name is correct
            $registration->save();
            return redirect()->back()->with('success','Registration Accepted');
        }
        elseif ($btn == 'reject') {
            // The deleting event in the Registration model will now
            // automatically delete the associated physical files
            // before the registration record is deleted from the DB.
            $registration->delete();

            return redirect()->back()->with('success','Registration Rejected and all associated data and files deleted.');
        } else {
             return redirect()->back()->with('error', 'Invalid action specified.');
        }

    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Registration not found.');
    } catch (\Exception $e) {
         // Log unexpected errors
         Log::error('Unexpected error in acceptOrReject for ID ' . $id . ' and action ' . $btn . ': ' . $e->getMessage());
        return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
    }
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

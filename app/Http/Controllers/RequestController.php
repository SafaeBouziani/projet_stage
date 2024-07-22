<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\DB;   // Import the DB facade
use App\Models\CardRequest;
use App\Models\CardInfo;

class RequestController extends Controller
{
    public function create()
    {
        return view('request.create');
    }

    public function store(Request $request)
    {
        // Start a database transaction
        DB::transaction(function () use ($request) {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:10',
                'cin' => 'required|string',
                'institution' => 'required|string',
                'position' => 'required|string',
                'type' => 'required|string',
            ]);
    
            // Get the ID of the currently authenticated user
            $userId = Auth::id();
    
            // Create a new CardInfo record
            $cardInfo = CardInfo::create([
                'user_id' => $userId,
                'full_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone'],
                'CIN' => $validatedData['cin'],
                'institution' => $validatedData['institution'],
                'position' => $validatedData['position'],
                'type' => $validatedData['type'],
            ]);
    
            // Create a new CardRequest record
            CardRequest::create([
                'user_id' => $userId,
                'card_info_id' => $cardInfo->id,
            ]);
        });

        // Redirect to a different page with a success message
        return redirect()->route('user.dashboard')->with('success', 'Your request has been created successfully!');
    }
}

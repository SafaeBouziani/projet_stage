<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;   
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
                'photo' => 'required|image',
            ]);
    
            $userId = Auth::id();
            $photoPath = $request->file('photo')->store('public/photos');
    
            $cardInfo = CardInfo::create([
                'user_id' => $userId,
                'full_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone'],
                'CIN' => $validatedData['cin'],
                'institution' => $validatedData['institution'],
                'position' => $validatedData['position'],
                'type' => $validatedData['type'],
                'photo' => basename($photoPath), // Save only the file name
            ]);
    

            CardRequest::create([
                'user_id' => $userId,
                'card_info_id' => $cardInfo->id,
            ]);
        });
    
        return redirect()->route('user.dashboard')->with('success', 'Your request has been created successfully!');
    }
    


    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $requests = CardRequest::with('user')->get();
            return view('admin.request.index', compact('requests'));
        } else {
            $requests = CardRequest::where('user_id', $user->id)->with('user')->get();
            return view('dashboard', compact('requests'));
        }

        
    }
    public function index_p()
    {
        $requests = CardRequest::where('status', 'pending')->with('user')->get();
        return view('admin.request.pending', compact('requests'));   
    }
    public function index_a()
    {
        $requests = CardRequest::where('status', 'approved')->with('user')->get();
        return view('admin.request.approved', compact('requests'));   
    }
    public function index_d()
    {
        $requests = CardRequest::where('status', 'rejected')->with('user')->get();
        return view('admin.request.rejected', compact('requests'));   
    }

    public function show(string $id)
    {
        $request = CardRequest::findOrFail($id);
        $info = CardInfo::findOrFail($request->card_info_id);
        if (Auth::user()->hasRole('admin')){
            return view('admin.request.show', compact('request', 'info'));
        }else{
            return view('request.show', compact('request', 'info'));
        }
        
    }
    
}

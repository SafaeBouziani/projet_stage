<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestNotification;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;   
use App\Models\CardRequest;
use App\Models\CardInfo;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestStatusNotification;
use PDF;


class RequestController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $requestCount = CardRequest::where('user_id', $user->id)->count();
        $cardInfo = CardInfo::where('user_id', $user->id)->first();
    
        if ($requestCount >= 3) {
            return redirect()->route('user.dashboard')->with('error', 'You have already made 3 requests. You cannot submit any more requests.');
        }
    
        return view('request.create',compact('cardInfo'));
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
            
            // Store the photo and get the path
            $photoPath = $request->file('photo')->store('public/photos');
            $photoFilename = basename($photoPath); // Save only the file name
    
            // Check if the user already has a CardInfo
            $cardInfo = CardInfo::where('user_id', $userId)->first();
    
            if ($cardInfo) {
                // Update existing CardInfo
                $cardInfo->update([
                    'full_name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone'],
                    'CIN' => $validatedData['cin'],
                    'institution' => $validatedData['institution'],
                    'position' => $validatedData['position'],
                    'type' => $validatedData['type'],
                    'photo' => $photoFilename, // Save only the file name
                ]);
            } else {
                // Create new CardInfo
                $cardInfo = CardInfo::create([
                    'user_id' => $userId,
                    'full_name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone'],
                    'CIN' => $validatedData['cin'],
                    'institution' => $validatedData['institution'],
                    'position' => $validatedData['position'],
                    'type' => $validatedData['type'],
                    'photo' => $photoFilename, // Save only the file name
                ]);
            }
    
            // Create a new CardRequest
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
            return view('user.dashboard', compact('requests'));
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

    public function destroy(string $id)
    {
        $request = CardRequest::findOrFail($id);
  
        $request->delete();
  
        return redirect()->route('admin.requests')->with('success', 'request deleted successfully');
    }


    
    public function approveRequest(string $id)
    {
        $request = CardRequest::findOrFail($id);
    
        // Change status to approved
        $request->status = 'approved';
        $request->save();
    
        // Generate PDFs
        // Generate Card PDF
        $cardPdf = Pdf::loadView('pdf.card', ['request' => $request]);
        $cardPdfPath = storage_path('app/public/cards/' . $request->id . '_card.pdf');
        $cardPdf->save($cardPdfPath);

        // Generate Receipt PDF
        $receiptPdf = Pdf::loadView('pdf.receipt', ['request' => $request]);
        $receiptPdfPath = storage_path('app/public/receipts/' . $request->id . '_receipt.pdf');
        $receiptPdf->save($receiptPdfPath);
    
        // Send notification to user
        Mail::to($request->user->email)->send(new RequestNotification($request));
    
        return redirect()->route('admin.dashboard')->with('success', 'Request approved and PDFs generated.');
    }
    
    public function declineRequest(string $id)
    {
        $request = CardRequest::findOrFail($id);
    
        // Change status to rejected
        $request->status = 'rejected';
        $request->save();
    
        // Send notification to user
        Mail::to($request->user->email)->send(new RequestNotification($request));
    
        return redirect()->route('admin.dashboard')->with('success', 'Request rejected.');
    }
    
    public function undoDecision(string $id)
    {
        $request = CardRequest::findOrFail($id);
    
        // Change status to pending
        $request->status = 'pending';
        $request->save();
        Mail::to($request->user->email)->send(new RequestNotification($request));
    
        return redirect()->route('admin.dashboard')->with('success', 'Your decision has been undone.');
    }
    
    public function edit(string $id)
    {
        $request = CardRequest::findOrFail($id);
        $cardInfo = CardInfo::findOrFail($request->card_info_id);
  
        return view('admin.users.edit', compact('request','cardInfo'));
    }

    public function update(Request $request, $id)
    {
        // Start a database transaction
        DB::transaction(function () use ($request, $id) {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:10',
                'cin' => 'required|string',
                'institution' => 'required|string',
                'position' => 'required|string',
                'type' => 'required|string',
                'photo' => 'nullable|image', // Photo is nullable in case user doesn't want to update it
            ]);

            $userId = Auth::id();
            $cardRequest = CardRequest::findOrFail($id);
            $cardInfo = CardInfo::findOrFail($cardRequest->card_info_id);

            // Check if the authenticated user owns the CardInfo
            if ($cardInfo->user_id !== $userId) {
                abort(403, 'Unauthorized action.');
            }

            // Handle photo upload if a new photo is provided
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('public/photos');
                $photoFilename = basename($photoPath);
                $cardInfo->photo = $photoFilename; // Update the photo only if a new one is uploaded
            }

            // Update the CardInfo
            $cardInfo->update([
                'full_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone'],
                'CIN' => $validatedData['cin'],
                'institution' => $validatedData['institution'],
                'position' => $validatedData['position'],
                'type' => $validatedData['type'],
                // 'photo' => $photoFilename, // This is handled above if a new photo is uploaded
            ]);
            $cardRequest->update([
                'status'=>'pending',
            ]);
        });

        return redirect()->route('user.dashboard')->with('success', 'Your card information has been updated successfully!');
    }
}

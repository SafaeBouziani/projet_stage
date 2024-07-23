<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function destroy(string $id)
    {
        $request = CardRequest::findOrFail($id);
  
        $request->delete();
  
        return redirect()->route('admin.request.index')->with('success', 'request deleted successfully');
    }

    public function approveRequest (string $id)
    {
        $request = CardRequest::findOrFail($id);

        // Change status to approved
        $request->status = 'approved';
        $request->save();

        // Generate PDFs
        $this->generatePDFs($request);

        // Send notification to user
        Notification::send($request->user, new RequestStatusNotification($request));

        return redirect()->route('admin.dashboard')->with('success', 'Request approved and PDFs generated.');
    }

    public function declineRequest (string $id)
    {
        $request = CardRequest::findOrFail($id);

        // Change status to rejected
        $request->status = 'rejected';
        $request->save();

        // Send notification to user
        Notification::send($request->user, new RequestStatusNotification($request));

        return redirect()->route('admin.dashboard')->with('success', 'Request rejected.');
    }

    public function undoDecision(string $id)
    {
        $request = CardRequest::findOrFail($id);

        // Change status to rejected
        $request->status = 'pending';
        $request->save();
        return redirect()->route('admin.dashboard')->with('success', 'Your decision has been undone.');
        
    }
   

    private function generatePDFs(CardRequest $request)
    {
        // Logic to generate PDFs for card and receipt
        $cardInfo = CardInfo::find($request->card_info_id);

        // Generate Card PDF
        $cardFrontPdf = PDF::loadView('pdf.card_front', compact('cardInfo'))->save(storage_path('app/public/cards/card_front_'.$request->id.'.pdf'));

        // Generate Back Side PDF
        $cardBackPdf = PDF::loadView('pdf.card_back', compact('cardInfo'))->save(storage_path('app/public/cards/card_back_'.$request->id.'.pdf'));

        // Generate Receipt PDF
        $receiptPdf = PDF::loadView('pdf.receipt', compact('cardInfo'))->save(storage_path('app/public/receipts/receipt_'.$request->id.'.pdf'));
    }
    
}

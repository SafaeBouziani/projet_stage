<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\CardRequest;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $requests = CardRequest::where('user_id', $user->id)->get();
        return view('dashboard', compact('requests'));
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
  
        return view('admin.users.index', compact('users'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user', // Validate 'role' input
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Encrypt password
        ]);
    
        // Assign role based on input
        if ($validatedData['role'] === 'admin') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }
    
        return redirect()->route('users')->with('success', 'User created successfully!');
    }
    
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
  
        return view('admin.users.show', compact('user'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
  
        return view('admin.users.edit', compact('user'));
    }
  
    /**
     * Update the specified resource in storage.
     */

    
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Optional password update
            'role' => 'required|in:admin,user', // Validate 'role' input
        ]);
    
        // Update user details
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        // Update password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
    
        // Save the updated user
        $user->save();
    
        // Assign role based on input
        if ($validatedData['role'] === 'admin') {
            $user->syncRoles(['admin']); // Replace existing roles with 'admin'
        } else {
            $user->syncRoles(['user']); // Replace existing roles with 'user'
        }
    
        return redirect()->route('users')->with('success', 'User updated successfully');
    }
    
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
  
        $user->delete();
  
        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}

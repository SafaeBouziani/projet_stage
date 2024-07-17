<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        \Log::info('Redirect to Google initiated');
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            \Log::info('Google callback received');
            $googleUser = Socialite::driver('google')->user();
            \Log::info('Google user retrieved', ['user' => $googleUser]);

            // Check if a user already exists with the provided google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // If user exists, log them in
                Auth::login($user);
                \Log::info('User logged in', ['user' => $user]);
                return redirect()->intended('/user/dashboard');
            }

            // Check if a user exists with the email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If user exists with the email, update the google_id
                $user->update([
                    'google_id' => $googleUser->getId()
                ]);
            } else {
                // Create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                ]);
                $user->assignRole('user');
            }

            // Log the user in
            Auth::login($user);
            \Log::info('User logged in', ['user' => $user]);
            return redirect()->intended('/user/dashboard');
        } catch (\Throwable $th) {
            \Log::error('Error in Google callback', ['error' => $th->getMessage()]);
            return redirect('/login')->with('error', 'Something went wrong');
        }
    }
}



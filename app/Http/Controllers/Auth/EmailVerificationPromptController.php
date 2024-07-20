<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            if (Auth::user()->hasRole('admin')) {
                return Redirect::intended(route('admin.dashboard', [], false));
            } else {
                return Redirect::intended(route('user.dashboard', [], false));
            }
        } else {
            return view('auth.verify-email');
        }
    }
}

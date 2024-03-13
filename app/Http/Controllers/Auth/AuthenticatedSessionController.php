<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if(Auth::check()) {

            $request->session()->regenerate();

            if (Auth::user()->status == 1) {
                if (Auth::user()->roles->contains('id', 1)) {
                    return redirect()->route('dashboard');
                } else if (Auth::user()->roles->contains('id', 3)) {
                    return redirect()->route('dashboardorganizer');
                } else {
                    return redirect('/home');
                }
            } else {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['error' => 'Your account is inactive.']);
             }

        }

    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}

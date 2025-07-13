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

        $request->session()->regenerate();

        $role = $request->input('role');

    // Optional: force login to fail if role doesn't match the user
    if ($role === 'admin' && !auth()->user()->hasRole('admin')) {
        Auth::logout();
        return redirect()->back()->withErrors([
            'email' => 'You are not authorized to login as admin.',
        ]);
    }

    if ($role === 'user' && auth()->user()->hasRole('admin')) {
        Auth::logout();
        return redirect()->back()->withErrors([
            'email' => 'Admins must login through the admin login form.',
        ]);
    }

        // return redirect()->intended(RouteServiceProvider::HOME);
        // return redirect('frontend/index');
        //[changing] checking if user or admin by laratrust
        
        if (auth()->user()->hasRole('admin')) {
            return redirect('/admin/categories');
        } else {
            return redirect('/');
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

        //[changing] redirecting to index page
        return redirect('/');
    }
}

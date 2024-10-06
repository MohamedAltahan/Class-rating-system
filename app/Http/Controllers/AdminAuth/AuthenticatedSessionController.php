<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LogoSetting;
use App\Models\User;
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
        $logoSetting = LogoSetting::first();
        return view('admin.auth.login', compact('logoSetting'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $user = User::where('residence_number', $request->residence_number)->first();

        // Check if the user exists and is inactive
        if ($user && $user->status !== 'active') {
            return redirect()->route('home');
        }
        $request->authenticate('admin');

        $request->session()->regenerate();

        if ($request->user()->role === 'admin') {
            return redirect()->route('admin.rating.material.allMaterialRatings');
        }
        if ($request->user()->role === 'student') {
            return redirect()->route('rating.index');
        }
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

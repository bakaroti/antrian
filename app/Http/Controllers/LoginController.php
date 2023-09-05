<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            User::where('id', $user->id)->update(['is_online' => '1']);
            // Check the user's role and redirect accordingly
            if ($user->role == 1) {
                return redirect()->intended('profile');
            } elseif ($user->role == 2) {
                return redirect()->intended('doctor');
            } elseif ($user->role == 3) {
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our dfdfh records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {

        $user = Auth::user();
        User::where('id', $user->id)->update(['is_online' => '0']);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseService; // Assuming you have a service to handle Supabase interactions
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $supabaseService;

    public function __construct(SupabaseService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Ensure this view exists in resources/views/auth/register.blade.php
    }

    /**
     * Handle registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'age' => 'required|integer|min:4|max:100',
            'parent_email' => 'required_if:age,<,13|email',
        ]);

        try {
            $result = $this->supabaseService->signUpUser($request->email, $request->password);

            if (isset($result['error'])) {
                return back()->withErrors(['message' => $result['error']['message']]);
            }

            // Optionally, store user data in the local database
            // User::create([...]);

            // Redirect with success message
            Session::flash('success', 'Registration successful! You can now log in.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred during registration. Please try again.']);
        }
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this view exists in resources/views/auth/login.blade.php
    }

    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $result = $this->supabaseService->signInUser($request->email, $request->password);

            if (isset($result['error'])) {
                return back()->withErrors(['message' => $result['error']['message']]);
            }

            session(['token' => $result['access_token']]);

            Session::flash('success', 'Login successful!');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred during login. Please try again.']);
        }
    }

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->forget('token');
        Session::flash('success', 'You have been logged out.');
        return redirect()->route('login');
    }
}
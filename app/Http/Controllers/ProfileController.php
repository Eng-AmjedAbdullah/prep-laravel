<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    protected $supabaseService;

    public function __construct(SupabaseService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }

    /**
     * Display the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request): View|RedirectResponse
    {
        // Assuming the user ID or token is stored in the session
        $userId = session('user_id');

        if (!$userId) {
            // Redirect to login if user ID is not found in the session
            return redirect()->route('login')->withErrors(['message' => 'User not authenticated.']);
        }

        // Fetch the user profile from Supabase
        $userData = $this->supabaseService->getUserProfile($userId);

        // Handle errors if any
        if (isset($userData['error'])) {
            return redirect()->route('login')->withErrors(['message' => $userData['error']['message']]);
        }

        // Pass the user data to the view
        return view('profile.show', ['user' => $userData[0]]);
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request): View|RedirectResponse
    {
        $userId = session('user_id');

        if (!$userId) {
            // Redirect to login if user ID is not found in the session
            return redirect()->route('login')->withErrors(['message' => 'User not authenticated.']);
        }

        // Fetch the user profile from Supabase
        $userData = $this->supabaseService->getUserProfile($userId);

        // Handle errors if any
        if (isset($userData['error'])) {
            return redirect()->route('login')->withErrors(['message' => $userData['error']['message']]);
        }

        // Pass the user data to the edit view
        return view('profile.edit', ['user' => $userData[0]]);
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email',
            'location' => 'nullable|string|max:100',
        ]);

        $userId = session('user_id');
        $updatedData = $request->only(['username', 'email', 'location']);

        // Update the user profile in Supabase
        $result = $this->supabaseService->updateUserProfile($userId, $updatedData);

        // Handle errors if any
        if (isset($result['error'])) {
            return back()->withErrors(['message' => $result['error']['message']]);
        }

        // Redirect to the profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
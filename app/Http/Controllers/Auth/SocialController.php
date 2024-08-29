<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SocialController extends Controller
{
    protected $supabaseService;

    public function __construct(SupabaseService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }

    /**
     * Redirect the user to the social provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        // Check if the provider is supported
        if (!in_array($provider, ['facebook', 'google', 'apple'])) {
            return Redirect::route('login')->withErrors(['message' => 'Unsupported provider']);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the social provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return Redirect::route('login')->withErrors(['message' => 'Failed to login using ' . ucfirst($provider) . '. Please try again.']);
        }

        // Check if the user already exists in Supabase
        $existingUser = $this->supabaseService->getUserByEmail($socialUser->getEmail());

        if (!$existingUser) {
            // If the user does not exist, create a new user in Supabase
            $password = Hash::make('random_password'); // Generate a random password or handle password creation differently
            $result = $this->supabaseService->signUpUser($socialUser->getEmail(), $password);

            if (isset($result['error'])) {
                return Redirect::route('login')->withErrors(['message' => $result['error']['message']]);
            }

            // Retrieve the newly created user profile
            $existingUser = $this->supabaseService->getUserByEmail($socialUser->getEmail());
        }

        if (!$existingUser) {
            return Redirect::route('login')->withErrors(['message' => 'Unable to retrieve user information.']);
        }

        // Log the user in by storing session information or token
        session(['user' => $existingUser]);

        // Redirect to home or intended page
        return redirect()->intended('/home');
    }
}
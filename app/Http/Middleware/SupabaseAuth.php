<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SupabaseService;

class SupabaseAuth
{
    protected $supabaseService;

    public function __construct(SupabaseService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the Supabase token exists in the session
        if (!$request->session()->has('supabase_token')) {
            return redirect()->route('login')->withErrors(['message' => 'You must be logged in.']);
        }

        $token = $request->session()->get('supabase_token');

        // Validate the token using the Supabase service
        $user = $this->supabaseService->getUserProfile($token);

        if (isset($user['error'])) {
            return redirect()->route('login')->withErrors(['message' => 'Invalid or expired token. Please log in again.']);
        }

        // Store user details in request (you can store the user object for easy access)
        $request->merge(['supabase_user' => $user]);

        return $next($request);
    }
}
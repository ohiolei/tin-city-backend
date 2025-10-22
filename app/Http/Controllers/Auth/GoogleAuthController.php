<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Controller for handling Google OAuth authentication
 *
 * This controller provides methods for redirecting users to Google for authentication
 * and handling the callback to create or authenticate users in the system.
 */
class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google for authentication
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        try {
            $redirect = Socialite::driver('google')->stateless()->redirect();

            return $redirect;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Handle Google authentication callback and create or update user
     *
     * This method handles the callback from Google OAuth, either creating a new user
     * or updating an existing user with their Google ID. It also creates an API token
     * for authentication.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            // Check if user already exists
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // User exists, update their Google ID if not set
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                ]);
            }

            // Create token for API authentication
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Google authentication successful',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Google authentication failed',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 400);
        }
    }
}

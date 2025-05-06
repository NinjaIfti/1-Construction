<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle provider callback and authenticate the user.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Find existing user or create new one
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // Random password
                    'email_verified_at' => now(), // Already verified through provider
                    'role' => 'contractor', // Default role
                ]);
            }
            
            // Add or update provider ID
            $providerField = "{$provider}_id";
            if (!$user->$providerField) {
                $user->$providerField = $socialUser->getId();
                $user->save();
            }
            
            // Log in the user
            Auth::login($user);
            
            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'There was an error authenticating with ' . ucfirst($provider) . ': ' . $e->getMessage());
        }
    }
} 
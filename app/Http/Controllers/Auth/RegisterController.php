<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Handle contractor registration from the GetStarted form
     */
    public function register(Request $request)
    {
        // Validate the form input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string',
            'company_size' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'project_types' => 'nullable|array',
            'services' => 'nullable|array',
            'project_volume' => 'nullable|string',
            'hear_about' => 'nullable|string',
            'terms' => 'required|accepted',
        ]);

        // Create the user with contractor role
        $user = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'contractor',
            'company_name' => $request->company_name,
            'phone_number' => $request->phone,
            'company_type' => $request->company_type,
            'company_size' => $request->company_size,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'project_types' => $request->project_types ? json_encode($request->project_types) : null,
            'services' => $request->services ? json_encode($request->services) : null,
            'project_volume' => $request->project_volume,
            'hear_about' => $request->hear_about,
        ]);

        // Log in the newly created user
        Auth::login($user);

        // Redirect to the client dashboard
        return redirect()->route('client.dashboard');
    }
} 
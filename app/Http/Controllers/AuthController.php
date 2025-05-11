<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Method to login and return the token
    public function login(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Find the user by email
        $user = User::where('email', $validated['email'])->first();

        // Check if the user exists and the password matches
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate a new API token for the authenticated user
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Return the token in the response
        return response()->json([
            'token' => $token,
        ]);
    }
}

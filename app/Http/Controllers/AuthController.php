<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Function to handle user registration
    public function register(Request $request)
    {
        // Validate incoming request (email, password, and confirm password)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Confirmed ensures password and password_confirmation match
            'name' => 'required|string|max:255', // Validate name
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create a new user instance
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'name' => $request->name, // Add the name field
        ]);

        // Generate an API token for the newly registered user
        $token = $user->createToken('TuneTix')->plainTextToken;

        // Return the user's token in the response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201); // Status 201 for resource creation
    }

    // Function to handle login and generate token
    public function login(Request $request)
    {
        // Validate incoming request (email and password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and if the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Create a new token for the user
            $token = $user->createToken('TuneTix')->plainTextToken;

            // Log the successful login attempt
            Log::info('User login attempt', ['email' => $request->email, 'status' => 'success']);

            // Return the token to the user
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        // Log the failed login attempt
        Log::warning('Failed login attempt', ['email' => $request->email]);

        // If authentication fails, return unauthorized error
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    //Function to handle logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * User Registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|unique:users',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bio' => $request->bio,
            'phone' => $request->phone,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * User Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * User Logout
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Get Authenticated User
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Update User
     */
    public function updateProfile(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // optional image upload validation
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Update user profile information
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Check if there's a new profile picture to upload
        if ($request->hasFile('profile_picture')) {
            // Store the new profile picture and get the file path
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Save the updated user information
        $user->save();

        // Return a response indicating the profile has been updated
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    public function profile(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Return the user profile details as a response
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    
}

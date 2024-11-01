<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    // Registration method
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;


        // Return success response
        return response()->json(['message' => 'User registered successfully', 'token' => $token], 201);
    }

    // Login method
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Create a new token for the user
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        // Return success response with token
        return response()->json(['message' => 'Login successful', 'token' => $token], 200);
    }
}

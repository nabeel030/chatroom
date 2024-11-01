<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatroomController extends Controller
{
    // Create a new chatroom
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_members' => 'required'
        ]);

        $chatroom = Chatroom::create([
            'name' => $request->name,
            'max_members' => $request->max_members
        ]);

        return response()->json($chatroom, 201);
    }

    // List all chatrooms
    public function index()
    {
        $chatrooms = Chatroom::all();
        return response()->json($chatrooms);
    }

    // Enter a chatroom
    public function enter($id)
    {
        $chatroom = Chatroom::find($id);
        
        if (!$chatroom) {
            return response()->json(['error' => 'Chatroom not found'], 404);
        }

        // Check if the user is already in the chatroom
        if ($chatroom->users()->where('users.id', Auth::id())->exists()) {
            return response()->json(['message' => 'You are already in this chatroom.'], 200);
        }

        // Check if the maximum number of members has been reached
        if ($chatroom->users()->count() >= $chatroom->max_members) {
            return response()->json(['error' => 'Chatroom is full'], 403);
        }

        // Add the user to the chatroom
        $chatroom->users()->attach(Auth::id());

        return response()->json(['message' => 'You have entered the chatroom successfully.'], 200);
    }

    // Leave a chatroom
    public function leave($id)
    {
        $chatroom = Chatroom::find($id);

        if (!$chatroom) {
            return response()->json(['error' => 'Chatroom not found'], 404);
        }

        // Check if the user is in the chatroom
        if (!$chatroom->users()->where('users.id', 1)->exists()) {
            return response()->json(['message' => 'You are not in this chatroom.'], 200);
        }

        // Remove the user from the chatroom
        $chatroom->users()->detach(Auth::id());

        return response()->json(['message' => 'You have left the chatroom successfully.'], 200);
    }
}

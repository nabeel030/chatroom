<?php

// In app/Http/Middleware/CheckUserInChatroom.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Chatroom;
use Illuminate\Support\Facades\Auth;

class CheckUserInChatroom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $chatroomId
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $chatroomId = $request->route('id');

        // Find the chatroom by ID
        $chatroom = Chatroom::find($chatroomId);

        if (!$chatroom) {
            return response()->json(['error' => 'Chatroom not found'], 404);
        }

        // Check if the user is part of the chatroom
        if (!$chatroom->users()->where('users.id', Auth::id())->exists()) {
            return response()->json(['error' => 'Join chatroom ' . $chatroom->name . '" to make activity!'], 403);
        }

        return $next($request);
    }
}

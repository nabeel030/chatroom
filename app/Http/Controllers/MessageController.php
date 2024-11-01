<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\Message;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Send a message to a chatroom
    public function send(SendMessageRequest $request, $id)
    {
        $chatroom = Chatroom::find($id);

        if (!$chatroom) {
            return response()->json(['error' => 'Chatroom not found'], 404);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('attachments'); 
        }

        // Create the message
        $message = Message::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => Auth::id(),
            'message_text' => $request->input('message'),
            'attachment_path' => $attachmentPath,
        ]);

        // Optionally, broadcast the message to the WebSocket server here

        return response()->json(['message' => 'Message sent successfully.', 'data' => $message], 201);

    }

    // List messages in a chatroom
    public function list($id)
    {
        $messages = Message::where('chatroom_id', $id)->get();
        return response()->json($messages);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\Message;
use App\Events\SendMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendMessageRequest;

class MessageController extends Controller
{
    public function send(SendMessageRequest $request, $id)
    {
        $chatroom = Chatroom::find($id);

        if (!$chatroom) {
            return response()->json(['error' => 'Chatroom not found'], 404);
        }

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $mimeType = $attachment->getMimeType();
        
            if (str_contains($mimeType, 'video')) {
                $directory = 'video';
            } elseif (str_contains($mimeType, 'image')) {
                $directory = 'picture';
            } else {
                $directory = 'attachments/other'; 
            }
        
            $attachmentPath = $attachment->store($directory, 'public');
        }

        $message = Message::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => Auth::id(),
            'message_text' => $request->input('message'),
            'attachment_path' => $attachmentPath
        ]);

        SendMessage::broadcast(
            Auth::user(),
            $chatroom->id,
            $request->input('message') ?? $attachmentPath
        );

        return response()->json(['message' => 'Message sent successfully.', 'data' => $message], 201);

    }

    public function list($id)
    {
        $messages = Message::where('chatroom_id', $id)->get();  
        return response()->json($messages);
    }
}

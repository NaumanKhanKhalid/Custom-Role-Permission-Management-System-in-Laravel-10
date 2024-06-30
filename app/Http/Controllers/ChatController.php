<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $guestId = $request->guest_id;
        $messages = ChatMessage::where('guest_id', $guestId)->orderBy('created_at')->get();
        return response()->json(['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'guest_id' => 'required|string|max:255',
        ]);

        $message = new ChatMessage();
        $message->guest_id = $request->guest_id;
        $message->message = $request->message;
        $message->message_type = 'received'; // Admin's messages are marked as received
        $message->save();

        return response()->json(['message' => 'Message sent successfully', 'message_data' => $message], 200);
    }

    public function adminIndex()
    {
        $messages = ChatMessage::orderBy('created_at')->get();
        return view('modules.chats.index', ['messages' => $messages]);
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'guest_id' => 'required|string|max:255',
        ]);

        $message = new ChatMessage();
        $message->guest_id = $request->guest_id;
        $message->message = $request->message;
        $message->message_type = 'sent'; // Admin's messages are marked as sent
        $message->save();

        return response()->json(['message' => 'Message sent successfully', 'message_data' => $message], 200);
    }
}

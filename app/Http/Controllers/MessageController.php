<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $messages = Message::where('conversation_id', $request->query('conversation_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($messages, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'conversation_id' => $request->get('conversation_id'),
            'sender_id' => auth()->id(),
            'message' => $request->get('message')
        ]);

        return response()->json($message, 201);
    }
}

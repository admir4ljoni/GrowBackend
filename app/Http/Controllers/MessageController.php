<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $message = Messages::create([
            'conversation_id' => $request->input('conversation_id'),
            'sender_id' => auth()->id(),
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message, 201);
    }
}

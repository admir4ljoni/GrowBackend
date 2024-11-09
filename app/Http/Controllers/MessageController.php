<?php

    namespace App\Http\Controllers;

    use App\Events\MessageSent;
    use App\Models\Message;
    use Illuminate\Http\Request;

    class MessageController extends Controller
    {
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

            broadcast(new MessageSent($message))->toOthers();

            return response()->json($message, 201);
        }

        public function index(Request $request)
        {
            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
            ]);

            $messages = Message::where('conversation_id', $request->query('conversation_id'))
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($messages, 200);
        }
    }

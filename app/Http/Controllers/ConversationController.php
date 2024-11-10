<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'receiverId' => 'required|exists:users,id',
            'senderId' => 'required|exists:users,id'
        ]);

        $receiverId = $request->query('receiverId');
        $senderId = $request->query('senderId');

        $conversation = Conversation::where(function ($query) use ($receiverId, $senderId) {
            $query->where('user_one_id', $receiverId)
                ->where('user_two_id', $senderId);
        })->orWhere(function ($query) use ($receiverId, $senderId) {
            $query->where('user_one_id', $senderId)
                ->where('user_two_id', $receiverId);
        })->first();


        if (!$conversation) {
            return response()->json(['status' => 'Has not yet created']);
        }
        return response()->json([
            'status' => 'exists',
            'data' => $conversation
        ]);
    }

    public function getConversations(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $request->query('user_id');

        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->get();

        return response()->json([
            'status' => 'exists',
            'data' => $conversations
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'user_one_id' => 'required|exists:users,id',
            'user_two_id' => 'required|exists:users,id'
        ]);

        $existingConversation = Conversation::where(function ($query) use ($request) {
            $query->where('user_one_id', $request->user_one_id)
                ->where('user_two_id', $request->user_two_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('user_one_id', $request->user_two_id)
                ->where('user_two_id', $request->user_one_id);
        })->first();

        if ($existingConversation) {
            return response()->json([
                'status'=> 'exist',
                'data' => $existingConversation
            ]);
        }

        $conversation = Conversation::create([
            'user_one_id' => $request->user_one_id,
            'user_two_id' => $request->user_two_id,
        ]);

        return response()->json([
            'status' => 'new',
            'data' => $conversation
        ], 201);
    }
}

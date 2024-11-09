<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'investor_id' => 'required|exists:users,id',
            'owner_id' => 'required|exists:users,id'
        ]);

        $investorId = $request->query('investor_id');
        $ownerId = $request->query('owner_id');

        $conversation = Conversation::where(function ($query) use ($investorId, $ownerId) {
            $query->where('user_one_id', $investorId)
                ->where('user_two_id', $ownerId);
        })->orWhere(function ($query) use ($investorId, $ownerId) {
            $query->where('user_one_id', $ownerId)
                ->where('user_two_id', $investorId);
        })->first();

        return response()->json([
            'status' => 'created',
            'data' => $conversation
        ]);
    }

    public function create(Request $request) {
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

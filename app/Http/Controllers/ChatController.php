<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Resources\Chat as ChatResource;
use App\Http\Resources\ChatCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $this->authorize('ViewAny',Chat::class);
        $user = Auth::user();
        $chats = $user->chat1->merge($user->chat2);
        return new ChatCollection($chats);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Chat $chat)
    {
        //$id = $user->id;
        //$chat_us = User::find($id)->chats2()->user_id1;
        //$this->authorize('view',$chat);
        //$chat = $user->chat2()->where('id1',$chat->id)->firstOrFail();
        //return response()->json($chat, 201);
        //return response()->json(new ChatResource($chat), 200);
    }
    public function store(Request $request, Chat $chat)
    {
        $this->authorize('create',$chat);

        $chat = Chat::create($request->all());
        return response()->json($chat,201);
    }
    public function update(Request $request, Chat $chat)
    {
        $this->authorize('update',$chat);

        $chat->update($request->all());
        return response()->json($chat,200);
    }
    public function delete(Request $request, Chat $chat)
    {
        $this->authorize('delete',$chat);

        $chat->delete();
        return response()->json(null,204);
    }
}

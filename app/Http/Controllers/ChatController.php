<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Resources\Chat as ChatResource;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $this->authorize('ViewAny',Chat::class);
        return Chat::all();
    }
    public function show(Chat $chat)
    {
        $this->authorize('view',$chat);

        return response()->json(new ChatResource($chat), 200);
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

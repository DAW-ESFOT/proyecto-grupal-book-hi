<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Resources\Message as MessageResource;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $this->authorize('ViewAny',Message::class);
        return Message::all();
    }
    public function show(Message $message)
    {
        $this->authorize('View',$message);

        return response()->json(new MessageResource($message), 200);
    }
    public function store(Request $request, Message $message)
    {
        $this->authorize('create',$message);

        $message = Message::create($request->all());
        return response()->json($message,201);
    }
    public function update(Request $request, Message $message)
    {
        $this->authorize('update',$message);

        $message->update($request->all());
        return response()->json($message, 200);
    }
    public function delete(Request $request, Message $message)
    {
        $this->authorize('delte',$message);

        $message->delete();
        return response()->json(null,204);
    }
}

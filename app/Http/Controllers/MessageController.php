<?php

namespace App\Http\Controllers;

use App\Events\StoreMessageEvent;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {

        $messages = Message::all();

        return Inertia::render('Message/Index', [
            'messages' => MessageResource::collection($messages)
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $message = Message::create($data);
        broadcast(new StoreMessageEvent($message))->toOthers();

        return MessageResource::make($message);
    }
}

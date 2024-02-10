<?php

namespace App\Http\Controllers\Client;

use App\Events\StoreMessageEvent;
use App\Http\Controllers\Controller;
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

        return Inertia::render('Client/Message/Index', [
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

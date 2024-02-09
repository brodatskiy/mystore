<?php

namespace App\Http\Controllers\Admin;

use App\Events\StoreMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;

use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();

        return Inertia::render('Admin/Chat/Index', [
            'messages' => MessageResource::collection($messages)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $message = Message::create($data);
        broadcast(new StoreMessageEvent($message))->toOthers();

        return MessageResource::make($message);
    }
}

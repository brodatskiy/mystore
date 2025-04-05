<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->order()->get();

        return Inertia::render('Client/Order/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }
}

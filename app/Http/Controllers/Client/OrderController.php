<?php

namespace App\Http\Controllers\Client;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->orderByDesc('updated_at')->get();

        return Inertia::render('Client/Order/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return back();
    }

    /**
     * @throws Exception
     */
    public function pay(Order $order)
    {
        $order->updateStatus(OrderStatus::Paid);

        return back();
    }
}

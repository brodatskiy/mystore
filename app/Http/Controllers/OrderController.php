<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Resources\Order\OrderResource;
use App\Jobs\TestJob;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        TestJob::dispatch();
        $user = auth()->user();
        $orders = $user->orders()->orderByDesc('updated_at')->get();

        return Inertia::render('Order/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }

    public function show(Order $order)
    {
        return Inertia::render('Order/Show', [
            'order' => OrderResource::make($order),
        ]);
    }

    public function destroy(Order $order): RedirectResponse
    {
        $orderItems = $order->orderItems()->get();

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product;

            $product->count += $orderItem->quantity;
            $product->save();
        }

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

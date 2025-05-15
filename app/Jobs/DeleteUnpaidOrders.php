<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Date;

class DeleteUnpaidOrders implements ShouldQueue
{
    use Queueable;
    const int ALIVE_TIME_OF_UNPAID_ORDER = 15;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders = Order::where('status', '=', OrderStatus::Unpaid)->get();

        foreach ($orders as $order) {
            if ($order->updated_at->diffInMinutes(Date::now()) > self::ALIVE_TIME_OF_UNPAID_ORDER) {
                $order->delete();
            }
        }
    }
}

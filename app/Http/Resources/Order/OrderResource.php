<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id" => $this->id,
            "total" => $this->total,
            "status" => $this->status,
//            'order_id' => $this->order_id,
            'product' => new ProductResource($this->orderItems()->get()),
//            'quantity' => $this->quantity,
//            'price' => $this->price,
        ];
    }
}

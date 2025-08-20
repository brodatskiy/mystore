<?php

namespace App\Enums;

enum OrderStatus: string
{
    use EnumToArray;

    case Unpaid = "Unpaid";
    case Paid = "Paid";
    case Cancelled = "Cancelled";
    case Shipped = "Shipped";
    case Delivered = "Delivered";

    public function isValidTransition(OrderStatus $newState): bool
    {
        $transitions = [
            OrderStatus::Unpaid->value => [
                OrderStatus::Paid,
                OrderStatus::Cancelled,
            ], OrderStatus::Paid->value => [
                OrderStatus::Shipped,
            ], OrderStatus::Shipped->value => [
                OrderStatus::Delivered,
            ]
        ];

        return in_array($newState, $transitions[$this->value]);
    }
}



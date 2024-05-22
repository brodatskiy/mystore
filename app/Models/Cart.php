<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Cart extends Pivot
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'carts';
    protected $guarded = false;

    /**
     * @param ?string $instance
     */
    public static function getContent($instance = null)
    {

        return auth()->user()->cart()->get();
    }

    /**
     * @param int $id
     */
    public static function getCartTotal($products)
    {
        $total = "0.00";

        foreach ($products as $item) {
            $total += $item->price * $item->pivot->quantity;
        }

        return number_format($total, 2);
    }

    // public static function empty()
    // {
    //     $ids = Cart::getContent();

    //     auth()->user()->cart()
    //         ->detach($ids->pluck('id'));
    // }
}

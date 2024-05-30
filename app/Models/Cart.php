<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class Cart extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'carts';

    protected $fillable = [
        'storage_id',
        'user_id'
    ];

    public static function get()
    {
        return Cart::query()
            ->where('storage_id', session()->getId())
            ->first();
    }

    public static function add(Product $product)
    {
        $cart = Cart::query()
            ->updateOrCreate(
                [
                    'storage_id' => session()->getId()
                ],
                [
                    'user_id' => auth()->id()
                ]
            );

        $cartItem = $cart->cartItems()->updateOrCreate([
            'product_id' => $product->getKey()
        ], [
            'price' => $product->price,
        ]);
        $cartItem->increment('quantity');
        $cartItem->save();
    }

    public static function increase(Product $product): void
    {
        $cartItem = self::get()->cartItems()->firstWhere('product_id', $product->id);
        $cartItem->increment('quantity');
    }

    public static function decrease(Product $product): void
    {
        $cartItem = self::get()->cartItems()->firstWhere('product_id', $product->id);
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
    }

    public static function getItems()
    {
        return self::get()?->cartItems()->orderBy('id')->get() ?? collect([]);
    }


    public static function getCount(): int
    {
        return self::get()->sum(function ($item) {
            return $item->quantity;
        });
    }

    public static function getTotal()
    {
        $total = self::getItems()->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return $total;
    }

    public static function destoyItem(Product $product): void
    {
        $cartItem = self::get()->cartItems()->firstWhere('product_id', $product->id);
        $cartItem->delete();
    }

    public static function empty(): void
    {
        self::get()?->delete();
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}

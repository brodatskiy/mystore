<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


/**
 *
 *
 * @property int $id
 * @property string $storage_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CartItem> $cartItems
 * @property-read int|null $cart_items_count
 * @property-read \App\Models\User|null $user
 * @method static Builder<static>|Cart defaultSort(string $column, string $direction = 'asc')
 * @method static Builder<static>|Cart filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static Builder<static>|Cart filtersApply(iterable $filters = [])
 * @method static Builder<static>|Cart filtersApplySelection($class)
 * @method static Builder<static>|Cart newModelQuery()
 * @method static Builder<static>|Cart newQuery()
 * @method static Builder<static>|Cart query()
 * @method static Builder<static>|Cart whereCreatedAt($value)
 * @method static Builder<static>|Cart whereId($value)
 * @method static Builder<static>|Cart whereStorageId($value)
 * @method static Builder<static>|Cart whereUpdatedAt($value)
 * @method static Builder<static>|Cart whereUserId($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    use AsSource, Filterable, Attachable;

    protected $table = 'carts';

    protected $fillable = [
        'storage_id',
        'user_id'
    ];

    public static function get()
    {
        return Cart::query()
            ->when(auth()->check(), fn(Builder $q) => $q->where('user_id', auth()->id()))
            ->orWhere('storage_id', session()->getId())
            ->first();
    }

    public static function add(Product $product): void
    {
        $cart = Cart::updateOrCreate(
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
        return self::getItems()->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    public static function destroyItem(Product $product): void
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
        return $this->belongsTo(User::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}

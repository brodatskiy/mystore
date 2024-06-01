<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Wish extends Pivot
{
    use HasFactory;

    protected $table = 'wish';
    protected $guarded = [];


    // public static function getContent(): Collection
    // {
    //     return auth()->user()->whishlist;
    // }

    // public static function moveToCart(Product $product): void
    // {
    //     auth()->user()->cart()->attach($product->id, ['quantity' => 1]);
    //     auth()->user()->whishlist()->detach($product->id);
    // }

    // public static function empty(): void
    // {
    //     auth()->user()->whishlist()->detach();
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $with = ['product'];

    protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'quantity',
        'string_option_values'
    ];

    public function total()
    {
        $total = $this->price * $this->quantity;

        return number_format($total, 2);
    }

    public function cart(): BelongsTo
    {
        return  $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return  $this->belongsTo(Product::class);
    }
}

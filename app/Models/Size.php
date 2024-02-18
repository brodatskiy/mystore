<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    protected $guarded = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag', 'size_id', 'post_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $guarded = false;
    protected $with = ['group', 'category', 'tags', 'sizes', 'sticker'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sticker()
    {
        return $this->belongsTo(Sticker::class, 'sticker_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id')->withPivot('count');
    }

    public function getImageUrlAttribute()
    {
        return $this->preview_image ? url('storage/' . $this->preview_image) : '';
    }
}

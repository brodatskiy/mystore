<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;
    use HasSlug;
    use AsSource, Filterable, Attachable;

    protected $table = 'products';
    protected $guarded = false;
    protected $with = ['group', 'category', 'sticker', 'tags'];

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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function usersWish()
    {
        return $this->belongsToMany(User::class, 'wish', 'product_id', 'user_id');
    }

    public function scopeSorted(Builder $query)
    {
        $sortBy = request('sort');

        $query->when($sortBy, function (Builder $q, $sortBy) {
            if ($sortBy == 'price') {
                $q->orderBy('price', 'ASC');
            } elseif ($sortBy == '-price') {
                $q->orderBy('price', 'DESC');
            }
        });
    }

    //Orchid
    protected $allowedSorts = [
        'id',
        'title',
        'price',
        'is_published',
        'updated_at',
        'created_at',
    ];

    protected $allowedFilters = [
        'title' => Like::class,
    ];
}

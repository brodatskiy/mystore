<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $with = ['category', 'sticker', 'tags'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sticker(): BelongsTo
    {
        return $this->belongsTo(Sticker::class, 'sticker_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function wishedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wish', 'product_id', 'user_id')->withTimestamps();
    }

    public function scopeSorted(Builder $query): void
    {
        $sortBy = request('sort');

        $query->when($sortBy, function (Builder $query, $sortBy) {
            if ($sortBy == 'price') {
                $query->orderBy('price', 'ASC');
            } elseif ($sortBy == '-price') {
                $query->orderBy('price', 'DESC');
            }
        }, function (Builder $query) {
            $query->orderBy('price', 'ASC');
        }

        );
    }

    //Orchid
    protected array $allowedSorts = [
        'id',
        'title',
        'price',
        'is_published',
        'updated_at',
        'created_at',
    ];

    protected array $allowedFilters = [
        'title' => Like::class,
    ];
}

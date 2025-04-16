<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read Collection<int, \App\Models\Category> $parentCategories
 * @property-read int|null $parent_categories_count
 * @property-read Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\SectionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Section extends Model
{
    use HasFactory;
    use HasSlug;
    use AsSource, Filterable, Attachable;

    protected $guarded = false;

    public function products(): HasManyThrough
    {
         return $this->hasManyThrough(Product::class, Category::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'section_id', 'id');
    }
    public function parentCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'section_id', 'id')
            ->whereNull('parent_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}

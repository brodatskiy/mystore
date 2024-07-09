<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Section extends Model
{
    use HasFactory;
    use HasSlug;
    use AsSource, Filterable, Attachable;

    protected $guarded = false;

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

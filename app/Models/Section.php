<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Section extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = false;

    public function categories()
    {
        return $this->hasMany(Category::class, 'section_id', 'id');
    }

    public function parentCategories()
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

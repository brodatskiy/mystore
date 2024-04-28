<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Sticker extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AsSource;

    protected $table = 'stickers';
    protected $guarded = false;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sticker_id', 'id');
    }
}

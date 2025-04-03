<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGroup query()
 * @mixin \Eloquent
 */
class ProductGroup extends Model
{
    use HasFactory;
    use AsSource;
}

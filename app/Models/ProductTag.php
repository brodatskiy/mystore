<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ProductTag extends Model
{
    use HasFactory;
    use AsSource;

    protected $table = 'product_tag';
    protected $guarded = false;
}

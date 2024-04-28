<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ProductSize extends Model
{
    use HasFactory;
    use AsSource;

    protected $table = 'product_size';
    protected $guarded = false;
}

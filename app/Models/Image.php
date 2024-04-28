<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Image extends Model
{
    use AsSource;

    protected $table = 'images';
    protected $guarded = false;

    public function imageable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AsSource;

    protected $table = 'groups';
    protected $guarded = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'group_id', 'id');
    }
}

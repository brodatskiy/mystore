<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'messages';
    protected $guarded = false;

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }
}

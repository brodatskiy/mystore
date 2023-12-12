<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_GUEST = 0;
    const ROLE_ADMIN = 1;

    public function getRoleTitleAttribute()
    {
        $roles = [
            0 => 'User',
            1 => 'Admin',
        ];

        return $roles[$this->role];
    }

    public function getGenderTitleAttribute()
    {
        $genders = [
            1 => 'Male',
            2 => 'Female',
        ];
        return $genders[$this->gender] ?? '';
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? url('storage/' . $this->avatar) : '';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

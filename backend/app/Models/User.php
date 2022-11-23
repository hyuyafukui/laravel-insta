<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    public function follows() //the people I (logged-in user/user object) am following
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        //$user->isFollowed()
        //$this->followers => gets all followers of $user
        //where() => within all follower, getall where follower_id = logged-in user
        //exists() => return true if logged=in user is in followers
    }
}

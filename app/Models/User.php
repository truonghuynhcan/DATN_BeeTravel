<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'gender',
        'phone',
        'address',
        'image_url',
        'noti_email',
        'noti_sms',
        'is_block',
        'last_login_at',
        'deletion_requested_at',
        'token',
        'google_id',
        'facebook_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'noti_email' => 'boolean',
        'noti_sms' => 'boolean',
        'is_block' => 'boolean',
        'last_login_at' => 'datetime',
        'deletion_requested_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}

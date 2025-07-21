<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\UserTest; // 💡 TAMBAHKAN INI: Import model UserTest

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
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
        'password' => 'hashed',
    ];

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }

    public function routeNotificationForMail()
    {
        return $this->biodata->email ?? null;
    }

    /**
     * Get the user tests associated with the user.
     * 💡 TAMBAHKAN FUNGSI INI: Relasi ke UserTest
     */
    public function userTests()
    {
        return $this->hasMany(UserTest::class);
    }
}
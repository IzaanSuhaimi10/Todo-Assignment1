<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

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
        'email',
        'password',
        'salt',
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

    public function generateTwoFactorCode()
{
    $this->two_factor_code = rand(100000, 999999);
    $this->two_factor_expires_at = Carbon::now()->addMinutes(10);
    $this->save();
}

public function resetTwoFactorCode()
{
    $this->two_factor_code = null;
    $this->two_factor_expires_at = null;
    $this->save();
}

public function role()
{
    return $this->hasOne(UserRole::class, 'user_id', 'id');
}


}

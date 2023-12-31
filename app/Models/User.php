<?php

namespace App\Models;

use Filament\Panel;

use App\Models\Card;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use softDeletes;


   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'card_id', 'card_amount', 'wallet_id', 'wallet_amount', 'recaptcha_token','email_verified_at','email_activate'];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret','email_verified_at','email_activate'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'email_activate' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_photo_url'];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole([1, 2]);
    }

    public function jeep()
    {
        return $this->hasOne(Jeep::class, 'driver');
    }

    public function getEmailVerifiedAttribute()
    {
        // If email_verified_at is not null and not false, return true, else return false
        return !is_null($this->attributes['email_verified_at']) && $this->attributes['email_verified_at'] !== false;
    }
}

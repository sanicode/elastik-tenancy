<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if($this->profile_photo_path == ''){
            return $this->defaultProfilePhotoUrl();
        } else {
            if(tenant('id') != ''){
                return asset($this->profile_photo_path);
            } else {
                return asset('storage/'.$this->profile_photo_path);
            }
        }
    }
    
    /**
     * @return string
     */
    public function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/'. implode('/', [
            //IMPORTANT: Do not change this order
            urlencode($this->name), // name
            200, // image size
            'EBF4FF', // background color
            '7F9CF5', // font color
        ]);
    }
}
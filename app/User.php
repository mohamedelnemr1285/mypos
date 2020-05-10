<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'last_name', 'email', 'password', 'image'
    ];

    protected $appends = ['image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
{
    return Str::ucfirst($this->username . ' ' . $this->last_name);
}

public function getUserNameAttribute($value)
{
    return Str::ucfirst($value);
}

public function getLastNameAttribute($value)
{
    return Str::ucfirst($value);
}

public function getImagePathAttribute()
{
    return asset('public/uploads/users/' . $this->image);
}
}

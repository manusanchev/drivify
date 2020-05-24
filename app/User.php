<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function achievement()
    {
      return $this->hasOne(Achievement::class);
    }
    public function spotify(){
        return $this->hasOne(Spotify::class);
    }
    public function travels(){
        return $this->belongsToMany(Travel::class)->withPivot('ready'); ;
    }
    public function awards(){
        return $this->belongsToMany(Award::class) ;
    }
}

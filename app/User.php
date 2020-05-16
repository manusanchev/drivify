<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function achievement()
    {
      return $this->hasOne(Achievement::class);
    }
    public function spotify(){
        return $this->hasOne(Spotify::class);
    }
    public function travels(){
        return $this->belongsToMany(Travel::class);
    }
    public function awards(){
        return $this->belongsToMany(Award::class);
    }
}

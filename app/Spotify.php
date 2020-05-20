<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spotify extends Model
{
    protected $fillable = [
        'access_token','user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}

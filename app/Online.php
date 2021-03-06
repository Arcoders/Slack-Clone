<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{

    protected $table = 'online';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public function online()
    {
        return $this->hasOne(Online::class, 'room_id');
    }

}

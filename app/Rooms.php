<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    protected $table = "rooms";

    public function messages()
    {
        return $this->hasMany(Messages::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function online()
    {
        return $this->hasMany(Messages::class, 'room_id');
    }

}

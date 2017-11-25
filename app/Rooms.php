<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    public function messages()
    {
        return $this->hasMany(Messages::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
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
        return $this->hasOne(Online::class, 'private_id');
    }
}
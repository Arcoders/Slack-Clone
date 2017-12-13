<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePrivate extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function privateChat()
    {
        return $this->belongsTo(PrivateChat::class, 'private_id');
    }

    public function onlinePrivate()
    {
        return $this->hasOne(OnlinePrivate::class, 'private_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

}

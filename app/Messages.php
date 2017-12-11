<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{

    protected $table = "messages";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public function privateChat()
    {
        return $this->belongsTo(PrivateChat::class, 'private_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    public function messages()
    {
        return $this->hasMany(Messages::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

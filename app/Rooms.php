<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    public function messages()
    {
        return $this->hasMany(Messages::class);
    }

}

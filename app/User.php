<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "users";

    public function messages()
    {
        return $this->hasMany(Messages::class, 'user_id');
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class, 'user_id');
    }

    public function privateChats()
    {
        return $this->hasMany(PrivateChat::class, 'user_id');
    }

    public function online()
    {
        return $this->hasOne(Online::class, 'user_id');
    }

}

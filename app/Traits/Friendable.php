<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{

    public function add_friend($user_requested_id)
    {
        $Friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id
        ]);

        if ($Friendship)
        {
            return response()->json($Friendship, 200);
        }

        return response()->json('fail', 501);
    }

    public function accept_friends($requester)
    {
        $Friendship = Friendship::where('requester', $requester)
                                ->where('user_requested', $this->id)
                                ->first();

        if ($Friendship)
        {
            $Friendship->update([
                'status' => 1
            ]);

            return response()->json($Friendship, 200);
        }

        return response()->json('fail', 501);
    }

    public function friends()
    {
        $friends1 = array();

        $f1 = Friendship::where('status', 1)
                        ->where('requester', $this->id)
                        ->get();

        foreach ($f1 as $friendship):
            array_push($friends1, User::find($friendship->user_requested));
        endforeach;


        $friends2 = array();

        $f2 = Friendship::where('status', 1)
                        ->where('user_requested', $this->id)
                        ->get();

        foreach ($f2 as $friendship):
            array_push($friends2, User::find($friendship->requester));
        endforeach;

        return array_merge($friends1, $friends2);

    }
}


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

    public function pending_friend_requests()
    {
        $users = array();

        $Friendships = Friendship::where('status', 0)
                        ->where('requester', $this->id)
                        ->get();

        foreach ($Friendships as $friendship):
            array_push($users, User::find($friendship->user_requested));
        endforeach;

        return $users;

    }

    public function friends_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function is_friends_with($user_id)
    {
        if (in_array($user_id, $this->friends_ids()))
        {
            return response()->json('true', 200);
        }
        else
        {
            return response()->json('false', 200);
        }
    }

}


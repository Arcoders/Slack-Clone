<?php

namespace App\Traits;

use App\Friendship;

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

    public function accept_frient($requester)
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

}


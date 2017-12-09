<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class FriendshipsController extends Controller
{
    public function check($id)
    {
        if(Auth::user()->is_friends_with($id) === 1)
        {
            return ['status' => 'friends'];
        }

        if(Auth::user()->has_pending_friend_request_from($id) === 'true')
        {
            return ['status' => 'pending'];
        }

        if(Auth::user()->has_pending_friend_request_sent_to($id) === 1)
        {
            return ['status' => 'waiting'];
        }

        return ['status' => 0];
    }

    public function add_friend($id)
    {
        return Auth::user()->add_friend($id);
    }
}

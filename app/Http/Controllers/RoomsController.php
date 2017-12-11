<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoomsRequest;
use App\Online;
use App\Rooms;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{

    public function AddNewRoom(AddRoomsRequest $request)
    {
        $room = new Rooms();
        $room->user_id = Auth::user()->id;
        $room->name = $request->name;

        if ($room->save())
        {
            return 1;
        } else {
            return 0;
        }
    }

    public function GetAllRooms()
    {
        return Rooms::where('type', 'public')
                      ->with('user')
                      ->get()
                      ->toArray();
    }

    public function GetMyRooms()
    {
        $user_id = Auth::user()->id;
        return Rooms::where('user_id', $user_id)
                    ->orWhere('friend_id', $user_id)
                    ->get()
                    ->toArray();
    }

    public function DeleteRoom($room_id)
    {
        if (Rooms::where('id', $room_id)->where('user_id', Auth::user()->id)->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function GetMeOnline($room_id) {
        $user = Auth::user();

        if (Online::where('user_id', $user->id)->count() == 0) {

            $this->insertOnline($user->id, $room_id);

        } else {
            $leaveRoom = Online::where('user_id', $user->id)->get()[0];
            Online::where('user_id', $user->id)->delete();

            triggerPusher($leaveRoom->room->id, 'leaveUser', "leave room");
            $this->insertOnline($user->id, $room_id);
        }

        triggerPusher($room_id, 'onlineUser', "login to room");
        return 'done';
    }

    public function Leaving()
    {
        $room_id = room_id();
        Online::where('user_id', Auth::user()->id)->delete();
        triggerPusher($room_id, 'leaveUser', "leave room");
    }

    protected function insertOnline($user, $room)
    {
        $online = new Online();
        $online->user_id = $user;
        $online->room_id = $room;
        $online->timelogin = time();
        $online->save();
    }
}

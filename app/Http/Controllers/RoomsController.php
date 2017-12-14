<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoomsRequest;
use App\Online;
use App\OnlinePrivate;
use App\PrivateChat;
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
        return Rooms::with('user')
                      ->get()
                      ->toArray();
    }

    public function GetMyRooms()
    {
        $user_id = Auth::user()->id;
        return Rooms::where('user_id', $user_id)
                    ->get()
                    ->toArray();
    }

    public function getPrivate()
    {
        $user_id = Auth::user()->id;
        return PrivateChat::with('user')
                    ->with('friend')
                    ->where('user_id', $user_id)
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

            triggerPublic($leaveRoom->room->id, 'leaveUser', "leave room");
            $this->insertOnline($user->id, $room_id);
        }

        triggerPublic($room_id, 'onlineUser', "login to room");
        return 'done';
    }

    public function Leaving()
    {
        $room_id = room_id();
        Online::where('user_id', Auth::user()->id)->delete();
        triggerPublic($room_id, 'leaveUser', "leave room");
    }

    public function LeavingPrivate()
    {
        $room_id = room_id_private();
        OnlinePrivate::where('user_id', Auth::user()->id)->delete();
        triggerPrivate($room_id, 'leaveUser', "leave room");
    }

    public function checkPrivateRoom($room_id)
    {

        $user_id = Auth::user()->id;
        $room = PrivateChat::find($room_id);
        if ($room->user_id == $user_id || $room->friend_id == $user_id) return 1;

        return 0;

    }

    public function getPrivateOnline($room_id) {
        $user = Auth::user();

        if (OnlinePrivate::where('user_id', $user->id)->count() == 0) {

            $this->insertPrivate($user->id, $room_id);

        } else {
            $leaveRoom = OnlinePrivate::where('user_id', $user->id)->get()[0];
            OnlinePrivate::where('user_id', $user->id)->delete();

            triggerPrivate(
                            $leaveRoom->privateChat->id,
                            'leaveUser',
                            "leave room"
                         );
            $this->insertPrivate($user->id, $room_id);
        }

        triggerPrivate(
                        $room_id,
                        'onlineUser',
                        "login to room"
            );
        return 'done';
    }

    protected function insertOnline($user, $room)
    {
        $online = new Online();
        $online->user_id = $user;
        $online->room_id = $room;
        $online->timelogin = time();
        $online->save();
    }

    protected function insertPrivate($user, $room)
    {
        $online = new OnlinePrivate();
        $online->user_id = $user;
        $online->private_id = $room;
        $online->timelogin = time();
        $online->save();
    }
}

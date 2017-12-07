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
        return Rooms::with('user')->get()->toArray();
    }

    public function GetMyRooms()
    {
        return Rooms::where('user_id', Auth::user()->id)->get()->toArray();
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

            $this->triggerPusher(
                                $leaveRoom->room->id,
                                'leaveUser',
                                "leave room $leaveRoom->name");
            $this->insertOnline($user->id, $room_id);
        }

        $this->triggerPusher(
                            $room_id,
                            'onlineUser',
                            "login to room");
        return 'done';
    }

    protected function triggerPusher($room_id, $event, $indicatedRoom)
    {
        $room = Rooms::where('id', $room_id)->withCount('online')->get()[0]->online_count;
        $onlineUsers = Online::where('room_id', $room_id)->with('user')->get();
        $array = [
            'count' => $room,
            'conected' => $onlineUsers,
            'actions' => Auth::user()->name.' '.$indicatedRoom
        ];
        trigger_pusher( $room_id.$event, $event, $array);
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

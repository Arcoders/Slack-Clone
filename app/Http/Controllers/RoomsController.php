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
            return 'done';
        } else {
            return 'error';
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
            return 'done';
        } else {
            return 'error';
        }
    }

    public function GetMeOnline($room_id) {
        $user = Auth::user();
        $userOnline = Online::where('user_id', $user->id)->count();

        if ($userOnline == 0) {
            $this->insertOnline($user->id, $room_id);

        } else {
            Online::where('user_id', $user->id)->delete();
            $this->insertOnline($user->id, $room_id);
        }

        $room = Rooms::where('id', $room_id)->withCount('online')->get()[0]->online_count;
        trigger_pusher( $room_id.'online', 'onlineUser', $room);

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

    

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoomsRequest;
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

}

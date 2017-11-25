<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoomsRequest;
use App\Rooms;

class RoomsController extends Controller
{

    public function AddNewRoom(AddRoomsRequest $request)
    {
        $room = new Rooms();
        $room->name = $request->name;

        if ($room->save())
        {
            return 'done';
        } else {
            return 'error';
        }
    }

}

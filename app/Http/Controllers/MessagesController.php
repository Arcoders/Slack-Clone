<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function AddMessage(AddMessageRequest $request)
    {
        $message = new Messages();
        $message->body = $request->message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $request->room_id;

        if ($message->save()) {

            $data = Messages::where('id', $message->id)->with('user', 'room')->get()[0]->toArray();
            trigger_pusher( $message->room_id.'room', 'pushMessage', $data);

            return $data;

        } else {
            return 'error';
        }
    }

    public function typingUsers()
    {
        return Auth::user()->name;
    }

    public function GetLatest(Request $request)
    {
        $count =  Messages::where('room_id', $request->room_id)->get()->count();

        return Messages::where('room_id', $request->room_id)
            ->with('user', 'room')
            ->skip($count - 5)
            ->take(5)
            ->get();
    }

}

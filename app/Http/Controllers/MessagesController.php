<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Messages;
use Illuminate\Support\Facades\Auth;
use Pusher\Laravel\Facades\Pusher;

class MessagesController extends Controller
{
    public function AddMessage(AddMessageRequest $request)
    {
        $message = new Messages();
        $message->body = $request->message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $request->room_id;

        if ($message->save()) {

            $data = Messages::where('id', $message->id)->with('user')->get()->toArray();
            Pusher::getDefaultConnection();
            Pusher::trigger($message->room_id.'room', 'pushMessage', $data);

            return $data;

        } else {
            return 'error';
        }
    }



}

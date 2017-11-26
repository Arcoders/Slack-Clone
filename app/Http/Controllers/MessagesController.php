<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Messages;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function AddMessage(AddMessageRequest $request)
    {
        $message = new Messages();
        $message->body = $request->message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $request->room_id;

        if ($message->save()) {
            return 'done';
        } else {
            return 'error';
        }
    }
}

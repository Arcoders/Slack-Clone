<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Messages;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessagesController extends Controller
{
    public function AddMessage(AddMessageRequest $request)
    {
        $message = new Messages();
        $message->body = $request->message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $request->room_id;

        if ($message->save()) {

            $data = Messages::where('id', $message->id)->with('user', 'room')->get()->toArray();
            $this->trigger_pusher( $message->room_id.'room', 'pushMessage', $data);

            return $data;

        } else {
            return 'error';
        }
    }

    protected function trigger_pusher($roomChannel, $event, $data)
    {
        $id = env('PUSHER_APP_ID');
        $key = env('PUSHER_APP_KEY');
        $secret = env('PUSHER_APP_SECRET');
        $cluster = env('PUSHER_APP_CLUSTER');

        $pusher = new Pusher( $key, $secret, $id, array('cluster' => $cluster) );
        $pusher->trigger($roomChannel, $event, $data);
    }

}

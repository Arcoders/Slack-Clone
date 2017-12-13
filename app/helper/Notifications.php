 <?php

 use App\Online;
 use App\OnlinePrivate;
 use App\PrivateChat;
 use App\Rooms;
 use Illuminate\Support\Facades\Auth;
 use Pusher\Pusher;

 function trigger_pusher($roomChannel, $event, $data)
 {
     $id = "436290";
     $key = "60efd870de38efff2291";
     $secret = "abb5aae8d6cb88f1c4cb";
     $cluster = "eu";
     
     $pusher = new Pusher( $key, $secret, $id, array('cluster' => $cluster) );
     $pusher->trigger($roomChannel, $event, $data);
 }

function triggerPublic($room_id, $event, $indicatedRoom)
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

 function triggerPrivate($room_id, $event, $indicatedRoom)
 {
     $room = PrivateChat::where('id', $room_id)->withCount('onlinePrivate')->get()[0]->online_private_count;
     $onlineUsers = OnlinePrivate::where('private_id', $room_id)->with('user')->get();
     $array = [
         'count' => $room,
         'conected' => $onlineUsers,
         'actions' => Auth::user()->name.' '.$indicatedRoom
     ];
     trigger_pusher( $room_id.$event, $event, $array);
 }

function room_id()
 {
     return Online::where('user_id', Auth::user()->id)->get()[0]->room_id;
 }

 function room_id_private()
 {
     return OnlinePrivate::where('user_id', Auth::user()->id)->get()[0]->private_id;
 }
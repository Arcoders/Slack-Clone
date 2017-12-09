<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/AddNewRoom', 'RoomsController@AddNewRoom');

Route::post('/AddMessage', 'MessagesController@AddMessage');
Route::get('/GetLatest/{room_id}', 'MessagesController@GetLatest');
Route::get('/typingUsers/{room_id}', 'MessagesController@typingUsers');

Route::get('/getMeOnline/{room_id}', 'RoomsController@GetMeOnline');
Route::get('/getAllRooms', 'RoomsController@GetAllRooms');
Route::get('/getMyRooms', 'RoomsController@GetMyRooms');
Route::delete('/deleteRoom/{room_id}', 'RoomsController@DeleteRoom');
Route::get('/leaving', 'RoomsController@Leaving');

Route::get('/getCurrentUser', function() {
    $user = Auth::user();
    return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar
    ];
});

Route::get('/getProfile/{user_id}', function($user_id) {
    $user = User::find($user_id);
    return [
        'id' => $user->id,
        'name' => $user->name,
        'avatar' => $user->avatar
    ];
});

Route::get('/check_relationship_status/{user_id}', 'FriendshipsController@check');


Route::post('/UploadAvatar', 'UserController@UploadAvatar');

Route::get('/users', function () {
    return Auth::user()->all_users();
});

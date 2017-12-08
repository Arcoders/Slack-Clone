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
Route::get('/leaving/{room_id}', 'RoomsController@Leaving');

Route::get('/getCurrentUser', function() {
    $user = Auth::user();
    return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar
    ];
});

Route::post('/UploadAvatar', 'UserController@UploadAvatar');

Route::get('/add', function () {
    return Auth::user(1)->add_friend(4);
});


Route::get('/check', function () {
    return User::find(1)->add_friend(2);
});
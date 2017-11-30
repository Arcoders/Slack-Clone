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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/AddNewRoom', 'RoomsController@AddNewRoom');

Route::post('/AddMessage', 'MessagesController@AddMessage');
Route::get('/GetLatest/{room_id}', 'MessagesController@GetLatest');
Route::get('/typingUsers', 'MessagesController@typingUsers');

Route::get('/getMeOnline/{room_id}', 'RoomsController@GetMeOnline');
Route::get('/getAllRooms', 'RoomsController@GetAllRooms');
Route::get('/getMyRooms', 'RoomsController@GetMyRooms');
Route::delete('/deleteRoom/{room_id}', 'RoomsController@DeleteRoom');

Route::get('/getCurrentUser', function() {
    return Auth::user()->id;
});



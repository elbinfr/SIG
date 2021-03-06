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

Route::get('/home', 'Dashboard\DashboardController@index');
Route::get('/getSendingToday', 'Dashboard\DashboardController@getSendingToday');

Route::group(['middleware' => 'auth', 'prefix' => 'message','namespace' => 'Message'], function(){
    Route::get('sent', 'SentController@sentByCorporates');
    Route::post('sent-by-corporates','SentController@getSentByCorporates');
    Route::get('sent-by-day', 'SentController@sentByDay');
    Route::get('get-data-by-day', 'SentController@getSentMessagesByDate');

	Route::get('/incoming_message','IncomingMessageController@index');
    Route::get('/trend','IncomingMessageController@trend');
	Route::get('/reportIncoming','IncomingMessageController@showTotalIncoming');
	Route::get('/reportPositiveIncoming','IncomingMessageController@showPositiveIncoming');
});

Route::get('/test', 'Dashboard\DashboardController@getSendingToday');




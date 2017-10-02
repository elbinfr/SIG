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

Route::get('/home', function(){

	setBreadCrumb('Dashboard');

	return view('dashboard.dashboard');
});

Route::group(['prefix' => 'message','namespace' => 'Message'], function(){
	setBreadCrumb('Dashboard','Mensajes recibidos');
	Route::get('/incoming_message','IncomingMessageController@index');
});
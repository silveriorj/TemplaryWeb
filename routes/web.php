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
    return view('main_home');
});

Route::get('/demolay', 'DemolayController@listar');


Route::get('/templario', function(){
    return view('templario');
});

Route::get('/porto', function(){
    return view('porto');
});
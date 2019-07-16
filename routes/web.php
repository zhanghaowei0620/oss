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

Route::get('/oss1','Video\VideoController@oss1');
Route::get('/oss2','Video\VideoController@oss2');

Route::get('/notify','Video\VideoController@ossNotify');    //oss事件推送


Route::get('/test','Video\VideoController@test');

Route::get('/cont','Cont\ContController@cont');
Route::get('/video','Cont\ContController@video');
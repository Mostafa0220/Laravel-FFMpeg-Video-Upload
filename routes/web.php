<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'VideoController@index');

Route::get('/stream/{id}', 'VideoController@stream')->name('stream');
Route::get('/add', 'VideoController@fileUpload')->name('file.upload');

Route::post('/add', 'VideoController@store')->name('store');

Route::post('file-upload', 'VideoController@store')->name('file.upload.post');
use Iman\Streamer\VideoStreamer;
Route::get('/home', function () {
    $path = 'http://localhost/video/public/storage/streamable_videos/7.m3u8';

    VideoStreamer::streamFile($path);
});

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/s1', function () {
    return '{"comment":["Produktion: Audiowiese&#13;&#10;Text: Jens Wenzel&#13;&#10;Sprecher: Juliane Zschau, Jens Wenzel&#13;&#10;Im Auftrag von podcast.de"],"year":["2009"],"artist":["www.podcast.de","Jens Wenzel"],"title":["Wie funktioniert ein Podcast?"]}';
});

Route::get('/s2', function () {
    return '{"language":["Undetermined"],"encoding_tool":["Lavf57.25.100"]}';
});

Route::get('/s3', function () {
    return '';
});

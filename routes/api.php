<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\S1Controller;
use App\Http\Controllers\S2Controller;
use App\Http\Controllers\S3Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('s1', S1Controller::class);
// Route::apiResource('s2', S2Controller::class);
// Route::apiResource('s3', S3Controller::class);


Route::get('/s1', function () {
    return response()->json('{"comment":["Produktion: Audiowiese&#13;&#10;Text: Jens Wenzel&#13;&#10;Sprecher: Juliane Zschau, Jens Wenzel&#13;&#10;Im Auftrag von podcast.de"],"year":["2009"],"artist":["www.podcast.de","Jens Wenzel"],"title":["Wie funktioniert ein Podcast?"]}');
});

Route::get('/s2', function () {
    return response()->json('{"language":["Undetermined"],"encoding_tool":["Lavf57.25.100"]}');
});

Route::get('/s3', function () {
    return response()->json('');
});
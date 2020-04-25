<?php

use App\ujian;
use Illuminate\Http\Request;

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


/**
 * @return Illuminate\Http\Response
 */
Route::get('/getAll', function(){
    $data = ujian::all();
    return response($data);
});

/**
 * @param  int  $id
 * @return Illuminate\Http\Response
 */

Route::get('/get/{id}', function($id){
    $data = ujian::find($id);
    return response($data);
});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//管理画面系のファイル呼び出し
include __DIR__ . '/admin.php';

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/mypage', 'App\Http\Controllers\HomeController@index')->name('mypage');

Route::post('/osakesearch', 'App\Http\Controllers\OsakeController@search')->name('osake.search');
Route::get('/osakeshow/{osake_id}', 'App\Http\Controllers\OsakeController@show')->name('osake.show');

Route::get('/content', 'App\Http\Controllers\ContentController@index')->name('content');
Route::get('/contentshow/{content_id}', 'App\Http\Controllers\ContentController@show')->name('content.show');
Route::get('/contentcreate', 'App\Http\Controllers\ContentController@create')->name('content.create');
Route::post('/content', 'App\Http\Controllers\ContentController@store')->name('content.store');
Route::get('/contentedit/{content_id}', 'App\Http\Controllers\ContentController@edit')->name('content.edit');
Route::post('/content/{content_id}', 'App\Http\Controllers\ContentController@update')->name('content.update');
Route::delete('/contentdestroy/{content_id}', 'App\Http\Controllers\ContentController@destroy')->name('content.destroy');

Route::post('/like', 'App\Http\Controllers\ContentController@like')->name('like');
//Route::post('/unlike/{content_id}','App\Http\Controllers\LikeController@unlike')->name('unlike');

//Route::post('/favorite/{content_id}', 'App\Http\Controllers\ContentController@favorite')->name('favorite');

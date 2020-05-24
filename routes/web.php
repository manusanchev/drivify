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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'auth-api', 'middleware' => ['auth']], function () {

    Route::get('/user', 'UserController@getHomeData')->name('homeData');

    Route::get('/perfil', 'UserController@getPerfil')->name('img');
    Route::put('/perfil/edit','UserController@editarPerfil')->name('editarPerfil');
    Route::post('/perfil/uploadImage','UserController@uploadImage')->name('uploadImage');
    Route::delete('/perfil/eliminar','UserController@eliminarPerfil')->name('eliminarPerfil');

    Route::post('/viajes/crear', 'TravelController@crearViaje');
    Route::post('/viajes/code', 'TravelController@comprobarCodigo');
    Route::get('/viajes/getCode', 'TravelController@getCode');
    Route::get('/viajes/passengers', 'TravelController@getPassengersData');
    Route::get('/viajes/verify_playlist', 'TravelController@has_playlist');

    Route::post('/spotify', 'UserController@VincularSpotify');

    Route::post('/addSongs', 'PlaylistController@addSongs');


});

//
Route::get('/{vue_capture}', function () {
    return view('home');
})->where('vue_capture', '^(?!storage).*$')->middleware('auth');

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


Route::group(['middleware' => ['auth', 'admin']], function() {
   
    Route::get('/admin/dashboard', function(){
        return view('home');
    });
  
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'auth-api', 'middleware' => ['auth']], function () {

    Route::group(['middleware' => ['auth', 'admin']], function() {
        Route::get('/admin/users', 'AdminController@getDataUsers');
        Route::get('/admin/viajes', 'AdminController@getDataViajes');

        Route::post('/admin/users/edit', 'AdminController@editDataUser');
        Route::post('/admin/users/delete', 'AdminController@deleteDataUser');
    });
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

    Route::post('/tusViajes/getViajes', 'TravelController@getViajes');
    Route::get('/tusViajes/options', 'TravelController@options');

    Route::post('/tusViajes/destination', 'TravelController@optionsDestination');
    Route::post('/tusViajes/detalles', 'TravelController@detalles');

    Route::get('/awards', 'AwardController@getAwards');

});

//


Route::get('/{vue_capture}', function () {
    return view('home');
})->where('vue_capture', '^(?!storage).*$')->middleware('auth');
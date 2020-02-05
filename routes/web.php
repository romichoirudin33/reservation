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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::resource('facility', 'Admin\FacilityController', ['except' => [
            'show'
        ], 'as' => 'admin']);

        Route::resource('type-room', 'Admin\TypeRoomController', ['as' => 'admin']);
        Route::post('upload-image', 'Admin\TypeRoomController@upload_image')->name('admin.upload-image');
        Route::get('delete-image/{id}', 'Admin\TypeRoomController@delete_image')->name('admin.delete-image');
        Route::post('setting-facility', 'Admin\TypeRoomController@setting_facility')->name('admin.setting-facility');

        Route::post('add-room', 'Admin\TypeRoomController@add_room')->name('admin.add-room');
        Route::get('delete-room/{id}', 'Admin\TypeRoomController@delete_room')->name('admin.delete-room');
    });

});
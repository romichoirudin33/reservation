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
    return view('guest.welcome');
})->name('welcome');

Route::get('/room', 'Guest\ReservationController@room')->name('guest.room');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    //punya guest
    Route::get('/book', 'Guest\ReservationController@book')->name('guest.book');
    Route::post('/book', 'Guest\ReservationController@store')->name('guest.store_book');
    Route::get('/book/{id}/edit', 'Guest\ReservationController@edit')->name('guest.book.edit');
    Route::put('/book/{id}', 'Guest\ReservationController@update')->name('guest.book.update');
    Route::delete('/book/{id}', 'Guest\ReservationController@destroy')->name('guest.book.destroy');

    Route::post('/book-continue', 'Guest\ReservationController@continue_payment')->name('guest.continue_payment');

    Route::get('/pay', 'Guest\PaymentController@index')->name('guest.pay.index');
    Route::post('/pay', 'Guest\PaymentController@store')->name('guest.pay.store');
    Route::get('/pay-edit', 'Guest\PaymentController@edit')->name('guest.pay.edit');

    //punya admin
    Route::group(['prefix' => 'admin'], function () {

        Route::resource('facility', 'Admin\FacilityController', ['except' => [
            'show'
        ], 'as' => 'admin']);

        Route::resource('type-room', 'Admin\TypeRoomController', ['as' => 'admin']);

        Route::post('upload-image', 'Admin\TypeRoomController@upload_image')->name('admin.upload-image');
        Route::get('delete-image/{id}', 'Admin\TypeRoomController@delete_image')->name('admin.delete-image');
        Route::post('add-room', 'Admin\TypeRoomController@add_room')->name('admin.add-room');
        Route::get('delete-room/{id}', 'Admin\TypeRoomController@delete_room')->name('admin.delete-room');
        Route::post('setting-facility', 'Admin\TypeRoomController@setting_facility')->name('admin.setting-facility');

        Route::resource('new-booking', 'Admin\NewBookingController', ['except' => [
            'create', 'store', 'edit', 'destroy'
        ], 'as' => 'admin']);

        Route::resource('booking', 'Admin\BookingController', ['except' => [
            'create', 'store', 'edit', 'destroy'
        ], 'as' => 'admin']);
    });

});
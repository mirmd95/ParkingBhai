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

Route::Post('/registerdriver','Auth\RegisterController@driver_reg')->name('driver.reg');
Route::get('/registerdriver','Auth\RegisterController@driver_reg_form')->name('driver.reg.form');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/notifications', 'HomeController@owner_notification')->name('owner_notifications');

Route::get('/notification', 'HomeController@driver_notification')->name('driver_notifications');
Route::get('/records', 'HomeController@owner_record')->name('owner_record');
Route::get('/record', 'HomeController@driver_record')->name('driver_record');
Route::get('/activePark', 'HomeController@active_park')->name('active.park');

Route::get('/pendingRequest', 'HomeController@pendingRequest')->name('pendingRequest');

Route::get('/driverRequestCancel/{task}','HomeController@send_request_cancel')->name('park.request.cancel');
Route::get('/RequestAccept/{task}','HomeController@request_accept')->name('park.request.accept');
Route::get('/RequestReject/{task}','HomeController@request_reject')->name('park.request.reject');
Route::get('/activePark/{task}/finish/{t}/{time}','HomeController@park_finish')->name('park.finish');

Route::Post('/driverhome','HomeController@search')->name('driver.search');
Route::get('/driverRequest/{task}/{t}','HomeController@send_request')->name('park.request');

Route::get('/gmaps', 'HomeController@gmaps')->name('maps');


Route::post("/getlocation",'MapController@save')->name('location.save');
Route::get("/showlocation/{t}/{t1}/{t2}",'MapController@show_location')->name('map.show');
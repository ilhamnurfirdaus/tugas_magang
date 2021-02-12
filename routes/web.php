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

Route::prefix("test")->group(function() {
    Route::get('/create', 'TestController@create')->name('test.index');
    Route::get('/', 'TestController@index')->name('test.view');
    Route::post('/store', 'TestController@store')->name('test.store');
    Route::get('/{id}', 'TestController@show')->name('test.show');
    Route::get('/delete/{id}', 'TestController@destroy');
});

// Route::get('/view', function () {
//     return view('test.view');
// });

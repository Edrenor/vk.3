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
Auth::routes();


Route::get('/', 'BasicController@index');

//Route::get('/getPosts', 'IndexController@index');

Route::get('/post/{id}', 'SaveController@save')->name('postSave');

Auth::routes();

Route::middleware(['web'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/channel/{id?}/', 'ChannelController@index')->name('channel');
    Route::get('/channel/{id}/posts', 'IndexController@index')->name('channel_post');

    Route::post('/source/{channel_id}/{id?}', 'SourceController@update')->name('update_source');

    Route::get('/source/delete/{id?}','SourceController@delete')->name('delete_source');

    Route::post('/channel/{id?}', 'ChannelController@update')->name('update_channel');


});


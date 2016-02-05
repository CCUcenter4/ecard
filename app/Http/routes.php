<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'InitController@index');

Route::group(['prefix'=>'web'], function() {
  Route::get('/', 'WebController@index');
  Route::get('festival', 'WebController@festival');
});

Route::group(['prefix'=>'api'], function() {
  Route::group(['prefix'=>'auth'], function() {
    Route::group(['prefix'=>'login'], function() {
      Route::post('ecard', 'AuthController@ecard');
      Route::get('facebook', 'AuthController@facebook');
      Route::get('facebook/callback', 'AuthController@facebookCallback');
    });
  });
});

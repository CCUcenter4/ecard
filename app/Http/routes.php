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

    Route::group(['prefix'=>'person'], function() {
        Route::get('/', 'WebController@person');
    });
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('/manage', 'ManagerController@manage');
    Route::get('/login', 'ManagerController@login');
});

Route::group(['prefix'=>'api'], function() {
    Route::group(['prefix'=>'auth'], function() {
        Route::group(['prefix'=>'login'], function() {
            // common user
            Route::post('ecard', 'AuthController@ecard');
            Route::post('sso', 'AuthController@sso');
            Route::get('facebook', 'AuthController@facebook');
            Route::get('facebook/callback', 'AuthController@facebookCallback');

            // manager
            Route::post('manager', 'AuthController@manager');
        });

        Route::post('register', 'AuthController@register');
    });
    Route::group(['prefix'=>'card'], function() {
        // manage
        Route::post('create', 'Api\CardController@create');
        Route::put('update/{id}', 'Api\CardController@create');
        Route::delete('delete/{id}', 'Api\CardController@delete');

        // get data
        Route::get('get/{parent}/{child}', 'Api\CardController@get');
    });

    Route::group(['prefix'=>'person'], function() {
        Route::put('update', 'Api\PersonController@update');
        Route::get('history', 'Api\PersonController@gistory');

        Route::group(['prefix'=>'reservation'], function() {
            Route::post('create/{card_id}', 'Api\ReservationController@create');
            Route::put('update/{id}', 'Api\ReservationController@update');
            Route::delete('delete/{id}', 'Api\ReservationController@delete');
            Route::get('list', 'Api\ReservationController@list');
        });
    });

    Route::group(['prefix'=>'category'], function() {
        Route::group(['prefix'=>'parent'], function() {
            Route::post('create', 'Api\CategoryController@createParent');
            Route::put('update/{id}', 'Api\CategoryController@updateParent');
            Route::delete('delete/{parent_id}', 'Api\CategoryController@deleteParent');
        });
        Route::group(['prefix'=>'child'], function() {
            Route::post('create', 'Api\CategoryController@createChild');
            Route::put('update/{id}', 'Api\CategoryController@updateChild');
            Route::delete('delete/{id}', 'Api\CategoryController@deleteChild');
        });
    });
});

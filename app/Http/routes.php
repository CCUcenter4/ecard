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
    Route::get('card/{card_id}', 'WebController@card');

    Route::group(['prefix'=>'person'], function() {
        Route::get('/', 'WebController@person');
    });
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('upload', ['middleware'=>'manager', 'uses'=>'ManagerController@upload']);
    Route::get('login', 'ManagerController@login');
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
        Route::post('update/{id}', 'Api\CardController@update');
        Route::post('delete/{id}', 'Api\CardController@delete');

        // get data
        Route::get('list/{parent_id}/{child_id}', 'Api\CardController@list');
        Route::get('detail/{id}', 'Api\CardController@detail');

        // mail
        Route::post('mail/{id}', 'Api\CardController@mail');
    });

    Route::group(['prefix'=>'person'], function() {
        Route::post('update', 'Api\PersonController@update');
        Route::get('history', 'Api\PersonController@gistory');

        Route::group(['prefix'=>'reservation'], function() {
            Route::post('create/{card_id}', 'Api\ReservationController@create');
            Route::post('update/{id}', 'Api\ReservationController@update');
            Route::post('delete/{id}', 'Api\ReservationController@delete');
            Route::get('get', 'Api\ReservationController@get');
        });
    });

    Route::group(['prefix'=>'category'], function() {
        Route::group(['prefix'=>'parent'], function() {
            Route::post('create', 'Api\CategoryController@createParent');
            Route::post('update/{id}', 'Api\CategoryController@updateParent');
            Route::post('delete/{id}', 'Api\CategoryController@deleteParent');
            Route::get('get', 'Api\CategoryController@getParent');
        });
        Route::group(['prefix'=>'child'], function() {
            Route::post('create/{parent_id}', 'Api\CategoryController@createChild');
            Route::post('update/{id}', 'Api\CategoryController@updateChild');
            Route::post('delete/{id}', 'Api\CategoryController@deleteChild');
            Route::get('get/{parent_id}', 'Api\CategoryController@getChild');
        });
    });
});

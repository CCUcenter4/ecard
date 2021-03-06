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
    Route::get('festival/{parent_id}/{child_id}', 'WebController@festival');
    Route::get('card/{card_id}/{visitor_type}/{refer}', 'WebController@card');
    Route::get('normal/{navbar_id}/{parent_id}/{child_id}', 'WebController@normal');
    Route::get('logout', 'AuthController@logout');
    Route::get('policy', 'WebController@policy');

    Route::group(['prefix'=>'person'], function() {
        Route::get('/', 'WebController@person');
    });
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('upload', ['middleware'=>'manager', 'uses'=>'ManagerController@upload']);
    Route::get('env', ['middleware'=>'manager', 'uses'=>'ManagerController@env']);
    Route::get('login', 'ManagerController@login');
});

Route::group(['prefix'=>'api'], function() {
    Route::group(['prefix'=>'auth'], function() {
        Route::group(['prefix'=>'login'], function() {
            // common user
            Route::post('ecard', 'AuthController@ecard');
            Route::post('sso', 'AuthController@sso');

            // manager
            Route::post('manager', 'AuthController@manager');
        });

        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
    });

    Route::group(['prefix'=>'card'], function() {
        // manage
        Route::post('create', 'Api\CardController@create');
        Route::post('update/{id}', 'Api\CardController@update');
        Route::post('selectCard/{id}', 'Api\CardController@selectCard');
        Route::delete('delete/{id}', 'Api\CardController@delete');

        // get data
        Route::get('list/{parent_id}/{child_id}', 'Api\CardController@cardList');
        Route::get('detail/{id}', 'Api\CardController@detail');
        Route::get('likeDetail/{id}', 'Api\CardController@likeDetail');
        Route::get('collectDetail/{id}', 'Api\CardController@collectDetail');
        Route::get('name', 'Api\CardController@name');

        // mail
        Route::post('mail/{id}', 'Api\CardController@mail');
        Route::post('multiMail/{id}', 'Api\CardController@multiMail');

        // fb_share
        Route::post('fb_share_increment/{id}', 'Api\CardController@fb_share_increment');

        // like_inc
        Route::post('like_increment/{id}', 'Api\CardController@like_increment');

        // collect_inc
        Route::post('collect_increment/{id}', 'Api\CardController@collect_increment');
    });

    Route::group(['prefix'=>'person'], function() {
        Route::put('update', 'Api\PersonController@update');
        Route::get('history', 'Api\PersonController@history');
        Route::get('like', 'Api\PersonController@like');
        Route::get('collect', 'Api\PersonController@collect');
        Route::get('contact', 'Api\PersonController@contact');

        Route::group(['prefix'=>'reservation'], function() {
            Route::post('create/{card_id}', 'Api\ReservationController@create');
            Route::delete('delete/{id}', 'Api\ReservationController@delete');
            Route::get('/', 'Api\ReservationController@get');
        });
    });

    Route::group(['prefix'=>'category'], function() {
        Route::group(['prefix'=>'parent'], function() {
            Route::post('create', 'Api\CategoryController@createParent');
            Route::put('update/{id}', 'Api\CategoryController@updateParent');
            Route::delete('delete/{id}', 'Api\CategoryController@deleteParent');
            Route::get('get', 'Api\CategoryController@getParent');
        });
        Route::group(['prefix'=>'child'], function() {
            Route::post('create/{parent_id}', 'Api\CategoryController@createChild');
            Route::put('update/{id}', 'Api\CategoryController@updateChild');
            Route::delete('delete/{id}', 'Api\CategoryController@deleteChild');
            Route::get('get/{parent_id}', 'Api\CategoryController@getChild');
        });
    });

    Route::group(['prefix'=>'env'], function() {
        Route::group(['prefix'=>'navbar'], function() {
            Route::get('get', 'Api\NavbarController@get');
            Route::post('create/{parent_id}', 'Api\NavbarController@create');
            Route::delete('delete/{id}', 'Api\NavbarController@delete');
        });
    });

    Route::group(['prefix'=>'account'], function() {
        Route::get('getNotUser', 'Api\AccountController@getNotUser');
        Route::post('searchUser', 'Api\AccountController@searchUser');
        Route::post('changeRole/{id}/{role}', 'Api\AccountController@changeRole');
    });
});

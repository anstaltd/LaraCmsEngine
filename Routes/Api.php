<?php

Route::group(array_merge([
    'namespace' => '\Ansta\LaraCms\Controllers',
    'middleware' => 'api',
], config('laracms.api_routes', [])), function() {


    Route::post('/admin/login', 'Admin\Auth\LoginController@login');

    Route::get('/help', function() {
        dd('hello');
    });

    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => ['jwt.auth'],
    ], function() {

        Route::resource('/sites', 'SiteController', [
            'except' => [
                'create',
                'edit',
            ],
        ]);

        Route::resource('/sites/{site}/authors', 'AuthorController', [
            'except' => [
                'create',
                'edit',
            ],
        ]);

        Route::resource('/sites/{site}/pages', 'PageController', [
            'except' => [
                'create',
                'edit',
            ],
        ]);

//        Route::resource('/sites/{site}/images', 'ImageController', [
//            'except' => [
//                'create',
//                'edit',
//            ],
//        ]);
    });

    Route::group([
        'namespace' => 'Hosted',
    ], function() {

        //Route::get('/{page}', 'PageController@index');
        //Route::get('/images/{path}', 'ImageController@show')->where('path', '*')->name('image.manipulator');
    });
});

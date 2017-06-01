<?php

Route::group([
    'namespace' => '\ChickenTikkaMasala\LaraCms\Controllers',
    'middleware' => 'api',
], function() {


    //Route::post('/admin/login', 'Auth\LoginController@login');

    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
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

        Route::resource('/sites/{site}/images', 'ImageController', [
            'except' => [
                'create',
                'edit',
            ],
        ]);
    });

    Route::group([
        'namespace' => 'Hosted',
    ], function() {

        Route::get('/{page}', 'PageController@index');
        Route::get('/images/{path}', 'ImageController@show')->where('path', '*')->name('image.manipulator');
    });
});

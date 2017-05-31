<?php

Route::group([
    'namespace' => '\ChickenTikkaMasala\LaraCms\Controllers',

], function() {
    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
    ], function() {
        Route::resource('/authors', 'AuthorController', [
            'except' => [
                'create',
                'edit',
            ],
        ]);
        Route::resource('/sites', 'SiteController', [
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
    });
});

<?php


/**
 *
 */

return [

    'allowed_origins' => [
        '*',
    ],

    'cors_headers' => [
        'Access-Control-Allow-Methods' => 'POST, GET, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization, Accept',
    ],

    'api_routes' => [
        'namespace' => '\Ansta\LaraCms\Controllers',
        'middleware' => 'api',
    ],
];

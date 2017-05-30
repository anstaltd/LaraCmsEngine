<?php

namespace ChickenTikkaMasala\LaraCms\Providers;

use Illuminate\Support\ServiceProvider;

class LaraCmsProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {

    }

    public function provides()
    {
        return [
            Zizaco\Entrust\EntrustServiceProvider::class,
            Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        ];
    }
}

<?php

namespace ChickenTikkaMasala\LaraCms\Providers;

use ChickenTikkaMasala\LaraCms\Commands\SiteCommand;
use ChickenTikkaMasala\LaraCms\Commands\UserCommand;
use Illuminate\Support\ServiceProvider;

class LaraCmsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laracms.php' => config_path('laracms.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes');

        $this->commands([
            SiteCommand::class,
            UserCommand::class,
        ]);
    }

    public function register()
    {

    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            \Zizaco\Entrust\EntrustServiceProvider::class,
            \Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        ];
    }
}

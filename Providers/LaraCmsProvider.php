<?php

namespace ChickenTikkaMasala\LaraCms\Providers;

use ChickenTikkaMasala\LaraCms\Commands\AuthorCommand;
use ChickenTikkaMasala\LaraCms\Commands\SiteCommand;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

/**
 * Class LaraCmsProvider
 * @package ChickenTikkaMasala\LaraCms\Providers
 */
class LaraCmsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laracms.php' => config_path('laracms.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/Api.php');

        $this->commands([
            SiteCommand::class,
            AuthorCommand::class,
        ]);
    }

    public function register()
    {
        $this->registerGlide();
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            \Zizaco\Entrust\EntrustServiceProvider::class,
            \Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
            \Intervention\Image\ImageServiceProvider::class,
            \Cviebrock\EloquentSluggable\ServiceProvider::class,
        ];
    }

    /**
     * Register glide server factory
     */
    protected function registerGlide()
    {
        $this->app->singleton(Server::class, function($app) {

            /** @var Filesystem $filesystem */
            $filesystem = $app->make(Filesystem::class);

            return ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'cache' => $filesystem->getDriver(),
                'source_path_prefix' => 'images/',
                'cache_path_prefix' => 'images/.cache',
            ]);

        });
    }
}

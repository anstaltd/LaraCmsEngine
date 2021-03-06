<?php

namespace Ansta\LaraCms\Providers;

use Ansta\LaraArticleGenerator\Providers\ArticleGeneratorProvider;
use Ansta\LaraCms\Commands\AuthorCommand;
use Ansta\LaraCms\Commands\SiteCommand;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

/**
 * LaraCmsProvider
 * @author Aaryanna Simonelli <ashleighsimonelli@gmail.com>
 */
class LaraCmsProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laracms.php' => config_path('laracms.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

//        $this->loadRoutesFrom(__DIR__.'/../Routes/Api.php');

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
            ArticleGeneratorProvider::class,
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

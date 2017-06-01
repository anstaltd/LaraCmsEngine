# Laravel CMS

## Install

Add the service provider to your `config/app.php` file.

```php
'providers' => [
    ...
    ChickenTikkaMasala\LaraCms\Providers\LaraCmsProvider::class,
    ...
];
```
> LaraCms will include the below service providers for you:

```php
\Zizaco\Entrust\EntrustServiceProvider::class,
\Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
\Intervention\Image\ImageServiceProvider::class,
\Cviebrock\EloquentSluggable\ServiceProvider::class,
```

Publish the vendors:

```bash
php artisan vendor:publish
```

Add the following middlewares to the kernel:

```php

protected $middlewares = [
    ...
    \ChickenTikkaMasala\LaraCms\Middlewares\CorsMiddleware::class,
    ...
];

...

protected $routeMiddlewares = [
    ...
    'jwt.auth' => \Tymon\JWTAuth\Middleware\Check::class,
    'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
    'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
    'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
    'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
    ...
];

```

Some of the above middlewares are not currently used but if and when extending the base structure of the classes you could use the above package's middlewares.
The Cors middleware can be replaced with your own if you want. The Cors middleware here just adds in some configured values from `config/laracms.php` for allow origin, allow methods and allow headers.

### Migrating
```bash
php artisan migrate
```
> Before running migration be sure to add a table property to your User class

```php
class User extends Authenicatable {
    public $table = 'users';
    ...
```

Reason why is to allow for different named tables and extends.



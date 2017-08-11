<?php

namespace Ansta\LaraCms\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Ansta\LaraCms\Models\{Author, Component, Site, Page};
use Ansta\LaraCms\Policy\{AuthorPolicy, ComponentPolicy, SitePolicy, PagePolicy};

/**
 * AuthServiceProvider
 * @author Aaryanna Simonelli <ashleighsimonelli@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Site::class => SitePolicy::class,
        Page::class => PagePolicy::class,
        Author::class => AuthorPolicy::class,
        Component::class => ComponentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }

}

<?php

namespace Ansta\LaraCms\Policy;

use Ansta\LaraCms\Models\Author;
use Illuminate\Auth\Access\HandlesAuthorization;
use Ansta\LaraCms\Models\Site;

/**
 * Class SitePolicy
 * @package Ansta\LaraCms\Models
 */
class SitePolicy
{
    use HandlesAuthorization;

    /**
     * @var Site
     */
    protected $site;

    /**
     * SitePolicy constructor.
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Check author's Role and ownership
     *
     * @param Author $author
     * @param $role
     * @return bool
     */
    protected function run(Author $author, $role)
    {
        return $author->hasRole($role) && $author->sites()->where('sites.id', $this->site->id)->count() === 1;
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function create(Author $author)
    {
        return $this->run($author, 'site.create');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function edit(Author $author)
    {
        return $this->run($author, 'site.edit');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function destroy(Author $author)
    {
        return $this->run($author, 'site.destroy');
    }

//    public function __call($name, $arguments)
//    {
//        return $this->run($arguments, Site::class.'.'.$name);
//    }

}

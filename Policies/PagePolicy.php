<?php

namespace Ansta\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PagePolicy
 * @package Ansta\LaraCms\Models
 */
class PagePolicy
{
    use HandlesAuthorization;

    /**
     * @var Page
     */
    protected $page;

    /**
     * PagePolicy constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
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
        return $author->hasRole($role) && $author->pages()->where('lara_cms_pages.id', $this->page->id)->count() === 1;
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function create(Author $author)
    {
        return $this->run($author, 'page.create');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function edit(Author $author)
    {
        return $this->run($author, 'page.edit');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function destroy(Author $author)
    {
        return $this->run($author, 'page.destroy');
    }

//    public function __call($name, $arguments)
//    {
//        return $this->run($arguments, Page::class.'.'.$name);
//    }

}

<?php

namespace Ansta\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ComponentPolicy
 * @package Ansta\LaraCms\Models
 */
class ComponentPolicy
{
    use HandlesAuthorization;

    /**
     * @var Component
     */
    protected $component;

    /**
     * AuthorPolicy constructor.
     * @param Author $author
     */
    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * Check author's Role and ownership
     *
     * @param Author $author
     * @param Page $page
     * @param $role
     * @return bool
     */
    protected function run(Author $author, Page $page, $role)
    {
        return $author->hasRole($role);
    }

    /**
     * @param Author $author
     * @param Page $page
     * @return bool
     */
    public function create(Author $author, Page $page)
    {
        return $this->run($author, $page, 'page.create');
    }

    /**
     * @param Author $author
     * @param Page $page
     * @return bool
     */
    public function edit(Author $author, Page $page)
    {
        return $this->run($author, $page, 'page.edit');
    }

    /**
     * @param Author $author
     * @param Page $page
     * @return bool
     */
    public function destroy(Author $author, Page $page)
    {
        return $this->run($author, $page, 'page.destroy');
    }

//    public function __call($name, $arguments)
//    {
//        return $this->run($arguments, Author::class.'.'.$name);
//    }

}

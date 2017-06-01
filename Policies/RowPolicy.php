<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class RowPolicy
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class RowPolicy
{
    use HandlesAuthorization;

    /**
     * @var Author
     */
    protected $row;

    /**
     * AuthorPolicy constructor.
     * @param Author $author
     */
    public function __construct(Row $row)
    {
        $this->row = $row;
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
        return $author->hasRole($role) && $author->pages()->with('rows')->where('lara_cms_rows.id', $this->row->id)->where('lara_cms_pages.id', $page->id)->count() === 1;
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function create(Author $author, Page $page)
    {
        return $this->run($author, $page, 'page.create');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function edit(Author $author, Page $page)
    {
        return $this->run($author, $page, 'page.edit');
    }

    /**
     * @param Author $author
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

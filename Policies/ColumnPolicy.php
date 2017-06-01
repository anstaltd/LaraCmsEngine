<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ColumnPolicy
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class ColumnPolicy
{
    use HandlesAuthorization;

    /**
     * @var Author
     */
    protected $column;

    /**
     * AuthorPolicy constructor.
     * @param Author $author
     */
    public function __construct(Column $column)
    {
        $this->column = $column;
    }

    /**
     * Check author's Role and ownership
     *
     * @param Author $author
     * @param Page $page
     * @param Row $row
     * @param $role
     * @return bool
     */
    protected function run(Author $author, Page $page, Row $row, $role)
    {
        return $author->hasRole($role) && $author->pages()->with('rows')->where('lara_cms_rows.id', $this->row->id)
                ->where('lara_cms_pages.id', $page->id)
                ->join('lara_cms_columns as columns', 'columns.row_id', '=', 'lara_cms_rows.id')
                ->where('columns.id', $this->column->id)->count() === 1;
    }

    /**
     * @param Author $author
     * @param Page $page
     * @param Row $row
     * @return bool
     */
    public function create(Author $author, Page $page, Row $row)
    {
        return $this->run($author, $page, $row, 'page.create');
    }

    /**
     * @param Author $author
     * @param Page $page
     * @param Row $row
     * @return bool
     */
    public function edit(Author $author, Page $page, Row $row)
    {
        return $this->run($author, $page, $row, 'page.edit');
    }

    /**
     * @param Author $author
     * @param Page $page
     * @param Row $row
     * @return bool
     */
    public function destroy(Author $author, Page $page, Row $row)
    {
        return $this->run($author, $page, $row, 'page.destroy');
    }

//    public function __call($name, $arguments)
//    {
//        return $this->run($arguments, Author::class.'.'.$name);
//    }

}

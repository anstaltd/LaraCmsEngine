<?php

namespace Ansta\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AuthorPolicy
 * @package Ansta\LaraCms\Models
 */
class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * @var Author
     */
    protected $author;

    /**
     * AuthorPolicy constructor.
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
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
        return $author->hasRole($role) && $author->sites()->with('authors')->where($author->getTable().'.id', $this->author->id)->count() === 1;
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function create(Author $author)
    {
        return $this->run($author, 'author.create');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function edit(Author $author)
    {
        return $this->run($author, 'author.edit');
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function destroy(Author $author)
    {
        return $this->run($author, 'author.destroy');
    }

//    public function __call($name, $arguments)
//    {
//        return $this->run($arguments, Author::class.'.'.$name);
//    }

}

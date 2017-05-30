<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy extends Policy
{
    use HandlesAuthorization;

    public function create(Author $author)
    {
        return $author->hasRole('page.create');
    }

    public function edit(Author $author)
    {
        return $author->hasRole('page.edit');
    }

    public function destroy(Author $author)
    {
        return $author->hasRole('page.destroy');
    }

}

<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use App\User;
use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class Author
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class Author extends User
{
    use SoftDeletes, AuditAuthorLog, EntrustUserTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function pages()
    {
        return $this->hasManyThrough(Page::class, Site::class);
    }

}

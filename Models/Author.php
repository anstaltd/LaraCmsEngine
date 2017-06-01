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
    use AuditAuthorLog, EntrustUserTrait;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = array_merge($this->fillable, [
            'site_id',
        ]);
    }

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

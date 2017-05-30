<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use App\User;
use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Author extends User
{
    use SoftDletes, AuditAuthorLog, EntrustUserTrait;

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }
}

<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use App\User;
use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Author extends User
{
    use SoftDletes, AuditAuthorLog;

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }
}

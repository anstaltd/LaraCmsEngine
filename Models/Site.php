<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Site extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_sites';

    public $fillable = [
        'domain',
        'active',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}

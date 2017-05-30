<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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

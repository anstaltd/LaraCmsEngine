<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Page extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_pages';

    public $fillable = [
        'slug',
        'title',
        'available-from',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function rows()
    {
        return $this->hasMany(Row::class);
    }

    public function columns()
    {
        return $this->hasManyThrough(Column::class, Row::class);
    }
}

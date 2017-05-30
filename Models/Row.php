<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Row extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_rows';

    public $fillable = [
        'position',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

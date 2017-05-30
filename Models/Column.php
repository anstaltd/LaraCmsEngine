<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Column extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_columns';

    public $fillable = [
        'data',
    ];

    public function page()
    {
        return $this->hasManyThrough(Page::class, Row::class);
    }

    public function row()
    {
        return $this->belongsTo(Column::class);
    }


}

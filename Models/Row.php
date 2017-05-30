<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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

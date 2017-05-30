<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;

class Image extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_images';

    public $fillable = [
        'title',
        'path',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}

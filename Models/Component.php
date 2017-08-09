<?php

namespace Ansta\LaraCms\Models;

use Ansta\LaraCms\Models\Traits\AuditAuthorLog;
use Ansta\LaraCms\Models\Traits\ConfigData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Column
 * @package Ansta\LaraCms\Models
 */
class Component extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData, NodeTrait;

    /**
     * @var string
     */
    public $table = 'components';

    /**
     * @var array
     */
    public $fillable = [
        'config',
        'page_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        $data['children'] = $this->children;

        return $data;
    }

    public static function boot() {
        parent::boot();

        static::creating(function($page) {
            $page->author()->associate(\Auth::user());
        });
    }
}

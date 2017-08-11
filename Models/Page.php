<?php

namespace Ansta\LaraCms\Models;

use Ansta\LaraCms\Models\Traits\AuditAuthorLog;
use Ansta\LaraCms\Models\Traits\ConfigData;
use Ansta\LaraCms\Models\Traits\Status;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package Ansta\LaraCms\Models
 */
class Page extends Model
{
    use SoftDeletes, AuditAuthorLog, Sluggable, ConfigData, Status;

    public $table = 'pages';

    public $fillable = [
        'slug',
        'title',
        'available_at',
        'active',
        'authorable_id',
        'authorable_type',
        'updatable_type',
        'updatable_id',
        'deletable_type',
        'deletable_id',
        'config',
        'site_id',
        'status_id',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName() {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        $data['components'] = $this->components;

        return $data;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public static function boot() {
        parent::boot();

        static::creating(function($page) {
            $page->author()->associate(\Auth::user());
        });
    }
}

<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use ChickenTikkaMasala\LaraCms\Models\Traits\ConfigData;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class Page extends Model
{
    use SoftDeletes, AuditAuthorLog, Sluggable, ConfigData;

    public $table = 'lara_cms_pages';

    public $fillable = [
        'slug',
        'title',
        'available-from',
        'active',
        'authorable_id',
        'authorable_type',
        'updatable_type',
        'updatable_id',
        'deletable_type',
        'deletable_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rows()
    {
        return $this->hasMany(Row::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function columns()
    {
        return $this->hasManyThrough(Column::class, Row::class);
    }
}

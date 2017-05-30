<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use SoftDletes, AuditAuthorLog, Sluggable;

    public $table = 'lara_cms_pages';

    public $fillable = [
        'slug',
        'title',
        'available-from',
    ];

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

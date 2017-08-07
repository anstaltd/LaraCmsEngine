<?php

namespace Ansta\LaraCms\Models;

use Ansta\LaraCms\Models\Traits\AuditAuthorLog;
use Ansta\LaraCms\Models\Traits\ConfigData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package Ansta\LaraCms\Models
 */
class Image extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData;

    /**
     * @var string
     */
    public $table = 'lara_cms_images';

    /**
     * @var array
     */
    public $fillable =  [
        "imagable_id",
        "imagable_type",
        "path",
        "title",
        "description",
        "publish_date",
        'config_data',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * @return string
     */
    public function getMasterImageAttribute()
    {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]);
    }

    /**
     * @return string
     */
    public function getDisplayImageAttribute()
    {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]).'?w=200&h=200';
    }

    /**
     * @return string
     */
    public function getGridImage1Attribute()
    {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]).'?w=200&h=200&fit=crop';
    }

    /**
     * @return string
     */
    public function getMainImageAttribute()
    {
        return route("image.manipulator", ["path" => str_replace("images/", "", $this->path)])."?w=1000&h=auto";
    }

}

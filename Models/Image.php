<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDletes, AuditAuthorLog;

    public $table = 'lara_cms_images';

    public $fillable =  [
        "imagable_id",
        "imagable_type",
        "path",
        "title",
        "description",
        "publish_date",
        "exif",
        "public",
    ];


    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function getMasterImageAttribute() {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]);
    }

    public function getDisplayImageAttribute() {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]).'?w=200&h=200';
    }

    public function getGridImage1Attribute() {
        return route("image.manipulator", ["path" => str_replace('images/', '', $this->path)]).'?w=200&h=200&fit=crop';
    }

    public function getMainImageAttribute() {
        return route("image.manipulator", ["path" => str_replace("images/", "", $this->path)])."?w=1000&h=auto";
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function setExifAttribute($exif) {
        return $this->attributes['exif'] = is_array($exif) ? json_encode($exif) : json_encode([]);
    }
    public function getExifAttribute($value) {
        return is_null($value) ? [] : json_decode($value, true);
    }
}

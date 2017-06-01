<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use ChickenTikkaMasala\LaraCms\Models\Traits\ConfigData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Site
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class Site extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData;

    /**
     * @var string
     */
    public $table = 'lara_cms_sites';

    /**
     * @var array
     */
    public $fillable = [
        'domain',
        'config_data',
        'title',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}

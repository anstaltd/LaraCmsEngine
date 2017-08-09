<?php

namespace Ansta\LaraCms\Models;

use Ansta\LaraCms\Models\Traits\AuditAuthorLog;
use Ansta\LaraCms\Models\Traits\ConfigData;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Site
 * @package Ansta\LaraCms\Models
 */
class Site extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData;

    /**
     * @var string
     */
    public $table = 'sites';

    /**
     * @var array
     */
    public $fillable = [
        'domain',
        'config',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

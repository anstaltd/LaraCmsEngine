<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use ChickenTikkaMasala\LaraCms\Models\Traits\ConfigData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Row
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class Row extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData;

    /**
     * @var string
     */
    public $table = 'lara_cms_rows';

    /**
     * @var array
     */
    public $fillable = [
        'position',
        'config_data',
        'site_id',
        'html',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}

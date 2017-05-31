<?php

namespace ChickenTikkaMasala\LaraCms\Models;

use ChickenTikkaMasala\LaraCms\Models\Traits\AuditAuthorLog;
use ChickenTikkaMasala\LaraCms\Models\Traits\ConfigData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Column
 * @package ChickenTikkaMasala\LaraCms\Models
 */
class Column extends Model
{
    use SoftDeletes, AuditAuthorLog, ConfigData;

    /**
     * @var string
     */
    public $table = 'lara_cms_columns';

    /**
     * @var array
     */
    public $fillable = [
        'config_data',
        'position',
        'row_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function page()
    {
        return $this->hasManyThrough(Page::class, Row::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function row()
    {
        return $this->belongsTo(Column::class);
    }

}

<?php

namespace Ansta\LaraCms\Models\Traits;

use Ansta\LaraCms\Enums\PageStatus;

trait Status {
    public function getStatusAttribute($value)
    {
        return PageStatus::$names[$this->attributes['status_id']];
    }
}

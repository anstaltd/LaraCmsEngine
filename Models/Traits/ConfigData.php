<?php

namespace Ansta\LaraCms\Models\Traits;

trait ConfigData
{
    public function setConfigAttribute($value)
    {
        return $this->attributes['config'] = json_encode(is_array($value) ? $value : []);
    }

    public function getConfigAttribute($value)
    {
        return json_decode($value);
    }
}

<?php

namespace ChickenTikkaMasala\LaraCms\Models\Traits;

trait ConfigData
{
    public function setConfigDataAttribute($value)
    {
        return $this->parameters['config_data'] = json_encode(is_array($value) ? $value : []);
    }

    public function getConfigDataAttribute($value)
    {
        return json_decode($value);
    }
}

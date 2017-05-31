<?php

namespace ChickenTikkaMasala\LaraCms\Models\Traits;

/**
 * Class AuditAuthorLog
 * @package ChickenTikkaMasala\LaraCms\Models\Traits
 */
trait AuditAuthorLog
{
    /**
     * @return mixed
     */
    public function author()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function updator()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function deletor()
    {
        return $this->morphTo();
    }
}

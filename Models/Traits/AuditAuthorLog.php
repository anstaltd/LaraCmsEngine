<?php

namespace Ansta\LaraCms\Models\Traits;

/**
 * Class AuditAuthorLog
 * @package Ansta\LaraCms\Models\Traits
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

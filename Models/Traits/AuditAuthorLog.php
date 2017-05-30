<?php

namespace ChickenTikkaMasala\LaraCms\Models\Traits;

trait AuditAuthorLog
{
    public function author()
    {
        return $this->morthTo();
    }

    public function updator()
    {
        return $this->morphTo();
    }

    public function deletor()
    {
        return $this->morphTo();
    }
}

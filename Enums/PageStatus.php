<?php

namespace Ansta\LaraCms\Enums;

final class PageStatus
{
    const STATUS_DRAFT = 10;
    const STATUS_REVIEW = 20;
    const STATUS_PUBLISH = 30;
    const STATUS_EDITED = 40;
    const STATUS_EDITING = 50;
    const STATUS_SCHEDULED = 60
    const STATUS_PROCESSING = 70;
    const STATUS_LIVE = 80;

    public static $names = [
        self::STATUS_DRAFT => 'draft',
        self::STATUS_REVIEW => 'review',
        self::STATUS_PUBLISH => 'published',
        self::STATUS_EDITED => 'edited',
        self::STATUS_EDITING => 'editing',
        self::STATUS_SCHEDULED => 'scheduled',
        self::STATUS_PROCESSING => 'processing',
        self::STATUS_LIVE => 'live',
    ];

}

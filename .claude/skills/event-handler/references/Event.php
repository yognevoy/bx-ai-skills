<?php

namespace Vendor\Example\App\Event;

abstract class Event
{
    /**
     * @return string
     */
    abstract public static function getFromModuleId(): string;

    /**
     * @return string
     */
    abstract public static function getEventName(): string;
}

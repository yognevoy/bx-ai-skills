<?php

namespace Vendor\Example\App\Event;

class OnProlog
{
    public static function getFromModuleId(): string
    {
        return 'main';
    }

    public static function getEventName(): string
    {
        return 'OnProlog';
    }

    public static function handle(): void
    {
        // Логика обработчика события
    }
}

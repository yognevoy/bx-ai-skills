<?php

use Bitrix\Main\EventManager;
use Vendor\Example\App\Event\OnProlog;

/**
 * Фрагмент install/index.php модуля.
 *
 * В методе doInstall() вызывается $this->installEvents().
 * В методе doUninstall() вызывается $this->unInstallEvents().
 */
class vendor_example extends CModule
{
    // ...

    public function installEvents(): void
    {
        $em = EventManager::getInstance();
        foreach ($this->getEventsData() as $eventData) {
            $em->registerEventHandler(...$eventData);
        }
    }

    public function unInstallEvents(): void
    {
        $em = EventManager::getInstance();
        foreach ($this->getEventsData() as $eventData) {
            $em->unRegisterEventHandler(...$eventData);
        }
    }

    protected function getEventsData(): array
    {
        return [
            [
                OnProlog::getFromModuleId(),
                OnProlog::getEventName(),
                'vendor.example',
                OnProlog::class,
                'handle',
            ],
        ];
    }
}

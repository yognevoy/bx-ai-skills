<?php

namespace Sprint\Migration;

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Sprint\Migration\Exceptions\MigrationException;
use Vendor\Example\App\Event\OnProlog;

class ExampleEventsMigration extends Version
{
    protected $author = 'author_login';
    protected $moduleVersion = '5.4.1';
    protected $description = 'Регистрирует обработчик события OnProlog';

    private const MODULE_ID = 'vendor.example';

    public function up()
    {
        $this->requireModule();
        $this->installEvents();
    }

    public function down()
    {
        $this->requireModule();
        $this->unInstallEvents();
    }

    protected function installEvents(): void
    {
        $eventManager = EventManager::getInstance();
        $className = OnProlog::class;

        $handler = $this->getEventHandler(
            OnProlog::getFromModuleId(),
            OnProlog::getEventName(),
            self::MODULE_ID,
            $className
        );

        if (empty($handler)) {
            $eventManager->registerEventHandler(
                fromModuleId: OnProlog::getFromModuleId(),
                eventType: OnProlog::getEventName(),
                toModuleId: self::MODULE_ID,
                toClass: $className,
                toMethod: 'handle'
            );
        }
    }

    protected function unInstallEvents(): void
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler(
            fromModuleId: OnProlog::getFromModuleId(),
            eventType: OnProlog::getEventName(),
            toModuleId: self::MODULE_ID,
            toClass: OnProlog::class,
            toMethod: 'handle'
        );
    }

    protected function getEventHandler(
        string $eventModuleId,
        string $eventType,
        string $moduleName,
        string $className
    ): ?array
    {
        $eventManager = EventManager::getInstance();

        $events = $eventManager->findEventHandlers(
            $eventModuleId,
            $eventType,
            [$moduleName]
        );

        $events = array_filter($events, function ($event) use ($className) {
            return $event['TO_CLASS'] == $className;
        });

        if (!empty($events)) {
            return current($events);
        }

        return null;
    }

    protected function requireModule(): void
    {
        if (!ModuleManager::isModuleInstalled(self::MODULE_ID)) {
            throw new MigrationException(sprintf('Module %s not installed.', self::MODULE_ID));
        }
        Loader::includeModule(self::MODULE_ID);
    }
}

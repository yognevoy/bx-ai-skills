<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class vendor_example extends CModule
{
    /** @var string */
    public $MODULE_ID;
    /** @var string */
    public $MODULE_NAME;
    /** @var string */
    public $MODULE_VERSION;
    /** @var string */
    public $MODULE_VERSION_DATE;
    /** @var string */
    public $MODULE_DESCRIPTION;
    /** @var string */
    public $PARTNER_NAME;
    /** @var string */
    public $PARTNER_URI;
    /** @var string */
    public $MODULE_GROUP_RIGHTS;
    /** @var string */
    protected string $messPrefix;
    public EventManager $eventManager;

    public function __construct()
    {
        $this->setModuleData(get_class($this));
        $this->setVersionData();
        $this->eventManager = EventManager::getInstance();
    }

    public function doInstall(): void
    {
        $this->registerModule();
        $this->installDB();
        $this->installEvents();
        $this->installFiles();
    }

    public function doUninstall(): void
    {
        $this->unInstallDB();
        $this->unInstallEvents();
        $this->unregisterModule();
    }

    protected function setModuleData(string $className): void
    {
        $this->messPrefix = strtoupper($className);
        $this->MODULE_ID = str_replace('_', '.', $className);
        $this->MODULE_NAME = Loc::getMessage("{$this->messPrefix}_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("{$this->messPrefix}_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage("{$this->messPrefix}_MODULE_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("{$this->messPrefix}_MODULE_PARTNER_URI");
        $this->MODULE_GROUP_RIGHTS = 'Y';
    }

    protected function setVersionData(): void
    {
        $arModuleVersion = [];

        require_once __DIR__ . '/version.php';

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    protected function registerModule(): void
    {
        if (!ModuleManager::isModuleInstalled($this->MODULE_ID)) {
            ModuleManager::registerModule($this->MODULE_ID);
        }
    }

    protected function unregisterModule(): void
    {
        if (ModuleManager::isModuleInstalled($this->MODULE_ID)) {
            ModuleManager::unRegisterModule($this->MODULE_ID);
        }
    }

    private function getEntities(): array
    {
        return [];
    }

    public function installDB(): void
    {
        foreach ($this->getEntities() as $entity) {
            if (!Application::getConnection($entity::getConnectionName())->isTableExists($entity::getTableName())) {
                Base::getInstance($entity)->createDbTable();
            }
        }
    }

    public function unInstallDB(): void
    {
        $connection = Application::getConnection();

        foreach ($this->getEntities() as $entity) {
            if (Application::getConnection($entity::getConnectionName())->isTableExists($entity::getTableName())) {
                $connection->dropTable($entity::getTableName());
            }
        }
    }

    public function installEvents(): void
    {
    }

    public function unInstallEvents(): void
    {
    }

    public function installFiles(): void
    {
    }
}

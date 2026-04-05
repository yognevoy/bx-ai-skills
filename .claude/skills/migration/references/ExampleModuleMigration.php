<?php

namespace Sprint\Migration;

use Bitrix\Main\ModuleManager;
use CModule;
use RuntimeException;
use Throwable;

class ExampleModuleMigration extends Version
{
    protected $author = "author_login";

    protected $description = 'Устанавливает модуль vendor.example';

    protected $moduleVersion = "5.4.1";

    protected const MODULES = [
        'vendor.example',
    ];

    public function up()
    {
        foreach (self::MODULES as $module) {
            $this->installModule($module);
        }
    }

    public function down()
    {
        foreach (array_reverse(self::MODULES) as $module) {
            $this->uninstallModule($module);
        }
    }

    protected function installModule(string $code): void
    {
        if (ModuleManager::isModuleInstalled($code)) {
            $this->outInfo(sprintf('Module %s already installed.', $code));
            return;
        }

        try {
            $installer = CModule::CreateModuleObject($code);
            if (!$installer) {
                throw new RuntimeException(sprintf('Module %s installer not found', $code));
            }
            $installer->DoInstall();
        } catch (Throwable $e) {
            throw new RuntimeException(sprintf("Can't install module %s: %s", $code, $e->getMessage()));
        }

        if (!ModuleManager::isModuleInstalled($code)) {
            throw new RuntimeException(sprintf('Module %s not installed', $code));
        }
    }

    protected function uninstallModule(string $code): void
    {
        if (!ModuleManager::isModuleInstalled($code)) {
            $this->outInfo(sprintf('Module %s not installed.', $code));
            return;
        }

        try {
            $installer = CModule::CreateModuleObject($code);
            if (!$installer) {
                throw new RuntimeException(sprintf('Module %s installer not found', $code));
            }
            $installer->DoUninstall();
        } catch (Throwable $e) {
            throw new RuntimeException(sprintf("Can't uninstall module %s: %s", $code, $e->getMessage()));
        }

        if (ModuleManager::isModuleInstalled($code)) {
            throw new RuntimeException(sprintf('Module %s not uninstalled', $code));
        }
    }
}

<?php

namespace Sprint\Migration;

use Bitrix\Main\Application;
use Bitrix\Main\DB\Connection;
use Bitrix\Main\Loader;
use Vendor\Example\Infra\Orm\ExampleTable;
use RuntimeException;

class ExampleTableMigration extends Version
{
    protected $author = "author_login";

    protected $description = 'Создаёт таблицу example_table для модуля vendor.example';

    protected $moduleVersion = "5.4.1";

    protected const string MODULE_ID = 'vendor.example';

    public function up(): bool
    {
        if (!Loader::includeModule(self::MODULE_ID)) {
            $this->outError(sprintf('Module %s is not installed', self::MODULE_ID));
            return false;
        }

        $this->installDb();

        return true;
    }

    public function down(): bool
    {
        if (!Loader::includeModule(self::MODULE_ID)) {
            $this->outError(sprintf('Module %s is not installed', self::MODULE_ID));
            return false;
        }

        $this->unInstallDb();

        return true;
    }

    protected function installDb(): void
    {
        $connection = $this->getConnection();
        $tableName = ExampleTable::getTableName();

        if ($connection->isTableExists($tableName)) {
            $connection->dropTable($tableName);
        }

        ExampleTable::getEntity()->createDbTable();
    }

    protected function unInstallDb(): void
    {
        $connection = $this->getConnection();
        $tableName = ExampleTable::getTableName();

        if ($connection->isTableExists($tableName)) {
            $connection->dropTable($tableName);
        }
    }

    protected function getConnection(): Connection
    {
        $connection = Application::getConnection();
        if ($connection instanceof Connection) {
            return $connection;
        }
        throw new RuntimeException(
            'Application::getConnection() must return instance of \Bitrix\Main\DB\Connection'
        );
    }
}

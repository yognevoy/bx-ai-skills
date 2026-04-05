<?php

namespace Sprint\Migration;

class ExampleSqlMigration extends Version
{
    protected $author = "author_login";

    protected $description = 'Добавляет колонку is_repeatable в таблицу example_table';

    protected $moduleVersion = "5.4.1";

    public function up()
    {
        $this->runSqlRequests([
            "ALTER TABLE example_table ADD COLUMN is_repeatable BOOLEAN NOT NULL DEFAULT 1;",
        ]);
    }

    public function down()
    {
        $this->runSqlRequests([
            "ALTER TABLE example_table DROP COLUMN is_repeatable;",
        ]);
    }

    protected function runSqlRequests(array $requests): void
    {
        $conn = \Bitrix\Main\Application::getConnection();

        foreach ($requests as $request) {
            $conn->query($request);
        }
    }
}

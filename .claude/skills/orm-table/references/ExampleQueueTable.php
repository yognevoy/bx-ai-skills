<?php

namespace Vendor\Module\Tables;

use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\EnumField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Vendor\Module\Domain\Enum\ExampleStatus;

// Пример таблицы-очереди
class ExampleQueueTable extends Data\DataManager
{
    public static function getTableName(): string
    {
        return 'vendor_module_example_queue';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID')
                ->configurePrimary()
                ->configureAutocomplete(),
            new IntegerField('ENTITY_ID')
                ->configureRequired(),
            new DatetimeField('CREATED_AT')
                ->configureRequired(),
            new DatetimeField('PROCESSED_AT')
                ->configureNullable(),
            new EnumField('STATUS')
                ->configureValues(ExampleStatus::getCases())
                ->configureRequired(),
            new IntegerField('RETRY_COUNT')
                ->configureDefaultValue(0)
                ->configureRequired(),
        ];
    }
}

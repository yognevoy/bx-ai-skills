<?php

namespace Vendor\Module\Tables;

use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

// Пример таблицы-связки (составной первичный ключ)
class ExampleRelationTable extends Data\DataManager
{
    public static function getTableName()
    {
        return 'vendor_module_example_relation';
    }

    public static function getMap()
    {
        return [
            new IntegerField('EXAMPLE_ID')
                ->configurePrimary(),
            new IntegerField('RELATED_ID')
                ->configurePrimary(),
            (new StringField('RELATION_TYPE')),
        ];
    }
}

<?php

namespace Vendor\Module\Tables;

use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Fields\ArrayField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\Type\DateTime;

class ExampleTable extends Data\DataManager
{
    public static function getTableName()
    {
        return 'vendor_module_example';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID')
                ->configurePrimary()
                ->configureAutocomplete(),
            new IntegerField('CREATED_BY')
                ->configureDefaultValue(static function () {
                    return CurrentUser::get()->getId() ?? 0;
                }),
            new DatetimeField('CREATED_AT')
                ->configureDefaultValue(static function () {
                    return new DateTime();
                }),
            new DatetimeField('UPDATED_AT')
                ->configureDefaultValue(static function () {
                    return new DateTime();
                }),
            (new IntegerField('OWNER_ID')),
            (new StringField('TITLE')),
            (new StringField('STATUS')),
            new TextField('DESCRIPTION')
                ->configureNullable(),
            new BooleanField('IS_ACTIVE')
                ->configureDefaultValue(static function () {
                    return true;
                }),
            new ArrayField('TAGS')
                ->addValidator(new LengthValidator(0, 65535)),
        ];
    }
}

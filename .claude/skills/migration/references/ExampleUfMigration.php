<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;

class ExampleUfMigration extends Version
{
    protected $author = "author_login";

    protected $description = 'Добавляет пользовательское поле UF_CRM_EXAMPLE_FIELD';

    protected $moduleVersion = "5.4.1";

    public function __construct()
    {
        Loader::includeModule('crm');
    }

    public function up()
    {
        $this->getHelperManager()->UserTypeEntity()->saveUserTypeEntity([
            'ENTITY_ID'          => 'CRM_CONTACT',
            'FIELD_NAME'         => 'UF_CRM_EXAMPLE_FIELD',
            'USER_TYPE_ID'       => 'string',
            'XML_ID'             => 'UF_CRM_EXAMPLE_FIELD',
            'SORT'               => '100',
            'MULTIPLE'           => 'N',
            'MANDATORY'          => 'N',
            'SHOW_FILTER'        => 'E',
            'SHOW_IN_LIST'       => 'Y',
            'EDIT_IN_LIST'       => 'Y',
            'IS_SEARCHABLE'      => 'Y',
            'EDIT_FORM_LABEL'    => ['en' => 'Example Field', 'ru' => 'Пример поля'],
            'LIST_COLUMN_LABEL'  => ['en' => 'Example Field', 'ru' => 'Пример поля'],
            'LIST_FILTER_LABEL'  => ['en' => 'Example Field', 'ru' => 'Пример поля'],
        ]);
    }

    public function down()
    {
        $this->getHelperManager()->UserTypeEntity()->deleteUserTypeEntity(
            'CRM_CONTACT',
            'UF_CRM_EXAMPLE_FIELD'
        );
    }
}

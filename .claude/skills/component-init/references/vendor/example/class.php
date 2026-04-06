<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;

class VendorExampleComponent extends \CBitrixComponent implements Controllerable
{
    public function __construct($component = null)
    {
        if (!Loader::includeModule('vendor.example')) {
            \ShowError('vendor.example module not included');
            return;
        }

        parent::__construct($component);
    }

    protected function listKeysSignedParameters(): array
    {
        return [];
    }

    public function configureActions(): array
    {
        return [];
    }

    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }
}

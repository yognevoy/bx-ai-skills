<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;

class VendorExampleController extends Controller
{
    protected function init(): void
    {
        if (!Loader::includeModule('vendor.example')) {
            $this->errorCollection[] = new Error('vendor.example module not included.');
        }

        parent::init();
    }

    public function getItemAction(int $id): ?array
    {
        return null;
    }
}

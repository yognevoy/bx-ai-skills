<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arActivityDescription = [
    "NAME" => Loc::getMessage("BPEA_DESCR_NAME"),
    "DESCRIPTION" => Loc::getMessage("BPEA_DESCR_DESCR"),
    "TYPE" => "activity",
    "CLASS" => "ExampleActivity",
    "JSCLASS" => "BizProcActivity",
    "CATEGORY" => [
        "ID" => "other",
    ],
];

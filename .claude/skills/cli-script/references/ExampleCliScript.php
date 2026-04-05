<?php

use Bitrix\Main\Loader;

if (php_sapi_name() !== 'cli') {
    die('Only CLI usage allowed');
}

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
}
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/bitrix/modules/main/cli/bootstrap.php';

while (ob_get_level() > 0) {
    ob_end_clean();
}

Loader::includeModule('vendor.module');

// логика скрипта

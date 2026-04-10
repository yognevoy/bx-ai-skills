<?php

/**
 * Работа с JSON
 */

// Старое ядро
$json = CUtil::PhpToJSObject($data);

// D7
use Bitrix\Main\Web\Json;

$json = Json::encode($data);
$data = Json::decode($json);

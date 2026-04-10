<?php

/**
 * Подключение модулей
 */

// Старое ядро
CModule::IncludeModule("iblock");
CModule::IncludeModuleEx("vendor.tips");

// D7
use Bitrix\Main\Loader;

Loader::includeModule("iblock");
Loader::includeSharewareModule("vendor.tips");

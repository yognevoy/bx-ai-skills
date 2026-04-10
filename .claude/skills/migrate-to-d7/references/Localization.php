<?php

/**
 * Локализация (языковые файлы и сообщения)
 */

// Старое ядро
IncludeTemplateLangFile(__FILE__);
IncludeModuleLangFile(__FILE__);
echo GetMessage("MY_COMPONENT_TITLE");

// D7
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
echo Loc::getMessage("MY_COMPONENT_TITLE");

<?php

/**
 * События: регистрация, удаление, поиск обработчиков
 */

// Старое ядро
// Временный обработчик (до конца хита)
$handler = AddEventHandler("main", "OnUserLoginExternal", [
    "Vendor\\Module\\EventHandlers",
    "onUserLoginExternal",
]);
RemoveEventHandler("main", "OnUserLoginExternal", $handler);

// Постоянный обработчик
RegisterModuleDependences(
    "main",
    "OnProlog",
    $this->MODULE_ID,
    "Vendor\\Module\\EventHandlers",
    "onProlog"
);
UnRegisterModuleDependences(
    "main",
    "OnProlog",
    $this->MODULE_ID,
    "Vendor\\Module\\EventHandlers",
    "onProlog"
);
$handlers = GetModuleEvents("main", "OnProlog", true);

// D7
use Bitrix\Main\EventManager;

// Временный обработчик (до конца хита)
// Обработчик получит объект Bitrix\Main\Event.
// Если нужны старые аргументы, используй addEventHandlerCompatible.
$handler = EventManager::getInstance()->addEventHandler(
    "main",
    "OnUserLoginExternal",
    ["Vendor\\Module\\EventHandlers", "onUserLoginExternal"]
);
EventManager::getInstance()->removeEventHandler("main", "OnUserLoginExternal", $handler);

// Постоянный обработчик
// Для совместимости со старым форматом аргументов, registerEventHandlerCompatible.
EventManager::getInstance()->registerEventHandler(
    "main",
    "OnProlog",
    $this->MODULE_ID,
    "Vendor\\Module\\EventHandlers",
    "onProlog"
);
EventManager::getInstance()->unRegisterEventHandler(
    "main",
    "OnProlog",
    $this->MODULE_ID,
    "Vendor\\Module\\EventHandlers",
    "onProlog"
);
$handlers = EventManager::getInstance()->findEventHandlers("main", "OnProlog");

<?php

/**
 * Отладка и логирование
 */

// Старое ядро
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/my-debug.log");
AddMessage2Log($_SERVER);
echo "<pre>" . mydump($_SERVER) . "</pre>";

// D7
use Bitrix\Main\Diag\Debug;

// Запись в файл
Debug::writeToFile($_SERVER, "label", "/bitrix/my-debug.log");

// Вывод на экран
Debug::dump($_SERVER);

// Замер времени
Debug::startTimeLabel("myBlock");
// Код
Debug::endTimeLabel("myBlock");
print_r(Debug::getTimeLabels());

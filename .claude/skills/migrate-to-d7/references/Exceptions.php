<?php

/**
 * Обработка ошибок и исключений
 */

// Старое ядро
global $APPLICATION;
$APPLICATION->ResetException();
$APPLICATION->ThrowException("Something went wrong");
if ($exception = $APPLICATION->GetException()) {
    echo $exception->GetString();
}

// D7
use Bitrix\Main\SystemException;

try {
    // ...
    throw new SystemException("Something went wrong");
} catch (SystemException $exception) {
    echo $exception->getMessage();
}

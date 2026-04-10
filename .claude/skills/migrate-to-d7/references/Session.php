<?php

/**
 * Сессия
 */

// Старое ядро
$_SESSION["my_key"] = "value";
$value = $_SESSION["my_key"];
unset($_SESSION["my_key"]);

// D7
use Bitrix\Main\Application;

$session = Application::getInstance()->getSession();
$session["my_key"] = "value";
$value = $session["my_key"];
unset($session["my_key"]);

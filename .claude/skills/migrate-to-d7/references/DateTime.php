<?php

/**
 * Дата и время
 */

// Старое ядро
$timestamp = MakeTimeStamp("25.12.2024 10:00:00");
$formatted = ConvertDateTime(date("d.m.Y H:i:s"), "YYYY-MM-DD HH:MI:SS");

// D7
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;

// Создание объектов
$date = new Date("2024-12-25", "Y-m-d");
$dateTime = new DateTime("2024-12-25 10:00:00", "Y-m-d H:i:s");

// Текущий момент
$now = new DateTime();

// Из timestamp
$dateTime = DateTime::createFromTimestamp($timestamp);

// Форматирование
$formatted = $dateTime->format("d.m.Y H:i:s");

// Арифметика
$dateTime->add("+1 day");    // +1 день
$dateTime->add("+2 hours");   // +2 часа

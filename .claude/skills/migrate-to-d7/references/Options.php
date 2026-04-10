<?php

/**
 * Настройки модулей
 */

// Старое ядро
COption::SetOptionString("main", "max_file_size", "1024");
COption::SetOptionInt("main", "max_file_size", 1024);
$size = COption::GetOptionString("main", "max_file_size");
$size = COption::GetOptionInt("main", "max_file_size");
COption::RemoveOption("main", "max_file_size", "s1");

// D7
use Bitrix\Main\Config\Option;

Option::set("main", "max_file_size", "1024");
$size = Option::get("main", "max_file_size");
Option::delete("main", [
    "name" => "max_file_size",
    "site_id" => "s1",
]);

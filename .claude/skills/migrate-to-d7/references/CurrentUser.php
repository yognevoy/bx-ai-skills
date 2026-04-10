<?php

/**
 * Текущий пользователь
 */

// Старое ядро
global $USER;
$id = $USER->GetID();
$login = $USER->GetLogin();
$isAdmin = $USER->IsAdmin();

// D7
use Bitrix\Main\Engine\CurrentUser;

$user = CurrentUser::get();
$id = $user->getId();
$login = $user->getLogin();
$isAdmin = $user->isAdmin();

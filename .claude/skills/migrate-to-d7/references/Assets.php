<?php

/**
 * Подключение скриптов, стилей, строк в <head>
 */

// Старое ядро
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/app.js");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/styles/app.css");
$APPLICATION->AddHeadString("<link rel='shortcut icon' href='/local/images/favicon.ico' />");

// D7
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app.js");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/styles/app.css");
Asset::getInstance()->addString("<link rel='shortcut icon' href='/local/images/favicon.ico' />");

// В шаблоне компонента (template.php)
$this->addExternalJS("/local/js/app.js");
$this->addExternalCss("/local/styles/app.css");

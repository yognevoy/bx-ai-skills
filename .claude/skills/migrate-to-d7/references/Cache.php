<?php

/**
 * Кеширование
 */

$cacheTime = 3600;
$cacheId = "my_cache_key";
$cacheDir = "/my_module/";

// Старое ядро
$cache = new CPHPCache();
if ($cache->InitCache($cacheTime, $cacheId, $cacheDir)) {
    $result = $cache->GetVars();
} elseif ($cache->StartDataCache()) {
    $result = [];
    // Формирование данных
    if ($isInvalid) {
        $cache->AbortDataCache();
    }
    $cache->EndDataCache($result);
}

// D7
use Bitrix\Main\Data\Cache;

$cache = Cache::createInstance();
if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
    $result = $cache->getVars();
} elseif ($cache->startDataCache()) {
    $result = [];
    // Формирование данных
    if ($isInvalid) {
        $cache->abortDataCache();
    }
    $cache->endDataCache($result);
}

<?php

use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Data\TaggedCache;
use Vendor\Module\Model\ExampleTable;

// Simple cache
$cache = Cache::createInstance();
$cacheId = md5(serialize(['example_list', $filter]));
$cachePath = '/vendor/module/example/';
$cacheTtl = 3600;

if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
    $rows = $cache->getVars();
} elseif ($cache->startDataCache()) {
    $rows = ExampleTable::getList(['filter' => $filter])->fetchAll();
    $cache->endDataCache($rows);
}

// Invalidation by path
$cache = Cache::createInstance();
$cache->cleanDir('/vendor/module/example/');


// Managed cache
$managedCache = Application::getInstance()->getManagedCache();
$cacheId = 'vendor_module_config';
$cacheTtl = 86400;

if ($managedCache->read($cacheTtl, $cacheId)) {
    $config = $managedCache->get($cacheId);
} else {
    $tagCache = new TaggedCache();
    $tagCache->startTagCache('/vendor/module/');

    $config = /* ... */
        [];

    $managedCache->set($cacheId, $config);
    $tagCache->registerTag('vendor_module_config');
    $tagCache->endTagCache();
}

// Invalidation by tag
$tagCache = new TaggedCache();
$tagCache->clearByTag('vendor_module_config');


// ORM query cache
$rows = ExampleTable::getList([
    'filter' => ['=ACTIVE' => 'Y'],
    'order' => ['SORT' => 'ASC'],
    'cache' => [
        'ttl' => 3600,
        'cache_joins' => true,
    ],
])->fetchAll();

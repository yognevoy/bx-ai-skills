---
name: cache
description: >
  Implements caching using Bitrix D7 API.
  Use when adding, modifying, or reviewing caching logic in services, repositories, or components.
argument-hint: "[file path or description of what to cache]"
allowed-tools: Glob Read Write Edit
---

Add or fix caching in: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they define the expected code style.

## Cache types

### 1. Simple cache — `\Bitrix\Main\Data\Cache`

**When to use:** caching arbitrary data (query results, computed values, external API responses).
General-purpose choice when managed cache is not available or tag-based invalidation is not needed.

```php
use Bitrix\Main\Data\Cache;

$cache = Cache::createInstance();
$cacheId   = md5(serialize(['entity', $id]));
$cachePath = '/vendor/module/entity/';
$cacheTtl  = 3600;

if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
    $result = $cache->getVars();
} elseif ($cache->startDataCache()) {
    $result = /* ... compute ... */;
    $cache->endDataCache($result);
}
```

Invalidation by path (clears all cache in the directory):

```php
$cache = Cache::createInstance();
$cache->cleanDir('/vendor/module/entity/');
```

---

### 2. Managed cache — `Application::getManagedCache()`

**When to use:** data that changes rarely but must be invalidated immediately when it does change
(e.g. component output, page blocks, assembled catalogs). Automatically clears related cache entries
via tags when the underlying data is updated.
**Do not use** for frequently updated or large datasets — the overhead of tag tracking is not justified.

```php
use Bitrix\Main\Application;
use Bitrix\Main\Data\TaggedCache;

$managedCache = Application::getInstance()->getManagedCache();
$cacheId  = 'vendor_module_config';
$cacheTtl = 86400;

if ($managedCache->read($cacheTtl, $cacheId)) {
    $result = $managedCache->get($cacheId);
} else {
    $result = /* ... compute ... */;
    $managedCache->set($cacheId, $result);
}
```

Tag-based invalidation (preferred over `clean` by key):

```php
$tagCache = new TaggedCache();
$tagCache->startTagCache('/vendor/module/');
$managedCache->set($cacheId, $result);
$tagCache->registerTag('vendor_module_config');
$tagCache->endTagCache();

// Invalidate:
$tagCache = new TaggedCache();
$tagCache->clearByTag('vendor_module_config');
```

Manual invalidation by key:

```php
Application::getInstance()->getManagedCache()->clean($cacheId);
```

---

### 3. ORM query cache — `cache` parameter in `getList()`

**When to use:** caching ORM queries that are called frequently and whose results change only on
entity mutations. Invalidated automatically when the entity is modified via ORM.

```php
$rows = SomeTable::getList([
    'filter' => ['=ACTIVE' => 'Y'],
    'order'  => ['SORT' => 'ASC'],
    'cache'  => [
        'ttl'         => 3600,
        'cache_joins' => true,
    ],
])->fetchAll();
```

`cache_joins => true` also caches joined tables. Cache is stored in `/bitrix/managed_cache/MYSQL/`
and keyed by the MD5 of the SQL query.

---

## Constraints

### MUST DO

- Build cache keys with `md5(serialize([...]))` from all parameters that affect the result
- Cache `null` and empty arrays — avoid repeated DB hits on missing data
- Define TTL, path, and tag as constants in the class — not inline magic values
- Cache only at the repository or service layer — not inside components or controllers
- Include the user ID in key and tag for user-specific data

### MUST NOT DO

- **Cache `Result` objects** — cache plain arrays or scalars instead
- **Use a shared cache key for user-specific data** — always include the user ID in key and tag
- **Add caching speculatively** — only when the caller is on a hot path or the query is expensive
- **Use managed cache for frequently updated data** — the tag-tracking overhead is not justified

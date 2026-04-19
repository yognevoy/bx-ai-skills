---
name: transaction
description: >
  Wraps multiple database operations in a transaction.
  Use when several writes must succeed together: if any fails, all changes are rolled back.
argument-hint: "[file path or description of what to wrap]"
allowed-tools: Glob Read Write Edit
---

Wrap the operations in a transaction: $ARGUMENTS

## Pattern

```php
use Bitrix\Main\Application;

$conn = Application::getConnection();
$conn->startTransaction();

try {
    // ... operations ...
    $conn->commitTransaction();
} catch (\Throwable $e) {
    $conn->rollbackTransaction();
    throw $e;
}
```

## Rules

- Always re-throw the exception after rollback — never swallow it.
- Do not wrap a single write in a transaction; it adds overhead without benefit.
- Do not nest transactions — get the connection once and pass it down if needed.

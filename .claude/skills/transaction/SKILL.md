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

## Constraints

### MUST DO

- Always re-throw the exception after rollback

### MUST NOT DO

- **Swallow the exception after rollback** — always re-throw; never catch without re-throwing
- **Wrap a single write in a transaction** — adds overhead without benefit
- **Nest transactions** — get the connection once and pass it down if needed

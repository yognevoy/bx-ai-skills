---
name: error-handling
description: >
  Guides error handling.
  Use when adding try/catch blocks, defining custom exceptions, or reviewing error handling logic.
argument-hint: "[file path or description]"
allowed-tools: Glob Read Write Edit
---

Add or fix error handling in: $ARGUMENTS

## Catch order

Catch specific exceptions before general ones. `\Throwable` is always last:

```php
try {
    // ...
} catch (NotFoundException $e) {
    // known — handle gracefully
} catch (DomainException $e) {
    throw $e;
} catch (\Throwable $e) {
    // unexpected — log, then re-throw or wrap
    throw $e;
}
```

## Constraints

### MUST DO

- Catch specific exceptions before general ones; `\Throwable` is always last
- Always log, re-throw, or return a meaningful result from every catch block

### MUST NOT DO

- **Silently swallow exceptions** — every catch block must log, re-throw, or return a meaningful result
- **Use `\Exception` as a catch-all** — use `\Throwable` (catches PHP errors too)
- **Add `try/catch` for code that cannot throw** — only wrap code paths that actually throw

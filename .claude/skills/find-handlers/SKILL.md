---
name: find-handlers
description: >
  Finds handlers for a specific event in the project. Use when you need to
  know where and how an event is handled.
argument-hint: "[event name] [module]"
allowed-tools: Grep Glob Read
---

Find all handlers for the event in the project. Arguments: $ARGUMENTS

## Clarify before starting (if not provided in arguments)

1. **Event name**
2. **Module** — optional, e.g. `main`, `crm`

## How to search

Handlers are registered in two ways:

**1. Via EventManager**
```php
EventManager::getInstance()->addEventHandler('module', 'EventName', ...);
```

**2. Via AddEventHandler**
```php
AddEventHandler('module', 'EventName', ...);
```

Search both patterns only within the `local/` directory.

## What to include in the response

For each handler found:

- **File** and **line number**
- **Callback** — function name, method, or closure (first ~5 lines if lambda)
- **Context** — which class/method it is registered in (if apparent)

If many handlers are found — group by file.

## Constraints

### MUST DO

- Search only within the `local/` directory
- Report the file path and line number for every handler found
- Group results by file when multiple handlers are found

### MUST NOT DO

- **Search in `bitrix/` or `vendor/`** — only project code in `local/` is relevant

## If nothing is found

State it explicitly and suggest:
- Checking the event name for typos
- Searching by partial match (e.g. `UserAdd` instead of `OnBeforeUserAdd`)

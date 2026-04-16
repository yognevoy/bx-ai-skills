---
name: explain-module
description: >
  Explains the purpose of a module.
  Use when you need to understand what a module does, its structure, and key capabilities.
argument-hint: "[vendor.modulename]"
allowed-tools: Read Glob Grep
---

Explain the purpose of the module. Arguments: $ARGUMENTS

## Clarify before starting (if not provided in arguments)

1. **Module code** — in `vendor.modulename` format

## How to find the module

Use Glob to find `**/modules/<name>/install/index.php`, where `<name>` is the module code from arguments.

## What to read

1. **`lang/ru/install/index.php`** — official module name and description
2. **`install/index.php`** — what gets registered on install: tables, agents, events, components
3. **`.settings.php`** — REST controllers (`controllers` section) and DI container services (`services` section)
4. **`include.php`** — what is loaded when the module starts
5. **`lib/`** — use Glob to find and read agent classes, event handler classes, and ORM table classes

Skip any files that don't exist.

## What to include in the response

### Purpose
1–2 sentences: what the module does and what it is used for.

### Key capabilities
Bulleted list: what the module registers or provides (components, agents, event handlers, REST methods, services).

### Code structure
Brief overview of namespaces and main classes from `lib/`.

### Tables
Database tables with a short description of stored data.

### Agents
List of agents with run interval and brief description of what each does.

### Event handlers
List of events the module listens to, with a description of what each handler does.

### Dependencies
List of modules this module depends on.

## If the module is not found

State it explicitly and suggest:
- Checking the module code for typos
- Searching by partial name via Glob (`**/*{partial_name}*/`)

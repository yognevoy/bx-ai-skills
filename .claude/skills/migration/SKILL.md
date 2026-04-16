---
name: migration
description: >
  Creates a sprint.migration file. Use when a migration is needed:
  table changes, UF fields, module settings, agents, mail events and templates,
  user groups, iblocks, HL-blocks, event handler registration.
argument-hint: "[ticket number] [short description]"
allowed-tools: Bash Glob Read Write
---

Create a sprint.migration file. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they define the expected code style.

## Clarify before generating (if not provided in arguments)

1. **Ticket number** — e.g. `PROJ-123`
2. **Short description** — what the migration does
3. **Migration type** — DDL (ALTER/CREATE TABLE), module install, UF field, other
4. **Author** — user login in the system

Ask for everything needed before generating.

## Naming rules

From ticket `PROJ-123` and description `example description`:

- Get current time: `date +%Y%m%d%H%M%S`
- Filename: `PROJ_123_exampleDescription20260405120000.php`
- Class name = filename without `.php`

Description in the filename — camelCase, Latin characters, no spaces, brief (2–3 words).

## Module version

Before filling `$moduleVersion`, read the current version from `**/sprint.migration/install/version.php`
(`$arModuleVersion['VERSION']`).

## sprint.migration helper classes

Before writing code, find the sprint.migration module via Glob (`**/sprint.migration/lib/helpers/*.php`) and check
if a suitable Helper exists. Access via `$this->getHelperManager()->HelperName()`.

Main helpers:

| Method             | What it does                                                      |
|--------------------|-------------------------------------------------------------------|
| `UserTypeEntity()` | UF fields: `saveUserTypeEntity()`, `deleteUserTypeEntityIfExists()` |
| `Agent()`          | Agents: `saveAgent()`, `deleteAgentIfExists()`                    |
| `Option()`         | Module options: `saveOption()`, `deleteOptions()`                 |
| `Event()`          | Mail events and templates                                         |
| `UserGroup()`      | Groups: `saveGroup()`, `getGroupId()`                             |
| `IBlock()`         | Iblocks, types, properties                                        |
| `HLBlock()`        | HL-blocks                                                         |

If a suitable Helper exists — use it instead of direct API calls.

## Where to save

Find the migrations directory via Glob (`**/migrations/PROJ_*.php`) and save next to existing files.

## After generation

Print the full path to the created file and the class name.

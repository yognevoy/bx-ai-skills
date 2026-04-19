---
name: cli-script
description: >
  Creates a CLI script. Use when a PHP script needs to be written to run
  from the command line.
argument-hint: "[filename] [short description]"
allowed-tools: Read Write Glob
---

Create a CLI script. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they define the expected code style.

## Clarify before generating (if not provided in arguments)

1. **Filename** — snake_case, e.g. `sync_contacts.php`
2. **What the script does**

Ask for everything needed before generating.

## Constraints

### MUST DO

- Use `exit(0)` / `exit(1)` to signal success or failure

### MUST NOT DO

- **Use web superglobals** (`$_GET`, `$_POST`, `$_SESSION`) — read arguments from `$argv` instead
- **Use `die()` for flow control** — use `exit()` with an appropriate status code

## After generation

Print the full path to the created file.

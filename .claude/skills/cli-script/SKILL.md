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

## After generation

Print the full path to the created file.

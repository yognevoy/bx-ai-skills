---
name: component-init
description: >
  Creates a component skeleton.
  Use when a new component needs to be created from scratch.
argument-hint: "[vendor:component.name] [description]"
allowed-tools: Bash Glob Read Write
---

Create a component skeleton. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/vendor/example/` — they define the exact file style and structure.

## Clarify before generating (if not provided in arguments)

1. **Component code** — in `vendor:component.name` format
2. **Description** — what the component does, one line

Ask for everything needed before generating.

## Generation rules

### Derive from component code `vendor:component.name`:

- **Vendor folder**: part before `:`, e.g. `vendor`
- **Component folder**: part after `:`, e.g. `component.name`
- **Component PHP class name**: convert each segment (`.`) to PascalCase, join, append `Component`,
  e.g. `vendor:my.component` → `VendorMyComponentComponent`
- **Controller PHP class name**: same, but append `Controller`

### File structure

```
{vendor}/
└── {component.name}/
    ├── class.php
    ├── ajax.php
    ├── lang/
    │   └── ru/
    │       ├── class.php
    │       ├── ajax.php
    │       └── templates/
    │           └── .default/
    │               ├── template.php
    │               └── script.php
    └── templates/
        └── .default/
            ├── template.php
            ├── style.css
            ├── script.js
            └── component_epilog.php
```

## Where to save

Find the components directory via Glob (`**/components/`) and create the `{vendor}/{component.name}/` folder
next to existing components.

## Constraints

### MUST DO

- Derive the PHP class name from the component code automatically
- Create a lang file for every generated PHP file

### MUST NOT DO

- **Put business logic in `class.php`** — delegate to services or repositories
- **Skip `ajax.php`** — it is always part of the skeleton even if initially empty

## After generation

Print the file tree of created files and the full path to the component root.

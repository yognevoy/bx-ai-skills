---
name: module-init
description: >
  Creates a module skeleton.
  Use when a new module needs to be created from scratch.
argument-hint: "[vendor.modulename] [name] [description] [partner] [partner url]"
allowed-tools: Bash Glob Read Write
---

Create a module skeleton. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/vendor.example/` — they define the exact file style and structure.

## Clarify before generating (if not provided in arguments)

1. **Module code** — in `vendor.modulename` format
2. **Module name** — shown in the admin panel
3. **Module description** — brief
4. **Partner name**
5. **Partner URL**

Ask for everything needed before generating.

## Generation rules

### Derive from module code `vendor.modulename`:

- **PHP class name**: replace `.` with `_`, e.g. `vendor_modulename`
- **Constants prefix**: UPPER_CASE of the class name, e.g. `VENDOR_MODULENAME`
- **Namespace**: convert each `_`-separated part to PascalCase, e.g. `\Vendor\Modulename`
    - Each segment after `.` becomes a new namespace level (`vendor.foo.bar` → `\Vendor\Foo\Bar`)
- **Controllers namespace**: `\Vendor\Modulename\App\Controller`

### Module version

In `install/version.php` use the current date in `YYYY-MM-DD 09:00:00` format. Get the current date with
`date +%Y-%m-%d`.

### File structure

```
{vendor.modulename}/
├── install/
│   ├── index.php       — module install/uninstall class
│   └── version.php     — version 1.0.0 and current date
├── lang/
│   └── ru/
│       └── install/
│           └── index.php   — language variables (name, description, partner)
├── .settings.php       — empty services list, namespace for controllers
└── include.php         — opening PHP tag only
```

## Where to save

Find the modules directory via Glob (`**/modules/`) and create the `{vendor.modulename}/` folder next to existing modules.

## After generation

Print the file tree of created files and the full path to the module root.

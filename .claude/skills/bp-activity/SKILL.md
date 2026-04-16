---
name: bp-activity
description: >
  Creates a business process activity. Use when a new activity needs to be
  added to the business process designer.
argument-hint: "[namespace] [ActivityName] [description] [properties...]"
allowed-tools: Read Write Glob
---

Create a business process designer activity. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they define the expected code style.

## Clarify before generating (if not provided in arguments)

1. **namespace** — subdirectory under `local/activities/`, e.g. `vendor`
2. **Activity name** — CamelCase without the `Activity` suffix, e.g. `SendNotification`
3. **Short description** — what the activity does (1–2 sentences)
4. **Properties** — list of parameters the user configures in the designer:
    - property name
    - type (`string`, `select`, `bool`, `int`, `user`, `date`, `datetime`)
    - required or not
    - for `select` — list of options

Ask for everything needed before generating.

## Conventions

### File layout

```
local/activities/{namespace}/{activityname}/
    .description.php
    {activityname}.php
    properties_dialog.php
    lang/ru/
        .description.php
        {activityname}.php
```

- `{activityname}` — **lowercase**, no spaces: `sendnotificationactivity`
- The directory name matches the class file name

### Naming

| Entity           | Rule                                                    | Example                       |
|------------------|---------------------------------------------------------|-------------------------------|
| Directory name   | lowercase, concatenated, with `activity` suffix         | `sendnotificationactivity`    |
| PHP class name   | `CBP` + CamelCase + `Activity`                          | `CBPSendNotificationActivity` |
| `CLASS` value    | CamelCase + `Activity` (without `CBP`)                  | `SendNotificationActivity`    |
| Lang prefix      | `BP` + initials of the activity name words + `_`        | `BPSNA_`                      |

### Lang prefix

Formed from the uppercase initials of the activity name words:

- `SendNotificationActivity` → `SNA` → prefix `BPSNA_`
- `UpdateEntityStatusActivity` → `UESA` → prefix `BPUESA_`

### Required lang keys

```
{PREFIX}DESCR_NAME              — name shown in the BP designer palette
{PREFIX}DESCR_DESCR             — description shown in the BP designer palette
{PREFIX}DESCR_{activityname}    — tracking result label (optional)
{PREFIX}PD_{PROPERTY}           — label for each field in the dialog
{PREFIX}EMPTY_{PROPERTY}        — validation error message (for Required fields)
{PREFIX}ACTIVITY_RESULT_SUCCESS — successful completion (written to tracking)
{PREFIX}ACTIVITY_RESULT_ERROR   — error (written to tracking)
```

## Field types (`getPropertiesMap`)

| Type       | Description                                              | Extra keys                                |
|------------|----------------------------------------------------------|-------------------------------------------|
| `string`   | Arbitrary string, supports document field substitution   | `Default`                                 |
| `text`     | Multi-line text                                          | `Default`                                 |
| `bool`     | Checkbox, value `'Y'` / `'N'`                            | `Default` (`'Y'` or `'N'`)                |
| `int`      | Integer                                                  | `Default`                                 |
| `double`   | Decimal number                                           | `Default`                                 |
| `select`   | Dropdown list                                            | `Options` (array), `Multiple`, `Default`  |
| `user`     | User selection from org structure                        | `Multiple`                                |
| `date`     | Date                                                     | `Default`                                 |
| `datetime` | Date and time                                            | `Default`                                 |
| `file`     | File                                                     | —                                         |

Every entry in `getPropertiesMap` must include:

- `Name` — localized label (`Loc::getMessage(...)`)
- `FieldName` — snake_case, unique within the activity
- `Type` — type from the table above
- `Required` — `true` or `false`

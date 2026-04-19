---
name: orm-table
description: >
  Creates an ORM DataManager table class. Use when a new database table
  needs to be created.
argument-hint: "[module] [EntityName] [fields...]"
allowed-tools: Read Write Glob
---

Create an ORM table. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they define the expected code style.

## Clarify before generating (if not provided in arguments)

1. **Module** — e.g. `vendor.module`
2. **Entity name** — e.g. `ExampleEntity`
3. **Fields** — list with types and constraints

Ask for everything needed before generating.

## Conventions

**Namespace and path** are derived from the module name:

- `vendor.module` → namespace `Vendor\Module\Tables`, file in `lib/tables/`
- `vendor.module.sub` → namespace `Vendor\Module\Sub\Tables`, file in `lib/tables/`

**DB table name** — `{vendor}_{module}_{entity}` in snake_case:

- module `vendor.module`, entity `ExampleEntity` → `vendor_module_example_entity`

**Field types:**

| Type            | Description                          |
|-----------------|--------------------------------------|
| `IntegerField`  | Integer                              |
| `StringField`   | String (VARCHAR)                     |
| `TextField`     | Long text (TEXT)                     |
| `DateField`     | Date                                 |
| `DatetimeField` | Date and time                        |
| `BooleanField`  | Boolean                              |
| `EnumField`     | Enumeration (values from an Enum)    |
| `ArrayField`    | Array serialized as TEXT             |

**Configuration methods:**

| Method                    | Description                                   |
|---------------------------|-----------------------------------------------|
| `configurePrimary()`      | Primary key                                   |
| `configureAutocomplete()` | Auto-increment                                |
| `configureNullable()`     | Allows NULL                                   |
| `configureRequired()`     | Required field (NOT NULL without default)     |
| `configureSize(int)`      | Maximum string length                         |
| `configureDefaultValue()` | Default value                                 |
| `configureValues(array)`  | Allowed values (for `EnumField`)              |

### EnumField

Values are taken via `getCases()` from an Enum (see `ExampleQueueTable.php` in references):

```php
(new EnumField('STATUS'))
    ->configureValues(ExampleStatus::getCases())
    ->configureRequired(),
```

The enum must implement the method:

```php
public static function getCases(): array
{
    return array_column(self::cases(), 'value');
}
```

## Constraints

### MUST DO

- Derive the DB table name automatically from the module code and entity name
- Always include a primary key field with `configurePrimary()` and `configureAutocomplete()`
- Use `getCases()` from an Enum for all `EnumField` values — never hardcode string arrays

### MUST NOT DO

- **Put business logic in the table class** — DataManager is a data layer; services and repositories go in `lib/`

## After generation

Remind the user to choose one of:

- Add table creation to the module installer (`install/index.php`)
- Create a migration via `sprint.migration`

---
name: lang-files
description: >
  Creates lang files with language variables.
  Use whenever user-facing text is added to a module, component, or JS extension file:
  messages, labels, headings, errors.
argument-hint: "[file path or description]"
allowed-tools: Bash Glob Read Write
---

Create lang file(s) for: $ARGUMENTS

## General rules

- Lang files always live in the `lang/ru/` subdirectory
- Each key is a line like `$MESS["VENDOR_MODULE_KEY"] = "Value";`
- Keys in UPPER_SNAKE_CASE, prefixed with the module/component code
- No PHP logic inside — only the `$MESS` array
- Opening `<?php` tag, no closing `?>`

## Rules by artifact type

### Module and PHP classes

Each PHP file gets its **own** lang file at the mirrored path inside `lang/ru/`:

| PHP file                       | Lang file                              |
|--------------------------------|----------------------------------------|
| `lib/Service/OrderService.php` | `lang/ru/lib/Service/OrderService.php` |
| `install/index.php`            | `lang/ru/install/index.php`            |

### Component

Each PHP file of the component gets its **own** lang file at the mirrored path inside `lang/ru/`:

| PHP file                          | Lang file                                 |
|-----------------------------------|-------------------------------------------|
| `class.php`                       | `lang/ru/class.php`                       |
| `templates/.default/template.php` | `lang/ru/templates/.default/template.php` |
| `templates/.default/script.php`   | `lang/ru/templates/.default/script.php`   |

### JS extension

One lang file for the entire extension: `lang/ru/config.php`.

Usage in JS:

```js
BX.message('VENDOR_MODULE_KEY')
```

## Lang file format

```php
<?php

$MESS['VENDOR_MODULE_TITLE'] = 'Title';
$MESS['VENDOR_MODULE_SAVE_BUTTON'] = 'Save';
$MESS['VENDOR_MODULE_ERROR_NOT_FOUND'] = 'Record not found';
```

## Key naming

- Prefix = module or component code in UPPER_SNAKE_CASE
- Suffix describes context: `_TITLE`, `_ERROR_*`, `_BUTTON_*`, `_LABEL_*`, `_SUCCESS_*`
- Avoid overly generic keys without a prefix

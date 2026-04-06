---
name: component-init
description: >
  Создаёт скелет компонента.
  Используй когда нужно создать новый компонент с нуля.
argument-hint: "[vendor:component.name] [описание]"
allowed-tools: Bash Glob Read Write
---

Создай скелет компонента. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/vendor/example/` — они задают точный стиль и структуру файлов.

## Что уточнить (если не указано в аргументах)

1. **Код компонента** — в формате `vendor:component.name`
2. **Описание** — что делает компонент, одной строкой

Спроси всё необходимое перед генерацией.

## Правила генерации

### Из кода компонента `vendor:component.name` вывести:

- **Папка вендора**: часть до `:`, например `vendor`
- **Папка компонента**: часть после `:`, например `component.name`
- **Имя PHP-класса компонента**: каждый сегмент (`.`) привести к PascalCase и соединить + `Component`,
  например `vendor:my.component` → `VendorMyComponentComponent`
- **Имя PHP-класса контроллера**: то же самое, но + `Controller`

### Структура файлов

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

## Куда сохранять

Найди директорию компонентов через Glob (`**/components/`) и создай папку `{vendor}/{component.name}/` рядом с
существующими компонентами.

## После генерации

Выведи дерево созданных файлов и полный путь к корню компонента.

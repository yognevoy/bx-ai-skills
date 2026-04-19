# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Назначение репозитория

Коллекция Claude Code скиллов для разработки Bitrix24. Скиллы находятся в `.claude/skills/{skill-name}/` и вызываются
через `/skill-name` в Claude Code.

## Структура скилла

```
.claude/skills/{skill-name}/
    SKILL.md          — frontmatter + инструкции (шаблон промпта)
    references/       — примеры PHP-файлов, задающие ожидаемый стиль кода
```

### Формат SKILL.md

```yaml
---
name: skill-name
description: Что делает скилл. Claude использует это для автоматической активации.
argument-hint: "[аргументы]"
allowed-tools: Read Write Glob
---
```

В теле промпта доступны переменные `$ARGUMENTS` и `${CLAUDE_SKILL_DIR}`.

### Ограничения SKILL.md

- Не упоминать реальные проекты, модули и имена из кодовой базы — только абстрактные примеры.
- Не упоминать Bitrix — это очевидный контекст.

## Добавление нового скилла

1. Создать `.claude/skills/{skill-name}/`
2. Добавить `SKILL.md` с frontmatter и инструкциями
3. Добавить `references/` с PHP-примерами в ожидаемом стиле вывода
4. Зарегистрировать скилл в таблице в `CLAUDE.md`
5. Добавить скилл в таблицу в `README.md`

## Доступные скиллы

| Скилл            | Описание                              |
|------------------|---------------------------------------|
| `orm-table`      | Создать класс ORM DataManager таблицы |
| `cli-script`     | Создать CLI-скрипт (php script.php)   |
| `migration`      | Создать миграцию sprint.migration     |
| `module-init`    | Создать скелет модуля                 |
| `component-init` | Создать скелет компонента             |
| `extension-init` | Создать скелет JS-расширения          |
| `find-handlers`  | Найти обработчики события в проекте   |
| `explain-module` | Объяснить назначение модуля           |
| `migrate-to-d7`  | Переписать устаревший API на D7       |
| `bp-activity`    | Создать активити БП                   |
| `lang-files`     | Создать lang-файлы для локализации    |
| `cache`          | Добавить кэширование                  |
| `transaction`    | Обернуть операции в транзакцию        |

Документация: https://code.claude.com/docs/en/skills

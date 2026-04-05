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

## Добавление нового скилла

1. Создать `.claude/skills/{skill-name}/`
2. Добавить `SKILL.md` с frontmatter и инструкциями
3. Добавить `references/` с PHP-примерами в ожидаемом стиле вывода
4. Зарегистрировать скилл в таблице в `CLAUDE.md`

## Доступные скиллы

| Скилл             | Описание                              |
|-------------------|---------------------------------------|
| `orm-table`       | Создать класс ORM DataManager таблицы |
| `cli-script`      | Создать CLI-скрипт (php script.php)   |
| `migration`       | Создать миграцию sprint.migration     |
| `module-init`     | Создать скелет модуля                 |

Документация: https://code.claude.com/docs/en/skills

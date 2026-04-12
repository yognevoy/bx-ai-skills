# bx-ai-skills

Коллекция Claude Code скиллов для разработки Битрикс24.

## Обзор

Скиллы автоматически активируются по описанию задачи или вызываются вручную через `/имя-скилла` в Claude Code.

## Скиллы

| Скилл                                                      | Описание                              |
|------------------------------------------------------------|---------------------------------------|
| [`orm-table`](.claude/skills/orm-table/SKILL.md)           | Создать класс ORM DataManager таблицы |
| [`cli-script`](.claude/skills/cli-script/SKILL.md)         | Создать CLI-скрипт                    |
| [`migration`](.claude/skills/migration/SKILL.md)           | Создать миграцию sprint.migration     |
| [`module-init`](.claude/skills/module-init/SKILL.md)       | Создать скелет модуля                 |
| [`component-init`](.claude/skills/component-init/SKILL.md) | Создать скелет компонента             |
| [`extension-init`](.claude/skills/extension-init/SKILL.md) | Создать скелет JS-расширения          |
| [`find-handlers`](.claude/skills/find-handlers/SKILL.md)   | Найти обработчики события в проекте   |
| [`explain-module`](.claude/skills/explain-module/SKILL.md) | Объяснить назначение модуля           |
| [`migrate-to-d7`](.claude/skills/migrate-to-d7/SKILL.md)   | Переписать устаревший API на D7       |
| [`event-handler`](.claude/skills/event-handler/SKILL.md)   | Создать обработчик события            |
| [`bp-activity`](.claude/skills/bp-activity/SKILL.md)       | Создать активити БП                   |

## Установка

Клонировать репозиторий и скопировать скиллы в свой проект:

```bash
git clone https://github.com/yognevoy/bx-ai-skills.git
cp -r bx-ai-skills/.claude/skills/ /путь/к/проекту/.claude/skills/
```

## Использование

Скиллы подхватываются автоматически. Описать задачу:

```
Создай ORM-таблицу для сущности CustomerTag в модуле vendor.module
```

Или вызвать скилл вручную:

```
/new-orm-table vendor.module CustomerTag
```

## Добавление нового скилла

1. Создать `.claude/skills/{skill-name}/`
2. Добавить `SKILL.md` с frontmatter и инструкциями
3. Добавить `references/` с примерами кода в ожидаемом стиле
4. Зарегистрировать скилл в таблице выше

## Лицензия

[MIT](https://github.com/yognevoy/bx-ai-skills/blob/main/LICENSE.txt)

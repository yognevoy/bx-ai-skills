# bx-ai-skills

Коллекция Claude Code скиллов для разработки Битрикс24.

## Обзор

Скиллы автоматически активируются по описанию задачи или вызываются вручную через `/имя-скилла` в Claude Code.

## Скиллы

| Скилл                                                    | Описание                              |
|----------------------------------------------------------|---------------------------------------|
| [`new-orm-table`](.claude/skills/new-orm-table/SKILL.md) | Создать класс ORM DataManager таблицы |

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

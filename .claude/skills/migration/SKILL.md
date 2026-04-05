---
name: migration
description: Создаёт файл миграции sprint.migration. Используй когда нужно создать миграцию.
argument-hint: "[номер тикета] [краткое описание]"
allowed-tools: Bash Glob Read Write
---

Создай миграцию sprint.migration. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/` — они задают стиль и паттерны кода.

## Что уточнить у пользователя (если не указано в аргументах)

1. **Номер тикета** — например `PROJ-123`
2. **Краткое описание** — на русском, что делает миграция
3. **Тип миграции** — DDL (ALTER/CREATE TABLE), установка модуля, UF-поле, другое
4. **Автор** — логин пользователя в системе

Спроси всё необходимое перед генерацией.

## Правила именования

Из тикета `PROJ-123` и описания `example description`:

- Получи текущее время: `date +%Y%m%d%H%M%S`
- Имя файла: `PROJ_123_exampleDescription20260405120000.php`
- Имя класса = имя файла без `.php`

Описание в имени файла — camelCase, латиница, без пробелов, кратко (2–3 слова).

## Версия модуля

Перед заполнением `$moduleVersion` прочитай актуальную версию из `**/sprint.migration/install/version.php` (`$arModuleVersion['VERSION']`).

## Helper-классы sprint.migration

Перед написанием кода найди модуль sprint.migration через Glob (`**/sprint.migration/lib/helpers/*.php`) и проверь, есть
ли подходящий Helper. Доступ через `$this->getHelperManager()->HelperName()`.

Основные хелперы:

| Метод              | Что делает                                                        |
|--------------------|-------------------------------------------------------------------|
| `UserTypeEntity()` | UF-поля: `saveUserTypeEntity()`, `deleteUserTypeEntityIfExists()` |
| `Agent()`          | Агенты: `saveAgent()`, `deleteAgentIfExists()`                    |
| `Option()`         | Опции модулей: `saveOption()`, `deleteOptions()`                  |
| `Event()`          | Почтовые события и шаблоны                                        |
| `UserGroup()`      | Группы: `saveGroup()`, `getGroupId()`                             |
| `IBlock()`         | Инфоблоки, типы, свойства                                         |
| `HLBlock()`        | HL-блоки                                                          |

Если подходящий Helper есть — используй его вместо прямых API-вызовов.

## Куда сохранять

Найди директорию миграций через Glob (`**/migrations/PROJ_*.php`) и сохрани рядом с существующими файлами.

## После генерации

Выведи полный путь к созданному файлу и имя класса.

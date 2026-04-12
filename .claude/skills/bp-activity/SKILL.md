---
name: bp-activity
description: >
  Создаёт активити БП. Используй когда нужно добавить новую активити в
  дизайнер бизнес-процессов.
argument-hint: "[namespace] [ActivityName] [описание] [свойства...]"
allowed-tools: Read Write Glob
---

Создай активити для дизайнера бизнес-процессов. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/` — они задают стиль кода.

## Что уточнить (если не указано в аргументах)

1. **namespace** — поддиректория в `local/activities/`, например `vendor`
2. **Имя активити** — CamelCase без суффикса Activity, например `SendNotification`
3. **Краткое описание** — что делает активити (1–2 предложения)
4. **Свойства** — список параметров, которые настраивает пользователь в дизайнере:
    - имя свойства
    - тип (`string`, `select`, `bool`, `int`, `user`, `date`, `datetime`)
    - обязательное или нет
    - для `select` — список значений

Спроси всё необходимое перед генерацией.

## Соглашения

### Размещение файлов

```
local/activities/{namespace}/{activityname}/
    .description.php
    {activityname}.php
    properties_dialog.php
    lang/ru/
        .description.php
        {activityname}.php
```

- `{activityname}` — имя в **нижнем регистре** без пробелов: `sendnotificationactivity`
- Директория называется так же, как файл класса

### Именование

| Сущность         | Правило                                           | Пример                        |
|------------------|---------------------------------------------------|-------------------------------|
| Имя директории   | нижний регистр, слитно, с суффиксом `activity`    | `sendnotificationactivity`    |
| Имя PHP-класса   | `CBP` + CamelCase + `Activity`                    | `CBPSendNotificationActivity` |
| Значение `CLASS` | CamelCase + `Activity` (без `CBP`)                | `SendNotificationActivity`    |
| Lang-префикс     | `BP` + аббревиатура из заглавных букв имени + `_` | `BPSNA_`                      |

### Lang-префикс

Образуется из заглавных букв слов имени активити:

- `SendNotificationActivity` → `SNA` → префикс `BPSNA_`
- `UpdateEntityStatusActivity` → `UESA` → префикс `BPUESA_`

### Обязательные lang-ключи

```
{PREFIX}DESCR_NAME              — название в палитре дизайнера БП
{PREFIX}DESCR_DESCR             — описание в палитре дизайнера БП
{PREFIX}DESCR_{activityname}    — метка результата в трекинге (опционально)
{PREFIX}PD_{PROPERTY}           — подпись каждого поля в диалоге
{PREFIX}EMPTY_{PROPERTY}        — сообщение при ошибке валидации (для Required-полей)
{PREFIX}ACTIVITY_RESULT_SUCCESS — успешное завершение (пишется в трекинг)
{PREFIX}ACTIVITY_RESULT_ERROR   — ошибка (пишется в трекинг)
```

## Типы полей (`getPropertiesMap`)

| Тип        | Описание                                                      | Дополнительные ключи                      |
|------------|---------------------------------------------------------------|-------------------------------------------|
| `string`   | Произвольная строка, поддерживает подстановку полей документа | `Default`                                 |
| `text`     | Многострочный текст                                           | `Default`                                 |
| `bool`     | Чекбокс, значение `'Y'` / `'N'`                               | `Default` (`'Y'` или `'N'`)               |
| `int`      | Целое число                                                   | `Default`                                 |
| `double`   | Дробное число                                                 | `Default`                                 |
| `select`   | Выпадающий список                                             | `Options` (массив), `Multiple`, `Default` |
| `user`     | Выбор пользователя из оргструктуры                            | `Multiple`                                |
| `date`     | Дата                                                          | `Default`                                 |
| `datetime` | Дата и время                                                  | `Default`                                 |
| `file`     | Файл                                                          | —                                         |

Каждое поле в `getPropertiesMap` обязательно содержит:

- `Name` — локализованное название (`Loc::getMessage(...)`)
- `FieldName` — snake_case, уникально в рамках активити
- `Type` — тип из таблицы выше
- `Required` — `true` или `false`

## После генерации

Напомни пользователю:

- Очистить кеш после добавления файлов
- Активити появится в палитре дизайнера БП в категории, указанной в `.description.php`

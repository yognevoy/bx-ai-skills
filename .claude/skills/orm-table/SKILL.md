---
name: orm-table
description: >
  Создаёт класс ORM DataManager таблицы. Используй когда нужно
  создать новую таблицу в БД.
argument-hint: "[модуль] [ИмяСущности] [поля...]"
allowed-tools: Read Write Glob
---

Создай ORM-таблицу. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/` — они задают стиль кода.

## Что уточнить (если не указано в аргументах)

1. **Модуль** — например `vendor.module`
2. **Имя сущности** — например `ExampleEntity`
3. **Поля** — список с типами и ограничениями

Спроси всё необходимое перед генерацией.

## Соглашения

**Namespace и путь** определяются по имени модуля:

- `vendor.module` → namespace `Vendor\Module\Tables`, файл `lib/tables/`
- `vendor.module.sub` → namespace `Vendor\Module\Sub\Tables`, файл `lib/tables/`

**Имя таблицы в БД** — `{vendor}_{module}_{entity}` в snake_case:

- модуль `vendor.module`, сущность `ExampleEntity` → `vendor_module_example_entity`

**Типы полей:**

| Тип             | Описание                        |
|-----------------|---------------------------------|
| `IntegerField`  | Целое число                     |
| `StringField`   | Строка (VARCHAR)                |
| `TextField`     | Длинный текст (TEXT)            |
| `DateField`     | Дата                            |
| `DatetimeField` | Дата и время                    |
| `BooleanField`  | Булево значение                 |
| `EnumField`     | Перечисление (значения из Enum) |
| `ArrayField`    | Массив, сериализованный в TEXT  |

**Методы конфигурации:**

| Метод                     | Описание                                 |
|---------------------------|------------------------------------------|
| `configurePrimary()`      | Первичный ключ                           |
| `configureAutocomplete()` | Автоинкремент                            |
| `configureNullable()`     | Допускает NULL                           |
| `configureRequired()`     | Обязательное поле (NOT NULL без дефолта) |
| `configureSize(int)`      | Максимальная длина строки                |
| `configureDefaultValue()` | Значение по умолчанию                    |
| `configureValues(array)`  | Допустимые значения (для `EnumField`)    |

### EnumField

Значения берутся через `getCases()` из Enum (см. `ExampleQueueTable.php` в references):

```php
(new EnumField('STATUS'))
    ->configureValues(ExampleStatus::getCases())
    ->configureRequired(),
```

Сам enum должен реализовывать метод:

```php
public static function getCases(): array
{
    return array_column(self::cases(), 'value');
}
```

## После генерации

Напомни пользователю на выбор:

- добавить создание таблицы в инсталлер модуля (`install/index.php`)
- создать миграцию через `sprint.migration`

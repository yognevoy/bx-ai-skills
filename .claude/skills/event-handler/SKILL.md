---
name: event-handler
description: >
  Создаёт класс-обработчик события и объясняет как его зарегистрировать.
  Используй когда нужно подписаться на событие модуля: создать handler-класс
  и зарегистрировать его через install/index.php или миграцию.
argument-hint: "[ModuleId EventName — например: vendor.example OnEntityCreated]"
allowed-tools: Read Write Glob Grep
---

Создай обработчик события. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/` перед генерацией кода.

## Порядок работы

1. Из аргументов определи `fromModuleId` (модуль, бросающий событие) и `eventName`.
2. Определи неймспейс и расположение файла — по аналогии с другими обработчиками в проекте (`lib/App/Event/`).
3. Создай класс-обработчик по шаблону ниже.
4. Объясни как зарегистрировать обработчик — через `install/index.php` **или** через миграцию.

## Структура класса-обработчика

- Располагается в `lib/App/Event/` модуля.
- Называется по имени события: `OnSomethingHappened.php`.
- Наследует абстрактный `Event` из того же пространства имён (см. `Event.php` в references).
- Реализует статические методы `getFromModuleId()` и `getEventName()`.
- Метод `handle(Event $event): ?EventResult` — статический, принимает `Bitrix\Main\Event`.
- Внутри `handle`: получение параметров через `$event->getParameter(...)`, выполнение действий, возврат `EventResult::SUCCESS` или `null`.

Пример: `${CLAUDE_SKILL_DIR}/references/OnProlog.php`

## Регистрация в install/index.php

Если обработчик входит в состав модуля с самого начала — регистрируй в инсталлере.

Пример: `${CLAUDE_SKILL_DIR}/references/IndexInstall.php`

## Регистрация через миграцию (если модуль уже выпущен)

Если обработчик добавляется к уже установленному модулю — регистрируй миграцией.

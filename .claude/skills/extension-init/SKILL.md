---
name: extension-init
description: >
  Создаёт скелет JS-расширения.
  Используй когда нужно создать новое JS-расширение с нуля.
argument-hint: "[namespace] [описание]"
allowed-tools: Bash Glob Read Write
---

Создай скелет JS-расширения. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/module/example-extension/` — они задают точный стиль и структуру файлов.

## Что уточнить (если не указано в аргументах)

1. **Namespace** — путь в пространстве имён BX, например `Vendor.Module.Feature`
2. **Описание** — что делает расширение, одной строкой

Спроси всё необходимое перед генерацией.

## Правила генерации

### Из namespace вывести:

- **Директория расширения**: сегменты после первого в kebab-case, разделённые `/`,
  например `Vendor.Module.Feature` → `module/feature/`
- **Имя главного JS-класса**: последний сегмент namespace, например `Feature`
- **namespace в bundle.config.js**: добавить префикс `BX.`, например `BX.Vendor.Module`
  (без последнего сегмента — он экспортируется внутри index.js)
- **Ключи в lang/ru/config.php**: все сегменты в UPPER_SNAKE_CASE

### Структура файлов

```
{module}/{extension-name}/
├── config.php
├── bundle.config.js
├── lang/
│   └── ru/
│       └── config.php
└── src/
    ├── index.js
    ├── {ClassName}.js
    └── style.css
```

### config.php

- `js` и `css` всегда указывают на `dist/bundle.js` и `dist/bundle.css`
- `rel` — зависимости от других расширений (минимум `main.core`)
- `lang` — всегда `'lang/' . LANGUAGE_ID . '/configphp'`

### bundle.config.js

- `input` всегда `'src/index.js'`
- `output` — строка `'dist/bundle.js'` (если есть CSS — объект с `js` и `css`)
- `namespace` — `BX.Vendor.{...}` (родительский namespace, без имени класса)
- `minification` всегда `false`

### src/index.js

- Импортирует главный класс из `./{ClassName}`
- Вызывает `BX.namespace(...)` с полным namespace (без имени класса)
- Оборачивает инициализацию в `BX.ready()`
- Проверяет `hasOwnProperty` перед назначением
- Вызывает `{ClassName}.create()` для инициализации

### src/{ClassName}.js

- ES6-класс с `constructor(props = {})`
- Метод `init()` для инициализации логики
- Конструктор вызывает `this.init()`
- Статический метод `static create(props = {}) { return new this(props); }`
- Если нужны AJAX-запросы — метод `runAction(action, data = {})` через `BX.ajax.runAction`

### src/style.css

- Пустой файл или минимальные стили с классами, основанными на имени расширения

### lang/ru/config.php

- Пустой файл с заглушкой-комментарием, если языковые ключи не известны заранее

## Куда сохранять

Найди директорию JS-расширений через Glob (`**/local/js/`) и создай папку расширения внутри неё.

## После генерации

Выведи дерево созданных файлов и полный путь к корню расширения.

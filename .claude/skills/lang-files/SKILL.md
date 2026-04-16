---
name: lang-files
description: >
  Создаёт lang-файлы с языковыми переменными.
  Используй каждый раз, когда в файл модуля, компонента или js-расширения добавляется
  пользовательский текст: сообщения, лейблы, заголовки, ошибки.
argument-hint: "[путь к файлу или описание]"
allowed-tools: Bash Glob Read Write
---

Создай lang-файл(ы) для: $ARGUMENTS

## Общие правила

- Lang-файлы всегда хранятся в подпапке `lang/ru/`
- Каждый ключ — строка вида `$MESS["VENDOR_MODULE_KEY"] = "Значение";`
- Ключи в UPPER_SNAKE_CASE, с префиксом из кода модуля/компонента
- Никакого PHP-кода внутри, только массив `$MESS`
- Открывающий тег `<?php` без закрывающего `?>`

## Правила по типу артефакта

### Модуль и классы PHP

Каждый PHP-файл получает **собственный** lang-файл по зеркальному пути внутри `lang/ru/`:

| PHP-файл                       | Lang-файл                              |
|--------------------------------|----------------------------------------|
| `lib/Service/OrderService.php` | `lang/ru/lib/Service/OrderService.php` |
| `install/index.php`            | `lang/ru/install/index.php`            |

Загрузка в PHP-файле:

```php
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
```

### Компонент

Каждый PHP-файл компонента получает **собственный** lang-файл по зеркальному пути внутри `lang/ru/`:

| PHP-файл                          | Lang-файл                                 |
|-----------------------------------|-------------------------------------------|
| `class.php`                       | `lang/ru/class.php`                       |
| `templates/.default/template.php` | `lang/ru/templates/.default/template.php` |
| `templates/.default/script.php`   | `lang/ru/templates/.default/script.php`   |


### JS-расширение

Один lang-файл на всё расширение: `lang/ru/config.php`.

Использование в JS:

```js
BX.message('VENDOR_MODULE_KEY')
```

## Формат lang-файла

```php
<?php

$MESS['VENDOR_MODULE_TITLE'] = 'Заголовок';
$MESS['VENDOR_MODULE_SAVE_BUTTON'] = 'Сохранить';
$MESS['VENDOR_MODULE_ERROR_NOT_FOUND'] = 'Запись не найдена';
```

## Именование ключей

- Префикс = код модуля или компонента в UPPER_SNAKE_CASE
- Суффикс описывает контекст: `_TITLE`, `_ERROR_*`, `_BUTTON_*`, `_LABEL_*`, `_SUCCESS_*`
- Избегай слишком общих ключей без префикса

---
name: migrate-to-d7
description: >
  Переписывает устаревший API старого ядра на современный D7. Используй когда
  нужно заменить CModule, COption, CPHPCache, AddEventHandler, CEvent, $DB, $APPLICATION и другие
  устаревшие классы и функции на их аналоги в новом ядре D7.
argument-hint: "[файл или фрагмент кода]"
allowed-tools: Read Write Edit Glob Grep
---

Перепиши устаревший API на D7. Аргументы: $ARGUMENTS

Изучи примеры в `${CLAUDE_SKILL_DIR}/references/` — они содержат парные примеры по каждой теме.

## Порядок работы

1. Если передан путь к файлу — прочитай его. Если передан фрагмент кода — работай с ним.
2. Найди все устаревшие конструкции по таблице ниже.
3. Замени каждую на D7-аналог согласно примерам в `references/`.
4. Добавь `use`-импорты в начало файла (без дублей).
5. Убери `global $APPLICATION`, `global $DB` там, где они больше не нужны.
6. Покажи итоговый код и кратко перечисли, что было изменено.

## Таблица замен

| Устаревшее                                      | D7-аналог                                             | Reference          |
|-------------------------------------------------|-------------------------------------------------------|--------------------|
| `CModule::IncludeModule`                        | `Loader::includeModule`                               | `ModuleLoader.php` |
| `CModule::IncludeModuleEx`                      | `Loader::includeSharewareModule`                      | `ModuleLoader.php` |
| `$APPLICATION->AddHeadScript`                   | `Asset::getInstance()->addJs`                         | `Assets.php`       |
| `$APPLICATION->SetAdditionalCSS`                | `Asset::getInstance()->addCss`                        | `Assets.php`       |
| `$APPLICATION->AddHeadString`                   | `Asset::getInstance()->addString`                     | `Assets.php`       |
| `GetMessage` / `IncludeTemplateLangFile`        | `Loc::getMessage` / `Loc::loadMessages`               | `Localization.php` |
| `COption::SetOptionString/Int`                  | `Option::set`                                         | `Options.php`      |
| `COption::GetOptionString/Int`                  | `Option::get`                                         | `Options.php`      |
| `COption::RemoveOption`                         | `Option::delete`                                      | `Options.php`      |
| `CPHPCache`                                     | `Bitrix\Main\Data\Cache`                              | `Cache.php`        |
| `AddEventHandler` / `RegisterModuleDependences` | `EventManager::getInstance()->addEventHandler`        | `EventManager.php` |
| `RemoveEventHandler`                            | `EventManager::getInstance()->removeEventHandler`     | `EventManager.php` |
| `UnRegisterModuleDependences`                   | `EventManager::getInstance()->unRegisterEventHandler` | `EventManager.php` |
| `GetModuleEvents`                               | `EventManager::getInstance()->findEventHandlers`      | `EventManager.php` |
| `CheckDirPath`                                  | `Directory::createDirectory`                          | `FileSystem.php`   |
| `DeleteDirFilesEx`                              | `Directory::deleteDirectory`                          | `FileSystem.php`   |
| `RewriteFile`                                   | `File::putFileContents`                               | `FileSystem.php`   |
| `$_SERVER["DOCUMENT_ROOT"]`                     | `Application::getDocumentRoot()`                      | `FileSystem.php`   |
| `$APPLICATION->ThrowException`                  | `throw new SystemException`                           | `Exceptions.php`   |
| `AddMessage2Log` / `mydump`                     | `Debug::writeToFile` / `Debug::dump`                  | `Debug.php`        |
| `CEvent::Send`                                  | `Event::send`                                         | `MailEvent.php`    |
| `$_GET` / `$_POST` / `$_REQUEST`                | `$request->getQuery` / `getPost` / `get`              | `HttpRequest.php`  |
| `$APPLICATION->set_cookie / get_cookie`         | `Cookie` + `getResponse()->addCookie` / `getCookie`   | `HttpRequest.php`  |
| `$APPLICATION->GetCurPageParam` / `DeleteParam` | `Uri::addParams` / `deleteParams`                     | `HttpRequest.php`  |
| `$DB->Query`                                    | `Application::getConnection()->query`                 | `Database.php`     |

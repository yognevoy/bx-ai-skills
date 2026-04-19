---
name: migrate-to-d7
description: >
  Rewrites legacy kernel API to modern D7. Use when CModule, COption, CPHPCache,
  AddEventHandler, CEvent, $DB, $APPLICATION and other deprecated classes and functions
  need to be replaced with their D7 equivalents.
argument-hint: "[file path or code snippet]"
allowed-tools: Read Write Edit Glob Grep
---

Rewrite legacy API to D7. Arguments: $ARGUMENTS

Study the examples in `${CLAUDE_SKILL_DIR}/references/` — they contain paired before/after examples for each topic.

## Steps

1. If a file path is provided — read it. If a code snippet is provided — work with it directly.
2. Find all deprecated constructs using the table below.
3. Replace each one with its D7 equivalent following the examples in `references/`.
4. Add `use` imports at the top of the file (no duplicates).
5. Remove `global $APPLICATION`, `global $DB` where they are no longer needed.
6. Show the resulting code and briefly list what was changed.

## Replacement table

| Legacy                                          | D7 equivalent                                         | Reference          |
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
| `$USER->GetID()` / `IsAdmin()`                  | `CurrentUser::get()->getId()` / `isAdmin()`           | `CurrentUser.php`  |
| `$_SESSION["key"]`                              | `Application::getInstance()->getSession()["key"]`     | `Session.php`      |
| `CJSON::encode/decode` / `CUtil::PhpToJSObject` | `Json::encode` / `Json::decode`                       | `Json.php`         |
| `MakeTimeStamp()` / `ConvertDateTime()`         | `new Date(...)` / `new DateTime(...)`                 | `DateTime.php`     |

## Constraints

### MUST DO

- Add all required `use` imports at the top of the file after migration
- Remove `global $APPLICATION` and `global $DB` where they are no longer needed
- Show what was changed after the migration is complete

### MUST NOT DO

- **Mix legacy and D7 API in the same file** — migrate all occurrences, not just some
- **Change business logic during migration** — replace API calls only; preserve behavior exactly

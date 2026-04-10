<?php

/**
 * Работа с файловой системой
 */

// Старое ядро
// DeleteDirFilesEx принимал путь от корня сайта.
CheckDirPath($_SERVER["DOCUMENT_ROOT"] . "/foo/bar/baz/");
RewriteFile($_SERVER["DOCUMENT_ROOT"] . "/foo/bar/baz/file.txt", "content");
DeleteDirFilesEx("/foo/bar/baz/");

// D7
// Directory::deleteDirectory принимает абсолютный путь от корня сервера.
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

Directory::createDirectory(Application::getDocumentRoot() . "/foo/bar/baz/");
File::putFileContents(Application::getDocumentRoot() . "/foo/bar/baz/file.txt", "content");
Directory::deleteDirectory(Application::getDocumentRoot() . "/foo/bar/baz/");

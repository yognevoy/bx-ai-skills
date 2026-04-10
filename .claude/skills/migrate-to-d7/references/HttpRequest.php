<?php

/**
 * HTTP-запрос: GET/POST, Cookie, URI
 */

// GET / POST / REQUEST

// Старое ядро
$name = $_POST["name"];
$email = htmlspecialchars($_GET["email"]);
$value = $_REQUEST["key"];

// D7
use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();

$name = $request->getPost("name");
$email = htmlspecialchars($request->getQuery("email"));
$value = $request->get("key"); // аналог $_REQUEST

// Cookie

// Старое ядро
// Cookie доступна только на следующем хите после записи.
global $APPLICATION;
$APPLICATION->set_cookie("TEST", 42, false, "/", "example.com");
echo $APPLICATION->get_cookie("TEST");

// D7
// Запись cookie происходит при вызове эпилога (HttpResponse::flush()).
use Bitrix\Main\Web\Cookie;

$cookie = new Cookie("TEST", 42);
$cookie->setDomain("example.com");
Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
echo Application::getInstance()->getContext()->getRequest()->getCookie("TEST");

// URI / параметры ссылки

// Старое ядро
global $APPLICATION;
$redirect = $APPLICATION->GetCurPageParam("foo=bar", ["baz"]); // добавить foo, удалить baz

// D7
use Bitrix\Main\Web\Uri;

$request = Application::getInstance()->getContext()->getRequest();
$uri = new Uri($request->getRequestUri());
$uri->deleteParams(["baz"]);
$uri->addParams(["foo" => "bar"]);
$redirect = $uri->getUri();

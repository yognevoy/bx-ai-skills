<?php

/**
 * Почтовые события
 */

// Старое ядро
CEvent::Send(
    "NEW_USER",
    "s1",
    [
        "EMAIL" => "user@example.com",
        "USER_ID" => 42,
    ]
);
CEvent::SendImmediate(
    "NEW_USER",
    "s1",
    [
        "EMAIL" => "user@example.com",
        "USER_ID" => 42,
    ]
);

// D7
use Bitrix\Main\Mail\Event;

Event::send([
    "EVENT_NAME" => "NEW_USER",
    "LID" => "s1",
    "C_FIELDS" => [
        "EMAIL" => "user@example.com",
        "USER_ID" => 42,
    ],
]);

Event::sendImmediate([
    "EVENT_NAME" => "NEW_USER",
    "LID" => "s1",
    "C_FIELDS" => [
        "EMAIL" => "user@example.com",
        "USER_ID" => 42,
    ],
]);

<?php
/**
 * Supply the basis for the navbar as an array.
 */

global $di;

$user = $di->get("session")->get("user");
$url = ($user == null) ? ("user/login") : ("user");

return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Översikt.",
        ],
        [
            "text" => "Om",
            "url" => "about",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Forum",
            "url" => "forum",
            "title" => "Forum.",
        ],
        [
            "text" => "Taggar",
            "url" => "tags",
            "title" => "Taggar.",
        ],
        [
            "text" => "Min sida",
            "url" => $url,
            "title" => "Min sida",
        ],
    ],
];

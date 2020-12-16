<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
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
        // [
        //     "text" => "Styleväljare",
        //     "url" => "style",
        //     "title" => "Välj stylesheet.",
        // ],
        // [
        //     "text" => "Verktyg",
        //     "url" => "verktyg",
        //     "title" => "Verktyg och möjligheter för utveckling.",
        // ],
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
        // [
        //     "text" => "Väder",
        //     "url" => "weather",
        //     "title" => "Väderprognoser.",
        // ],
        [
            "text" => "Min sida",
            "url" => "user",
            "title" => "Min sida",
        ],
        // [
        //     "text" => "Logga in",
        //     "url" => "login",
        //     "title" => "Logga in",
        // ],
    ],
];

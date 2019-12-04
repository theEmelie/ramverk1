<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "Validera Ip",
            "url" => "ip",
            "title" => "Validera Ip adresser.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Ip Validering",
                        "url" => "ip",
                        "title" => "Validera Ip",
                    ],
                    [
                        "text" => "JSON Validering",
                        "url" => "jsonValidate",
                        "title" => "Validera JSON",
                    ],
                ],
            ],
        ],
        [
            "text" => "Väderprognos",
            "url" => "geoWeather",
            "title" => "Väderprognos.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Väderprognos",
                        "url" => "geoWeather",
                        "title" => "Väderprognos",
                    ],
                    [
                        "text" => "Väderprognos JSON",
                        "url" => "weatherJson",
                        "title" => "Väderprognos JSON",
                    ],
                ],
            ],
        ],
    ],
];

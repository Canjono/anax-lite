<?php
/**
 * Config file for navbar
 */
return [
    "config" => [
        "navbar-class" => "navbar-collapse collapse",
        "navbar-id" => "navbar",
        "ul-class" => "nav navbar-nav"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => "",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "session" => [
            "text" => "Session",
            "route" => "session",
        ],
        "calendar" => [
            "text" => "Månadskalender",
            "route" => "calendar",
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
        ]
    ]
];

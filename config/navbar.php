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
            "dropdown" => null,
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
            "dropdown" => null,
        ],
        "session" => [
            "text" => "Session",
            "route" => "session",
            "dropdown" => null,
        ],
        "calendar" => [
            "text" => "Månadskalender",
            "route" => "calendar",
            "dropdown" => null,
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
            "dropdown" => null,
        ],
        "login" => [
            "text" => "Logga in",
            "route" => "login",
            "dropdown" => null,
        ],
        "user" => [
            "text" => "User",
            "route" => "user",
            "dropdown" => [
                "profile" => [
                    "text" => "Profil",
                    "route" => "profile",
                ],
                "admin" => [
                    "text" => "Admin",
                    "route" => "admin",
                ],
                "logout" => [
                    "text" => "Logga ut",
                    "route" => "logout",
                ],
            ],
        ],
    ]
];

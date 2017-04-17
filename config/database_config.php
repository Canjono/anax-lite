<?php
/**
 * Config file for Database
 */
return [
    "dsn" => "mysql:host=localhost;dbname=name;",
    "username" => "user",
    "password" => "password",
    "driver_options" => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    "fetch_mode" => \PDO::FETCH_OBJ,
    "table_prefix" => "anaxlite_",
    "session_key" => "User\Database",
    "verbose" => null,
    "debug_connect" => false
];

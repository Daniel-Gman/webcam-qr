<?php
if (! file_exists(__DIR__ . '/../.env')){
    die ('Geen .env bestand gevonden');
}

$envSettings = parse_ini_file(__DIR__ . '/../.env');

define('DB_USER', (isset($envSettings['DB_USER'])) ? $envSettings['DB_USER'] : 'username');
define('DB_PASSWORD', (isset($envSettings['DB_PASSWORD'])) ? $envSettings['DB_PASSWORD'] : 'pass');
define('DB_HOST', (isset($envSettings['DB_HOST'])) ? $envSettings['DB_HOST'] : 'mariadb');
define('DB_SCHEMA', (isset($envSettings['DB_SCHEMA'])) ? $envSettings['DB_SCHEMA'] : 'mariadb');
define('SOURCE_ROOT',(isset($envSettings['SOURCE_ROOT'])) ? $envSettings['SOURCE_ROOT'] : 'http://localhost:88');
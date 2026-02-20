<?php

function get_db_conn()
{
    static $connection = null;

    if ($connection instanceof mysqli) {
        return $connection;
    }

    $config_path = __DIR__ . '/../config.local.php';

    if (!file_exists($config_path)) {
        http_response_code(500);
        exit('Missing config.local.php. Copy config.example.php and update credentials.');
    }

    require $config_path;

    $connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if ($connection->connect_errno) {
        http_response_code(500);
        exit('Database connection failed: ' . $connection->connect_error);
    }

    $connection->set_charset('utf8mb4');
    return $connection;
}

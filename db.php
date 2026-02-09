<?php
// Basic database connection for local XAMPP.
// Store local credentials in config.local.php (not committed).
$config_path = __DIR__ . '/config.local.php';

if (!file_exists($config_path)) {
    http_response_code(500);
    exit('Missing config.local.php. Copy config.example.php and update credentials.');
}

require $config_path;

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    http_response_code(500);
    exit('Database connection failed: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');

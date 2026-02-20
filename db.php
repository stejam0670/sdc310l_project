<?php
// Backward-compatible DB entrypoint, now delegated to MVC model function.
require_once __DIR__ . '/models/Database.php';

$mysqli = get_db_conn();

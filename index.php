<?php
require_once __DIR__ . '/controllers/HomeController.php';

$view_data = get_home_data();
$checkout_success = $view_data['checkout_success'];
require __DIR__ . '/views/home.php';

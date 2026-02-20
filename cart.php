<?php
require_once __DIR__ . '/controllers/CartController.php';

handle_cart_request();
$view_data = get_cart_page_data();
$cart_items = $view_data['cart_items'];
$total = $view_data['total'];
require __DIR__ . '/views/cart.php';

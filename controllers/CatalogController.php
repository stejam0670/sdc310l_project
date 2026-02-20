<?php

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CartModel.php';

function handle_catalog_request()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        if ($product_id > 0) {
            add_to_cart($product_id);
        }

        header('Location: catalog.php');
        exit();
    }
}

function get_catalog_products()
{
    return get_all_products();
}

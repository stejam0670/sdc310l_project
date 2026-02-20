<?php

require_once __DIR__ . '/Database.php';

function get_all_products()
{
    $db = get_db_conn();
    $products = $db->query(
        'SELECT product_id, name, description, cost FROM products ORDER BY product_id'
    );

    $rows = array();
    if ($products) {
        while ($row = $products->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    return $rows;
}

<?php

require_once __DIR__ . '/Database.php';

function add_to_cart($product_id)
{
    $db = get_db_conn();
    $check_stmt = $db->prepare('SELECT cart_item_id, quantity FROM cart_items WHERE product_id = ?');
    $check_stmt->bind_param('i', $product_id);
    $check_stmt->execute();
    $check_stmt->bind_result($cart_item_id, $quantity);
    $found = $check_stmt->fetch();
    $check_stmt->close();

    if ($found) {
        $new_qty = $quantity + 1;
        $update_stmt = $db->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
        $update_stmt->bind_param('ii', $new_qty, $cart_item_id);
        $update_stmt->execute();
        $update_stmt->close();
        return;
    }

    $insert_stmt = $db->prepare('INSERT INTO cart_items (product_id, quantity) VALUES (?, 1)');
    $insert_stmt->bind_param('i', $product_id);
    $insert_stmt->execute();
    $insert_stmt->close();
}

function update_cart_quantities($quantities)
{
    $db = get_db_conn();
    foreach ($quantities as $cart_item_id => $qty) {
        $cart_item_id = (int)$cart_item_id;
        $qty = (int)$qty;

        if ($qty <= 0) {
            $delete_stmt = $db->prepare('DELETE FROM cart_items WHERE cart_item_id = ?');
            $delete_stmt->bind_param('i', $cart_item_id);
            $delete_stmt->execute();
            $delete_stmt->close();
            continue;
        }

        $update_stmt = $db->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
        $update_stmt->bind_param('ii', $qty, $cart_item_id);
        $update_stmt->execute();
        $update_stmt->close();
    }
}

function checkout_cart()
{
    $db = get_db_conn();
    $db->query('TRUNCATE TABLE cart_items');
}

function get_cart_items()
{
    $db = get_db_conn();
    $cart_items = $db->query(
        'SELECT ci.cart_item_id, p.name, p.cost, ci.quantity
         FROM cart_items ci
         JOIN products p ON ci.product_id = p.product_id
         ORDER BY ci.cart_item_id'
    );

    $rows = array();
    if ($cart_items) {
        while ($row = $cart_items->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    return $rows;
}

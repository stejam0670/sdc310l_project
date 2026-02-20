<?php

require_once __DIR__ . '/../models/CartModel.php';

function handle_cart_request()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $redirect_target = 'cart.php';

        if (isset($_POST['update_cart']) && isset($_POST['quantity']) && is_array($_POST['quantity'])) {
            update_cart_quantities($_POST['quantity']);
        } elseif (isset($_POST['checkout'])) {
            checkout_cart();
            $redirect_target = 'index.php?checkout=success';
        }

        header('Location: ' . $redirect_target);
        exit();
    }
}

function get_cart_page_data()
{
    $cart_items = get_cart_items();
    $total = 0.00;

    foreach ($cart_items as &$item) {
        $subtotal = (float)$item['cost'] * (int)$item['quantity'];
        $item['subtotal'] = $subtotal;
        $total += $subtotal;
    }

    return array(
        'cart_items' => $cart_items,
        'total' => $total
    );
}

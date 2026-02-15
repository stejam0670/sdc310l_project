<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirect_target = 'cart.php';

    if (isset($_POST['update_cart'])) {
        if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $cart_item_id => $qty) {
                $cart_item_id = (int)$cart_item_id;
                $qty = (int)$qty;
                if ($qty <= 0) {
                    $delete_stmt = $mysqli->prepare('DELETE FROM cart_items WHERE cart_item_id = ?');
                    $delete_stmt->bind_param('i', $cart_item_id);
                    $delete_stmt->execute();
                    $delete_stmt->close();
                } else {
                    $update_stmt = $mysqli->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
                    $update_stmt->bind_param('ii', $qty, $cart_item_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }
            }
        }
    } elseif (isset($_POST['checkout'])) {
        $mysqli->query('TRUNCATE TABLE cart_items');
        $redirect_target = 'index.php?checkout=success';
    }

    header('Location: ' . $redirect_target);
    exit();
}

$cart_items = $mysqli->query(
    'SELECT ci.cart_item_id, p.name, p.cost, ci.quantity
     FROM cart_items ci
     JOIN products p ON ci.product_id = p.product_id
     ORDER BY ci.cart_item_id'
);

$total = 0.00;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="page">
        <section class="panel">
            <h1>Shopping Cart</h1>
            <p class="nav"><a href="index.php">Home</a> | <a href="catalog.php">Catalog</a></p>

            <?php if ($cart_items && $cart_items->num_rows > 0): ?>
                <form method="post" action="cart.php">
                    <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $cart_items->fetch_assoc()): ?>
                            <?php $subtotal = (float)$row['cost'] * (int)$row['quantity']; ?>
                            <?php $total += $subtotal; ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td>$<?php echo number_format((float)$row['cost'], 2); ?></td>
                                <td>
                                    <input type="number" min="0" name="quantity[<?php echo (int)$row['cart_item_id']; ?>]" value="<?php echo (int)$row['quantity']; ?>">
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" align="right"><strong>Total</strong></td>
                                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <p class="actions">
                        <button type="submit" name="update_cart">Update Cart</button>
                        <button type="submit" name="checkout">Checkout</button>
                    </p>
                </form>
            <?php else: ?>
                <p class="empty">Your cart is empty.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

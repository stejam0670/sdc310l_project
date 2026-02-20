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

            <?php if (!empty($cart_items)): ?>
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
                        <?php foreach ($cart_items as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td>$<?php echo number_format((float)$row['cost'], 2); ?></td>
                                <td>
                                    <input type="number" min="0" name="quantity[<?php echo (int)$row['cart_item_id']; ?>]" value="<?php echo (int)$row['quantity']; ?>">
                                </td>
                                <td>$<?php echo number_format((float)$row['subtotal'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" align="right"><strong>Total</strong></td>
                                <td><strong>$<?php echo number_format((float)$total, 2); ?></strong></td>
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

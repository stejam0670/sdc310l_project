<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];

    $check_stmt = $mysqli->prepare('SELECT cart_item_id, quantity FROM cart_items WHERE product_id = ?');
    $check_stmt->bind_param('i', $product_id);
    $check_stmt->execute();
    $check_stmt->bind_result($cart_item_id, $quantity);
    $found = $check_stmt->fetch();
    $check_stmt->close();

    if ($found) {
        $new_qty = $quantity + 1;
        $update_stmt = $mysqli->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
        $update_stmt->bind_param('ii', $new_qty, $cart_item_id);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        $insert_stmt = $mysqli->prepare('INSERT INTO cart_items (product_id, quantity) VALUES (?, 1)');
        $insert_stmt->bind_param('i', $product_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    header('Location: catalog.php');
    exit();
}

$products = $mysqli->query('SELECT product_id, name, description, cost FROM products ORDER BY product_id');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Catalog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Catalog</h1>
    <p><a href="index.php">Home</a> | <a href="cart.php">View Cart</a></p>

    <?php if ($products && $products->num_rows > 0): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $products->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>$<?php echo number_format((float)$row['cost'], 2); ?></td>
                    <td>
                        <form method="post" action="catalog.php">
                            <input type="hidden" name="product_id" value="<?php echo (int)$row['product_id']; ?>">
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</body>
</html>

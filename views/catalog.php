<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Catalog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="page">
        <section class="panel">
            <h1>Catalog</h1>
            <p class="nav"><a href="index.php">Home</a> | <a href="cart.php">View Cart</a></p>

            <?php if (!empty($products)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $row): ?>
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
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="empty">No products found.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

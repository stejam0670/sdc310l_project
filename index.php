<?php
// Simple landing page for Week 2 scope.
$checkout_success = isset($_GET['checkout']) && $_GET['checkout'] === 'success';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fantasy Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="page">
        <section class="panel">
            <h1>Alex's Fantasy Shop</h1>
            <?php if ($checkout_success): ?>
                <p><strong>Thank you for your order.</strong> The guild quartermaster is preparing your items.</p>
            <?php endif; ?>
            <p>Welcome to the guild outpost. Browse wares or review your cart.</p>
            <ul class="links">
                <li><a href="catalog.php">Catalog</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
            </ul>
        </section>
    </main>
</body>
</html>

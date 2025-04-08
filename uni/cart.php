<?php
// Start the session to access cart data
session_start();

// Initialize cart if it's not set yet
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Sample products (This would normally come from a database)
$products = [
    1 => ['name' => 'Product 1', 'price' => 30, 'image' => 'path_to_image/product1.jpg'],
    2 => ['name' => 'Product 2', 'price' => 50, 'image' => 'path_to_image/product2.jpg'],
    3 => ['name' => 'Product 3', 'price' => 100, 'image' => 'path_to_image/product3.jpg']
];

// Function to get cart total
function getCartTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        global $products;
        $total += $products[$productId]['price'] * $quantity;
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - E-commerce</title>
    <link rel="stylesheet" href="in.css">
    <script src="cart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" width="90px" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.html"><b>Home</b></a></li>
                <li><a href="categories.html"><b>Categories</b></a></li>
                <li><a href="foods.html"><b>Foods</b></a></li>
                <li><a href="contact.html"><b>Contact</b></a></li>
            </ul>
        </nav>
    </div>

    <!-- Cart Page -->
    <div class="cart-page">
        <h1>Your Cart</h1>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty!</p>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
                <?php
                    $product = $products[$productId];
                ?>
                <div class="cart-item">
                    <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" width="100" height="100">
                    <div class="cart-item-details">
                        <h4><?= $product['name']; ?></h4>
                        <p>Price: $<?= $product['price']; ?></p>
                        <p>Quantity: <span class="quantity"><?= $quantity; ?></span></p>
                        <button onclick="removeFromCart(<?= $productId; ?>)">Remove</button>
                    </div>
                    <div class="cart-item-total">
                        <p>Total: $<?= $product['price'] * $quantity; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div id="total-price">
                <p>Total: $<?= getCartTotal(); ?></p>
            </div>

            <a href="checkout.html" class="btn">Proceed to Checkout</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="social">
            <ul>
                <li><a href="#" class="fa fa-facebook"></a></li>
                <li><a href="#" class="fa fa-twitter"></a></li>
                <li><a href="#" class="fa fa-instagram"></a></li>
            </ul>
        </div>
    </footer>

    <script src="cart.js"></script>
</body>
</html>

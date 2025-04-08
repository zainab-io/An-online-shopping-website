<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to checkout.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_price = $_POST['total_price'];

    // Create new order
    $sql = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $total_price]);
    $order_id = $pdo->lastInsertId();

    // Add items to order
    $cart_sql = "SELECT * FROM cart WHERE user_id = ?";
    $cart_stmt = $pdo->prepare($cart_sql);
    $cart_stmt->execute([$_SESSION['user_id']]);
    $cart_items = $cart_stmt->fetchAll();

    foreach ($cart_items as $item) {
        $product_sql = "SELECT * FROM products WHERE product_id = ?";
        $product_stmt = $pdo->prepare($product_sql);
        $product_stmt->execute([$item['product_id']]);
        $product = $product_stmt->fetch();

        $order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $order_item_stmt = $pdo->prepare($order_item_sql);
        $order_item_stmt->execute([$order_id, $product['product_id'], $item['quantity'], $product['price']]);
    }

    // Clear cart
    $clear_cart_sql = "DELETE FROM cart WHERE user_id = ?";
    $clear_cart_stmt = $pdo->prepare($clear_cart_sql);
    $clear_cart_stmt->execute([$_SESSION['user_id']]);

    echo "Order placed successfully!";
}
?>

<form action="checkout.php" method="POST">
    <input type="text" name="total_price" placeholder="Total Price" required><br>
    <input type="submit" value="Place Order">
</form>

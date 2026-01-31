<?php
session_start();
include 'config.php';

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Add to cart logic (from JS POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $_SESSION['cart'][] = $_POST['product_id'];
}

// Fetch cart products
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', $_SESSION['cart']);
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Cart</h2>
<?php foreach ($cart_items as $item): ?>
    <div><?php echo $item['name']; ?> - ₹<?php echo $item['price']; ?></div>
<?php endforeach; ?>
<a href="checkout.php">Checkout</a>
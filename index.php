<?php
session_start();
include 'config.php';

try {
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AMORA Scented Candles</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
<h1>AMORA - Luxury Scented Candles</h1>
<nav>
<a href="login.php">Login</a> | <a href="register.php">Register</a> | <a href="dashboard.php">Dashboard</a> | <a href="cart.php">Cart</a>
</nav>
</header>
<main>
<h2>Our Candles</h2>
<div class="products">
<?php foreach ($products as $product): ?>
<div class="product-card">
<img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
<h3><?php echo $product['name']; ?></h3>
<p><?php echo $product['description']; ?></p>
<p>₹<?php echo $product['price']; ?></p>
<button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
</div>
<?php endforeach; ?>
</div>
</main>
<script src="js/scripts.js"></script>
</body>
</html>
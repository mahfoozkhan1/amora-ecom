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
    <div class="container">
      <a href="/" class="logo">AMORA</a>
      <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="cart.php">Cart</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section (like "Ignite Your Senses") -->
  <section class="hero">
    <div class="hero-content">
      <h1>Ignite Your Senses</h1>
      <p>Handcrafted luxury scented candles from Varanasi • Natural soy & beeswax • Sustainable, long-lasting, clean burn</p>
      <a href="#collection" class="cta">Shop Collection</a>
    </div>
  </section>

  <!-- Products / Signature Collection -->
  <section id="collection" class="collection">
    <h2>Our Signature Candles</h2>
    <div class="product-grid">
      <?php
      try {
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($products)) {
          echo '<p>No candles added yet. Use admin to add some.</p>';
        } else {
          foreach ($products as $product) {
            echo '
            <div class="product-card">
              <img src="' . htmlspecialchars($product['image'] ?? 'https://images.unsplash.com/photo-1603006905886-9f8a2160db25?w=800') . '" alt="' . htmlspecialchars($product['name']) . '">
              <div class="info">
                <h3>' . htmlspecialchars($product['name']) . '</h3>
                <p class="desc">' . htmlspecialchars($product['description'] ?? 'Premium hand-poured scent') . '</p>
                <p class="price">₹' . number_format($product['price'], 2) . '</p>
                <button class="add-cart" onclick="addToCart(' . $product['id'] . ')">Add to Cart</button>
              </div>
            </div>';
          }
        }
      } catch (Exception $e) {
        echo '<p>Product load error – check DB.</p>';
      }
      ?>
    </div>
  </section>

  <!-- Our Story / Promise (like reference) -->
  <section class="story">
    <h2>The AMORA Promise</h2>
    <p>We believe a candle is more than wax and wick — it's a memory waiting to happen. Handcrafted in Varanasi with love, using ethically sourced natural ingredients for warmth and calm in your space.</p>
  </section>

  <!-- Footer -->
  <footer>
    <p>© <?php echo date('Y'); ?> AMORA – Luxury Scented Candles from Varanasi, India</p>
  </footer>

  <script src="js/scripts.js"></script>
</body>

</html>


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
    <div style="display:flex; justify-content:space-between; align-items:center; max-width:1400px; margin:auto;">
      <a href="/" class="logo">AMORA</a>
      <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="cart.php">Cart</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Luxury Scented Candles</h1>
      <p>Handcrafted with love in Varanasi • Natural soy & beeswax • Long-lasting, clean burn</p>
      <a href="#products" class="cta-btn">Explore Collection</a>
    </div>
  </section>

  <!-- Products -->
  <section id="products">
    <h2>Our Signature Candles</h2>
    <div class="products-grid">
      <?php
      try {
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        $products = [];
      }

      if (empty($products)) {
        echo '<p style="text-align:center; grid-column:1/-1; font-size:1.3rem;">No products yet. Add some via admin panel.</p>';
      } else {
        foreach ($products as $product) {
          echo '
          <div class="product-card">
            <img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">
            <div class="product-info">
              <h3>' . htmlspecialchars($product['name']) . '</h3>
              <p class="price">₹' . number_format($product['price'], 2) . '</p>
              <button class="add-btn" onclick="addToCart(' . $product['id'] . ')">Add to Cart</button>
            </div>
          </div>';
        }
      }
      ?>
    </div>
  </section>

  <!-- Reviews -->
  <section class="reviews">
    <h2>What Our Customers Say</h2>
    <div class="review-grid">
      <div class="review-card">
        <p>“The Lavender Serenity is my evening ritual now. The scent lasts for hours and feels so luxurious.”</p>
        <p style="margin-top:1rem; font-weight:600;">— Priya S., Delhi</p>
      </div>
      <div class="review-card">
        <p>“Best packaging and fastest delivery. The Vanilla Warmth candle is pure comfort in a jar.”</p>
        <p style="margin-top:1rem; font-weight:600;">— Arjun K., Mumbai</p>
      </div>
      <div class="review-card">
        <p>“Perfect gift for Diwali. Everyone loved the Citrus Grove — fresh and uplifting!”</p>
        <p style="margin-top:1rem; font-weight:600;">— Ananya R., Varanasi</p>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section class="contact">
    <h2>Stay in Touch</h2>
    <p style="max-width:700px; margin:0 auto 2rem; opacity:0.9;">
      Have questions? Want custom scents or bulk orders? Drop us a message.
    </p>
    <form>
      <input type="text" placeholder="Your Name" required>
      <input type="email" placeholder="Email Address" required>
      <textarea rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>

  <footer>
    <p>© <?php echo date('Y'); ?> AMORA – Handcrafted Luxury Candles from Varanasi, India</p>
    <p style="margin-top:1rem; font-size:0.95rem;">
      <a href="#">Privacy Policy</a> • <a href="#">Terms of Service</a> • <a href="#">Contact</a>
    </p>
  </footer>

  <script src="js/scripts.js"></script>
</body>

</html>

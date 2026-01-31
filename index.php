<?php
session_start();
include 'config.php';

try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMORA | Luxury Perfumed Candles</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;800&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amora: {
                            gold: '#D4AF37',
                            dark: '#1A1A1A',
                            cream: '#F9F7F2',
                            sage: '#8A9A5B',
                            rose: '#C5958E'
                        }
                    },
                    fontFamily: {
                        serif: ['Cinzel', 'serif'],
                        sans: ['Lato', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS from reference (adapted) -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header / Nav -->
    <header class="fixed w-full bg-amora-cream/95 backdrop-blur-md z-50 border-b border-amora-gold/10">
        <div class="container mx-auto px-4 py-5 flex items-center justify-between">
            <a href="/" class="text-3xl font-serif font-bold text-amora-gold">AMORA</a>
            <nav class="space-x-8">
                <a href="/" class="text-amora-dark hover:text-amora-gold transition">Home</a>
                <a href="#collection" class="text-amora-dark hover:text-amora-gold transition">Collection</a>
                <a href="#story" class="text-amora-dark hover:text-amora-gold transition">Our Story</a>
                <a href="login.php" class="text-amora-dark hover:text-amora-gold transition">Login</a>
                <a href="register.php" class="text-amora-dark hover:text-amora-gold transition">Register</a>
                <a href="dashboard.php" class="text-amora-dark hover:text-amora-gold transition">Dashboard</a>
                <a href="cart.php" class="text-amora-dark hover:text-amora-gold transition">Cart</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero min-h-screen flex items-center justify-center text-center bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=2000');">
        <div class="container mx-auto px-4">
            <h1 class="text-7xl font-serif font-bold text-white mb-6">Ignite Your Senses</h1>
            <p class="text-2xl text-white/90 mb-8">Handcrafted luxury perfumed candles from Varanasi • Natural soy & beeswax • Long-lasting, clean burn</p>
            <a href="#collection" class="bg-amora-gold text-white px-8 py-3 rounded-full font-sans font-bold hover:bg-amora-dark transition">Shop Collection</a>
        </div>
    </section>

    <!-- Collection -->
    <section id="collection" class="py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-5xl font-serif text-center mb-16">Our Signature Collection</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                if (empty($products)) {
                    echo '<p class="text-center col-span-4">No products yet. Add some via admin.</p>';
                } else {
                    foreach ($products as $product) {
                        echo '
                        <div class="product-card group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="p-6 text-center">
                                <h3 class="text-2xl font-serif mb-2">' . htmlspecialchars($product['name']) . '</h3>
                                <p class="text-gray-600 mb-4">' . htmlspecialchars($product['description']) . '</p>
                                <p class="text-xl font-bold mb-4">₹' . number_format($product['price'], 2) . '</p>
                                <button onclick="addToCart(' . $product['id'] . ')" class="bg-amora-gold text-white px-6 py-2 rounded-full hover:bg-amora-dark transition">Add to Cart</button>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section id="story" class="py-24 bg-amora-cream">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-serif mb-12">The AMORA Promise</h2>
            <p class="text-xl max-w-3xl mx-auto mb-8">We believe a candle is more than wax and wick — it's a memory waiting to happen. Handcrafted in Varanasi with love, using ethically sourced natural ingredients for warmth and calm in your space.</p>
            <a href="#" class="bg-amora-gold text-white px-8 py-3 rounded-full font-sans font-bold hover:bg-amora-dark transition">Learn More</a>
        </div>
    </section>

    <!-- Reviews -->
    <section class="py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-5xl font-serif text-center mb-16">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="review-card p-8 rounded-xl shadow-lg bg-white">
                    <p>“The Lavender Serenity is my evening ritual now. The scent lasts for hours and feels so luxurious.”</p>
                    <p class="mt-4 font-bold">— Priya S., Delhi</p>
                </div>
                <div class="review-card p-8 rounded-xl shadow-lg bg-white">
                    <p>“Best packaging and fastest delivery. The Vanilla Warmth candle is pure comfort in a jar.”</p>
                    <p class="mt-4 font-bold">— Arjun K., Mumbai</p>
                </div>
                <div class="review-card p-8 rounded-xl shadow-lg bg-white">
                    <p>“Perfect gift for Diwali. Everyone loved the Citrus Grove — fresh and uplifting!”</p>
                    <p class="mt-4 font-bold">— Ananya R., Varanasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="py-24 bg-amora-dark text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-serif mb-12">Get in Touch</p>
            <p class="text-xl max-w-700 mx-auto mb-8">Have questions? Want custom scents or bulk orders? Drop us a message.</p>
            <form class="max-w-700 mx-auto grid gap-4">
                <input type="text" placeholder="Your Name" class="p-4 rounded-xl bg-white/10 border-none">
                <input type="email" placeholder="Email Address" class="p-4 rounded-xl bg-white/10 border-none">
                <textarea rows="5" placeholder="Your Message" class="p-4 rounded-xl bg-white/10 border-none"></textarea>
                <button type="submit" class="bg-amora-gold text-white p-4 rounded-xl font-bold hover:bg-amora-rose transition">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-amora-dark text-white text-center">
        <p>© <?php echo date('Y'); ?> AMORA – Handcrafted Luxury Candles from Varanasi, India</p>
        <p class="mt-2"><a href="#">Privacy Policy</a> • <a href="#">Terms of Service</a></p>
    </footer>

    <!-- Chatbot from reference -->
    <div class="fixed bottom-8 right-8 z-50">
        <button class="chat-toggle bg-amora-gold text-white p-4 rounded-full shadow-lg hover:bg-amora-dark transition">
            <i class="fas fa-message"></i>
        </button>
        <div class="chat-container hidden bg-white rounded-2xl shadow-2xl w-80 h-96 overflow-hidden">
            <div class="chat-header bg-amora-gold p-4 text-white font-serif text-xl">Amora Assistant</div>
            <div class="chat-messages p-4 overflow-y-auto h-72">
                <p class="bot-message">Hello! How can I help you find the perfect scent?</p>
            </div>
            <input type="text" class="chat-input p-4 w-full border-t border-amora-gold/20" placeholder="Type your message...">
        </div>
    </div>

    <!-- Scripts from reference -->
    <script src="js/scripts.js"></script>
</body>
</html>

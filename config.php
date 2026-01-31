<?php
$host   = getenv('DB_HOST')   ?: 'localhost';
$port   = getenv('DB_PORT')   ?: '5432';
$dbname = getenv('DB_NAME')   ?: 'neondb';
$user   = getenv('DB_USER')   ?: 'neondb_owner';
$pass   = getenv('DB_PASS')   ?: '';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require;sslrootcert=neon-ca-bundle.pem";  // sslmode=require is key for Neon

try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];  // Empty array if error
    // Optional: echo "No products found or DB error.";
}
?>


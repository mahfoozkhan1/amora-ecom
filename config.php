<?php
$host   = getenv('DB_HOST')   ?: 'localhost';
$port   = getenv('DB_PORT')   ?: '5432';
$dbname = getenv('DB_NAME')   ?: 'neondb';
$user   = getenv('DB_USER')   ?: 'neondb_owner';
$pass   = getenv('DB_PASS')   ?: '';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require;sslrootcert=neon-ca-bundle.pem";  // sslmode=require is key for Neon

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: echo "Connected successfully"; // for testing, remove later
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php
// Hide errors in production (comment out during debug)
// ini_set('display_errors', 0);
// error_reporting(0);

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'neondb';
$user = getenv('DB_USER') ?: 'neondb_owner';
$pass = getenv('DB_PASS') ?: '';

// Debug: Show what values we're actually using (remove after testing)
// echo "<pre>Host: $host\nPort: $port\nDB: $dbname\nUser: $user\nPass length: " . strlen($pass) . "</pre>";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to Neon Postgres!"; // uncomment temporarily to test
} catch (PDOException $e) {
    // Show friendly message instead of raw fatal error
    die("Database connection failed: " . $e->getMessage() .
        "<br><br>Check Render Environment Variables (DB_HOST, DB_PASS etc.)");
}
?>

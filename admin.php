<?php
session_start();
include 'config.php';
// Add auth check for admin

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // URL for free

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :desc, :price, :image)");
    $stmt->execute(['name' => $name, 'desc' => $desc, 'price' => $price, 'image' => $image]);
}
?>
<form method="POST">
    Name: <input name="name"><br>
    Description: <textarea name="description"></textarea><br>
    Price: <input name="price" type="number"><br>
    Image URL: <input name="image"><br>
    <button>Add Product</button>
</form>
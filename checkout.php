<?php
session_start();
include 'config.php';
require 'vendor/autoload.php'; // Composer for Stripe

\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Calculate total from cart (simplified)
    $total = 0; // Add logic to sum cart prices

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'inr',
                'product_data' => ['name' => 'AMORA Order'],
                'unit_amount' => $total * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'https://your-render-url/success.php',
        'cancel_url' => 'https://your-render-url/cart.php',
    ]);
    header('Location: ' . $session->url);
}
?>
<form method="POST">
    Address: <input name="address"><br>
    <button type="submit">Pay with Stripe</button>
</form>
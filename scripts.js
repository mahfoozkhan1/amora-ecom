document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.product-card').forEach((card, i) => {
        setTimeout(() => card.classList.add('visible'), i * 200);
    });
});

function addToCart(id) {
    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${id}`
    }).then(() => {
        alert('Added to cart!');
        // Add bounce animation if needed
    });
}
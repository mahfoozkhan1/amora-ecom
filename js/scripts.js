// Header scroll effect
window.addEventListener('scroll', () => {
  document.querySelector('header').classList.toggle('scrolled', window.scrollY > 100);
});

// Fade-in on scroll
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.15 });

document.querySelectorAll('.product-card, .review-card').forEach(el => {
  observer.observe(el);
});

// Simple cart add animation (optional enhancement)
document.querySelectorAll('.add-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    btn.textContent = 'Added!';
    btn.style.background = '#d4af37';
    setTimeout(() => {
      btn.textContent = 'Add to Cart';
      btn.style.background = 'var(--accent)';
    }, 1500);
  });
});

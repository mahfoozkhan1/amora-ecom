// GSAP Animations
gsap.registerPlugin(ScrollTrigger);

gsap.from('.hero-content', { y: 50, opacity: 0, duration: 1.2, ease: 'power3.out' });

ScrollTrigger.create({
  trigger: '.collection',
  start: 'top 80%',
  onEnter: () => gsap.to('.product-card', { y: 0, opacity: 1, stagger: 0.2, duration: 0.8, ease: 'power3.out' })
});

ScrollTrigger.create({
  trigger: '.story',
  start: 'top 80%',
  onEnter: () => gsap.to('.story p', { y: 0, opacity: 1, duration: 1, ease: 'power3.out' })
});

// Chatbot Toggle & Logic
const toggle = document.querySelector('.chat-toggle');
const container = document.querySelector('.chat-container');
const input = document.querySelector('.chat-input');
const messages = document.querySelector('.chat-messages');

toggle.addEventListener('click', () => {
  container.classList.toggle('hidden');
});

input.addEventListener('keypress', (e) => {
  if (e.key === 'Enter' && input.value.trim()) {
    const userMsg = document.createElement('div');
    userMsg.classList.add('user-message');
    userMsg.textContent = input.value;
    messages.appendChild(userMsg);
    messages.scrollTop = messages.scrollHeight;

    const lowerInput = input.value.toLowerCase();
    input.value = '';

    setTimeout(() => {
      let response = "I'm here to help with scents! Tell me what mood you're in (relaxed, romantic, energetic)?";

      if (lowerInput.includes('relaxed')) {
        response = "For relaxed moods, try Lavender Serenity – calming and soothing.";
      } else if (lowerInput.includes('romantic')) {
        response = "For romance, Sandalwood & Amber is perfect – warm and intimate.";
      } else if (lowerInput.includes('energetic')) {
        response = "For energy, Citrus Grove will wake you up with fresh notes.";
      }

      const botMsg = document.createElement('div');
      botMsg.classList.add('bot-message');
      botMsg.textContent = response;
      messages.appendChild(botMsg);
      messages.scrollTop = messages.scrollHeight;
    }, 1000);
  }
});

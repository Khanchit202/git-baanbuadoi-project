<div id="typingEffect"></div>

<style>
  #typingEffect::after {
    content: ' |';
    animation: blink 0.7s infinite;
  }

  @keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
  }
</style>

<script>
  const text = "ยินดีต้อนรับ";
  let index = 0;
  let isDeleting = false;
  const speed = 300;
  const delay = 2000;

  function typeEffect() {
    const typingElement = document.getElementById('typingEffect');
    typingElement.textContent = text.slice(0, index);

    if (!isDeleting) {
      if (index < text.length) {
        index++;
        setTimeout(typeEffect, speed);
      } else {
        setTimeout(() => {
          isDeleting = true;
          setTimeout(typeEffect, speed);
        }, delay);
      }
    } else {
      if (index > 0) {
        index--;
        setTimeout(typeEffect, 100);
      } else {
        isDeleting = false;
        setTimeout(typeEffect, 100);
      }
    }
  }

  document.addEventListener('DOMContentLoaded', (event) => {
    typeEffect();
  });
</script>

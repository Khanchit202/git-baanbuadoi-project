<div id="typingEffect"></div>

<script>
  const text = "ยินดีตอนรับ";
  let index = 0;
  const speed = 300; // speed in milliseconds
  const delay = 2000; // delay before restarting

  function typeEffect() {
    const typingElement = document.getElementById('typingEffect');
    typingElement.textContent = text.slice(0, index);

    if (index < text.length) {
      index++;
      setTimeout(typeEffect, speed);
    } else {
      index = 0;
      setTimeout(typeEffect, delay); // Delay before restarting
    }
  }

  document.addEventListener('DOMContentLoaded', (event) => {
    typeEffect();
  });
</script>

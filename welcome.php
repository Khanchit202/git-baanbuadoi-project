<div id="typingEffect"></div>

<script>
  const text = "ยินดีต้อนรับ";
  let index = 0;
  const speed = 300;
  const delay = 2000;

  function typeEffect() {
    const typingElement = document.getElementById('typingEffect');
    typingElement.textContent = text.slice(0, index);

    if (index < text.length) {
      index++;
      setTimeout(typeEffect, speed);
    } else {
      // เมื่อข้อความครบแล้วให้แสดงทั้งหมด
      typingElement.textContent = text;
      setTimeout(() => {
        // รอให้ครบ 2 วินาที จากนั้นลบข้อความและเริ่มใหม่
        index = 0;
        typingElement.style.visibility = 'hidden';
        setTimeout(() => {
          typingElement.style.visibility = 'visible';
          typeEffect();
        }, 100);
      }, delay);
    }
  }

  document.addEventListener('DOMContentLoaded', (event) => {
    typeEffect();
  });
</script>

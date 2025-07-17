document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.getElementById('booksCarousel');
  const titleElement = document.getElementById('books-section-title');
  const titleMobileElement = document.getElementById('books-section-title-mobile');

  let lastDirection = 'next';

  const iconClasses = {
    "Libros populares": "fas fa-fire text-warning me-2",
    "Libros nuevos": "fas fa-plus text-success me-2",
  };

  function animateFadeOut(direction) {
    [titleElement, titleMobileElement].forEach(el => {
      el.classList.remove('fade-in', 'fade-out-left', 'fade-out-right');
      if (direction === 'next') {
        el.classList.add('fade-out-left');
      } else {
        el.classList.add('fade-out-right');
      }
    });
  }

  function animateFadeIn(newTitle) {
    [titleElement, titleMobileElement].forEach(el => {
      el.querySelector('.carousel-title-text').textContent = newTitle;
      const icon = el.querySelector('i');
      if (iconClasses[newTitle]) {
        icon.className = iconClasses[newTitle];
      }
      el.classList.remove('fade-out-left', 'fade-out-right');
      el.classList.add('fade-in');
      setTimeout(() => {
        el.classList.remove('fade-in');
      }, 300);
    });
  }

  carousel.addEventListener('slide.bs.carousel', (e) => {
    animateFadeOut(lastDirection);
  });

  carousel.addEventListener('slid.bs.carousel', () => {
    const activeSlide = carousel.querySelector('.carousel-item.active');
    const newTitle = activeSlide.getAttribute('data-title');
    animateFadeIn(newTitle);
  });

  document.querySelectorAll('.carousel-control-prev').forEach(btn => {
    btn.addEventListener('click', () => {
      lastDirection = 'prev';
    });
  });

  document.querySelectorAll('.carousel-control-next').forEach(btn => {
    btn.addEventListener('click', () => {
      lastDirection = 'next';
    });
  });

  document.getElementById('prevBtnMobile').addEventListener('click', () => {
    lastDirection = 'prev';
  });

  document.getElementById('nextBtnMobile').addEventListener('click', () => {
    lastDirection = 'next';
  });

  const firstSlide = carousel.querySelector('.carousel-item.active');
  const firstTitle = firstSlide.getAttribute('data-title');
  animateFadeIn(firstTitle);
});
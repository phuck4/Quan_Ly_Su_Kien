
  // Add scroll effect to navigation
  window.addEventListener('scroll', () => {
    const nav = document.querySelector('.sticky-nav');
    if (window.scrollY > 100) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  });

  // Simple slider
  let currentSlide = 0;
  const slides = document.querySelectorAll('.hero-slider .slide');
  
  function showSlide(n) {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[n].classList.add('active');
  }

  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }, 5000);
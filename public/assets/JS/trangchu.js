// JavaScript cho trang chủ QNP Events

document.addEventListener('DOMContentLoaded', function() {
  // Các biến
  const headerSlider = document.getElementById('headerSlider');
  const testimonialSlider = document.getElementById('testimonialsSlider');
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const navLinks = document.getElementById('navLinks');
  const contactForm = document.getElementById('contactForm');
  const newsletterForm = document.getElementById('newsletterForm');

  // Hàm khởi tạo
  function init() {
    initializeSlider(headerSlider);
    initializeSlider(testimonialSlider);
    setupMobileMenu();
    setupSmoothScroll();
    setupFormSubmission();
    setupStickyNav();
  }

  // Khởi tạo slider
  function initializeSlider(sliderElement) {
    if (!sliderElement) return;

    const slides = sliderElement.querySelectorAll('.slide, .testimonial-slide');
    const prevBtn = sliderElement.querySelector('.prev-btn');
    const nextBtn = sliderElement.querySelector('.next-btn');
    const dots = sliderElement.querySelectorAll('.dot');
    let currentSlide = 0;
    let slideInterval;

    // Thiết lập slider tự động chạy
    function startSlideInterval() {
      slideInterval = setInterval(() => {
        moveToNextSlide();
      }, 5000);
    }

    // Dừng slider khi người dùng tương tác
    function stopSlideInterval() {
      clearInterval(slideInterval);
    }

    // Chuyển đến slide được chỉ định
    function moveToSlide(index) {
      // Ẩn slide hiện tại
      slides[currentSlide].classList.remove('active');
      
      // Cập nhật chỉ số slide hiện tại
      currentSlide = (index + slides.length) % slides.length;
      
      // Hiển thị slide mới
      slides[currentSlide].classList.add('active');
      
      // Cập nhật trạng thái của dots
      if (dots.length > 0) {
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentSlide].classList.add('active');
      }
    }

    // Chuyển đến slide tiếp theo
    function moveToNextSlide() {
      moveToSlide(currentSlide + 1);
    }

    // Chuyển đến slide trước đó
    function moveToPrevSlide() {
      moveToSlide(currentSlide - 1);
    }

    // Thêm sự kiện cho nút điều hướng
    if (prevBtn && nextBtn) {
      prevBtn.addEventListener('click', () => {
        moveToPrevSlide();
        stopSlideInterval();
        startSlideInterval();
      });

      nextBtn.addEventListener('click', () => {
        moveToNextSlide();
        stopSlideInterval();
        startSlideInterval();
      });
    }

    // Thêm sự kiện cho các dots
    if (dots.length > 0) {
      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          moveToSlide(index);
          stopSlideInterval();
          startSlideInterval();
        });
      });
    }

    // Bắt đầu slider
    startSlideInterval();
  }

  // Thiết lập menu mobile
  function setupMobileMenu() {
    if (!mobileMenuBtn || !navLinks) return;

    mobileMenuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      
      // Thay đổi icon của nút menu
      const icon = mobileMenuBtn.querySelector('i');
      if (icon) {
        if (navLinks.classList.contains('active')) {
          icon.classList.remove('fa-bars');
          icon.classList.add('fa-times');
        } else {
          icon.classList.remove('fa-times');
          icon.classList.add('fa-bars');
        }
      }
    });

    // Đóng menu khi click vào link
    const navLinkItems = navLinks.querySelectorAll('a');
    navLinkItems.forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          navLinks.classList.remove('active');
          
          const icon = mobileMenuBtn.querySelector('i');
          if (icon) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
          }
        }
      });
    });
  }

  // Thiết lập smooth scroll
  function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 70, // Trừ đi chiều cao của nav
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // Thiết lập xử lý form
  function setupFormSubmission() {
    // Xử lý form liên hệ
    if (contactForm) {
      contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Thêm mã xử lý gửi form liên hệ ở đây
        alert('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong thời gian sớm nhất.');
        contactForm.reset();
      });
    }

    // Xử lý form đăng ký nhận tin
    if (newsletterForm) {
      newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Thêm mã xử lý đăng ký nhận tin ở đây
        alert('Cảm ơn bạn đã đăng ký nhận tin!');
        newsletterForm.reset();
      });
    }
  }

  // Thiết lập sticky navigation
  function setupStickyNav() {
    const nav = document.querySelector('.sticky-nav');
    const heroHeader = document.querySelector('.hero-header');
    
    if (!nav || !heroHeader) return;
    
    const navHeight = nav.offsetHeight;
    const heroHeight = heroHeader.offsetHeight;
    
    window.addEventListener('scroll', () => {
      if (window.scrollY >= heroHeight - navHeight) {
        nav.classList.add('sticky-active');
      } else {
        nav.classList.remove('sticky-active');
      }
    });
  }

  // Kích hoạt các phần tử active khi scroll
  function handleScrollAnimation() {
    const elements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });
    
    elements.forEach(element => {
      observer.observe(element);
    });
  }

  // Khởi chạy tất cả các hàm
  init();
});
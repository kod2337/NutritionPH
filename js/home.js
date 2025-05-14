// Initialize AOS with more modern settings
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS animation library
    AOS.init({
        duration: 800,
        offset: 100,
        once: false,
        mirror: true,
        easing: 'ease-in-out'
    });

    // Welcome popup with better animation
    setTimeout(() => {
        const popup = document.getElementById("welcomePopup");
        if (popup) {
            popup.style.transform = "translate(-50%, -50%) scale(1.1)";
            popup.style.opacity = "0";
            setTimeout(() => popup.style.display = "none", 500);
        }
    }, 5000);

    // Initialize Swiper with more modern options
    var swiper = new Swiper(".hero-slider", {
        loop: true,
        grabCursor: true,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
        speed: 1000,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    // Reveal animations on scroll
    const observerOptions = {
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.product-card, .category-card, .stats-card').forEach(el => {
        el.classList.add('reveal');
        observer.observe(el);
    });

    // Add smooth scrolling behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
}); 
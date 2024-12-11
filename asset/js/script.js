const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelectorAll('.nav-link');
const iconHamburger = document.getElementById('icon-hamburger');
const iconClose = document.getElementById('icon-close');

let isMenuOpen = false;

// Toggle menu and change icon
menuToggle.addEventListener('click', () => {
    isMenuOpen = !isMenuOpen;
    if (isMenuOpen) {
        mobileMenu.classList.remove('hidden', 'slide-up');
        mobileMenu.classList.add('slide-down');
        iconHamburger.classList.add('hidden');
        iconClose.classList.remove('hidden');
    } else {
        mobileMenu.classList.remove('slide-down');
        mobileMenu.classList.add('slide-up');
        setTimeout(() => mobileMenu.classList.add('hidden'), 300);
        iconHamburger.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }
});

// Close menu when a link is clicked
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        isMenuOpen = false;
        mobileMenu.classList.remove('slide-down');
        mobileMenu.classList.add('slide-up');
        setTimeout(() => mobileMenu.classList.add('hidden'), 300);
        iconHamburger.classList.remove('hidden');
        iconClose.classList.add('hidden');
    });
});
function initMap() {
    const location = { lat: 55.7558, lng: 37.6173 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15, center: location,
    });
    new google.maps.Marker({ position: location, map: map, title: "We are here!" });
}

document.querySelectorAll('.nav-link').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

const sections = document.querySelectorAll('.fade-section');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (window.scrollY >= sectionTop) current = section.getAttribute('id');
        if (window.scrollY >= sectionTop - 100 && window.scrollY < sectionTop + section.offsetHeight - 100) {
            section.classList.add('in-view');
        } else {
            section.classList.remove('in-view');
        }
    });
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').substring(1) === current) link.classList.add('active');
    });
});
document.querySelectorAll('.card .btn-primary').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const card = this.closest('.card');
        document.getElementById('modalImage').src = card.querySelector('img').src;
        document.getElementById('modalName').textContent = card.querySelector('.card-title').textContent;
        document.getElementById('modalDescription').textContent = card.querySelector('.card-text').textContent;
        document.getElementById('modalPrice').textContent = card.querySelector('.text-muted').textContent;
        new bootstrap.Modal(document.getElementById('productModal')).show();
    });
});

const darkModeSwitch = document.getElementById('darkModeSwitch');
darkModeSwitch.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
});

if (localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-mode');
    darkModeSwitch.checked = true;
}
document.addEventListener('DOMContentLoaded', () => {
    const welcomeMessage = document.getElementById('welcome-message');
    if (welcomeMessage) {
        setTimeout(() => {
            welcomeMessage.style.display = 'none';
        }, 5000); 
    }
});
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
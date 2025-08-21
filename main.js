// Sidebar navigation logic
document.querySelectorAll('.sidebar-nav nav ul li a').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    // Remove active from all links
    document.querySelectorAll('.sidebar-nav nav ul li a').forEach(l => l.classList.remove('active'));
    // Add active to clicked link
    this.classList.add('active');
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
    // Show the selected section
    const section = document.getElementById(this.dataset.section);
    if (section) section.classList.add('active');
    // Scroll to top of content
    document.querySelector('.main-content').scrollTo({ top: 0, behavior: 'smooth' });
  });
});

// Back to Top Button
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  if (window.scrollY > 300) {
    backToTop.style.display = 'flex';
  } else {
    backToTop.style.display = 'none';
  }
});
backToTop.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Smooth scroll for nav links
document.querySelectorAll('.top-nav a').forEach(link => {
  link.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

// Contact form alert
document.querySelector('form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Thank you for reaching out!');
});
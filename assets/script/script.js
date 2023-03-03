const sidebar = document.querySelector('.fixed-sidebar');
const home = document.querySelector('.home');

window.addEventListener('scroll', () => {
  if (window.scrollY >= home.offsetHeight) {
    sidebar.classList.add('sticky');
  } else {
    sidebar.classList.remove('sticky');
  }
});
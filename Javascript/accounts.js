const container = document.getElementById('container');
const registerbtn = document.getElementById('register');
const loginbtn = document.getElementById('login');

registerbtn.addEventListener('click', () => {
  container.classList.toggle("active");
});

loginbtn.addEventListener('click', () => {
  container.classList.toggle("active");
});
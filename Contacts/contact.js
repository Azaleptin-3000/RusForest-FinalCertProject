console.log('Скрипт загружен');

const burgerMenu = document.querySelector('.burger-menu');
const menu = document.querySelector('.menu');

if (burgerMenu) {
    burgerMenu.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
}

document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    if (name === '' || email === '' || message === '') {
        alert('Пожалуйста, заполните все поля.');
        return;
    }

    alert('Заявка отправлена!');
    this.submit();
});
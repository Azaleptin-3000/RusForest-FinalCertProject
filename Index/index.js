console.log('Скрипт загружен');

const burgerMenu = document.querySelector('.burger-menu');
const menu = document.querySelector('.menu');

burgerMenu.addEventListener('click', (event) => {
    event.stopPropagation(); // Останавливаем всплытие события
    menu.classList.toggle('active'); // Переключаем видимость меню
});

// Закрытие меню при клике вне его области
document.addEventListener('click', (event) => {
    if (menu.classList.contains('active') && !menu.contains(event.target)) {
        menu.classList.remove('active');
    }
});
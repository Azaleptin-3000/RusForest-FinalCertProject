document.addEventListener('DOMContentLoaded', () => {
    updateCartCount(); // Обновляем счетчик при загрузке страницы

    // Добавляем обработчик события на значок корзины
    const basketIcon = document.querySelector('.basket-icon');
    if (basketIcon) {
        basketIcon.addEventListener('click', () => {
            window.location.href = '../Basket/basket.html'; // Перенаправление на страницу корзины
        });
    }
});

// Функция для добавления товара в корзину и обновления счетчика
function addItemToCart(item) {
    // Получаем корзину из localStorage или создаем пустую
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Добавляем новый товар в корзину
    cart.push(item);
    
    // Обновляем данные корзины в localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Обновляем значок с количеством товаров
    updateCartCount();
}

// Функция для обновления количества товаров в корзине
function updateCartCount() {
    const cartCountElement = document.querySelector('.cart-count');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const itemCount = cart.length; // Количество товаров в корзине

    if (cartCountElement) {
        if (itemCount > 0) {
            cartCountElement.textContent = itemCount;
            cartCountElement.style.display = 'block'; // Показать кружок
        } else {
            cartCountElement.style.display = 'none'; // Скрыть кружок
        }
    }
}

// Пример использования функции для добавления товара
// Например, вызов addItemToCart({name: "Пример товара", price: 100});
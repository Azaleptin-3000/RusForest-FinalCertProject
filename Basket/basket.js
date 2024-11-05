// Пример товаров с ценами
const products = {
    1: { name: 'Саженец Кедра сибирского', price: 3000 },
    2: { name: 'Саженец Сосны обыкновенной', price: 2000 },
    3: { name: 'Саженец Ели обыкновенной', price: 1000 },
    4: { name: 'Саженец Берёзы повислой', price: 1000 },
    5: { name: 'Саженец Дуба черешчатого', price: 2000 },
};

// Функция отображения товаров в корзине с чекбоксами
function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartContainer = document.getElementById('cart-items');
    const totalCostContainer = document.getElementById('total-cost');

    cartContainer.innerHTML = ''; // Очищаем контейнер

    if (cart.length === 0) {
        cartContainer.innerHTML = "<p>Ваша корзина пуста.</p>";
        totalCostContainer.innerHTML = ''; // Очищаем стоимость
    } else {
        let totalCost = 0; // Инициализируем общую стоимость

        cart.forEach((productId, index) => {
            const product = products[productId];
            if (product) {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');

                // Создаем чекбокс для каждого товара
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.classList.add('remove-checkbox');
                checkbox.dataset.index = index;

                // Добавляем чекбокс и информацию о товаре
                cartItem.appendChild(checkbox);
                cartItem.appendChild(document.createTextNode(` ${product.name}: ${product.price} руб.`));
                cartContainer.appendChild(cartItem);

                // Считаем общую стоимость
                totalCost += product.price;
            } else {
                console.warn(`Продукт с ID ${productId} не найден!`); // Лог для отсутствующих продуктов
            }
        });

        totalCostContainer.innerHTML = `Общая стоимость: ${totalCost} руб.`; // Выводим общую стоимость
    }
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

// Функция удаления выбранных товаров
function removeSelectedItems() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const checkboxes = document.querySelectorAll('.remove-checkbox:checked');

    checkboxes.forEach(checkbox => {
        const index = parseInt(checkbox.dataset.index);
        cart.splice(index, 1); // Удаляем товар по индексу
    });

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay(); // Обновляем отображение корзины
    updateCartCount(); // Обновляем счетчик товаров
}

// Функция для полной очистки корзины
function clearCart() {
    localStorage.removeItem('cart'); // Удаляем корзину из localStorage
    updateCartDisplay(); // Обновляем отображение корзины
    updateCartCount(); // Обновляем счетчик товаров
}

// Обработчик событий при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    updateCartDisplay(); // Отображаем товары при загрузке страницы
    updateCartCount();   // Обновляем счетчик товаров

    // Переход к оплате
    document.querySelector('#checkout-button').addEventListener('click', () => {
        window.location.href = '../Basket/checkout.html';
    });

    // Удаление выбранных товаров
    document.querySelector('#remove-item-button').addEventListener('click', removeSelectedItems);

    // Очистка всей корзины
    document.querySelector('#clear-cart-button').addEventListener('click', clearCart);
});
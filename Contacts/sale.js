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

// Функция добавления товара в корзину
function addItemToCart(itemId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(itemId); // Добавляем id товара в корзину
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount(); // Обновляем значок с количеством товаров
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

document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll("#gall img");
  
    images.forEach((image) => {
      image.addEventListener("click", function () {
        // Проверка, увеличено ли текущее изображение
        if (this.classList.contains("zoomed")) {
          this.classList.remove("zoomed"); // Уменьшение обратно
        } else {
          // Убираем увеличение со всех изображений
          images.forEach((img) => img.classList.remove("zoomed"));
          this.classList.add("zoomed"); // Увеличиваем текущее изображение
        }
      });
    });
  });
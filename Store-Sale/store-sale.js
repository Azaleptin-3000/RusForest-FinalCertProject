document.addEventListener('DOMContentLoaded', () => {
  updateCartCount(); // Обновляем счетчик при загрузке страницы

  // Обработчик кликов по кнопкам «Купить»
  document.querySelectorAll('.buy-button').forEach(button => {
      button.addEventListener('click', function () {
          const item = this.closest('.item');
          const name = item.querySelector('img').dataset.name;
          const price = parseInt(item.querySelector('img').dataset.price);

          // Получаем текущую корзину или создаем новую
          let cart = JSON.parse(localStorage.getItem('cart')) || [];

          // Проверяем, есть ли товар в корзине, и увеличиваем количество, если да
          const existingItem = cart.find(i => i.name === name);
          if (existingItem) {
              existingItem.quantity++;
          } else {
              cart.push({ name, price, quantity: 1 });
          }

          // Обновляем localStorage и счетчик
          localStorage.setItem('cart', JSON.stringify(cart));
          updateCartCount();
          alert(`${name} добавлен(а) в корзину!`);
      });
  });

  // Настраиваем зум при клике на карточки товаров
  document.querySelectorAll('.item img').forEach(img => {
      img.addEventListener('click', function () {
          this.classList.toggle('zoomed'); // Переключаем класс для зума
      });
  });
});

// Функция для обновления количества товаров в кружке
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const itemCount = cart.reduce((total, item) => total + item.quantity, 0);

  const cartCountElement = document.querySelector('.cart-count');
  if (itemCount > 0) {
      cartCountElement.textContent = itemCount;
      cartCountElement.style.display = 'block'; // Показываем кружок
  } else {
      cartCountElement.style.display = 'none'; // Скрываем кружок, если корзина пуста
  }
}

// Для работы зума фото товаров
document.querySelectorAll("#gall img").forEach((img) => {
  img.addEventListener("click", () => {
    img.classList.toggle("zoomed");
  });
});
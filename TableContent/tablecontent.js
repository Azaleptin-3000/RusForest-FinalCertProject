window.addEventListener("scroll", () => {
    const arrowIndicator = document.querySelector(".arrow-indicator");
  
    // Проверяем, что прокрутили страницу вниз
    if (window.scrollY > 100) {
      arrowIndicator.style.opacity = "0"; // Скрываем стрелки
    } else {
      arrowIndicator.style.opacity = "1"; // Показываем стрелки
    }
  });
  
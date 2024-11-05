<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата</title>
    <style>
        /* Общий стиль страницы */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
        }

        /* Контейнер формы */
        .card-form-container {
            width: 350px;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Заголовок */
        .card-form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Поля ввода */
        .card-form-container input[type="text"],
        .card-form-container input[type="number"],
        .card-form-container input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        /* Кнопка отправки */
        .card-form-container button {
            width: 40%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card-form-container button:hover {
            background-color: #45a049;
        }

        /* Сообщение об успешном платеже */
        #success-message {
            display: none;
            text-align: center;
        }

        #success-message h2 {
            color: #4CAF50;
        }

        #return-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        #return-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="card-form-container">
    <h2>Оплата банковской картой</h2>
    <!-- Форма оплаты -->
    <form id="payment-form">
        <label for="card-number">Номер карты:</label>
        <input type="text" id="card-number" name="card_number" placeholder="0000 0000 0000 0000" required>

        <label for="card-expiry">Срок действия:</label>
        <input type="date" id="card-expiry" name="card_expiry" required>

        <label for="card-cvv">CVV:</label>
        <input type="number" id="card-cvv" name="card_cvv" placeholder="123" required pattern="\d{3}">

        <button type="submit">Оплатить</button>
    </form>

    <!-- Сообщение об успешном платеже -->
    <div id="success-message">
        <h2>Спасибо за ваше пожертвование!</h2>
        <button id="return-button" onclick="location.href='contacts.html'">Вернуться на страницу контактов</button>
    </div>
</div>

<script>
    // Функция для форматирования номера карты
    function formatCardNumber(value) {
        // Удаляем все, кроме цифр
        const cleaned = value.replace(/\D/g, '');
        const groups = cleaned.match(/.{1,4}/g); // Разделяем на группы по 4
        return groups ? groups.join(' ') : '';
    }

    document.getElementById('card-number').addEventListener('input', function() {
        this.value = formatCardNumber(this.value);
    });

    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Получение значений из формы
        const cardNumber = document.getElementById('card-number').value.replace(/\s/g, ''); // Убираем пробелы для проверки
        const cardExpiry = new Date(document.getElementById('card-expiry').value);
        const cardCvv = document.getElementById('card-cvv').value.trim();
        const currentDate = new Date();

        // Проверка формата данных
        const isCardNumberValid = /^\d{16}$/.test(cardNumber);
        const isCvvValid = /^\d{3}$/.test(cardCvv);
        const isExpiryValid = cardExpiry <= currentDate; // Проверяем, что срок действия не больше сегодняшней даты

        if (isCardNumberValid && isCvvValid && isExpiryValid) {
            // Скрыть форму и показать сообщение об успешном платеже
            document.getElementById('payment-form').style.display = 'none';
            document.getElementById('success-message').style.display = 'block';
        } else {
            alert("Пожалуйста, введите корректные данные.");
        }
    });
</script>

</body>
</html>
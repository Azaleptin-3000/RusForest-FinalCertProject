<?php
// thank_you.php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спасибо за обратную связь</title>
    <style>
        /* Стили благодарности за обратную связь */
        .thank-you-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .return-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .return-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <h2>Спасибо за обратную связь!</h2>
        <p>Ваше сообщение было успешно отправлено.</p>
        <a href="contacts.html">
            <button class="return-button">Вернуться на страницу контактов</button>
        </a>
    </div>
</body>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о погоде</title>
    <link rel="stylesheet" href="weather.css"> <!-- Подключите CSS для оформления -->
</head>
    <body>
    <div class="container">
        <h1>Информация о погоде</h1>

        <?php if (isset($_SESSION['weather'])): ?>
            <h2><?php echo htmlspecialchars($_SESSION['weather']['location']); ?></h2>
            <p>Температура: <?php echo htmlspecialchars($_SESSION['weather']['temp']); ?>°C</p>
            <p>Описание: <?php echo htmlspecialchars($_SESSION['weather']['description']); ?></p>
            <img src="<?php echo htmlspecialchars($_SESSION['weather']['icon']); ?>" alt="Погода" />
        <?php else: ?>
            <p>Нет информации о погоде.</p>
        <?php endif; ?>

        <button onclick="window.location.href='contacts.html'" class="return-btn">Вернуться назад</button>

        <?php 
        // Очищаем данные о погоде после отображения
        unset($_SESSION['weather']); 
        ?>
    </div>

    <style>
        /* Простой CSS для оформления */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #007BFF;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        img {
            display: block;
            margin: 0 auto;
            width: 100px; /* Регулируйте размер изображения по необходимости */
        }
        .return-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .return-btn:hover {
            background-color: #0056b3;
        }
    </style>
    </body>
</html>
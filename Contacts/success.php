<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешная отправка</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            /* светло-голубой фон */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* высота страницы */
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #fff;
            /* белый фон */
            padding: 20px;
            border-radius: 10px;
            /* закругленные углы */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            /* тень */
        }

        h1 {
            color: #4CAF50;
            /* зеленый цвет */
        }

        p {
            font-size: 18px;
            color: #333;
            /* темно-серый цвет текста */
        }

        .button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            /* зеленая кнопка */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #45a049;
            /* более темный оттенок при наведении */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Спасибо за ваше сообщение!</h1>
        <p>Мы свяжемся с вами в ближайшее время.</p>
        <button class="button" onclick="window.location.href='potrfolio.html'">Вернуться на главную</button>
    </div>
</body>

</html>
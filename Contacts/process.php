<?php
session_start();
require 'db.php'; // Подключаемся к базе данных

try {
    // 1. Обработка формы "Запрос погоды"
    if (isset($_POST['city'])) {
        $city = trim($_POST['city']);

        if (!empty($city)) {
            // API ключ и URL
            $weatherApiKey = '2bde616c073248a5b00120453240411';
            $url = "https://api.weatherapi.com/v1/current.json?key=$weatherApiKey&q=" . urlencode($city) . "&lang=ru";

            // Выполняем запрос к API погоды
            $response = @file_get_contents($url);

            if ($response === FALSE) {
                $_SESSION['weather_error'] = 'Ошибка подключения к сервису погоды.';
                header("Location: weather.php");
                exit();
            }

            // Декодируем JSON ответ
            $data = json_decode($response, true);
            error_log("Ответ от API: " . print_r($data, true)); // Лог для проверки API-ответа

            // Проверка данных и их сохранение в сессии
            if (isset($data['error'])) {
                $_SESSION['weather_error'] = 'Ошибка получения данных о погоде: ' . $data['error']['message'];
            } else {
                $_SESSION['weather'] = [
                    'city' => $data['location']['name'],
                    'country' => $data['location']['country'],
                    'temp' => $data['current']['temp_c'],
                    'weather' => $data['current']['condition']['text'],
                    'icon' => $data['current']['condition']['icon']
                ];
                $_SESSION['weather_success'] = "Данные о погоде для города {$data['location']['name']} успешно получены.";
            }

            // Перенаправление на weather.php
            header("Location: weather.php");
            exit();
        } else {
            $_SESSION['weather_error'] = "Пожалуйста, укажите название города.";
            header("Location: weather.php");
            exit();
        }

    // 2. Обработка формы "Связаться с нами"
    } elseif (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['message'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        if (!empty($username) && !empty($email) && !empty($message)) {
            // Подготовленный запрос для вставки данных в таблицу contacts
            $stmt = $pdo->prepare("INSERT INTO contacts (username, email, message) VALUES (:username, :email, :message)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            header("Location: thank_you.php");
            exit();
        } else {
            header("Location: contacts.html?status=error&message=" . urlencode("Пожалуйста, заполните все поля!"));
            exit();
        }

    // 3. Обработка формы «Сделать пожертвование»
    } elseif (isset($_POST['donor_name']) && isset($_POST['amount'])) {
        $donor_name = trim($_POST['donor_name']);
        $amount = (float) $_POST['amount'];
        $donation_message = isset($_POST['message']) ? trim($_POST['message']) : null; // Поле message может быть необязательным

        if (!empty($donor_name) && $amount > 0) {
            // Подготовленный запрос для вставки данных в таблицу donations
            $stmt = $pdo->prepare("INSERT INTO donations (donor_name, amount, message) VALUES (:donor_name, :amount, :message)");
            $stmt->bindParam(':donor_name', $donor_name);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':message', $donation_message);
            $stmt->execute();

            // Перенаправляем пользователя на виртуальную форму оплаты
            header("Location: virtual_payment_form.php");
            exit();
        } else {
            $messages[] = "Пожалуйста, заполните все обязательные поля!";
            header("Location: contacts.html?status=error&message=" . urlencode("Пожалуйста, заполните все обязательные поля!"));
            exit();
        }
    } else {
        $messages[] = "Пожалуйста, заполните все поля!";
        header("Location: contacts.html?status=error&message=" . urlencode("Пожалуйста, заполните все поля!"));
        exit();
    }

} catch (PDOException $e) {
    header("Location: contacts.html?status=error&message=" . urlencode("Ошибка при записи в базу данных: " . $e->getMessage()));
    exit();
}
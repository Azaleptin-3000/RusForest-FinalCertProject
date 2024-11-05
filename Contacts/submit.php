<?php
require 'db.php'; // Подключаемся к базе данных

try {
    // Определяем, какая форма была отправлена
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Обработка формы "Связаться с нами"
        
        // Проверка на заполнение полей
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
        
        // Проверяем, что поля не пустые
        if (!empty($name) && !empty($email) && !empty($message)) {
            // Подготовленный запрос для вставки данных в таблицу contacts
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute(); // Выполняем запрос

            echo "Сообщение успешно отправлено!";
        } else {
            echo "Пожалуйста, заполните все поля!";
        }

    } elseif (isset($_POST['donor_name']) && isset($_POST['amount'])) {
        // Обработка формы "Пожертвования"
        
        // Проверка на заполнение полей
        $donor_name = trim($_POST['donor_name']);
        $amount = (float) $_POST['amount'];
        $donation_message = isset($_POST['message']) ? trim($_POST['message']) : null;

        if (!empty($donor_name) && $amount > 0) {
            // Подготовленный запрос для вставки данных в таблицу donations
            $stmt = $pdo->prepare("INSERT INTO donations (donor_name, amount, message) VALUES (:donor_name, :amount, :message)");
            $stmt->bindParam(':donor_name', $donor_name);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':message', $donation_message);
            $stmt->execute(); // Выполняем запрос

            echo "Спасибо за ваше пожертвование! Перенаправляем на страницу оплаты...";
            header("Location: virtual_payment_form.php");
            exit();
        } else {
            echo "Пожалуйста, заполните все обязательные поля!";
        }

    } else {
        // Если данные неполные, выводим сообщение об ошибке
        echo "Пожалуйста, заполните все поля!";
    }

} catch (PDOException $e) {
    // Обработка ошибок при работе с базой данных
    echo "Ошибка при записи в базу данных: " . $e->getMessage();
}
?>
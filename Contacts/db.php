<?php
// db.php - Подключение к базе данных через PDO

$host = 'localhost';    // хост базы данных
$db = 'form_data';      // имя базы данных
$user = 'root';         // имя пользователя
$pass = '';             // пароль

try {
    // Создаем объект PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Устанавливаем режим обработки ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // В случае ошибки выводим сообщение
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

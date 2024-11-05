<?php
// Подключение к базе данных
$host = 'localhost';
$db = 'form_data'; // Убедитесь, что здесь указано правильное имя базы данных
$user = 'root'; // Ваше имя пользователя
$pass = ''; // Ваш пароль

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из формы
    $name = $_POST['customer_name'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Проверка наличия обязательных данных
    if (empty($name) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        throw new Exception("Все поля обязательны для заполнения.");
    }

    // Добавление данных в таблицу заказов
    $stmt = $pdo->prepare("INSERT INTO orders (name, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $cardNumber, $expiryDate, $cvv]);

    echo json_encode(["status" => "success", "message" => "Заказ успешно оформлен!"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Ошибка: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Ошибка: " . $e->getMessage()]);
}

echo json_encode(['status' => 'success', 'message' => 'Оплата прошла успешно']);

?>
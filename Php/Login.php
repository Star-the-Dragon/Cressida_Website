<?php
$config = require_once 'db.php';
require_once 'notification.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    echo 'sos1';
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {
        $errors[] = 'Введите email';
    }
    echo 'sos2';
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    if (empty($password)) {
        $errors[] = 'Введите пароль';
    }
    echo 'sos3';
    if (empty($errors)) {
        try {
            // Создаем соединение с базой данных
            $connection = new mysqli($config['dbHost'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
            echo 'sos4';
            if ($connection->connect_error) {
                throw new Exception('Ошибка подключения: ' . $connection->connect_error);
                echo 'Ошибка подключения';
            }
            echo 'sos5';
            // Подготавливаем запрос
            $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
            if (!$stmt) {
                throw new Exception('Ошибка подготовки запроса: ' . $connection->error);
                echo 'Ошибка подготовки запроса';
            }
            echo 'sos6';
            // Привязываем параметры и выполняем запрос
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            echo 'sos7';
            // Если пользователь найден, сверяем пароли
            if ($user = $result->fetch_assoc()) {
                // Если пароли совпадают, сохраняем данные пользователя в сессию и редиректим на главную страницу
                echo 'sos8';
                if (password_verify($password, $user['password'])) {
                    echo 'sos9';
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    echo 'sos10';
                    header('Location: /account.php');
                    exit;
                }
                notify('Пользователь с такой комбинацией email и пароля не существует');
            } else {
                notify('Пользователь с такой комбинацией email и пароля не существует');
            }
        } catch (Exception $e) {
            notify('Произошла ошибка при авторизации: ' . $e->getMessage());
            error_log($e->__toString());
        } finally {
            // Закрываем соединение
            if (isset($connection)) {
                $connection->close();
            }
        }
    } else {
        notify(implode('<br>', $errors));
    }
}
?>

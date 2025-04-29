<?php
$config = require_once 'db.php';
require_once 'notification.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    echo 'sos1';
    // Получение данных из POST
    $login = $_POST['login'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $number = $_POST['phone'] ?? '';
    echo 'sos2';
    // Проверка на пустые поля
    if (empty($login)) {
        echo 'sos3';
        $errors[] = 'Введите логин';
    }
    if (empty($email)) {
        echo 'sos4';
        $errors[] = 'Введите email';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'sos5';
        $errors[] = 'Неверный email';
    }
    if (empty($password)) {
        echo 'sos6';
        $errors[] = 'Введите пароль';
    }
    if (strlen(trim($password)) < 6 || strlen(trim($password)) > 50) {
        echo 'sos7';
        $errors[] = 'Пароль должен содержать не менее 6 и не более 50 символов';
    }
    if (empty($name)) {
        echo 'sos8';
        $errors[] = 'Введите имя';
    }
    if (empty($surname)) {
        echo 'sos9';
        $errors[] = 'Введите фамилию';
    }
    if (empty($number)) {
        echo 'sos10';
        $errors[] = 'Введите номер телефона';
    } elseif (!preg_match('/^\+?[0-9\s()-]{10,20}$/', $number)) { // Improved regex
        echo 'sos11';
        $errors[] = 'Неверный формат номера телефона.  Допустимы цифры, пробелы, скобки и дефисы.';
    }
    echo 'sos12';
    // Если нет ошибок
    if (empty($errors)) {
        echo 'sos13';
        try {
            // Соединение с базой данных
            $connection = new mysqli($config['dbHost'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
            echo 'sos14';
            if ($connection->connect_error) {
                echo 'sos15';
                notify('Ошибка подключения к базе данных: ' . $connection->connect_error);
                exit;
            }
            echo 'sos16';
            // Проверка существования пользователя с таким email
            $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            echo 'sos17';
            if ($result->num_rows > 0) {
                echo 'sos18';
                notify('Пользователь с таким email уже существует');
            } else {
                // Вставка нового пользователя
                echo 'sos19';
                $stmt = $connection->prepare("INSERT INTO users (login, email, password, name, surname, phone) VALUES (?, ?, ?, ?, ?, ?)");
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("ssssss", $login, $email, $passwordHash, $name, $surname, $number);
                echo 'sos20';
                if (!$stmt->execute()) {
                    notify('Ошибка при добавлении пользователя: ' . $stmt->error);
                } else {
                    header('Location: /index.php');
                    exit;
                }
            }
        } catch (mysqli_sql_exception $e) {
            notify('Произошла ошибка при регистрации');
            error_log($e->__toString());
        } finally {
            if (isset($connection)) {
                $connection->close();
            }
        }
    } else {
        notify(implode('<br>', $errors));
    }
}
?>
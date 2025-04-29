<?php
    $config = require_once 'db.php';
    require_once 'notification.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        if (empty($email)) {
            $errors[] = 'Введите email';
        }
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        if (empty($password)) {
            $errors[] = 'Введите пароль';
        }
        if (empty($errors)) {
            try {
                $connection = new mysqli($config['dbHost'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
                // Пробуем извлечь пользователя из базы с предоставленным email
                $sql = "SELECT * FROM users WHERE email = ?";
                $result = $connection->execute_query($sql, [$email]);
                // Если пользователь найден, сверяем пароли
                if ($user = $result->fetch_assoc()) {
                    // Если пароли совпадают, сохраняем данные пользователя в сессию и редиректим на главную страницу
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        header('location: /index.php');
                        exit;
                    }
                    // В случае несовпадения паролей выводим сообщение, что нет пользователя с такой комбинацией
                    notify('Пользователь с такой комбинацией email и пароля не существует');
                } else {
                    // Такое же сообщение выведем, если email неверный
                    notify('Пользователь с такой комбинацией email и пароля не существует');
                }
            } catch (mysqli_sql_exception $e) {
                notify('Произошла ошибка при авторизации');
                error_log($e->__toString());
            } finally {
                if (isset($connection)) {
                    $connection->close();
                }
                notify('sos1');
            }
        } else {
            notify(implode('<br>', $errors));
            notify('sos2');
        }
    }
?>
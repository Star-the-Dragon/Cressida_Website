<?php
    // Сохраняем данные конфигурации в переменную
    $config = require_once 'db.php';
    // Подключаем нотификации
    require_once 'notification.php';
    // Инициализируем сессию
    session_start();
    // Если это POST-запрос, то есть мы нажали на кнопку "Регистрация", выполняем процесс регистрации
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // В этот массив будем собирать возможные ошибки
    $errors = [];

    //Валидируем Логин
    $login = isset($_POST['login']);
    if (empty($login)) {
        $errors[] = 'Введите логин';
    }
    // Валидируем email
    $email = isset($_POST['email']);
    if (empty($email)) {
        $errors[] = 'Введите email';
    }
    if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
        $errors[] = 'Неверный email';
    }
    // Валидируем пароль
    $password = isset($_POST['password']);
    if (empty($password)) {
        $errors[] = 'Введите пароль';
    }
    if (strlen(trim($password)) < 6 || strlen(trim($password)) > 50) {
        $errors[] = 'Пароль должен содержать не менее 6 и не более 50 символов';
    }
    if (empty($errors)) {
        try {
            // Подключаемся к базе данных
            $connection = new mysqli($config['dbHost'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
            // Делаем запрос в базу, проверяя, существует ли уже зарегистрированный пользователь с таким email
            $sql = "SELECT id FROM users WHERE email = ?";
            $result = $connection->execute_query($sql, [$email]);
            // Если такой пользователь есть, выводим сообщение
            if ($result->fetch_assoc()) {
                notify('Пользователь с таким email уже существует');
            } else { // Иначе создаем запись в базе данных с новым пользователем
                $sql = "INSERT INTO users (login, email, password) VALUES (?, ?, ?)";
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $connection->execute_query($sql, [$login, $email, $passwordHash]);
                // После создания нового пользователя редиректим на страницу авторизации

                header('location: /index.php');
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Если произошла какая-либо ошибка при регистрации, выводим ее
            notify('Произошла ошибка при регистрации');
            echo 'sos1';
            // Можно сделать запись в лог об ошибке
            error_log($e->__toString());
        } finally { // При любом исходе процесса регистрации закрываем подключение к базе данных
            if (isset($connection)) {
                $connection->close();
            }
        }
    } else { // В случае наличия ошибок выводим их на страницу
        notify(implode('<br>', $errors));
        echo 'sos2';
    }
}
?>

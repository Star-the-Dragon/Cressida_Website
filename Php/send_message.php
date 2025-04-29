<?php
    // Сохраняем данные конфигурации в переменную
    $conn = new mysqli("localhost", "root", "", "cressida_db");

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Получение данных из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Подготовка и выполнение SQL-запроса
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    // if ($stmt->execute()) {
    //     // Отправка письма пользователю
    //     $to = $email;
    //     $subject = "Спасибо за ваше сообщение";
    //     $message = "Уважаемый(ая) $name,\n\nСпасибо за ваше сообщение. Мы свяжемся с вами в ближайшее время.\n\nС уважением,\nВаша компания";
    //     $headers = "From: your_email@example.com";

    //     if (mail($to, $subject, $message, $headers)) {
    //         echo "Спасибо за ваше сообщение! Мы свяжемся с вами в ближайшее время.";
    //     } else {
    //         echo "Ошибка при отправке письма.";
    //     }
    // } else {
    //     echo "Ошибка при сохранении данных в базу данных.";
    // }
    $stmt->close();
    $conn->close();
    header('Location: /');
    exit;
?>

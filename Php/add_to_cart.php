<?php
    $conn=new mysqli("localhost", "root", "","cressida_db");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_SESSION['user_id'])) {
        $errors = [];

        $user_id=$_SESSION['user_id'];
        $product_id=$_POST["product_id"] ?? null;
        $property=$_POST["property"] ?? null;
        $quantity=$_POST["quantity"] ?? 1;

        if ($product_id === null) {
            die("Не указан ID товара");
        }
        if ($property === null) {
            die("Не указано свойство товара");
        }

        // Проверка наличия товара в корзине
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=? AND property=?");
        $stmt->bind_param("iss", $user_id, $productId, $property);
        $stmt->execute();
        // Получаем результат выполнения запроса
        $result = $stmt->get_result();
        // Получаем ассоциативный массив с данными
        $existingItem = $result->fetch_assoc();
        if ($existingItem) {
            // Если товар уже есть, увеличиваем количество
            $newQuantity = $existingItem['quantity'] + $quantity;
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $stmt->bind_param("is", $quantity, $user_id);
            $stmt->execute();
        } else {
            // Если товара нет, добавляем его
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, property, quantity) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $user_id, $product_id, $property, $quantity);
            $stmt->execute();
        }
    

        header("Location: /Cart.php");
        // $redicet = $_SERVER['HTTP_REFERER'];
        // @header ("Location: $redicet");
        exit;
    }
    else{
        header("Location: /index.php");
        exit;
    }
?>
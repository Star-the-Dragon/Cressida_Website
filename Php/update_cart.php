<?php
session_start();
$pdo=new PDO('mysql:hots=localhost;dbname=cressida_db;port=3306', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $cartId = (int) $_POST['cart_id'];
    $productId = (int) $_POST['product_id'];
    $property=(int)$_POST['property'];
    $action = $_POST['action'];
    $userId = (int) $_SESSION['user_id'];
    try {
        $stmt = $pdo->prepare("SELECT quantity FROM cart WHERE id = :cart_id AND user_id = :user_id AND product_id = :product_id AND property= :property");
        $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':property', $property, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
         if (!$row) die("Товар не найден в корзине");
        $currentQuantity = $row['quantity']; 
        if ($action == 'increase') {
            $newQuantity = $currentQuantity + 1;
        } else if ($action == 'decrease') {
            if ( $currentQuantity >= 1)
            $newQuantity = $currentQuantity - 1;
        } else $newQuantity = $currentQuantity;
        $updateStmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE id = :cart_id");
        $updateStmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
        $updateStmt->execute();
        } catch (PDOException $e) {
           die("Ошибка обновления корзины: " . $e->getMessage());
    }
     
}

header('Location: /Cart.php');
exit();
?>
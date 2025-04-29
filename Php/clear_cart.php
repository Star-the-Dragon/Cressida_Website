<?php
session_start();
$pdo=new PDO('mysql:hots=localhost;dbname=cressida_db;port=3306', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $userId = (int) $_SESSION['user_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    
    } catch (PDOException $e) {
        die("Ошибка очистки корзины: " . $e->getMessage());
    }
}
header('Location: /Cart.php');
exit();
?>
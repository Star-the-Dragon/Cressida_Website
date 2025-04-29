<!DOCTYPE html>
<html>
	<head>
		<?php require_once "Blocks/head.php"; ?>
		<script>
			function order() {
				alert("Заказ выполнен!");
			}
		</script>
	</head>
	<body>
		<?php require_once "Blocks/header.php"; ?>
		<br>
		<table border="0" width="900" cellpadding="5" cellpaccing="0" align="center">
            <td width="150" cellpadding="5" valign="top" align="center">
				<div class="cart">
					<?php
						$pdo=new PDO('mysql:hots=localhost;dbname=cressida_db;port=3306', 'root', '');

						if (isset($_SESSION['user_id'])){
							$userId = (int) $_SESSION['user_id'];
							try{
								$stmt = $pdo->prepare("SELECT cart.id as cart_id, cart.product_id, cart.quantity, cart.property, product.product_name, product.price FROM cart JOIN product ON cart.product_id = product.article WHERE cart.user_id = :user_id");
								$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
								$stmt->execute();
								$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

							} catch (PDOException $e) {
								die("Ошибка получения корзины: " . $e->getMessage());
							}
						}
						else {
							$cartItems = []; // Или перенаправление на страницу логина
						}
					?>
					<h2>Корзина</h2>
					<table>
						<thead>
						<tr>
							<th>Товар</th>
							<th>Характеристика</th>
							<th>Цена</th>
							<th>Количество</th>
							<th>Итого</th>
							<!-- <th>Действие</th> -->
						</tr>
						</thead>
						<tbody>
							<?php
                                $totalSum = 0;
                                foreach ($cartItems as $item):
                            ?>
							<tr>
							<td><a href="<?= $item['product_id'];?>.php" class="Links"><?php echo $item['product_name']; ?></a></td>
							<td><?php echo $item['property']; ?></td>
							<td><?php echo $item['price']; ?></td>
							<td>
								<form action="Php/update_cart.php" method="POST">
									<input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
									<input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
									<input type="hidden" name="property" value="<?php echo $item['property']; ?>">

									
									<input type="text" name="quantity" value="<?php echo $item['quantity']; ?>" size="2" disabled><br>
									<button type="submit" name="action" value="decrease">-</button>
									<button type="submit" name="action" value="increase">+</button>
								</form>
							</td>
							<td><?php $itemSum = $item['price'] * $item['quantity']; echo $itemSum; $totalSum += $itemSum?></td>
							<!-- <td><form action="Php/clear_item.php" method="POST">
									<input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
									<button class="feedback-button" type="submit">Удалить</button>
								</form>
							</td> -->
							</tr>
                            <?php endforeach; ?>
						</tbody>
					</table>
					<div class="total">
						<strong>Общая стоимость: <span id="total-price"><?php echo $totalSum ?> </span>руб.</strong>
					</div>
					<form action="Php/clear_cart.php" method="POST">
                  		<button class="feedback-button" type="submit">Очистить корзину</button>
                	</form>
					<div align="right"><button align="right" class="feedback-button" type="submit" onclick="order()">Заказать</button></div>
				</div>
            </td>
		</table>
		<?php require_once "Blocks/feedback.php"; ?>
	</body>
	<footer>
		<?php require_once "Blocks/footer.php"; ?>
	</footer>
</html>
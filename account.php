<!DOCTYPE html>
<html>
	<head>
		<?php require_once "Blocks/head.php"; ?>
	</head>
	<body>
		<?php require_once "Blocks/header.php"; ?>
		<br>
		<table border="0" width="900" cellpadding="5" cellpaccing="0" align="center">
            <td width="150" cellpadding="5" valign="top" align="center">
                <div>
                    <h2>Личный кабинет</h2>
					<!--  -->
					<?php
					if (isset($_SESSION['user_id'])){
						$id=$_SESSION['user_id'];
						$pdo = new PDO('mysql:host=localhost;dbname=cressida_db;port=3306', 'root', '');
						$sql="SELECT * FROM users WHERE id=?";
						$stmt = $pdo->prepare($sql);
						$stmt->execute([$id]);
						$user=$stmt->fetch();
						if ($user){
							echo "<p>Добро пожаловать, <b>".$user['login']."</b>!</p>";
						}
					}

					?>
                    <!--  -->
					<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) { ?>
					<form action="Php/logout.php" method="POST"><button type="submit" class="feedback-button">Выйти</button></form>
					<?php }?>
                </div>
                <div align="left">
                    <h3>Информация о пользователе</h3>
                    <?php
						if (isset($_SESSION['user_id'])){
							$id=$_SESSION['user_id'];
							$sql="SELECT * FROM users WHERE id=?";
							$pdo = new PDO('mysql:host=localhost;dbname=cressida_db;port=3306', 'root', '');
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$id]);
							$user=$stmt->fetch();
							if ($user){
								echo "
								<div align='left'>
								<p>Логин: ".$user['login']."</p>
								<p>Имя: ".$user['name']."</p>
								<p>Фамилия: ".$user['surname']."</p>
								<p>Почта: ".$user['email']."</p>
								<p>Телефон: ".$user['phone']."</p>
								</div>
								";
							}
						}
					?>
                </div>
                
            </td>
		</table>
		<?php require_once "Blocks/feedback.php"; ?>
	</body>
	<footer>
		<?php require_once "Blocks/footer.php"; ?>
	</footer>
</html>
<!DOCTYPE html>
<html>
    <head>
	<?php require_once "Blocks/head.php"; ?>
    </head>
    <body>
	<?php require_once "Blocks/header.php"; ?>
		<table border="0" width="1000" cellpadding="5" cellpaccing="0" align="center">
			<h1 align="center">наши товары</h1>
			<div class="product-gallery">
				<div class="product" onclick="window.location.href='coat_m.php'">
					<img src="Images/coat_man.jpg" alt="Пальто" width="75%" height="75%">
					<h3>Пальто</h3>
				</div>
				<div class="product" onclick="window.location.href='leather_m.php'">
					<img src="Images/leather_man.jpg" alt="Дубленки и кожа" width="75%" height="75%">
					<h3>Дубленки и кожа</h3>
				</div>
			</div>
		</table>
		<br>
		<?php require_once "Blocks/feedback.php"; ?>
    </body>
    <footer>
        <?php require_once "Blocks/footer.php"; ?>
    </footer>
</html>
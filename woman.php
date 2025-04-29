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
				<div class="product" onclick="window.location.href='leather_w.php'">
					<img src="Images/leather_woman.jpg" alt="Дубленки и кожа" width="75%" height="75%">
					<h3>Дубленки и кожа</h3>
				</div>
				<div class="product" onclick="window.location.href='furs_w.php'">
					<img src="Images/furs_woman.jpg" alt="Меха" width="75%" height="75%">
					<h3>Меха</h3>
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
<!DOCTYPE html>
<html>
    <head>
    <?php require_once "Blocks/head.php"; ?>
    </head>
    <body>
    <?php require_once "Blocks/header.php"; ?>
		<table border="0" width="1000" cellpadding="5" cellpaccing="0" align="center">
                
		</table>
        <table border="0" width="1000" cellpadding="5" cellpaccing="0" align="center">
            <tr>
                <h1 align="center">Дубленки и кожа</h1>
                <td>
                    <form method="GET" class="search-container">
                        <input type="text" name="query" placeholder="Поиск товаров..." value="<?php echo htmlspecialchars(isset($_GET['query']) ? $_GET['query'] : ''); ?>">
                        <button type="submit">Поиск</button>
                    </form>
                </td>	
            </tr>
            <td width="600px" cellpadding="5" valign="top" align="center">
            <div class="product-gallery">
                <?php
                    // Подключение к базе данных
                    $pdo = new PDO('mysql:host=localhost;dbname=cressida_db;port=3306', 'root', '');
                    // Получение поискового запроса
                    $query = isset($_GET['query']) ? $_GET['query'] : '';
                    // Запрос к базе данных
                    if (!empty($query)) {
                        $sql = 'SELECT * FROM product WHERE product_name LIKE :query ';
                        $stmt = $pdo->prepare($sql);
                        $search_term = "%" . $query . "%";
                        $stmt->bindParam(':query', $search_term, PDO::PARAM_STR);
                    } else {
                        $sql = 'SELECT * FROM product WHERE category="дубленка женская"';
                        $stmt = $pdo->prepare($sql);
                    }

                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_OBJ);

                    // Вывод результатов
                    if (count($products) > 0) {
                        foreach ($products as $product) {
                            echo '
                                <div class="product" onclick="window.location.href=\'' . $product->article . '.php\'">
                                    <img src="Images/' . $product->image . '" alt="дубленка женская" width="75%" height="75%">
                                    <h3>' . $product->price . '₽</h3>
                                    <p>' . $product->product_name . '</p>
                                </div>
                            ';
                        }
                    } else {
                        echo "Товары не найдены.";
                    }
                ?>
            </div>
            </td>
		</table>
        <br>
    </body>
    <footer>
    <?php require_once "Blocks/footer.php"; ?>
    </footer>
</html>
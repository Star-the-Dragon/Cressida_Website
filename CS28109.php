<!DOCTYPE html>
<html>
    <head>
    <?php require_once "Blocks/head.php"; ?>
    </head>
    <body>
        <?php require_once "Blocks/header.php"; ?>
        <table border="0" width="1000" cellpadding="5" cellpaccing="0" align="center">
        <td width="300px">
                <?php
                    $conn=new mysqli("localhost", "root", "","cressida_db");
                    if ($conn->connect_error) {
                        die("Ошибка подключения: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM images WHERE article = 'CS28109'";
                    $result = $conn->query($sql);

                    $images = [];
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $images[] = $row['image'];
                        }
                    }
                ?>
                <div class="slider">
                    <div class="slider-images">
                        <?php foreach ($images as $image): ?>
                            <img src="Images/<?php echo $image; ?>" height="75%" width="75%" alt="Photo">
                        <?php endforeach; ?>
                    </div>
                    <div class="slider-controls">
                        <button class="prev">&#10094;</button>
                        <button class="next">&#10095;</button>
                    </div>
                </div>
            </td>
            <td width="500px">
                <div>
                    <?php
                    $conn=new mysqli("localhost", "root", "","cressida_db");
                    if ($conn->connect_error) {
                        die("Ошибка подключения: " . $conn->connect_error);
                    }
                    $sql = "SELECT product.article, product.product_name, product.price, description.color, description.composition, description.cut, description.length, description.insulation, description.zipper, description.hood, description.recommendations
                    FROM product JOIN description ON product.article= description.article
                    WHERE product.article = 'CS28109'";
                    $result = $conn->query($sql);
                    // Проверка результата
                    if ($result->num_rows > 0) {
                        // Вывод данных каждого товара
                        while ($row = $result->fetch_assoc()) {
                            echo'
                            <h2>'.$row["product_name"].'</h2><h3>'.$row["price"].'₽</h3>
                            <form action="Php/add_to_cart.php" method="post">
                                <p>выберите размер:
                                <input type="hidden" name="product_id" value="CS28109">
                                <input type="radio" id="XS" name="property" value="XS" class="input-drop"/>
                                <label for="XS">XS</label>
                                <input type="radio" id="S" name="property" value="S" class="input-drop"/>
                                <label for="S">S</label>
                                <input type="radio" id="M" name="property" value="M" class="input-drop"/>
                                <label for="M">M</label>
                                <input type="radio" id="L" name="property" value="L" class="input-drop"/>
                                <label for="L">L</label>
                                <input type="radio" id="XL" name="property" value="XL" class="input-drop"/>
                                <label for="XL">XL</label>
                                </p>
                                <div>
                                    <button class="feedback-button" id="add-to-cart" type="submit" >Добавить в корзину</button>
                                </div>
                            </form>
                            <p><b>таблица размеров</b><br>
                            <img src="Images/size_table.png" height="83%" width="90%" style="float: left; margin-right: 10px;" alt="Таблица размеров"></p>                           
                            <br><br><br><p><b>описание товара</b><br>
                                цвет: '.$row["color"].'<br>
                                артикул: '.$row["article"].'<br>
                            </p>
                            <p><b>состав и параметры</b><br>
                                '.$row["composition"].'<br>
                                длина: '.$row["length"].'<br>
                                утеплитель: '.$row["insulation"].'<br>
                                капюшон: '.$row["hood"].'<br>
                                вид застежки: '.$row["zipper"].'<br>
                            </p>
                            <p><b>рекомендации по уходу:</b>'.$row["recommendations"].'</p>
                            ';
                        }
                    } else {
                        echo "Товары не найдены.";
                    }
                    $conn->close();
                    ?>
                </div>
            </td>
        </table>
    </body>
    <footer>
    <?php require_once "Blocks/footer.php"; ?>
    </footer>
</html>
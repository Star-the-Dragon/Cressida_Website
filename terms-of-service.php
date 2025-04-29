<!DOCTYPE html>
<html>
	<head>
	<?php require_once "Blocks/head.php"; ?>
	</head>
	<body>
	<?php require_once "Blocks/header.php"; ?>
		<br>
		<table border="0" width="900" cellpadding="5" cellpaccing="0" align="center">
			<td>
                <h2 align="center">Условия использования</h2>
                <iframe id="pdfFrame" width="100%" height="700px"></iframe>
                <script>
                    // Путь к вашему PDF-документу
                    const pdfPath = "documents/Условия использования.pdf";
                    // Устанавливаем путь к PDF-документу в iframe
                    document.getElementById('pdfFrame').src = pdfPath;
                    // Устанавливаем путь к PDF-документу в ссылке для скачивания
                    document.getElementById('downloadLink').href = pdfPath;

                    // Функция для открытия PDF в новом окне
                    function openPDF() {
                        window.open(pdfPath, '_blank');
                    }
                    // Добавляем обработчик события для кнопки
                    document.getElementById('openPdfButton').addEventListener('click', openPdfInNewWindow);
                </script>                
			</td>
		</table>
		<?php require_once "Blocks/feedback.php"; ?>
	</body>
	<footer>
	<?php require_once "Blocks/footer.php"; ?>
	</footer>
</html>
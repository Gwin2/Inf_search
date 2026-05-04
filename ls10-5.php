<?php
$name = $_GET["name"] ?? "";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Листинг 10-5</title>
</head>
<body>
	<p>Переданное значение: <?php echo htmlspecialchars($name); ?></p>
	<p><a href="z4-45.php">Назад</a></p>
</body>
</html>

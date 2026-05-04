<?php
$surname = $_GET["surname"] ?? "";
$name = $_GET["name"] ?? "";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Листинг 10-6</title>
</head>
<body>
	<p>Фамилия: <?php echo htmlspecialchars($surname); ?></p>
	<p>Имя: <?php echo htmlspecialchars($name); ?></p>
	<p><a href="z4-46.php">Назад</a></p>
</body>
</html>

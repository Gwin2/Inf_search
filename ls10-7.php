<?php
$name = $_GET["name"] ?? "";
$age = $_GET["age"] ?? "не задан";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Листинг 10-7</title>
</head>
<body>
	<p>Имя: <?php echo htmlspecialchars($name); ?></p>
	<p>Возраст: <?php echo htmlspecialchars($age); ?></p>
	<p><a href="z4-47.php">Назад</a></p>
</body>
</html>

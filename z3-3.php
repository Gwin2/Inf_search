<?php
function Ru($color)
{
	echo "<p style=\"color: $color;\">Здравствуйте!</p>";
}

function En($color)
{
	echo "<p style=\"color: $color;\">Hello!</p>";
}

function Fr($color)
{
	echo "<p style=\"color: $color;\">Bonjour!</p>";
}

function De($color)
{
	echo "<p style=\"color: $color;\">Guten Tag!</p>";
}

$lang = $_GET["lang"] ?? "Ru";
$color = $_GET["color"] ?? "black";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 5</title>
</head>
<body>
<?php
if (in_array($lang, ["Ru", "En", "Fr", "De"])) {
	$lang($color);
} else {
	echo "<p>Неизвестный язык</p>";
}
?>
</body>
</html>

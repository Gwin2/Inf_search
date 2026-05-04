<?php
$lang = $_GET["lang"] ?? "";

if ($lang == "ru") {
	$name = "русский";
} elseif ($lang == "en") {
	$name = "английский";
} elseif ($lang == "fr") {
	$name = "французский";
} elseif ($lang == "de") {
	$name = "немецкий";
} else {
	$name = "язык неизвестен";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 2</title>
</head>
<body>
	<?php echo $name; ?>
</body>
</html>

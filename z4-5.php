<?php
$list_sites = [
	"https://www.google.com/",
	"https://www.yandex.ru/",
	"https://www.rambler.ru/",
	"https://www.yahoo.com/",
	"https://www.bing.com/"
];

$site = $_GET["site"] ?? "";

if ($site != "" && in_array($site, $list_sites)) {
	header("Location: $site");
	exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 5</title>
</head>
<body>
	<form action="z4-5.php" method="get">
		<p>Выберите поисковую систему:</p>
		<select name="site">
<?php
$i = 0;
while ($i < count($list_sites)) {
	echo "\t\t\t<option value=\"" . $list_sites[$i] . "\">" . $list_sites[$i] . "</option>\n";
	$i++;
}
?>
		</select>
		<p><input type="submit" value="Перейти"></p>
	</form>
</body>
</html>

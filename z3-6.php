<?php
function printAssocArray($title, $array)
{
	echo "<h3>$title</h3>\n";
	echo "<pre>\n";
	foreach ($array as $key => $value) {
		echo $key . " => " . $value . "\n";
	}
	echo "</pre>\n";
}

$cust = [
	"cnum" => 2001,
	"cname" => "Hoffman",
	"city" => "London",
	"snum" => 1001,
	"rating" => 100
];

$byValues = $cust;
asort($byValues);

$byKeys = $cust;
ksort($byKeys);

$sorted = $cust;
sort($sorted);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 7</title>
</head>
<body>
<?php
printAssocArray("Исходный массив", $cust);
printAssocArray("Сортировка по значениям", $byValues);
printAssocArray("Сортировка по ключам", $byKeys);
printAssocArray("Сортировка функцией sort()", $sorted);
?>
</body>
</html>

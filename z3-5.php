<?php
function printArrayLine($title, $array)
{
	echo "<p>$title: ";
	foreach ($array as $value) {
		echo $value . "&nbsp;&nbsp;";
	}
	echo "</p>\n";
}

$treug = [];
for ($n = 1; $n <= 10; $n++) {
	$treug[] = $n * ($n + 1) / 2;
}

$kvd = [];
for ($n = 1; $n <= 10; $n++) {
	$kvd[] = $n * $n;
}

$rez = array_merge($treug, $kvd);
$sortedRez = $rez;
sort($sortedRez);

$withoutFirst = $sortedRez;
array_shift($withoutFirst);

$rez1 = array_unique($withoutFirst);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 6</title>
</head>
<body>
<?php
printArrayLine("Треугольные числа", $treug);
printArrayLine("Квадраты", $kvd);
printArrayLine("Объединенный массив", $rez);
printArrayLine("Отсортированный массив", $sortedRez);
printArrayLine("После удаления первого элемента", $withoutFirst);
printArrayLine("Без повторяющихся элементов", $rez1);
?>
</body>
</html>

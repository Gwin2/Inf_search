<?php
$diagColor = "lightgreen";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 3</title>
</head>
<body>
	<table border="1" cellpadding="5">
<?php
$i = 1;
while ($i <= 10) {
	echo "\t\t<tr>\n";
	$j = 1;
	while ($j <= 10) {
		$value = $i * $j;
		if ($i == $j) {
			echo "\t\t\t<td style=\"background-color: $diagColor;\">$value</td>\n";
		} else {
			echo "\t\t\t<td>$value</td>\n";
		}
		$j++;
	}
	echo "\t\t</tr>\n";
	$i++;
}
?>
	</table>
</body>
</html>

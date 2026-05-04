<?php
$color = "blue";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 4</title>
</head>
<body>
	<table border="1" cellpadding="5">
		<tr>
			<td style="color: red;">+</td>
<?php
for ($i = 1; $i <= 10; $i++) {
	echo "\t\t\t<td style=\"color: $color;\">$i</td>\n";
}
?>
		</tr>
<?php
for ($i = 1; $i <= 10; $i++) {
	echo "\t\t<tr>\n";
	echo "\t\t\t<td style=\"color: $color;\">$i</td>\n";
	for ($j = 1; $j <= 10; $j++) {
		$value = $i + $j;
		echo "\t\t\t<td>$value</td>\n";
	}
	echo "\t\t</tr>\n";
}
?>
	</table>
</body>
</html>

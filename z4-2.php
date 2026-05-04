<?php
$align = $_GET["align"] ?? "left";
$valign = $_GET["valign"] ?? "top";

$allowedAlign = ["left", "center", "right"];
$allowedValign = ["top", "middle", "bottom"];

if (!in_array($align, $allowedAlign)) {
	$align = "left";
}
if (!in_array($valign, $allowedValign)) {
	$valign = "top";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задание 2</title>
</head>
<body>
	<h3>Выберите расположение текста</h3>
	<form action="z4-2.php" method="get">
		<p><b>Горизонтальное расположение:</b></p>
		<p><label><input type="radio" name="align" value="left" <?php if ($align == "left") echo "checked"; ?>> left</label></p>
		<p><label><input type="radio" name="align" value="center" <?php if ($align == "center") echo "checked"; ?>> center</label></p>
		<p><label><input type="radio" name="align" value="right" <?php if ($align == "right") echo "checked"; ?>> right</label></p>

		<p><b>Вертикальное расположение:</b></p>
		<p><label><input type="radio" name="valign" value="top" <?php if ($valign == "top") echo "checked"; ?>> top</label></p>
		<p><label><input type="radio" name="valign" value="middle" <?php if ($valign == "middle") echo "checked"; ?>> middle</label></p>
		<p><label><input type="radio" name="valign" value="bottom" <?php if ($valign == "bottom") echo "checked"; ?>> bottom</label></p>

		<p><input type="submit" value="Выполнить"></p>
	</form>

	<table border="1">
		<tr>
			<td width="100" height="100" align="<?php echo $align; ?>" valign="<?php echo $valign; ?>">Текст</td>
		</tr>
	</table>
</body>
</html>

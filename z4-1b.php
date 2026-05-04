<?php
$align = $_GET["align"] ?? "left";
$valign = $_GET["valign"] ?? ["top"];

if (is_array($valign)) {
	$valign = $valign[0] ?? "top";
}

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
	<title>Результат задания 1</title>
</head>
<body>
	<table border="1">
		<tr>
			<td width="100" height="100" align="<?php echo $align; ?>" valign="<?php echo $valign; ?>">Текст</td>
		</tr>
	</table>
	<p><a href="z4-1a.htm">Назад</a></p>
</body>
</html>

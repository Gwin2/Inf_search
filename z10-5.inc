<?php
function valid_table($table)
{
	return in_array($table, ["sal", "cust", "ord"]);
}

function vid_structure($table)
{
	global $conn;

	if (!valid_table($table)) {
		return;
	}

	$result = mysqli_query($conn, "DESCRIBE `$table`");

	echo "<h4>Структура таблицы $table</h4>\n";
	echo "<table border=\"1\" cellpadding=\"5\">\n";
	echo "\t<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>\n";

	while ($row = mysqli_fetch_assoc($result)) {
		echo "\t<tr>";
		echo "<td>" . htmlspecialchars($row["Field"]) . "</td>";
		echo "<td>" . htmlspecialchars($row["Type"]) . "</td>";
		echo "<td>" . htmlspecialchars($row["Null"]) . "</td>";
		echo "<td>" . htmlspecialchars($row["Key"]) . "</td>";
		echo "<td>" . htmlspecialchars($row["Default"] ?? "") . "</td>";
		echo "<td>" . htmlspecialchars($row["Extra"]) . "</td>";
		echo "</tr>\n";
	}

	echo "</table>\n";
}

function vid_content($table)
{
	global $conn;

	if (!valid_table($table)) {
		return;
	}

	$rus_name = [
		"snum" => "Номер продавца",
		"sname" => "Имя продавца",
		"city" => "Город",
		"comm" => "Комиссионные",
		"cnum" => "Номер покупателя",
		"cname" => "Имя покупателя",
		"rating" => "Рейтинг",
		"onum" => "Номер заказа",
		"amt" => "Сумма",
		"odate" => "Дата заказа"
	];

	$result = mysqli_query($conn, "SELECT * FROM `$table`");

	echo "<h4>Содержимое таблицы $table</h4>\n";
	echo "<table border=\"1\" cellpadding=\"5\">\n";

	$fields = mysqli_fetch_fields($result);
	echo "\t<tr>";
	foreach ($fields as $field) {
		$name = $field->name;
		$rus = $rus_name[$name] ?? $name;
		echo "<th>" . htmlspecialchars($rus) . "<br>" . htmlspecialchars($name) . "</th>";
	}
	echo "</tr>\n";

	while ($row = mysqli_fetch_assoc($result)) {
		echo "\t<tr>";
		foreach ($fields as $field) {
			$name = $field->name;
			echo "<td>" . htmlspecialchars($row[$name]) . "</td>";
		}
		echo "</tr>\n";
	}

	echo "</table>\n";
}

$structure = $_GET["structure"] ?? [];
$content = $_GET["content"] ?? [];

if (isset($structure) && is_array($structure)) {
	foreach ($structure as $table) {
		vid_structure($table);
	}
}

if (isset($content) && is_array($content)) {
	foreach ($content as $table) {
		vid_content($table);
	}
}
?>
<p><a href="z10-1.htm">Возврат к выбору таблицы</a></p>
</body>

<?php
$conn = mysqli_connect("localhost", "root", "", "sample");

if (!$conn) {
	die("Нет подключения к MySQL");
}

mysqli_set_charset($conn, "utf8");

$id = $_GET["id"] ?? "";
$field_name = $_GET["field_name"] ?? "";
$field_value = $_GET["field_value"] ?? "";
$allowed_fields = ["name", "city", "address", "birthday", "mail"];

if ($id != "" && $field_name != "" && in_array($field_name, $allowed_fields)) {
	$stmt = mysqli_prepare($conn, "UPDATE notebook SET `$field_name` = ? WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "si", $field_value, $id);
	mysqli_stmt_execute($stmt);
	echo "<p>Запись изменена</p>";
	echo "<p><a href=\"ex3.php\">Посмотреть результат</a></p>";
}

$result = mysqli_query($conn, "SELECT * FROM notebook");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Изменение записи</title>
</head>
<body>
	<h3>Выберите запись</h3>
	<form action="ex4.php" method="get">
		<table border="1" cellpadding="5">
			<tr>
				<th>Выбор</th>
				<th>id</th>
				<th>name</th>
				<th>city</th>
				<th>address</th>
				<th>birthday</th>
				<th>mail</th>
			</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td><input type="radio" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>"></td>
				<td><?php echo htmlspecialchars($row["id"]); ?></td>
				<td><?php echo htmlspecialchars($row["name"]); ?></td>
				<td><?php echo htmlspecialchars($row["city"]); ?></td>
				<td><?php echo htmlspecialchars($row["address"]); ?></td>
				<td><?php echo htmlspecialchars($row["birthday"]); ?></td>
				<td><?php echo htmlspecialchars($row["mail"]); ?></td>
			</tr>
<?php } ?>
		</table>
		<p><input type="submit" value="Выбрать"></p>
	</form>

<?php
if ($id != "") {
	$stmt = mysqli_prepare($conn, "SELECT * FROM notebook WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	$selected = mysqli_stmt_get_result($stmt);
	$a_row = mysqli_fetch_assoc($selected);

	if ($a_row) {
?>
	<h3>Выберите поле для замены</h3>
	<form action="ex4.php" method="get">
		<select name="field_name">
			<option value="name"><?php echo htmlspecialchars($a_row["name"]); ?></option>
			<option value="city"><?php echo htmlspecialchars($a_row["city"]); ?></option>
			<option value="address"><?php echo htmlspecialchars($a_row["address"]); ?></option>
			<option value="birthday"><?php echo htmlspecialchars($a_row["birthday"]); ?></option>
			<option value="mail"><?php echo htmlspecialchars($a_row["mail"]); ?></option>
		</select>
		<input type="text" name="field_value">
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
		<p><input type="submit" value="Заменить"></p>
	</form>
<?php
	}
}
?>
</body>
</html>
<?php mysqli_close($conn); ?>

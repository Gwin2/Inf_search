<?php
$conn = mysqli_connect("localhost", "root", "", "sample");

if (!$conn) {
	die("Нет подключения к MySQL");
}

mysqli_set_charset($conn, "utf8");
$result = mysqli_query($conn, "SELECT * FROM notebook");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Все записи</title>
</head>
<body>
	<h3>Таблица notebook</h3>
	<table border="1" cellpadding="5">
		<tr>
			<th>id</th>
			<th>name</th>
			<th>city</th>
			<th>address</th>
			<th>birthday</th>
			<th>mail</th>
		</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td><?php echo htmlspecialchars($row["id"]); ?></td>
			<td><?php echo htmlspecialchars($row["name"]); ?></td>
			<td><?php echo htmlspecialchars($row["city"]); ?></td>
			<td><?php echo htmlspecialchars($row["address"]); ?></td>
			<td><?php echo htmlspecialchars($row["birthday"]); ?></td>
			<td><?php echo htmlspecialchars($row["mail"]); ?></td>
		</tr>
<?php } ?>
	</table>
	<p><a href="ex2.php">Добавить запись</a></p>
	<p><a href="ex4.php">Изменить запись</a></p>
</body>
</html>
<?php mysqli_close($conn); ?>

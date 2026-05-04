<?php
$conn = mysqli_connect("localhost", "root", "", "sample");

if (!$conn) {
	die("Нет подключения к MySQL");
}

mysqli_set_charset($conn, "utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"] ?? "";
	$city = $_POST["city"] ?? "";
	$address = $_POST["address"] ?? "";
	$birthday = $_POST["birthday"] ?? "";
	$mail = $_POST["mail"] ?? "";

	if ($name != "" && $mail != "") {
		$stmt = mysqli_prepare($conn, "INSERT INTO notebook (name, city, address, birthday, mail) VALUES (?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "sssss", $name, $city, $address, $birthday, $mail);
		mysqli_stmt_execute($stmt);
		echo "<p>Запись добавлена</p>";
	} else {
		echo "<p>Поля name и mail обязательны для заполнения</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Добавление записи</title>
</head>
<body>
	<form action="ex2.php" method="post">
		<p>Имя: <input type="text" name="name"></p>
		<p>Город: <input type="text" name="city"></p>
		<p>Адрес: <input type="text" name="address"></p>
		<p>Дата рождения: <input type="text" name="birthday"></p>
		<p>E-mail: <input type="text" name="mail"></p>
		<p><input type="submit" value="Добавить"></p>
	</form>
	<p><a href="ex3.php">Показать все записи</a></p>
</body>
</html>
<?php mysqli_close($conn); ?>

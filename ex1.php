<?php
$conn = mysqli_connect(getenv("DB_HOST") ?: "localhost", getenv("DB_USER") ?: "root", getenv("DB_PASS") ?: "");

if (!$conn) {
	die("Нет подключения к MySQL");
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS sample");
mysqli_select_db($conn, "sample");
mysqli_set_charset($conn, "utf8");

mysqli_query($conn, "DROP TABLE IF EXISTS notebook");

$query = "CREATE TABLE notebook (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50),
	city VARCHAR(50),
	address VARCHAR(50),
	birthday DATE,
	mail VARCHAR(20),
	PRIMARY KEY (id)
)";

if (!mysqli_query($conn, $query)) {
	echo "Нельзя создать таблицу notebook";
} else {
	echo "Таблица notebook создана";
}

mysqli_close($conn);
?>

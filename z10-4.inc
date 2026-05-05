<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";
$db = "study";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
	die("<p>Нет подключения к MySQL</p>");
}

mysqli_set_charset($conn, "utf8");
?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "study";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
	die("<p>Нет подключения к MySQL</p>");
}

mysqli_set_charset($conn, "utf8");
?>

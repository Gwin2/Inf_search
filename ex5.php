<?php
$conn = mysqli_connect("localhost", "root", "", "sample");

if (!$conn) {
	die("Нет подключения к MySQL");
}

mysqli_set_charset($conn, "utf8");

$query = "INSERT INTO notebook (name, city, address, birthday, mail) VALUES
	('Ivanov Ivan', 'Novosibirsk', 'Lenina 1', '2000-01-10', 'ivan@mail.ru'),
	('Petrov Petr', 'Tomsk', 'Mira 2', '1999-02-20', 'petr@mail.ru'),
	('Sidorov Sidor', 'Omsk', 'Sovetskaya 3', '1998-03-30', 'sidor@mail.ru')";

if (mysqli_query($conn, $query)) {
	echo "Три записи добавлены";
} else {
	echo "Ошибка добавления записей";
}

mysqli_close($conn);
?>

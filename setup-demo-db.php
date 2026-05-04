<?php
$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {
	die("Нет подключения к MySQL\n");
}

mysqli_set_charset($conn, "utf8");

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS study");
mysqli_select_db($conn, "study");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS sal (
	snum INT(4) NOT NULL,
	sname VARCHAR(10) NOT NULL,
	city VARCHAR(10) NOT NULL,
	comm DOUBLE(7,2) NOT NULL,
	PRIMARY KEY (snum)
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS cust (
	cnum INT(4) NOT NULL,
	cname VARCHAR(10) NOT NULL,
	city VARCHAR(10) NOT NULL,
	rating INT(6) NOT NULL,
	snum INT(5),
	PRIMARY KEY (cnum)
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS ord (
	onum INT(4) NOT NULL,
	amt DOUBLE(7,2) NOT NULL,
	odate VARCHAR(10) NOT NULL,
	cnum INT(4),
	snum INT(4),
	PRIMARY KEY (onum)
)");

$queries = [
	"INSERT IGNORE INTO sal VALUES (1001, 'Peel', 'London', 0.12)",
	"INSERT IGNORE INTO sal VALUES (1002, 'Serres', 'San Jose', 0.13)",
	"INSERT IGNORE INTO sal VALUES (1004, 'Motica', 'London', 0.11)",
	"INSERT IGNORE INTO sal VALUES (1007, 'Rifkin', 'Barcelona', 0.15)",
	"INSERT IGNORE INTO sal VALUES (1003, 'Axelrod', 'New York', 0.10)",
	"INSERT IGNORE INTO cust VALUES (2001, 'Hoffman', 'London', 100, 1001)",
	"INSERT IGNORE INTO cust VALUES (2002, 'Giovanni', 'Rome', 200, 1003)",
	"INSERT IGNORE INTO cust VALUES (2003, 'Liu', 'San Jose', 200, 1002)",
	"INSERT IGNORE INTO cust VALUES (2004, 'Grass', 'Berlin', 300, 1002)",
	"INSERT IGNORE INTO cust VALUES (2006, 'Clemens', 'London', 100, 1001)",
	"INSERT IGNORE INTO cust VALUES (2008, 'Cisneros', 'San Jose', 300, 1007)",
	"INSERT IGNORE INTO cust VALUES (2007, 'Pereira', 'Rome', 100, 1004)",
	"INSERT IGNORE INTO ord VALUES (3001, 18.69, '03-OCT-90', 2008, 1007)",
	"INSERT IGNORE INTO ord VALUES (3003, 767.19, '03-OCT-90', 2001, 1001)",
	"INSERT IGNORE INTO ord VALUES (3002, 1900.10, '03-OCT-90', 2007, 1004)",
	"INSERT IGNORE INTO ord VALUES (3005, 5160.45, '03-OCT-90', 2003, 1002)",
	"INSERT IGNORE INTO ord VALUES (3006, 1098.16, '03-OCT-90', 2008, 1007)",
	"INSERT IGNORE INTO ord VALUES (3009, 1713.23, '04-OCT-90', 2002, 1003)",
	"INSERT IGNORE INTO ord VALUES (3007, 75.75, '04-OCT-90', 2004, 1002)",
	"INSERT IGNORE INTO ord VALUES (3008, 4723.00, '05-OCT-90', 2006, 1001)",
	"INSERT IGNORE INTO ord VALUES (3010, 1309.95, '06-OCT-90', 2004, 1002)",
	"INSERT IGNORE INTO ord VALUES (3011, 9891.88, '06-OCT-90', 2006, 1001)"
];

foreach ($queries as $query) {
	mysqli_query($conn, $query);
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS sample");
mysqli_select_db($conn, "sample");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS notebook (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50),
	city VARCHAR(50),
	address VARCHAR(50),
	birthday DATE,
	mail VARCHAR(20),
	PRIMARY KEY (id)
)");

$result = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM notebook");
$row = mysqli_fetch_assoc($result);

if ((int)$row["cnt"] === 0) {
	mysqli_query($conn, "INSERT INTO notebook (name, city, address, birthday, mail) VALUES
		('Ivanov Ivan', 'Novosibirsk', 'Lenina 1', '2000-01-10', 'ivan@mail.ru'),
		('Petrov Petr', 'Tomsk', 'Mira 2', '1999-02-20', 'petr@mail.ru'),
		('Sidorov Sidor', 'Omsk', 'Sovetskaya 3', '1998-03-30', 'sidor@mail.ru')");
}

mysqli_close($conn);
echo "Demo DB ready\n";
?>

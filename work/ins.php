<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "study";

$conn = mysqli_connect($host, $user, $pass, $db);

//$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Нет соединения с MySQL");
}

// Создание базы данных sample, если не существует
$mysqli_user = "root";  
$conn = mysqli_connect("localhost", 
$mysqli_user); 
if (!$conn ) die("Нет соединения с MySQL");

if (!mysqli_select_db($conn, $db)) {
    $create_db = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS study");
    if (!$create_db) {
        die("Нельзя создать базу данных $db: " . mysqli_error($conn));
    }
    mysqli_select_db($conn, $db);
}

#Теперь создадим таблицы в базе study:

// Уничтожение таблицы, если она уже существует
$drop_query = "DROP TABLE IF EXISTS sal";
if (!mysqli_query($conn, $drop_query)) {
    echo "<p>Нельзя создать таблицу ord</p>";
    mysqli_close($conn);
    exit;
}

#
#	создание таблицы продавцов - SAL
#



$create_query = "create table sal
  (snum int(4) NOT NULL,
   sname varchar(10) NOT NULL,
   city  varchar(10) NOT NULL,
   comm  double(7,2) NOT NULL,
   PRIMARY KEY (snum))";

if (!mysqli_query($conn, $create_query)) {
    echo "<p>Нельзя создать таблицу sal</p>";
} 

// Уничтожение таблицы, если она уже существует
$drop_query = "DROP TABLE IF EXISTS cust";
if (!mysqli_query($conn, $drop_query)) {
    echo "<p>Нельзя создать таблицу cust</p>";
   
}

#
#	создание таблицы заказчиков - CUST
#

$query = "create table cust
  (cnum int(4) NOT NULL,
   cname varchar(10) NOT NULL,
   city  varchar(10) NOT NULL,
   rating int(6) NOT NULL,
   snum int(5),
   PRIMARY KEY (cnum))";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));


// Уничтожение таблицы, если она уже существует
$drop_query = "DROP TABLE IF EXISTS ord";
if (!mysqli_query($conn, $drop_query)) {
    echo "<p>Нельзя создать таблицу ord</p>";
    mysqli_close($conn);
    exit;
}

#
#	создание таблицы заказов - ORD
#


$query = "create table ord
  (onum int(4) NOT NULL,
   amt  double(7,2) NOT NULL,
   odate varchar(10) NOT NULL,
   cnum int(4),
   snum int(4),
   PRIMARY KEY (onum))";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));


 #   
#Таблицы созданы, внесем в них данные:
#
#	заполнение таблицы sal
#

$query = "INSERT INTO sal (snum, sname, city, comm)
  VALUES (1001, 'Peel', 'London', 0.12)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO sal (snum, sname, city, comm)
  VALUES (1002, 'Serres', 'San Jose', 0.13)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO sal (snum, sname, city, comm)
  VALUES (1004, 'Motica', 'London', 0.11)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO sal (snum, sname, city, comm)
  VALUES (1007, 'Rifkin', 'Barcelona', 0.15)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO sal (snum, sname, city, comm)
  VALUES (1003, 'Axelrod', 'New York', 0.10)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

#
#	заполнение таблицы cust
#

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2001, 'Hoffman', 'London', 100, 1001)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2002, 'Giovanni', 'Rome', 200, 1003)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2003, 'Liu', 'San Jose', 200, 1002)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2004, 'Grass', 'Berlin', 300, 1002)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2006, 'Clemens', 'London', 100, 1001)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2008, 'Cisneros', 'San Jose', 300, 1007)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 

$query = "INSERT INTO cust (cnum, cname, city, rating, snum)
  VALUES (2007, 'Pereira', 'Rome', 100, 1004)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn)); 
#
#	заполнение таблицы ord
#

$query = "INSERT INTO ord
  VALUES (3001, 18.69,   '03-OCT-90', 2008, 1007)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3003, 767.19,  '03-OCT-90', 2001, 1001)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3002, 1900.10, '03-OCT-90', 2007, 1004)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3005, 5160.45, '03-OCT-90', 2003, 1002)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3006, 1098.16, '03-OCT-90', 2008, 1007)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
    VALUES (3009, 1713.23, '04-OCT-90', 2002, 1003)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
   VALUES (3007, 75.75,   '04-OCT-90', 2004, 1002)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
    VALUES (3008, 4723.00, '05-OCT-90', 2006, 1001)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3010, 1309.95, '06-OCT-90', 2004, 1002)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

$query = "INSERT INTO ord
  VALUES (3011, 9891.88, '06-OCT-90', 2006, 1001)";

$result = mysqli_query($conn, $query) 
          or die ("<p>Ошибка: ".mysqli_error($conn));

echo "Создание и заполнение таблиц выполнено";

?>
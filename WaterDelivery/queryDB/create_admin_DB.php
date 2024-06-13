<?php
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB)
	or die("Ошибка при подключении".mysqli_errno ($connect).": ".mysqli_error ($connect));
$password = 'admin';
$hash = password_hash($password, PASSWORD_DEFAULT);

$query ="INSERT INTO User(id_user, Login, Password, id_type_user) VALUES (1,'admin', '$hash', 1)";
$result = mysqli_query($connect, $query) or die("Ошибка при создании данных администратора".mysqli_errno ($connect).": ".mysqli_error ($connect));

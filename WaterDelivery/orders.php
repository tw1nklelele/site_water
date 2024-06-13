<?
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB)
	or die("Ошибка при подключении".mysqli_errno ($connect).": ".mysqli_error ($connect));
	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Заказы</title>
	<link rel="stylesheet" href="style.css">
	<style> body{margin: 0;}</style>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=8cb3cec1-6517-485e-a55d-7beca626e8db" type="text/javascript"></script>
		<script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>

</head>
<body>
	<?php require "header.php";
	?>
	<div class="katalog_header">
		<h1 class="page_zagolovok">Заказы</h1>
	</div>
	<table id="table_orders">
		<tr>
			<th>ID</th>
			<th>Дата создания</th>
			<th>Статус заказа</th>
			<th>Товары заказа</th>
			<th>Способ получения</th>
			<th>Тип оплаты</th>
			<th>Имя клиента</th>
			<th>Телефон</th>
			<th>Время доставки</th>
			<th>Адрес</th>
			<th>Комментарий</th>
		</tr>

	<?php
	$query = "SELECT * FROM Zakaz";
	$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
	foreach($result as $row){
		echo '<tr>';
		echo '<td>'.$row['order_ID'];
		$num_ord = $row['order_ID'];
		$query1 = "SELECT * FROM Zakaz_status WHERE order_ID = $num_ord AND name_status = 'Создан'";
		$result1 = mysqli_query($connect,$query1) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
		echo '<td>';
			foreach($result1 as $row1){
				echo $row1['date_change'];
			}
		echo '<td>';
		$query1 = "SELECT * FROM Zakaz_status WHERE order_ID = $num_ord ORDER BY date_change DESC LIMIT 1";
		$result1 = mysqli_query($connect,$query1) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
			foreach($result1 as $row1){
				echo $row1['name_status'];
			}
		$query1 = "SELECT p.Code_product, Name_product, quantity FROM Order_Product
			INNER JOIN Product p USING(Code_product)
			WHERE order_ID = $num_ord";
		$result1 = mysqli_query($connect,$query1) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
		echo '<td id="prodTD">';
			$i = 1;
			foreach($result1 as $row1){
				echo $i;
				echo '. Код:'.$row1['Code_product'];
				echo '<br>';
				echo 'Наименование:'.$row1['Name_product'];
				echo '<br>';
				echo 'Кол-во:'.$row1['quantity'];
				echo '<br>';
				$i++;
			}
		echo '<td>'.$row['type_order'];
		echo '<td>'.$row['type_pay'];
		echo '<td>'.$row['name_client'];
		echo '<td>'.$row['num_tel'];
		echo '<td>'.$row['date_delivery'];
		echo '<td>'.$row['address'];
		echo '<td>'.$row['comment'];

	}
	?>
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
$num_order = $_GET['order'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Завершение создания заказа</title>
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
		<h1 class="page_zagolovok">Завершение создания заказа</h1>
	</div>
	<div class="div_change_prod" id="div_end_order">
		<h1 id="h1num_order"> Заказ создан! Номер заказа -  <?php echo $num_order." "?></h1>
	</div>
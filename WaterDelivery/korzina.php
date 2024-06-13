<?
	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
$host = "db";
$login = "root";
$passwordDB = "root_password";
$nameDB = "Water_delivery";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Корзина</title>
	<link rel="stylesheet" href="style.css">
	<style> body{margin: 0px;}
	</style>
	<script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>
</head>
<body>
	<?php require "header.php"?>
	<div class="katalog_header">
			<h1 class="page_zagolovok">Корзина товаров</h1>
	</div>
	<div class = "korzina_body">
	<?php
		$cart = array();
		$codes = array();
		for ($i = 0; $i < count($_SESSION['cart']); $i++) {
    		$cart[$_SESSION['cart'][$i]['code']]=$_SESSION['cart'][$i]['quantiti'];
    		array_push($codes,$_SESSION['cart'][$i]['code']);
		}
		$codes = implode(',', $codes);
		$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
		if (count($_SESSION['cart']) !== 0) {
			$query = "SELECT * FROM Product WHERE Code_product IN ($codes)";
			$result = mysqli_query($connect,$query)
				or die("Ошибка при выборке данных корзины из таблицы товаров".mysqli_errno ($connect).": ".mysqli_error ($connect));

			echo '<table id="korzina_table">';
			$i = 1;
			$totalPrice = 0;
			foreach ($result as $row){
					echo '<tr class="korzina_tr">';
					echo '<td class="num_td">'.'№ '.$i;
					echo '<td class="img_td"><img id="cart_foto" src="ImageKatalog/'.$row['LinkImage'].'"">';
					echo '<td class="info_td">';
						echo '<b>'.$row['Name_product'].'</b>';
						echo '<p>Код товара: '.$row['Code_product'];
						echo '<p>Цена за шт. : '.$row['Price'].' ₽';
					echo '<td class="quantiti_td">';
					echo 'Количество: <input id="quantiti_cart" type="text" value='.$cart[$row['Code_product']].'>';
					echo '<td class="del_prod"><img class="delete_cart" src="Images/delete_cart.png" data-productID ='. $row['Code_product'].' width="25" height="25">';
					echo '<td class="price_td">'.$cart[$row['Code_product']]*$row['Price'].' руб.'.'</td>';
					echo '</tr>';
					$i++;
					$totalPrice+=$cart[$row['Code_product']]*$row['Price'];
			}
			echo '<tr><td colspan=4>';
			echo '<td class="price_td">Доставка: ';
			echo '<td class="price_td">';
				if ($totalPrice < 500){
					$totalPrice+=150;
					echo '150 руб.';
				}
				else {echo 'бесплатно';}
			echo '<form action="create_order.php">';
			echo '<tr><td colspan=4>';
			echo '<td class="price_td">Всего: ';
			echo '<td class="price_td" id="totalPrice">'.$totalPrice. ' руб.';
			echo '</table>';
			echo '<form action="create_order.php">';
			echo '<input id="but_oformlenie" type="submit" value="Перейти к оформлению">';
			echo '</form>';
		}
		else{
			echo '<h2> В вашей корзине нет товаров. Вы можете добавить их в каталоге';
		}
		echo '</div>';
		require "footer.html";
		?>
		<script>




			$(document).ready(function(){
				//выделение tr при наведении на иконку удаления
				$('.delete_cart').mouseenter(function () {
					var tr=($(this).parent()).parent();
					tr.css({"background-color": "#F08080"})
				});$('.delete_cart').mouseleave(function() {
					var tr=($(this).parent()).parent();
    				tr.css({"background-color": "transparent"})
  				});



				//аякс запрос на удаление
				$('.delete_cart').on('click',function () {
					var PRcode = $(this).attr('data-productID');
					var tr = ($(this).parent()).parent();
					$.ajax({
	  					method: "POST",
	 	 				url: "del_from_korzina.php",
  						data: {code_tovar: PRcode},
 						success: function(response) {
     					if (response === 'success') {
					        // Успешное удаление
					       	let Price_td = tr.children('.price_td');
					       	let CurrentPrice = parseInt(Price_td.text());
					       	let TotalPrice = parseInt($('#totalPrice').text());
					       	let NewPrice = TotalPrice - CurrentPrice;
					       	$('#totalPrice').text(NewPrice + ' руб.');
					        tr.remove();
					        count_c = parseInt($('#korzina_counter').text()); //уменьшение счётчика корзины
    						count_c--;
    						$('#korzina_counter').text(count_c);

    						if (count_c == 0) {
    							($('.korzina_body')).children().remove();
    							($('.korzina_body')).text('В корзине нет товаров, вы можете добавить их в каталоге.')

    						}

     					 }
    				}
				})
  					})
				})
		</script>


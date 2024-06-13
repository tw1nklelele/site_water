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
	<title>Оформление заказа</title>
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
			<h1 class="page_zagolovok">Оформление заказа</h1>
	</div>

	<div class="create_order_body">
		<div class="body_input_order">
			<div id="div_type_delivery">
				<h3>Способ получения</h3>
				<?php
				$query ="SELECT * FROM Delivery_type";
				$result = mysqli_query($connect,$query)
					or die("Ошибка при выборке данных delivery".mysqli_errno ($connect).": ".mysqli_error ($connect));
				echo '<div class="parent_radio">';
					foreach ($result as $row){
					echo '<div class="radio_div_del">';
						echo '<input type="radio" name="type_del" id="radio_delivery" class="radio_order" value="'.$row['name_delivery_type'].'">';
						echo $row['name_delivery_type'];
					echo '</div>';
					}
				echo '</div>';
			?>
			</div>
			<div id="div_type_payment">

				<h3>Способ оплаты</h3>
				<?php
				$query ="SELECT * FROM Payment_type";
				$result = mysqli_query($connect,$query)
					or die("Ошибка при выборке данных типа оплаты".mysqli_errno ($connect).": ".mysqli_error ($connect));
				echo '<div class="parent_radio">';
					foreach ($result as $row){
						echo '<div class="radio_div_del">';
							echo '<input type="radio" name="type_pay" class="radio_order" id="radio_payment" value="'.$row['name_payment_type'].'">';
							echo $row['name_payment_type'];
							switch($row['name_payment_type']){
								case 'Наличные':
									echo '<img src="Images/cash.png" width="40">';
									break;
								case 'Картой при получении':
									echo '<img src="Images/pay_terminal.png" width="50">';
									break;
							}
						echo '</div>';
					}
					echo '</div>';
			?>
			</div>
			<div id="info_order">
				<h3>Данные заказа</h3>
				<input class="order_info" id="name" type="text" placeholder="Имя">
				<input class="order_info" id="number" type="number" placeholder="Номер телефона">
				<input class="order_info" id="address_in" type="text" placeholder = "Адрес доставки">
				<input class="order_info" id="comment" type="text" placeholder = "Комментарий к заказу">
				<input class="order_info" id="date" type="date">
				<input class="order_info" id="time" type="time">
			</div>
		</div>
		<div id="order_prod">
			<h3>Товары заказа</h3>
			<?php
			//$query = "SELECT * FROM Product WHERE "
			$cart = array();
			$codes = array();
			for ($i = 0; $i < count($_SESSION['cart']); $i++) {
	    		$cart[$_SESSION['cart'][$i]['code']]=$_SESSION['cart'][$i]['quantiti'];
	    		array_push($codes,$_SESSION['cart'][$i]['code']);
			}
			$codes = implode(',', $codes);
			$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
			$query = "SELECT * FROM Product WHERE Code_product IN ($codes)";
			$result = mysqli_query($connect,$query) or die("Ошибка при выборке данных корзины из таблицы товаров".mysqli_errno ($connect).": ".mysqli_error ($connect));
			$totalPrice = 0;
			echo '<table id="order_product">';
			foreach($result as $row){
				echo '<tr>';
				echo '<td><img src="ImageKatalog/'.$row['LinkImage'].'"">';
				echo '<td>'.$row['Name_product'];
				echo '<p>'.$cart[$row['Code_product']].' шт.';
				echo '<td>'.$cart[$row['Code_product']]*$row['Price'].' ₽';
				echo '</tr>';
				$totalPrice+=$cart[$row['Code_product']]*$row['Price'];
			}
			echo '</table>';
			echo '<h3>Стоимость доставки</h3>';
			if ($totalPrice < 500) {
				echo '<h4> 150 рублей </h4>';
				$totalPrice+=150;
			}
			else{
				//echo '<h4><del>150 ₽</del></h4>';
				echo '<h4>БЕСПЛАТНО</h4>';
			}
			echo '<h3> Сумма заказа </h3>';
			echo '<h4>'.$totalPrice.' ₽'.'</h4>';
			?>
		</div>
		<div id="body_but_order">
			<input type="submit" value="Оформить заказ" id="but_create_order">
			<div id="soglasie">
				<input type="radio" name="soglasie">
				<span> Нажимая на кнопку "Оформить заказ", Вы соглашаетесь на обработку ваших персональных данных...</span>
			</div>
		</div>

		<div id="div_order_2">
			<div id="map" class="OrderMap"></div>

		</div>

		<!--<div id="div_order">
			<h2>Заполнение данных для заказа</h2>
		<div id="map" class="OrderMap"></div>
		<span> Адрес </span>
		<input type="text" placeholder="Адрес" name="adres">
		<span> Дата </span>
		<input type="date" placeholder="Дата" name="adres">
		<span> Время </span>
		<select name="time">
			<option> 09:00 - 12:00 </option>
			<option> 12:00 - 15:00 </option>
			<option> 15:00 - 18:00 </option>
			<option> 18:00 - 20:00 </option>

		</select>
		<span> Способ оплаты </span>
		<input type="text" placeholder="Выберите тип оплаты" name="adres">
		</div> -->

			<div id="toast">
			 <div class="checkicon"> <i class="fas fa-check-square"></i> </div>
			<span id="not"></span></div>
	</div>
<?php require "footer.html";
	?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>


<script type="text/javascript">

	ymaps.ready(init);
	function init() {

		myMap = new ymaps.Map("map", {
			center: [63.5663620589178,53.691073999999944], // Координаты центра карты
			zoom: 15 // Маштаб карты
		});
		myMap.controls.add(
			new ymaps.control.ZoomControl()  // Добавление элемента управления картой
		);

		myPlacemark = new ymaps.Placemark([63.5663620589178,53.691073999999944], { // Координаты метки объекта
			balloonContent: "<div class='ya_map'>Наш офис!</div>" // Подсказка метки
		}, {
			preset: "twirl#redDotIcon" // Тип метки
		});
		myMap.geoObjects.add(myPlacemark); // Добавление метки
		myPlacemark.balloon.open(); // Открытие подсказки метки

		  		myMap.events.add('click', function (e) {
    	var coords = e.get('coords');

    	// Выполните запрос на геокодирование с помощью API Яндекс.Карт
    	ymaps.geocode(coords).then(function (res) {
      	var firstGeoObject = res.geoObjects.get(0);

      // Получите адрес из полученного объекта геокодирования
      var address = firstGeoObject.getAddressLine();

      // Вставьте адрес в нужную строку на странице
      document.getElementById('adres').value = address;
    });
  });
	};
	</script>

<script>
	var address_id;
    $("#address_in").suggestions({
        token: "678f3ea7d7d333dc316348f073f41bf28cede573",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        constraints: {
      	// ограничиваем поиск Новосибирском
      		locations: {
        		region: "Коми",
        		city: "Ухта"
      	},
    	},
        onSelect: function(suggestion) {
        //console.log(suggestion);
        address_id = suggestion.kladr_id;
        console.log(address_id);
        }
    });
</script>
<script type="text/javascript">
	$('#but_create_order').on('click',function () {
	var type_del = document.getElementById("radio_delivery").value;
	var type_pay = document.getElementById("radio_payment").value;
	var name = document.getElementById("name").value;
	var number = document.getElementById("number").value;
	var address = document.getElementById("address_in").value;
	var date = document.getElementById("date").value;
	var time = document.getElementById("time").value;
	var comment = document.getElementById("comment").value;
	if($('#radio_delivery').val().length == 0 ||  $('#radio_payment').val().length == 0 || $('#name').val().length == 0
		|| $('#number').val().length == 0
		|| $('#date').val().length == 0 || $('#time').val().length == 0 ){
		$('#not').text("Пожалуйста заполните все поля данными.");
  		$('#toast').css('background','#FA8072');
  		console.log('Пустые поля');
	}
	else{
		$.ajax({
	  		method: "POST",
	 	 	url: "save_order_script.php",
	  		data: {type_del: type_del, type_pay: type_pay, name:name, number: number,address:address,date:date,
	  			time:time, comment:comment},
	  		success: function(response){   /* функция которая будет выполнена после успешного запроса.  */
	  			 	var location = "end_order_create.php?order" + response
	  				window.location.replace(location);
	  		}
		})
		.done(function(response){
	  				var location = "end_order_create.php?order=" + response
	  				window.location.replace(location);

		})
	}
})
</script>
</body>
</html>
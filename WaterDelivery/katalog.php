<?php
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

if(!isset($_GET['sort'])) $_GET['sort'] = "Code_product";
$sort = $_GET['sort'];


//if(!isset($GET['type_product'])) $_GET['type_product'] = "";
if (!isset($_GET['type_product'])) $_GET['type_product'] = array();
$select_cat = $_GET['type_product'];
$select_cat = "'".implode("','", $select_cat)."'";


//$select_cat = implode(',',$select_cat);
//$select_cat = array_map( 'mysql_real_escape_string', $select_cat);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Каталог</title>
	<link rel="stylesheet" href="style.css">
	<style> body{margin: 0}</style>
	<script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>
</head>
<body>
	<?php require "header.php"?>
	<?php require "fdata.php"?>
	<?php require "window_for_log.php" ?>
	<div class="katalog_header">
		<h1 class="page_zagolovok">Каталог</h1>
	</div>
	<div id = "div_add_katalog">
		Товар добавлен в корзину!
	</div>
	<div class="body_for_katalog">

		<div class="div_katalog">
			<div class="filter">
				<div id="div_filter_category">
					<legend>Категория</legend>
					<form method="get">
					<div class="cell_cat">
						<input type = "checkbox" name="type_product" value="All" class="check_cat">
						<label for="cat_Water">Все категории</label>
					</div>
					<?php $connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
					$query = "SELECT name_type_product FROM type_product";
					$result = mysqli_query($connect,$query);
					foreach ($result as $row){
						echo '<div class="cell_cat">';
						echo '<input type = "checkbox" name="type_product[]" class="check_cat" value='.$row['name_type_product'].'>';
						echo '<label for="cat_Water">'.$row['name_type_product'].'</label>';
					echo '</div>';
					}

					?>
				</div>

				<div id="filter_price">
					<legend>Цена</legend>
					<?php echo '<input type="number" min =0 name="min" placeholder="Мин. цена" class="cell_price" id="cell_min_price"';
					if(isset($_GET['min'])) echo 'value='.$_GET['min'];
					echo'>';
					echo '<input type="number" min =0 name="max" placeholder="Макс. цена" class="cell_price" id="cell_max_price"';
					if(isset($_GET['max']) && !empty($_GET['max'])) echo 'value='.$_GET['max'];
					echo'>';

					if(empty($_GET['min'])) $_GET['min'] = 0;
					if(empty($_GET['max'])) $_GET['max'] = 10000;

					$min = $_GET['min'];
					$max = $_GET['max'];
					?>
				</div>
				<input type="submit" value="Фильтровать" class="but_filter">
				</form>
			</div>


			<div class="div_parent_card">
				<div id="div_sortirovka">
				    <b>Сортировать по:</b>
				    <?php echo sort_link_th('Название ', 'Name_product', 'Name_product DESC');
				    echo sort_link_th('Цена ', 'Price', 'Price DESC');
				    echo sort_link_th('Категория ', 'name_type_product', 'name_type_product DESC');?>
				</div>
			<?php
			$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
			$query = "SELECT name_type_product as тип_продукта FROM type_product";
			$result = mysqli_query($connect,$query)
				or die("Ошибка при выборке данных типов товаров".mysqli_errno ($connect).": ".mysqli_error ($connect));

			//Блок добавления товара для администратора
			if (isset($_SESSION['TypeUser']) && $_SESSION['TypeUser'] =='Менеджер'){
				echo '<div id="add_product" class="product_card">';
					echo '<a href = "add_prod.php">';
						echo '<img src="Images/img_add_product.png">';
					echo '</a>';
				echo '</div>';
			}
			if (!isset($_SESSION['TypeUser']) || ($_SESSION['TypeUser'] == 'Клиент')){
				$query = "SELECT * FROM Product INNER JOIN type_product USING(id_type_product)
					WHERE (Price BETWEEN $min AND $max)
					AND (Hidden=0)
					/*AND (name_type_product IN ($select_cat))*/
					ORDER BY $sort";}
			if (isset($_SESSION['TypeUser']) && $_SESSION['TypeUser'] =='Менеджер'){
				$query = "SELECT * FROM Product INNER JOIN type_product USING(id_type_product)
					WHERE (Price BETWEEN $min AND $max)
					/*AND (name_type_product IN ($select_cat))*/
					ORDER BY $sort";
			}
			$result = mysqli_query($connect,$query)
				or die("Ошибка при выборке данных из каталога".mysqli_errno ($connect).": ".mysqli_error ($connect));
										//функция проверки на наличие кода товара в сессии
							function check_cart($a){
								for ($i = 0; $i < count($_SESSION['cart']); $i++) {
									if ($_SESSION['cart'][$i]['code'] == $a) return false;
									}
									return true;
								}
			foreach ($result as $row){
				echo '<div class="product_card"';
				if (isset($row['Hidden']) && $row['Hidden']==1) echo ' id="hidden_card"';
				echo '>';
					echo '<h4>'.$row['Name_product'].'</h4>';
					echo '<div class="category">'.'Категория : '.$row['name_type_product'].'</div>';
					echo '<img src="ImageKatalog/'.$row['LinkImage'].'"">';
					echo '<div class="div_price">'.$row['Price'].' ₽'.'</div>';
					echo '<div class="parent_buy">';
					if (!isset($_SESSION['TypeUser']) || $_SESSION['TypeUser']=='Клиент'){
						echo '<input type="number" min=1 class="count_prod" name="count" placeholder="Количество">';
							if (check_cart($row['Code_product'])==false){
								echo '<input type="submit" class="buy" value="В корзине" disabled ="disabled" data-value='.$row['Code_product'].'>';
							}
							else{echo '<input type="submit" class="buy" value="В корзину" data-value='.$row['Code_product'].'>';}
					}
					if (isset($_SESSION['TypeUser']) && $_SESSION['TypeUser']=='Менеджер'){
						echo '<a href="edit_product.php'.'?code_pr='.$row['Code_product'].'" id="a_edit_prod" class="edit_product" data-value='.$row['Code_product'].'>Изменить</a>';

						if ($row['Hidden'] == 0){
							echo '<input type="submit" class="delete_product" value="Скрыть" data-value='.$row['Code_product'].'>';}
						else{
							echo '<input type="submit" class="visible_product" value="Открыть" data-value='.$row['Code_product'].'>';
						}
					}
					echo'</div>';
					if ($row['Hidden'] == 1) echo '<div class="hidden"><img src="Images/hidden.png"></div>';


				echo '</div>';
			}
			//echo var_dump($_GET['type_product'][0]);
			//echo var_dump($select_cat);
			echo $select_cat;
			?>
			</div>

		</div>


	</div>
	<?php //require "korzina.php"?>
	<?php require "footer.html"?>
	<script>
		//$(document).ready(function(){
		//	$('input.buy').on('click',function (){
		//		var count = $('span#korzina_counter');
		//		count++;
		//		count.val(parseInt(count.val()) + 1);
    	//		count.change();
		//	});
		//});
		$(document).ready(function() {
			$('.delete_product').mouseenter(function () {
				var card=($(this).parent()).parent();
				card.css({"background-color": "#FFA07A"})
			});$('.delete_product').mouseleave(function() {
				var card=($(this).parent()).parent();
    			card.css({"background-color": "transparent"})
  			});


			//AJAX запрос на скрытие товара
			$('.delete_product').on('click',function () {
				var codeValue = $(this).attr('data-value');
				var product_card = ($(this).parent()).parent();
				//product_card.remove();
				$.ajax({
  					method: "POST",
 	 				url: "scripts_PHP/hide_or_vis_product.php",
  					data: {code_tovar: codeValue}
  				})
  				$(this).val('Открыть');
  				$(this).attr('class', 'visible_product');

  			})

  			//AJAX запрос на "открытие" товара
			$('.visible_product').on('click',function () {
				var codeValue = $(this).attr('data-value');
				var product_card = ($(this).parent()).parent();
				$.ajax({
  					method: "POST",
 	 				url: "scripts_PHP/hide_or_vis_product.php",
  					data: {code_tovar: codeValue}
  				})
  				$(this).val('Скрыть');
  				$(this).attr('class', 'delete_product');
  				let div_remove = product_card.children('.hidden');
  				div_remove.remove();
  			})


			$('.headref').first().attr('id', 'activeheadref');
  			$('input.buy').click(function() {
    			$(this).attr('disabled', true);
    			$(this).val('В корзине');
    			count_c = parseInt($('#korzina_counter').text());
    			count_c++;
    			$('#korzina_counter').text(count_c);
  			});
  		});

		$(document).ready(function(){
			$('input.buy').on('click',function () {
				var codeValue = $(this).attr('data-value');
				var parent = $(this).parent();
				var count = $(parent).children('.count_prod');
				var quantiti = count.val();
				$.ajax({
  					method: "POST",
 	 				url: "add_to_korzina.php",
  					data: {code_tovar: codeValue, count: quantiti}
  				})

  				//.done(function( msg ) {
    			//	alert( "Data Saved: " + msg );
  				//});
		});

	});
	</script>
	<script src="scriptsJS/window_for_log.js" type="text/javascript">
	</script>
</body>
</html>
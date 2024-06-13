<div id="korzina_tovarov">
	<?php
	$host = "localhost";
	$login = "root";
	$passwordDB = "";
	$nameDB = "Water_Delivery";

	if (!isset($_SESSION['buy_prod'])) echo 'Корзина пуста';

	if(isset($_POST['code'])){
	$_SESSION['buy_prod'] = $_POST['code'];
	$code = $_POST['code'];
	$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
	$query = "SELECT * FROM Product WHERE Code_product = $code";
	$result = mysqli_query($connect,$query);
	foreach ($result as $row){
		echo $row['Name_product'];
	}
	}
	?>





</div>

<?php
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$code = $_POST['code_tovar'];
$query = "UPDATE Product
			SET Hidden = IF (Hidden = 0, 1, 0)
			WHERE Code_product = $code";
$result = mysqli_query($connect,$query);
?>
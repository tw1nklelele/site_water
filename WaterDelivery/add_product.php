<?php
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";

$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);

$code = $_POST['code_tovar'];
$name = $_POST['name_tovar'];
$desc = $_POST['desc_tovar'];
$price = $_POST['price_tovar'];
$cat = $_POST['cat_tovar'];
$weight = $_POST['weight_tovar'];
$img = $_POST['img_tovar'];
$file = $_FILES['file'];

$target = "ImageKatalog/".basename($_FILES['file']['name']);

$query = "SELECT COUNT(*) FROM Product WHERE Code_product = $code";
$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
foreach($result as $row){
	if($row['COUNT(*)'] > 0){
		echo 0;
	}
	else{
		$query = "INSERT INTO Product(Code_product,Name_product,Description,Price, id_type_product,Weight, LinkImage, Hidden)
			VALUES ($code, '$name', '$desc', $price, $cat,$weight, '$img', 0)";
		$result = mysqli_query($connect,$query);
		move_uploaded_file($_FILES['file']['tmp_name'], $target);
		echo 1;
	}
}

?>


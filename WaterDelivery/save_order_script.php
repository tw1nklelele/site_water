<?php
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);

$type_del = $_POST['type_del'];
$type_pay = $_POST['type_pay'];
$name = $_POST['name'];
$number = $_POST['number'];
$address = $_POST['address'];
$date = $_POST['date'].$_POST['time'];
$date = date('Y-m-d H:i:s');
$comment = $_POST['comment'];

$query = "INSERT INTO Zakaz(type_order,type_pay,comment,num_tel,date_delivery,address,name_client)
	VALUES('$type_del','$type_pay','$comment','$number','$date','$address','$name')";
$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "SELECT order_id FROM Zakaz WHERE date_delivery = '$date' AND num_tel = '$number'";
$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
foreach($result as $row){
	$num_order = $row['order_id'];
}

for ($i = 0; $i < count($_SESSION['cart']); $i++) {
	$code_prod = $_SESSION['cart'][$i]['code'];
	$quant = $_SESSION['cart'][$i]['quantiti'];
    $query = "INSERT INTO Order_Product(order_ID, code_product, quantity)
		VALUES($num_order, $code_prod, $quant)";
	$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
}

$query = "INSERT INTO Zakaz_status(order_ID, name_status, date_change)
	VALUES($num_order, 'Создан',NOW())";
$result = mysqli_query($connect,$query) or die("Ошибка".mysqli_errno ($connect).": ".mysqli_error ($connect));
for ($i = 0; $i < count($_SESSION['cart']); $i++){
	unset($_SESSION['cart'][$i]);
}
unset($_SESSION['cart']);
echo $num_order;
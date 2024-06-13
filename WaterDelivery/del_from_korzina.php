<?php
	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
$code_tovar = $_POST['code_tovar'];
$index = 0;
	//поиск значения для удаления
for ($i = 0; $i < count($_SESSION['cart']); $i++){
	if ($_SESSION['cart'][$i]['code'] == $code_tovar){
		$index = $i;
		break;
	}
}

unset($_SESSION['cart'][$index]);  //удаление из сессии товара
$_SESSION['cart'] = (array_values($_SESSION['cart'])); //новый массив без пустого удалённого товара
echo 'success';

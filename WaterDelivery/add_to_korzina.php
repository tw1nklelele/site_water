
<?php
	//функция проверки на наличие кода товара в сессии
	function check_cart($a){
		for ($i = 0; $i < count($_SESSION['cart']); $i++) {
			if ($_SESSION['cart'][$i]['code'] == $a) return false;
			}
			return true;
		}

	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
	if (isset($_POST['code_tovar'])){
		$code_tovar = $_POST['code_tovar'];
		$quantiti = $_POST['count'];
		//var_dump($_POST);
		if (check_cart($code_tovar)!=false){
			$_SESSION['cart'][] = array('code'=>$code_tovar,'quantiti'=>$quantiti);
		}
	}
	?>


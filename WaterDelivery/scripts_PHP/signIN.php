<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);


$input_log = trim($_POST['login']);
$input_pass = trim($_POST['password']);
$login = mysqli_real_escape_string($connect, $input_log);
$password = mysqli_real_escape_string($connect, $input_pass);

$query = "SELECT * FROM User INNER JOIN type_user USING(id_type_user) WHERE Login = '$login'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result)==1) {
	foreach ($result as $row){
		$hash = $row['Password'];
		$type = $row['name_type_user'];
	}
	if (password_verify($password,$hash)){
		$_SESSION['User']=$login;
		$_SESSION['TypeUser'] = $type;
		echo 'Успешно!';
	}
	else{
		echo 'Введённый логин или пароль неверен!';
	}
}
else {
	echo 'Введённый логин или пароль неверен!';
}
mysqli_close($connect);
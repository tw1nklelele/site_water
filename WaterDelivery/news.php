<?php
session_start();
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Новости</title>
	<link rel="stylesheet" href="style.css">
	<style> body{margin: 0}</style>
</head>
<body>
	<?php require "header.php"?>
	<div class="katalog_header">
		<h1 class="page_zagolovok">Новости</h1>
	</div>
	<div class ="news_body">
		<?php
		$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
		$query = "SELECT * FROM News";
		$result = mysqli_query($connect,$query);
		foreach ($result as $row){
			echo '<div class="block_news">';
				echo '<h2>'.$row['news_header'].'</h2>';
				echo '<div>'.$row['news_date'].'</div>';
				echo '<div>'.$row['news_time'].'</div>';
				echo '<span>'.$row['news_text'].'</span>';
			echo '</div>';
		}
		?>
	</div>

	<?php require "window_for_log.php"?>
</body>
</html>
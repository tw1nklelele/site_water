<?php
	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";

$code_pr = $_GET['code_pr'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Изменение товара</title>
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
		<h1 class="page_zagolovok">Изменение товара</h1>
	</div>
	<?php $connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
		$query = "SELECT * FROM Product WHERE code_product = $code_pr";
		$result = mysqli_query($connect,$query);
		foreach ($result as $row){
			$select_code = $row['Code_product'];
			$select_name = $row['Name_product'];
			$select_desc = $row['Description'];
			$select_price = $row['Price'];
			$select_cat = $row['id_type_product'];
			$select_weight = $row['Weight'];
			$img = $row['LinkImage'];
		}
	?>
	<div class="div_change_prod">
		<h2> <?php echo 'ПРОДУКТ С КОДОМ '.$select_code;?> </h2>
			<table class="table_edit_prod">
				<input type="hidden" id="code_tovar" value =<?php $select_code;?>>
				<tr>
				<td> <label> Наименование</label>
				<td><input type ="text" class="input_edit_prod" id = "name_tovar" value=<?php echo $select_name ?> >
				</tr><tr>
				<td> <label>Описание товара</label>
				<td><textarea rows="5" class ="area_desc" cols="81" class="textarea" id = "desc_tovar"> <?php echo $select_desc ?>
				</textarea>
				</td>
				</tr>
				<tr>
					<td> <label> Стоимость</label></td>
					<td><input type ="text" class="input_edit_prod" id = "price_tovar" value=<?php echo $select_price ?> >
				</tr>
					<td> <label> Категория</label></td>
					<td><select name="select" class="input_edit_prod" id = "cat_tovar">
						<?php $query = "SELECT * FROM type_product";
							$result = mysqli_query($connect,$query);
							foreach($result as $row){
								if($row['id_type_product'] = $select_cat){
									echo '<option selected ="selected" value='.$row['id_type_product'].'>';
								}
								else{
									echo '<option value='.$row['id_type_product'].'>';}
								echo $row['name_type_product'];
								echo '</option>';
							}
						?>
					</select>
				</tr>
				<tr>
					<td> <label>Вес</label></td>
					<td><input type ="text" class="input_edit_prod" id = "weight_tovar" value=<?php echo $select_weight ?> >
				</tr>
				<tr>
					<td> <label>Изображение</label></td>
					<td><img class = "img_edit" src="ImageKatalog/<?php echo $img ?> ">
						<div class="input-file-row" id="file_edit">
							<label class="input-file">
							   	<input type="file" id ="fileLoad" name="file[]" multiple accept="image/*">
							   	<span>Выберите файл</span>
					 		</label>
							<div class="input-file-list" id="new_img_edit"></div>
						</div>
				</tr>
			</table>
			<button class="button_add_product" onclick="toastFunction()"> СОХРАНИТЬ ИЗМЕНЕНИЯ </button>

			<div id="toast">
			 <div class="checkicon"> <i class="fas fa-check-square"></i> </div>
			<span id="not"></span></div>
	</div>
			<div id="toast">
			 <div class="checkicon"> <i class="fas fa-check-square"></i> </div>
			<span id="not"></span></div>



<script>
var dt = new DataTransfer();

$('.input-file input[type=file]').on('change', function(){
	let $files_list = $(this).closest('.input-file').next();
	$files_list.empty();

	for(var i = 0; i < this.files.length; i++){
		let file = this.files.item(i);
		dt.items.add(file);

		let reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onloadend = function(){
			let new_file_input = '<div class="input-file-list-item">' +
				'<img class="input-file-list-img" src="' + reader.result + '">' +
				'<span class="input-file-list-name">' + file.name + '</span>' +
				'<a href="#" onclick="removeFilesItem(this); return false;" class="input-file-list-remove">x</a>' +
			'</div>';
			$files_list.append(new_file_input);
		}
	};
	this.files = dt.files;
});

function removeFilesItem(target){
	let name = $(target).prev().text();
	let input = $(target).closest('.input-file-row').find('input[type=file]');
	$(target).closest('.input-file-list-item').remove();
	for(let i = 0; i < dt.items.length; i++){
		if(name === dt.items[i].getAsFile().name){
			dt.items.remove(i);
		}
	}
	input[0].files = dt.files;
}

</script>


<script type="text/javascript">
	$('.button_add_product').on('click',function () {
	var code = document.getElementById("code_tovar").value;
	var name = document.getElementById("name_tovar").value;
	var desc = document.getElementById("desc_tovar").value;
	var price = document.getElementById("price_tovar").value;
	var cat = document.getElementById("cat_tovar").value;
	var weight = document.getElementById("weight_tovar").value;
	var formData = new FormData();
	if(document.getElementById("fileLoad").files.length != 0 ) {
		var fileInput = $("#fileLoad")[0].files[0];
		formData.append('file',fileInput);
	}
	formData.append('code_tovar',code);
	formData.append('name_tovar',name);
	formData.append('desc_tovar',desc);
	formData.append('price_tovar',price);
	formData.append('cat_tovar',cat);
	formData.append('weight_tovar',weight);
	console.log(fileInput);
	if(document.getElementById("fileLoad").files.length != 0 ) var img = document.getElementById("fileLoad").files[0].name;
	formData.append('img_tovar',img);
	if($('#name_tovar').val().length == 0 || $('#desc_tovar').val().length == 0
		|| $('#price_tovar').val().length == 0 || $('#weight_tovar').val().length == 0){
		$('#not').text("Пожалуйста заполните все поля данными.");
  		$('#toast').css('background','#FA8072');
  		console.log('Пустые поля');
	}
	else{
		$.ajax({
	  		method: "POST",
	 	 	url: "script_edit_php.php",
	  		data: formData,
	  		processData: false,
	  		contentType: false,
	  		success: function(response){   /* функция которая будет выполнена после успешного запроса.  */
	  			if(response == 0){
	  				$('#not').text("Ошибка обновления данных");
	  				$('#toast').css('background','#FA8072');
	  			}
	  			 if(response == 1){
	  				$('#not').text("Данные товара успешно обновлены!");
	  				$('#toast').css('background','#98FB98');
	  			}
	  		}
		})
		.done(function(response){
			console.log(response);
				if(response == 0){
	  				$('#not').text("Ошибка обновления данных");
	  				$('#toast').css('background','#FA8072');
	  			}
	  			 if(response == 1){
	  				$('#not').text("Данные товара успешно обновлены!");
	  				$('#toast').css('background','#98FB98');
	  			}

		})
	}
})
</script>

<script type="text/javascript">
	function toastFunction() {
  	var x = document.getElementById("toast");
  	x.className = "show";
  	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
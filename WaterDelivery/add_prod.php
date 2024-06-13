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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Images/icon_logo.png">
	<title>Добавление товара</title>
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
		<h1 class="page_zagolovok">Добавление товара</h1>
	</div>
	<div class="div_change_prod">
			<table class="table_edit_prod">
				<tr>
					<td class="td_edit_info"> <label>Код товара</label>
					<td><input type ="text" class="input_edit_prod" id="code_tovar">
				</tr><tr>
				<td class="td_edit_info"> <label> Наименование</label>
				<td><input type ="text" class="input_edit_prod" id="name_tovar">
				</tr><tr>
				<td class="td_edit_info"> <label>Описание товара</label>
				<td><textarea class ="area_desc" rows="10" cols="81" id="desc_tovar">
				</textarea>
				</td>
				</tr>
				<tr>
					<td> <label> Стоимость</label></td>
					<td><input type ="text" class="input_edit_prod" id="price_tovar">
				</tr>
					<td> <label> Категория</label></td>
					<td>
					<div class="box1">
						<select name="select" class="input_edit_prod" id="cat_tovar">
							<?php $connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
							$query = "SELECT * FROM type_product";
								$result = mysqli_query($connect,$query);
								foreach($result as $row){
									echo '<option value='.$row['id_type_product'].'>';
									echo $row['name_type_product'];
									echo '</option>';
								}
							?>
						</select>
					</div>
				</tr>
				<tr>
					<td> <label>Вес</label></td>
					<td><input type ="text" class="input_edit_prod" id="weight_tovar">
				</tr>
				<tr>
					<td> <label>Картинка товара</label></td>
					<td>
					<form method="post" enctype="multipart/form-data">
						<div class="input-file-row">
							<label class="input-file">
							   	<input type="file" id ="fileLoad" name="file[]" multiple accept="image/*">
							   	<span>Выберите файл</span>
					 		</label>
							<div class="input-file-list"></div>
						</div>
					</form>
				</tr>
			</table>
			<button class="button_add_product" onclick="toastFunction()"> ДОБАВИТЬ ТОВАР </button>

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

	var fileInput = $("#fileLoad")[0].files[0];
	var formData = new FormData();
	formData.append('file',fileInput);
	formData.append('code_tovar',code);
	formData.append('name_tovar',name);
	formData.append('desc_tovar',desc);
	formData.append('price_tovar',price);
	formData.append('cat_tovar',cat);
	formData.append('weight_tovar',weight);
	console.log(fileInput);
	if(document.getElementById("fileLoad").files.length != 0 ) var img = document.getElementById("fileLoad").files[0].name;
	formData.append('img_tovar',img);
	if($('#code_tovar').val().length == 0 ||  $('#name_tovar').val().length == 0 || $('#desc_tovar').val().length == 0
		|| $('#price_tovar').val().length == 0 || $('#weight_tovar').val().length == 0){
		$('#not').text("Пожалуйста заполните все поля данными.");
  		$('#toast').css('background','#FA8072');
  		console.log('Пустые поля');
	}
	else{
		$.ajax({
	  		method: "POST",
	 	 	url: "add_product.php",
	  		data: formData,
	  		processData: false,
	  		contentType: false,
	  		success: function(response){   /* функция которая будет выполнена после успешного запроса.  */
	  			if(response == 0){
	  				$('#not').text("ОШИБКА! Данные не добавлены, так как товар с таким кодом уже есть.");
	  				$('#toast').css('background','#FA8072');
	  			}
	  			 if(response == 1){
	  				$('#not').text("Данные товара успешно добавлены!");
	  				$('#toast').css('background','#98FB98');
	  			}
	  		}
		})
		.done(function(response){
			console.log(response);
				if(response == 0){
	  				$('#not').text("ОШИБКА! Данные не добавлены, так как товар с таким кодом уже есть.");
	  				$('#toast').css('background','#FA8072');
	  			}
	  			 if(response == 1){
	  				$('#not').text("Данные товара успешно добавлены!");
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
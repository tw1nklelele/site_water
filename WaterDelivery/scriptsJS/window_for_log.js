$(document).ready(function() {
	$('#butEnter').on('click',function () {
		console.log('aaa');
		$('#window_for_log').css({"display":"block"});
		$('#freez').css({"display":"flex"});
	})
	$('#but_log').on('click',function () {
		$('#body_reg').css({"display":"none"});
		$('#body_enter').css({"display":"flex"});
		$(this).css({"borderBottom":"2px solid #02A5E6"});
		$('#but_reg').css({"borderBottom":"none"});
	})
	$('#but_reg').on('click',function () {
		$('#body_enter').css({"display":"none"});
		$('#body_reg').css({"display":"flex"});
		$(this).css({"borderBottom":"2px solid #02A5E6"});
		$('#but_log').css({"borderBottom":"none"});
	})
	$('#close_modal').on('click',function () {
		$('#window_for_log').css({"display":"none"});
		$('#freez').css({"display":"none"});
	})

	$('.user-icon').hover(
    function() {
      $(this).find('.dropdown-menu').show();
    },
    function() {
      $(this).find('.dropdown-menu').hide();
    }
  );

//AJAX запрос авторизации
	$('#aut_but').on('click',function () {
		login = $('#aut_log').val();
		pass = $('#aut_pass').val();
		$.ajax({
  				method: "POST",
 	 			url: "scripts_PHP/signIN.php",
  				data: {login: login, password: pass},
  				success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
					if (data == 'Успешно!') location.reload();
					else {
						$('#msg_aut').text('Неверный логин или пароль!');
					}            /* В переменной data содержится ответ от index.php. */
				}
  		})

})
})





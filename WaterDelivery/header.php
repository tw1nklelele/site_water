<div class="header"> <!-- шапка -->
		<div class ="item-header" id = "logo"> <!-- логотип -->
			<a href="index.php"><img src="Images/logo.png" id="logo"></a>
		</div>
		<div id = "header-nav"> <!-- ссылки в шапке сайта -->
				<a href="katalog.php" class="headref">Каталог</a>
				<a href="info.php" class="headref">О компании</a>
				<a href="info.php" class="headref">Доставка и оплата</a>
				<a href="news.php" class="headref">Новости</a>

				<?php if (isset($_SESSION['TypeUser'])) {
				if($_SESSION['TypeUser']=='Менеджер') {
					echo '<a href="orders.php" class="headref">Заказы</a>';
					echo '<a href="news.php" class="headref">Справочная информация</a>';
				}}
				?>
		</div>
		<div class ="item-header" id = "divButHeader">
			<?php if (!isset($_SESSION['User']) || $_SESSION['User'] == 'Клиент'){
				echo '<span id="korzina_counter">';
				echo count($_SESSION['cart']);
				echo '</span>';
				echo '<div id ="divkorzina">';
				echo '<a href ="korzina.php">';
					echo '<img src="Images/korzina.png" width="30">';
				echo '</a>';
			echo '</div>';
			}
			if (isset($_SESSION['User'])){
				echo '<div id="UserIcon">';
				if ($_SESSION['TypeUser']=='Менеджер') echo '<img src="Images/icon_manager.png" width="40">';
				echo '<ul class="dropdown-menu">';
					echo'<li id="li_quit">Возможность</li>';
    				echo'<li id="li_quit">Выйти</li>';
    			echo '</ul>';
				echo '</div>';
			}
			else{
				echo '<div id="butEnter">';
				echo '<span>ВХОД</span>';
					echo '<img width= "30" src="Images/icon-enter.png">';
				echo '</div>';
			}
			?>
		</div>
</div>

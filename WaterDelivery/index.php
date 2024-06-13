<?php
	if(session_status() !== PHP_SESSION_ACTIVE) {
    	session_start();
	}
	if (!isset($_SESSION['cart'])) {
    	$_SESSION['cart'] = array();
	}
$host = "db";
$login = "root";
$passwordDB = "root_password";
$nameDB = "Water_delivery";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);

$connect = mysqli_connect($host,$login,$passwordDB)
	or die("Ошибка при подключении".mysqli_errno ($connect).": ".mysqli_error ($connect));
	$query = "DROP DATABASE ".$nameDB;
$result = mysqli_query($connect,$query) or die("Ошибка при создании БД".mysqli_errno ($connect).": ".mysqli_error ($connect));
$query = "CREATE DATABASE ".$nameDB;
$result = mysqli_query($connect,$query) or die("Ошибка при создании БД".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE Delivery_type (
  id_delivery_type int NOT NULL,
  name_delivery_type varchar(25) DEFAULT NULL
)";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query)   or die("Ошибка при создании БД".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `Delivery_type` (`id_delivery_type`, `name_delivery_type`) VALUES
(1, 'Самовывоз'),
(2, 'Доставка курьером')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE `News` (
  `id_news` smallint NOT NULL,
  `news_header` varchar(255) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` date NOT NULL,
  `news_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "INSERT INTO `News` (`id_news`, `news_header`, `news_text`, `news_date`, `news_time`) VALUES
(1, 'Изменение времени доставки 12 июня', 'По техническим причинам наша компания 12 июня 2023 года доставку товаров будет осуществлять до 15:00', '2023-06-05', '09:00:00'),
(2, 'Новая акция!', 'С сегодняшенго дня (01 июля 2023 года) по 01 сентября 2023 года действует акция для новых клиентов. Для авторизованных пользователей на первый заказ доступен заказ двух бутылок воды в таре 19 литров по цене одной.', '2023-07-01', '09:00:00');
";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE `Order_Product` (
  `order_prod_ID` int NOT NULL,
  `order_ID` int NOT NULL,
  `Code_product` int NOT NULL,
  `quantity` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "INSERT INTO `Order_Product` (`order_prod_ID`, `order_ID`, `Code_product`, `quantity`) VALUES
(1, 5, 5555, 2),
(2, 6, 5555, 2),
(3, 7, 5555, 2),
(4, 8, 5555, 1),
(5, 8, 55555, 1),
(6, 9, 5555, 1),
(7, 9, 55555, 1),
(8, 10, 5555, 1),
(9, 10, 55555, 1),
(10, 11, 5555, 1),
(11, 11, 55555, 1),
(12, 12, 5555, 1),
(13, 12, 55555, 1),
(14, 13, 5555, 2),
(15, 13, 55555, 2),
(16, 14, 5555, 2),
(17, 14, 55555, 2),
(18, 15, 5555, 2),
(19, 16, 77777, 2),
(20, 17, 5555, 2),
(21, 17, 77777, 1),
(22, 18, 5555, 2),
(23, 18, 55555, 2),
(24, 18, 66666, 2),
(25, 19, 5555, 2),
(26, 19, 55555, 2),
(27, 19, 66666, 2),
(28, 20, 77777, 2),
(29, 20, 999999, 2),
(30, 20, 66666, 1),
(31, 21, 77777, 1),
(32, 21, 88888, 1),
(33, 21, 55555, 1)";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "CREATE TABLE `Payment_type` (
  `id_payment_type` int NOT NULL,
  `name_payment_type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "INSERT INTO `Payment_type` (`id_payment_type`, `name_payment_type`) VALUES
(1, 'Наличные'),
(2, 'Картой при получении'),
(3, 'Переводом при получении'),
(4, 'Онлайн-оплата')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "CREATE TABLE `Post_worker` (
  `id_post_worker` int NOT NULL,
  `name_post_worker` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "INSERT INTO `Post_worker` (`id_post_worker`, `name_post_worker`) VALUES
(1, 'Менеджер'),
(2, 'Диспетчер'),
(3, 'Курьер'),
(4, 'Работник склада')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE `Product` (
  `Code_product` int NOT NULL,
  `Name_product` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `id_type_product` int NOT NULL,
  `Weight` decimal(6,3) NOT NULL,
  `Volume` decimal(6,3) DEFAULT NULL,
  `LinkImage` varchar(50) NOT NULL,
  `Hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `Product` (`Code_product`, `Name_product`, `Description`, `Price`, `id_type_product`, `Weight`, `Volume`, `LinkImage`, `Hidden`) VALUES
(5555, 'Тара 19л', 'Тара для воды объёмом 19 литров', '600.00', 2, '0.700', NULL, 'Tara.png', 0),
(55555, 'Питьевая вода 19л', 'Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество', '250.00', 1, '19.700', NULL, 'Water19L.png', 0),
(66666, 'Питьевая вода 5л', 'Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество', '50.00', 1, '5.000', NULL, 'Water5L.png', 0),
(77777, 'Помпа механическая', 'Помпа необходима для набора воды', '350.00', 3, '0.200', NULL, 'Pompa.png', 0),
(88888, 'Помпа электрическая', 'Необходимая для набора воды', '600.00', 3, '0.350', NULL, 'ElectricalPompa.png', 0),
(122221, 'Вода 1,5 литра', '...				', '35.00', 1, '1.500', NULL, 'Water2L.png', 0),
(999999, 'Вода питьевая 0.5л', 'блаблабла', '25.00', 1, '0.500', NULL, 'Water0.5L.png', 0),
(1234546, 'Электрическая помпа', '...				', '550.00', 3, '0.480', NULL, 'ElectricalPompa.png', 0)";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "CREATE TABLE `type_product` (
  `id_type_product` int NOT NULL,
  `name_type_product` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `type_product` (`id_type_product`, `name_type_product`) VALUES
(1, 'Вода'),
(2, 'Тары'),
(3, 'Аксессуары'),
(4, 'Наборы')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "CREATE TABLE `type_user` (
  `id_type_user` tinyint UNSIGNED NOT NULL,
  `name_type_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO `type_user` (`id_type_user`, `name_type_user`) VALUES
(1, 'Менеджер'),
(2, 'Диспетчер'),
(3, 'Водитель'),
(4, 'Клиент')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));
$query = "CREATE TABLE `User` (
  `id_user` int UNSIGNED NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `id_type_user` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `User` (`id_user`, `Login`, `Password`, `id_type_user`) VALUES
(1, 'admin', '\$2y\$10\$ah8AwJNc/zhWqW3lte4JYu2KVRj0DSd3SKQWLo.g4WeQKjgwQL0cK', 1)";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE `Zakaz` (
  `order_ID` int NOT NULL,
  `type_order` varchar(30) NOT NULL,
  `type_pay` varchar(40) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_tel` char(10) NOT NULL,
  `date_delivery` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `name_client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `Zakaz` (`order_ID`, `type_order`, `type_pay`, `comment`, `num_tel`, `date_delivery`, `address`, `name_client`) VALUES
(16, 'Доставка', 'Наличные', NULL, '9129554934', '2023-11-12 12:30:00', 'Респ. Коми, г.Ухта, ул.Юбилейная, д.15, кв.23', 'Андрей'),
(20, 'Самовывоз', 'Наличные', 'Код домофона 1234', '9048630395', '2023-11-22 11:41:30', 'Респ Коми, г Ухта, ул Сенюкова, д 12а, кв 86', 'Трофим'),
(21, 'Самовывоз', 'Наличные', 'Позвоните за 10 минут', '9048630395', '2023-11-22 11:49:13', 'Респ Коми, г Ухта, ул Юбилейная, д 5, кв 10', 'Трофим')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));




$query = "CREATE TABLE `Zakaz_status` (
  `zakaz_status_ID` int NOT NULL,
  `order_ID` int NOT NULL,
  `name_status` varchar(40) DEFAULT NULL,
  `date_change` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "INSERT INTO `Zakaz_status` (`zakaz_status_ID`, `order_ID`, `name_status`, `date_change`) VALUES
(1, 5, 'Создан', '2023-11-21 20:23:47'),
(2, 6, 'Создан', '2023-11-21 22:26:28'),
(3, 7, 'Создан', '2023-11-21 22:27:01'),
(4, 8, 'Создан', '2023-11-21 22:29:07'),
(5, 9, 'Создан', '2023-11-21 22:37:01'),
(6, 10, 'Создан', '2023-11-21 22:37:46'),
(7, 11, 'Создан', '2023-11-21 22:39:00'),
(8, 12, 'Создан', '2023-11-21 22:39:57'),
(9, 13, 'Создан', '2023-11-21 23:14:37'),
(10, 14, 'Создан', '2023-11-21 23:15:28'),
(11, 15, 'Создан', '2023-11-21 23:24:31'),
(12, 16, 'Создан', '2023-11-10 15:18:27'),
(13, 16, 'Завершён', '2023-11-12 12:13:27'),
(14, 17, 'Создан', '2023-11-22 11:31:04'),
(15, 18, 'Создан', '2023-11-22 11:35:49'),
(16, 19, 'Создан', '2023-11-22 11:39:03'),
(17, 20, 'Создан', '2023-11-22 11:41:30'),
(18, 21, 'Создан', '2023-11-22 11:49:13')";

$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));






?>
<!DOCTYPE HTML>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Доставка воды</title>
	<link rel="icon" href="Images/icon_logo.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=8cb3cec1-6517-485e-a55d-7beca626e8db" type="text/javascript">
	</script>
	<style> .header{height: 51px;}</style>
</head>
<body>
		<?php require "header.php"?>
		<?php require "fdata.php"?>
		<?php require "window_for_log.php" ?>



										<!-- ВОЛНА -->
<svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><style>
    .path-0{
       	animation:pathAnim-0 4s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
          }
          @keyframes pathAnim-0{
            0%{
              d: path("M 0,400 C 0,400 0,133 0,133 C 113.7129186602871,124.12918660287082 227.4258373205742,115.25837320574162 326,106 C 424.5741626794258,96.74162679425838 508.0095693779905,87.0956937799043 600,101 C 691.9904306220095,114.9043062200957 792.5358851674641,152.35885167464116 884,147 C 975.4641148325359,141.64114832535884 1057.846889952153,93.4688995215311 1149,84 C 1240.153110047847,74.5311004784689 1340.0765550239234,103.76555023923444 1440,133 C 1440,133 1440,400 1440,400 Z");
            }
            25%{
              d: path("M 0,400 C 0,400 0,133 0,133 C 75.11004784688996,144.40669856459328 150.2200956937799,155.8133971291866 239,141 C 327.7799043062201,126.1866028708134 430.22966507177034,85.15311004784688 550,94 C 669.7703349282297,102.84688995215312 806.8612440191387,161.57416267942583 908,174 C 1009.1387559808613,186.42583732057417 1074.3253588516745,152.55023923444975 1157,138 C 1239.6746411483255,123.44976076555025 1339.8373205741627,128.22488038277513 1440,133 C 1440,133 1440,400 1440,400 Z");
            }
            50%{
              d: path("M 0,400 C 0,400 0,133 0,133 C 82.77511961722487,134.78947368421052 165.55023923444975,136.57894736842104 255,130 C 344.44976076555025,123.42105263157896 440.57416267942585,108.47368421052633 552,120 C 663.4258373205741,131.52631578947367 790.153110047847,169.5263157894737 879,174 C 967.846889952153,178.4736842105263 1018.8133971291866,149.42105263157893 1106,137 C 1193.1866028708134,124.57894736842107 1316.5933014354068,128.78947368421052 1440,133 C 1440,133 1440,400 1440,400 Z");
            }
            75%{
              d: path("M 0,400 C 0,400 0,133 0,133 C 85.06220095693783,121.29665071770336 170.12440191387566,109.5933014354067 259,114 C 347.87559808612434,118.4066985645933 440.56459330143537,138.92344497607655 540,131 C 639.4354066985646,123.07655502392345 745.6172248803828,86.71291866028707 858,94 C 970.3827751196172,101.28708133971293 1088.9665071770337,152.2248803827751 1187,166 C 1285.0334928229663,179.7751196172249 1362.5167464114832,156.38755980861245 1440,133 C 1440,133 1440,400 1440,400 Z");
            }
            100%{
              d: path("M 0,400 C 0,400 0,133 0,133 C 113.7129186602871,124.12918660287082 227.4258373205742,115.25837320574162 326,106 C 424.5741626794258,96.74162679425838 508.0095693779905,87.0956937799043 600,101 C 691.9904306220095,114.9043062200957 792.5358851674641,152.35885167464116 884,147 C 975.4641148325359,141.64114832535884 1057.846889952153,93.4688995215311 1149,84 C 1240.153110047847,74.5311004784689 1340.0765550239234,103.76555023923444 1440,133 C 1440,133 1440,400 1440,400 Z");
            }
          }</style><defs><linearGradient id="gradient" x1="0%" y1="50%" x2="100%" y2="50%"><stop offset="5%" stop-color="#0693e3"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,133 0,133 C 113.7129186602871,124.12918660287082 227.4258373205742,115.25837320574162 326,106 C 424.5741626794258,96.74162679425838 508.0095693779905,87.0956937799043 600,101 C 691.9904306220095,114.9043062200957 792.5358851674641,152.35885167464116 884,147 C 975.4641148325359,141.64114832535884 1057.846889952153,93.4688995215311 1149,84 C 1240.153110047847,74.5311004784689 1340.0765550239234,103.76555023923444 1440,133 C 1440,133 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53" class="transition-all duration-300 ease-in-out delay-150 path-0" transform="rotate(-180 720 200)"></path><style>
          .path-1{
            animation:pathAnim-1 4s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
          }
          @keyframes pathAnim-1{
            0%{
              d: path("M 0,400 C 0,400 0,266 0,266 C 76.26794258373204,246.53588516746413 152.53588516746407,227.07177033492823 254,232 C 355.4641148325359,236.92822966507177 482.1244019138758,266.2488038277512 584,272 C 685.8755980861242,277.7511961722488 762.9665071770333,259.93301435406704 860,248 C 957.0334928229667,236.066985645933 1074.0095693779906,230.01913875598086 1174,234 C 1273.9904306220094,237.98086124401914 1356.9952153110048,251.99043062200957 1440,266 C 1440,266 1440,400 1440,400 Z");
            }
            25%{
              d: path("M 0,400 C 0,400 0,266 0,266 C 67.05263157894737,259.0622009569378 134.10526315789474,252.1244019138756 238,239 C 341.89473684210526,225.8755980861244 482.63157894736844,206.5645933014354 599,218 C 715.3684210526316,229.4354066985646 807.3684210526317,271.6172248803828 895,281 C 982.6315789473683,290.3827751196172 1065.8947368421052,266.96650717703346 1156,259 C 1246.1052631578948,251.03349282296654 1343.0526315789475,258.51674641148327 1440,266 C 1440,266 1440,400 1440,400 Z");
            }
            50%{
              d: path("M 0,400 C 0,400 0,266 0,266 C 97.53110047846889,241.5023923444976 195.06220095693777,217.00478468899522 299,232 C 402.9377990430622,246.99521531100478 513.2822966507179,301.48325358851673 615,302 C 716.7177033492821,302.51674641148327 809.8086124401913,249.0622009569378 889,225 C 968.1913875598087,200.9377990430622 1033.4832535885168,206.26794258373204 1123,218 C 1212.5167464114832,229.73205741626796 1326.2583732057415,247.86602870813397 1440,266 C 1440,266 1440,400 1440,400 Z");
            }
            75%{
              d: path("M 0,400 C 0,400 0,266 0,266 C 86.09569377990428,266.3732057416268 172.19138755980856,266.7464114832536 268,269 C 363.80861244019144,271.2535885167464 469.33014354066995,275.3875598086124 568,285 C 666.66985645933,294.6124401913876 758.4880382775119,309.70334928229664 846,308 C 933.5119617224881,306.29665071770336 1016.7177033492824,287.799043062201 1115,278 C 1213.2822966507176,268.200956937799 1326.6411483253587,267.1004784688995 1440,266 C 1440,266 1440,400 1440,400 Z");
            }
            100%{
              d: path("M 0,400 C 0,400 0,266 0,266 C 76.26794258373204,246.53588516746413 152.53588516746407,227.07177033492823 254,232 C 355.4641148325359,236.92822966507177 482.1244019138758,266.2488038277512 584,272 C 685.8755980861242,277.7511961722488 762.9665071770333,259.93301435406704 860,248 C 957.0334928229667,236.066985645933 1074.0095693779906,230.01913875598086 1174,234 C 1273.9904306220094,237.98086124401914 1356.9952153110048,251.99043062200957 1440,266 C 1440,266 1440,400 1440,400 Z");
            }
          }</style><defs><linearGradient id="gradient" x1="0%" y1="50%" x2="100%" y2="50%"><stop offset="5%" stop-color="#0693e3"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,266 0,266 C 76.26794258373204,246.53588516746413 152.53588516746407,227.07177033492823 254,232 C 355.4641148325359,236.92822966507177 482.1244019138758,266.2488038277512 584,272 C 685.8755980861242,277.7511961722488 762.9665071770333,259.93301435406704 860,248 C 957.0334928229667,236.066985645933 1074.0095693779906,230.01913875598086 1174,234 C 1273.9904306220094,237.98086124401914 1356.9952153110048,251.99043062200957 1440,266 C 1440,266 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-1" transform="rotate(-180 720 200)"></path></svg>
    

     <?php require "window_for_log.php" ?>
    <div id="parent_info">
		<div id="info">
			<h1>КОМПАНИЯ H20</h1>
		</div>
	</div>

	<!--Анимация машины -->
	<div class="movie_body">
		<div class="road"></div>
		<img width="50" src="Images/botle.png" id="botle">
		<div class="car">
			<img src="Images/car.png">
		</div>
		<div class="wheels">
			<img src="Images/wheel.png" class="back_wheel">
			<img src="Images/wheel.png" class="front_wheel">
		</div>
	</div>

	<div class="info_body">
		<div id = "check_order">
			<input type="text" id="index_check_order" placeholder="Введите номер заказа...">
			<p><input type="submit" value ="Узнать о заказе" id="check_order_but">
		</div>
		<div class="div_zakaz_body">
			<h1 class="zagolovok" id="but_zakaz">КАК ЗАКАЗАТЬ?<h1>
			<div class="div_zakaz" id="div_zakaz">
				<div class="body_step_zakaz">
					<div class="step_zakaz">
						<div class="number"> 1 </div>
							Ознакомьтесь с каталогом, добавьте товары в корзину
							<img src="Images/dekstop_img.png" width="250">
					</div>
				</div>

				<div class="body_step_zakaz">
					<div class="step_zakaz">
						<div class="number"> 2 </div>
						<span>Перейдите в корзину, начните оформление заказа</span>
					</div>
				</div>

				<div class="body_step_zakaz">
					<div class="step_zakaz">
						<div class="number"> 3 </div>
						Укажите информацию о заказе
					</div>
				</div>

				<div class="body_step_zakaz">
					<div class="step_zakaz">
						<div class="number"> 4 </div>
						<span>Ожидайте доставку</span>
						<img src="Images/w8.png" width="150" id="imgw8">
					</div>
				</div>
			</div>
		</div>

		<div class="div_akc">
			<h1 class="zagolovok">АКЦИИ<h1>

			<div class="slider_akc">
				<div class="slide">
					<img src="Images/skidka1.png">
					<div class="info_slide">

					</div>
				</div>
			</div>
		</div>

		<div class="div_news">
			<h1 class="zagolovok" id="but_news">НОВОСТИ<h1>
			<div class="index_news_body" id='index_news'>
				<?php
					$query = "SELECT * FROM News ORDER BY id_news DESC LIMIT 2";
					$result = mysqli_query($connect,$query)
						or die("Ошибка при выводе данных новостей".mysqli_errno ($connect).": ".mysqli_error ($connect));
					foreach ($result as $row){
						echo '<div class="index_block_news">';
							echo '<h4>'.$row['news_header'].'</h4>';
							echo '<div class="block_news_text">'.$row['news_text'].'</div>';
							echo '<div class="index_news_datetime">'.$row['news_date'].' '.$row['news_time'].'</div>';
						echo '</div>';
					}
					mysqli_close($connect);
				?>
				<a href="news.php">Смотреть все новости >> </a>
			</div>
		</div>

		<div class="div_about_comp">
			<h1 class="zagolovok" id="but_contact">КОНТАКТЫ<h1>
			<div id="index_about_block">
				<div class="index_adres">

				</div>
				<div id="map" class="MapIndex"></div>
				<div class="index_contacts">

					<div class="div_contact">
						<div class="index_icon_contact">
							<img src="Images/adress.png">
						</div>
						город Ухта, ул. Капелька, д.55
					</div>

					<div class="div_contact">
						<div class="index_icon_contact">
							<img src="Images/mail.png">
						</div>
						CompanyH20@mail.ru
					</div>

					<div class="div_contact">
						<div class="index_icon_contact">
							<img src="Images/phone.png">
						</div>
						+7(999)-999-99-99
					</div>

					<div class="div_contact">
						<div class="index_icon_contact">
							<img src="Images/vk.png">
						</div>
						vk.com/companyH20
					</div>


				</div>
			</div>
		</div>
		<?php require "footer.html"?>
	</div>




	<script type="text/javascript">

	ymaps.ready(init);
	var myMap;

	function init() {

		myMap = new ymaps.Map("map", {
			center: [63.5663620589178,53.691073999999944], // Координаты центра карты
			zoom: 15 // Маштаб карты
		});



		myMap.controls.add(
			new ymaps.control.ZoomControl()  // Добавление элемента управления картой
		);

		myPlacemark = new ymaps.Placemark([63.5663620589178,53.691073999999944], { // Координаты метки объекта
			balloonContent: "<div class='ya_map'>Наш офис!</div>" // Подсказка метки
		}, {
			preset: "twirl#redDotIcon" // Тип метки
		});

		myMap.geoObjects.add(myPlacemark); // Добавление метки
		myPlacemark.balloon.open(); // Открытие подсказки метки
	};

	</script>

	<script src="index.js" type="text/javascript">
	</script>
	<script src="scriptsJS/window_for_log.js" type="text/javascript">
	</script>
</body>
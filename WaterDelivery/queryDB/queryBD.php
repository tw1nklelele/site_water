<?php

$host = "localhost";
$login = "root";
$passwordDB = "";
$nameDB = "Water_Delivery";

$connect = mysqli_connect($host,$login,$passwordDB)
	or die("Ошибка при подключении".mysqli_errno ($connect).": ".mysqli_error ($connect));
$query = "CREATE DATABASE ".$nameDB;
$result = mysqli_query($connect,$query) or die("Ошибка при создании БД".mysqli_errno ($connect).": ".mysqli_error ($connect));




$query = "CREATE TABLE `Delivery_type` (
  `id_delivery_type` int NOT NULL,
  `name_delivery_type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO `Delivery_type` (`id_delivery_type`, `name_delivery_type`) VALUES
(1, 'Самовывоз'),
(2, 'Доставка курьером');";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "CREATE TABLE `News` (
  `id_news` smallint NOT NULL,
  `news_header` varchar(255) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` date NOT NULL,
  `news_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));



$query = "CREATE TABLE type_product (
								id_type_product INT PRIMARY KEY AUTO_INCREMENT,
								name_type_product VARCHAR (20)
								)";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));


$query = "CREATE TABLE Product (
								Code_product INT PRIMARY KEY AUTO_INCREMENT,
								Name_product VARCHAR (50) NOT NULL,
								Description VARCHAR (255) NOT NULL,
								Price DECIMAL (8,2) NOT NULL,
								id_type_product INT NOT NULL,
								Weight DECIMAL (6,3) NOT NULL,
								Volume DECIMAL (6,3),
								LinkImage VARCHAR(50) NOT NULL,
								CONSTRAINT type_product_fk
    							FOREIGN KEY (id_type_product)  REFERENCES type_product (id_type_product)
								)";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO type_product(name_type_product) VALUES ('Вода'),('Бутылки'),('Аксессуары')";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при добавлении значений в таблицу Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO Product VALUES (55555,'Питьевая вода 19л','Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество',250,1,19.7,NULL, 'Water19L.png')";
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при добавлении значений в таблицу Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO Product VALUES (66666,'Питьевая вода 5л','Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество',50,1,5,NULL,'Water5L.png'), (77777,'Помпа механическая','Помпа необходима для набора воды',350,3,0.200,NULL,'Pompa.png'),
			(88888,'Помпа электрическая','Необходимая для набора воды',600,3,0.350,NULL,'ElectricalPompa.png')",
			(99999,'Питьевая вода 0.5л','блаблабла',20,1,0.5,NULL,'Water0.5L.png');
$connect = mysqli_connect($host,$login,$passwordDB,$nameDB);
$result = mysqli_query($connect,$query) or die("Ошибка при добавлении значений в таблицу Тип товара".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "CREATE TABLE News (
							id_news SMALLINT PRIMARY KEY AUTO_INCREMENT,
							news_header VARCHAR (255) NOT NULL,
							news_text TEXT NOT NULL,
							news_date DATE NOT NULL,
							news_time TIME NOT NULL)";
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Новости".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO News (news_header,news_text,news_date,news_time) VALUES ('Изменение времени доставки 12 июня', 'По техническим причинам наша компания 12 июня 2023 года доставку товаров будет осуществлять до 15:00','2023-06-05','09:00:00')";
$result = mysqli_query($connect,$query) or die("Ошибка при добавлении записи в Новости".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO News (news_header,news_text,news_date,news_time) VALUES ('Новая акция!', 'С сегодняшенго дня (01 июля 2023 года) по 01 сентября 2023 года действует акция для новых клиентов. Для авторизованных пользователей на первый заказ доступен заказ двух бутылок воды в таре 19 литров по цене одной.','2023-07-01','09:00:00')";
$result = mysqli_query($connect,$query) or die("Ошибка при добавлении записи в Новости".mysqli_errno ($connect).": ".mysqli_error ($connect));




$query = "CREATE TABLE type_user (
								id_type_user SMALLINT PRIMARY KEY AUTO_INCREMENT,
								name_type_user VARCHAR(20) NOT NULL)";
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип пользователя".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO type_user (name_type_user) VALUES ('Клиент'),('Менеджер'),('Водитель'),('Диспетчер'),('Администратор')";
$result = mysqli_query($connect,$query) or die("Ошибка при вставке данных в Тип пользователя".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "CREATE TABLE User (
								id_user INT PRIMARY KEY AUTO_INCREMENT,
								login VARCHAR(100) NOT NULL,
								Password VARCHAR(255) NOT NULL,
								id_type_user SMALLINT NOT NULL,
								CONSTRAINT type_user_fk
    							FOREIGN KEY (id_type_user)  REFERENCES type_user (id_type_user)
								)";
$result = mysqli_query($connect,$query) or die("Ошибка при создании таблицы Тип пользователя".mysqli_errno ($connect).": ".mysqli_error ($connect));

$query = "INSERT INTO type_user(login,password,id_type_user) VALUES ('admin','admin', 3)";

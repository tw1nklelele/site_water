-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 26 2023 г., 14:58
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Water_Delivery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Delivery_type`
--

CREATE TABLE `Delivery_type` (
  `id_delivery_type` int NOT NULL,
  `name_delivery_type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Delivery_type`
--

INSERT INTO `Delivery_type` (`id_delivery_type`, `name_delivery_type`) VALUES
(1, 'Самовывоз'),
(2, 'Доставка курьером');

-- --------------------------------------------------------

--
-- Структура таблицы `News`
--

CREATE TABLE `News` (
  `id_news` smallint NOT NULL,
  `news_header` varchar(255) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` date NOT NULL,
  `news_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `News`
--

INSERT INTO `News` (`id_news`, `news_header`, `news_text`, `news_date`, `news_time`) VALUES
(1, 'Изменение времени доставки 12 июня', 'По техническим причинам наша компания 12 июня 2023 года доставку товаров будет осуществлять до 15:00', '2023-06-05', '09:00:00'),
(2, 'Новая акция!', 'С сегодняшенго дня (01 июля 2023 года) по 01 сентября 2023 года действует акция для новых клиентов. Для авторизованных пользователей на первый заказ доступен заказ двух бутылок воды в таре 19 литров по цене одной.', '2023-07-01', '09:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `Order_Product`
--

CREATE TABLE `Order_Product` (
  `order_prod_ID` int NOT NULL,
  `order_ID` int NOT NULL,
  `Code_product` int NOT NULL,
  `quantity` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Order_Product`
--

INSERT INTO `Order_Product` (`order_prod_ID`, `order_ID`, `Code_product`, `quantity`) VALUES
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
(33, 21, 55555, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Payment_type`
--

CREATE TABLE `Payment_type` (
  `id_payment_type` int NOT NULL,
  `name_payment_type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Payment_type`
--

INSERT INTO `Payment_type` (`id_payment_type`, `name_payment_type`) VALUES
(1, 'Наличные'),
(2, 'Картой при получении'),
(3, 'Переводом при получении'),
(4, 'Онлайн-оплата');

-- --------------------------------------------------------

--
-- Структура таблицы `Post_worker`
--

CREATE TABLE `Post_worker` (
  `id_post_worker` int NOT NULL,
  `name_post_worker` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Post_worker`
--

INSERT INTO `Post_worker` (`id_post_worker`, `name_post_worker`) VALUES
(1, 'Менеджер'),
(2, 'Диспетчер'),
(3, 'Курьер'),
(4, 'Работник склада');

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `Code_product` int NOT NULL,
  `Name_product` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `id_type_product` int NOT NULL,
  `Weight` decimal(6,3) NOT NULL,
  `Volume` decimal(6,3) DEFAULT NULL,
  `LinkImage` varchar(50) NOT NULL,
  `Hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`Code_product`, `Name_product`, `Description`, `Price`, `id_type_product`, `Weight`, `Volume`, `LinkImage`, `Hidden`) VALUES
(5555, 'Тара 19л', 'Тара для воды объёмом 19 литров', '600.00', 2, '0.700', NULL, 'Tara.png', 0),
(55555, 'Питьевая вода 19л', 'Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество', '250.00', 1, '19.700', NULL, 'Water19L.png', 0),
(66666, 'Питьевая вода 5л', 'Чистая питьевая вода нашего производства, прошедшая все необходимые проверки на качество', '50.00', 1, '5.000', NULL, 'Water5L.png', 0),
(77777, 'Помпа механическая', 'Помпа необходима для набора воды', '350.00', 3, '0.200', NULL, 'Pompa.png', 0),
(88888, 'Помпа электрическая', 'Необходимая для набора воды', '600.00', 3, '0.350', NULL, 'ElectricalPompa.png', 0),
(122221, 'Вода 1,5 литра', '...				', '35.00', 1, '1.500', NULL, 'Water2L.png', 0),
(999999, 'Вода питьевая 0.5л', 'блаблабла', '25.00', 1, '0.500', NULL, 'Water0.5L.png', 0),
(1234546, 'Электрическая помпа', '...				', '550.00', 3, '0.480', NULL, 'ElectricalPompa.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `type_product`
--

CREATE TABLE `type_product` (
  `id_type_product` int NOT NULL,
  `name_type_product` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type_product`
--

INSERT INTO `type_product` (`id_type_product`, `name_type_product`) VALUES
(1, 'Вода'),
(2, 'Тары'),
(3, 'Аксессуары'),
(4, 'Наборы');

-- --------------------------------------------------------

--
-- Структура таблицы `type_user`
--

CREATE TABLE `type_user` (
  `id_type_user` tinyint UNSIGNED NOT NULL,
  `name_type_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type_user`
--

INSERT INTO `type_user` (`id_type_user`, `name_type_user`) VALUES
(1, 'Менеджер'),
(2, 'Диспетчер'),
(3, 'Водитель'),
(4, 'Клиент');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `id_user` int UNSIGNED NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `id_type_user` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id_user`, `Login`, `Password`, `id_type_user`) VALUES
(1, 'admin', '$2y$10$ah8AwJNc/zhWqW3lte4JYu2KVRj0DSd3SKQWLo.g4WeQKjgwQL0cK', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Zakaz`
--

CREATE TABLE `Zakaz` (
  `order_ID` int NOT NULL,
  `type_order` varchar(30) NOT NULL,
  `type_pay` varchar(40) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_tel` char(10) NOT NULL,
  `date_delivery` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `name_client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Zakaz`
--

INSERT INTO `Zakaz` (`order_ID`, `type_order`, `type_pay`, `comment`, `num_tel`, `date_delivery`, `address`, `name_client`) VALUES
(16, 'Доставка', 'Наличные', NULL, '9129554934', '2023-11-12 12:30:00', 'Респ. Коми, г.Ухта, ул.Юбилейная, д.15, кв.23', 'Андрей'),
(20, 'Самовывоз', 'Наличные', 'Код домофона 1234', '9048630395', '2023-11-22 11:41:30', 'Респ Коми, г Ухта, ул Сенюкова, д 12а, кв 86', 'Трофим'),
(21, 'Самовывоз', 'Наличные', 'Позвоните за 10 минут', '9048630395', '2023-11-22 11:49:13', 'Респ Коми, г Ухта, ул Юбилейная, д 5, кв 10', 'Трофим');

-- --------------------------------------------------------

--
-- Структура таблицы `Zakaz_status`
--

CREATE TABLE `Zakaz_status` (
  `zakaz_status_ID` int NOT NULL,
  `order_ID` int NOT NULL,
  `name_status` varchar(40) DEFAULT NULL,
  `date_change` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Zakaz_status`
--

INSERT INTO `Zakaz_status` (`zakaz_status_ID`, `order_ID`, `name_status`, `date_change`) VALUES
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
(18, 21, 'Создан', '2023-11-22 11:49:13');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Delivery_type`
--
ALTER TABLE `Delivery_type`
  ADD PRIMARY KEY (`id_delivery_type`);

--
-- Индексы таблицы `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id_news`);

--
-- Индексы таблицы `Order_Product`
--
ALTER TABLE `Order_Product`
  ADD PRIMARY KEY (`order_prod_ID`);

--
-- Индексы таблицы `Payment_type`
--
ALTER TABLE `Payment_type`
  ADD PRIMARY KEY (`id_payment_type`);

--
-- Индексы таблицы `Post_worker`
--
ALTER TABLE `Post_worker`
  ADD PRIMARY KEY (`id_post_worker`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Code_product`),
  ADD KEY `type_product_fk` (`id_type_product`);

--
-- Индексы таблицы `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id_type_product`);

--
-- Индексы таблицы `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`id_type_user`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `Zakaz`
--
ALTER TABLE `Zakaz`
  ADD PRIMARY KEY (`order_ID`);

--
-- Индексы таблицы `Zakaz_status`
--
ALTER TABLE `Zakaz_status`
  ADD PRIMARY KEY (`zakaz_status_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Delivery_type`
--
ALTER TABLE `Delivery_type`
  MODIFY `id_delivery_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `News`
--
ALTER TABLE `News`
  MODIFY `id_news` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Order_Product`
--
ALTER TABLE `Order_Product`
  MODIFY `order_prod_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `Payment_type`
--
ALTER TABLE `Payment_type`
  MODIFY `id_payment_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Post_worker`
--
ALTER TABLE `Post_worker`
  MODIFY `id_post_worker` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `Code_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5424324;

--
-- AUTO_INCREMENT для таблицы `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id_type_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Zakaz`
--
ALTER TABLE `Zakaz`
  MODIFY `order_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `Zakaz_status`
--
ALTER TABLE `Zakaz_status`
  MODIFY `zakaz_status_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `type_product_fk` FOREIGN KEY (`id_type_product`) REFERENCES `type_product` (`id_type_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Чрв 18 2022 р., 20:33
-- Версія сервера: 10.4.21-MariaDB
-- Версія PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Структура таблиці `add_sevrvice`
--

CREATE TABLE `add_sevrvice` (
  `id` int(100) NOT NULL,
  `id_type` int(100) NOT NULL,
  `id_partner` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `add_sevrvice`
--

INSERT INTO `add_sevrvice` (`id`, `id_type`, `id_partner`, `name`, `price`) VALUES
(3, 2, 4, 'Додаткове прибирання', 100),
(4, 2, 4, 'Сауна', 400),
(5, 2, 4, 'Приладдя для барбекю', 250),
(6, 1, 5, 'Сніданок', 70),
(7, 1, 5, 'Вечеря', 80),
(8, 1, 5, 'Обід', 100);

-- --------------------------------------------------------

--
-- Структура таблиці `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`, `name`, `phone`) VALUES
(1, 'admin', '1111', 'admin', '+38025485522');

-- --------------------------------------------------------

--
-- Структура таблиці `all_add_service`
--

CREATE TABLE `all_add_service` (
  `id` int(100) NOT NULL,
  `id_order` int(100) NOT NULL,
  `id_service` int(100) NOT NULL,
  `count` int(100) NOT NULL,
  `sum` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблиці `clients`
--

CREATE TABLE `clients` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `clients`
--

INSERT INTO `clients` (`id`, `name`, `passport`, `phone`) VALUES
(14, 'Василь', 'hytyhe', 'hyh'),
(15, 'Катерина', 'etyh', 'etj'),
(16, 'Іван', 'hn', 'dhnd');

-- --------------------------------------------------------

--
-- Структура таблиці `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `id_client` int(100) NOT NULL,
  `number_people` int(100) NOT NULL,
  `id_room` int(100) NOT NULL,
  `date_start` varchar(100) NOT NULL,
  `date_end` varchar(100) NOT NULL,
  `id_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `orders`
--

INSERT INTO `orders` (`id`, `id_client`, `number_people`, `id_room`, `date_start`, `date_end`, `id_status`) VALUES
(16, 14, 1, 10, '2022-06-16', '2022-06-19', 2),
(17, 15, 3, 19, '2022-06-15', '2022-06-18', 2),
(18, 16, 1, 6, '2022-06-13', '2022-06-15', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `partner`
--

CREATE TABLE `partner` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблиці `payment`
--

CREATE TABLE `payment` (
  `id` int(100) NOT NULL,
  `sum` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `id_order` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблиці `rooms`
--

CREATE TABLE `rooms` (
  `id` int(100) NOT NULL,
  `id_type` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `rooms`
--

INSERT INTO `rooms` (`id`, `id_type`, `name`, `price`, `description`) VALUES
(6, 18, '№1', 250, ''),
(7, 18, '№2', 250, ''),
(8, 18, '№3', 250, ''),
(9, 18, '№4', 250, ''),
(10, 18, '№5', 250, ''),
(11, 18, '№6', 250, ''),
(12, 18, '№7', 250, ''),
(13, 17, '№8', 400, ''),
(14, 17, '№9', 400, ''),
(15, 17, '№10', 400, ''),
(16, 17, '№11', 400, ''),
(17, 16, '№12', 600, ''),
(18, 16, '№13', 600, ''),
(19, 16, '№14', 600, ''),
(20, 15, '№15', 900, ''),
(21, 15, '№16', 900, ''),
(23, 15, '№17', 900, '');

-- --------------------------------------------------------

--
-- Структура таблиці `status`
--

CREATE TABLE `status` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'бронь'),
(2, 'проживають'),
(3, 'виїхали');

-- --------------------------------------------------------

--
-- Структура таблиці `type_add_service`
--

CREATE TABLE `type_add_service` (
  `id` int(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `type_add_service`
--

INSERT INTO `type_add_service` (`id`, `type`) VALUES
(1, 'їжа / продукти'),
(2, 'інше');

-- --------------------------------------------------------

--
-- Структура таблиці `type_room`
--

CREATE TABLE `type_room` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `type_room`
--

INSERT INTO `type_room` (`id`, `name`) VALUES
(15, 'Люкс 4-місний'),
(16, 'Сімейний 3-місний'),
(17, 'Бюджетний 2-місний'),
(18, 'Стандартний 1-місний');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `add_sevrvice`
--
ALTER TABLE `add_sevrvice`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `all_add_service`
--
ALTER TABLE `all_add_service`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `type_add_service`
--
ALTER TABLE `type_add_service`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `type_room`
--
ALTER TABLE `type_room`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `add_sevrvice`
--
ALTER TABLE `add_sevrvice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `all_add_service`
--
ALTER TABLE `all_add_service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблиці `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблиці `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблиці `status`
--
ALTER TABLE `status`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `type_add_service`
--
ALTER TABLE `type_add_service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `type_room`
--
ALTER TABLE `type_room`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

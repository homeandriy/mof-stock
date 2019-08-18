-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 18 2019 г., 22:23
-- Версия сервера: 5.7.27-0ubuntu0.18.04.1
-- Версия PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crmwp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `c4rm_nomenclature`
--

CREATE TABLE `c4rm_nomenclature` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type_pay` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `c4rm_ordered_nomenclature`
--

CREATE TABLE `c4rm_ordered_nomenclature` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `nomenclatureID` int(11) NOT NULL,
  `sendDate` datetime NOT NULL,
  `receivedDate` datetime NOT NULL,
  `amount` int(11) NOT NULL COMMENT 'кількість',
  `priority` int(11) NOT NULL COMMENT '1 дуже срочно / 0 не дуже срочно'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `c4rm_orders`
--

CREATE TABLE `c4rm_orders` (
  `orderId` int(11) NOT NULL,
  `crateDate` datetime NOT NULL COMMENT 'Дата створення',
  `createUser` varchar(100) NOT NULL COMMENT 'email того хто створив',
  `storageName` varchar(60) NOT NULL COMMENT 'Номер складу, в який треба відправити',
  `city` varchar(60) NOT NULL COMMENT 'Місто в яке відправляти',
  `proficomId` varchar(60) NOT NULL COMMENT 'Номер накладної в профікомі',
  `sendDate` datetime NOT NULL COMMENT 'Дата надсилання профікомом',
  `receivingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата отримання',
  `receivingEmail` varchar(60) NOT NULL COMMENT 'email того хто отримав',
  `taxId` varchar(60) NOT NULL COMMENT 'Номер накладної',
  `dateTaxReceiving` datetime NOT NULL COMMENT 'Дата отримання накладних',
  `dateModifed` datetime NOT NULL COMMENT 'Дата модифікації при обробці заявок',
  `createComments` text NOT NULL COMMENT 'Коментарій при створенні',
  `receivedComments` text NOT NULL COMMENT 'Коментарій при отриманні',
  `userComments` text NOT NULL COMMENT 'Коментарій того хто обробляє замовлення',
  `status` varchar(30) NOT NULL COMMENT 'new / processing / sendFromStock/received/closed',
  `state` int(11) NOT NULL COMMENT '1 активний / 0 не активний'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `c4rm_nomenclature`
--
ALTER TABLE `c4rm_nomenclature`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `c4rm_ordered_nomenclature`
--
ALTER TABLE `c4rm_ordered_nomenclature`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `c4rm_orders`
--
ALTER TABLE `c4rm_orders`
  ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `c4rm_nomenclature`
--
ALTER TABLE `c4rm_nomenclature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `c4rm_ordered_nomenclature`
--
ALTER TABLE `c4rm_ordered_nomenclature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `c4rm_orders`
--
ALTER TABLE `c4rm_orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

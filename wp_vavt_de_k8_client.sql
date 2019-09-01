-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 04 2019 г., 13:30
-- Версия сервера: 10.2.17-MariaDB-10.2.17+maria~stretch
-- Версия PHP: 5.6.22-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `c1w5db1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wp_vavt_de_k8_client`
--

CREATE TABLE `wp_vavt_de_k8_client` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wp_vavt_de_k8_client`
--

INSERT INTO `wp_vavt_de_k8_client` (`id`, `phone`) VALUES
(20, '4915908454382'),
(21, '4915122222424'),
(22, '4915168192520'),
(23, '4915908613282'),
(24, '447480728290'),
(25, '4915903922388'),
(26, '8613062888081'),
(27, '41763606008'),
(28, '410795882198'),
(29, '491711718494'),
(30, '41798112123'),
(31, '41743894938'),
(32, '491792261694'),
(33, '4915172686671'),
(34, '4915903922700'),
(35, '431736690478'),
(36, '4917641613127');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `wp_vavt_de_k8_client`
--
ALTER TABLE `wp_vavt_de_k8_client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `wp_vavt_de_k8_client`
--
ALTER TABLE `wp_vavt_de_k8_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 04 2019 г., 13:31
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
-- Структура таблицы `wp_vavt_de_k8_coupon`
--

CREATE TABLE `wp_vavt_de_k8_coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `is_taken` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wp_vavt_de_k8_coupon`
--

INSERT INTO `wp_vavt_de_k8_coupon` (`id`, `code`, `client_id`, `is_taken`) VALUES
(1, '0caeicxb9u', NULL, 0),
(2, '82s9qq10ol', NULL, 0),
(3, 'h5kuku3jv0', 32, 1),
(4, '1um6mzv9nh', 22, 1),
(5, '6146jdnwas', NULL, 0),
(6, 'stziqtea9u', 31, 1),
(7, 'rf7b4ldrew', 36, 1),
(8, 'weiwkuwq51', 34, 1),
(9, '7uwbvicqjx', NULL, 0),
(10, '66fqqbj3pl', NULL, 0),
(11, '6zn4wzzdc4', 26, 1),
(12, 'b4omivusr7', 21, 1),
(13, 'xsr6zbkhsi', NULL, 0),
(14, 'dogguxlogr', NULL, 0),
(15, 'q839ca2uyu', NULL, 0),
(16, '6xkw3n4rvr', 23, 1),
(17, 'aqd0lns4jo', NULL, 0),
(18, 'di5jpx96so', 27, 1),
(19, 'fmtfsu15aa', NULL, 0),
(20, 'ooiavhi5u9', NULL, 0),
(21, '29a4rktu5c', NULL, 0),
(22, 'cvcdn7xk06', NULL, 0),
(23, 'j7sv6chhyz', 28, 1),
(24, 'y9xikqu3x3', NULL, 0),
(25, 'i4b74egmrd', NULL, 0),
(26, '7yny98fgc9', NULL, 0),
(27, 'os0sa42jl5', NULL, 0),
(28, 'tliyvstqrd', NULL, 0),
(29, 'jz3t9qzrc3', NULL, 0),
(30, 'ji2vdhdhcc', NULL, 0),
(31, '6ifamvmljx', NULL, 0),
(32, 'nrco6oezd6', 35, 1),
(33, 'ueqqzuyjaa', NULL, 0),
(34, 'n369vzqj7g', 25, 1),
(35, 'n453pfuxpo', NULL, 0),
(36, '06mca5nsec', 33, 1),
(37, '51d9gp1pqi', NULL, 0),
(38, 'ekfcxb5tnw', NULL, 0),
(39, 'sgffb0hb5l', 29, 1),
(40, 'kuyj6iyxfw', NULL, 0),
(41, 'bsiz3pxima', 30, 1),
(42, '5qq9gqonth', NULL, 0),
(43, '6hw7eyq980', 24, 1),
(44, 'jn9mo34rao', NULL, 0),
(45, 'kms9s6mnwm', NULL, 0),
(46, '5yms2cg7vu', 20, 1),
(47, 'bvdbrk10ou', NULL, 0),
(48, 'hse845gn02', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `wp_vavt_de_k8_coupon`
--
ALTER TABLE `wp_vavt_de_k8_coupon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `wp_vavt_de_k8_coupon`
--
ALTER TABLE `wp_vavt_de_k8_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

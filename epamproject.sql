-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2022 г., 20:09
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `epamproject`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `requests_id` int(11) NOT NULL,
  `user_custom_id` int(11) DEFAULT NULL,
  `user_name` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_profession` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requests_status` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_time` datetime NOT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`requests_id`, `user_custom_id`, `user_name`, `user_phone`, `doctor_profession`, `requests_status`, `request_time`, `employee_id`) VALUES
(4, NULL, 'Anonymus', '951-11-121', 'therapist', 'CLOSED', '2022-05-07 21:13:52', 3),
(3, 3, 'Dmitry B', '095-23-123', 'traumatologist', 'CLOSED', '2022-05-07 20:18:52', NULL),
(5, 3, 'Dmitry B', '095-23-123', 'surgeon', 'CLOSED', '2022-05-07 21:14:37', NULL),
(6, 3, 'Dmitry B', '095-23-123', 'oculist', 'CLOSED', '2022-05-08 18:22:47', 3),
(7, NULL, 'Dmitry', '095-23-123', 'therapist', 'CLOSED', '2022-05-08 20:55:46', 3),
(8, 3, 'Dmitry B', '095-23-123', 'surgeon', 'CLOSED', '2022-05-09 21:00:15', 3),
(9, NULL, '1', '066-12-123', 'therapist', 'CLOSED', '2022-05-09 21:22:57', 3),
(10, 3, 'Dmitry B', '095-23-123', 'surgeon', 'CLOSED', '2022-05-09 21:57:55', 3),
(11, 3, 'Dmitry B', '095-23-123', 'lor', 'CLOSED', '2022-05-09 21:58:03', 3),
(12, 3, 'Dmitry B', '095-23-123', 'oculist', 'CLOSED', '2022-05-09 21:58:13', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_passwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_salt` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_hex` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_email` char(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_passwd`, `user_salt`, `active_hex`, `user_phone`, `user_role`, `user_status`, `user_email`) VALUES
(0, 'Dmitry B', '', '', '', '', 2, 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requests_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `requests_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

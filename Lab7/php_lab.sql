-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2020 г., 11:17
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php_lab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `continents`
--

CREATE TABLE `continents` (
  `id_continent` int(100) NOT NULL,
  `continent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `continents`
--

INSERT INTO `continents` (`id_continent`, `continent`) VALUES
(1, 'Північна Америка'),
(2, 'Євразія'),
(3, 'Південна Америка'),
(4, 'Африка'),
(5, 'Австралія'),
(6, 'Антарктида');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id_country` int(100) NOT NULL,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_continent` int(100) DEFAULT NULL,
  `id_government` int(100) DEFAULT NULL,
  `population` double DEFAULT NULL,
  `square` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id_country`, `country_name`, `id_continent`, `id_government`, `population`, `square`) VALUES
(1, 'Канада', 1, 1, 37067011, 9984670),
(2, 'Монако', 2, 2, 38400, 2),
(8, 'Люксембург', 2, 5, 613900, 25864),
(9, 'Україна', 2, 1, 37285000, 603628),
(11, 'Франція', 2, 4, 0, 0),
(13, 'Італія', 2, 3, 0, 0),
(14, 'Росія', 2, 4, 0, 0),
(17, 'Великобританія', 2, 2, 66273576, 243809),
(25, 'Сполучені Штати Амер', 1, 6, 325719178, 9826675),
(26, 'Чилі', 3, 6, 16634603, 756950);

-- --------------------------------------------------------

--
-- Структура таблицы `country_language`
--

CREATE TABLE `country_language` (
  `id_country_language` int(100) NOT NULL,
  `id_language` int(100) DEFAULT NULL,
  `id_country` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `country_language`
--

INSERT INTO `country_language` (`id_country_language`, `id_language`, `id_country`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(5, 2, 8),
(6, 7, 8),
(7, 8, 8),
(8, 4, 9),
(10, 5, 14),
(13, 1, 17),
(19, 1, 25),
(20, 6, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `government`
--

CREATE TABLE `government` (
  `id_government` int(100) NOT NULL,
  `government` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `government`
--

INSERT INTO `government` (`id_government`, `government`) VALUES
(1, 'унітарна парламентсько-президентська республіка'),
(2, 'конституційна монархія'),
(3, 'президент'),
(4, 'президентськo-парламентська федеративна республіка'),
(5, 'унітарна парламентська монархія'),
(6, 'федеративна конституційна республіка');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id_language` int(100) NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id_language`, `language`) VALUES
(1, 'англійська'),
(2, 'французька'),
(3, 'азербайджанська'),
(4, 'українська'),
(5, 'російська'),
(6, 'іспанська'),
(7, 'люксембурзька'),
(8, 'німецька');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `continents`
--
ALTER TABLE `continents`
  ADD PRIMARY KEY (`id_continent`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`),
  ADD UNIQUE KEY `country_name` (`country_name`);

--
-- Индексы таблицы `country_language`
--
ALTER TABLE `country_language`
  ADD PRIMARY KEY (`id_country_language`);

--
-- Индексы таблицы `government`
--
ALTER TABLE `government`
  ADD PRIMARY KEY (`id_government`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_language`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `continents`
--
ALTER TABLE `continents`
  MODIFY `id_continent` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `country_language`
--
ALTER TABLE `country_language`
  MODIFY `id_country_language` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `government`
--
ALTER TABLE `government`
  MODIFY `id_government` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

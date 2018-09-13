-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 13 2018 г., 16:46
-- Версия сервера: 8.0.11
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `easy.studio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `decodes`
--

CREATE TABLE `decodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `secret_code_id` int(10) UNSIGNED NOT NULL,
  `decode_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `decodes`
--

INSERT INTO `decodes` (`id`, `secret_code_id`, `decode_code`, `created_at`, `updated_at`) VALUES
(1, 1, 457, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(2, 1, 98, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(3, 1, 2, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(4, 1, 12637, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(5, 1, 89123789, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(6, 1, -2010, '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(7, 2, 98, '2018-09-13 13:45:56', '2018-09-13 13:45:56'),
(8, 2, 2, '2018-09-13 13:45:56', '2018-09-13 13:45:56'),
(9, 2, 12637, '2018-09-13 13:45:56', '2018-09-13 13:45:56'),
(10, 2, 5, '2018-09-13 13:45:56', '2018-09-13 13:45:56');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_11_141410_create_secret_codes_table', 1),
(2, '2018_09_11_142103_create_decodes_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `secret_codes`
--

CREATE TABLE `secret_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `secret_codes`
--

INSERT INTO `secret_codes` (`id`, `code_name`, `secret_code`, `created_at`, `updated_at`) VALUES
(1, 'code number 1', 'easystudio\r\nlala-}blab{la ! =)) :( {457} 7775 \r\n{-1.000001 } 32 {+98} {2} {+3.14} \r\n{12637} 9812 {89123789} 1 O O1 01 1O\r\n1}OO {zer}o! {df1000 ggg... {5-} 105} \r\n{-2010} wass{auupp!!}', '2018-09-13 13:23:40', '2018-09-13 13:23:40'),
(2, 'code number 2', 'easystudio\r\nlala-}blab{la ! =)) :( {-3c 7775 \r\n{-1.000001 } 32 {+98} {2} {+3.14} \r\n{12637} 9812 {4-5389} 1 O O1 01 1O{4-5h3459}\r\n1}OO {zer}o! {df1000 ggg... {5-} 105}{5} \r\n{0610} wass{auupp!!}', '2018-09-13 13:45:56', '2018-09-13 13:45:56');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `decodes`
--
ALTER TABLE `decodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `secret_codes`
--
ALTER TABLE `secret_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `decodes`
--
ALTER TABLE `decodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `secret_codes`
--
ALTER TABLE `secret_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 21 2021 г., 18:20
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `coffe_site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auxiliary`
--

CREATE TABLE `auxiliary` (
  `page` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content_caption` varchar(100) NOT NULL,
  `other_content` text NOT NULL,
  `footer` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `auxiliary`
--

INSERT INTO `auxiliary` (`page`, `title`, `content_caption`, `other_content`, `footer`) VALUES
('authorization', 'Блог о кофе', 'Вход', 'Введите ваши данные.', 'Copyright &copy; Caffeine 2021'),
('contact', 'Блог о кофе', 'Контакты', 'Свяжитесь со мной, если вам это нужно.', 'Copyright &copy; Caffeine 2021'),
('index', 'Блог о кофе', 'Немного о сортах:', 'Каждый хотя бы раз пробовал чашку горячего кофе, но уверен, что не каждый знает о том,\r\nкакое бывает кофе.', 'Copyright &copy; Caffeine 2021'),
('recipes', 'Блог о кофе', 'Рецепты по приготовлению кофе', '', 'Copyright &copy; Caffeine 2021'),
('registration', 'Блог о кофе', 'Регистрация', 'Введите ваши данные.', 'Copyright &copy; Caffeine 2021');

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE `main` (
  `id` int(11) NOT NULL,
  `content_url` text NOT NULL,
  `content_text` text NOT NULL,
  `content_text2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `main`
--

INSERT INTO `main` (`id`, `content_url`, `content_text`, `content_text2`) VALUES
(1, 'images/arabica.jpg', 'Арабика – самый важный вид кофе в мире –\r\n    отличается сложным ароматом. У арабики богатый вкус с яркой кислотностью.', 'Арабика растёт в прохладном субтропический климате, требует большое количество\r\n    влаги, плодородную почву, тень и солнце. Содержание кофеина на чашку примерно 1,7%.'),
(2, 'images/liberika.jpg', 'Вкус либерики оставляет желать лучшего,\r\n    он очень невыразительный и водянистый. Напиток приготовленный с такого зерна горький и очень резкий.\r\n    Из-за этого либерику практически не пьют в чистом виде.', 'В либерике есть свои преимущества – это прекрасный и сильный аромат. Содержание кофеина на чашку\r\n    примерно 2,4%'),
(3, 'images/robusta.jpg', 'Робуста – второй по популярности вид\r\n    кофе в мире – характеризуется высоким содержанием кофеина в зернах. Робусту используют в кофейных смесях\r\n    для придания крепости напитку.', 'Зерна робусты грубые и простые на вкус, с выраженной горечью. Робуста же выращивается на малых высотах от\r\n    200 до 800 метров и менее прихотлива к климатическим условиям. Содержание кофеина на чашку примерно 4,5%.');

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `content_url` varchar(100) NOT NULL,
  `content_text` text NOT NULL,
  `content_text2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`content_url`, `content_text`, `content_text2`) VALUES
('images/espresso.jpg', 'как готовить эспрессо', 'Эспрессо — самый популярный кофе на сегодня. На ег...'),
('images/irish_coffe.jpeg', 'кофе для взрослых', 'Кофе по-ирла́ндски - это напиток, который поможет вам...'),
('images/jar.jpg', 'как правильно хранить кофе', 'Неправильное хранение зернового кофе, даже качеств...'),
('images/kapuchino.jpg', 'как приготовить вкусный...', 'Капучино – напиток, покоривший сердца сотен миллио...'),
('images/latte.jpg', 'чем отличается латте от ка...', 'Расскажем о разнице между двумя популярными напитк...'),
('images/paint_on_coffe.jpg', 'как сделать рисунок на латте', 'Чтобы создавать собственные мини-шедевры у себя дома...');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`name`, `email`, `review`) VALUES
('Роман', 'rmn.polishchuk@gmail.com', 'test'),
('Кирилл', 'kirillshcherbakov2002@gmail.com', 'Здарова\r\n'),
('Кирилл', 'kirillshcherbakov2002@gmail.com', 'Здарова\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'ad2c3cd0607bb933cd504f1d2db3d03f'),
(2, 'fff', 'd9b1d7db4cd6e70935368a1efb10e377');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auxiliary`
--
ALTER TABLE `auxiliary`
  ADD PRIMARY KEY (`page`,`content_caption`),
  ADD KEY `title` (`title`),
  ADD KEY `footer` (`footer`);

--
-- Индексы таблицы `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`content_url`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `main`
--
ALTER TABLE `main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

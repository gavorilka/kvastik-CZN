-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 16 2022 г., 18:30
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kvestik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `picture_url` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `sub_title`, `description`, `text`, `picture_url`, `create_date`) VALUES
(1, 2, 'jghjh', 'hjhkb', 'uyygvyg', 'jvuyvyu', 'img/posts/1.jpeg', '2022-08-16 18:17:35'),
(2, 2, 'jghjh', 'hjhkb', 'uyygvyg', 'jvuyvyu', 'img/posts/2type.png', '2022-08-16 18:17:35'),
(3, 2, 'jghjh', 'hjhkb', 'uyygvyg', 'jvuyvyu', 'img/posts/1.jpeg', '2022-08-16 18:17:35'),
(4, 2, 'jghjh', 'hjhkb', 'uyygvyg', 'jvuyvyu', 'img/posts/1.jpeg', '2022-08-16 18:17:35'),
(9, 1, 'jghjh', 'hjhkb', 'uyygvyg', 'jvuyvyu', 'img/posts/1.jpeg', '2022-08-16 18:17:35'),
(11, 1, 'Title example\r\n', 'Subtitle example\r\n', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid architecto aspernatur delectus deserunt eaque eos in maxime neque perspiciatis quas quia quidem quis, quos, reiciendis sunt tempore tenetur. Numquam?', 'img/posts/type-join.png', '2022-08-16 18:17:35'),
(12, 3, 'Title example ', 'Subtitle example ', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid architecto aspernatur delectus deserunt eaque eos in maxime neque perspiciatis quas quia quidem quis, quos, reiciendis sunt tempore tenetur. Numquam?', 'img/posts/join.png', '2022-08-16 18:17:35'),
(13, 3, 'Title example ', 'Subtitle example ', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid architecto aspernatur delectus deserunt eaque eos in maxime neque perspiciatis quas quia quidem quis, quos, reiciendis sunt tempore tenetur. Numquam?', 'img/posts/1.jpeg', '2022-08-16 18:17:35');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `time_label` datetime NOT NULL DEFAULT current_timestamp(),
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `time_label`, `isadmin`) VALUES
(1, 'Pit', '$2y$10$tCHF9YCnWlFpkG7Qd2wm5Obq73I6WQMkaPCkbc.8NNiH.3SVdTgu2', '2022-08-16 17:28:57', 0),
(2, 'Bob', '$2y$10$VDYQ3oMpKz0usEiPy8KRe.8rAlSgoY66fn3rwRKvjq8.zjbPrOlHW', '2022-08-16 17:29:26', 1),
(3, 'Rit', '', '2022-08-16 18:15:14', 0),
(4, 'Bob1', '$2y$10$VDYQ3oMpKz0usEiPy8KRe.8rAlSgoY66fn3rwRKvjq8.zjbPrOlHW', '2022-08-16 17:29:26', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_ibfk_1` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

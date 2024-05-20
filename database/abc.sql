-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 20 2024 г., 11:03
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `abc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attendance`
--

CREATE TABLE `attendance` (
  `ИИН` varchar(12) NOT NULL,
  `Номер_кружка` int(2) NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Структура таблицы `clubs`
--

CREATE TABLE `clubs` (
  `Номер_кружка` int(1) NOT NULL,
  `Название` tinytext DEFAULT NULL,
  `Количество_занятий` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Структура таблицы `loginadmin`
--

CREATE TABLE `loginadmin` (
  `login` varchar(255) DEFAULT NULL,
  `parol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `ИИН` varchar(12) NOT NULL,
  `месяц` varchar(2) NOT NULL,
  `год` int(4) NOT NULL,
  `статус` tinyint(1) DEFAULT 0,
  `Сумма` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `ИИН` varchar(12) NOT NULL,
  `Фамилия` tinytext DEFAULT NULL,
  `Имя` tinytext DEFAULT NULL,
  `Отчество` tinytext DEFAULT NULL,
  `Телефон` int(15) DEFAULT NULL,
  `Улица` varchar(50) DEFAULT NULL,
  `Дом` int(5) DEFAULT NULL,
  `Квартира` int(3) DEFAULT NULL,
  `Дата_рождения` date DEFAULT NULL,
  `Пароль` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Структура таблицы `students_and_clubs`
--

CREATE TABLE `students_and_clubs` (
  `ИИН` varchar(12) NOT NULL,
  `Номер_кружка` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

\
--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ИИН`,`Номер_кружка`,`Дата`),
  ADD KEY `fk_club` (`Номер_кружка`);

--
-- Индексы таблицы `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`Номер_кружка`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ИИН`,`месяц`,`год`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ИИН`);

--
-- Индексы таблицы `students_and_clubs`
--
ALTER TABLE `students_and_clubs`
  ADD PRIMARY KEY (`ИИН`,`Номер_кружка`),
  ADD KEY `Номер_кружка` (`Номер_кружка`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance` FOREIGN KEY (`ИИН`) REFERENCES `students` (`ИИН`),
  ADD CONSTRAINT `fk_club` FOREIGN KEY (`Номер_кружка`) REFERENCES `clubs` (`Номер_кружка`);

--
-- Ограничения внешнего ключа таблицы `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_iin_pay` FOREIGN KEY (`ИИН`) REFERENCES `students` (`ИИН`);

--
-- Ограничения внешнего ключа таблицы `students_and_clubs`
--
ALTER TABLE `students_and_clubs`
  ADD CONSTRAINT `fk_students_iin` FOREIGN KEY (`ИИН`) REFERENCES `students` (`ИИН`),
  ADD CONSTRAINT `students_and_clubs_ibfk_2` FOREIGN KEY (`Номер_кружка`) REFERENCES `clubs` (`Номер_кружка`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 15 2020 г., 22:11
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `polyclinic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Number` int(11) NOT NULL,
  `id_quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `analyzes`
--

CREATE TABLE `analyzes` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cabinet`
--

CREATE TABLE `cabinet` (
  `id` int(11) NOT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `classification_diagnosis`
--

CREATE TABLE `classification_diagnosis` (
  `id` int(11) NOT NULL,
  `Title` int(25) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `id_reception` int(11) NOT NULL,
  `id_medicines` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_classification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `Surname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Patronymic` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_specialty` int(11) NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `Surname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Patronymic` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Passport` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Policy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Birth` date NOT NULL,
  `id_address` int(11) NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `procedures`
--

CREATE TABLE `procedures` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `quarter`
--

CREATE TABLE `quarter` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reception`
--

CREATE TABLE `reception` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_diagnosis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `id_reception` int(11) NOT NULL,
  `id_analyzes` int(11) NOT NULL,
  `id_procedures` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `Title` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `Begin` time NOT NULL,
  `End` time NOT NULL,
  `id_days` int(11) NOT NULL,
  `id_cabinet` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_role` (`id_role`);

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_quarter` (`id_quarter`);

--
-- Индексы таблицы `analyzes`
--
ALTER TABLE `analyzes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cabinet`
--
ALTER TABLE `cabinet`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classification_diagnosis`
--
ALTER TABLE `classification_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_reception` (`id_reception`),
  ADD UNIQUE KEY `id_medicines` (`id_medicines`);

--
-- Индексы таблицы `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_classification` (`id_classification`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_specialty` (`id_specialty`),
  ADD UNIQUE KEY `id_account` (`id_account`);

--
-- Индексы таблицы `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_address` (`id_address`),
  ADD UNIQUE KEY `id_account` (`id_account`);

--
-- Индексы таблицы `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quarter`
--
ALTER TABLE `quarter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reception`
--
ALTER TABLE `reception`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_patient` (`id_patient`),
  ADD UNIQUE KEY `id_employee` (`id_employee`),
  ADD UNIQUE KEY `id_diagnosis` (`id_diagnosis`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_reception` (`id_reception`),
  ADD UNIQUE KEY `id_analyzes` (`id_analyzes`),
  ADD UNIQUE KEY `id_procedures` (`id_procedures`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_days` (`id_days`),
  ADD UNIQUE KEY `id_cabinet` (`id_cabinet`),
  ADD UNIQUE KEY `id_employee` (`id_employee`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `analyzes`
--
ALTER TABLE `analyzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cabinet`
--
ALTER TABLE `cabinet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `classification_diagnosis`
--
ALTER TABLE `classification_diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `quarter`
--
ALTER TABLE `quarter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reception`
--
ALTER TABLE `reception`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);

--
-- Ограничения внешнего ключа таблицы `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_quarter`) REFERENCES `quarter` (`id`);

--
-- Ограничения внешнего ключа таблицы `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`id_medicines`) REFERENCES `medicines` (`id`),
  ADD CONSTRAINT `destination_ibfk_2` FOREIGN KEY (`id_reception`) REFERENCES `reception` (`id`);

--
-- Ограничения внешнего ключа таблицы `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`id_classification`) REFERENCES `classification_diagnosis` (`id`);

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`id_specialty`) REFERENCES `specialty` (`id`);

--
-- Ограничения внешнего ключа таблицы `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `address` (`id`);

--
-- Ограничения внешнего ключа таблицы `reception`
--
ALTER TABLE `reception`
  ADD CONSTRAINT `reception_ibfk_1` FOREIGN KEY (`id_diagnosis`) REFERENCES `diagnosis` (`id`),
  ADD CONSTRAINT `reception_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `reception_ibfk_3` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`);

--
-- Ограничения внешнего ключа таблицы `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`id_analyzes`) REFERENCES `analyzes` (`id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`id_procedures`) REFERENCES `procedures` (`id`),
  ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`id_reception`) REFERENCES `reception` (`id`);

--
-- Ограничения внешнего ключа таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`id_cabinet`) REFERENCES `cabinet` (`id`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`id_days`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:8889
-- Час створення: Трв 24 2022 р., 21:36
-- Версія сервера: 8.0.29
-- Версія PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `apteka_db`
--

-- --------------------------------------------------------

--
-- Структура таблиці `check`
--

CREATE TABLE `check` (
  `id_check` int NOT NULL,
  `order_price` int DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_iduser` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблиці `discount`
--

CREATE TABLE `discount` (
  `id_discount` int NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `discount`
--

INSERT INTO `discount` (`id_discount`, `value`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Структура таблиці `dose`
--

CREATE TABLE `dose` (
  `id_dose` int NOT NULL,
  `dose` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `dose`
--

INSERT INTO `dose` (`id_dose`, `dose`) VALUES
(1, '50'),
(2, '100'),
(3, '150'),
(4, '200'),
(5, '250'),
(6, '300'),
(7, '350'),
(8, '400'),
(9, '450'),
(10, '500');

-- --------------------------------------------------------

--
-- Структура таблиці `drug_info`
--

CREATE TABLE `drug_info` (
  `id_info` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `instruction` varchar(200) DEFAULT NULL,
  `group` varchar(45) NOT NULL,
  `giving` varchar(45) NOT NULL,
  `drug_manufacturer_id_drug_manufacturer` int NOT NULL,
  `dose_id_dose` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `drug_info`
--

INSERT INTO `drug_info` (`id_info`, `name`, `instruction`, `group`, `giving`, `drug_manufacturer_id_drug_manufacturer`, `dose_id_dose`) VALUES
(1, 'Левоміцетин', 'Левоміцетин (хлорамфенікол) – бактеріостатичний антибіотик широкого спектра дії. Дія пов’язана з порушенням процесу синтезу білка у мікробній клітині на стадії переносу амінокислот тРНК на рибосоми.', 'Антибіотики', 'без рецепту', 4, 5),
(2, 'Синтоміцин', 'блокатор циклооксигенази.', 'Антибіотики', 'без рецепту', 4, 10),
(3, 'Фурадонін', 'Нітрофурантоїн – протимікробний засіб групи нітрофурану, уроантисептик.', 'Антибіотики', 'без рецепту', 1, 2),
(4, 'Фурагін', 'Фурагін – нітрофурановий антибактеріальний засіб з бактеріостатичною дією.', 'Антибіотики', 'без рецепту', 2, 1),
(5, 'Цитрамон', 'Лікарський засіб чинить аналгезивну, жарознижувальну та протизапальну дію. Компоненти, що входять до складу лікарського засобу, посилюють ефекти один одного.', 'Знеболюючі', 'без рецепту', 4, 5),
(6, 'Анальгін', 'Похідна речовина піразолону, блокатор циклооксигенази.', 'Знеболюючі', 'без рецепту', 3, 10),
(7, 'Німесил', 'Німесулід – нестероїдний протизапальний засіб зі знеболювальною та жарознижувальною властивостями, котрий діє як інгібітор ферменту циклооксигенази, що відповідає за синтез простагландинів.', 'Знеболюючі', 'без рецепту', 4, 2),
(8, 'Парацетамол', 'Ненаркотичний аналгетик.', 'Знеболюючі', 'без рецепту', 4, 10);

-- --------------------------------------------------------

--
-- Структура таблиці `drug_manufacturer`
--

CREATE TABLE `drug_manufacturer` (
  `id_drug_manufacturer` int NOT NULL,
  `manufacturer` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `drug_manufacturer`
--

INSERT INTO `drug_manufacturer` (`id_drug_manufacturer`, `manufacturer`) VALUES
(1, 'Артеріум'),
(2, 'ІнтерХім'),
(3, 'Індар'),
(4, 'Дарниця');

-- --------------------------------------------------------

--
-- Структура таблиці `drug_sklad`
--

CREATE TABLE `drug_sklad` (
  `id_drug_sklad` int NOT NULL,
  `drug_count` int NOT NULL,
  `price` int NOT NULL,
  `in_date` date NOT NULL,
  `drug_info_id_info` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `drug_sklad`
--

INSERT INTO `drug_sklad` (`id_drug_sklad`, `drug_count`, `price`, `in_date`, `drug_info_id_info`) VALUES
(1, 11, 40, '2022-05-03', 1),
(2, 12, 35, '2022-05-03', 2),
(3, 2, 50, '2022-05-03', 3),
(4, 0, 52, '2022-04-25', 3),
(5, 34, 12, '2022-05-10', 5),
(6, 22, 12, '2022-05-10', 6),
(7, 12, 196, '2022-05-10', 7),
(8, 2, 23, '2022-04-25', 8);

-- --------------------------------------------------------

--
-- Структура таблиці `order`
--

CREATE TABLE `order` (
  `id_order` int NOT NULL,
  `order_count` int NOT NULL,
  `drug_sklad_id_drug_sklad` int NOT NULL,
  `drug_sklad_drug_info_id_info` int NOT NULL,
  `check_id_check` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `surname` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `number` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`iduser`, `surname`, `name`, `number`) VALUES
(1, 'Korabel', 'Yura', '+380986028827'),
(2, 'Hnativ', 'Vitalik', '+380986095524'),
(4, 'surname', 'ffff', '+380986028833');

-- --------------------------------------------------------

--
-- Структура таблиці `worker`
--

CREATE TABLE `worker` (
  `idworker` int NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `worker`
--

INSERT INTO `worker` (`idworker`, `login`, `password`, `surname`, `name`, `role`) VALUES
(1, 'admin', '1111', 'ADMIN', 'ADMIN', 1),
(2, 'korabel', '2222', 'Korabel', 'Yura', 0);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `check`
--
ALTER TABLE `check`
  ADD PRIMARY KEY (`id_check`),
  ADD KEY `fk_check_user1_idx` (`user_iduser`);

--
-- Індекси таблиці `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id_discount`);

--
-- Індекси таблиці `dose`
--
ALTER TABLE `dose`
  ADD PRIMARY KEY (`id_dose`);

--
-- Індекси таблиці `drug_info`
--
ALTER TABLE `drug_info`
  ADD PRIMARY KEY (`id_info`),
  ADD KEY `fk_drug_info_drug_manufacturer_idx` (`drug_manufacturer_id_drug_manufacturer`),
  ADD KEY `fk_drug_info_dose1_idx` (`dose_id_dose`);

--
-- Індекси таблиці `drug_manufacturer`
--
ALTER TABLE `drug_manufacturer`
  ADD PRIMARY KEY (`id_drug_manufacturer`);

--
-- Індекси таблиці `drug_sklad`
--
ALTER TABLE `drug_sklad`
  ADD PRIMARY KEY (`id_drug_sklad`,`drug_info_id_info`),
  ADD KEY `fk_drug_sklad_drug_info1_idx` (`drug_info_id_info`);

--
-- Індекси таблиці `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`,`drug_sklad_id_drug_sklad`,`drug_sklad_drug_info_id_info`,`check_id_check`),
  ADD KEY `fk_order_drug_sklad1_idx` (`drug_sklad_id_drug_sklad`,`drug_sklad_drug_info_id_info`),
  ADD KEY `fk_order_check1_idx` (`check_id_check`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- Індекси таблиці `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`idworker`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `check`
--
ALTER TABLE `check`
  MODIFY `id_check` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `discount`
--
ALTER TABLE `discount`
  MODIFY `id_discount` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `dose`
--
ALTER TABLE `dose`
  MODIFY `id_dose` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `drug_info`
--
ALTER TABLE `drug_info`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `drug_sklad`
--
ALTER TABLE `drug_sklad`
  MODIFY `id_drug_sklad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `worker`
--
ALTER TABLE `worker`
  MODIFY `idworker` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `check`
--
ALTER TABLE `check`
  ADD CONSTRAINT `fk_check_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);

--
-- Обмеження зовнішнього ключа таблиці `drug_info`
--
ALTER TABLE `drug_info`
  ADD CONSTRAINT `fk_drug_info_dose1` FOREIGN KEY (`dose_id_dose`) REFERENCES `dose` (`id_dose`),
  ADD CONSTRAINT `fk_drug_info_drug_manufacturer` FOREIGN KEY (`drug_manufacturer_id_drug_manufacturer`) REFERENCES `drug_manufacturer` (`id_drug_manufacturer`);

--
-- Обмеження зовнішнього ключа таблиці `drug_sklad`
--
ALTER TABLE `drug_sklad`
  ADD CONSTRAINT `fk_drug_sklad_drug_info1` FOREIGN KEY (`drug_info_id_info`) REFERENCES `drug_info` (`id_info`);

--
-- Обмеження зовнішнього ключа таблиці `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_check1` FOREIGN KEY (`check_id_check`) REFERENCES `check` (`id_check`),
  ADD CONSTRAINT `fk_order_drug_sklad1` FOREIGN KEY (`drug_sklad_id_drug_sklad`,`drug_sklad_drug_info_id_info`) REFERENCES `drug_sklad` (`id_drug_sklad`, `drug_info_id_info`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

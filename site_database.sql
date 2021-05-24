-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2021 alle 19:55
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site_database`
--

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `calcolaTotale` (IN `id_cliente` INTEGER)  BEGIN
select TRUNCATE(sum(g.prezzo),2) as tot
from cart c join games g on c.game=g.id_game 
where c.user_site=id_cliente;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `cart`
--

CREATE TABLE `cart` (
  `id_add` int(11) NOT NULL,
  `game` int(11) DEFAULT NULL,
  `user_site` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cart`
--

INSERT INTO `cart` (`id_add`, `game`, `user_site`) VALUES
(27, 15, 12),
(28, 11, 12),
(30, 13, 12),
(31, 15, 12),
(36, 3, 6),
(39, 7, 6),
(41, 3, 6),
(57, 7, 8),
(59, 10, 8),
(60, 11, 8),
(62, 13, 8),
(63, 14, 8),
(71, 21, 8),
(96, 1, 6),
(103, 14, 8),
(104, 11, 8),
(105, 4, 8),
(106, 2, 8),
(107, 15, 6),
(113, 8, 6),
(114, 4, 6),
(115, 3, 6),
(116, 21, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `games`
--

CREATE TABLE `games` (
  `id_game` int(11) NOT NULL,
  `name` varchar(255) UNIQUE,
  `main_image` varchar(255) NOT NULL,
  `realese_date` date DEFAULT NULL,
  `genre` varchar(255) NOT NULL,
  `esrb_rating` varchar(255) NOT NULL,
  `prezzo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `games`
--

INSERT INTO `games` (`id_game`, `name`, `main_image`, `realese_date`, `genre`, `esrb_rating`, `prezzo`) VALUES
(1, 'Cyberpunk 2077', 'img/test/cyberpunk.jpg', '2020-12-10', 'Adventure-Action-RPG', 'Adult Only', 39.99),
(2, 'Assassin\'s Creed Valhalla', 'https://media.rawg.io/media/games/a8b/a8bf6f31bfbdaf7d4b86c1953c62cee0.jpg', '2020-11-10', 'Adventure-Action-RPG', 'Mature', 49.95),
(3, 'Watch Dogs Legion', 'https://media.rawg.io/media/games/415/41563ce6cb061a210160687a4e5d39f6.jpg', '2020-10-29', 'Shooter-Adventure-Action', 'Mature', 55.99),
(4, 'Immortals: Fenyx Rising', 'https://media.rawg.io/media/games/cd9/cd90cbe0868a2a3bbde2a9c245cb32b0.jpg', '2020-12-03', 'Adventure-Action', 'Teen', 25.55),
(5, 'Marvel\'s Spider-Man: Miles Morales', 'https://media.rawg.io/media/games/048/048b46cdc66cbc7e235e1f359c2a77ec.jpg', '2020-11-12', 'Adventure-Action', 'Teen', 22.99),
(6, 'Tony Hawk\'s Pro Skater 1 + 2', 'https://media.rawg.io/media/games/088/0885c48293746aad6df30735f30d0836.jpg', '2020-09-04', 'Aracde-Sport', 'Teen', 14.99),
(7, 'Returnal', 'https://media.rawg.io/media/games/9ea/9ea75a5e0f437d7a982147014899e0ea.jpg', '2020-11-13', 'Action', 'Mature', 58.75),
(8, 'FIFA 21', 'https://media.rawg.io/media/games/df4/df415b18835f91a1b4db1da294996ee5.jpg', '2020-10-06', 'Simulation-Sport', 'Everyone', 46.59),
(10, 'Subnautica: Below Zero', 'https://media.rawg.io/media/games/b11/b114db08b8c14b560cfb087ebd89a138.jpg', '2021-05-14', 'Indie-Adventure', 'Everyone', 8.99),
(11, 'Hitman 3', 'https://media.rawg.io/media/games/126/126fbd5ceacddc6ad16fc96e50b1265b.jpg', '2021-01-20', 'Shooter-Action', 'Mature', 45.59),
(12, 'DiRT 5', 'https://media.rawg.io/media/games/9c7/9c7dd09596246993169b356d7c1facf0.jpg', '2020-11-06', 'Racing', 'Everyone', 34.55),
(13, 'Resident Evil: Village', 'https://media.rawg.io/media/games/6cc/6cc23249972a427f697a3d10eb57a820.jpg', '2021-05-06', 'Adventure-Action', 'Teen', 69.99),
(14, 'Crash Bandicoot 4: It’s About Time', 'https://media.rawg.io/media/games/54a/54a14917b3298bbaacdf9873c3af7229.jpg', '2020-10-01', 'Platform-Action', 'Everyone', 55.59),
(15, 'It Takes Two', 'https://media.rawg.io/media/games/d47/d479582ed0a46496ad34f65c7099d7e5.jpg', '2021-03-26', 'Platform-Indie-Action', 'Everyone', 38.49),
(16, 'Cyber Shadow', 'https://media.rawg.io/media/games/bee/bee2cf3815fe16391b15a77ac690679a.jpg', '2020-12-03', 'Adventure-RPG', 'Everyone', 12.59),
(17, 'Deathloop', 'https://media.rawg.io/media/games/018/01857c5ff9579c48fa8bd76b4d83a946.jpg', '2021-09-14', 'Action-RPG', 'Teen', 19.95),
(18, 'Kena: Bridge of Spirits', 'https://media.rawg.io/media/games/f39/f3971e0dfde68f234c56ae789433b219.jpg', '2021-08-24', 'Strategy-Shooter-Adventure-Action', 'Everyone', 44.65),
(19, 'Observer: System Redux', 'https://media.rawg.io/media/games/9ac/9acdbcf11b7aa2c9d629ee38f8fa8c71.jpg', '2020-11-10', 'Adventure', 'Everyone', 45.59),
(20, 'Dead Space 2', 'https://media.rawg.io/media/games/9d5/9d5aa70db8c16566d79712df6417d13a.jpg', '2011-01-25', 'Shooter-Action', 'Mature', 53.75),
(21, 'Monster Hunter Rise', 'img/test/monster.jpg', '2021-03-26', 'Action-RPG', 'Everyone', 65.59);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `gioco` int(11) NOT NULL,
  `editor` int(11) NOT NULL,
  `voto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`gioco`, `editor`, `voto`) VALUES
(1, 1, 9),
(1, 2, 8),
(1, 3, 9),
(1, 5, 9),
(2, 1, 10),
(2, 2, 9),
(2, 4, 9),
(3, 2, 8),
(4, 1, 7),
(4, 5, 6),
(5, 2, 10),
(6, 3, 9),
(6, 4, 10),
(6, 5, 9),
(7, 5, 8),
(8, 2, 7),
(8, 3, 8),
(10, 1, 9),
(11, 1, 7),
(12, 3, 7),
(13, 1, 7),
(13, 4, 7),
(14, 2, 8),
(14, 3, 8),
(15, 2, 8),
(15, 3, 8),
(16, 3, 8),
(17, 2, 6),
(18, 2, 8),
(18, 3, 8),
(19, 2, 10),
(19, 3, 7),
(20, 3, 8),
(21, 3, 9),
(21, 5, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensore`
--

CREATE TABLE `recensore` (
  `id_editore` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensore`
--

INSERT INTO `recensore` (`id_editore`, `nome`) VALUES
(1, 'Multiplayer'),
(2, 'SpazioGames'),
(3, 'Everyeye'),
(4, 'Gamesoul'),
(5, 'Gamemag');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar_image` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `avatar_image`, `surname`) VALUES
(6, 'savvo123@palagonia.it', '$2y$10$GD9Xh93B/p/w6hvEaKpbGeC1Y22d7kruvFniILrdjPhmNYXGDEnyO', 'Emilio', 'img/icons/av08.jpg', 'Interlandi'),
(8, 'gabriele@creatore.it', '$2y$10$RZh8k6oxTaMD1Fvyt7pA6OiOE0NvHlVCAjPcmuBmRc8sKCEYXVcRK', 'Gabriele', 'img/icons/av03.jpg', 'Sollami'),
(9, 'concetto@unict.it', '$2y$10$blTPYtVvMH.dJx3y8jv4SeYUk7SuQRczKaqPYMpWs9lShayxZI4e.', 'Concetto', 'img/icons/av04.jpg', 'Spampinato'),
(11, 'giovanni@traina.it', '$2y$10$D.CSH8jDzay2KQskOe1kzO34FXAYJSFKAOFrCI3xBG/1nkIqPPhIa', 'Giovanni', 'img/icons/av02.jpg', 'Traina'),
(12, 'paolo@dangelo.it', '$2y$10$4Z1.05wH5LypPZtFxMgFzOyhevqauNPaHSzjLeIiWb112zO0zxNqq', 'Paolo', 'img/icons/av11.jpg', 'D\'angelo');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_add`),
  ADD KEY `new_game` (`game`),
  ADD KEY `new_user` (`user_site`);

--
-- Indici per le tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`gioco`,`editor`),
  ADD KEY `new_gioco` (`gioco`),
  ADD KEY `new_ins` (`editor`);

--
-- Indici per le tabelle `recensore`
--
ALTER TABLE `recensore`
  ADD PRIMARY KEY (`id_editore`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cart`
--
ALTER TABLE `cart`
  MODIFY `id_add` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT per la tabella `games`
--
ALTER TABLE `games`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`game`) REFERENCES `games` (`id_game`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_site`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `recensione_ibfk_1` FOREIGN KEY (`gioco`) REFERENCES `games` (`id_game`),
  ADD CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`editor`) REFERENCES `recensore` (`id_editore`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

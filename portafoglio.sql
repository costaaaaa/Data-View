-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Mag 12, 2022 alle 08:45
-- Versione del server: 5.7.34
-- Versione PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portafoglio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `buy`
--

CREATE TABLE `buy` (
  `idBuy` int(11) NOT NULL,
  `simbolo` varchar(10) NOT NULL,
  `quote` int(11) NOT NULL,
  `prezzo` decimal(10,0) NOT NULL,
  `totale` decimal(10,0) NOT NULL,
  `dataTransazione` varchar(10) NOT NULL,
  `tipo` char(1) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `buy`
--

INSERT INTO `buy` (`idBuy`, `simbolo`, `quote`, `prezzo`, `totale`, `dataTransazione`, `tipo`, `email`) VALUES
(1, 'MSFT', 5, '270', '1348', '2022/05/11', 'A', 'costamagna551@gmail.com'),
(2, 'MSFT', 1, '270', '270', '2022/05/11', 'A', 'costamagna551@gmail.com'),
(3, 'MSFT', 9, '270', '2426', '2022/05/11', 'A', 'costamagna551@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `possedute`
--

CREATE TABLE `possedute` (
  `idPossedimento` int(11) NOT NULL,
  `simbolo` varchar(10) NOT NULL,
  `quote` int(11) NOT NULL,
  `prezzo_medio` decimal(10,0) NOT NULL,
  `totale` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `possedute`
--

INSERT INTO `possedute` (`idPossedimento`, `simbolo`, `quote`, `prezzo_medio`, `totale`, `email`) VALUES
(1, 'MSFT', 15, '270', 4050, 'costamagna551@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `psw` text NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `sesso` char(1) NOT NULL,
  `dataNascita` date DEFAULT NULL,
  `monetaVirtuale` int(11) NOT NULL DEFAULT '50000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `psw`, `nome`, `cognome`, `sesso`, `dataNascita`, `monetaVirtuale`) VALUES
(1, 'Costa', 'costamagna551@gmail.com', '$2y$10$/37rfVIo.zcWqKtiqSKtJOYJYnk6ifNqGqBNbGAXkhwX637Tu7CrW', 'Andrea', 'Costamagna', 'M', '2003-12-31', 45958);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idBuy`);

--
-- Indici per le tabelle `possedute`
--
ALTER TABLE `possedute`
  ADD PRIMARY KEY (`idPossedimento`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `buy`
--
ALTER TABLE `buy`
  MODIFY `idBuy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `possedute`
--
ALTER TABLE `possedute`
  MODIFY `idPossedimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

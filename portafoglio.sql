-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Mag 10, 2022 alle 15:08
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
  `prezzo_acquisto` decimal(10,0) NOT NULL,
  `dataAcquisto` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Costa', 'costamagna551@gmail.com', '$2y$10$/37rfVIo.zcWqKtiqSKtJOYJYnk6ifNqGqBNbGAXkhwX637Tu7CrW', 'Andrea', 'Costamagna', 'M', '2003-12-31', 50000);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idBuy`),
  ADD KEY `idUser` (`idUser`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

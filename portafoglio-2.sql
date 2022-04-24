-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Apr 24, 2022 alle 15:31
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
  `idEtf` int(11) NOT NULL,
  `quote` int(11) NOT NULL,
  `prezzo_acquisto` decimal(10,0) NOT NULL,
  `idPortafoglio` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `etf`
--

CREATE TABLE `etf` (
  `idEtf` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `simbolo` varchar(10) NOT NULL,
  `borsa` varchar(15) NOT NULL,
  `costi` decimal(10,0) NOT NULL,
  `data_lancio` date NOT NULL,
  `dimensione` int(11) NOT NULL,
  `valuta` varchar(5) NOT NULL,
  `KIID` text NOT NULL,
  `scheda_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `etf`
--

INSERT INTO `etf` (`idEtf`, `nome`, `simbolo`, `borsa`, `costi`, `data_lancio`, `dimensione`, `valuta`, `KIID`, `scheda_info`) VALUES
(1, 'Ishares glocalismi clean energy UCITS ETF', 'INRG.MI', 'Borsa italiana', '1', '2007-07-06', 0, 'EUR', 'https://www.justetf.com/servlet/download?isin=IE00B1XNHC34&documentType=KID&country=IT&lang=it', 'https://www.justetf.com/servlet/download?isin=IE00B1XNHC34&documentType=MR&country=IT&lang=it');

-- --------------------------------------------------------

--
-- Struttura della tabella `portafogli`
--

CREATE TABLE `portafogli` (
  `idPortafoglio` int(11) NOT NULL,
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
  `dataNascita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `psw`, `nome`, `cognome`, `sesso`, `dataNascita`) VALUES
(1, 'Costa', 'costamagna551@gmail.com', '$2y$10$/37rfVIo.zcWqKtiqSKtJOYJYnk6ifNqGqBNbGAXkhwX637Tu7CrW', 'Andrea', 'Costamagna', 'M', '2003-12-31');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idBuy`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idEtf` (`idEtf`,`idPortafoglio`),
  ADD KEY `idPortafoglio` (`idPortafoglio`);

--
-- Indici per le tabelle `etf`
--
ALTER TABLE `etf`
  ADD PRIMARY KEY (`idEtf`);

--
-- Indici per le tabelle `portafogli`
--
ALTER TABLE `portafogli`
  ADD PRIMARY KEY (`idPortafoglio`),
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
-- AUTO_INCREMENT per la tabella `etf`
--
ALTER TABLE `etf`
  MODIFY `idEtf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `portafogli`
--
ALTER TABLE `portafogli`
  MODIFY `idPortafoglio` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`idEtf`) REFERENCES `etf` (`idEtf`),
  ADD CONSTRAINT `buy_ibfk_2` FOREIGN KEY (`idPortafoglio`) REFERENCES `portafogli` (`idPortafoglio`),
  ADD CONSTRAINT `buy_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Limiti per la tabella `portafogli`
--
ALTER TABLE `portafogli`
  ADD CONSTRAINT `portafogli_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

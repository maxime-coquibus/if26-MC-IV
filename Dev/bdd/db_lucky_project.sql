-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 02 Décembre 2013 à 16:50
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `db_lucky_project`
--
CREATE DATABASE IF NOT EXISTS `db_lucky_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_lucky_project`;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id_game` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `score` int(8) NOT NULL,
  `notification` varchar(50) NOT NULL,
  PRIMARY KEY (`id_game`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(8) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

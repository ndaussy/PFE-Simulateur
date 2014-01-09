-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 09 Janvier 2014 à 19:21
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ql`
--
CREATE DATABASE IF NOT EXISTS `ql` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ql`;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('481ef61fc4c25e8fdc6a8df47b380c7c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', 1389206389, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:19:"ndaussy@hotmail.com";s:9:"logged_in";b:1;}'),
('969a0ba3b939d2809fdb80c7652e38a6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', 1389214276, ''),
('f1d0057f3cd308ff4f1446b5018021b3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', 1389211465, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(10, 'zae', '427a13a77c4f06555a569b6ef14d0dc1123582a2'),
(11, 'aze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae'),
(12, 'dzadza', '4eb5e5a647ef56e234b83cc3d137694b33d31954'),
(13, 'zaert', '50436e3d5d82b36cb4d199cd9582d125f9d17846'),
(84, 'titit', '90795a0ffaa8b88c0e250546d8439bc9c31e5a5e'),
(85, 'zaezae', 'dd0a71aa80c2ea75ea5b48fed0229d60a3fb270c'),
(86, 'ndaussy@hotmail.com', '2b15224059447b7a2b5fca811ce40301c35d4016'),
(89, 'daussy@ece.fr', '2b15224059447b7a2b5fca811ce40301c35d4016'),
(90, 'nico', '356a192b7913b04c54574d18c28d46e6395428ab');

-- --------------------------------------------------------

--
-- Structure de la table `usersimulation`
--

CREATE TABLE IF NOT EXISTS `usersimulation` (
  `name_simulation` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`name_simulation`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usersimulation`
--

INSERT INTO `usersimulation` (`name_simulation`, `username`, `date_add`) VALUES
('Identification Reussite', 'nico', '2013-11-20 14:50:17'),
('Nom_Simulation', 'ndaussy@hotmail.com', '2013-12-05 13:03:52'),
('Nom_Simulation', 'nico', '2013-11-28 18:19:50'),
('Nom_Simulation_2', 'ndaussy@hotmail.com', '2013-12-05 13:08:22'),
('Nom_Simulation_3', 'ndaussy@hotmail.com', '2013-12-05 13:09:22'),
('pfe-QL', 'nico', '2013-11-20 15:16:52'),
('Simulation', 'ndaussy@hotmail.com', '2013-12-04 23:49:41'),
('tata', 'unit_test', '2013-11-26 22:19:15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

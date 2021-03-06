-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 11 Février 2014 à 15:24
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

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

-- --------------------------------------------------------

--
-- Structure de la table `conf_simulateur`
--

CREATE TABLE IF NOT EXISTS `conf_simulateur` (
  `port_gga` bigint(20) NOT NULL DEFAULT '44100',
  `port_rmc` bigint(20) NOT NULL DEFAULT '44200',
  PRIMARY KEY (`port_gga`,`port_rmc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `csv`
--

CREATE TABLE IF NOT EXISTS `csv` (
  `Date` datetime NOT NULL,
  `Scumul` decimal(10,4) NOT NULL,
  `Actual Engine - Percent Torque` int(11) NOT NULL,
  `Engine Speed` int(11) NOT NULL,
  `Parking Brake Switch` int(11) NOT NULL,
  `Wheel-Based vehicule Speed` decimal(10,5) NOT NULL,
  `Brake Switch` int(11) NOT NULL,
  `Accelerator pedal position 1` decimal(12,6) NOT NULL,
  `Transmission Selected gear` int(11) NOT NULL,
  `Transmission Current Gear` int(11) NOT NULL,
  `Engine Coolant Temperature` int(11) NOT NULL,
  `Engine Fuel Temperature` int(11) NOT NULL,
  `Seconds` int(11) NOT NULL,
  `Minutes` int(11) NOT NULL,
  `Hours` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `Day` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Local minute offset` int(11) NOT NULL,
  `Local hour offset` int(11) NOT NULL,
  `High Resolution Total Vehicle Distance` int(11) NOT NULL,
  `Total Vehicle distance` decimal(32,16) NOT NULL,
  `Position of doors` int(11) NOT NULL,
  `Engine fuel rate` int(11) NOT NULL,
  `Engine Instantaneous fuel economy` int(11) NOT NULL,
  `Fuel Level` int(11) NOT NULL,
  `Engine Total Fuel Used` int(11) NOT NULL,
  `Compass Bearing` int(11) NOT NULL,
  `Navigation-Based Vehicule Speed` decimal(14,7) NOT NULL,
  `Altitude` decimal(16,8) NOT NULL,
  `Latitude` decimal(16,8) NOT NULL,
  `Longitude` decimal(16,8) NOT NULL,
  `name_simulation` varchar(255) NOT NULL,
  PRIMARY KEY (`Scumul`,`name_simulation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table d''enregistrement des csv';

-- --------------------------------------------------------

--
-- Structure de la table `kml`
--

CREATE TABLE IF NOT EXISTS `kml` (
  `name_simulation` varchar(100) NOT NULL,
  `arret` varchar(100) NOT NULL,
  `longitude` decimal(20,10) NOT NULL,
  `latitude` decimal(20,10) NOT NULL,
  `ligne` varchar(100) NOT NULL,
  PRIMARY KEY (`name_simulation`,`arret`,`longitude`,`latitude`,`ligne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lignes`
--

CREATE TABLE IF NOT EXISTS `lignes` (
  `name_simulation` varchar(255) NOT NULL,
  `Scumul` decimal(10,4) NOT NULL,
  `Longitude` decimal(16,8) DEFAULT NULL,
  `Latitude` decimal(16,8) DEFAULT NULL,
  `Arret` varchar(255) NOT NULL,
  PRIMARY KEY (`name_simulation`,`Scumul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `txt`
--

CREATE TABLE IF NOT EXISTS `txt` (
  `name_simulation` varchar(255) NOT NULL,
  `time` decimal(10,4) NOT NULL,
  `id` varchar(4) NOT NULL,
  `frame` varchar(30) NOT NULL,
  PRIMARY KEY (`name_simulation`,`time`,`id`,`frame`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Structure de la table `usersimulation`
--

CREATE TABLE IF NOT EXISTS `usersimulation` (
  `name_simulation` varchar(255) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state_csv` varchar(100) NOT NULL,
  `state_txt` varchar(100) NOT NULL,
  PRIMARY KEY (`name_simulation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Adminer 4.8.1 MySQL 10.11.6-MariaDB-0+deb12u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `EduCaps`;
CREATE DATABASE `EduCaps` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `EduCaps`;

DROP TABLE IF EXISTS `Documents`;
CREATE TABLE `Documents` (
  `idDoc` int(11) NOT NULL AUTO_INCREMENT,
  `idForm` int(11) DEFAULT NULL,
  `nomDoc` varchar(500) DEFAULT NULL,
  `cheminDoc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idDoc`),
  KEY `idForm` (`idForm`),
  CONSTRAINT `Documents_ibfk_1` FOREIGN KEY (`idForm`) REFERENCES `Formulaire` (`idForm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Formulaire`;
CREATE TABLE `Formulaire` (
  `idForm` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `descForm` varchar(1000) DEFAULT NULL,
  `idTheme` int(11) DEFAULT NULL,
  PRIMARY KEY (`idForm`),
  KEY `idUser` (`idUser`),
  KEY `idTheme` (`idTheme`),
  CONSTRAINT `Formulaire_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Users` (`idUser`),
  CONSTRAINT `Formulaire_ibfk_2` FOREIGN KEY (`idTheme`) REFERENCES `Themes` (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Posseder`;
CREATE TABLE `Posseder` (
  `idTheme` int(11) NOT NULL,
  `idVid` int(11) NOT NULL,
  PRIMARY KEY (`idTheme`,`idVid`),
  KEY `idVid` (`idVid`),
  CONSTRAINT `Posseder_ibfk_1` FOREIGN KEY (`idTheme`) REFERENCES `Themes` (`idTheme`),
  CONSTRAINT `Posseder_ibfk_2` FOREIGN KEY (`idVid`) REFERENCES `Video` (`idVid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Posseder` (`idTheme`, `idVid`) VALUES
(1,	1),
(1,	5),
(2,	11),
(3,	1),
(4,	5);

DROP TABLE IF EXISTS `Qualifier`;
CREATE TABLE `Qualifier` (
  `idUser` int(11) NOT NULL,
  `idTheme` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idTheme`),
  KEY `idTheme` (`idTheme`),
  CONSTRAINT `Qualifier_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Users` (`idUser`),
  CONSTRAINT `Qualifier_ibfk_2` FOREIGN KEY (`idTheme`) REFERENCES `Themes` (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Qualifier` (`idUser`, `idTheme`) VALUES
(1,	1),
(1,	2),
(1,	3),
(1,	4),
(1,	5),
(1,	6),
(1,	7),
(1,	8),
(9,	3),
(13,	1),
(13,	2),
(13,	3),
(13,	4),
(13,	8);

DROP TABLE IF EXISTS `Themes`;
CREATE TABLE `Themes` (
  `idTheme` int(11) NOT NULL AUTO_INCREMENT,
  `nomTheme` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Themes` (`idTheme`, `nomTheme`) VALUES
(1,	'Informatique'),
(2,	'Maths'),
(3,	'Francais'),
(4,	'Histoire'),
(5,	'Geographie'),
(6,	'Physique'),
(7,	'Chimie'),
(8,	'Agriculture');

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `typeU` varchar(25) DEFAULT NULL,
  `pseudoU` varchar(20) DEFAULT NULL,
  `mdpU` varchar(30) DEFAULT NULL,
  `mailU` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Users` (`idUser`, `typeU`, `pseudoU`, `mdpU`, `mailU`) VALUES
(1,	'admin',	'admin0',	'Isanum64!',	NULL),
(9,	'prof',	'test',	'test0',	'test'),
(13,	'prof',	'test2',	'test2',	'yyt646794@gmail.com'),
(14,	'etudiant',	'salutmathis',	'baisetesmorts',	'constant@bg.com'),
(15,	'etudiant',	'Lichar',	'isanum64',	'mail@exemple.com');

DROP TABLE IF EXISTS `Video`;
CREATE TABLE `Video` (
  `idVid` int(11) NOT NULL AUTO_INCREMENT,
  `titreVid` varchar(30) DEFAULT NULL,
  `descVid` varchar(500) DEFAULT NULL,
  `cheminVid` varchar(200) DEFAULT NULL,
  `cheminMinia` varchar(200) DEFAULT NULL,
  `auteurVid` int(11) DEFAULT NULL,
  `datePubli` date DEFAULT NULL,
  PRIMARY KEY (`idVid`),
  KEY `auteurVid` (`auteurVid`),
  CONSTRAINT `Video_ibfk_1` FOREIGN KEY (`auteurVid`) REFERENCES `Users` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Video` (`idVid`, `titreVid`, `descVid`, `cheminVid`, `cheminMinia`, `auteurVid`, `datePubli`) VALUES
(1,	'Oiseau',	'Dans un monde où la technologie évolue à un rythme effréné, il est crucial de maintenir un équilibre entre innovation et préservation de l\'environnement. Les avancées en intelligence artificielle, énergies renouvelables et exploration spatiale façonnent l\'avenir, mais elles posent également des défis éthiques et sociaux. Collaborer pour créer des solutions durables et inclusives est une priorité essentielle. Ensemble, nous pouvons bâtir un avenir harmonieux et responsable.',	'./../Video/video/oiseau.mp4',	'./../Video/minia/oiseau.webp',	1,	'2024-12-18'),
(5,	'Feu',	'UNe vidéo en lien avec l\'Histoire',	'./../Video/video/feu.mp4',	'./../Video/minia/feu.webp',	1,	'2024-12-22'),
(11,	'Montagne',	'video de maths',	'./../Video/video/1736338690montagne.mp4',	'./../Video/minia/1736338690montagne.webp',	13,	'2025-01-08');

-- 2025-01-08 12:28:56

-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Admin`;
CREATE TABLE `Admin` (
  `Username` varchar(30) NOT NULL,
  `Password` char(32) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Station`;
CREATE TABLE `Station` (
  `Station_ID` int(11) NOT NULL,
  `Station_Name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Station_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Train`;
CREATE TABLE `Train` (
  `Train_ID` int(11) NOT NULL,
  `Train_name` varchar(50) NOT NULL,
  `Train_type` enum('Superfast','Express') NOT NULL,
  `Source_stn` varchar(50) NOT NULL,
  `Destination_stn` varchar(50) NOT NULL,
  `Source_ID` int(11) NOT NULL,
  `Destination_ID` int(11) NOT NULL,
  PRIMARY KEY (`Train_ID`),
  UNIQUE KEY `Train_name` (`Train_name`),
  KEY `Source_ID` (`Source_ID`),
  KEY `Destination_ID` (`Destination_ID`),
  CONSTRAINT `Train_ibfk_1` FOREIGN KEY (`Source_ID`) REFERENCES `Station` (`Station_ID`),
  CONSTRAINT `Train_ibfk_2` FOREIGN KEY (`Destination_ID`) REFERENCES `Station` (`Station_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `EmailID` varchar(30) NOT NULL,
  `Password` char(32) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Gender` enum('male','female') NOT NULL,
  `Mobile` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-11-09 09:30:54

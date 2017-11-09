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

INSERT INTO `Admin` (`Username`, `Password`) VALUES
('admin',	'e10adc3949ba59abbe56e057f20f883e');

DROP TABLE IF EXISTS `Station`;
CREATE TABLE `Station` (
  `Station_Code` char(3) NOT NULL,
  `Station_Name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Station_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Train`;
CREATE TABLE `Train` (
  `Train_ID` int(11) NOT NULL,
  `Train_name` varchar(50) NOT NULL,
  `Train_type` enum('Superfast','Express') NOT NULL,
  `Source_stn` varchar(50) NOT NULL,
  `Destination_stn` varchar(50) NOT NULL,
  `Source_Code` char(3) NOT NULL,
  `Destination_Code` char(3) NOT NULL,
  PRIMARY KEY (`Train_ID`),
  UNIQUE KEY `Train_name` (`Train_name`),
  KEY `Source_Code` (`Source_Code`),
  KEY `Destination_Code` (`Destination_Code`),
  CONSTRAINT `Train_ibfk_1` FOREIGN KEY (`Source_Code`) REFERENCES `Station` (`Station_Code`),
  CONSTRAINT `Train_ibfk_2` FOREIGN KEY (`Destination_Code`) REFERENCES `Station` (`Station_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `EmailID` varchar(30) NOT NULL,
  `Password` char(32) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Gender` enum('male','female') NOT NULL,
  `Mobile` char(10) NOT NULL,
  PRIMARY KEY (`EmailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `User` (`EmailID`, `Password`, `Name`, `Gender`, `Mobile`) VALUES
('ajay@dmm.com',	'25d55ad283aa400af464c76d713c07ad',	'Ajay K',	'male',	'9656214051'),
('ajay@dmm.in',	'fcbd9c10cf8c8763b952116af84795d3',	'Ajay KT',	'female',	'9656214051'),
('ajaypt@gmail.com',	'25d55ad283aa400af464c76d713c07ad',	'Ajay T Sivaprasad',	'male',	'9898989898'),
('anu.asok701@gmail.com',	'25d55ad283aa400af464c76d713c07ad',	'Anupam Asok',	'male',	'9447888520'),
('jacob@gmail.com',	'b1970a763752942773dcc9ab9fde0f9f',	'Jacob Roy',	'male',	'1212121212');

-- 2017-11-09 13:47:31

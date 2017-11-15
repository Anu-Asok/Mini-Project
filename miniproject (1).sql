-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `addStatus`;;
CREATE PROCEDURE `addStatus`(in d date, in trainid int, in available int)
begin
    if dayofweek(d) in (select Dayofweek from Days_available where Train_ID=trainid) then
      insert into Train_status values(trainid,d,available,0);
    else
      call raise_error;
    end if;
   end;;

DELIMITER ;

DROP TABLE IF EXISTS `Admin`;
CREATE TABLE `Admin` (
  `Username` varchar(30) NOT NULL,
  `Password` char(32) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Admin` (`Username`, `Password`) VALUES
('admin',	'e10adc3949ba59abbe56e057f20f883e');

DROP TABLE IF EXISTS `Days_available`;
CREATE TABLE `Days_available` (
  `Train_ID` int(11) NOT NULL,
  `Dayofweek` enum('1','2','3','4','5','6','7') NOT NULL,
  PRIMARY KEY (`Train_ID`,`Dayofweek`),
  CONSTRAINT `Days_available_ibfk_1` FOREIGN KEY (`Train_ID`) REFERENCES `Train` (`Train_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Days_available` (`Train_ID`, `Dayofweek`) VALUES
(16306,	'1'),
(16306,	'3'),
(16306,	'4');

DROP TABLE IF EXISTS `Passenger`;
CREATE TABLE `Passenger` (
  `PNR` int(11) NOT NULL AUTO_INCREMENT,
  `Seat_no` int(11) NOT NULL,
  `Passenger_name` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` enum('male','female') NOT NULL,
  `Train_ID` int(11) NOT NULL,
  `Booked_By` varchar(30) NOT NULL,
  PRIMARY KEY (`PNR`),
  KEY `Train_ID` (`Train_ID`),
  KEY `Booked_By` (`Booked_By`),
  CONSTRAINT `Passenger_ibfk_1` FOREIGN KEY (`Train_ID`) REFERENCES `Train` (`Train_ID`),
  CONSTRAINT `Passenger_ibfk_2` FOREIGN KEY (`Booked_By`) REFERENCES `User` (`EmailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Passenger` (`PNR`, `Seat_no`, `Passenger_name`, `Age`, `Gender`, `Train_ID`, `Booked_By`) VALUES
(1,	1,	'jacob',	20,	'male',	16301,	'jacob@gmail.com');

DROP TABLE IF EXISTS `Route`;
CREATE TABLE `Route` (
  `Train_ID` int(11) NOT NULL,
  `Station_Code` varchar(6) NOT NULL,
  `Stop_number` int(11) NOT NULL,
  `Arrival_time` varchar(5) NOT NULL,
  `Departure_time` varchar(5) NOT NULL,
  `Source_distance` decimal(10,0) NOT NULL,
  KEY `Station_Code` (`Station_Code`),
  CONSTRAINT `Route_ibfk_1` FOREIGN KEY (`Station_Code`) REFERENCES `Station` (`Station_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Station`;
CREATE TABLE `Station` (
  `Station_Code` varchar(6) NOT NULL,
  `Station_Name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Station_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Station` (`Station_Code`, `Station_Name`) VALUES
('ALLP',	'Alappuzha'),
('CAN',	'Kannur'),
('ERS',	'Ernakulam Junction'),
('MNG',	'Mangalore'),
('SHR',	'Shornur'),
('TVM',	'Trivandrum');

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `test` (`id`) VALUES
(1),
(1),
(1),
(1),
(1),
(1),
(0),
(0),
(0),
(0);

DROP TABLE IF EXISTS `Train`;
CREATE TABLE `Train` (
  `Train_ID` int(11) NOT NULL,
  `Train_name` varchar(50) NOT NULL,
  `Train_type` enum('Superfast','Express') NOT NULL,
  `Source_Code` varchar(6) NOT NULL,
  `Destination_Code` varchar(6) NOT NULL,
  PRIMARY KEY (`Train_ID`),
  KEY `Source_Code` (`Source_Code`),
  KEY `Destination_Code` (`Destination_Code`),
  CONSTRAINT `Train_ibfk_1` FOREIGN KEY (`Source_Code`) REFERENCES `Station` (`Station_Code`),
  CONSTRAINT `Train_ibfk_3` FOREIGN KEY (`Destination_Code`) REFERENCES `Station` (`Station_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Train` (`Train_ID`, `Train_name`, `Train_type`, `Source_Code`, `Destination_Code`) VALUES
(16301,	'Venad Express',	'Express',	'SHR',	'TVM'),
(16302,	'Venad Express',	'Express',	'TVM',	'SHR'),
(16306,	'Executive Express',	'Express',	'ERS',	'CAN'),
(16307,	'Alappuzha Kannur Express',	'Express',	'ALLP',	'CAN'),
(16630,	'Malabar express',	'Express',	'MNG',	'TVM');

DROP TABLE IF EXISTS `Train_status`;
CREATE TABLE `Train_status` (
  `Train_ID` int(11) NOT NULL,
  `Available_Date` date NOT NULL,
  `Available_Seats` int(11) NOT NULL,
  `Booked_Seats` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Train_ID`,`Available_Date`),
  CONSTRAINT `Train_status_ibfk_1` FOREIGN KEY (`Train_ID`) REFERENCES `Train` (`Train_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Train_status` (`Train_ID`, `Available_Date`, `Available_Seats`, `Booked_Seats`) VALUES
(16306,	'2017-11-09',	34,	12),
(16306,	'2017-11-10',	34,	0),
(16306,	'2017-11-12',	56,	0),
(16306,	'2017-11-22',	56,	0),
(16306,	'2017-11-29',	58,	0),
(16306,	'2017-12-06',	23,	32);

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
('jacob@gmail.com',	'b1970a763752942773dcc9ab9fde0f9f',	'Jacob Roy',	'male',	'1212121212'),
('jlku@gmail.com',	'5f4dcc3b5aa765d61d8327deb882cf99',	'JLK',	'male',	'9495949594'),
('megha@gmail.com',	'25d55ad283aa400af464c76d713c07ad',	'Megha',	'female',	'9495473743');

-- 2017-11-15 16:44:33

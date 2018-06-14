-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: akaiotagamma.org.mysql:3306
-- Generation Time: Jun 14, 2018 at 11:04 PM
-- Server version: 10.1.30-MariaDB-1~xenial
-- PHP Version: 5.4.45-0+deb7u13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `akaiotagamma_org`
--
DROP DATABASE `akaiotagamma_org`;
CREATE DATABASE `akaiotagamma_org` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `akaiotagamma_org`;

-- --------------------------------------------------------

--
-- Table structure for table `AccountPermission`
--
-- Creation: Mar 03, 2018 at 08:22 PM
--

DROP TABLE IF EXISTS `AccountPermission`;
CREATE TABLE IF NOT EXISTS `AccountPermission` (
  `Id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `pk_AccountPermission` (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `AccountPermission`
--

INSERT INTO `AccountPermission` (`Id`, `Name`, `Description`) VALUES
(1, 'Admin', 'The user can edit all profiles and has access to the ACL.'),
(2, 'Regular', 'The user can only edit their own profile.'),
(3, 'Disable', 'The user cannot access the directory.'),
(4, 'IBTW', 'The user is disabled and deceased.');

-- --------------------------------------------------------

--
-- Table structure for table `DegreeType`
--
-- Creation: Mar 16, 2018 at 09:25 PM
--

DROP TABLE IF EXISTS `DegreeType`;
CREATE TABLE IF NOT EXISTS `DegreeType` (
  `Id` smallint(6) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Abbreviation` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `pk_DegreeType` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DegreeType`
--

INSERT INTO `DegreeType` (`Id`, `Name`, `Abbreviation`) VALUES
(0, 'Bachelor of Arts', 'BA'),
(1, 'Bachelor of Science', 'BS'),
(2, 'Master of Fine Arts', 'MFA');

-- --------------------------------------------------------

--
-- Table structure for table `FamilyType`
--
-- Creation: Mar 03, 2018 at 08:22 PM
--

DROP TABLE IF EXISTS `FamilyType`;
CREATE TABLE IF NOT EXISTS `FamilyType` (
  `Id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `pk_FamilyType` (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `FamilyType`
--

INSERT INTO `FamilyType` (`Id`, `Name`, `Description`) VALUES
(1, 'Child', 'as in Child-Parent relationship'),
(2, 'Honey-Do', 'Husband or Significant Other');

-- --------------------------------------------------------

--
-- Table structure for table `UserAccount`
--
-- Creation: Apr 17, 2018 at 01:09 AM
--

DROP TABLE IF EXISTS `UserAccount`;
CREATE TABLE IF NOT EXISTS `UserAccount` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `MemberId` char(10) DEFAULT NULL,
  `AccountPermission_Id` tinyint(4) DEFAULT NULL,
  `Password` varchar(200) NOT NULL,
  `Salt` varchar(50) DEFAULT NULL,
  `HashLength` smallint(6) DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `pk_UserAccount` (`Id`),
  UNIQUE KEY `unique_Hash` (`Salt`,`HashLength`),
  UNIQUE KEY `MemberId` (`MemberId`),
  KEY `AccountPermission_fk_UserAccount` (`AccountPermission_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `UserAccount`
--

INSERT INTO `UserAccount` (`Id`, `MemberId`, `AccountPermission_Id`, `Password`, `Salt`, `HashLength`) VALUES
(22, '1976SP01CS', 3, '5647233521405977f7ede65d3a9d15cc0d72fbd338e5adc8732807cb74043f45', '146', NULL),
(23, '1974SL02MC', 4, '91a60c95c073a4a91a93de6e0b18ec98f693275a2962bff73f093f9ffaa86461', '233', NULL),
(24, '1975SE02VT', 2, '0721ac4f8e2cc7e9d60361c377e0717300964d4638f9eccad1cc87d8ab5f4f6a', '373', NULL),
(25, '1974SL03DG', 2, 'f0de1adf77dc28900bcec385f2566d20a1620483bd5f76eea37cf1d3d6de7040', '209', NULL),
(26, '1975SE03SK', 2, '8b60cf19ae8907f6d94d9fdd6620a8008f0aec2afeaf057e589f4673e1d08048', '179', NULL),
(27, '1976SP03IH', 2, 'b3a909067dc4b27c410d07cd3fb24bc51be36ef673b2c817effaa4c92eb58634', '264', NULL),
(28, '1974SL04AB', 1, 'dd32b2027d83606dca2914c5291e49650e996a82306c05387916879b325772ee', '334', NULL),
(29, '1975SE04DL', 2, '1ac0384530fdf09ba120bb6b218a4a26b7d709f081dc9399a63f27946ee6aa8b', '430', NULL),
(30, '1976SP04DW', 2, '18220a8e14e07af8bcb972a5c3e247707cc3bb74ff27322120a0a703aae2702c', '249', NULL),
(31, '1974SL05PB', 1, 'b3de17d6ecf39670b78c6196aaaba7c285a1754ef3d3ae6d1f8a0b24f1b0d6f7', '403', NULL),
(32, '1975SE05MS', 2, '1ab38879b45fbb869de6808b6b8369e8ceec6ccb033fea7feb343fcf2327c821', '369', NULL),
(33, '1974SL06YB', 1, 'a182edd5dc04fa5c54188f4f5a9a470269ee924bce329186084a3bd565b9bf98', '188', NULL),
(34, '1976SP06DB', 2, '6afd2b10ea5fd6ff88047f1d61276250cbd4e5200175da4c7340845e1bead2b9', '281', NULL),
(35, '1974SL07MS', 2, '3af13b607abd1dad033b196f08370c6032bfb82a852d906ec18b466223d15d3d', '392', NULL),
(36, '1974SL08DJ', 2, '3fd7e590bbbddfc40689c54f792bd5a3e3b8acc30a36c519d4c3f796d7524a30', '216', NULL),
(37, '1974SL09DM', 2, 'e392343ba5e12742f214a63941edc12e047bae3eba645b2dc5c9ae69bb8a2988', '354', NULL),
(38, '1974SL10GR', 3, 'bd134d4538c3d775b752b1a870ba8418ec4dc44ab2e4ad32d790936a8704ce71', '225', NULL),
(43, '1974SL01PF', 1, '6e0e3eddfa9af449d328a8928f7fd5becd08c82c63556de9feb002c9838d7c8c', '334', NULL),
(46, '1974SL1LS', 1, '2685ce048e9189f707d39dc560084fd5d6142142a7f61f38323f6fa65ed833c8', '355', NULL),
(62, '2018SS1SA', 1, '42775a2fa182b52f69886f48fc7a7ce020d6869cb9c4e5e72ea6c963b09d5587', '444', NULL),
(65, '1985SS01SW', 1, '74c5f5774146e05a0f0966c2a4eb9da1241df5052456bb0393f0c1048b5df51d', '23', NULL),
(67, '1985SS04IH', 2, '7c719aa67bd526511f9d4bae3ad38f362b8404e77461d767cd3c4983c84b49c5', '263', NULL),
(69, '1982SP05LC', 2, '2ca0dc6d59b66346f1bbf2298cd07f64664c1119c36ac4784f259b1f441d1fc7', '100', NULL),
(71, '1974FB05CD', 1, '12b41eb7447a9682411270233c481422b1685f1c945a08e4dcb332dd232ee514', '300', NULL),
(73, '1985SS02KH', 2, '6d13b0543b2d620bd56c45143bf7feea60969c7bc3e472d89aefa875c0e9aa56', '400', NULL);

--
-- Triggers `UserAccount`
--
DROP TRIGGER IF EXISTS `beforeInsert_UserAccount`;
DELIMITER //
CREATE TRIGGER `beforeInsert_UserAccount` BEFORE INSERT ON `UserAccount`
 FOR EACH ROW BEGIN
            SET NEW.Salt =  cast((FLOOR(RAND()*((9*50)-1)+1)) as char);
            SET NEW.HashLength = DEFAULT;

        SET NEW.Password = SHA2(concat(NEW.Password,NEW.Salt),NEW.HashLength);
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `beforeUpdate_UserAccount`;
DELIMITER //
CREATE TRIGGER `beforeUpdate_UserAccount` BEFORE UPDATE ON `UserAccount`
 FOR EACH ROW BEGIN
     IF NEW.Password != OLD.Password THEN
            SET NEW.Salt =  cast((FLOOR(RAND()*((9*50)-1)+1)) as char);
            SET NEW.HashLength = DEFAULT;

        SET NEW.Password = SHA2(concat(NEW.Password,NEW.Salt),NEW.HashLength);
     END IF;
        
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `UserDegree`
--
-- Creation: Mar 16, 2018 at 09:26 PM
--

DROP TABLE IF EXISTS `UserDegree`;
CREATE TABLE IF NOT EXISTS `UserDegree` (
  `MemberId` char(10) NOT NULL,
  `DegreeType_Id` smallint(6) NOT NULL,
  `Major` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`MemberId`,`DegreeType_Id`),
  UNIQUE KEY `pk_UserDegree` (`MemberId`,`DegreeType_Id`),
  KEY `UserDegree_fk_DegreeType` (`DegreeType_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserDegree`
--

INSERT INTO `UserDegree` (`MemberId`, `DegreeType_Id`, `Major`) VALUES
('1974FB05CD', 0, 'Journalism'),
('1974SL08DJ', 0, 'Music'),
('1974SL1LS', 1, 'Biochemistry'),
('1985SS04IH', 1, 'Electrical enginering');

-- --------------------------------------------------------

--
-- Table structure for table `UserFamily`
--
-- Creation: Apr 16, 2018 at 02:58 AM
--

DROP TABLE IF EXISTS `UserFamily`;
CREATE TABLE IF NOT EXISTS `UserFamily` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MemberId` char(10) DEFAULT NULL,
  `FamilyType_Id` smallint(6) DEFAULT NULL,
  `FirstName` varchar(25) DEFAULT NULL,
  `MiddleName` varchar(25) DEFAULT NULL,
  `LastName` varchar(25) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `pk_UserFamily` (`Id`),
  UNIQUE KEY `MemberId` (`MemberId`,`FamilyType_Id`,`FirstName`),
  KEY `FamilyType_fk_UserFamily` (`FamilyType_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `UserFamily`
--

INSERT INTO `UserFamily` (`Id`, `MemberId`, `FamilyType_Id`, `FirstName`, `MiddleName`, `LastName`, `Gender`) VALUES
(1, '1974SL02MC', 1, 'Ife', NULL, NULL, NULL),
(2, '1974SL02MC', 1, 'Lauren', NULL, NULL, 'Female'),
(3, '1974SL03DG', 2, 'Samuel', NULL, NULL, 'Male'),
(4, '1974SL03DG', 2, 'James', NULL, NULL, 'GenderQuee'),
(5, '1974SL04AB', 2, 'Daniel', NULL, NULL, 'Male'),
(6, '1974SL04AB', 1, 'Shelley', NULL, NULL, 'Female'),
(7, '1974SL04AB', 1, 'SororSusan', NULL, NULL, NULL),
(8, '1974SL05PB', 1, 'Keith', NULL, NULL, 'Male'),
(9, '1974SL09DM', 1, 'Jordan', NULL, NULL, 'Male'),
(10, '1974SL09DM', 1, 'Ghingi', NULL, NULL, NULL),
(11, '1974SL09DM', 1, 'Kala', NULL, NULL, 'Female'),
(13, '1975SE04DL', 2, 'Andrew', NULL, NULL, 'Male'),
(14, '1975SE04DL', 1, 'Jose', NULL, NULL, 'Male'),
(15, '1976SP01CS', 2, 'Irving', NULL, NULL, 'Male'),
(16, '1976SP01CS', 1, 'Jason', NULL, NULL, 'Male'),
(17, '1976SP04DW', 2, 'Travis', NULL, NULL, 'Male'),
(18, '1976SP06DB', 2, 'Preston', NULL, NULL, 'Male'),
(24, '1974SL1LS', 1, 'Kind', NULL, 'Sanchez', 'Male'),
(48, '1974SL1LS', 1, 'Natalia', NULL, NULL, 'Female'),
(50, '1974SL1LS', 2, 'Isaac', NULL, NULL, NULL),
(54, '1985SS04IH', 1, 'Isaiah', NULL, NULL, 'male'),
(56, '1974SL08DJ', 2, 'Ingrid', NULL, NULL, NULL),
(58, '1985SS04IH', 1, 'Indi', NULL, NULL, 'f'),
(60, '1974FB05CD', 2, 'Walter', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserLine`
--
-- Creation: Mar 10, 2018 at 11:56 PM
--

DROP TABLE IF EXISTS `UserLine`;
CREATE TABLE IF NOT EXISTS `UserLine` (
  `Id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Semester` varchar(10) NOT NULL,
  `InitiationYear` year(4) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `pk_UserLine` (`Id`),
  UNIQUE KEY `unique_YearSemester` (`Semester`,`InitiationYear`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `UserLine`
--

INSERT INTO `UserLine` (`Id`, `Name`, `Semester`, `InitiationYear`) VALUES
(1, 'Line Jewels', 'Spring', 1974),
(2, 'Eight Shades of Jade', 'Spring', 1975),
(3, 'Pink Ladies and Crème De Menth', 'Spring', 1976),
(22, 'Ubiquity', 'Spring', 1981),
(26, 'Sample', 'Spring', 2018),
(28, 'Synergist', 'Spring', 1985),
(33, 'Pink Radiance', 'Spring', 1982),
(35, 'Black Jewels', 'Fall', 1974);

-- --------------------------------------------------------

--
-- Table structure for table `UserProfile`
--
-- Creation: Apr 15, 2018 at 05:30 PM
--

DROP TABLE IF EXISTS `UserProfile`;
CREATE TABLE IF NOT EXISTS `UserProfile` (
  `MemberId` char(10) NOT NULL DEFAULT '0000000000',
  `UserLine_Id` smallint(6) NOT NULL,
  `LinePosition` char(2) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `MiddleName` varchar(25) DEFAULT NULL,
  `LastName` varchar(25) DEFAULT NULL,
  `LastNamePledge` varchar(25) NOT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` char(2) DEFAULT NULL,
  `Zipcode` char(10) DEFAULT NULL,
  `PhonePrimary` char(15) DEFAULT NULL,
  `PhoneSecondary` char(15) DEFAULT NULL,
  `Birthday` date DEFAULT '1900-01-01',
  `DateofDeath` date DEFAULT NULL,
  `DateofDeathNot` date DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `WorkName` varchar(50) DEFAULT NULL,
  `WorkPosition` varchar(50) DEFAULT NULL,
  `WorkStreet` varchar(50) DEFAULT NULL,
  `WorkCity` varchar(50) DEFAULT NULL,
  `WorkState` char(2) DEFAULT NULL,
  `WorkZipcode` char(10) DEFAULT NULL,
  `WorkPhone` char(15) DEFAULT NULL,
  `MailingStreet` varchar(50) DEFAULT NULL,
  `MailingState` varchar(50) DEFAULT NULL,
  `MailingCity` varchar(50) DEFAULT NULL,
  `MailingZipcode` char(10) DEFAULT NULL,
  `CurrentChapter` varchar(50) DEFAULT NULL,
  `EmergencyName` varchar(50) DEFAULT NULL,
  `EmergencyRelation` varchar(25) DEFAULT NULL,
  `EmergencyPhone` char(15) DEFAULT NULL,
  `EmergencyEmail` varchar(50) DEFAULT NULL,
  `Facebook` text,
  `Twitter` text,
  `Instagram` text,
  `Website` text,
  `Linkedin` text,
  `Google` text,
  `Youtube` text,
  PRIMARY KEY (`MemberId`),
  UNIQUE KEY `pk_UserProfile` (`MemberId`),
  UNIQUE KEY `unique_LinePosition` (`LinePosition`,`UserLine_Id`),
  KEY `Userline_fk_UserProfile` (`UserLine_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserProfile`
--

INSERT INTO `UserProfile` (`MemberId`, `UserLine_Id`, `LinePosition`, `FirstName`, `MiddleName`, `LastName`, `LastNamePledge`, `Street`, `City`, `State`, `Zipcode`, `PhonePrimary`, `PhoneSecondary`, `Birthday`, `DateofDeath`, `DateofDeathNot`, `Email`, `WorkName`, `WorkPosition`, `WorkStreet`, `WorkCity`, `WorkState`, `WorkZipcode`, `WorkPhone`, `MailingStreet`, `MailingState`, `MailingCity`, `MailingZipcode`, `CurrentChapter`, `EmergencyName`, `EmergencyRelation`, `EmergencyPhone`, `EmergencyEmail`, `Facebook`, `Twitter`, `Instagram`, `Website`, `Linkedin`, `Google`, `Youtube`) VALUES
('1974FB05CD', 35, '05', 'Cheryl', NULL, 'Davis', 'Davis', NULL, NULL, NULL, NULL, NULL, NULL, '1974-10-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1974SL01PF', 1, '01', 'Patricia', NULL, 'Forrest', 'Forrest', NULL, NULL, NULL, NULL, NULL, '8567575555', '1900-08-17', NULL, NULL, NULL, 'Some Company', 'Senior Investigator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Xi Omega', NULL, NULL, NULL, NULL, 'www.facebook.com/lsanchezartu', NULL, NULL, 'www.lsanchezartu.com', NULL, NULL, NULL),
('1974SL02MC', 1, '02', 'Maria', NULL, 'Collier', 'Collier', '5 Bonita Vista Rd', 'Mount Vernon', 'NY', '10552', NULL, '9146671234', '1900-03-24', NULL, NULL, 'm.collier@earthlink.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL03DG', 1, '03', 'Deborah', 'L.', '(Rack)', 'Green-Cook', '389 N Arlington Ave', 'East Orange', 'Ne', '7017', '9734354321', '9736266262', '1900-01-08', NULL, NULL, 'racksammy@hotmail.com', 'State of New Jersey (DCA)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL04AB', 1, '04', 'AnnMarie', NULL, 'Stone', 'Stone', '3101 Claremont Street', 'Philadelphia', 'Pa', '19107', NULL, '6092402987', '1900-09-16', NULL, NULL, 'Annstone916@hotmail.com', 'State of Whowhat Judiciary', 'Retired Circuit Court Judge', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Beta Rho Omega', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL05PB', 1, '05', 'Pamela', NULL, 'Tiegue', 'Tiegue', '201 W Maple Ave', 'Pennsauken', 'Ne', '8109', NULL, '8561613210', '1900-03-29', NULL, NULL, 'pamika@live.net', 'Merchantville City Schools', 'Director of Special Services', '205 Ashland Street', 'Maple Shade', 'NJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL06YB', 1, '06', 'Yvette', NULL, 'Lincoln', 'Lincoln', NULL, NULL, NULL, NULL, NULL, '3015537744', '0190-08-21', NULL, NULL, 'yvettebaka@verizon.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL07MS', 1, '07', 'Myrielle', NULL, 'Smith', 'Smith', NULL, NULL, NULL, NULL, NULL, '7043003000', '1900-10-18', NULL, NULL, 'msmithjd@earthlink.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL08DJ', 1, '08', 'Donna', NULL, 'Adrine-Smith', 'Adrine-Smith', '292 Upper Brushy Face Rd', 'Highlands', 'NC', '28741', '(617) 784-1757', '(828) 868-3080', '1900-03-04', NULL, NULL, 'lsanchezartu@gmail.com', 'Smith Made Property', 'Chief Executive Officer', '1205 Highland Rd', 'Highlands', 'NC', '28741', '(828) 568-3680', '21 Creighton St., Unit 1', 'MA', 'Jamaica Plain', '02130', 'Chapter', 'Desiree Artu', 'Sister', '(617) 699-9089', NULL, 'http://www.facebook.com/dsmith', NULL, NULL, NULL, '', NULL, NULL),
('1974SL09DM', 1, '09', 'Donna', NULL, 'Montague-Barkley', 'Montague', '7410 4th St #325', NULL, NULL, NULL, NULL, '3019109100', '1900-07-25', NULL, NULL, 'jhingikaromas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL10GR', 1, '10', 'Gertrude', NULL, 'Robbins', 'Robbins', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1974SL1LS', 1, '1', 'Luis', NULL, 'Sanchez-Artu', 'Sanchez', '21 Creighton St., Unit 1', 'Jamaica Plain', 'MA', '02130', '(617) 784-1757', '(802) 230-6700', '1990-10-16', NULL, NULL, 'lsanchezartu@gmail.com', 'Year Up', 'IT TA', '45 Milk St.', 'Boston', 'MA', '02125', '(857) 333-4444', '21 Creighton St., Unit 1', 'MA', 'Jamaica Plain', '02130', 'IG', 'Desiree Artu', 'Mother', '(617) 435-2231', 'natalia.sanchezartu@gmail.com', 'http://www.facebook.com/lsanchezartu', 'http://www.twitter.com/newfok', NULL, 'http://www.lsanchezartu.com', 'http://www.linkedin.com/in/lsanchezartu', 'http://plus.google.com/lsanchezartu', 'http://youtube.google.com/lsanchezartu'),
('1975SE02VT', 2, '02', 'Vanessa', NULL, 'Tingle', 'Tingle', '25 Woodlawn Road', 'Randolph', 'MA', '2368', NULL, NULL, NULL, NULL, NULL, NULL, 'Fleet Federal Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1975SE03SK', 2, '03', 'Selena', NULL, 'Kansas', 'Kansas', NULL, NULL, NULL, NULL, NULL, NULL, '1900-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1975SE04DL', 2, '04', 'Denise', NULL, 'Lowery', 'Links', '536 W Farms Rd', 'Howell', 'NJ', '7731', '6318568566', '7328658659', '1900-08-10', NULL, NULL, 'dmlowery@optonline.net', 'Financial Freedom, LLC', 'Managing Director', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1975SE05MS', 2, '05', 'Murel', NULL, 'Smith', 'Smith', NULL, NULL, NULL, NULL, NULL, NULL, '1900-06-06', NULL, '2017-11-11', NULL, NULL, 'IVY BEYOND THE WALL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1976SP01CS', 3, '01', 'Corrinne', NULL, 'Ball', 'Ball', '1224 White Wood Way', 'West Chester', 'PA', '19382', NULL, '6108888080', '1900-08-13', NULL, NULL, 'CSBell8080@farmfresh.net', NULL, 'Marketing Manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1976SP03IH', 3, '03', 'Ivy', 'Jean', 'Hammon', 'Hammon', '165-45 137th Avenue #7G', NULL, NULL, NULL, '9175235235', '7186445555', '1900-11-30', NULL, NULL, 'diamondjean@hotmail.com', 'Large Agency', 'Assistant District Manager', NULL, NULL, NULL, NULL, '(212) 881-3104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1976SP04DW', 3, '04', 'Daisy', NULL, 'Trapps', 'Washington', '11990 Market St Unit 1713', 'Reston', 'VA', '20190', NULL, '7030200904', '1900-02-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1976SP06DB', 3, '06', 'Donna', NULL, 'French', 'Brasille', '11705 Shadystone Ter', 'Mitchellville', 'MD', '20721-2767', '2402712711', '3018838833', NULL, NULL, NULL, 'dbrasille@yahoo.com', NULL, 'Stay-@-Home Mom/Self Employed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
('1982SP05LC', 33, '05', 'Lisa', NULL, 'Chapman', 'Chapman', NULL, NULL, NULL, NULL, NULL, NULL, '1900-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1985SS01SW', 28, '01', 'Shelley', NULL, 'Worrell', 'Worrell', NULL, NULL, NULL, NULL, NULL, NULL, '1900-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1985SS02KH', 28, '02', 'Karen', NULL, 'Heyward', 'Heyward', NULL, NULL, NULL, NULL, NULL, NULL, '1900-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1985SS04IH', 28, '04', 'Ingrid', NULL, 'Sanchez', 'Henricksen', '21 Creighton St., Unit 1', 'Jamaica Plain', 'MA', '02130', '(617) 784-1757', NULL, '1983-05-04', NULL, NULL, 'ilhenricksen@gmail.com', 'FedEx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NY', 'New York', NULL, 'Iota Gamma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2018SS1SA', 26, '1', 'Sue', NULL, 'Argentieri', 'Argentieri', NULL, NULL, NULL, NULL, NULL, NULL, '1900-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `UserProfile`
--
DROP TRIGGER IF EXISTS `beforeInsert_UserProfile`;
DELIMITER //
CREATE TRIGGER `beforeInsert_UserProfile` BEFORE INSERT ON `UserProfile`
 FOR EACH ROW BEGIN

         IF NEW.LastName IS NULL THEN
            SET NEW.LastName = NEW.LastNamePledge;
         END IF;

         SET @Line = (SELECT ul.name FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
         SET @Semester = (SELECT ul.semester FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
         SET @InitiationYear = (SELECT ul.InitiationYear FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
		 
         SET NEW.MemberId = concat(@InitiationYear, left(@Semester,1), left(@Line,1), NEW.LinePosition, left(NEW.FirstName,1), left(NEW.LastNamePledge,1));         

    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `beforeUpdate_UserProfile`;
DELIMITER //
CREATE TRIGGER `beforeUpdate_UserProfile` BEFORE UPDATE ON `UserProfile`
 FOR EACH ROW BEGIN
         IF NEW.LastNamePledge != OLD.LastNamePledge  && NEW.LastName = OLD.LastNamePledge THEN
            SET NEW.LastName = NEW.LastNamePledge;
         END IF;
    END
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `UserAccount`
--
ALTER TABLE `UserAccount`
  ADD CONSTRAINT `AccountPermission_fk_UserAccount` FOREIGN KEY (`AccountPermission_Id`) REFERENCES `AccountPermission` (`Id`),
  ADD CONSTRAINT `UserProfile_fk_UserAccount` FOREIGN KEY (`MemberId`) REFERENCES `UserProfile` (`MemberId`);

--
-- Constraints for table `UserDegree`
--
ALTER TABLE `UserDegree`
  ADD CONSTRAINT `UserDegree_fk_DegreeType` FOREIGN KEY (`DegreeType_Id`) REFERENCES `DegreeType` (`Id`),
  ADD CONSTRAINT `UserDegree_fk_UserProfile` FOREIGN KEY (`MemberId`) REFERENCES `UserProfile` (`MemberId`);

--
-- Constraints for table `UserFamily`
--
ALTER TABLE `UserFamily`
  ADD CONSTRAINT `FamilyType_fk_UserFamily` FOREIGN KEY (`FamilyType_Id`) REFERENCES `FamilyType` (`Id`),
  ADD CONSTRAINT `UserProfile_fk_UserFamily` FOREIGN KEY (`MemberId`) REFERENCES `UserProfile` (`MemberId`);

--
-- Constraints for table `UserProfile`
--
ALTER TABLE `UserProfile`
  ADD CONSTRAINT `Userline_fk_UserProfile` FOREIGN KEY (`UserLine_Id`) REFERENCES `UserLine` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 10:02 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `biens_imposables`
--
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
create table if not exists `biens_imposables`.`admin`(
  `id` int(11) not null,
  `UserName` varchar(100) not null,
  `Password` varchar(100) not null,
  `updationDate` timestamp not null default '2023-10-10 11:42:58' on update CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Dumping data for table `admin` 
-- 
insert into `admin` (`id`, `UserName`, `Password`, `updationDate`) values
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2017-10-30 11:42:58');
-- --------------------------------------------------------
--
-- Structure de la table `ttaux`
--
create table if not exists `biens_imposables`.`ttaux`(
`id` int(11) not null AUTO_INCREMENT,
`Montant` float default null,
`Devise` varchar(250) default null,
`CreationDate` timestamp null default CURRENT_TIMESTAMP,
primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Structure de la table `tnature`
--
create table if not exists `biens_imposables`.`tnature`(
`id` int(11) not null AUTO_INCREMENT,
`Taux_id` int not null,
`Designation` varchar(250) not null,
`Mesurage` BOOLEAN not null,
`CreationDate` timestamp null default CURRENT_TIMESTAMP,
constraint `fk_tnature_ttaux` foreign key(`Taux_id`) references `ttaux`(`id`) on delete cascade on update cascade,
primary key(`id`)) ENGINE=InnoDB AUTO_INCREMENT=5 default CHARSET=latin1;
--
-- Structure de la table `trang`
--
create table if not exists `biens_imposables`.`trang`(
`id` int(11) not null AUTO_INCREMENT,
`Designation` varchar(250) not null,
`CreationDate` timestamp null default CURRENT_TIMESTAMP,
primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Structure de la table `tactivite`
--
create table if not exists `biens_imposables`.`tactivite`(
`id` int(11) not null AUTO_INCREMENT, 
`Designation` varchar(250) not null,
`Ensegne` varchar(250) not null,
`Taxe` varchar(250) not null,
`CreationDate` timestamp null default CURRENT_TIMESTAMP,
primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
--
-- Table structure for table `tcentre`
--
create table if not exists `biens_imposables`.`tcentre`(
  `id` int(11) not null AUTO_INCREMENT,
  `CentreName` varchar(150) default null,
  `CentreShortName` varchar(100) not null ,
  `CentreCode` varchar(50) default null,
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Dumping data for table `tcentre`
--
insert into `tcentre` (`id`, `CentreName`, `CentreShortName`, `CentreCode`, `CreationDate`) values
(1, 'Karisimbi', 'KR001', 'KR001', '2023-11-01 07:16:25'),
(2, 'Goma', 'GO', 'GO001', '2023-11-01 07:19:37'),
(3, 'Beni', 'BN', 'BN001', '2023-11-01 07:19:37'),
(4, 'Butembo', 'BT', 'BT001', '2023-11-01 07:19:37'),
(5, 'Bunagana', 'BU', 'BN001', '2023-11-01 07:19:37'),
(6, 'Rutshuru', 'RT', 'RT001', '2023-12-02 21:28:56');
-- --------------------------------------------------------
--
-- Table structure for table `tprovince`
--
create table if not exists `biens_imposables`.`tprovince`(
  `id` int(11) not null AUTO_INCREMENT,
  `ProvinceName` varchar(150) default null,
  `ProvinceCode` varchar(50) default null,
  `ProvinceShortName` varchar(100) not null,
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
   unique(`ProvinceName`,`ProvinceCode`,`ProvinceShortName`),
   primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;

INSERT INTO `tprovince` (`id`,`ProvinceName`,`ProvinceCode`,`ProvinceShortName`) values(null,'Nord-Kivu','33','NK');
--
-- Table structure for table `tville`
--
create table if not exists `biens_imposables`.`tville`(
  `id` int(11) not null AUTO_INCREMENT,
  `ProvinceId`int not null,
  `VilleName` varchar(150) default null,
  `VilleCode` varchar(50) default null,
  unique(`ProvinceId`, `VilleName`,`VilleCode`),
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
  constraint `fk_tville_territoire_tprovince` foreign key(`ProvinceId`) references `tprovince`(`id`) on delete cascade on update cascade,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Table structure for table `tcommune`
--
create table if not exists `biens_imposables`.`tcommune`(
  `id` int(11) not null AUTO_INCREMENT,
  `VilleId` int not null,
  `CommuneName` varchar(150) default null,
  unique(`VilleId`, `CommuneName`),
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Table structure for table `tquartier`
--
create table if not exists `biens_imposables`.`tquartier`(
  `id` int(11) not null AUTO_INCREMENT,
  `CommuneId` int not null,
  `QuartierName` varchar(150) default null,
  unique(`CommuneId`, `QuartierName`),
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Table structure for table `tavenue`
--
create table if not exists `biens_imposables`.`tavenue`(
  `id` int(11) not null AUTO_INCREMENT,
  `QuartierId` int not null,
  `AvenueName` varchar(150) default null,
  `CreationDate` timestamp null default CURRENT_TIMESTAMP,
  unique(`QuartierId`,`AvenueName`),
  constraint `fk_tavenue_localite_tquartier_groupement` foreign key(`QuartierId`) references `tquartier`(`id`) on delete cascade on update cascade,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
  --
-- Structure de la table `tadresse`
--
create table if not exists `biens_imposables`.`tadresse`(
`id` int(11) not null AUTO_INCREMENT,
`AvenueId` int not null,
`RangId` int not null,
`Numero` int not null default 0,
`Localisation` varchar(255) not null,
unique(`AvenueId`,`Numero`,`Localisation`),
constraint `fk_tadresse_tavenue_localite` foreign key(`AvenueId`) references `tavenue`(`id`) on delete cascade on update cascade,
constraint `fk_tadresse_taang` foreign key(`RangId`) references `trang`(`id`) on delete cascade on update cascade,
primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Table structure for table `tassujetti`
--
create table if not exists `biens_imposables`.`tassujetti`(
  `id` int(11) not null AUTO_INCREMENT,
  `AsId` varchar(100) not null,
  `FirstName` varchar(150) default null,
  `LastName` varchar(150) default null,
  `EmailId` varchar(200) default null,
  `Gender` varchar(100) default null,
  `Dob` varchar(100) default null,
  `Formjuridique` varchar(100) default null,
  `Raison` varchar(100) default null,
  `Rccm` varchar(100) default null,
  `Sigle` varchar(100) default null,
  `Numimpot` varchar(100) default null,
  `Address` varchar(255) not null,
  `City` varchar(200) not null,
  `Country` varchar(150) not null,
  `Phonenumber` char(11) not null,
  `Status` int(1) not null,
  `RegDate` timestamp not null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Table structure for table `tagent`
--
create table if not exists `biens_imposables`.`tagent`(
  `id` int(11) not null AUTO_INCREMENT,
  `AgId` varchar(100) not null,
  `FirstName` varchar(150) not null,
  `LastName` varchar(150) not null,
  `EmailId` varchar(200) not null,
  `Password` varchar(180) not null,
  `Gender` varchar(100) not null,
  `Dob` varchar(100) not null,
  `Centre` varchar(255) not null,
  `Address` varchar(255) not null,
  `City` varchar(200) not null,
  `Country` varchar(150) not null,
  `Phonenumber` char(14) not null,
  `Status` int(1) not null,
  `RegDate` timestamp not null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;

  INSERT INTO `tagent` (`id`, `AgId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Centre`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(null, 'AG10806121', 'AKILI', 'KAMALA', 'ezkamala@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Masculin', '10 October, 1993', 'Goma', '32, Kyeshero, KIBATI', 'Goma', 'RDC', '970580940', 1, '2023-08-04 11:29:59'),
(null, 'AG10762132', 'KAMBALE', 'MALYABO', 'joram@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Masculin', '3 February, 1996', 'Karisimbi', '10, Katindo, Hewa', 'Goma', 'RDC', '8587944255', 1, '2023-08-04 13:40:02');
--
-- Table structure for table `tdetails`
--
create table if not exists `biens_imposables`.`tdetails` (
  `id` int(11) not null AUTO_INCREMENT,
  `AgrType` varchar(110) not null,
  `Description` mediumtext not null,
  `PostingDate` timestamp not null default CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminRemarkDate` varchar(120) default null,
  `Status` int(1) not null,
  `IsRead` int(1) not null,
  `agid` int(11) default null,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Dumping data for table `tdetails`
--
insert into `tdetails` (`id`, `AgrType`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `agid`) values
(1, 'CB', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-19 13:11:21', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:27 ', 2, 1, 1),
(2, 'CD', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-20 11:14:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-12-02 23:24:39 ', 1, 1, 2);
-- Table structure for table `tagreetype`
--
create table if not exists `biens_imposables`.`tagreetype`(
  `id` int(11) not null AUTO_INCREMENT,
  `AgrType` varchar(200) default null,
  `Description` mediumtext,
  `CreationDate` timestamp not null default CURRENT_TIMESTAMP,
  primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;
--
-- Dumping data for table `tagreetype`
--
INSERT INTO `tagreetype` (`id`, `AgrType`, `Description`, `CreationDate`) VALUES
(1,'CB', 'Agrement', '2017-11-01 12:07:56'),
(2,'CD', 'CD Agree test', '2017-11-06 13:16:09');
--
-- Structure de la table `tpropriete`
--
create table if not exists `biens_imposables`.`tpropriete`(
`id` int(11) not null AUTO_INCREMENT,
`PrId` varchar(100) not null,
`AdresseId` int not null,
`ActiviteId` int not null,
`NatureId` int not null,
`AgentId` int not null,
`AssujettiId` int not null,
`Designation` varchar(250) not null,
`Status` int(1) not null,
`CreationDate` timestamp null default CURRENT_TIMESTAMP,
constraint `fk_tpropriete_tadresse` foreign key(`AdresseId`) references `tadresse`(`id`) on delete cascade on update cascade,
constraint `fk_tpropriete_tativite` foreign key(`ActiviteId`) references `tactivite`(`id`) on delete cascade on update cascade,
constraint `fk_tpropriete_tnature` foreign key(`NatureId`) references `tnature`(`id`) on delete cascade on update cascade,
constraint `fk_tpropriete_tagent` foreign key(`AgentId`) references `tagent`(`id`) on delete cascade on update cascade,
constraint `fk_tpropriete_tassujetti` foreign key(`AssujettiId`) references `tassujetti`(`id`) on delete cascade on update cascade,
primary key(`id`)) ENGINE=InnoDB default CHARSET=latin1;

INSERT INTO `tpropriete` (`id`, `PrId`, `AdresseId`, `ActiviteId`, `NatureId`, `AgentId`, `AssujettiId`, `Designation`, `Status`, `CreationDate`) VALUES (NULL, 'CU4535', '1', '1', '5', '1', '1', 'Parcelle', '1', current_timestamp());
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

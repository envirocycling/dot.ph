-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2015 at 07:37 AM
-- Server version: 5.0.77
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `efi_db_efi_truc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addbattery`
--

CREATE TABLE IF NOT EXISTS `tbl_addbattery` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `qty` varchar(1000) NOT NULL,
  `issued` int(11) NOT NULL,
  `available` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addinventorytool`
--

CREATE TABLE IF NOT EXISTS `tbl_addinventorytool` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `dateencode` varchar(100) NOT NULL,
  `encodeby` varchar(100) NOT NULL,
  `issued` int(100) NOT NULL,
  `available` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `zero` int(11) NOT NULL,
  `truckid` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_addinventorytool`
--

INSERT INTO `tbl_addinventorytool` (`id`, `name`, `qty`, `dateencode`, `encodeby`, `issued`, `available`, `status`, `sold`, `zero`, `truckid`) VALUES
(25, 'COMBINATION WRENCH 10', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(26, 'DO BUT 8', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(27, 'DO BUT 9', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(28, 'DO BUT 10', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(29, 'DO BUT 11', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(30, 'DO BUT 12', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(31, 'DO BUT 13', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(32, 'DO BUT 14', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(33, 'DO BUT 15', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(34, 'DO BUT 16', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(35, 'DO BUT 17', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(36, 'DO BUT 18', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(37, 'DO BUT 19', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(38, 'DO BUT 20', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(39, 'DO BUT 21', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(40, 'DO BUT 22', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(41, 'DO BUT 23', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(42, 'DO BUT 24', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(43, 'ADJUSTABLE WRENCH', '70', '06-18-2015', '', 0, '70', 0, 0, 0, ''),
(44, 'VICE GRIP', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(45, 'PHILIPS SREW', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(46, 'SCREW DRIVER', '70', '06-18-2015', '', 1, '69', 0, 0, 0, ''),
(47, 'PLIERS', '70', '06-18-2015', '', 1, '69', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_battery`
--

CREATE TABLE IF NOT EXISTS `tbl_battery` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_changeoil`
--

CREATE TABLE IF NOT EXISTS `tbl_changeoil` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(100) NOT NULL,
  `date` varchar(500) NOT NULL,
  `performedby` varchar(500) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `changes` varchar(100) NOT NULL,
  `froms` varchar(100) NOT NULL,
  `tos` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tbl_changeoil`
--

INSERT INTO `tbl_changeoil` (`id`, `truckid`, `date`, `performedby`, `remarks`, `changes`, `froms`, `tos`) VALUES
(41, 68, '2015-08-15', 'ARVY', '', '2015-11-15', '', ''),
(38, 50, '2015-08-05', 'TOYOTA', 'C/O ROLANDO', '2015-11-05', '', ''),
(39, 68, '2015-07-05', 'ROLANDO MANARANG', '', '2015-11-15', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_changeswaps`
--

CREATE TABLE IF NOT EXISTS `tbl_changeswaps` (
  `id` int(11) NOT NULL auto_increment,
  `tireid` varchar(100) NOT NULL,
  `truckid` varchar(100) NOT NULL,
  `tirename` varchar(100) NOT NULL,
  `tiresize` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `addedby` varchar(100) NOT NULL,
  `swapto` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `lifespan` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `tid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forrepair`
--

CREATE TABLE IF NOT EXISTS `tbl_forrepair` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `receivingbranch` varchar(100) NOT NULL,
  `sendingbranch` varchar(100) NOT NULL,
  `datereceive` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_givento`
--

CREATE TABLE IF NOT EXISTS `tbl_givento` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `truckid` int(11) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `issuancedate` varchar(100) NOT NULL,
  `enddate` varchar(100) NOT NULL,
  `amortization` varchar(100) NOT NULL,
  `cashbond` varchar(100) NOT NULL,
  `proposedvolume` varchar(100) NOT NULL,
  `preparedby` varchar(100) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_givento`
--

INSERT INTO `tbl_givento` (`id`, `name`, `truckid`, `suppliername`, `issuancedate`, `enddate`, `amortization`, `cashbond`, `proposedvolume`, `preparedby`, `remarks`) VALUES
(10, 'PAMPANGA', 10, 'TISOY', '2014-07-01', '2014-07-01', '6500', '3500', '30000', 'caridaoan', ''),
(11, 'SAUYO', 11, 'J. STA. MARIA', '2011-10-11', '2016-10-10', '3667', '3900', '50000', 'JJD', ''),
(12, 'MANGALDAN', 12, 'ALEX JUNKSHOP', '2015-04-04', '2015-04-04', '5833', '5200', '60000', 'JJD', ''),
(13, 'PASAY', 13, '	FJ PRAXIDIO	', '2015-04-04', '2015-04-04', '5833', '5200', '60000', 'JJD', ''),
(14, 'KAYBIGA', 14, 'BERNANDITA TUANDA', '2014-03-21', '2019-03-20', '7167', '5200', '40000', 'JJD', ''),
(15, 'CAINTA', 15, 'CYRUS DEO TRADING', '2013-08-01', '2018-07-31', '4667', '3900', '20000', 'JJD', ''),
(16, 'SAUYO', 16, 'ALLERA', '2014-02-26', '', '', '', '', '', ''),
(17, 'KAYBIGA', 17, 'RUKAWA', '2014-04-10', '2019-04-09', '5770', '5200', '50000', 'JJD', ''),
(18, 'PAMPANGA', 18, 'RODEL NOAY', '2013-01-12', '', '', '', '', '', ''),
(19, 'SAUYO', 19, 'MARIO ADENA', '2013-09-01', '', '', '', '', '', ''),
(20, 'PAMPANGA', 20, 'RONALDO SALVANTE / SALVANTE JUNKSHOP', '2014-08-01', '', '', '', '', '', ''),
(21, 'KAYBIGA', 21, 'PATERNO AMANDOG JR', '2013-02-21', '2018-02-20', '9167', '5200', '80000', 'JJD', ''),
(22, 'CAINTA', 22, 'CYRUS DEO TRADING', '2013-08-01', '', '', '', '', '', ''),
(23, '', 23, '', '', '', '', '', '', '', ''),
(24, 'SAUYO', 24, 'JOVEN DANONG', '2012-10-01', '', '', '', '', '', ''),
(25, 'SAUYO', 25, 'TRANSFORMER JUNKSHOP', '2013-03-13', '2018-03-12', '6334', '5200', '50000', 'JJD', ''),
(26, 'PAMPANGA', 26, 'EDRIA TRADING / FELIMON TRADING', '2014-12-09', '', '', '', '', '', ''),
(27, 'KAYBIGA', 27, 'RJR JUNKSHOP/RODERICK', '2014-05-22', '', '', '', '', '', ''),
(28, 'KAYBIGA', 28, 'TINE AND MELAI JUNKSHOP', '2014-04-14', '', '', '', '', '', ''),
(29, 'CAVITE', 29, 'RASHEED TRADING', '2014-05-12', '', '', '', '', '', ''),
(30, 'CAVITE', 30, 'JV JUNKSHOP', '2014-06-24', '', '', '', '', '', ''),
(31, 'PAMPANGA', 31, 'ALVIN SACLAPUZ / ABAY', '2014-08-01', '', '', '', '', '', ''),
(32, 'CAINTA', 32, 'ANALIE TRADING', '2014-08-01', '', '', '', '', '', ''),
(33, 'KAYBIGA', 33, 'HERMIE LOUIE SARCENO', '2014-04-11', '', '', '', '', '', ''),
(34, 'PAMPANGA', 34, 'JD SCRAP PAPER', '2015-01-26', '2015-01-26', '6334', '3000', '40000', 'JJD', ''),
(35, 'MANGALDAN', 35, 'MYLA GANADEN', '2015-02-02', '', '', '', '', '', ''),
(36, 'SAUYO', 36, 'CRISTINA', '0015-03-13', '', '', '', '', '', ''),
(37, 'PAMPANGA', 37, 'NEBOR JSHOP / ROVINILDA DE GUZMAN', '2015-03-11', '2015-03-11', '7500', '5200', '30000', 'JJD', ''),
(38, 'PASAY', 38, '4J JUNKSHOP', '2015-04-06', '2020-04-05', '6667', '3000', '30000', 'JJD', ''),
(39, 'MANGALDAN', 39, 'RAFAEL MADANES', '2015-05-01', '2015-05-01', '6667', '5200', '50000', 'JJD', ''),
(41, 'URDANETA', 41, 'BRANCH_URDANETA', '', '', '', '', '', 'JJD', ''),
(42, 'PAMPANGA', 42, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(43, 'URDANETA', 43, 'BRANCH_URDANETA', '', '', '', '', '', 'JJD', ''),
(44, 'URDANETA', 44, 'BRANCH_URDANETA', '', '', '', '', '', 'JJD', ''),
(45, 'SAUYO', 45, 'BRANCH_SAUYO', '', '', '', '', '', 'JJD', ''),
(46, 'CAINTA', 46, 'BRANCH_CAINTA', '', '', '', '', '', '', ''),
(47, 'PAMPANGA', 47, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(48, 'PAMPANGA', 48, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(49, 'PAMPANGA', 49, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', 'USED FOR PAMPANGA PICK UP'),
(50, 'PAMPANGA', 50, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(51, 'CAVITE', 51, 'BRANCH_CAVITE', '', '', '', '', '', 'JJD', ''),
(52, 'PASAY', 52, 'HP-PASAY', '', '', '', '', '', 'JJD', 'USED FOR PASAY PICK-UP'),
(53, 'SAUYO', 53, 'BRANCH_SAUYO', '', '', '', '', '', '', ''),
(54, 'KAYBIGA', 54, 'BRANCH_NOVALICHES', '', '', '', '', '', '', ''),
(55, '', 55, '', '', '', '', '', '', '', ''),
(56, 'CAINTA', 56, 'BRANCH_CAINTA', '', '', '', '', '', '', ''),
(57, 'PASAY', 57, 'HP-PASAY', '', '', '', '', '', 'JJD', 'UNDER REPAIR'),
(58, 'KAYBIGA', 58, 'BRANCH_NOVALICHES', '', '', '', '', '', '', ''),
(59, 'PASAY', 59, 'ALTECIN JUNKSHOP', '2014-11-13', '', '', '', '', '', ''),
(60, 'KAYBIGA', 64, 'BRANCH_NOVALICHES', '', '', '', '', '', 'JJD', ''),
(61, 'CALAMBA', 65, 'BRANCH_CALAMBA', '', '', '', '', '', 'JJD', ''),
(62, 'CAINTA', 66, 'BRANCH_CAINTA', '', '', '', '', '', 'JJD', ''),
(63, 'PAMPANGA', 67, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(64, 'PAMPANGA', 68, 'BRANCH_PAMPANGA', '', '', '', '', '', '', ''),
(65, 'SAUYO', 69, 'BRANCH_SAUYO', '', '', '', '', '', 'JJD', ''),
(66, 'SAUYO', 70, 'BRANCH_SAUYO', '', '', '', '', '', 'JJD', ''),
(67, 'PAMPANGA', 71, 'BRANCH_PAMPANGA', '', '', '', '', '', 'JJD', ''),
(68, '', 72, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE IF NOT EXISTS `tbl_history` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_input`
--

CREATE TABLE IF NOT EXISTS `tbl_input` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` varchar(100) NOT NULL,
  `con` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_input`
--

INSERT INTO `tbl_input` (`id`, `truckid`, `con`, `cost`, `month`, `year`) VALUES
(12, '47', '2.50', '', 'August', '2015'),
(10, '68', '5.16', '', 'July', '2015'),
(6, '48', '3.50', '', 'July', '2015'),
(7, '49', '2.50', '', 'August', '2015'),
(8, '68', '5.16', '', 'August', '2015'),
(11, '49', '2.50', '', 'July', '2015'),
(13, '48', '3.50', '', 'August', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invetorytire`
--

CREATE TABLE IF NOT EXISTS `tbl_invetorytire` (
  `id` int(11) NOT NULL auto_increment,
  `tireid` varchar(100) NOT NULL,
  `truckid` varchar(100) NOT NULL,
  `tirename` varchar(100) NOT NULL,
  `tiresize` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reassign`
--

CREATE TABLE IF NOT EXISTS `tbl_reassign` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `truckid` varchar(100) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `issuancedate` varchar(100) NOT NULL,
  `enddate` varchar(100) NOT NULL,
  `amortization` varchar(100) NOT NULL,
  `cashbond` varchar(100) NOT NULL,
  `proposedvolume` varchar(100) NOT NULL,
  `preparedby` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `approved` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reassignmenthistory`
--

CREATE TABLE IF NOT EXISTS `tbl_reassignmenthistory` (
  `id` int(11) NOT NULL auto_increment,
  `truckplate` varchar(100) NOT NULL,
  `suppname` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `issuancedate` varchar(100) NOT NULL,
  `enddate` varchar(100) NOT NULL,
  `amortization` varchar(100) NOT NULL,
  `cashbond` varchar(100) NOT NULL,
  `proposedvolume` varchar(100) NOT NULL,
  `prepared` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repair`
--

CREATE TABLE IF NOT EXISTS `tbl_repair` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `date` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL,
  `items` varchar(500) NOT NULL,
  `repairedby` varchar(500) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_repair`
--

INSERT INTO `tbl_repair` (`id`, `truckid`, `date`, `type`, `items`, `repairedby`, `remarks`) VALUES
(2, 47, '2015-08-04', 'ENGINE INSTALLATION', 'ENGINE', 'MOTORPOOL WINNIE', 'INSTALLED WITH THE HELP OF FORKLIFT. JOHN AS THE ASSISTANT'),
(3, 47, '2015-08-05', 'REPAIR STARTER', 'STARTER & BATT.', 'MOTORPOOL WINNIE', ''),
(4, 68, '2015-08-03', 'WHEEL REPAIR', 'BRAKE DRUM, REAM, ETC', 'MOTORPOOL WINNIE', ''),
(5, 67, '2015-08-01', 'OVERHAULING', 'ENGINE', 'NONE YET', 'NOT YET DONE'),
(6, 49, '2015-08-04', 'SEAT REPLACEMENT', 'SEAT', 'CREW ARVY', 'DONE'),
(7, 49, '2015-08-05', 'PATCHING LEAK', 'GEARBOX', 'CREW ARVY', 'FOUND LEAKS AT GEARBOX');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soldtools`
--

CREATE TABLE IF NOT EXISTS `tbl_soldtools` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` varchar(100) NOT NULL,
  `suppname` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `toolname` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `encodeby` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tool`
--

CREATE TABLE IF NOT EXISTS `tbl_tool` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `decription` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_tool`
--

INSERT INTO `tbl_tool` (`id`, `name`, `decription`) VALUES
(24, 'COMBINATION WRENCH 10', ''),
(25, 'DO BUT 8', ''),
(26, 'DO BUT 9', ''),
(27, 'DO BUT 10', ''),
(28, 'DO BUT 11', ''),
(29, 'DO BUT 12', ''),
(30, 'DO BUT 13', ''),
(31, 'DO BUT 14', ''),
(32, 'DO BUT 15', ''),
(33, 'DO BUT 16', ''),
(34, 'DO BUT 17', ''),
(35, 'DO BUT 18', ''),
(36, 'DO BUT 19', ''),
(37, 'DO BUT 20', ''),
(38, 'DO BUT 21', ''),
(39, 'DO BUT 22', ''),
(40, 'DO BUT 23', ''),
(41, 'DO BUT 24', ''),
(42, 'ADJUSTABLE WRENCH', ''),
(43, 'VICE GRIP', ''),
(44, 'PHILIPS SREW', ''),
(45, 'SCREW DRIVER', ''),
(46, 'PLIERS', ''),
(47, 'MSD', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_toolreassign`
--

CREATE TABLE IF NOT EXISTS `tbl_toolreassign` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` varchar(100) NOT NULL,
  `toolname` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `suppname` varchar(100) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `reassign` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `encodeby` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_toolreassign`
--

INSERT INTO `tbl_toolreassign` (`id`, `truckid`, `toolname`, `branch`, `suppname`, `dateadded`, `qty`, `reassign`, `sold`, `encodeby`) VALUES
(15, '24', 'SAMPLE', 'SAUYO', '', '08-10-2015', '2', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip`
--

CREATE TABLE IF NOT EXISTS `tbl_trip` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` int(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `ton` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `ins` varchar(100) NOT NULL,
  `outs` varchar(100) NOT NULL,
  `refill` int(11) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `driver` varchar(100) NOT NULL,
  `helper` varchar(100) NOT NULL,
  `updates` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=513 ;

--
-- Dumping data for table `tbl_trip`
--

INSERT INTO `tbl_trip` (`id`, `truckid`, `day`, `month`, `year`, `supplier`, `ton`, `remarks`, `ins`, `outs`, `refill`, `cost`, `driver`, `helper`, `updates`, `no`) VALUES
(63, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(62, 49, 4, 'July', 2015, 'JOY JUNKSHOP', '1500', '', '17', '16', 0, '28.60', 'ROD', '', 1, 7),
(470, 49, 18, 'August', 2015, 'BALIBAGO WATERWORKS', '0', '', '0', '0', 0, '0', 'RODNEY', '', 1, 7),
(59, 49, 2, 'July', 2015, 'WH TO RMD/ HYPER', '1500', '', '20', '18', 0, '28.60', 'ROD', '', 1, 7),
(58, 49, 1, 'July', 2015, 'SM CLARK', '1300', '', '22', '20', 0, '28.60', 'ROD', '', 1, 7),
(468, 49, 19, 'August', 2015, 'GUERIZA / SM HYPER', '970', '', '10', '9', 0, '28.60', 'RODNEY', 'NIKO', 1, 7),
(64, 49, 6, 'July', 2015, 'SM CLARK-HYPER', '1500', 'AS PER CREW,HIGH CONSUMP DUE TO TRRAFFIC', '16', '11', 0, '28.60', 'RYAN ', '', 1, 7),
(65, 49, 7, 'July', 2015, 'REX TRUCK USED', '0', 'DRIVER DEPLOYED TO REX TRUCK', '11', '10', 0, '28.00', 'NONE', '', 1, 7),
(66, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(67, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(68, 49, 6, 'July', 2015, 'SM CLARK-HYPER', '1500', 'AS PER CREW,HIGH CONSUMP DUE TO TRRAFFIC', '16', '11', 0, '28.60', 'RYAN ', '', 1, 7),
(69, 49, 7, 'July', 2015, 'REX TRUCK USED', '0', 'DRIVER DEPLOYED TO REX TRUCK', '11', '10', 0, '28.00', 'NONE', '', 1, 7),
(70, 49, 8, 'July', 2015, 'NONE', '0', 'NO TRIP - UNLOAD REX TRUCK', '10', '10', 0, '28.00', '', '', 1, 7),
(71, 49, 11, 'July', 2015, 'TNT JSHOP', '1000', '', '10', '9', 0, '28.60', 'ROD', '', 1, 7),
(72, 49, 12, 'July', 2015, 'SUNDAY', '0', '', '9', '9', 0, '28.60', '', '', 1, 7),
(73, 49, 13, 'July', 2015, 'NONE', '0', 'NO TRIP - DO SORTING & LOAD WJP AT WH', '9', '9', 0, '28.00', '', '', 1, 7),
(74, 49, 14, 'July', 2015, 'WH TO RMD', '4150', '', '9', '9', 0, '28.00', '', '', 1, 7),
(75, 49, 9, 'July', 2015, 'NONE', '0', 'NO TRIP - LOAD WJP AT WH', '10', '10', 0, '28.00', '', '', 1, 7),
(76, 49, 8, 'July', 2015, 'NONE', '0', 'NO TRIP - UNLOAD REX TRUCK', '10', '10', 0, '28.00', '', '', 1, 7),
(77, 49, 9, 'July', 2015, 'NONE', '0', 'NO TRIP - LOAD WJP AT WH', '10', '10', 0, '28.00', '', '', 1, 7),
(78, 49, 13, 'July', 2015, 'NONE', '0', 'NO TRIP - DO SORTING & LOAD WJP AT WH', '9', '9', 0, '28.00', '', '', 1, 7),
(79, 49, 9, 'July', 2015, 'NONE', '0', 'NO TRIP - LOAD WJP AT WH', '10', '10', 0, '28.00', '', '', 1, 7),
(80, 49, 10, 'July', 2015, 'WH TO RMD', '4320', '', '10', '10', 0, '28.00', 'ROD', '', 1, 7),
(81, 49, 11, 'July', 2015, 'TNT JSHOP', '1000', '', '10', '9', 0, '28.60', 'ROD', '', 1, 7),
(82, 49, 12, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(83, 49, 15, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO REX', '9', '9', 0, '28.00', '', '', 1, 7),
(84, 49, 16, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO REX', '9', '9', 0, '28.00', '', '', 1, 7),
(85, 49, 17, 'July', 2015, 'NONE', '0', 'HOLIDAY', '9', '9', 0, '28.00', '', '', 1, 7),
(86, 49, 18, 'July', 2015, 'SM CLARK', '1310', '', '9', '7', 0, '28.60', 'ROD', '', 1, 7),
(87, 49, 19, 'July', 2015, 'SUNDAY', '0', '', '7', '7', 0, '28.00', '', '', 1, 7),
(88, 49, 20, 'July', 2015, 'NONE', '0', '', '7', '7', 0, '28.00', '', '', 1, 7),
(89, 49, 21, 'July', 2015, 'NONE', '0', 'DRIVER ON LEAVE', '7', '7', 0, '28.00', '', '', 1, 7),
(91, 49, 23, 'July', 2015, 'SM CLARK', '960', '', '7', '5', 17, '28.00', '', '', 1, 7),
(92, 49, 24, 'July', 2015, 'SM CLARK', '1370', '', '22', '20', 0, '28.60', 'RYAN ', '', 1, 7),
(93, 49, 25, 'July', 2015, 'OFF - GREASING', '0', '', '20', '20', 0, '28.00', '', '', 1, 7),
(94, 49, 26, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '20', '20', 0, '28.00', '', '', 1, 7),
(95, 49, 26, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '20', '20', 0, '28.00', '', '', 1, 7),
(96, 49, 26, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '20', '20', 0, '28.00', '', '', 1, 7),
(99, 49, 26, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '20', '20', 0, '28.00', '', '', 1, 7),
(97, 49, 26, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '20', '20', 0, '28.00', '', '', 1, 7),
(98, 49, 25, 'July', 2015, 'OFF - GREASING', '0', '', '20', '20', 0, '28.00', '', '', 1, 7),
(100, 49, 27, 'July', 2015, 'NONE', '0', 'TME WAS USED.', '20', '20', 0, '28.00', '', '', 1, 7),
(101, 49, 28, 'July', 2015, 'WH TO RMD /GUERIZA', '1340', '', '20', '19', 0, '28.60', '', '', 1, 7),
(102, 49, 29, 'July', 2015, 'TNT JSHOP                                                                                           ', '960', '', '19', '17', 0, '28.60', '', '', 1, 7),
(103, 49, 30, 'July', 2015, 'UNDER REPAIR', '0', '', '17', '17', 0, '28.00', '', '', 1, 7),
(104, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(105, 49, 32, 'July', 2015, '', '', '', '17', '', 0, '', '', '', 1, 7),
(106, 49, 33, 'July', 2015, '', '', '', '16', '', 0, '', '', '', 0, 7),
(107, 49, 3, 'July', 2015, 'SM CLARK', '1530', '', '18', '17', 0, '28.60', 'ARVY', '', 1, 7),
(108, 49, 33, 'July', 2015, '', '', '', '16', '', 0, '', '', '', 0, 7),
(109, 49, 28, 'July', 2015, 'WH TO RMD /GUERIZA', '1340', '', '20', '19', 0, '28.60', '', '', 1, 7),
(110, 49, 26, 'July', 2015, '', '', '', '20', '', 0, '', '', '', 1, 7),
(111, 49, 24, 'July', 2015, 'SM CLARK', '1370', '', '22', '20', 0, '28.60', 'RYAN ', '', 1, 7),
(112, 49, 20, 'July', 2015, 'NONE', '0', '', '7', '7', 0, '28.00', '', '', 1, 7),
(113, 49, 17, 'July', 2015, 'NONE', '0', 'HOLIDAY', '9', '9', 0, '28.00', '', '', 1, 7),
(114, 49, 18, 'July', 2015, 'SM CLARK', '1310', '', '9', '7', 0, '28.60', 'ROD', '', 1, 7),
(115, 49, 13, 'July', 2015, 'NONE', '0', 'NO TRIP - DO SORTING & LOAD WJP AT WH', '9', '9', 0, '28.00', '', '', 1, 7),
(116, 49, 7, 'July', 2015, 'REX TRUCK USED', '0', 'DRIVER DEPLOYED TO REX TRUCK', '11', '10', 0, '28.00', 'NONE', '', 1, 7),
(117, 49, 7, 'July', 2015, 'REX TRUCK USED', '0', 'DRIVER DEPLOYED TO REX TRUCK', '11', '10', 0, '28.00', 'NONE', '', 1, 7),
(118, 49, 9, 'July', 2015, 'NONE', '0', 'NO TRIP - LOAD WJP AT WH', '10', '10', 0, '28.00', '', '', 1, 7),
(119, 49, 12, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(120, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(121, 49, 6, 'July', 2015, 'SM CLARK-HYPER', '1500', 'AS PER CREW,HIGH CONSUMP DUE TO TRRAFFIC', '16', '11', 0, '28.60', 'RYAN ', '', 1, 7),
(122, 49, 7, 'July', 2015, 'REX TRUCK USED', '0', 'DRIVER DEPLOYED TO REX TRUCK', '11', '10', 0, '28.00', 'NONE', '', 1, 7),
(123, 49, 8, 'July', 2015, 'NONE', '0', 'NO TRIP - UNLOAD REX TRUCK', '10', '10', 0, '28.00', '', '', 1, 7),
(124, 49, 9, 'July', 2015, 'NONE', '0', 'NO TRIP - LOAD WJP AT WH', '10', '10', 0, '28.00', '', '', 1, 7),
(125, 49, 10, 'July', 2015, 'WH TO RMD', '4320', '', '10', '10', 0, '28.00', 'ROD', '', 1, 7),
(126, 49, 11, 'July', 2015, 'TNT JSHOP', '1000', '', '10', '9', 0, '28.60', 'ROD', '', 1, 7),
(127, 49, 12, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(128, 49, 8, 'July', 2015, 'NONE', '0', 'NO TRIP - UNLOAD REX TRUCK', '10', '10', 0, '28.00', '', '', 1, 7),
(129, 49, 15, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(130, 49, 19, 'July', 2015, '', '', '', '7', '', 0, '', '', '', 1, 7),
(131, 49, 10, 'July', 2015, 'WH TO RMD', '4320', '', '10', '10', 0, '28.00', 'ROD', '', 1, 7),
(132, 49, 11, 'July', 2015, 'TNT JSHOP', '1000', '', '10', '9', 0, '28.60', 'ROD', '', 1, 7),
(133, 49, 15, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(134, 49, 25, 'July', 2015, 'OFF - GREASING', '0', '', '20', '20', 0, '28.00', '', '', 1, 7),
(136, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(137, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(138, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(139, 48, 1, 'July', 2015, 'UNDER REPAIR', '0', 'WIRING REPAIR', '23', '23', 0, '26.80', '', '', 1, 7),
(140, 48, 2, 'July', 2015, 'UNDER REPAIR', '0', 'WIRING REPAIR', '23', '23', 0, '', '', '', 1, 7),
(141, 48, 3, 'July', 2015, 'UNDER REPAIR', '0', 'WIRING', '23', '23', 0, '', '', '', 1, 7),
(142, 48, 6, 'July', 2015, 'UNDER REPAIR', '0', 'FIX ALTERNATOR', '23', '23', 0, '', '', '', 1, 7),
(143, 48, 7, 'July', 2015, 'JOY JUNKSHOP', '2590', '', '23', '20', 0, '26.80', 'RYAN', '', 1, 7),
(144, 48, 8, 'July', 2015, 'SFPM', '4560', 'SAN FERNANDO PAPERMILL', '20', '15', 0, '26.80', 'RYAN ', '', 1, 7),
(145, 48, 4, 'July', 2015, 'UNDER REPAIR', '0', 'REGULATOR OF ALTERNATOR', '23', '23', 0, '', '', '', 1, 7),
(146, 48, 5, 'July', 2015, 'SUNDAY', '0', '', '23', '23', 0, '', '', '', 1, 7),
(147, 48, 7, 'July', 2015, 'JOY JUNKSHOP', '2590', '', '23', '20', 0, '26.80', 'RYAN', '', 1, 7),
(149, 48, 10, 'July', 2015, 'SM CLARK-HYPER', '1230', '', '13', '10', 0, '26.80', 'RYAN ', '', 1, 7),
(150, 48, 10, 'July', 2015, 'SM CLARK-HYPER', '1230', '', '13', '10', 0, '26.80', 'RYAN ', '', 1, 7),
(467, 49, 18, 'August', 2015, 'BALIBAGO WATERWORKS', '0', '', '0', '0', 0, '0', 'RODNEY', '', 1, 8),
(152, 49, 30, 'July', 2015, 'UNDER REPAIR', '0', '', '17', '17', 0, '28.00', '', '', 1, 7),
(153, 49, 7, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(154, 49, 7, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(378, 49, 23, 'July', 2015, 'SM CLARK', '960', '', '7', '5', 17, '28.00', '', '', 1, 7),
(155, 49, 24, 'July', 2015, 'SM CLARK', '1370', '', '22', '20', 0, '28.60', 'RYAN ', '', 1, 7),
(156, 49, 24, 'July', 2015, 'SM CLARK', '1370', '', '22', '20', 0, '28.60', 'RYAN ', '', 1, 7),
(157, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(158, 49, 32, 'July', 2015, '', '', '', '17', '', 0, '', '', '', 1, 7),
(159, 49, 33, 'July', 2015, '', '', '', '15', '', 0, '', '', '', 0, 7),
(160, 49, 1, 'August', 2015, 'SM HYPER', '0', '', '15', '0', 0, '', '', '', 1, 8),
(161, 49, 2, 'August', 2015, 'SUNDAY', '0', '', '0', '0', 0, '', '', '', 1, 8),
(162, 49, 3, 'August', 2015, 'WH TO RMD', '0', '', '0', '0', 0, '', '', '', 1, 8),
(163, 48, 10, 'July', 2015, 'SM CLARK-HYPER', '1230', '', '13', '10', 0, '26.80', 'RYAN ', '', 1, 7),
(164, 48, 10, 'July', 2015, 'SM CLARK-HYPER', '1230', '', '13', '10', 0, '26.80', 'RYAN ', '', 1, 7),
(165, 48, 10, 'July', 2015, 'SM CLARK-HYPER', '1230', '', '13', '10', 0, '26.80', 'RYAN ', '', 1, 7),
(166, 48, 11, 'July', 2015, 'NONE', '0', '', '10', '10', 0, '', '', '', 1, 7),
(167, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(168, 48, 11, 'July', 2015, 'NONE', '0', '', '10', '10', 0, '', '', '', 1, 7),
(169, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(170, 48, 11, 'July', 2015, 'NONE', '0', '', '10', '10', 0, '', '', '', 1, 7),
(171, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(172, 48, 11, 'July', 2015, 'NONE', '0', '', '10', '10', 0, '', '', '', 1, 7),
(175, 48, 11, 'July', 2015, 'NONE', '0', '', '10', '10', 0, '', '', '', 1, 7),
(173, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(174, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(176, 48, 12, 'July', 2015, 'SUNDAY', '0', '', '10', '10', 0, '', '', '', 1, 7),
(177, 48, 13, 'July', 2015, 'WH TO RMD', '2780', '', '10', '10', 0, '28.60', '', '', 1, 7),
(178, 48, 14, 'July', 2015, 'SM CLARK', '1460', '', '10', '8', 0, '28.60', '', '', 1, 7),
(179, 48, 15, 'July', 2015, 'SEMI', '1730', '', '8', '5', 20, '28.60', '', '', 1, 7),
(180, 48, 16, 'July', 2015, 'SM CLARK-HYPER', '1250', '', '25', '23', 0, '28.60', '', '', 1, 7),
(181, 48, 17, 'July', 2015, 'GUERIZA', '1210', '', '23', '22', 0, '28.60', '', '', 1, 7),
(182, 48, 16, 'July', 2015, 'SM CLARK-HYPER', '1250', '', '25', '23', 0, '28.60', '', '', 1, 7),
(183, 48, 17, 'July', 2015, 'GUERIZA', '1210', '', '23', '22', 0, '28.60', '', '', 1, 7),
(184, 48, 18, 'July', 2015, 'SM CLARK', '1660', '', '22', '20', 0, '28.60', '', '', 1, 7),
(185, 48, 19, 'July', 2015, 'SUNDAY', '0', '', '20', '20', 0, '', '', '', 1, 7),
(186, 48, 20, 'July', 2015, 'NO DRIVER', '0', 'RESCUE REX TRUCK', '20', '20', 0, '', '', '', 1, 7),
(187, 48, 21, 'July', 2015, 'NONE', '0', 'DRIVER ON-LEAVE', '20', '20', 0, '', '', '', 1, 7),
(188, 48, 22, 'July', 2015, 'SM HYPER/MANGUERA', '2800', '', '20', '18', 0, '28.60', '', '', 1, 7),
(189, 48, 23, 'July', 2015, 'SM CLARK', '1430', '', '18', '16', 0, '28.60', '', '', 1, 7),
(190, 48, 24, 'July', 2015, 'SEMI', '2070', 'DUE TO TRAFFIC, DIESEL HIGH', '16', '12.5', 0, '28.60', '', '', 1, 7),
(191, 48, 25, 'July', 2015, 'SM CLARK-HYPER', '1620', 'DUE TO TRAFFIC AS PER CREW', '12.5', '10', 25, '28.60', '', '', 1, 7),
(192, 48, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '35', '19', 0, '28.60', 'ROD', '', 1, 7),
(193, 48, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '35', '19', 0, '28.60', 'ROD', '', 1, 7),
(194, 48, 27, 'July', 2015, 'UNLOAD AMCOR', '7180', 'FOR SORTING QUALITY', '19', '19', 0, '28.60', 'ROD', '', 1, 7),
(195, 48, 27, 'July', 2015, 'UNLOAD AMCOR', '7180', 'FOR SORTING QUALITY', '19', '19', 0, '28.60', 'ROD', '', 1, 7),
(196, 48, 27, 'July', 2015, 'UNLOAD AMCOR', '7180', 'FOR SORTING QUALITY', '19', '19', 0, '28.60', 'ROD', '', 1, 7),
(197, 48, 28, 'July', 2015, 'SM CLARK-HYPER', '1440', '', '19', '17', 0, '28.60', 'ROD', '', 1, 7),
(198, 48, 29, 'July', 2015, 'SEMI', '2100', '', '17', '15', 0, '28.60', 'ROD', '', 1, 7),
(199, 48, 30, 'July', 2015, 'SM CLARK', '1460', '', '15', '13', 0, '28.60', 'ROD', '', 1, 7),
(200, 48, 31, 'July', 2015, 'SEMI', '2240', '', '13', '11', 0, '28.60', 'ROD', '', 1, 7),
(201, 48, 32, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(202, 48, 33, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 0, 7),
(203, 48, 27, 'July', 2015, 'UNLOAD AMCOR', '7180', 'FOR SORTING QUALITY', '19', '19', 0, '28.60', 'ROD', '', 1, 7),
(204, 48, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '35', '19', 0, '28.60', 'ROD', '', 1, 7),
(205, 68, 1, 'July', 2015, 'UNLOAD TO RMD', '14880', '', '39', '38', 0, '28.00', '', '', 1, 7),
(206, 68, 2, 'July', 2015, 'TRIPLE DRAGON', '20220', '', '38', '28', 0, '28.60', 'ARVY', '', 1, 7),
(207, 68, 3, 'July', 2015, 'SEMI', '3650', '', '28', '23', 0, '28.60', 'ROD', '', 1, 7),
(208, 68, 4, 'July', 2015, 'UNDER REPAIR', '0', 'FILTER', '23', '23', 0, '', '', '', 1, 7),
(209, 68, 5, 'July', 2015, 'SUNDAY', '0', '', '23', '23', 0, '', '', '', 1, 7),
(210, 68, 4, 'July', 2015, 'UNDER REPAIR', '0', 'FILTER', '23', '23', 0, '', '', '', 1, 7),
(211, 68, 5, 'July', 2015, 'SUNDAY', '0', '', '23', '23', 0, '', '', '', 1, 7),
(212, 68, 6, 'July', 2015, 'SEMI', '3480', '', '23', '17', 20, '28.60', 'ARVY', '', 1, 7),
(213, 68, 7, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '37', '16', 0, '28.60', 'ARVY', '', 1, 7),
(469, 49, 18, 'August', 2015, 'BALIBAGO WATERWORKS', '0', '', '0', '0', 0, '0', 'RODNEY', '', 1, 8),
(216, 68, 8, 'July', 2015, 'UNLOAD AMCOR', '10190', '', '16', '15', 25, '28.60', 'ARVY', '', 1, 7),
(217, 68, 9, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'ROD', '', 1, 7),
(218, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(219, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(465, 49, 17, 'August', 2015, 'PHILBOOK', '0', '', '0', '0', 0, '0', 'ROLAND', '', 1, 8),
(220, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(221, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(222, 68, 11, 'July', 2015, 'MANGALDAN', '20230', '', '44', '18', 22, '28.60', 'RYAN ', '', 1, 7),
(223, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(224, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(225, 68, 12, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'RYAN ', '', 1, 7),
(226, 68, 12, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'RYAN ', '', 1, 7),
(227, 68, 13, 'July', 2015, 'UNLOAD AMCOR', '14920', '', '18', '17', 24, '28.60', 'RYAN ', '', 1, 7),
(228, 68, 13, 'July', 2015, 'UNLOAD AMCOR', '14920', '', '18', '17', 24, '28.60', 'RYAN ', '', 1, 7),
(229, 68, 14, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '41', '19', 0, '28.60', 'ARVY', '', 1, 7),
(230, 68, 15, 'July', 2015, 'UNLOAD AMCOR', '12763', '', '19', '18', 25, '28.60', 'ARVY', '', 1, 7),
(464, 49, 17, 'August', 2015, 'PHILBOOK', '0', '', '0', '0', 0, '0', 'ROLAND', '', 1, 8),
(232, 68, 16, 'July', 2015, 'QC ROLYO/NOVA', '0', '', '43', '24', 0, '28.60', 'ARVY', '', 1, 7),
(233, 68, 17, 'July', 2015, 'HOLIDAY', '0', '', '24', '24', 0, '28.60', '', '', 1, 7),
(234, 68, 18, 'July', 2015, 'UNLOAD NOVA', '16470', '', '24', '23', 0, '28.60', '', '', 1, 7),
(463, 49, 16, 'August', 2015, 'SUNDAY', '0', '', '0', '0', 0, '0', '', '', 1, 8),
(235, 68, 17, 'July', 2015, 'HOLIDAY', '0', '', '24', '24', 0, '28.60', '', '', 1, 7),
(236, 68, 18, 'July', 2015, 'UNLOAD NOVA', '16470', '', '24', '23', 0, '28.60', '', '', 1, 7),
(237, 68, 19, 'July', 2015, 'SUNDAY', '0', '', '23', '23', 9, '', '', '', 1, 7),
(238, 68, 20, 'July', 2015, 'RESCUE REX419', '0', '', '32', '22', 0, '28.60', '', '', 1, 7),
(240, 68, 20, 'July', 2015, 'RESCUE REX419', '0', '', '32', '22', 0, '28.60', '', '', 1, 7),
(335, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(242, 68, 21, 'July', 2015, 'UNLOAD AMCOR', '10810', 'TRANSFER WP FROM REX TO RCS', '22', '19', 29, '28.60', '', '', 1, 7),
(329, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(244, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(277, 68, 22, 'July', 2015, 'SEMI', '7470', '', '48', '19', 29, '28.60', 'ARVY', '', 1, 7),
(245, 68, 23, 'July', 2015, 'MANILA BULLETIN', '7470', 'CHARGE TO SAUYO', '48', '27', 0, '26.60', 'ARVY', '', 1, 7),
(246, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(247, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(248, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(249, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(250, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(251, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(252, 68, 27, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '27', '26', 40, '26.60', 'ARVY', '', 1, 7),
(253, 68, 27, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '27', '26', 40, '26.60', 'ARVY', '', 1, 7),
(254, 68, 28, 'July', 2015, 'TRIPLE DRAGON', '0', '', '40', '29', 0, '28.60', 'ARVY', '', 1, 7),
(255, 68, 29, 'July', 2015, 'UNLOAD TRIPLE', '20750', '', '29', '28', 0, '28.60', 'ARVY', '', 1, 7),
(256, 49, 20, 'July', 2015, '', '', '', '7', '', 0, '', '', '', 0, 7),
(257, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(258, 49, 30, 'July', 2015, 'UNDER REPAIR', '0', '', '17', '17', 0, '28.00', '', '', 1, 7),
(259, 49, 25, 'July', 2015, 'OFF - GREASING', '0', '', '20', '20', 0, '28.00', '', '', 1, 7),
(260, 49, 16, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 0, 7),
(261, 49, 26, 'July', 2015, '', '', '', '20', '', 0, '', '', '', 1, 7),
(262, 49, 24, 'July', 2015, '', '', '', '22', '', 0, '', '', '', 1, 7),
(263, 49, 12, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(264, 68, 3, 'July', 2015, 'SEMI', '3650', '', '28', '23', 0, '28.60', 'ROD', '', 1, 7),
(265, 68, 4, 'July', 2015, '', '', '', '23', '', 0, '', '', '', 1, 7),
(266, 68, 5, 'July', 2015, '', '', '', '23', '', 0, '', '', '', 0, 7),
(267, 68, 8, 'July', 2015, 'UNLOAD AMCOR', '10190', '', '16', '15', 25, '28.60', 'ARVY', '', 1, 7),
(268, 68, 12, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'RYAN ', '', 1, 7),
(269, 68, 29, 'July', 2015, 'UNLOAD TRIPLE', '20750', '', '29', '28', 0, '28.60', 'ARVY', '', 1, 7),
(270, 68, 10, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '18', '17', 27, '28.60', 'ROD', '', 1, 7),
(271, 68, 12, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'RYAN ', '', 1, 7),
(272, 68, 13, 'July', 2015, 'UNLOAD AMCOR', '14920', '', '18', '17', 24, '28.60', 'RYAN ', '', 1, 7),
(273, 68, 15, 'July', 2015, 'UNLOAD AMCOR', '12763', '', '19', '18', 25, '28.60', 'ARVY', '', 1, 7),
(274, 68, 17, 'July', 2015, 'HOLIDAY', '0', '', '24', '24', 0, '28.60', '', '', 1, 7),
(275, 68, 20, 'July', 2015, '', '', '', '23', '', 0, '', '', '', 0, 7),
(276, 68, 23, 'July', 2015, 'MANILA BULLETIN', '7470', 'CHARGE TO SAUYO', '48', '27', 0, '26.60', 'ARVY', '', 1, 7),
(280, 68, 30, 'July', 2015, 'UNDER REPAIR', '0', '', '28', '28', 0, '', '', '', 1, 7),
(281, 68, 31, 'July', 2015, 'UNDER REPAIR', '0', '', '28', '28', 0, '', '', '', 1, 7),
(282, 68, 32, 'July', 2015, '', '', '', '28', '', 0, '', '', '', 1, 7),
(283, 68, 33, 'July', 2015, '', '', '', '28', '', 0, '', '', '', 0, 7),
(379, 49, 24, 'July', 2015, '', '', '', '22', '', 0, '', '', '', 1, 7),
(377, 49, 22, 'July', 2015, 'WH TO RMD', '2564', '', '7', '7', 0, '28.00', '', '', 1, 7),
(284, 49, 24, 'July', 2015, '', '', '', '22', '', 0, '', '', '', 1, 7),
(285, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(286, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(287, 49, 6, 'July', 2015, 'SM CLARK-HYPER', '1500', 'AS PER CREW,HIGH CONSUMP DUE TO TRRAFFIC', '16', '11', 0, '28.60', 'RYAN ', '', 1, 7),
(288, 68, 4, 'August', 2015, 'TRIPLE DRAGON', '0', '', '20', '18', 0, '28.60', '', '', 1, 8),
(289, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(290, 68, 6, 'August', 2015, 'ROLYO /MARVILLE', '0', '', '61', '40', 0, '28.60', '', '', 1, 8),
(291, 68, 7, 'August', 2015, '', '', '', '40', '', 0, '', '', '', 1, 8),
(292, 48, 4, 'August', 2015, 'SM CLARK-HYPER', '0', '', '9', '21', 23, '39.84', '', '', 1, 8),
(293, 48, 5, 'August', 2015, 'SEMI', '0', '', '44', '19', 0, '28.60', '', '', 1, 8),
(294, 48, 6, 'August', 2015, 'WIDUS', '0', '', '19', '0', 0, '28.60', '', '', 1, 8),
(295, 49, 5, 'August', 2015, 'UNDER REPAIR', '0', 'GEARBOX LEAK - NEED TO OPEN', '0', '0', 0, '28.60', '', '', 1, 8),
(296, 49, 6, 'August', 2015, 'UNDER REPAIR', '0', 'DID NOT REPAIR IMMEDIATELY AS JOHN ASSIST KUYA WIN ON RBW & RCS REPAIR', '0', '0', 0, '28.60', '', '', 1, 8),
(297, 49, 7, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(298, 48, 6, 'August', 2015, 'WIDUS', '0', '', '19', '0', 0, '28.60', '', '', 1, 8),
(299, 48, 7, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(300, 48, 1, 'August', 2015, 'SM CLARK', '0', '', '0', '0', 0, '', '', '', 1, 8),
(301, 48, 2, 'August', 2015, 'SUNDAY', '0', '', '0', '0', 0, '', '', '', 1, 8),
(302, 48, 3, 'August', 2015, 'SEMI', '0', '', '11', '9', 0, '28.60', 'RODNEY', 'REYMON', 1, 8),
(303, 49, 3, 'August', 2015, 'WH TO RMD', '0', '', '0', '0', 0, '', '', '', 1, 8),
(304, 49, 4, 'August', 2015, 'NO TRIP', '0', '?????', '0', '0', 0, '', '', '', 1, 8),
(305, 49, 4, 'August', 2015, 'NO TRIP', '0', '?????', '0', '0', 0, '', '', '', 1, 8),
(306, 49, 5, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(307, 49, 6, 'August', 2015, 'UNDER REPAIR', '0', 'DID NOT REPAIR IMMEDIATELY AS JOHN ASSIST KUYA WIN ON RBW & RCS REPAIR', '0', '0', 0, '28.60', '', '', 1, 8),
(308, 49, 6, 'August', 2015, 'UNDER REPAIR', '0', 'DID NOT REPAIR IMMEDIATELY AS JOHN ASSIST KUYA WIN ON RBW & RCS REPAIR', '0', '0', 0, '28.60', '', '', 1, 8),
(309, 48, 4, 'August', 2015, 'SM CLARK-HYPER', '0', '', '9', '21', 23, '39.84', '', '', 1, 8),
(310, 48, 4, 'August', 2015, 'SM CLARK-HYPER', '0', '', '9', '21', 23, '39.84', '', '', 1, 8),
(311, 48, 4, 'August', 2015, 'SM CLARK-HYPER', '0', '', '9', '21', 23, '39.84', '', '', 1, 8),
(312, 48, 5, 'August', 2015, 'SEMI', '0', '', '44', '19', 0, '28.60', '', '', 1, 8),
(313, 68, 3, 'August', 2015, 'SEMI', '0', '', '25', '20', 0, '28.60', '', '', 1, 8),
(314, 68, 4, 'August', 2015, 'TRIPLE DRAGON', '0', '', '20', '18', 0, '28.60', '', '', 1, 8),
(315, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(316, 68, 2, 'August', 2015, 'SUNDAY', '0', '', '0', '0', 0, '', '', '', 1, 8),
(317, 68, 3, 'August', 2015, 'SEMI', '0', '', '25', '20', 0, '28.60', '', '', 1, 8),
(318, 68, 4, 'August', 2015, 'TRIPLE DRAGON', '0', '', '20', '18', 0, '28.60', '', '', 1, 8),
(319, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(320, 48, 8, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(321, 48, 8, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(322, 68, 8, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(323, 49, 8, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(324, 49, 8, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(462, 49, 15, 'August', 2015, 'AFPLAI', '0', '', '0', '0', 0, '0', 'RYAN ', 'PAULO', 1, 8),
(332, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(328, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(325, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(326, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(327, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(330, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(331, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(333, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(334, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(336, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(337, 68, 24, 'July', 2015, 'SEMI', '3840', '', '27', '23', 0, '26.60', 'ARVY', '', 1, 7),
(338, 68, 5, 'July', 2015, '', '', '', '23', '', 0, '', '', '', 0, 7),
(339, 68, 5, 'July', 2015, '', '', '', '23', '', 0, '', '', '', 0, 7),
(340, 68, 27, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '27', '26', 40, '26.60', 'ARVY', '', 1, 7),
(341, 48, 12, 'July', 2015, '', '', '', '10', '', 0, '', '', '', 0, 7),
(342, 48, 9, 'July', 2015, 'SM CLARK', '1630', '', '15', '13', 0, '26.80', 'ARVY', '', 1, 7),
(343, 48, 10, 'July', 2015, '', '', '', '13', '', 0, '', '', '', 1, 7),
(466, 49, 18, 'August', 2015, 'BALIBAGO WATERWORKS', '0', '', '0', '0', 0, '0', 'RODNEY', '', 1, 8),
(344, 48, 11, 'July', 2015, '', '', '', '13', '', 0, '', '', '', 0, 7),
(345, 48, 15, 'July', 2015, 'SEMI', '1730', '', '8', '5', 20, '28.60', '', '', 1, 7),
(346, 48, 16, 'July', 2015, 'SM CLARK-HYPER', '1250', '', '25', '23', 0, '28.60', '', '', 1, 7),
(347, 48, 17, 'July', 2015, 'GUERIZA', '1210', '', '23', '22', 0, '28.60', '', '', 1, 7),
(348, 48, 18, 'July', 2015, 'SM CLARK', '1660', '', '22', '20', 0, '28.60', '', '', 1, 7),
(349, 48, 19, 'July', 2015, '', '', '', '20', '', 0, '', '', '', 1, 7),
(350, 48, 20, 'July', 2015, '', '', '', '20', '', 0, '', '', '', 0, 7),
(351, 48, 24, 'July', 2015, 'SEMI', '2070', 'DUE TO TRAFFIC, DIESEL HIGH', '16', '12.5', 0, '28.60', '', '', 1, 7),
(352, 48, 25, 'July', 2015, 'SM CLARK-HYPER', '1620', 'DUE TO TRAFFIC AS PER CREW', '12.5', '10', 25, '28.60', '', '', 1, 7),
(353, 68, 23, 'July', 2015, 'MANILA BULLETIN', '7470', 'CHARGE TO SAUYO', '48', '27', 0, '26.60', 'ARVY', '', 1, 7),
(354, 48, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '35', '19', 0, '28.60', 'ROD', '', 1, 7),
(355, 48, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '35', '19', 0, '28.60', 'ROD', '', 1, 7),
(356, 48, 27, 'July', 2015, 'UNLOAD AMCOR', '7180', 'FOR SORTING QUALITY', '19', '19', 0, '28.60', 'ROD', '', 1, 7),
(357, 48, 29, 'July', 2015, 'SEMI', '2100', '', '17', '15', 0, '28.60', 'ROD', '', 1, 7),
(358, 68, 16, 'July', 2015, '', '', '', '43', '', 0, '', '', '', 1, 7),
(359, 68, 17, 'July', 2015, 'HOLIDAY', '0', '', '24', '24', 0, '28.60', '', '', 1, 7),
(360, 68, 23, 'July', 2015, 'MANILA BULLETIN', '7470', 'CHARGE TO SAUYO', '48', '27', 0, '26.60', 'ARVY', '', 1, 7),
(361, 48, 30, 'July', 2015, 'SM CLARK', '1460', '', '15', '13', 0, '28.60', 'ROD', '', 1, 7),
(362, 48, 31, 'July', 2015, 'SEMI', '2240', '', '13', '11', 0, '28.60', 'ROD', '', 1, 7),
(363, 48, 32, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(364, 48, 33, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 0, 7),
(365, 49, 13, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 0, 7),
(366, 49, 12, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 1, 7),
(367, 49, 13, 'July', 2015, '', '', '', '9', '', 0, '', '', '', 0, 7),
(368, 49, 12, 'July', 2015, '', '', '', '10', '', 0, '', '', '', 0, 7),
(369, 49, 5, 'July', 2015, 'SUNDAY', '0', '', '16', '16', 0, '28.60', '', '', 1, 7),
(370, 49, 6, 'July', 2015, 'SM CLARK-HYPER', '1500', 'AS PER CREW,HIGH CONSUMP DUE TO TRRAFFIC', '16', '11', 0, '28.60', 'RYAN ', '', 1, 7),
(371, 49, 7, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(372, 49, 7, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 1, 7),
(373, 49, 8, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 0, 7),
(374, 49, 8, 'July', 2015, '', '', '', '11', '', 0, '', '', '', 0, 7),
(375, 68, 19, 'July', 2015, '', '', '', '24', '', 0, '', '', '', 0, 7),
(376, 68, 19, 'July', 2015, '', '', '', '24', '', 0, '', '', '', 0, 7),
(380, 49, 25, 'July', 2015, 'OFF - GREASING', '0', '', '20', '20', 0, '28.00', '', '', 1, 7),
(381, 49, 27, 'July', 2015, 'NONE', '0', 'TME WAS USED.', '20', '20', 0, '28.00', '', '', 1, 7),
(382, 49, 29, 'July', 2015, 'TNT JSHOP                                                                                           ', '960', '', '19', '17', 0, '28.60', '', '', 1, 7),
(383, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(384, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(385, 49, 31, 'July', 2015, 'NONE', '0', 'DRIVER DEPLOYED TO TME', '17', '17', 0, '28.00', '', '', 1, 7),
(386, 49, 32, 'July', 2015, '', '', '', '17', '', 0, '', '', '', 1, 7),
(387, 49, 33, 'July', 2015, '', '', '', '17', '', 0, '', '', '', 0, 7),
(388, 68, 9, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '40', '18', 0, '28.60', 'ROD', '', 1, 7),
(389, 68, 11, 'July', 2015, '', '', '', '18', '', 0, '', '', '', 0, 7),
(390, 68, 14, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '41', '19', 0, '28.60', 'ARVY', '', 1, 7),
(391, 68, 28, 'July', 2015, 'TRIPLE DRAGON', '0', '', '40', '29', 0, '28.60', 'ARVY', '', 1, 7),
(392, 68, 25, 'July', 2015, 'OFF - GREASING', '0', '', '23', '23', 45, '26.60', '', '', 1, 7),
(393, 68, 16, 'July', 2015, '', '', '', '19', '', 0, '', '', '', 0, 7),
(394, 48, 28, 'July', 2015, '', '', '', '19', '', 0, '', '', '', 0, 7),
(396, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(395, 68, 26, 'July', 2015, 'AMCOR', '0', 'CHARGE TO CAINTA', '48', '27', 0, '28.60', '', '', 1, 7),
(397, 68, 27, 'July', 2015, 'UNLOAD AMCOR', '19500', '', '27', '26', 40, '26.60', 'ARVY', '', 1, 7),
(398, 68, 28, 'July', 2015, 'TRIPLE DRAGON', '0', '', '40', '29', 0, '28.60', 'ARVY', '', 1, 7),
(399, 68, 29, 'July', 2015, 'UNLOAD TRIPLE', '20750', '', '29', '28', 0, '28.60', 'ARVY', '', 1, 7),
(400, 68, 29, 'July', 2015, 'UNLOAD TRIPLE', '20750', '', '29', '28', 0, '28.60', 'ARVY', '', 1, 7),
(401, 68, 29, 'July', 2015, 'UNLOAD TRIPLE', '20750', '', '29', '28', 0, '28.60', 'ARVY', '', 1, 7),
(402, 68, 30, 'July', 2015, '', '', '', '28', '', 0, '', '', '', 1, 7),
(403, 68, 31, 'July', 2015, '', '', '', '28', '', 0, '', '', '', 0, 7),
(404, 67, 7, 'July', 2015, 'SAUYO', '0', 'BROUGHT CONTAINER VAN', '30', '8', 0, '0', 'ROD', 'JIMBOY', 1, 7),
(405, 67, 8, 'July', 2015, '', '', '', '8', '', 0, '', '', '', 1, 7),
(406, 67, 9, 'July', 2015, 'SEMI', '3760', '', '8', '6', 35, '0', '', '', 1, 7),
(407, 67, 9, 'July', 2015, 'SEMI', '3760', '', '8', '6', 35, '0', '', '', 1, 7),
(408, 67, 12, 'July', 2015, 'AMCOR', '12580', '', '35', '14', 50, '28.60', 'ROD', 'JOMEL', 1, 7),
(409, 67, 13, 'July', 2015, 'AMCOR', '6180', '', '50', '25', 0, '28.60', 'ROD', 'PAOLO', 1, 7),
(410, 67, 14, 'July', 2015, 'UNLOAD AMCOR', '0', '', '25', '24', 0, '0', 'ROD', 'HELPERS', 1, 7),
(411, 67, 14, 'July', 2015, 'UNLOAD AMCOR', '0', '', '25', '24', 0, '0', 'ROD', 'HELPERS', 1, 7),
(412, 67, 14, 'July', 2015, 'UNLOAD AMCOR', '0', '', '25', '24', 0, '0', 'ROD', 'HELPERS', 1, 7),
(413, 67, 14, 'July', 2015, 'UNLOAD AMCOR', '0', '', '25', '24', 0, '0', 'ROD', 'HELPERS', 1, 7),
(414, 67, 15, 'July', 2015, 'SEMI', '3340', '', '24', '20', 40, '0', 'ROD', 'JOMEL', 1, 7),
(415, 67, 11, 'July', 2015, 'WAREHOUSE', '0', '', '8', '8', 35, '28.60', 'ROD', '', 1, 7),
(416, 67, 12, 'July', 2015, 'AMCOR', '12580', '', '35', '14', 50, '28.60', 'ROD', 'JOMEL', 1, 7),
(417, 67, 13, 'July', 2015, 'AMCOR', '6180', '', '50', '25', 0, '28.60', 'ROD', 'PAOLO', 1, 7),
(418, 67, 13, 'July', 2015, 'AMCOR', '6180', '', '50', '25', 0, '28.60', 'ROD', 'PAOLO', 1, 7),
(419, 67, 14, 'July', 2015, 'UNLOAD AMCOR', '0', '', '25', '24', 0, '0', 'ROD', 'HELPERS', 1, 7),
(420, 67, 15, 'July', 2015, 'SEMI', '3340', '', '24', '20', 40, '0', 'ROD', 'JOMEL', 1, 7),
(425, 68, 3, 'July', 2015, '', '', '', '39', '', 1, '', '', '', 0, 7),
(422, 67, 17, 'July', 2015, '', '', '', '20', '', 0, '', '', '', 0, 7),
(423, 67, 16, 'July', 2015, '', '', '', '60', '', 0, '', '', '', 1, 7),
(424, 67, 17, 'July', 2015, '', '', '', '60', '', 40, '', '', '', 0, 7),
(426, 68, 3, 'July', 2015, '', '', '', '38', '', 0, '', '', '', 0, 7),
(427, 48, 12, 'August', 2015, 'SEMI', '0', '', '0', '0', 0, '28.60', 'RYAN ', 'RAYMOND', 1, 8),
(428, 48, 13, 'August', 2015, 'TNT JSHOP                                                                                           ', '1620', 'TONNAGE FOR VERIFICATION', '14', '12', 0, '28.60', 'RYAN ', 'PAOLO', 1, 8),
(429, 48, 14, 'August', 2015, 'SM CLARK-HYPER', '1390', '', '12', '10', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(430, 48, 15, 'August', 2015, 'SM CLARK-HYPER', '1300', '', '10', '8', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(431, 68, 11, 'August', 2015, 'SEMI', '0', '', '24', '19', 31, '28.60', 'RODNEY', 'NIKO', 1, 8),
(432, 68, 12, 'August', 2015, 'MANGALDAN', '18000', '', '50', '31', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(433, 68, 13, 'August', 2015, 'LUBAO', '19800', '', '31', '19', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(434, 68, 14, 'August', 2015, 'ROLYO / NOVA', '0', '', '19', '0', 0, '0', 'RODNEY', 'NIKO', 1, 8),
(435, 68, 15, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(436, 68, 16, 'August', 2015, 'CHANGE OIL', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(437, 49, 11, 'August', 2015, 'NONE', '0', 'NO DRIVER', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(438, 49, 12, 'August', 2015, 'UNLOAD SM-HYPER', '0', 'NO AVAILABLE DRIVER', '0', '0', 0, '28.60', 'ROLAND', '', 1, 8),
(439, 49, 13, 'August', 2015, 'SOTTO', '0', '', '20', '19', 0, '28.60', 'ROLAND', 'RYAN', 1, 8),
(440, 49, 10, 'August', 2015, 'SM CLARK-HYPER', '0', '', '20', '0', 0, '28.60', 'RYAN ', 'REIMON', 1, 8),
(441, 49, 11, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(442, 49, 12, 'August', 2015, 'UNLOAD SM-HYPER', '0', 'NO AVAILABLE DRIVER', '0', '0', 0, '28.60', 'ROLAND', '', 1, 8),
(443, 49, 12, 'August', 2015, 'UNLOAD SM-HYPER', '0', 'NO AVAILABLE DRIVER', '0', '0', 0, '28.60', 'ROLAND', '', 1, 8),
(444, 49, 14, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 1, 8),
(445, 48, 5, 'August', 2015, 'SEMI', '0', '', '44', '19', 0, '28.60', '', '', 1, 8),
(446, 48, 6, 'August', 2015, '', '', '', '19', '', 23, '', '', '', 1, 8),
(447, 48, 7, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 0, 8),
(448, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(449, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(450, 68, 5, 'August', 2015, 'SEMI', '0', '', '18', '11', 50, '28.60', '', '', 1, 8),
(451, 68, 6, 'August', 2015, 'ROLYO /MARVILLE', '0', '', '61', '40', 0, '28.60', '', '', 1, 8),
(452, 68, 7, 'August', 2015, '', '', '', '40', '', 0, '', '', '', 1, 8),
(453, 68, 8, 'August', 2015, '', '', '', '90', '', 50, '', '', '', 0, 8),
(454, 68, 8, 'August', 2015, '', '', '', '90', '', 50, '', '', '', 0, 8),
(455, 68, 8, 'August', 2015, '', '', '', '61', '', 50, '', '', '', 0, 8),
(456, 68, 7, 'August', 2015, '', '', '', '40', '', 50, '', '', '', 1, 8),
(457, 68, 8, 'August', 2015, '', '', '', '40', '', 0, '', '', '', 0, 8),
(458, 68, 16, 'August', 2015, 'CHANGE OIL', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(459, 68, 16, 'August', 2015, 'CHANGE OIL', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(460, 68, 16, 'August', 2015, 'CHANGE OIL', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(461, 68, 16, 'August', 2015, 'CHANGE OIL', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(471, 49, 18, 'August', 2015, 'BALIBAGO WATERWORKS', '0', '', '0', '0', 0, '0', 'RODNEY', '', 1, 8),
(472, 49, 20, 'August', 2015, '', '', '', '9', '', 0, '', '', '', 1, 8),
(473, 49, 21, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(474, 49, 17, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(475, 48, 17, 'August', 2015, 'SM CLARK-HYPER', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(476, 48, 18, 'August', 2015, 'SJSR - AMOR SUMAYOD', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(477, 48, 19, 'August', 2015, 'SEMI', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(478, 48, 16, 'August', 2015, 'SUNDAY', '0', '', '8', '0', 0, '0', '0', '', 1, 8),
(479, 48, 16, 'August', 2015, 'SUNDAY', '0', '', '8', '0', 0, '0', '0', '', 1, 8),
(480, 48, 20, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(481, 48, 16, 'August', 2015, 'SUNDAY', '0', '', '8', '0', 0, '0', '0', '', 1, 8),
(482, 48, 16, 'August', 2015, 'SUNDAY', '0', '', '8', '0', 0, '0', '0', '', 1, 8),
(483, 48, 21, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(484, 48, 18, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(485, 48, 19, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(486, 68, 17, 'August', 2015, 'MANGALDAN', '0', '', '0', '0', 0, '28.60', 'ARVY', '', 1, 8),
(487, 68, 18, 'August', 2015, 'LUBAO', '0', '', '0', '0', 0, '28.60', 'RYAN ', '', 1, 8),
(488, 68, 19, 'August', 2015, 'SEMI', '0', '', '0', '0', 0, '28.60', 'RODNEY', '', 1, 8),
(489, 68, 20, 'August', 2015, 'MANGALDAN', '0', '', '0', '0', 0, '28.60', 'RODNEY', '', 1, 8),
(490, 68, 21, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 1, 8),
(491, 68, 22, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(492, 49, 17, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(493, 49, 21, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(494, 48, 17, 'August', 2015, '', '', '', '8', '', 0, '', '', '', 0, 8),
(495, 48, 16, 'August', 2015, '', '', '', '10', '', 0, '', '', '', 0, 8),
(496, 48, 15, 'August', 2015, '', '', '', '12', '', 0, '', '', '', 0, 8),
(497, 48, 15, 'August', 2015, '', '', '', '12', '', 0, '', '', '', 0, 8),
(498, 68, 15, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 0, 8),
(500, 68, 13, 'August', 2015, 'LUBAO', '19800', '', '31', '19', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(499, 68, 13, 'August', 2015, 'LUBAO', '19800', '', '31', '19', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(501, 68, 13, 'August', 2015, 'LUBAO', '19800', '', '31', '19', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(502, 68, 14, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 1, 8),
(503, 68, 13, 'August', 2015, 'LUBAO', '19800', '', '31', '19', 0, '28.60', 'RODNEY', 'NIKO', 1, 8),
(504, 68, 14, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 1, 8),
(505, 68, 15, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 0, 8),
(506, 68, 14, 'August', 2015, '', '', '', '31', '', 0, '', '', '', 0, 8),
(507, 49, 21, 'August', 2015, '', '', '', '9', '', 0, '', '', '', 0, 8),
(508, 49, 15, 'August', 2015, '', '', '', '19', '', 0, '', '', '', 0, 8),
(509, 49, 12, 'August', 2015, '', '', '', '0', '', 0, '', '', '', 0, 8),
(510, 69, 19, 'August', 2015, 'SM/HYPER', '1011', '', '7', '17', 0, 'NIKO', '', '', 1, 8),
(511, 69, 20, 'August', 2015, '', '', '', '17', '', 0, '', '', '', 1, 0),
(512, 69, 21, 'August', 2015, '', '', '', '17', '', 0, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truckbattery`
--

CREATE TABLE IF NOT EXISTS `tbl_truckbattery` (
  `bid` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `batteryname` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `addedby` varchar(100) NOT NULL,
  `reassign` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_truckbattery`
--

INSERT INTO `tbl_truckbattery` (`bid`, `truckid`, `batteryname`, `qty`, `dateadded`, `addedby`, `reassign`, `sold`, `description`) VALUES
(1, 67, '2D MOTOLITE', '1', '08-12-2015', 'Niño_PAM', 0, 0, 'PVS-222719725'),
(2, 68, 'OUTLAST PREMIUM', '1', '08-12-2015', 'Niño_PAM', 0, 0, 'N120');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truckdeedofsale`
--

CREATE TABLE IF NOT EXISTS `tbl_truckdeedofsale` (
  `dosid` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `updateby` varchar(100) NOT NULL,
  PRIMARY KEY  (`dosid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_truckdeedofsale`
--

INSERT INTO `tbl_truckdeedofsale` (`dosid`, `truckid`, `location`, `date`, `updateby`) VALUES
(10, 10, 'crx935.jpg', '', ''),
(11, 11, '', '', ''),
(12, 12, '', '', ''),
(13, 13, 'xgw541.jpg', '', ''),
(14, 14, '', '', ''),
(15, 15, '', '', ''),
(16, 16, '', '', ''),
(17, 17, '', '', ''),
(18, 18, 'xlr382.jpg', '', ''),
(19, 19, '', '', ''),
(20, 20, 'rdt853.jpg', '', ''),
(21, 21, 'ctb349.jpg', '', ''),
(22, 22, '', '', ''),
(23, 23, '', '', ''),
(24, 24, '', '', ''),
(25, 25, 'vbp369.jpg', '', ''),
(26, 26, 'xat579.jpg', '', ''),
(27, 27, '', '', ''),
(28, 28, '', '', ''),
(29, 29, '', '', ''),
(30, 30, 'udg461.jpg', '', ''),
(31, 31, '', '', ''),
(32, 32, '', '', ''),
(33, 33, '', '', ''),
(34, 34, 'xgn579.jpg', '', ''),
(35, 35, 'ret848.jpg', '', ''),
(36, 36, 'wlm120.jpg', '', ''),
(37, 37, '', '', ''),
(38, 38, 'rkg74.jpg', '', ''),
(39, 39, 'rjg813.jpg', '', ''),
(41, 41, 'rdl191.jpg', '', ''),
(42, 42, 'rjx423.jpg', '', ''),
(43, 43, '', '', ''),
(44, 44, 'umz414.jpg', '', ''),
(45, 45, '', '', ''),
(46, 46, '', '', ''),
(47, 47, 'rbw685.jpg', '', ''),
(48, 48, 'usa475.jpg', '', ''),
(49, 49, '', '', ''),
(50, 50, 'zrr766.jpg', '', ''),
(51, 51, '', '', ''),
(52, 52, '', '', ''),
(53, 53, '', '', ''),
(54, 54, 'zjt358.jpg', '', ''),
(55, 55, '', '', ''),
(56, 56, 'csl918.jpg', '', ''),
(57, 57, 'rek528.jpg', '', ''),
(58, 58, '', '', ''),
(59, 59, 'xfu503.jpg', '', ''),
(60, 64, 'zfe548.jpg', '', ''),
(61, 65, '3138dp.jpg', '', ''),
(62, 66, 'ttz799.jpg', '', ''),
(63, 67, '', '', ''),
(64, 68, '', '', ''),
(65, 69, '', '', ''),
(66, 70, 'wpt720.jpg', '', ''),
(67, 71, '', '', ''),
(68, 72, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truckimage`
--

CREATE TABLE IF NOT EXISTS `tbl_truckimage` (
  `id` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_truckimage`
--

INSERT INTO `tbl_truckimage` (`id`, `truckid`, `name`) VALUES
(5, 56, 'csl918_1.jpg'),
(6, 56, 'csl918_2.jpg'),
(7, 68, 'rcs739_3.jpg'),
(8, 68, 'rcs739_2.jpg'),
(9, 68, 'rcs739_1.jpg'),
(10, 37, 'wlm573_2.jpg'),
(11, 37, 'wlm573_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truckorcr`
--

CREATE TABLE IF NOT EXISTS `tbl_truckorcr` (
  `orcrid` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `uploadby` varchar(100) NOT NULL,
  PRIMARY KEY  (`orcrid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_truckorcr`
--

INSERT INTO `tbl_truckorcr` (`orcrid`, `truckid`, `location`, `date`, `uploadby`) VALUES
(10, 10, 'crx935.jpg', '', ''),
(11, 11, 'uds301.jpg', '', ''),
(12, 12, '', '', ''),
(13, 13, 'xgw541.jpg', '', ''),
(14, 14, 'zld 541.jpg', '', ''),
(15, 15, 'uuc602.jpg', '', ''),
(16, 16, 'zcd502.jpg', '', ''),
(17, 17, 'xcn302.jpg', '', ''),
(18, 18, 'xlr382.jpg', '', ''),
(19, 19, '', '', ''),
(20, 20, 'rdt853.jpg', '', ''),
(21, 21, 'ctb349.jpg', '', ''),
(22, 22, 'wlj507.jpg', '', ''),
(23, 23, '', '', ''),
(24, 24, 'xlj320.jpg', '', ''),
(25, 25, 'vbp369.jpg', '', ''),
(26, 26, 'xat579.jpg', '', ''),
(27, 27, 'wgg163.jpg', '', ''),
(28, 28, 'rct378.jpg', '', ''),
(29, 29, 'wsn984.jpg', '', ''),
(30, 30, 'udg461.jpg', '', ''),
(31, 31, 'whw414.jpg', '', ''),
(32, 32, '', '', ''),
(33, 33, '', '', ''),
(34, 34, 'xgn579.jpg', '', ''),
(35, 35, 'ret15.jpg', '', ''),
(36, 36, 'wlm120.jpg', '', ''),
(37, 37, 'wlm573.jpg', '', ''),
(38, 38, 'rkg743.jpg', '', ''),
(39, 39, 'rjg813.jpg', '', ''),
(41, 41, 'rdl191.jpg', '', ''),
(42, 42, 'rjx423.jpg', '', ''),
(43, 43, '', '', ''),
(44, 44, 'umz414.jpg', '', ''),
(45, 45, '', '', ''),
(46, 46, '9974oe.jpg', '', ''),
(47, 47, 'rbw685.jpg', '', ''),
(48, 48, 'usa475.jpg', '', ''),
(49, 49, 'wjp755.jpg', '', ''),
(50, 50, 'zrr776.jpg', '', ''),
(51, 51, 'xsa916.jpg', '', ''),
(52, 52, '', '', ''),
(53, 53, '2987um.jpg', '', ''),
(54, 54, '002.jpg', '', ''),
(55, 55, '', '', ''),
(56, 56, '001.jpg', '', ''),
(57, 57, 'rek.jpg', '', ''),
(58, 58, '', '', ''),
(59, 59, 'xfu503.jpg', '', ''),
(60, 64, 'zfe.jpg', '', ''),
(61, 65, '003.jpg', '', ''),
(62, 66, 'ttz799.jpg', '', ''),
(63, 67, '', '', ''),
(64, 68, '', '', ''),
(65, 69, '', '', ''),
(66, 70, 'wpt720.jpg', '', ''),
(67, 71, '7840uk.jpg', '', ''),
(68, 72, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truckregistration`
--

CREATE TABLE IF NOT EXISTS `tbl_truckregistration` (
  `regid` int(11) NOT NULL auto_increment,
  `truckid` int(11) NOT NULL,
  `insurance` varchar(100) NOT NULL,
  `stencil` varchar(100) NOT NULL,
  `emission` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `year` varchar(100) NOT NULL,
  PRIMARY KEY  (`regid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_truckregistration`
--

INSERT INTO `tbl_truckregistration` (`regid`, `truckid`, `insurance`, `stencil`, `emission`, `location`, `remarks`, `status`, `year`) VALUES
(10, 10, 'OK', 'OK', 'OK', 'LTO DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(11, 11, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAIALABLE', 1, '2015'),
(12, 12, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(13, 13, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(14, 14, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(15, 15, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(16, 16, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(17, 17, 'OK', 'OK', 'OK', 'DAU', 'NOT INDICATED NSA,\nNO DEED OF SALE', 1, '2015'),
(18, 18, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(19, 19, 'OK', 'OK', 'OK', 'PALAYAN', 'NO STICKER AVAILABLE, NO DEED OF SALE', 1, '2015'),
(20, 20, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE,\r\nNO DEED OF SALE', 1, '2015'),
(21, 21, 'OK', 'OK', 'OK', 'DAu', ' ', 1, '2015'),
(22, 22, 'OK', 'OK', 'OK', 'DAU', '', 1, '2015'),
(23, 23, '', '', '', '', '', 0, ''),
(24, 24, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1, '2015'),
(25, 25, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1, '2015'),
(26, 26, 'OK', 'OK', 'OK', 'DAU', ' ', 1, '2015'),
(27, 27, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(28, 28, '', '', '', '', '', 0, ''),
(29, 29, 'OK', 'OK', 'OK', ' ', 'NO DEED OF SALE', 1, '2015'),
(30, 30, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVIALABLE', 1, '2015'),
(31, 31, 'OK', 'OK', 'OK', ' ', ' ', 1, '2015'),
(32, 32, '', '', '', '', '', 0, ''),
(68, 72, '', '', '', '', '', 0, ''),
(33, 33, '', '', '', '', '', 0, ''),
(34, 34, 'OK', 'OK', 'OK', 'DAU', ' ', 1, '2015'),
(35, 35, 'OK', 'OK', 'OK', '', 'ON HAND\r\n', 1, '2015'),
(36, 36, '', 'OK', 'OK', '', '', 0, ''),
(37, 37, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(38, 38, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE, DEED OF SALE LLR TO EFI', 1, '2015'),
(39, 39, 'OK', 'OK', 'OK', 'PALAYAN', 'NO STICKER AVAILABLE', 1, '2015'),
(41, 41, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1, '2015'),
(42, 42, 'OK', 'OK', 'OK', 'DAu', 'NO STICKER AVAILABLE', 1, '2015'),
(43, 43, 'OK', '', '', '', '', 0, ''),
(44, 44, 'OK', 'OK', 'OK', ' ', ' ', 1, '2015'),
(45, 45, 'OK', 'OK', 'OK', ' ', 'OR/CR IS AT LTO', 1, '2015'),
(46, 46, 'OK', 'OK', 'OK', ' ', ' ', 1, '2015'),
(47, 47, 'OK', 'OK', 'OK', 'PALAYAN', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1, '2015'),
(48, 48, 'OK', 'OK', 'OK', 'DAU', ' ', 1, '2015'),
(49, 49, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1, '2015'),
(50, 50, 'OK', 'OK', 'OK', 'DAU', ' ', 1, '2015'),
(51, 51, 'OK', 'OK', 'OK', 'DAU', ' ', 1, '2015'),
(52, 52, 'OK', 'OK', 'OK', 'LTO CABANATUAN', '', 1, '2015'),
(53, 53, 'OK', 'OK', 'OK', '', '', 1, '2015'),
(54, 54, 'OK', 'OK', 'OK', '', 'ON HAND', 1, '2015'),
(55, 55, '', '', '', '', '', 0, ''),
(56, 56, 'OK', 'OK', 'OK', '', 'ON HAND', 1, '2015'),
(57, 57, 'OK', 'OK', 'OK', '', 'ON HAND', 1, '2015'),
(58, 58, '', '', '', '', '', 0, ''),
(59, 59, '', '', '', '', '', 0, ''),
(60, 64, 'OK', 'OK', 'OK', '', 'ON HAND', 1, '2015'),
(61, 65, 'OK', 'OK', 'OK', '', 'ON HAND', 1, '2015'),
(62, 66, '', '', '', '', '', 0, ''),
(63, 67, '', '', '', '', '', 0, ''),
(64, 68, '', '', '', '', '', 0, ''),
(65, 69, '', '', '', '', '', 0, ''),
(66, 70, '', '', '', '', '', 0, ''),
(67, 71, '', '', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trucktires`
--

CREATE TABLE IF NOT EXISTS `tbl_trucktires` (
  `id` int(11) NOT NULL auto_increment,
  `tireid` int(100) NOT NULL,
  `truckplate` varchar(100) NOT NULL,
  `tirename` varchar(100) NOT NULL,
  `tiresize` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `addedby` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tbl_trucktires`
--

INSERT INTO `tbl_trucktires` (`id`, `tireid`, `truckplate`, `tirename`, `tiresize`, `description`, `dateadded`, `addedby`, `position`, `status`) VALUES
(25, 1, '20', 'MRF  NYLON', 'RDT - 853', '26199521914', '2014-07-21', 'Niño_PAM', '1', 'In Used'),
(24, 6, '44', 'MRF', 'UMZ 7-20-11', '30146685181', '2011-07-20', 'Niño_PAM', '6', 'In Used'),
(23, 5, '44', 'MRF', 'UMZ 7-20-11', '30146685181', '2011-07-20', 'Niño_PAM', '5', 'In Used'),
(22, 4, '44', 'MRF', 'UMZ 4-4-13', '3029210213', '2013-04-04', 'Niño_PAM', '4', 'In Used'),
(21, 3, '44', 'MRF', 'UMZ 4-4-13', '30279825212', '2013-04-04', 'Niño_PAM', '3', 'In Used'),
(20, 2, '44', 'MRF', 'UMZ 7-12-12', '66244631312', '2012-07-12', 'Niño_PAM', '2', 'In Used'),
(19, 1, '44', 'MRF', 'UMZ-7-12-12', '6625367811', '2012-07-12', 'Niño_PAM', '1', 'In Used'),
(26, 2, '20', 'MRF  NYLON', 'RDT - 853', '26199521014', '2014-07-21', 'Niño_PAM', '2', 'In Used'),
(27, 6, '20', 'MRF  NYLON', 'RDT - 853', '26002071114', '2014-07-21', 'Niño_PAM', '6', 'In Used'),
(28, 5, '20', 'MRF  NYLON', 'RDT - 853', '26203791914', '2014-07-21', 'Niño_PAM', '5', 'In Used'),
(29, 1, '68', 'BRIGDESTONE', 'RCS 8-6-13', '0', '2013-08-16', 'Niño_PAM', '1', 'In Used'),
(30, 2, '68', 'BRIGDESTONE', 'RCS 8-6-13', '0', '2013-08-06', 'Niño_PAM', '2', 'In Used'),
(31, 3, '68', 'BRIGDESTONE RADIAL', 'RCS 5-6-15', '146/143', '2015-05-06', 'Niño_PAM', '3', 'In Used'),
(32, 4, '68', 'BRIGDESTONE RADIAL', 'RCS 5-6-15', '146/143', '2013-05-06', 'Niño_PAM', '4', 'In Used'),
(33, 5, '68', 'BRIGDESTONE RADIAL', 'RCS 5-6-15', '146/143', '2015-05-06', 'Niño_PAM', '5', 'In Used'),
(34, 6, '68', 'BRIGDESTONE RADIAL', 'RCS 5-6-15', '146/143', '2015-05-06', 'Niño_PAM', '6', 'In Used'),
(35, 7, '68', 'BRIGDESTONE', 'RCS 9-6-13', '3CY4413', '2013-09-06', 'Niño_PAM', '7', 'In Used'),
(36, 8, '68', 'BRIGDESTONE', 'RCS 9-20-13', '0', '2013-09-20', 'Niño_PAM', '8', 'In Used'),
(37, 9, '68', 'BRIGDESTONE', 'RCS 9-6-13', '3CY4412', '2013-09-06', 'Niño_PAM', '9', 'In Used'),
(38, 10, '68', 'BRIGDESTONE', 'RCS 9-20-13', '0', '2013-09-20', 'Niño_PAM', '10', 'In Used'),
(39, 1, '67', 'BRIGDESTONE', 'REX 11-11-12', '66352643813', '2012-11-11', 'Niño_PAM', '1', 'In Used'),
(40, 2, '67', 'BRIGDESTONE', 'REX 11-11-12', '63526438132', '2012-11-11', 'Niño_PAM', '2', 'In Used'),
(41, 3, '67', 'BRIGDESTONE', 'REX 1-2-14', 'Y3832505', '2014-01-02', 'Niño_PAM', '3', 'In Used'),
(42, 4, '67', 'BRIGDESTONE', 'REX 1-2-14', '0', '2014-01-02', 'Niño_PAM', '4', 'In Used'),
(43, 5, '67', 'BRIGDESTONE', 'REX 1-27-14', 'Y2K209670', '2014-01-27', 'Niño_PAM', '5', 'In Used'),
(44, 6, '67', 'BRIGDESTONE', 'REX 1-27-14', 'Y2K219188', '2014-01-27', 'Niño_PAM', '6', 'In Used'),
(45, 10, '67', 'BRIGDESTONE', 'REX 3-18-13', '0', '2013-03-18', 'Niño_PAM', '10', 'In Used'),
(46, 9, '67', 'BRIGDESTONE', 'REX 3-18-13', '0', '2013-03-18', 'Niño_PAM', '9', 'In Used'),
(47, 8, '67', 'BRIGDESTONE', 'REX 3-18-13', '0', '2013-03-18', 'Niño_PAM', '8', 'In Used'),
(48, 7, '67', 'BRIGDESTONE', 'REX 3-18-13', '0', '2013-03-18', 'Niño_PAM', '7', 'In Used');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trucktools`
--

CREATE TABLE IF NOT EXISTS `tbl_trucktools` (
  `ti` int(11) NOT NULL auto_increment,
  `truckid` varchar(100) NOT NULL,
  `toolname` varchar(100) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `reassign` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `encodeby` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  PRIMARY KEY  (`ti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_trucktools`
--

INSERT INTO `tbl_trucktools` (`ti`, `truckid`, `toolname`, `dateadded`, `qty`, `reassign`, `sold`, `encodeby`, `remarks`) VALUES
(1, '68', 'COMBINATION WRENCH 10', '07-08-2015', '1', 0, 0, '', ''),
(2, '68', 'DO BUT 8', '07-08-2015', '1', 0, 0, '', ''),
(3, '68', 'DO BUT 10', '07-08-2015', '1', 0, 0, '', ''),
(4, '68', 'DO BUT 11', '07-08-2015', '1', 0, 0, '', ''),
(5, '68', 'DO BUT 12', '07-08-2015', '1', 0, 0, '', ''),
(6, '68', 'DO BUT 13', '07-08-2015', '1', 0, 0, '', ''),
(7, '68', 'DO BUT 14', '07-08-2015', '1', 0, 0, '', ''),
(8, '68', 'DO BUT 19', '07-08-2015', '1', 0, 0, '', ''),
(9, '68', 'DO BUT 22', '07-08-2015', '1', 0, 0, '', ''),
(10, '68', 'DO BUT 24', '07-08-2015', '1', 0, 0, '', ''),
(11, '68', 'VICE GRIP', '07-08-2015', '1', 0, 0, '', ''),
(12, '68', 'PHILIPS SREW', '07-08-2015', '1', 0, 0, '', ''),
(13, '68', 'SCREW DRIVER', '07-08-2015', '1', 0, 0, '', ''),
(14, '68', 'PLIERS', '07-08-2015', '1', 0, 0, '', ''),
(15, '24', 'SAMPLE', '08-10-2015', '2', 0, 0, '', 'SAMLPE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_truck_report`
--

CREATE TABLE IF NOT EXISTS `tbl_truck_report` (
  `id` int(11) NOT NULL auto_increment,
  `branch` varchar(100) NOT NULL,
  `ownersname` varchar(100) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `truckplate` varchar(100) NOT NULL,
  `ending` varchar(50) NOT NULL,
  `make` varchar(100) NOT NULL,
  `series` varchar(100) NOT NULL,
  `bodytype` varchar(100) NOT NULL,
  `yearmodel` varchar(100) NOT NULL,
  `aquisitioncost` varchar(100) NOT NULL,
  `netbookvalue` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `truckcondition` varchar(100) NOT NULL,
  `dateadded` varchar(50) NOT NULL,
  `wheels` varchar(100) NOT NULL,
  `oil` varchar(100) NOT NULL,
  `repair` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `truckplate` (`truckplate`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `tbl_truck_report`
--

INSERT INTO `tbl_truck_report` (`id`, `branch`, `ownersname`, `suppliername`, `truckplate`, `ending`, `make`, `series`, `bodytype`, `yearmodel`, `aquisitioncost`, `netbookvalue`, `amount`, `truckcondition`, `dateadded`, `wheels`, `oil`, `repair`) VALUES
(10, 'PAMPANGA', 'ENVIROCYCLING FIBER INC.,', 'TISOY', 'CRX 935', '5', 'ISUZU', 'ELF', 'DROPSIDE WITH GRILLS', '1997', '220000', '11000', '360000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(11, 'SAUYO', 'HAKOT PAPAEL CORPORATION', '', 'UDS 301', '1', 'ISUZU', 'NI', 'DROPSIDE PICKUP', '1986', '175000', '32083', '220000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(12, 'MANGALDAN', 'LUISITIO PISCASIO', 'ALEX JUNKSHOP', 'XBS 671', '1', 'ISUZU', 'ELF', 'DROPSIDE', '2002', '405130', '324104', '405130', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(13, 'PASAY', 'ENVIROCYCLING FIBER INC', '	FJ PRAXIDIO	', 'XGW 541', '1', 'ISUZU', 'ELF WITH CANOPY', 'DROPSIDE', '', '315000', '', '31500', '', '2015-07-04', '4', '', ''),
(14, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'ZDL 541', '1', 'ISUZU', 'ELF', 'DROPSIDE', '2006', '419545', '419545', '430000', '', '2015-07-04', '4', '', ''),
(15, 'CAINTA', 'HP TRADING', '', 'UUC 602', '2', 'ISUZU', 'ELF', 'ALUMINUM VAN', '', '207500', '', '100000', '', '2015-07-04', '4', '', ''),
(16, 'SAUYO', 'HAKOT PAPEL CORPORATION', '', 'ZCD 502', '2', 'ISUZU', 'ELF', 'CLOSE VAN', '2001', '220000', '66000', '330000', '', '2015-07-04', '4', '', ''),
(17, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'XCN 302', '2', 'ISUZU', 'DROPSIDE', 'DROPSIDE', '2002', '430674', '43674', '500000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(18, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'XLR 382', '2', 'ISUZU', 'CHICKEN CAGE', 'DROPSIDE WITH STAKE', '2004', '304500', '81200', '400000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(19, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'REH 712', '2', 'FUSO', 'WITH HANGER BODY', 'CANOPY', '1995', '417670', '327175', '330000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(20, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RDT 853', '3', 'ISUZU', 'FORWARD', 'DROPSIDE WITH GRILLS', '1991', '535000', '', '600000', 'GOOD CONDITION', '2015-07-04', '6', '', ''),
(21, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'CTB 349', '4', 'ISUZU', 'FORWARD', 'DROPSIDE', '2003', '460000', '', '550000', '', '2015-07-04', '6', '', ''),
(22, 'CAINTA', 'LUISA LORAN REGALA', '', 'WLJ 507', '7', 'ISUZU', 'ELF', 'DROPSIDE', '1998', '330000', '77000', '380000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(24, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'XLJ 320', '0', 'ISUZU', 'NPR', 'DROPSIDE', '19991', '370000', '370000', '380000', 'GOOD CONDITION', '2015-07-04', '4', '2015-04-23', ''),
(25, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'VBP 369', '9', 'ISUZU', 'ELF WITH STAKE', 'DROPSIDE', '2002', '351102', '351102', '380000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(26, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'XAT 579', '9', 'ISUZU', 'ELF', 'DROPSIDE', '1989', '320000', '117333', '370000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(27, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'WGG 163', '3', 'ISUZU', 'ELF', 'DROPSIDE WITH CANOPY', '1988', '476360', '476360', '450000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(28, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'RCT 378', '8', 'ISUZU', 'ELF', 'DORPSIDE', '1991', '380000', '380000', '400000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(29, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'WSN 984', '4', 'ISUZU', 'ELF', 'STAKE WITH CANOPY', '1990', '417926', '417926', '430000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(30, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'UDG 461', '1', 'ISUZU', '', 'OPEN TOP VAN', '1987', '220000', '66000', '100000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(31, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'WHW 414', '4', 'MITSUBISHI FUSO', '', 'DROPSIDE WITH CANOPY', '2000', '375000', '', '440000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(32, 'CAINTA', 'CATALINO TIONGSON II', 'ANALIE TRADING', 'XAT 446', '6', 'ISUZU', 'ELF', 'ALUMINUM VAN', '', '415250', '', '400000', 'TRUCK NOT RUNNING', '2015-07-04', '4', '', ''),
(33, 'KAYBIGA', 'RECYCLEAN FOUNDATION', '', 'RFZ 678', '8', 'ISUZU', 'ELF', 'WING VAN', '1992', '253730', '238929', '430000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(34, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'JD SCRAP PAPER', 'XGN 579', '9', 'ISUZU', 'ELF', 'DROPSIDE WITH CANOPY', '2003', '320000', '117333', '380000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(35, 'MANGALDAN', 'ENVIROCYCLING FIBER INC', '', 'RET 848', '8', 'ISUZU', 'FORWARD', 'DROPSIDE', '2006', '580000', '560667', '580000', 'GOOD CONDITION', '2015-07-04', '6', '', ''),
(36, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'WLM 120', '0', 'ISUZU', 'ELF', 'DROPSIDE', '2000', '270000', '256500', '291660', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(37, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'NEBOR JSHOP / ROVINILDA DE GUZMAN', 'WLM 573', '3', 'ISUZU', 'ELF', 'DROPSIDE', '1995', '429830', '358192', '450000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(38, 'PASAY', 'LUISA LORNA REGALA', '', 'RKG 743', '3', 'ISUZU', 'ELF', 'ALUMINUM DROPSIDE', '2001', '375500', '56325', '375500', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(39, 'MANGALDAN', 'ENVIROCYCLING FIBER INC', 'RAFAEL MADANES', 'RJG 813', '3', 'MITSUBISHI', 'CANTER', 'CARGO DROPSIDE', '1990', '350000', '326667', '350000', 'GOOD CONDITION', '2015-07-04', '4', '', ''),
(41, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', 'RDL 191', '1', '', '', '', '', '', '', '', '', '2015-07-06', '4', '', ''),
(42, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RJX 423', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4', '', ''),
(43, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', '2084AS', '4', '', '', '', '', '', '', '', '', '2015-07-06', '4', '', ''),
(44, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', 'UMZ 414', '4', 'ISUZU', 'FORWARD', 'HIGH SIDE', '1997', '', '', '', '', '2015-07-06', '6', '', ''),
(45, 'SAUYO', 'ENVIROCYCLING FIBER INC', 'BRANCH_SAUYO', 'CTP 264', '4', 'ISUZU', '', 'DROPSIDE', '2003', '', '', '', 'UNDER REPAIR', '2015-07-06', '4', '', ''),
(46, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', '9974OE', '4', 'HONDA', 'ZN125MB', 'MOTORCYCLE', '2009', '', '', '', '', '2015-07-06', '2', '', ''),
(47, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'BRANCH_PAMPANGA', 'RBW 685', '5', 'ISUZU', '', 'DROPSIDE', '1992', '', '', '', 'UNDER REPAIR', '2015-07-06', '4', '', ''),
(48, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'USA 475', '5', 'ISUZU', '', 'HIGH SIDE', '1998', '', '', '', '', '2015-07-06', '4', '', ''),
(49, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'BRANCH_PAMPANGA', 'WJP 755', '5', 'ISUZU', '', 'DROP SIDE', '1999', '', '', '', '', '2015-07-06', '4', '', ''),
(50, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'ZRR 776', '6', 'TOYOTA', 'INNOVA 2.5 DSL', 'WAGON', '2008', '', '', '', '', '2015-07-06', '4', '2015-08-05', ''),
(51, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'XSA 916', '6', 'HONDA', 'CRV', 'WAGON', '2005', '', '', '', '', '2015-07-06', '4', '', ''),
(52, 'PASAY', 'ABEL & ANITA ANGELES', 'HP-PASAY', 'XDA 417', '7', 'ISUZU', 'ELF', 'DROPSIDE', '', '', '', '', '', '2015-07-06', '4', '', ''),
(53, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', '2987 UM', '7', 'YAMAHA', 'MIO SPORTY', 'MC', '2010', '', '', '', '', '2015-07-06', '2', '', ''),
(54, 'KAYBIGA', 'JESUS LAPUZ APOSTOL', '', 'ZJT 358', '8', 'ISUZU', 'ELF', 'FB BODY', '2007', '', '', '', '', '2015-07-06', '4', '', ''),
(56, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', 'CSL 918', '8', 'MITSUBISHI', 'L300', 'VAN', '2002', '', '', '', '', '2015-07-06', '4', '', ''),
(57, 'PASAY', 'ENVIROCYCLING FIBER INC', 'HP-PASAY', 'REK 528', '8', 'ISUZU', 'ELF', 'DROPSIDE', '2006', '', '', '', 'UNDER REPAIR', '2015-07-06', '4', '', ''),
(58, 'KAYBIGA', 'BILLY JOHN C YABUT ', '', '9932 PD', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4', '', ''),
(59, 'PASAY', 'ENVIROCYCLING FIBER INC', '', 'XFU 503', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4', '', ''),
(64, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'ZFE 548', '8', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', ''),
(65, 'CALAMBA', 'ENVIROCYCLING FIBER INC', '', '3138 DP', '8', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', ''),
(66, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', 'TTZ 799', '9', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', ''),
(67, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'REX 419', '9', '', '', '', '', '', '', '', '', '2015-07-07', '10', '2015-06-15', ''),
(68, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RCS 739', '9', '', '', '', '', '', '', '', '', '2015-07-07', '10', '2015-08-15', ''),
(69, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'TME 509', '9', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', ''),
(70, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'WPT 720', '0', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', ''),
(71, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', '784O UK', '0', '', '', '', '', '', '', '', '', '2015-07-07', '4', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL auto_increment,
  `Name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `branch` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `Name`, `username`, `password`, `type`, `branch`) VALUES
(1, 'caridaoan_PAM', 'rj', '-clear360', 1, ''),
(3, 'Niño_PAM', 'NBC', 'passs', 3, ' '),
(6, 'EAA_PAMPANGA', 'EAA', 'May102015', 2, 'PAMPANGA'),
(7, 'CLC_MANGALDAN', 'mangaldan', 'mpass2', 2, 'MANGALDAN'),
(8, 'FDM_CAINTA', 'cainta', 'cpass2', 2, 'CAINTA'),
(9, 'MDG__CALAMBA', 'calamba', 'cpass2', 2, 'CALAMBA'),
(10, 'MDG_CAVITE', 'cavite', 'cpass2', 2, 'CAVITE'),
(11, 'JRP_KAYBIGA', 'kaybiga', 'kpass2', 2, 'KAYBIGA'),
(12, 'JLA_SAUYO', 'sauyo', 'spass2', 2, 'SAUYO'),
(13, 'AAP_PASAY', 'PASAY', 'ppass2', 2, 'PASAY'),
(14, 'JAM_URDANETA', 'urdaneta', 'upass2', 2, 'URDANETA'),
(15, 'MAKATI', 'makati', 'mpass2', 2, 'MAKATI'),
(16, 'LORNA REGALA', 'LLR', 'efi123', 0, '');

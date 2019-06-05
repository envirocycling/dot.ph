-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2015 at 02:51 PM
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_changeswaps`
--

INSERT INTO `tbl_changeswaps` (`id`, `tireid`, `truckid`, `tirename`, `tiresize`, `description`, `reason`, `dateadded`, `addedby`, `swapto`, `remarks`) VALUES
(2, '2', '53', 'W', 'Q', 'Q', 'Worn Out/ Pudpod', '2015-01-01', 'caridaoan', '1', 'swap');

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
(10, 'PASAY', 10, 'TISOY', '2014-07-01', '2014-07-01', '6500', '3500', '30000', 'JJD', ''),
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_reassignmenthistory`
--

INSERT INTO `tbl_reassignmenthistory` (`id`, `truckplate`, `suppname`, `branch`, `issuancedate`, `enddate`, `amortization`, `cashbond`, `proposedvolume`, `prepared`, `remarks`) VALUES
(1, '12', '	FJ PRAXIDIO	', 'PASAY', '2015-04-04', '2020-03-04', '5833', '5200', '60000', 'JJD', ''),
(2, '13', '	FJ PRAXIDIO	', 'PASAY', '2015-04-04', '2020-03-04', '5833', '5200', '60000', 'JJD', ''),
(3, '10', 'NEBOR JSHOP / ROVINILDA DE GUZMAN', 'PAMPANGA', '2015-03-11', '2020-03-10', '6500', '3500', '30000', 'JJD', ''),
(4, '37', 'NEBOR JSHOP / ROVINILDA DE GUZMAN', 'PAMPANGA', '2015-03-11', '2015-03-10', '7500', '5200', '30000', 'JJD', ''),
(5, '39', 'RAFAEL MADANES', 'MANGALDAN', '2015-05-01', '2020-04-30', '6667', '5200', '50000', 'JJD', ''),
(6, '10', 'TISOY', 'PASAY', '2014-07-01', '2019-06-30', '6500', '3500', '30000', 'JJD', ''),
(7, '49', 'BRANCH_PAMPANGA', 'PAMPANGA', '', '', '', '', '', 'JJD', 'USED FOR PAMPANGA PICK UP'),
(8, '52', 'HP-PASAY', 'PASAY', '', '', '', '', '', 'JJD', 'USED FOR PASAY PICK-UP'),
(9, '34', 'JD SCRAP PAPER', 'PAMPANGA', '2015-01-26', '2020-01-25', '6334', '3000', '40000', 'JJD', ''),
(10, '57', 'HP-PASAY', 'PASAY', '', '', '', '', '', 'JJD', 'UNDER REPAIR'),
(11, '12', 'ALEX JUNKSHOP', 'MANGALDAN', '2015-04-04', '2019-03-04', '5833', '5200', '60000', 'JJD', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_toolreassign`
--

INSERT INTO `tbl_toolreassign` (`id`, `truckid`, `toolname`, `branch`, `suppname`, `dateadded`, `qty`, `reassign`, `sold`, `encodeby`) VALUES
(1, '68', 'COMBINATION WRENCH 10', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(2, '68', 'DO BUT 8', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(3, '68', 'DO BUT 10', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(4, '68', 'DO BUT 11', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(5, '68', 'DO BUT 12', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(6, '68', 'DO BUT 13', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(7, '68', 'DO BUT 14', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(8, '68', 'DO BUT 19', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(9, '68', 'DO BUT 22', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(10, '68', 'DO BUT 24', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(11, '68', 'VICE GRIP', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(12, '68', 'PHILIPS SREW', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(13, '68', 'SCREW DRIVER', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, ''),
(14, '68', 'PLIERS', 'PAMPANGA', '', '07-08-2015', '1', 0, 0, '');

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
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

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
(35, 35, 'ret848.jpg', '', ''),
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
  PRIMARY KEY  (`regid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_truckregistration`
--

INSERT INTO `tbl_truckregistration` (`regid`, `truckid`, `insurance`, `stencil`, `emission`, `location`, `remarks`, `status`) VALUES
(10, 10, 'OK', 'OK', 'OK', 'LTO DAU', 'NO STICKER AVAILABLE', 1),
(11, 11, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAIALABLE', 1),
(12, 12, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(13, 13, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(14, 14, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(15, 15, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(16, 16, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(17, 17, 'OK', 'OK', 'OK', 'DAU', 'NOT INDICATED NSA,\nNO DEED OF SALE', 1),
(18, 18, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(19, 19, 'OK', 'OK', 'OK', 'PALAYAN', 'NO STICKER AVAILABLE, NO DEED OF SALE', 1),
(20, 20, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE,\r\nNO DEED OF SALE', 1),
(21, 21, 'OK', 'OK', 'OK', 'DAu', ' ', 1),
(22, 22, 'OK', 'OK', 'OK', 'DAU', '', 1),
(23, 23, '', '', '', '', '', 0),
(24, 24, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1),
(25, 25, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1),
(26, 26, 'OK', 'OK', 'OK', 'DAU', ' ', 1),
(27, 27, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(28, 28, ' ', ' ', ' ', ' ', ' ', 0),
(29, 29, 'OK', 'OK', 'OK', ' ', 'NO DEED OF SALE', 1),
(30, 30, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVIALABLE', 1),
(31, 31, 'OK', 'OK', 'OK', ' ', ' ', 1),
(32, 32, '', '', '', '', '', 0),
(68, 72, '', '', '', '', '', 0),
(33, 33, 'OK', 'OK', 'OK', 'DAU', 'ORCR IS AT LTO DAU/ FOR TRANSFER OF OWNERSHIP ORCR.(RFI TO EFI)', 1),
(34, 34, 'OK', 'OK', 'OK', 'DAU', ' ', 1),
(35, 35, 'OK', 'OK', 'OK', ' ', ' ', 1),
(36, 36, '', 'OK', 'OK', '', '', 0),
(37, 37, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(38, 38, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE, DEED OF SALE LLR TO EFI', 1),
(39, 39, 'OK', 'OK', 'OK', 'PALAYAN', 'NO STICKER AVAILABLE', 1),
(41, 41, 'OK', 'OK', 'OK', 'DAU', 'NO STICKER AVAILABLE', 1),
(42, 42, 'OK', 'OK', 'OK', 'DAu', 'NO STICKER AVAILABLE', 1),
(43, 43, 'OK', '', '', '', '', 0),
(44, 44, 'OK', 'OK', 'OK', ' ', ' ', 1),
(45, 45, 'OK', 'OK', 'OK', ' ', 'OR/CR IS AT LTO', 1),
(46, 46, 'OK', 'OK', 'OK', ' ', ' ', 1),
(47, 47, 'OK', 'OK', 'OK', 'PALAYAN', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1),
(48, 48, 'OK', 'OK', 'OK', 'DAU', ' ', 1),
(49, 49, 'OK', 'OK', 'OK', 'DAU', 'INCOMPLETE INFO REGARDING DEED OF SALE', 1),
(50, 50, 'OK', 'OK', 'OK', 'DAU', ' ', 1),
(51, 51, 'OK', 'OK', 'OK', 'DAU', ' ', 1),
(52, 52, '', '', '', '', '', 0),
(53, 53, 'OK', '', '', '', '', 0),
(54, 54, 'OK', 'OK', 'OK', 'CALOOCAN CITY', ' ', 1),
(55, 55, '', '', '', '', '', 0),
(56, 56, ' ', ' ', ' ', ' ', ' ', 0),
(57, 57, 'OK', 'OK', 'OK', 'QUEZON CITY', ' ', 1),
(58, 58, '', '', '', '', '', 0),
(59, 59, '', '', '', '', '', 0),
(60, 64, '', '', '', '', '', 0),
(61, 65, '', '', '', '', '', 0),
(62, 66, '', '', '', '', '', 0),
(63, 67, '', '', '', '', '', 0),
(64, 68, '', '', '', '', '', 0),
(65, 69, '', '', '', '', '', 0),
(66, 70, '', '', '', '', '', 0),
(67, 71, '', '', '', '', '', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
  PRIMARY KEY  (`ti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_trucktools`
--

INSERT INTO `tbl_trucktools` (`ti`, `truckid`, `toolname`, `dateadded`, `qty`, `reassign`, `sold`, `encodeby`) VALUES
(1, '68', 'COMBINATION WRENCH 10', '07-08-2015', '1', 0, 0, ''),
(2, '68', 'DO BUT 8', '07-08-2015', '1', 0, 0, ''),
(3, '68', 'DO BUT 10', '07-08-2015', '1', 0, 0, ''),
(4, '68', 'DO BUT 11', '07-08-2015', '1', 0, 0, ''),
(5, '68', 'DO BUT 12', '07-08-2015', '1', 0, 0, ''),
(6, '68', 'DO BUT 13', '07-08-2015', '1', 0, 0, ''),
(7, '68', 'DO BUT 14', '07-08-2015', '1', 0, 0, ''),
(8, '68', 'DO BUT 19', '07-08-2015', '1', 0, 0, ''),
(9, '68', 'DO BUT 22', '07-08-2015', '1', 0, 0, ''),
(10, '68', 'DO BUT 24', '07-08-2015', '1', 0, 0, ''),
(11, '68', 'VICE GRIP', '07-08-2015', '1', 0, 0, ''),
(12, '68', 'PHILIPS SREW', '07-08-2015', '1', 0, 0, ''),
(13, '68', 'SCREW DRIVER', '07-08-2015', '1', 0, 0, ''),
(14, '68', 'PLIERS', '07-08-2015', '1', 0, 0, '');

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
  PRIMARY KEY  (`id`),
  UNIQUE KEY `truckplate` (`truckplate`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `tbl_truck_report`
--

INSERT INTO `tbl_truck_report` (`id`, `branch`, `ownersname`, `suppliername`, `truckplate`, `ending`, `make`, `series`, `bodytype`, `yearmodel`, `aquisitioncost`, `netbookvalue`, `amount`, `truckcondition`, `dateadded`, `wheels`) VALUES
(10, 'PASAY', 'ENVIROCYCLING FIBER INC.,', 'TISOY', 'CRX 935', '5', 'ISUZU', 'ELF', 'DROPSIDE WITH GRILLS', '1997', '220000', '11000', '360000', 'GOOD CONDITION', '2015-07-04', '4'),
(11, 'SAUYO', 'HAKOT PAPAEL CORPORATION', '', 'UDS 301', '1', 'ISUZU', 'NI', 'DROPSIDE PICKUP', '1986', '175000', '32083', '220000', 'GOOD CONDITION', '2015-07-04', '4'),
(12, 'MANGALDAN', 'LUISITIO PISCASIO', 'ALEX JUNKSHOP', 'XBS 671', '1', 'ISUZU', 'ELF', 'DROPSIDE', '2002', '405130', '324104', '405130', 'GOOD CONDITION', '2015-07-04', '4'),
(13, 'PASAY', 'ENVIROCYCLING FIBER INC', '	FJ PRAXIDIO	', 'XGW 541', '1', 'ISUZU', 'ELF WITH CANOPY', 'DROPSIDE', '', '315000', '', '31500', '', '2015-07-04', '4'),
(14, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'ZDL 541', '1', 'ISUZU', 'ELF', 'DROPSIDE', '2006', '419545', '419545', '430000', '', '2015-07-04', '4'),
(15, 'CAINTA', 'HP TRADING', '', 'UUC 602', '2', 'ISUZU', 'ELF', 'ALUMINUM VAN', '', '207500', '', '100000', '', '2015-07-04', '4'),
(16, 'SAUYO', 'HAKOT PAPEL CORPORATION', '', 'ZCD 502', '2', 'ISUZU', 'ELF', 'CLOSE VAN', '2001', '220000', '66000', '330000', '', '2015-07-04', '4'),
(17, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'XCN 302', '2', 'ISUZU', 'DROPSIDE', 'DROPSIDE', '2002', '430674', '43674', '500000', 'GOOD CONDITION', '2015-07-04', '4'),
(18, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'XLR 382', '2', 'ISUZU', 'CHICKEN CAGE', 'DROPSIDE WITH STAKE', '2004', '304500', '81200', '400000', 'GOOD CONDITION', '2015-07-04', '4'),
(19, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'REH 712', '2', 'FUSO', 'WITH HANGER BODY', 'CANOPY', '1995', '417670', '327175', '330000', 'GOOD CONDITION', '2015-07-04', '4'),
(20, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RDT 853', '3', 'ISUZU', 'FORWARD', 'DROPSIDE WITH GRILLS', '1991', '535000', '', '600000', 'GOOD CONDITION', '2015-07-04', '6'),
(21, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'CTB 349', '4', 'ISUZU', 'FORWARD', 'DROPSIDE', '2003', '460000', '', '550000', '', '2015-07-04', '6'),
(22, 'CAINTA', 'LUISA LORAN REGALA', '', 'WLJ 507', '7', 'ISUZU', 'ELF', 'DROPSIDE', '1998', '330000', '77000', '380000', 'GOOD CONDITION', '2015-07-04', '4'),
(24, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'XLJ 320', '0', 'ISUZU', 'NPR', 'DROPSIDE', '19991', '370000', '370000', '380000', 'GOOD CONDITION', '2015-07-04', '4'),
(25, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'VBP 369', '9', 'ISUZU', 'ELF WITH STAKE', 'DROPSIDE', '2002', '351102', '351102', '380000', 'GOOD CONDITION', '2015-07-04', '4'),
(26, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'XAT 579', '9', 'ISUZU', 'ELF', 'DROPSIDE', '1989', '320000', '117333', '370000', 'GOOD CONDITION', '2015-07-04', '4'),
(27, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'WGG 163', '3', 'ISUZU', 'ELF', 'DROPSIDE WITH CANOPY', '1988', '476360', '476360', '450000', 'GOOD CONDITION', '2015-07-04', '4'),
(28, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'RCT 378', '8', 'ISUZU', 'ELF', 'DORPSIDE', '1991', '380000', '380000', '400000', 'GOOD CONDITION', '2015-07-04', '4'),
(29, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'WSN 984', '4', 'ISUZU', 'ELF', 'STAKE WITH CANOPY', '1990', '417926', '417926', '430000', 'GOOD CONDITION', '2015-07-04', '4'),
(30, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'UDG 461', '1', 'ISUZU', '', 'OPEN TOP VAN', '1987', '220000', '66000', '100000', 'GOOD CONDITION', '2015-07-04', '4'),
(31, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'WHW 414', '4', 'MITSUBISHI FUSO', '', 'DROPSIDE WITH CANOPY', '2000', '375000', '', '440000', 'GOOD CONDITION', '2015-07-04', '4'),
(32, 'CAINTA', 'CATALINO TIONGSON II', 'ANALIE TRADING', 'XAT 446', '6', 'ISUZU', 'ELF', 'ALUMINUM VAN', '', '415250', '', '400000', 'TRUCK NOT RUNNING', '2015-07-04', '4'),
(33, 'KAYBIGA', 'RECYCLEAN FOUNDATION', '', 'RFZ 678', '8', 'ISUZU', 'ELF', 'WING VAN', '1992', '253730', '238929', '430000', 'GOOD CONDITION', '2015-07-04', '4'),
(34, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'JD SCRAP PAPER', 'XGN 579', '9', 'ISUZU', 'ELF', 'DROPSIDE WITH CANOPY', '2003', '320000', '117333', '380000', 'GOOD CONDITION', '2015-07-04', '4'),
(35, 'MANGALDAN', 'ENVIROCYCLING FIBER INC', '', 'RET 848', '8', 'ISUZU', 'FORWARD', 'DROPSIDE', '2006', '580000', '560667', '580000', 'GOOD CONDITION', '2015-07-04', '6'),
(36, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'WLM 120', '0', 'ISUZU', 'ELF', 'DROPSIDE', '2000', '270000', '256500', '291660', 'GOOD CONDITION', '2015-07-04', '4'),
(37, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'NEBOR JSHOP / ROVINILDA DE GUZMAN', 'WLM 573', '3', 'ISUZU', 'ELF', 'DROPSIDE', '1995', '429830', '358192', '450000', 'GOOD CONDITION', '2015-07-04', '4'),
(38, 'PASAY', 'LUISA LORNA REGALA', '', 'RKG 743', '3', 'ISUZU', 'ELF', 'ALUMINUM DROPSIDE', '2001', '375500', '56325', '375500', 'GOOD CONDITION', '2015-07-04', '4'),
(39, 'MANGALDAN', 'ENVIROCYCLING FIBER INC', 'RAFAEL MADANES', 'RJG 813', '3', 'MITSUBISHI', 'CANTER', 'CARGO DROPSIDE', '1990', '350000', '326667', '350000', 'GOOD CONDITION', '2015-07-04', '4'),
(41, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', 'RDL 191', '1', '', '', '', '', '', '', '', '', '2015-07-06', '4'),
(42, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RJX 423', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4'),
(43, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', '2084AS', '4', '', '', '', '', '', '', '', '', '2015-07-06', '4'),
(44, 'URDANETA', 'ENVIROCYCLING FIBER INC', '', 'UMZ 414', '4', 'ISUZU', 'FORWARD', 'HIGH SIDE', '1997', '', '', '', '', '2015-07-06', '6'),
(45, 'SAUYO', 'ENVIROCYCLING FIBER INC', 'BRANCH_SAUYO', 'CTP 264', '4', 'ISUZU', '', 'DROPSIDE', '2003', '', '', '', 'UNDER REPAIR', '2015-07-06', '4'),
(46, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', '9974OE', '4', 'HONDA', 'ZN125MB', 'MOTORCYCLE', '2009', '', '', '', '', '2015-07-06', '2'),
(47, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'BRANCH_PAMPANGA', 'RBW 685', '5', 'ISUZU', '', 'DROPSIDE', '1992', '', '', '', 'UNDER REPAIR', '2015-07-06', '4'),
(48, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'USA 475', '5', 'ISUZU', '', 'HIGH SIDE', '1998', '', '', '', '', '2015-07-06', '4'),
(49, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', 'BRANCH_PAMPANGA', 'WJP 755', '5', 'ISUZU', '', 'DROP SIDE', '1999', '', '', '', '', '2015-07-06', '4'),
(50, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'ZRR 776', '6', 'TOYOTA', 'INNOVA 2.5 DSL', 'WAGON', '2008', '', '', '', '', '2015-07-06', '4'),
(51, 'CAVITE', 'ENVIROCYCLING FIBER INC', '', 'XSA 916', '6', 'HONDA', 'CRV', 'WAGON', '2005', '', '', '', '', '2015-07-06', '4'),
(52, 'PASAY', 'ABEL & ANITA ANGELES', 'HP-PASAY', 'XDA 417', '7', 'ISUZU', 'ELF', 'DROPSIDE', '', '', '', '', '', '2015-07-06', '4'),
(53, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', '2987 UM', '7', 'YAMAHA', 'MIO SPORTY', 'MC', '2010', '', '', '', '', '2015-07-06', '2'),
(54, 'KAYBIGA', 'JESUS LAPUZ APOSTOL', '', 'ZJT 358', '8', 'ISUZU', 'ELF', 'FB BODY', '2007', '', '', '', '', '2015-07-06', '4'),
(56, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', 'CSL 918', '8', 'MITSUBISHI', 'L300', 'VAN', '2002', '', '', '', '', '2015-07-06', '4'),
(57, 'PASAY', 'ENVIROCYCLING FIBER INC', 'HP-PASAY', 'REK 528', '8', 'ISUZU', 'ELF', 'DROPSIDE', '2006', '', '', '', 'UNDER REPAIR', '2015-07-06', '4'),
(58, 'KAYBIGA', 'BILLY JOHN C YABUT ', '', '9932 PD', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4'),
(59, 'PASAY', 'ENVIROCYCLING FIBER INC', '', 'XFU 503', '3', '', '', '', '', '', '', '', '', '2015-07-06', '4'),
(64, 'KAYBIGA', 'ENVIROCYCLING FIBER INC', '', 'ZFE 548', '8', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(65, 'CALAMBA', 'ENVIROCYCLING FIBER INC', '', '3138 DP', '8', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(66, 'CAINTA', 'ENVIROCYCLING FIBER INC', '', 'TTZ 799', '9', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(67, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'REX 419', '9', '', '', '', '', '', '', '', '', '2015-07-07', '10'),
(68, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', 'RCS 739', '9', '', '', '', '', '', '', '', '', '2015-07-07', '10'),
(69, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'TME 509', '9', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(70, 'SAUYO', 'ENVIROCYCLING FIBER INC', '', 'WPT 720', '0', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(71, 'PAMPANGA', 'ENVIROCYCLING FIBER INC', '', '784O UK', '0', '', '', '', '', '', '', '', '', '2015-07-07', '4'),
(72, 'PAMPANGA', 'EMILROSE', '', 'AAA111', '1', 'ISUZU', 'ELF', 'DROP SIDE', '1997', '450000', '420000', '380000', 'CHASSIS FOR REPAIR', '2015-07-13', '2');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `Name`, `username`, `password`, `type`, `branch`) VALUES
(1, 'caridaoan', 'rj', '-clear360', 1, ''),
(3, 'USER3', 'user3', 'user3', 3, ' '),
(5, 'user4', 'user4', 'user4', 4, ''),
(6, 'USER2', 'user2', 'user2', 2, 'CAINTA');

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2015 at 08:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "America/Sao_Paulo";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `block` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL,
  `comment` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_id`, `name`, `date`, `block`, `active`, `new`, `comment`) VALUES
(1, '156 123 789', 'გიორგი ჯანაშია', '2015-09-06', 1, 0, 0, ''),
(2, '456 789 456', 'ნინო კავსაძე', '2015-09-01', 0, 1, 0, ''),
(3, '156 123 789', 'ნუგზარ გაბროძე', '2015-09-06', 0, 1, 0, ''),
(4, '456 789 456', 'თამარ კაპანაძე', '2015-07-06', 1, 0, 0, ''),
(5, '547 546 114', 'ნინო', '2015-09-06', 0, 0, 1, 'სატესტო');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `link` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent`, `icon`, `name`, `link`) VALUES
(1, 2, 'glyphicon-th-large', 'მართვის პანელი', 'ea'),
(2, 2, 'glyphicon-road', 'ბარათები', 'ea/cards.php'),
(3, 0, '', 'მოდულები', 'base'),
(4, 0, '', 'მომხმარებლები', 'base/users.php'),
(5, 0, '', 'ჯგუფები', 'base/groups.php');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `link` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `link`, `active`) VALUES
(1, 'HR', 'hr', 1),
(2, 'EA', 'ea', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 08:04 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `belongings`
--

CREATE TABLE IF NOT EXISTS `belongings` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `belongings` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `belongings`
--

INSERT INTO `belongings` (`id`, `belongings`) VALUES
(1, 'phones');

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('e4b57b404582dc6bd1fd45c752982134', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 1533966079, 'a:7:{s:9:"user_data";s:0:"";s:9:"user_name";s:6:"guard5";s:12:"is_logged_in";b:1;s:20:"manufacture_selected";N;s:22:"search_string_selected";N;s:5:"order";N;s:10:"order_type";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`) VALUES
(1, 'AK47BalajiMManfa');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  `role` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`, `role`) VALUES
(1, 'Alex', 'Bejjam', 'balajisiddi@adinadataservices.com', 'alex', '534b44a19bf18d20b71ecc4eb77c572f', 'admin'),
(2, 'guard', 'guard', 'guard@guard.com', 'guard', 'guard', ''),
(3, 'guard5', 'guard', 'guard@guard.com', 'guard5', '16337a32f5f2995519c7d05d40f94efa', 'guard');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `age` double DEFAULT NULL,
  `phone` double DEFAULT NULL,
  `comingfrom` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `checkin` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `checkout` varchar(255) NOT NULL,
  `adhar` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `belongings` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `age`, `phone`, `comingfrom`, `purpose`, `checkin`, `address`, `checkout`, `adhar`, `email`, `belongings`) VALUES
(51, 'ram', 0, 0, 'ram', 'ram', '0000-00-00', 'ram', '', 0, 'ram', '0'),
(52, 'sita', 0, 0, 'sita', 'sita', '0000-00-00', 'sita', '', 0, 'sita', '0'),
(53, 'hanuma', 0, 0, 'hanuma', 'hanuma', '0000-00-00', 'hanuma', '', 0, 'hanuma', '0'),
(54, 'bharat', 0, 0, 'bharat', 'bharat', '0000-00-00', 'bharat', '', 0, 'bharat', '0'),
(55, 'dkddk', 0, 1, 'dkj', '`dfkj', '08-10-2018', 'sdkfjed', '', 0, 'dfkkj', '0'),
(56, 'selec', 0, 0, 'sdkj', 'dckj', '08-11-2018', 'dfkj', '', 0, 'dkjff', '0'),
(57, 'dfghj', 0, 0, 'rtyu', 'rtyu', '08-11-2018', 'erty', '', 0, 'ertyu', 'phones');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

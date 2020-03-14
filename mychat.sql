-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2020 at 01:41 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--
CREATE DATABASE IF NOT EXISTS mychat;
use mychat;

CREATE TABLE IF NOT EXISTS `chat` (
  `textid` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `chat` text NOT NULL,
  `texttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cansee` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`textid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`textid`, `fromid`, `toid`, `chat`, `texttime`, `cansee`) VALUES
(1, 1, 2, 'hello', '2020-03-11 20:59:31', 0),
(5, 1, 3, 'hello again', '2020-03-11 21:10:36', 0),
(7, 2, 1, 'hey bro', '2020-03-11 22:17:47', 0),
(15, 1, 4, 'hi dear', '2020-03-12 09:14:05', 1),
(14, 4, 1, 'hello brother', '2020-03-12 09:13:23', 1),
(16, 1, 2, 'hello', '2020-03-12 09:34:07', 0),
(17, 1, 4, 'hello dear ', '2020-03-12 11:03:57', 1),
(18, 1, 3, 'hi hero', '2020-03-12 11:04:04', 0),
(19, 1, 2, 'what about you???', '2020-03-12 11:04:13', 0),
(20, 4, 1, 'hi again', '2020-03-12 11:13:30', 1),
(21, 1, 4, 'hello brother', '2020-03-12 11:13:42', 1),
(22, 4, 1, 'hey?? Is It Working fine?', '2020-03-12 11:13:55', 1),
(23, 1, 4, 'ya going good', '2020-03-12 11:14:04', 1),
(24, 4, 1, 'I love you', '2020-03-12 11:14:11', 1),
(25, 1, 4, 'i love you too', '2020-03-12 11:14:17', 1),
(26, 4, 1, 'hey bro??\n', '2020-03-12 11:14:39', 1),
(27, 1, 4, 'hi', '2020-03-13 21:40:27', 1),
(28, 4, 1, 'Hello bro\n', '2020-03-13 21:40:35', 1),
(29, 4, 1, 'How are you doing??', '2020-03-13 21:40:47', 1),
(30, 1, 4, 'i am fine', '2020-03-13 21:40:55', 1),
(31, 1, 4, 'hey', '2020-03-13 21:42:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Username` varchar(80) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL COMMENT '1 for Online and 0 for Offline',
  `dp` varchar(20) NOT NULL DEFAULT 'dp.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`Email`,`Username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `Name`, `Email`, `Username`, `Password`, `gender`, `last_seen`, `status`, `dp`) VALUES
(1, 'Bug Boy ', 'bugboy@bb.com', 'bugboy', '202cb962ac59075b964b07152d234b70', 'male', '2020-03-13 21:44:05', 1, '1.png'),
(2, 'banny', 'banny.swan@gmail.com', 'bugboyb2', '202cb962ac59075b964b07152d234b70', 'male', '2020-02-21 18:34:37', 0, 'dp.png'),
(3, 'Sample User', 'Sample@x.com', 'sampleuser', '202cb962ac59075b964b07152d234b70', 'male', '2020-03-11 20:50:57', 0, 'dp.png'),
(4, 'Iron Man', 'ironman@starkind.com', 'jarvis', '202cb962ac59075b964b07152d234b70', 'male', '2020-03-13 21:43:28', 0, '4.jpg');

-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2010 at 08:11 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hekmat`
--

-- --------------------------------------------------------

--
-- Table structure for table `sokhanrans`
--

CREATE TABLE `sokhanrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sokhanrans`
--

INSERT INTO `sokhanrans` (`id`, `name`, `Description`) VALUES
(4, 'Ghasemian', 'Ghasemian Ghasemian\r\nGhasemian\r\nGhasemian\r\nGhasemian\r\nGhasemianGhasemian'),
(5, 'Panahian', 'Panahian\r\nPanahian\r\nPanahian\r\nPanahian\r\n'),
(6, 'Amjad', 'aslfjasldfjlasdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL,
  `password` varchar(40) NOT NULL COMMENT 'md5ed',
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `isSokhanran` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


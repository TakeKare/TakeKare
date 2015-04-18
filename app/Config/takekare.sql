-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2015 at 11:55 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `takekare`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `title`, `created`, `updated`) VALUES
(1, 1, 'Sydney CBD', '0000-00-00 00:00:00', '2015-04-18 03:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `created`, `updated`) VALUES
(1, 'Sydney', '2015-04-17 11:37:00', '2015-04-17 11:37:00'),
(2, 'Melbourne', '2015-04-18 00:56:00', '2015-04-18 00:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` smallint(5) unsigned NOT NULL,
  `team_id` int(11) unsigned NOT NULL,
  `males_number` smallint(5) unsigned NOT NULL,
  `females_number` smallint(5) unsigned NOT NULL,
  `age` smallint(5) unsigned DEFAULT NULL,
  `intoxication` smallint(5) unsigned DEFAULT NULL,
  `receptiveness` smallint(5) unsigned DEFAULT NULL,
  `referral_id` smallint(5) unsigned DEFAULT NULL,
  `referral_comment` text NOT NULL,
  `support_type_id` smallint(5) unsigned DEFAULT NULL,
  `support_type_sub_id` smallint(5) unsigned DEFAULT NULL,
  `comment` text NOT NULL,
  `lat` decimal(11,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `draft` tinyint(1) unsigned NOT NULL,
  `police` tinyint(1) unsigned NOT NULL,
  `contact` tinyint(1) unsigned NOT NULL,
  `report` tinyint(1) unsigned NOT NULL,
  `water_given` smallint(5) unsigned NOT NULL,
  `chupa_chups_given` smallint(5) unsigned NOT NULL,
  `thongs_given` smallint(5) unsigned NOT NULL,
  `vomit_bags_given` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `area_id`, `team_id`, `males_number`, `females_number`, `age`, `intoxication`, `receptiveness`, `referral_id`, `referral_comment`, `support_type_id`, `support_type_sub_id`, `comment`, `lat`, `lng`, `draft`, `police`, `contact`, `report`, `water_given`, `chupa_chups_given`, `thongs_given`, `vomit_bags_given`, `created`, `updated`) VALUES
(1, 1, 0, 1, 1, 1, 4, 3, 9, 'referred comment', 10, 0, 'long comment', 0.00000000, 0.00000000, 1, 0, 0, 0, 0, 0, 0, 0, '2015-04-18 07:37:56', '2015-04-18 23:30:22'),
(2, 0, 0, 1, 1, 2, NULL, NULL, 5, '', 7, 0, '', 0.00000000, 0.00000000, 1, 1, 0, 0, 0, 0, 0, 0, '2015-04-18 23:28:56', '2015-04-18 23:28:56'),
(3, 0, 0, 1, 1, 2, 1, 2, 2, '', 4, 0, '', 0.00000000, 0.00000000, 0, 0, 1, 0, 0, 0, 0, 0, '2015-04-18 23:47:29', '2015-04-18 23:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `pos` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `title`, `icon`, `pos`, `created`, `updated`) VALUES
(1, 'Police', 'fa-shield', 10, '2015-04-18 05:28:32', '2015-04-18 12:07:03'),
(2, 'Venue', 'fa-hospital-o', 20, '2015-04-18 05:28:41', '2015-04-18 12:06:55'),
(3, 'Control Room', 'fa-video-camera', 30, '2015-04-18 06:21:02', '2015-04-18 12:07:15'),
(4, 'Self', 'fa-child', 40, '2015-04-18 06:21:10', '2015-04-18 12:32:47'),
(5, 'Friend', 'fa-user', 50, '2015-04-18 06:21:16', '2015-04-18 12:07:36'),
(6, 'Public', 'fa-users', 60, '2015-04-18 06:21:23', '2015-04-18 12:07:47'),
(7, 'Transport', 'fa-bus', 70, '2015-04-18 06:21:31', '2015-04-18 12:21:33'),
(8, 'Taxi', 'fa-taxi', 80, '2015-04-18 06:21:41', '2015-04-18 12:08:08'),
(9, 'TKA', 'fa-street-view', 90, '2015-04-18 06:21:46', '2015-04-18 12:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `support_types`
--

CREATE TABLE IF NOT EXISTS `support_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `pos` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `support_types`
--

INSERT INTO `support_types` (`id`, `parent_id`, `title`, `icon`, `pos`, `created`, `updated`) VALUES
(1, NULL, 'Directions', 'fa-subway', 10, '2015-04-18 05:36:23', '2015-04-18 12:36:20'),
(2, 1, 'Accommodation', '', 10, '2015-04-18 05:56:09', '2015-04-18 06:07:26'),
(3, NULL, 'Transport', 'fa-train', 20, '2015-04-18 06:02:21', '2015-04-18 12:36:37'),
(4, NULL, 'Friends / Family', 'fa-home', 40, '2015-04-18 06:05:10', '2015-04-18 12:44:33'),
(5, NULL, 'Sexual Assault', 'fa-bed', 50, '2015-04-18 06:05:33', '2015-04-18 12:44:46'),
(6, NULL, 'Injury', 'fa-hospital-o', 70, '2015-04-18 06:05:45', '2015-04-18 12:45:52'),
(7, NULL, 'Theft', 'fa-user-secret', 70, '2015-04-18 06:06:15', '2015-04-18 12:46:27'),
(8, NULL, 'Conflict De-escalation', 'fa-user-times', 60, '2015-04-18 06:06:28', '2015-04-18 12:44:58'),
(9, NULL, 'First Aid', 'fa-heart', 30, '2015-04-18 06:06:58', '2015-04-18 12:44:22'),
(10, NULL, 'Professional', 'fa-ambulance', 90, '2015-04-18 06:07:09', '2015-04-18 12:46:09'),
(11, 1, 'Toilets', '', 20, '2015-04-18 06:07:46', '2015-04-18 06:07:46'),
(12, 1, 'Other', '', 30, '2015-04-18 06:08:10', '2015-04-18 06:08:10'),
(13, 3, 'Taxi', '', 10, '2015-04-18 06:08:23', '2015-04-18 06:08:23'),
(14, 3, 'Train', '', 20, '2015-04-18 06:08:33', '2015-04-18 06:08:33'),
(15, 3, 'Bus', '', 30, '2015-04-18 06:08:44', '2015-04-18 06:08:44'),
(16, 3, 'Car pick-up', '', 40, '2015-04-18 06:08:57', '2015-04-18 06:08:57'),
(17, 4, 'Phone', '', 10, '2015-04-18 06:09:35', '2015-04-18 06:09:35'),
(18, 4, 'Social media', '', 20, '2015-04-18 06:09:45', '2015-04-18 06:09:45'),
(19, 4, 'In person', '', 30, '2015-04-18 06:09:56', '2015-04-18 06:09:56'),
(20, 4, 'Pick-up', '', 40, '2015-04-18 06:10:07', '2015-04-18 06:10:07'),
(21, 5, 'Minor', '', 10, '2015-04-18 06:10:22', '2015-04-18 06:10:22'),
(22, 5, 'Major', '', 20, '2015-04-18 06:10:35', '2015-04-18 06:10:35'),
(23, 5, 'Sexual assault occurred', '', 30, '2015-04-18 06:11:02', '2015-04-18 06:11:02'),
(24, 6, 'Minor', '', 10, '2015-04-18 06:11:17', '2015-04-18 06:11:17'),
(25, 6, 'Major', '', 20, '2015-04-18 06:11:29', '2015-04-18 06:11:29'),
(26, 6, 'Injury occurred', '', 30, '2015-04-18 06:11:39', '2015-04-18 06:11:39'),
(27, 7, 'Minor', '', 10, '2015-04-18 06:11:49', '2015-04-18 06:11:49'),
(28, 7, 'Major', '', 20, '2015-04-18 06:11:59', '2015-04-18 06:11:59'),
(29, 7, 'Theft occurred', '', 30, '2015-04-18 06:12:09', '2015-04-18 06:12:09'),
(30, 8, 'Minor', '', 10, '2015-04-18 06:12:24', '2015-04-18 06:12:24'),
(31, 8, 'Major', '', 20, '2015-04-18 06:12:39', '2015-04-18 06:12:39'),
(32, 8, 'Assault occurred', '', 30, '2015-04-18 06:12:54', '2015-04-18 06:12:54'),
(33, 9, 'Vomit bag & water', '', 10, '2015-04-18 06:13:11', '2015-04-18 06:13:11'),
(34, 9, 'Cuts, abrasions & blisters', '', 20, '2015-04-18 06:13:23', '2015-04-18 06:13:23'),
(35, 9, 'Serious injury', '', 30, '2015-04-18 06:13:33', '2015-04-18 06:13:33'),
(36, 10, 'Police', '', 10, '2015-04-18 06:13:44', '2015-04-18 06:13:44'),
(37, 10, 'Ambulance', '', 20, '2015-04-18 06:13:54', '2015-04-18 06:13:54'),
(38, 10, 'CCTV Control Room', '', 30, '2015-04-18 06:14:09', '2015-04-18 06:14:09'),
(39, 10, 'Homeless services', '', 40, '2015-04-18 06:14:21', '2015-04-18 06:14:21'),
(40, 10, 'Safe Space', '', 50, '2015-04-18 06:14:33', '2015-04-18 06:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` smallint(5) unsigned NOT NULL,
  `leader_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`),
  KEY `leader_id` (`leader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL,
  `is_manager` tinyint(1) unsigned NOT NULL,
  `is_owner` tinyint(1) unsigned NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `team_id`, `name`, `email`, `password`, `hash`, `is_active`, `is_manager`, `is_owner`, `last_login_date`, `last_login_ip`, `created`, `updated`) VALUES
(1, NULL, 'Andrej Griniuk', 'test@test.com', '9313f14ad66f24f8c28efd81e10ecd1e1007ac2a2b98e82c12c3749553328e37', 'c8015d05e7cda62c61d1ed3d0b1bc06641c1f5e1', 1, 1, 1, '2015-04-18 23:20:56', '10.0.2.2', '0000-00-00 00:00:00', '2015-04-18 23:20:56'),
(2, NULL, 'User', 'test2@test.com', '9313f14ad66f24f8c28efd81e10ecd1e1007ac2a2b98e82c12c3749553328e37', 'be073e73c3c62c96cbe07215f7b1fd03e0f6a1a1', 1, 1, 0, '2014-11-29 12:40:21', '10.0.2.2', '2014-11-29 09:09:40', '2014-11-29 12:40:21'),
(3, NULL, 'Christopher', 'christopher@insport.com', '9313f14ad66f24f8c28efd81e10ecd1e1007ac2a2b98e82c12c3749553328e37', '3d7ea2c43aa3e15580f812cc7836dd84b00b1760', 1, 1, 1, '2014-11-29 13:30:48', '10.0.2.2', '0000-00-00 00:00:00', '2014-11-29 13:30:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

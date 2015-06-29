-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2015 at 10:01 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

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
  `lat` decimal(11,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `title`, `lat`, `lng`, `created`, `modified`) VALUES
(1, 1, 'Town Hall', -33.87298819, 151.20667934, '0000-00-00 00:00:00', '2015-04-30 11:52:03'),
(2, 1, 'Kings Cross', -33.87486951, 151.22244000, '2015-04-28 11:41:21', '2015-04-28 11:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `lat` decimal(11,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `lat`, `lng`, `created`, `modified`) VALUES
(1, 'Sydney', -33.87896695, 151.19942665, '2015-04-17 11:37:00', '2015-04-28 11:42:57');

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
  `sub_support_type_id` smallint(5) unsigned DEFAULT NULL,
  `support_type_sub_id` smallint(5) unsigned NOT NULL,
  `comment` text NOT NULL,
  `lat` decimal(11,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `draft` tinyint(1) unsigned NOT NULL,
  `police` tinyint(1) unsigned NOT NULL,
  `contact` tinyint(1) unsigned NOT NULL,
  `report` tinyint(1) unsigned NOT NULL,
  `water_given` smallint(5) unsigned NOT NULL,
  `chupa_chups_given` smallint(5) unsigned NOT NULL,
  `thongs_given` smallint(5) unsigned NOT NULL,
  `vomit_bags_given` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `area_id`, `team_id`, `males_number`, `females_number`, `age`, `intoxication`, `receptiveness`, `referral_id`, `referral_comment`, `support_type_id`, `sub_support_type_id`, `support_type_sub_id`, `comment`, `lat`, `lng`, `draft`, `police`, `contact`, `report`, `water_given`, `chupa_chups_given`, `thongs_given`, `vomit_bags_given`, `created`, `modified`) VALUES
(4, 1, 1, 2, 2, NULL, 2, 1, 4, 'asd', 1, 2, 0, 'Directions to Safe spot to charge phone', -33.87148452, 151.20543480, 0, 0, 0, 0, 3, 0, 0, 0, '2015-04-18 21:29:57', '2015-04-30 13:30:33'),
(5, 1, 1, 1, 0, 1, 3, 3, 1, '', 10, NULL, 0, 'Heavily intoxicated minor referred to police', -33.86952473, 151.20625019, 0, 1, 0, 0, 1, 0, 0, 1, '2015-04-17 21:34:11', '2015-04-18 22:49:27'),
(6, 1, 1, 0, 3, 2, 2, 2, 4, '', 1, NULL, 0, '', -33.86542684, 151.20779514, 0, 0, 0, 0, 1, 3, 0, 0, '2015-04-18 21:35:19', '2015-04-18 21:36:21'),
(7, 1, 1, 0, 1, 3, 4, 3, 9, '', 5, NULL, 0, 'Drug effected women in danger of sexual assault however very unreceptive to our company', -33.86667404, 151.20689392, 0, 0, 0, 0, 0, 0, 0, 0, '2015-04-18 21:36:25', '2015-04-18 21:38:06'),
(8, 1, 2, 2, 1, 2, 2, 2, 2, 'Boston Pub', 9, NULL, 0, 'Minor cuts after falling, referred by Boston Pub', -33.87098567, 151.20813847, 0, 0, 0, 0, 2, 3, 0, 0, '2015-04-18 21:38:17', '2015-04-18 23:08:46'),
(9, 1, 1, 0, 1, 2, 4, 3, 6, '', 4, NULL, 0, 'Call Suzy at the end of the shift 0411234958\r\n\r\nDrug effected, called friend to take her home and wants to be contacted', -33.87290980, 151.20633602, 0, 0, 1, 0, 2, 0, 1, 0, '2015-04-18 21:39:56', '2015-04-18 21:41:59'),
(10, 1, 1, 1, 0, 3, 3, 1, 9, 'hgj\r\n', 3, 1, 0, 'Organised transport for a very drunk man. He was very pleasant and complimentary. Quite enjoyed this experience.', -33.87077188, 151.20865345, 0, 0, 0, 0, 1, 0, 0, 1, '2015-04-18 21:42:07', '2015-04-29 13:25:25'),
(11, 1, 1, 1, 0, 4, 4, 3, 2, '', 10, NULL, 0, 'Older gentlemen heavily effected was referred to police as he was threatening passing individuals. Police report needs to be filed if he is charge. Follow up.', -33.86906150, 151.20946884, 0, 1, 0, 0, 0, 0, 0, 1, '2015-04-17 21:43:29', '2015-04-18 21:45:33'),
(12, 1, 1, 2, 2, 2, 2, 1, 4, '', 1, NULL, 0, '2 young couples referred to safe space to charge their phones and meet with friends.', -33.86695912, 151.20504856, 0, 0, 0, 0, 3, 2, 2, 0, '2015-04-17 21:45:43', '2015-04-18 21:47:10'),
(13, 1, 1, 1, 0, 3, 3, 3, 5, '', 9, NULL, 0, 'Young man had been in a scuffle. Regretfully received first aid for a cut on his forehead. Young me can be so proud. Oh if only one day to be young and reckless again.', -33.86845573, 151.20603561, 0, 0, 0, 0, 0, 0, 0, 0, '2015-04-18 21:47:20', '2015-04-18 21:50:06'),
(14, 1, 1, 0, 3, 2, 2, 1, 6, '', 5, NULL, 0, '3 attractive girls being stalking and harassed by 2 heavily intoxicated foreigners. The asked to be contacted an hour after the left to see if they were followed.\r\n\r\n0444258393 - bethany', -33.86528430, 151.20856762, 0, 0, 1, 0, 2, 2, 2, 0, '2015-04-17 21:37:11', '2015-04-18 21:52:11'),
(15, 1, 1, 2, 1, 2, 3, 1, 9, '', 9, NULL, 0, 'First aid for deescalation of conflict and ambulance called after the fact.', -33.87640162, 151.20607853, 0, 0, 0, 0, 1, 0, 0, 0, '2015-04-18 21:52:53', '2015-04-18 22:34:06'),
(16, 1, 1, 1, 2, 2, 2, 1, 2, 'Canary Hole', 4, NULL, 0, 'Organised friend to pick up form the city', -33.87119946, 151.20556355, 0, 0, 0, 0, 1, 2, 0, 0, '2015-04-17 22:34:30', '2015-04-18 22:35:45'),
(17, 1, 1, 4, 0, 2, 3, 2, 1, '', 1, NULL, 0, '4 quite drunk men referred by police to sober up before heading home to their partners.', -33.87116383, 151.20491982, 0, 0, 0, 0, 4, 12, 0, 1, '2015-04-17 22:19:54', '2015-04-18 22:37:35'),
(18, 1, 1, 0, 2, 1, 3, 3, 9, '', 7, NULL, 0, '2 girls in danger were protected and then put in a cab', -33.86899023, 151.20371819, 0, 0, 0, 0, 0, 2, 0, 0, '2015-04-18 22:27:39', '2015-04-18 22:39:09'),
(19, 1, 1, 1, 1, 3, 1, 1, 9, '', 1, NULL, 0, 'Lollipop and hotel directions :)', -33.86870517, 151.20461941, 0, 0, 0, 0, 0, 2, 0, 0, '2015-04-17 22:39:18', '2015-04-18 22:40:11'),
(20, 1, 1, 4, 1, 2, 2, 2, 5, '', 4, NULL, 0, 'Friend referred large group to us for pickup directions from family', -33.86489232, 151.20320320, 0, 0, 0, 0, 0, 3, 0, 0, '2015-04-18 22:40:22', '2015-04-18 22:42:30'),
(21, 1, 1, 2, 2, 4, 3, 1, 2, 'Quay Resturant', 1, NULL, 0, 'Heavily intoxicated older group completely lost. Charming. Of to only be old, retired and happy.', -33.86193457, 151.20792389, 0, 0, 0, 0, 2, 3, 0, 0, '2015-04-17 22:43:10', '2015-04-18 22:45:03'),
(22, 1, 1, 1, 3, 2, 4, 2, 1, '', 5, NULL, 0, '', -33.86403707, 151.20526314, 0, 0, 0, 0, 1, 3, 1, 0, '2015-04-17 22:45:20', '2015-04-18 22:46:39'),
(23, 1, 1, 1, 1, 1, 3, 3, 9, '', 6, NULL, 0, 'Heavily intoxicated couple did not want to talk to us by girls shoe heel was broken and they knew there was broken glass abound. Things provided. Rigorously refused water.', -33.86589009, 151.21041298, 0, 0, 0, 0, 0, 0, 1, 0, '2015-04-18 22:47:23', '2015-04-18 22:49:09'),
(24, 1, 1, 2, 0, 2, 2, 2, 6, '', 4, NULL, 0, '', -33.86792123, 151.20479107, 0, 0, 0, 0, 1, 2, 0, 0, '2015-04-17 23:04:07', '2015-04-18 23:04:45'),
(25, 1, 1, 3, 0, 2, 2, 2, 7, '', 8, NULL, 0, '', -33.86414398, 151.20818138, 0, 0, 1, 0, 1, 0, 0, 0, '2015-04-17 23:04:49', '2015-04-18 23:06:22'),
(26, 1, 1, 1, 0, 4, 4, 2, 9, '', 10, NULL, 0, '', -33.86589009, 151.20800972, 0, 1, 0, 0, 0, 0, 0, 1, '2015-04-17 23:06:40', '2015-04-18 23:08:16'),
(31, 1, 1, 1, 2, 1, 1, 1, 3, 'asd', 1, 2, 0, 'asdas', -33.87059371, 151.20612144, 0, 0, 0, 0, 0, 0, 0, 0, '2015-06-08 17:25:22', '2015-06-08 17:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL,
  `pos` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `title`, `icon`, `color`, `pos`, `created`, `modified`) VALUES
(1, 'Police', 'fa-shield', '#743f3f', 10, '2015-04-18 05:28:32', '2015-04-28 13:09:07'),
(2, 'Venue', 'fa-hospital-o', '', 20, '2015-04-18 05:28:41', '2015-04-18 12:06:55'),
(3, 'Control Room', 'fa-video-camera', '', 30, '2015-04-18 06:21:02', '2015-04-18 12:07:15'),
(4, 'Self', 'fa-child', '', 40, '2015-04-18 06:21:10', '2015-04-18 12:32:47'),
(5, 'Friend', 'fa-user', '', 50, '2015-04-18 06:21:16', '2015-04-18 12:07:36'),
(6, 'Public', 'fa-users', '', 60, '2015-04-18 06:21:23', '2015-04-18 12:07:47'),
(7, 'Transport', 'fa-bus', '', 70, '2015-04-18 06:21:31', '2015-04-18 12:21:33'),
(8, 'Taxi', 'fa-taxi', '', 80, '2015-04-18 06:21:41', '2015-04-18 12:08:08'),
(9, 'TKA', 'fa-street-view', '', 90, '2015-04-18 06:21:46', '2015-04-18 12:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `support_types`
--

CREATE TABLE IF NOT EXISTS `support_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL,
  `pos` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `support_types`
--

INSERT INTO `support_types` (`id`, `parent_id`, `title`, `icon`, `color`, `pos`, `created`, `modified`) VALUES
(1, NULL, 'Directions', 'fa-subway', '', 10, '2015-04-18 05:36:23', '2015-04-18 12:36:20'),
(2, 1, 'Accommodation', '', '', 10, '2015-04-18 05:56:09', '2015-04-18 06:07:26'),
(3, NULL, 'Transport', 'fa-train', '', 20, '2015-04-18 06:02:21', '2015-04-18 12:36:37'),
(4, NULL, 'Friends / Family', 'fa-home', '', 40, '2015-04-18 06:05:10', '2015-04-18 12:44:33'),
(5, NULL, 'Sexual Assault', 'fa-bed', '', 50, '2015-04-18 06:05:33', '2015-04-18 12:44:46'),
(6, NULL, 'Injury', 'fa-hospital-o', '', 70, '2015-04-18 06:05:45', '2015-04-18 12:45:52'),
(7, NULL, 'Theft', 'fa-user-secret', '', 70, '2015-04-18 06:06:15', '2015-04-18 12:46:27'),
(8, NULL, 'Conflict De-escalation', 'fa-user-times', '', 60, '2015-04-18 06:06:28', '2015-04-18 12:44:58'),
(9, NULL, 'First Aid', 'fa-heart', '', 30, '2015-04-18 06:06:58', '2015-04-18 12:44:22'),
(10, NULL, 'Professional', 'fa-ambulance', '', 90, '2015-04-18 06:07:09', '2015-04-18 12:46:09'),
(11, 1, 'Toilets', '', '', 20, '2015-04-18 06:07:46', '2015-04-18 06:07:46'),
(12, 1, 'Other', '', '', 30, '2015-04-18 06:08:10', '2015-04-18 06:08:10'),
(13, 3, 'Taxi', '', '', 10, '2015-04-18 06:08:23', '2015-04-18 06:08:23'),
(14, 3, 'Train', '', '', 20, '2015-04-18 06:08:33', '2015-04-18 06:08:33'),
(15, 3, 'Bus', '', '', 30, '2015-04-18 06:08:44', '2015-04-18 06:08:44'),
(16, 3, 'Car pick-up', '', '', 40, '2015-04-18 06:08:57', '2015-04-18 06:08:57'),
(17, 4, 'Phone', '', '', 10, '2015-04-18 06:09:35', '2015-04-18 06:09:35'),
(18, 4, 'Social media', '', '', 20, '2015-04-18 06:09:45', '2015-04-18 06:09:45'),
(19, 4, 'In person', '', '', 30, '2015-04-18 06:09:56', '2015-04-18 06:09:56'),
(20, 4, 'Pick-up', '', '', 40, '2015-04-18 06:10:07', '2015-04-18 06:10:07'),
(21, 5, 'Minor', '', '', 10, '2015-04-18 06:10:22', '2015-04-18 06:10:22'),
(22, 5, 'Major', '', '', 20, '2015-04-18 06:10:35', '2015-04-18 06:10:35'),
(23, 5, 'Sexual assault occurred', '', '', 30, '2015-04-18 06:11:02', '2015-04-18 06:11:02'),
(24, 6, 'Minor', '', '', 10, '2015-04-18 06:11:17', '2015-04-18 06:11:17'),
(25, 6, 'Major', '', '', 20, '2015-04-18 06:11:29', '2015-04-18 06:11:29'),
(26, 6, 'Injury occurred', '', '', 30, '2015-04-18 06:11:39', '2015-04-18 06:11:39'),
(27, 7, 'Minor', '', '', 10, '2015-04-18 06:11:49', '2015-04-18 06:11:49'),
(28, 7, 'Major', '', '', 20, '2015-04-18 06:11:59', '2015-04-18 06:11:59'),
(29, 7, 'Theft occurred', '', '', 30, '2015-04-18 06:12:09', '2015-04-18 06:12:09'),
(30, 8, 'Minor', '', '', 10, '2015-04-18 06:12:24', '2015-04-18 06:12:24'),
(31, 8, 'Major', '', '', 20, '2015-04-18 06:12:39', '2015-04-18 06:12:39'),
(32, 8, 'Assault occurred', '', '', 30, '2015-04-18 06:12:54', '2015-04-18 06:12:54'),
(33, 9, 'Vomit bag & water', '', '', 10, '2015-04-18 06:13:11', '2015-04-18 06:13:11'),
(34, 9, 'Cuts, abrasions & blisters', '', '', 20, '2015-04-18 06:13:23', '2015-04-18 06:13:23'),
(35, 9, 'Serious injury', '', '', 30, '2015-04-18 06:13:33', '2015-04-18 06:13:33'),
(36, 10, 'Police', '', '', 10, '2015-04-18 06:13:44', '2015-04-18 06:13:44'),
(37, 10, 'Ambulance', '', '', 20, '2015-04-18 06:13:54', '2015-04-18 06:13:54'),
(38, 10, 'CCTV Control Room', '', '', 30, '2015-04-18 06:14:09', '2015-04-18 06:14:09'),
(39, 10, 'Homeless services', '', '', 40, '2015-04-18 06:14:21', '2015-04-18 06:14:21'),
(40, 10, 'Safe Space', '', '', 50, '2015-04-18 06:14:33', '2015-04-18 06:14:33');

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
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `area_id`, `leader_id`, `title`, `created`, `modified`) VALUES
(1, 1, 0, 'Team Alpha', '2015-04-19 00:18:04', '2015-04-19 01:57:49'),
(2, 1, 0, 'Team Beta', '2015-04-19 01:57:22', '2015-04-19 01:57:22'),
(3, 1, 0, 'Team Omega', '2015-04-19 01:57:38', '2015-04-19 01:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

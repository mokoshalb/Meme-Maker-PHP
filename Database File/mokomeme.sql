-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2017 at 02:04 PM
-- Server version: 10.1.24-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mokomeme`
--

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_ads`
--

CREATE TABLE IF NOT EXISTS `mokomeme_ads` (
  `ads_id` int(11) NOT NULL AUTO_INCREMENT,
  `ads_title` varchar(255) NOT NULL,
  `ads_code` text NOT NULL,
  PRIMARY KEY (`ads_id`),
  UNIQUE KEY `ads_id` (`ads_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mokomeme_ads`
--

INSERT INTO `mokomeme_ads` (`ads_id`, `ads_title`, `ads_code`) VALUES
(1, 'ad1', '<div class="ads"><img src="assets/images/ads.png" alt="ads banner"></div>');

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_images`
--

CREATE TABLE IF NOT EXISTS `mokomeme_images` (
  `images_id` int(11) NOT NULL AUTO_INCREMENT,
  `images_title` varchar(255) NOT NULL,
  `images_ext` varchar(255) NOT NULL,
  PRIMARY KEY (`images_id`),
  UNIQUE KEY `image_id` (`images_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `mokomeme_images`
--

INSERT INTO `mokomeme_images` (`images_id`, `images_title`, `images_ext`) VALUES
(1, '7O3JQgMjza', 'jpg'),
(2, 'toZ3lKLbIY', 'jpg'),
(3, 'StePjMxwUf', 'jpg'),
(4, 'tvGh453KnU', 'jpg'),
(5, 'SB9ijnfUZa', 'jpg'),
(6, 'T7CXNJUhGk', 'jpg'),
(7, 'EKbHoA5ePg', 'jpg'),
(8, 'OVLBdow2pz', 'jpg'),
(9, 'vncPhIRjwD', 'jpg'),
(10, 'AKjfGnpP4l', 'jpg'),
(11, 'uXTbmopjV3', 'jpg'),
(12, 'xcW7PvCdTA', 'jpg'),
(13, 'KtQ8oXl1LJ', 'jpg'),
(14, 'nSFZXxwpHT', 'jpg'),
(15, 'qYeFSb5Dpm', 'jpg'),
(16, 'EyL4MHQ8JU', 'jpg'),
(17, 'CJVQ9NEWwj', 'jpg'),
(18, 'iMIW2ZVnyh', 'jpg'),
(19, 'fz7xSlw8td', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_memes`
--

CREATE TABLE IF NOT EXISTS `mokomeme_memes` (
  `memes_id` int(11) NOT NULL AUTO_INCREMENT,
  `memes_title` varchar(255) NOT NULL,
  `memes_ext` varchar(255) NOT NULL,
  PRIMARY KEY (`memes_id`),
  UNIQUE KEY `memes_id` (`memes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `mokomeme_memes`
--

INSERT INTO `mokomeme_memes` (`memes_id`, `memes_title`, `memes_ext`) VALUES
(1, 'bv9TjZUinN', 'jpg'),
(2, 'nmuvkaA1LI', 'jpg'),
(3, 'vVYEfkZhXs', 'jpg'),
(4, 'XAIGtOdTm1', 'jpg'),
(5, 'JoKDVQae7f', 'jpg'),
(6, 'k48X7CPjZw', 'jpg'),
(7, 'F3tU1IxGaC', 'jpg'),
(8, '10LSP2klnV', 'jpg'),
(9, 'kruSywU8co', 'jpg'),
(10, '8Q4JMxphNq', 'jpg'),
(11, 'FewYVbvlXP', 'jpg'),
(12, 'HJMUF12RnZ', 'jpg'),
(13, 'qbM9wCKPEX', 'jpg'),
(14, 'LnxREKwQWf', 'jpg'),
(15, 'acpGkfuhm2', 'jpg'),
(16, 'Px6FBotAfd', 'jpg'),
(17, 'ifnMR4ANdt', 'jpg'),
(18, 'sFJufDABbc', 'jpg'),
(19, 'wqVb4aX0Eu', 'jpg'),
(20, 'xZLCDhIRb0', 'jpg'),
(21, 'qi3As5RxOF', 'jpg'),
(22, 'H9xMuJQa1r', 'jpg'),
(23, 'zyf1xploXc', 'jpg'),
(24, 'f1cVbu7j8W', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_menu`
--

CREATE TABLE IF NOT EXISTS `mokomeme_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `category_or_page_slug` varchar(255) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_page`
--

CREATE TABLE IF NOT EXISTS `mokomeme_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_layout` varchar(255) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_settings`
--

CREATE TABLE IF NOT EXISTS `mokomeme_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `receive_email` varchar(255) NOT NULL,
  `send_email` varchar(255) NOT NULL,
  `max_images` int(11) NOT NULL,
  `meta_title_home` text NOT NULL,
  `meta_keyword_home` text NOT NULL,
  `meta_description_home` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mokomeme_settings`
--

INSERT INTO `mokomeme_settings` (`id`, `logo`, `favicon`, `receive_email`, `send_email`, `max_images`, `meta_title_home`, `meta_keyword_home`, `meta_description_home`) VALUES
(1, 'logo.png', 'favicon.png', 'usmanokoya10@gmail.com', 'support@catonite.website', 20, 'MokoMeme - The best meme maker cms', 'make meme, create meme, build meme, design meme, funny meme, real meme, meme website', 'MokoMeme is a responsive meme maker that uses funny images to make funny memes');

-- --------------------------------------------------------

--
-- Table structure for table `mokomeme_user`
--

CREATE TABLE IF NOT EXISTS `mokomeme_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mokomeme_user`
--

INSERT INTO `mokomeme_user` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Okoya Usman', 'admin1234@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

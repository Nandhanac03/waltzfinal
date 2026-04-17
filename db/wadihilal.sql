-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2024 at 11:02 AM
-- Server version: 5.7.36
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wadihilal`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertisement_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_cover` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `album_cover`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`) VALUES
(1, 'Logo', '6e5d4a7ce8a46c4bc4c99741b92a9002.png', 1708943664, NULL, 1, NULL, 1),
(2, 'Clients', 'b90a5d04471189463c36a56c17a6ef50.png', 1708943681, NULL, 1, NULL, 1),
(3, 'Portfolio', '2ff124f43bed07cc0f0ef9240bc9d989.jpg', 1709198870, NULL, 1, NULL, 1),
(4, 'Innerpage Banner', '80a0d1f9c7252f9d2041557749f374ce.jpg', 1709201721, NULL, 1, NULL, 1),
(5, 'Brands', '61e4567c4ca30607f57ee0600674792a.png', 1710331004, NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_canonical_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `title_slug`, `subtitle`, `short_desc`, `description`, `desc_img`, `order_by`, `seo_title`, `seo_meta_keywords`, `seo_meta_description`, `seo_canonical_url`, `language`, `language_parent`, `created_by`, `updated_by`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Trading', 'trading', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'cc7a9e8b19b001143c498fdab1daa086.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010261, 1709187872, 1),
(2, 'CCTV Camera Systems', 'cctv-camera-systems', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'bd071a5758a27e3b226538140d88ff55.jpg', 1, '', '', '', NULL, 1, 0, 1, 1, 1709010305, 1709187868, 1),
(3, 'Access Control Systems', 'access-control-systems', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '373acedf681d71ae3c26be9788bafa37.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010317, 1709187864, 1),
(4, 'Networking', 'networking', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'f619a6eedb518688f99e31071398a879.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010327, 1709533627, 1),
(5, 'Gate Automation', 'gate-automation', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '32ea60cfdac458d7cb650849235d6e40.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010342, 1709187854, 1),
(6, 'Parking Management Systems', 'parking-management-systems', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '9a22b5dd2c91e0c6f3c98a0a521fd4f3.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010358, 1709187849, 1),
(7, 'Intercom', 'intercom', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '56e28ace2f05097fed776b865b61a775.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010368, 1709187844, 1),
(8, 'Telephone & PABX', 'telephone-pabx', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', 'CCTV(IP,Standalone/Embedded PC Based system)<br />Access Control System<br />Biometric/Fingerprint system<br />RFID/Proximity<br />Solution Gate<br />Barrier System<br />Intercom system(video &amp; audio)<br />Digital Door Locking System<br />Electromagnectic &amp; Fingerprint type<br />SMATV,IPTV Public Addressing System<br />Intrusion detection system', '28239ea1025d383d14e0280106e3edae.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010383, 1709188296, 1),
(9, 'SMATV', 'smatv', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '0a1bd9d115d4f6afa97a1a29bb48df88.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010391, 1709187748, 1),
(10, 'Smart Home', 'smart-home', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'a09cf622e343c631b97c3e2bc21c93d2.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709010399, 1709533664, 1),
(11, 'Storage Solution', 'storage-solution', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '3a496bf4e6da68c4528c8dbbed7477b9.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186202, 1709187738, 1),
(12, 'Digital Signage System', 'digital-signage-system', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '1221b723a0c71e1175908dd50d6bfbcd.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186237, 1709187733, 1),
(13, 'Public Addressing System', 'public-addressing-system', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '235b58eb3e7199c35008159776e9c1d2.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186244, 1709187729, 1),
(14, 'Q System and Anti-Theft', 'q-system-and-anti-theft', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '9b5d71df75c44d413157cea5e82865b6.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186252, 1709187724, 1),
(15, 'Hotel High Speed Internet Solution', 'hotel-high-speed-internet-solution', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '2451d669e86318ec493658e9596d9733.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186260, 1709187719, 1),
(16, 'Vehicle Tracking Devices', 'vehicle-tracking-devices', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '8133294439a57366acb8327f46b8b9ec.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186269, 1709187714, 1),
(17, 'Turnstile and Tripod', 'turnstile-and-tripod', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '78938d5d45f6a45d0222312f59973848.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186276, 1709187709, 1),
(18, 'Hotel Door Lock', 'hotel-door-lock', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'defec57f40a56b9d71ec54f94ecfdaa6.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186283, 1709187702, 1),
(19, 'VPN & Fire wall', 'vpn-fire-wall', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '48b99324414cadfdd5306425a020c989.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186289, 1709187561, 1),
(20, 'Structured Cabling', 'structured-cabling', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '427d1da3f4e814d4932a83fc9b71e753.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186298, 1709187566, 1),
(21, 'Fiber Optic Splicing', 'fiber-optic-splicing', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'acaaca076065b685687eb46b1294b58d.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186305, 1709187574, 1),
(22, 'Annual Maintenance Contacts', 'annual-maintenance-contacts', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'c5816d306248956404db047d91c1d300.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186312, 1709187579, 1),
(23, 'Workstations', 'workstations', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '4513912e59915da2266fee5ba120f798.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186318, 1709533569, 1),
(24, 'Desktop and Laptop', 'desktop-and-laptop', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'ec698f0bc158370200b69be9288e99e7.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186326, 1709187589, 1),
(25, 'Website Designing', 'website-designing', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'cd50c4dfa47709f2df024ff50463a810.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186335, 1709533769, 1),
(26, 'Social Media Marketing', 'social-media-marketing', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '1c9b9f689c55e7bbea5d53cd3a65c1a0.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186343, 1709533844, 1),
(27, 'Software Trading', 'software-trading', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', '6882a40ec6192ba57804291998111134.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186351, 1709187604, 1),
(28, 'Plotters,Printer & Scanners', 'plottersprinter-scanners', NULL, 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design, Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective CCTV Installations and Maintenance in,UAE.', '<ul><li>CCTV(IP,Standalone/Embedded PC Based system)</li><li>Access Control System</li><li>Biometric/Fingerprint system</li><li>RFID/Proximity</li><li>Solution Gate</li><li>Barrier System</li><li>Intercom system(video &amp; audio)</li><li>Digital Door Locking System</li><li>Electromagnectic &amp; Fingerprint type</li><li>SMATV,IPTV Public Addressing System</li><li>Intrusion detection system</li></ul>', 'ef1981b77bac6c756652ced3c677b7a9.jpg', NULL, '', '', '', NULL, 1, 0, 1, 1, 1709186359, 1709187468, 1),
(29, 'Computers', 'computers', NULL, 'test data', 'test description', '6bade1ebbdfce7bcc477fc425b560c43.jpg', NULL, '', '', '', NULL, 1, NULL, 1, NULL, 1709537696, NULL, 1),
(30, 'testin', 'testin', NULL, 'test', 'test', NULL, 30, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1712133048, 1712133104, 1),
(31, 'Test Service', 'test-service', NULL, 'res', '', NULL, 31, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, 1712133135, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--

DROP TABLE IF EXISTS `bio`;
CREATE TABLE IF NOT EXISTS `bio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_is` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A - Author, I - Illustrator',
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_slug` text COLLATE utf8mb4_unicode_ci,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `additional_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` text COLLATE utf8mb4_unicode_ci,
  `brand_img` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_canonical_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `title_slug`, `subtitle`, `additional_info`, `short_desc`, `description`, `desc_img`, `brand_img`, `language`, `seo_title`, `seo_meta_keywords`, `seo_meta_description`, `seo_canonical_url`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(1, 'Dolorum optio tempore voluptas dignissimos', 'dolorum-optio-tempore-voluptas-dignissimos', 'Maria Doe', 'Politics', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas nulla, id ornare mauris suscipit sed. Phasellus ut aliquet elit. Curabitur ut dui orci. Nulla varius turpis mauris, eget vulputate massa congue vel. Integer imperdiet in nulla venenatis gravida. In eget posuere orci. Nam consectetur sem suscipit, tincidunt neque a, auctor nulla. Sed ac velit vitae diam tristique fringilla nec eu nunc. Aliquam aliquam velit ipsum, consectetur ullamcorper tortor convallis ac. Suspendisse potenti. Vestibulum placerat, velit id rutrum laoreet, neque orci aliquet metus, quis aliquet tortor libero ac nunc. Sed suscipit feugiat erat. Aliquam in pretium lectus, quis dapibus leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam dignissim neque in velit finibus, vel mattis mauris feugiat. Integer egestas quam vel metus sodales tristique.', 'a3b26877bf71abd01fc731e94f93fe26.jpg', 'bdffed34c9e1c6afc9daba728a19c8cd.jpg', '1', NULL, NULL, NULL, NULL, 1709270873, '1', 1709271973, 1, 1),
(2, 'Nisi magni odit consequatur autem nulla dolorem', 'nisi-magni-odit-consequatur-autem-nulla-dolorem', 'Allisa Mayer', 'Sports', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas nulla, id ornare mauris suscipit sed. Phasellus ut aliquet elit. Curabitur ut dui orci. Nulla varius turpis mauris, eget vulputate massa congue vel. Integer imperdiet in nulla venenatis gravida. In eget posuere orci. Nam consectetur sem suscipit, tincidunt neque a, auctor nulla. Sed ac velit vitae diam tristique fringilla nec eu nunc. Aliquam aliquam velit ipsum, consectetur ullamcorper tortor convallis ac. Suspendisse potenti. Vestibulum placerat, velit id rutrum laoreet, neque orci aliquet metus, quis aliquet tortor libero ac nunc. Sed suscipit feugiat erat. Aliquam in pretium lectus, quis dapibus leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam dignissim neque in velit finibus, vel mattis mauris feugiat. Integer egestas quam vel metus sodales tristique.<br />Mauris et gravida felis. Phasellus mauris leo, bibendum eu velit sed, accumsan fringilla ligula. Curabitur molestie orci ut libero iaculis, a tincidunt sapien mollis. Aenean libero dolor, suscipit sed nulla nec, pellentesque facilisis purus. In facilisis blandit dui eget dictum. Praesent ultricies, purus nec ultricies convallis, ligula metus cursus ipsum, vel consectetur turpis purus a odio. Sed sodales consequat elit et ullamcorper. Suspendisse egestas posuere faucibus.', '73307a6a726de1343d7fcbf5d9ee6f80.jpg', 'c506d8b3c16295f9607887f0853d7953.jpg', '1', NULL, NULL, NULL, NULL, 1709272037, '1', NULL, NULL, 1),
(3, 'Possimus soluta ut id suscipit ea ut in quo quia et soluta', 'possimus-soluta-ut-id-suscipit-ea-ut-in-quo-quia-et-soluta', 'Mark Dower', 'Entertainment', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas nulla, id ornare mauris suscipit sed. Phasellus ut aliquet elit. Curabitur ut dui orci. Nulla varius turpis mauris, eget vulputate massa congue vel. Integer imperdiet in nulla venenatis gravida. In eget posuere orci. Nam consectetur sem suscipit, tincidunt neque a, auctor nulla. Sed ac velit vitae diam tristique fringilla nec eu nunc. Aliquam aliquam velit ipsum, consectetur ullamcorper tortor convallis ac. Suspendisse potenti. Vestibulum placerat, velit id rutrum laoreet, neque orci aliquet metus, quis aliquet tortor libero ac nunc. Sed suscipit feugiat erat. Aliquam in pretium lectus, quis dapibus leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam dignissim neque in velit finibus, vel mattis mauris feugiat. Integer egestas quam vel metus sodales tristique.<br />Mauris et gravida felis. Phasellus mauris leo, bibendum eu velit sed, accumsan fringilla ligula. Curabitur molestie orci ut libero iaculis, a tincidunt sapien mollis. Aenean libero dolor, suscipit sed nulla nec, pellentesque facilisis purus. In facilisis blandit dui eget dictum. Praesent ultricies, purus nec ultricies convallis, ligula metus cursus ipsum, vel consectetur turpis purus a odio. Sed sodales consequat elit et ullamcorper. Suspendisse egestas posuere faucibus.<br />Nam malesuada nulla sit amet gravida blandit. Nulla lacinia feugiat mi eu efficitur. Curabitur scelerisque sit amet dui vel tincidunt. Duis et risus interdum, venenatis mi non, eleifend mauris. Nullam egestas eros non neque convallis, ut scelerisque metus malesuada. Praesent lorem diam, vehicula vitae felis quis, condimentum consectetur libero. Quisque ac purus nunc. Donec posuere bibendum augue, a tincidunt nulla fermentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec vitae finibus turpis. In nec elit vel enim congue accumsan in in dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis luctus est nunc, id malesuada dui varius non. Aenean gravida pulvinar orci et scelerisque. Donec vitae nibh pellentesque, eleifend nisi in, molestie ligula.', '7a118b9869a5390333c133b168d39975.jpg', '1a38b7ca7e35a48cf41ae8c756432112.jpg', '1', NULL, NULL, NULL, NULL, 1709272089, '1', NULL, NULL, 1),
(4, 'consequatur autem Dolorum optio quia et soluta', 'consequatur-autem-dolorum-optio-quia-et-soluta', 'John', 'Movie', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas nulla, id ornare mauris suscipit sed. Phasellus ut aliquet elit. Curabitur ut dui orci. Nulla varius turpis mauris, eget vulputate massa congue vel. Integer imperdiet in nulla venenatis gravida. In eget posuere orci. Nam consectetur sem suscipit, tincidunt neque a, auctor nulla. Sed ac velit vitae diam tristique fringilla nec eu nunc. Aliquam aliquam velit ipsum, consectetur ullamcorper tortor convallis ac. Suspendisse potenti. Vestibulum placerat, velit id rutrum laoreet, neque orci aliquet metus, quis aliquet tortor libero ac nunc. Sed suscipit feugiat erat. Aliquam in pretium lectus, quis dapibus leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam dignissim neque in velit finibus, vel mattis mauris feugiat. Integer egestas quam vel metus sodales tristique.<br />Mauris et gravida felis. Phasellus mauris leo, bibendum eu velit sed, accumsan fringilla ligula. Curabitur molestie orci ut libero iaculis, a tincidunt sapien mollis. Aenean libero dolor, suscipit sed nulla nec, pellentesque facilisis purus. In facilisis blandit dui eget dictum. Praesent ultricies, purus nec ultricies convallis, ligula metus cursus ipsum, vel consectetur turpis purus a odio. Sed sodales consequat elit et ullamcorper. Suspendisse egestas posuere faucibus.<br />Nam malesuada nulla sit amet gravida blandit. Nulla lacinia feugiat mi eu efficitur. Curabitur scelerisque sit amet dui vel tincidunt. Duis et risus interdum, venenatis mi non, eleifend mauris. Nullam egestas eros non neque convallis, ut scelerisque metus malesuada. Praesent lorem diam, vehicula vitae felis quis, condimentum consectetur libero. Quisque ac purus nunc. Donec posuere bibendum augue, a tincidunt nulla fermentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec vitae finibus turpis. In nec elit vel enim congue accumsan in in dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis luctus est nunc, id malesuada dui varius non. Aenean gravida pulvinar orci et scelerisque. Donec vitae nibh pellentesque, eleifend nisi in, molestie ligula.', '1b6cb31e0f5b3ac91c42f7e250f3063f.jpg', '3c33baaf64b85a1d11ddd8e6b656398a.jpg', '1', NULL, NULL, NULL, NULL, 1709272601, '1', 1709279678, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `brand_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(11) NOT NULL,
  `full_name` varchar(55) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `current_loc` varchar(255) NOT NULL,
  `company` varchar(200) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `phonecode` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `notice_period` int(11) DEFAULT NULL,
  `join_now` enum('YES','NO') DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `career_id` int(11) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `job_role` varchar(255) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `resume` varchar(155) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_category_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `resume_cover` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

DROP TABLE IF EXISTS `career`;
CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `company_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_hour` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_iframe` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `address`, `email`, `phone`, `fax`, `work_hour`, `map`, `location_iframe`, `language`, `language_parent`, `created_by`, `updated_by`, `created_at`, `updated_at`, `active`) VALUES
(1, NULL, '305 Sheikh Omar Building,<br />Deira, Dubai,<br />United Arab Emirates', 'info@wadihilal.com', '+971 50 242 2097', '+971 42 863 700', 'Monday - Friday<br />9:00AM - 05:00PM', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102618.19840393699!2d55.24852697324879!3d25.237063175096353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5d1e3f24f6ed%3A0xb1f4e6f8f71243fa!2sWadi%20Hilal%20Technologies%20llc!5e0!3m2!1sen!2sin!4v1709093232306!5m2!1sen!2sin', NULL, 1, 1, 1, 1, 1612591767, 1709641051, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

DROP TABLE IF EXISTS `distributor`;
CREATE TABLE IF NOT EXISTS `distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `file` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` enum('I','V','O','L') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'I-Image,V-Video,O-Other,L-Link',
  `file_for` enum('A','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A-Album,O-Other',
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `parent_id`, `file`, `file_type`, `file_for`, `language`, `language_parent`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(29, 1, '6e5d4a7ce8a46c4bc4c99741b92a9002.png', 'I', 'A', 1, NULL, 1710839536, 1, NULL, NULL, 1),
(26, 2, 'b90a5d04471189463c36a56c17a6ef50.png', 'I', 'A', 1, NULL, 1710331138, 1, NULL, NULL, 1),
(25, 2, '3090aad562eb335b026f5d4cfc48dc81.jpg', 'I', 'A', 1, NULL, 1710331128, 1, NULL, NULL, 1),
(24, 2, 'b3c86210afefcd2e2788140f0286f9e8.jpg', 'I', 'A', 1, NULL, 1710331109, 1, NULL, NULL, 1),
(23, 2, 'aefc9f7c28e384dc7452030c8629e71a.png', 'I', 'A', 1, NULL, 1710331100, 1, NULL, NULL, 1),
(22, 2, '9ebaa0c2059f3c7547c5c51fc8822eae.png', 'I', 'A', 1, NULL, 1710331088, 1, NULL, NULL, 1),
(8, 3, '2ff124f43bed07cc0f0ef9240bc9d989.jpg', 'I', 'A', 1, NULL, 1709198937, 1, NULL, NULL, 1),
(28, 4, '80a0d1f9c7252f9d2041557749f374ce.jpg', 'I', 'A', 1, NULL, 1710839515, 1, NULL, NULL, 1),
(10, 3, 'fbf9a7efb8fb1f04352dc24bbb1cc7c2.jpg', 'I', 'A', 1, NULL, 1709198937, 1, NULL, NULL, 1),
(11, 3, '84133f35558423dada29e6f81b5ad0c2.jpg', 'I', 'A', 1, NULL, 1709198937, 1, NULL, NULL, 1),
(12, 3, 'c94b26d01357ba9a955726aebe152fed.jpg', 'I', 'A', 1, NULL, 1709198937, 1, NULL, NULL, 1),
(13, 3, '7ccae1f04c0e1b0bf81efbfe328551d5.jpg', 'I', 'A', 1, NULL, 1709198938, 1, NULL, NULL, 1),
(14, 3, '7f3f303f0a87cd315585a1c06afccd7a.jpg', 'I', 'A', 1, NULL, 1709198938, 1, NULL, NULL, 1),
(16, 5, '2d1bf89fb873267095346968c1322b47.png', 'I', 'A', 1, NULL, 1710331030, 1, NULL, NULL, 1),
(17, 5, 'c465232c56d0da5ea002a50853ceeff6.png', 'I', 'A', 1, NULL, 1710331035, 1, NULL, NULL, 1),
(18, 5, '895d6e62b80851fd88ede708fc5d13bd.png', 'I', 'A', 1, NULL, 1710331042, 1, NULL, NULL, 1),
(19, 5, 'f7b44ac1cdc765f73d5f03b0778c5fa8.png', 'I', 'A', 1, NULL, 1710331051, 1, NULL, NULL, 1),
(20, 5, 'ce12d52e8a225daeba9bcf6a3e09e689.png', 'I', 'A', 1, NULL, 1710331056, 1, NULL, NULL, 1),
(21, 5, '61e4567c4ca30607f57ee0600674792a.png', 'I', 'A', 1, NULL, 1710331062, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files_description`
--

DROP TABLE IF EXISTS `files_description`;
CREATE TABLE IF NOT EXISTS `files_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files_description`
--

INSERT INTO `files_description` (`id`, `file_id`, `title`, `subtitle`, `short_desc`, `description`, `link`, `button_name`, `language`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(29, 29, '', NULL, NULL, NULL, NULL, NULL, 1, 1710839536, 1, NULL, NULL, 1),
(26, 26, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331138, 1, NULL, NULL, 1),
(25, 25, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331128, 1, NULL, NULL, 1),
(24, 24, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331109, 1, NULL, NULL, 1),
(23, 23, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331100, 1, NULL, NULL, 1),
(22, 22, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331088, 1, NULL, NULL, 1),
(8, 8, 'CCTV Solutions', 'We Offer CCTV Solutions', NULL, NULL, NULL, NULL, 1, 1709198937, 1, 1709198961, 1, 1),
(28, 28, '', NULL, NULL, NULL, NULL, NULL, 1, 1710839515, 1, NULL, NULL, 1),
(10, 10, 'CCTV Solutions', 'We Offer CCTV Solutions', NULL, NULL, NULL, NULL, 1, 1709198937, 1, 1709199000, 1, 1),
(11, 11, 'Access Control System', 'Security Of a building', NULL, NULL, NULL, NULL, 1, 1709198937, 1, 1709199019, 1, 1),
(12, 12, 'Gate Barrier System', 'Securing an open space', NULL, NULL, NULL, NULL, 1, 1709198937, 1, 1709199032, 1, 1),
(13, 13, 'Cabling and Networking', 'Cable Installations', NULL, NULL, NULL, NULL, 1, 1709198938, 1, 1709199047, 1, 1),
(14, 14, 'Web Design', 'Web Design and Web based software', NULL, NULL, NULL, NULL, 1, 1709198938, 1, 1709198984, 1, 1),
(16, 16, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331030, 1, NULL, NULL, 1),
(17, 17, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331035, 1, NULL, NULL, 1),
(18, 18, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331042, 1, NULL, NULL, 1),
(19, 19, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331051, 1, NULL, NULL, 1),
(20, 20, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331056, 1, NULL, NULL, 1),
(21, 21, '', NULL, NULL, NULL, NULL, NULL, 1, 1710331062, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Admin'),
(2, 'customer', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions`
--

DROP TABLE IF EXISTS `groups_permissions`;
CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `value` tinyint(4) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleID_2` (`group_id`,`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_canonical_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `label_order` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci DEFAULT 'ltr',
  `for_site` tinyint(4) DEFAULT NULL,
  `for_news` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `code`, `flag`, `direction`, `for_site`, `for_news`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(1, 'English', 'en', '8672daf9225991775a05767d34dafce1.png', 'ltr', 1, 1, 1, 1594977047, 1, 1611988290, 1, 1),
(2, 'Arabic', 'ar', '8a90ae033e99f92592a3e8104ce3f027.png', 'rtl', 1, 0, 0, 1594977047, 1, 1617787778, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_content`
--

DROP TABLE IF EXISTS `mail_content`;
CREATE TABLE IF NOT EXISTS `mail_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` enum('H','L') COLLATE utf8mb4_unicode_ci DEFAULT 'L' COMMENT 'H - High, L - Low',
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_sample`
--

DROP TABLE IF EXISTS `mail_sample`;
CREATE TABLE IF NOT EXISTS `mail_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_send`
--

DROP TABLE IF EXISTS `mail_send`;
CREATE TABLE IF NOT EXISTS `mail_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_send_count` int(11) DEFAULT '0',
  `mail_status` enum('S','F','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'P - Processing, S - Success, F - Failed',
  `processed_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `title_slug`, `description`, `language`, `language_parent`, `menu_order`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(1, 0, 'Home', 'home', NULL, 1, NULL, 1, 1708937545, 1, NULL, NULL, 1),
(2, 0, 'About', 'about', NULL, 1, NULL, 2, 1708937556, 1, NULL, NULL, 1),
(3, 0, 'Services', 'services', NULL, 1, NULL, 3, 1708937564, 1, NULL, NULL, 1),
(4, 0, 'Portfolio', 'portfolio', NULL, 1, NULL, 4, 1708937573, 1, NULL, NULL, 1),
(5, 0, 'Contact', 'contact', NULL, 1, NULL, 5, 1708937583, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsroom` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_cover` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_img` text COLLATE utf8mb4_unicode_ci,
  `published_at` int(11) DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('D','P') COLLATE utf8mb4_unicode_ci DEFAULT 'D' COMMENT 'D - Drafted, P - Publishd',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_code`, `newsroom`, `parent_id`, `title`, `title_slug`, `subtitle`, `short_desc`, `description`, `link`, `location`, `contact`, `news_cover`, `secondary_img`, `published_at`, `seo_title`, `seo_meta_keywords`, `seo_meta_description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `language`, `active`) VALUES
(1, 'P24251', 15, NULL, 'CCTV Solutions', 'cctv-solutions', NULL, '', 'We offer CCTV Solutions Our CCTV SOLUTIONS Team in UAE right from carrying initial Surveys, Design,&nbsp;Engineering, Supply, Installation, Testing &amp; Commissioning of complete CCTV systems as per the&nbsp;requirements and make available world&#39;s leading &amp; latest technologies with Quality, which enables us&nbsp;to produce tailored systems for all purposes. Few of the Brands Included are Samsung, Axis&nbsp;communications, Dhahuva, HIK vision &amp; Bosch. Wadi Hilal is the master in delivering Cost Effective&nbsp;CCTV Installations and Maintenance in,UAE.&nbsp;CCTV(IP,Standalone/Embedded PC Based system)', NULL, NULL, NULL, 'ac977d5de595718cffa7f1682906863e.jpg', '4248953fc5a1038656bb45426f558b07.jpg', 0, 'Aliquip est nisi as', 'Reiciendis culpa et', 'Quo non aspernatur v', 'D', 1709284628, 1709286264, 1, 1, 1, 1),
(2, 'P24842', 16, NULL, 'ACCESS CONTROL SYSTEMS', 'access-control-systems', NULL, '', 'Security of a building or facility is of major importance. Access control can provide organizations with full control over where and when staff, visitors or vehicles can move at all times. This ensures the organization to monitor the activity in their organizations. Wadi Hilal Technologies&nbsp;provides access control systems in uae where programmed cards can be controlled from a central&nbsp;location as per your requirements.', NULL, NULL, NULL, '74858e1d96d2fe7eb2c8ab73f38a4c83.jpg', 'f5769858859db7d667f0be37462faa6b.jpg', 0, '', '', '', 'D', 1709285306, 1710842160, 1, 1, 1, 1),
(3, 'P24753', 17, NULL, 'INFORMATION & COMMUNICATION SYSTEMS AND INTERCOM SYSTEMS', 'information-communication-systems-and-intercom-systems', 'http://localhost/wadihilal/services/annual-maintenance-contacts', '', 'Our skilled engineers have a wealth of knowledge and experience to draw upon and when combined with slate of the art technology can overcome any IT challenge. The core philosophy of our IT company is to provide our clients with fast,convenient solutions that help to improve their overall efficiency.', NULL, NULL, NULL, 'b7d0e6564a7c5e1810dff1458af84742.jpg', 'f664df2977851292797a83d03573eb00.jpg', 0, '', '', '', 'D', 1709285358, 1712128431, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsroom`
--

DROP TABLE IF EXISTS `newsroom`;
CREATE TABLE IF NOT EXISTS `newsroom` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` enum('N','M','PV') COLLATE utf8mb4_unicode_ci DEFAULT 'N' COMMENT 'N - News, M - Multimedia, PV - Press Video',
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsroom`
--

INSERT INTO `newsroom` (`id`, `type`, `active`) VALUES
(1, 'N', 1),
(2, 'N', 1),
(3, 'N', 1),
(4, 'N', 1),
(5, 'N', 1),
(6, 'N', 1),
(7, 'N', 1),
(8, 'N', 1),
(9, 'N', 1),
(10, 'N', 1),
(11, 'N', 1),
(12, 'N', 1),
(13, 'N', 1),
(14, 'N', 1),
(15, 'N', 1),
(16, 'N', 1),
(17, 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_files`
--

DROP TABLE IF EXISTS `news_files`;
CREATE TABLE IF NOT EXISTS `news_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsroom` int(11) DEFAULT NULL,
  `file` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_for` enum('FI','MI','NT','NV','O') COLLATE utf8mb4_unicode_ci DEFAULT 'O' COMMENT 'FI - Featured Image, MI - Multimedia Image, NT - News Thumbnail , NV - News Video, O - Other',
  `file_type` enum('I','V','L','O') COLLATE utf8mb4_unicode_ci DEFAULT 'O' COMMENT 'I - Image, V - Video, L - Link, O - Other',
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_file_description`
--

DROP TABLE IF EXISTS `news_file_description`;
CREATE TABLE IF NOT EXISTS `news_file_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) DEFAULT NULL,
  `newsroom` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `menu` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `desc_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_desc_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `date`, `menu`, `order_by`, `title`, `title_slug`, `subtitle`, `short_desc`, `description`, `desc_img`, `brand_desc_img`, `language`, `language_parent`, `created_by`, `updated_by`, `created_at`, `updated_at`, `seo_title`, `seo_meta_keywords`, `seo_meta_description`, `active`) VALUES
(1, NULL, 1, NULL, 'Welcome to Our Website', 'welcome-to-our-website', '', 'We are leading IT Technology development and Trading Company<br />with strong focus on service Quality and client satisfaction.', NULL, '85376daf2d7b6feaada013cd60f5cd88.jpg', NULL, 1, 0, 1, 1, 1708942909, 1710839554, NULL, NULL, NULL, 1),
(2, NULL, 1, NULL, 'About Us', 'about-us-home', '', 'Wadi Hilal (WH) Technologies is a leading IT Technology development and Trading Company with strong focus on service Quality and client satisfaction. Providing customers with a complete solutions to their Current and future services. Our intelligent teams have the resources to carry out intricate installations of extra low voltage cabling for applications involving Fiber Optics,', '', '6463394db81f9f86dcfc8021e0f36361.jpg', '7cfefd27365831c93872dbb073d08888.jpg', 1, NULL, 1, NULL, 1708944643, NULL, '', '', '', 1),
(3, NULL, 1, NULL, 'Our Vision', 'our-vision', '', 'We commit to be innovative and responsive, while offering our high quality products and services at competitive prices.', '', NULL, NULL, 1, NULL, 1, NULL, 1708944762, NULL, '', '', '', 1),
(4, NULL, 1, NULL, 'Our Mission', 'our-mission', '', 'Our mission is to offer a leading edge integrated solutions in security and surveillance by repeatedly exceeding the expectations of our clients.', '', NULL, NULL, 1, NULL, 1, NULL, 1708944779, NULL, '', '', '', 1),
(5, NULL, 1, NULL, 'Stats Cover', 'stats-cover', '', '', '', 'd855b8d20773ad2c7577c2860d29bba7.jpg', NULL, 1, NULL, 1, NULL, 1708945523, NULL, '', '', '', 1),
(6, NULL, 1, NULL, 'Testimonials', 'testimonials', '', 'Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.', '', NULL, NULL, 1, NULL, 1, NULL, 1708945737, NULL, '', '', '', 1),
(7, NULL, 1, NULL, 'Contact', 'contact', '', 'Connect with Us: Elevate Your Experience Through Direct Communication', NULL, NULL, NULL, 1, 0, 1, 1, 1708946675, 1711539847, NULL, NULL, NULL, 1),
(8, NULL, 1, NULL, 'Services', 'services', '', '', '', NULL, NULL, 1, NULL, 225, NULL, 1709014706, NULL, '', '', '', 1),
(9, NULL, 1, NULL, 'Security Solutions', 'security-solutions', 'The Freedom to feel secure', '', '', NULL, NULL, 1, NULL, 225, NULL, 1709014789, NULL, '', '', '', 1),
(10, NULL, 1, NULL, 'Recent Posts', 'recent-posts', 'Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit', '', '', NULL, NULL, 1, NULL, 225, NULL, 1709014907, NULL, '', '', '', 1),
(11, NULL, 2, NULL, 'About Us', 'about-us', 'Short Description', 'Wadi Hilal Technology L.L.C is a solutions and integrated service management organization, offering comprehensive and standardized life cycle services to the small and medium size businesses. We offer higher end IT products and services, system integration &amp; site solutions. We are geared towards offering innovative and honest technical consultancy, services and solutions ranging from planning to implementation in the Information and Telecom field. Our strategic solutions and service delivery standards are designed to achieve higher level of productivity, efficiency, reliability and security with a proven global delivery standards. Our office is located in Dubai, U.A.E.<br />We strive for a true partnership with our clients. Our mission is to help you meet the demands of your business through customized management process and information technology solutions. Some examples of potential gains for your organization are:<ul><li><strong>Achieve faster business growth.</strong></li><li><strong>Improve your ability to increase volume, decrease cycle time, reduce costs, and achieve better results.</strong></li><li><strong>Become more effective and efficient in planning and implementing programs and projects.</strong></li><li><strong>Improve your ability to understand and anticipate customer requirements.</strong></li><li><strong>Increase the job performance capability of your workforce.</strong></li><li><strong>Improve your ability to handle organizational change, such as meeting the challenges created by the stresses of growth and new clients.</strong></li></ul>Wadi Hilal provides scalable solutions adapted to the business and culture of your organization. This approach involves listening carefully to you about the forces that stress your organization, then designing and implementing solutions that work for your unique situation.', NULL, '55202764ada3efe23321596577c86fa0.jpg', NULL, 1, 0, 1, 1, 1709184525, 1710310570, NULL, NULL, NULL, 1),
(12, NULL, 3, NULL, 'Services-Title', 'services-title', 'Services', NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1709185904, 1709186043, NULL, NULL, NULL, 1),
(13, NULL, 4, NULL, 'Portfolio-title', 'portfolio-title', 'Portfolio', 'Explore Our Work: A Showcase of Creativity and Innovation', NULL, NULL, NULL, 1, 0, 1, 1, 1709198318, 1711540122, NULL, NULL, NULL, 1),
(14, NULL, 5, NULL, 'Contact title', 'contact-title', 'Contact', '', '', NULL, NULL, 1, NULL, 1, NULL, 1709200118, NULL, '', '', '', 1),
(15, NULL, 1, NULL, 'WADI HILAL', 'wadi-hilal', '', 'Wadi Hilal (WH) Technologies is a leading IT Technology development and Trading Company with strong focus on service Quality and client satisfaction. Providing customers with a complete solutions to their Current and future services.', '', NULL, NULL, 1, NULL, 1, NULL, 1709202240, NULL, '', '', '', 1),
(16, NULL, 1, NULL, 'Terms of Service', 'terms-of-service', '', NULL, '<p>Accounts and membership</p>If you create an account in the Wadi hilal Website, you are responsible for maintaining the security of your account and you are fully responsible for all activities that occur under the account and any other actions taken in connection with it. We may, but have no obligation to, monitor and review new accounts before you may sign in and start using the Services. Providing false contact information of any kind may result in the termination of your account. You must immediately notify us of any unauthorized uses of your account or any other breaches of security. We will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions. We may suspend, disable, or delete your account (or any part thereof) if we determine that you have violated any provision of this Agreement or that your conduct or content would tend to damage our reputation and goodwill. If we delete your account for the foregoing reasons, you may not re-register for our Services. We may block your email address and Internet protocol address to prevent further registration. Any dispute or claim arising out of or in connection with this Application shall be governed and construed in accordance with the laws of United Arab Emirates. United Arab Emirates is our country of domicile and stipulate that the governing law is the local law. &ldquo;Wadi Hilal&rdquo; maintains the https://stylesdubai.com Website (&quot;Site&quot;). &lsquo;&rsquo;We will not trade with or provide any services to OFAC (Office of Foreign Assets Control) and sanctioned countries in accordance with the law of UAE&rsquo;&rsquo; &lsquo;&rsquo;Customer using the website who are Minor /under the age of 18 shall not register as a User of the website and shall not transact on or use the website&rsquo;&rsquo; &lsquo;&rsquo;Cardholder must retain a copy of transaction records and Merchant policies and rules&rsquo;&rsquo;<br />&nbsp;<h4>Links to other resources</h4> Although the Wadi Hilal Website may link to other resources (such as websites, Mobile applications, etc.), we are not, directly or indirectly, implying any approval, association, sponsorship, endorsement, or affiliation with any linked resource, unless specifically stated herein. We are not responsible for examining or evaluating, and we do not warrant the offerings of, any businesses or individuals or the content of their resources. We do not assume any responsibility or liability for the actions, products, services, and content of any other third parties. You should carefully review the legal statements and other conditions of use of any resource which you access through a link in the Wadi Hilal Website. Your linking to any other off-site resources is at your own risk. User is responsible for maintaining the confidentiality of his account.<br />&nbsp;<h4>Prohibited uses</h4> In addition to other terms as set forth in the Agreement, you are prohibited from using the Wadi Hilal Website or Content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, federal, provincial or state regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Wadi Hilal Website, third party products and services, or the Internet; (h) to spam, phish, pharm, pretext, spider, crawl, or scrape; (i) for any obscene or immoral purpose; or (j) to interfere with or circumvent the security features of the Wadi Hilal Website, third party products and services, or the Internet. We reserve the right to terminate your use of the Wadi Hilal Website for violating any of the prohibited uses.<br />&nbsp;<h4>Intellectual property rights</h4> &ldquo;Intellectual Property Rights&rdquo; means all present and future rights conferred by statute, common law or equity in or in relation to any copyright and related rights, trademarks, designs, patents, inventions, goodwill and the right to sue for passing off, rights to inventions, rights to use, and all other intellectual property rights, in each case whether registered or unregistered and including all applications and rights to apply for and be granted, rights to claim priority from, such rights and all similar or equivalent rights or forms of protection and any other results of intellectual activity which subsist or will subsist now or in the future in any part of the world. This Agreement does not transfer to you any intellectual property owned by the Operator or third parties, and all rights, titles, and interests in and to such property will remain (as between the parties) solely with the Operator. All trademarks, service marks, graphics and logos used in connection with the Wadi Hilal Website, are trademarks or registered trademarks of the Operator or its licensors. Other trademarks, service marks, graphics and logos used in connection with the Wadi Hilal Website may be the trademarks of other third parties. Your use of the Wadi Hilal Website grants you no right or license to reproduce or otherwise use any of the Operator or third party trademarks.<br />&nbsp;<h4>Severability</h4> All rights and restrictions contained in this Agreement may be exercised and shall be applicable and binding only to the extent that they do not violate any applicable laws and are intended to be limited to the extent necessary so that they will not render this Agreement illegal, invalid or unenforceable. If any provision or portion of any provision of this Agreement shall be held to be illegal, invalid or unenforceable by a court of competent jurisdiction, it is the intention of the parties that the remaining provisions or portions thereof shall constitute their agreement with respect to the subject matter hereof, and all such remaining provisions or portions thereof shall remain in full force and effect.<br />&nbsp;<h4>Payment Confirmation (for Services)</h4> We accept payments online using Visa and MasterCard credit/debit card in AED. Once the payment is made, the confirmation notice will be sent to the client via email within 24 hours of receipt of payment.<br />&nbsp;<h4>Cancellation Policy</h4> Customers can cancel services they have ordered for free up to two (2) hours from the service scheduled time. Cancelations that are less than two (2) hours from the service scheduled time will result in the customer being charged 30% of the order value. Please allow for up to 45 days for the refund transfer to be completed.<br />&nbsp;<h4>Refund Policy</h4> Refunds will be done only through the Original Mode of Payment<br />&nbsp;<h4>Delivery/Shipping Policy</h4> The multiple bookings/orders/shipments may result in multiple postings to the cardholder&rsquo;s monthly statement.<br />&nbsp;<h4>Changes and amendments</h4> The Application Policies and Terms &amp; Conditions may be changed or updated occasionally to meet the requirements and standards. Therefore, the Customers are encouraged to frequently visit these sections in order to be updated about the changes on the website. Modifications will be effective on the day they are posted.<br />&nbsp;<h4>Acceptance of these terms</h4> You acknowledge that you have read this Agreement and agree to all its terms and conditions. By accessing and using the Wadi Hilal Website you agree to be bound by this Agreement. If you do not agree to abide by the terms of this Agreement, you are not authorized to access or use the Wadi Hilal Website.<br />&nbsp;<h4>Contacting us</h4> If you have any questions, you may contact us at <a href=\"mailto:info@wadihilal.com\"> info@wadihilal.com </a><p>&nbsp;</p>', NULL, NULL, 1, 0, 1, 1, 1709209409, 1710321863, NULL, NULL, NULL, 1),
(17, NULL, 1, NULL, 'Privacy Policy', 'privacy-policy', '', NULL, 'Introduction<br /><br />We in Wadi Hilal respects your privacy and is committed to protecting it through our compliance with this privacy policy. This policy describes the types of information we may collect from you or that you may provide (&ldquo;Personal Information&rdquo;) through the Wadi Hilal&rdquo; Website and any of its related products and services, and our practices for collecting, using, maintaining, protecting, and disclosing that Personal Information. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update it.<br />Please read this Privacy Policy carefully to understand our policies and practices regarding your information and how we will treat it. By accessing or using our website and Website (collectively, the service), you agree to the terms of this Privacy Policy. This Privacy Policy may change from time to time. If you have questions about this Privacy Policy, you may contact us at info@wadihilal.com<br />This Policy is a legally binding agreement between you (&amp;ldqldquo;User&rdquo;, &ldquo;you&rdquo; or &ldquo;your&rdquo;) and this Website developer (&ldquo;Operator&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo; or &ldquo;our&rdquo;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &ldquo;User&rdquo;, &ldquo;you&rdquo; or &ldquo;your&rdquo; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Wadi Hilal Website. By accessing and using the Wadi Hilal Website, you acknowledge that you have read, understood, and agree to be bound by the terms of this Policy. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.<br /><br />Collection of personal information<br /><br />You may access and use the Wadi Hilal Website without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features offered in the Website, you may be asked to provide certain Personal Information (for example, your name, e-mail address, mobile number).<br />&nbsp;<br />We receive and store any information you knowingly provide to us when you create an account, or fill any forms in the Wadi Hilal Website. When required, this information may include the following:<br />Account details (such as user name, unique user ID, password, etc)<br />Contact information (such as email address, phone number, etc)<br />Basic personal information (such as name, country of residence, etc)<br />Certain features on the mobile device (such as contacts, calendar, gallery, location, etc)<br />All credit/debit cards&rsquo; details and personally identifiable information will NOT be stored, sold, shared, rented or leased to any third parties<br />You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of the features in the Wadi Hilal Website. Users who are uncertain about what information is mandatory are welcome to contact us.<br /><br />Use and processing of collected information<br /><br />We act as a data controller and a data processor when handling Personal Information, unless we have entered into a data processing agreement with you in which case you would be the data controller and we would be the data processor.<br />Our role may also differ depending on the specific situation involving Personal Information. We act in the capacity of a data controller when we ask you to submit your Personal Information that is necessary to ensure your access and use of the Website. In such instances, we are a data controller because we determine the purposes and means of the processing of Personal Information.<br />We act in the capacity of a data processor in situations when you submit Personal Information through Wadi Hilal Website. We do not own, control, or make decisions about the submitted Personal Information, and such Personal Information is processed only in accordance with your instructions. In such instances, the User providing Personal Information acts as a data controller.<br />In order to make Wadi Hilal Website available to you, or to meet a legal obligation, we may need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:<br />Create and manage user accounts<br />Request user feedback<br />Improve user experience<br />Run and operate Wadi Hilal Website<br />Processing your Personal Information depends on how you interact with the Website, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party. We may also combine or aggregate some of your Personal Information in order to better serve you and to improve and update our Website.<br />Note that under some legislations we may be allowed to process information until you object to such processing by opting out, without having to rely on consent or any other of the legal bases. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.<br /><br />Managing information<br /><br />You are able to delete certain Personal Information we have about you. The Personal Information you can delete may change as the Website change. When you delete Personal Information, however, we may maintain a copy of the unrevised Personal Information in our records for the duration necessary to comply with our obligations to our affiliates and partners, and for the purposes described below.<br /><br />Disclosure of information<br /><br />Depending on the requested Services or as necessary to complete any transaction or provide any Service you have requested, we may share your information with our affiliates, contracted companies, and service providers (collectively, &ldquo;Service Providers&rdquo;) we rely upon to assist in the operation of the Wadi Hilal Website available to you and whose privacy policies are consistent with ours or who agree to abide by our policies with respect to Personal Information.<br />Service Providers are not authorized to use or disclose your information except as necessary to perform services on our behalf or comply with legal requirements. Service Providers are given the information they need only in order to perform their designated functions, and we do not authorize them to use or disclose any of the provided information for their own marketing or other purposes.<br /><br />Retention of information<br /><br />We will retain and use your Personal Information for the period necessary to comply with our legal obligations, as long as your user account remains active, to enforce our agreements, resolve disputes, and unless a longer retention period is required or permitted by law.<br />We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification, and the right to data portability cannot be enforced after the expiration of the retention period.<br /><br />Payment data<br /><br />All credit/debit cards&rsquo; details and personally identifiable information will not be stored, sold, shared, rented or leased to any third parties.<br />If you make a payment for our products or services on our Website, the details you are asked to submit will be provided directly to our payment provider via a secured connection.<br />We will not pass any debit/credit card details to third parties.<br />We take appropriate steps to ensure data privacy and security including through various hardware and software methodologies. However, Wadi Hilal Website and Wadi Hilal cannot guarantee the security of any information that is disclosed online.<br /><br />Notifications<br /><br />We offer push notifications to which you may voluntarily subscribe at any time. To make sure push notifications reach the correct devices, we use a third-party push notifications provider who relies on a device token unique to your device which is issued by the operating system of your device. While it is possible to access a list of device tokens, they will not reveal your identity, your unique device ID, or your contact information to us or our third-party push notifications provider. We will maintain the information sent via e-mail in accordance with applicable laws and regulations. If, at any time, you wish to stop receiving push notifications, simply adjust your device settings accordingly.<br /><br />Links to other resources<br /><br />The Wadi Hilal Website contains links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to read the privacy statements of each and every resource that may collect Personal Information.<br /><br />Information security<br /><br />We secure the information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in our control and custody. However, no data transmission over the Internet or wireless network can be guaranteed.<br />Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Website cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.<br />As the security of Personal Information depends in part on the security of the device you use to communicate with us and the security you use to protect your credentials, please take appropriate measures to protect this information.<br /><br />Data breach<br /><br />In the event we become aware that the security of the Wadi Hilal Website has been compromised or Users&rsquo; Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the User as a result of the breach or if notice is otherwise required by law. When we do, we will post a notice in the Website.<br /><br />Changes and amendments<br /><br />We reserve the right to modify this Policy or its terms related to the Wadi Hilal Website at any time at our discretion. When we do, we will post a notification in the Website. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.<br />An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Website after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes.<br /><br />Acceptance of this policy<br /><br />You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Wadi Hilal Website and submitting your information you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Wadi Hilal Website.<br />Cookie Policy<br /><br />Wadi Hilal understands that your privacy is important to the data subject (&ldquo;you&rdquo;, &ldquo;your&rdquo;, &ldquo;user&rdquo;) and we are committed to being transparent about the technologies we use. This Cookie Policy explains how and why cookies and other similar technologies may be stored on and accessed from your device when you use or visit the Wadi Hilal website.<br />This Cookie Policy should be read together with our Privacy Policy and Terms of Use. This policy describes the information which Wadi Hilal collect from you when you access, or use its Website https://Wadi Hilal.net (&quot;Website&quot;)<br />The Website may have links to third party websites and services. This Policy does not apply to such third-party websites and services. By continuing to browse or use our sites, you agree that we can store and access essential cookies and other necessary tracking technologies as described in this policy.<br /><br />What are cookies and Other Tracking Technologies?<br /><br />A cookie is a small text file that a website saves on your computer or mobile device when you visit the site. It enables the website to remember your actions and preferences (such as login, language, font size and other display preferences) over a period of time, so you don&rsquo;t have to keep re-entering them whenever you come back to the site or browse from one page to another. The other tracking technologies work similarly to cookies and place small data files on your devices or monitor your website activity to enable us to collect information about how you use our websites. This allows our websites to recognize your device from those of other users of the websites. The information provided below about cookies also applies to these other tracking technologies.<br /><br />How do we use cookies and other tracking technologies?<br /><br />We use cookies to collect and store information when you visit our website and/or use any Wadi Hilal Group services. We use cookies for various purposes such as:<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;To provide you with Wadi Hilal Services<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;To provide non-personalized or personalized recommendations<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;To identify your location<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;To identify your browser and device.<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;For analytics and research,<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;Measure and analyze the audience for each page in order to subsequently improve the ergonomics, browsing, or visibility of content;<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;Measure the reliability of Website by analyzing the number of visits to its pages in real-time, and offer varied ads that are adapted to users&rsquo; areas of interest;<br />&middot; &nbsp; &nbsp; &nbsp; &nbsp;Cookies may also be saved by social media tools if you use these functionalities (e.g. Facebook, Google &amp; LinkedIn).<br /><br />Types of cookies<br /><br />We use different types of cookies on the Website for different purposes.<br />1. First-party cookies<br />These are the cookies that belong to us and which we place on your device or are those set by a website that is being visited by the user at the time. We use these cookies as they are absolutely necessary to provide you with Viacom 18 Services. If you choose to opt-out of these cookies, then we may not be able to provide you Services. The table below would help you to understand what these necessary cookies do.<br />2. Third-party cookies<br />These cookies are set by someone other than us when you access or use the Website. We have no control over third-party cookies - you can turn them off, but not through us. (For e.g. advertising agencies may place their cookies on our website which will collect tracking information and serve you with advertisements). We endeavour to identify these cookies before they are used so that you can decide whether you wish to accept them or not.<br />3. Persistent Cookies<br />We use persistent cookies to improve your experience of using the sites. This includes recording your acceptance of our Cookie Policy to remove the cookie message which first appears when you visit the site.<br />4. Session Cookies<br />Session Cookies are temporary and deleted from your machine when your web browser closes. We use session Cookies to help us track internet usage as described above.<br />You may refuse to accept browser Cookies by activating the appropriate setting on your browser. However, if you select this setting you may be unable to access certain parts of the Sites. Unless you have adjusted your browser setting so that it will refuse Cookies, our system will check if Cookies can be captured when you direct your browser to our Sites.<br />The data collected by the websites and/or through Cookies that may be placed on your computer will not be kept for longer than is necessary to fulfil the purposes mentioned above. In any event, such information will be kept in our database until we get explicit consent from you to remove all the stored cookies.<br /><br />We categorize cookies as follows:<br /><br />a) Essential cookies<br />These Cookies are necessary to allow us to operate our Sites so you may access them as you have requested. These Cookies, for example, let us recognize that you have created an account and have logged in/out to access site content. They also include Cookies that enable us to remember your previous actions within the same browsing session and secure our Sites. Some of the essential cookies we use include the Google tag Manager.<br />b) Analytical/Performance cookies<br />These Cookies are used by us or third-party service providers to analyse how the Sites are used and how they are performing. For example, these Cookies track what content is most frequently visited, watch history and from what locations our visitors come from. If you subscribe to a newsletter or otherwise register with the Sites, these Cookies may be correlated to you. These Cookies include, for example, Google Analytics and New Relic cookies.<br />c) Functionality cookies<br />These Cookies let us operate the Sites in accordance with the choices you make. These Cookies permit us to &quot;remember&quot; you in-between visits. For instance, we will recognize your user name and remember how you customized the Sites and services, for example by adjusting text size, fonts, languages and other parts of web pages that are alterable, and provide you with the same customizations during future visits.<br />d) Targeting or Advertising Cookies<br />These cookies are used to deliver content that is more relevant to you and your interests. They are also used to deliver targeted advertising or limit the number of times you see an advertisement as well as help measure the effectiveness of the advertising campaigns on Wadi Hilal websites. They remember that you have visited one of our websites and this information is shared with other parties, including advertisers and our agencies. Some of the advertising cookies that we use include DoubleClick and Facebook Custom Audience. These cookies may also be linked to site functionality provided by third-parties.<br /><br />Do these cookies collect personal data/identify me?<br /><br />Most types of these cookies track consumers via their Device ID or IP address, therefore, they may collect personal data<br /><br />Accepting or Refusing Cookies<br /><br />The cookie acceptance banner is not displayed on your screen. You may still choose at any time to delete or disable all or part of these cookies using your browser, with the exception of the First Party Cookies which are necessary for the Website to function.<br /><br />Contact Information<br />More detail on how businesses use cookies is available at www.allaboutcookies.org. If you have any queries regarding this Cookie Policy please contact us at info@wadihilal.com', NULL, NULL, 1, 0, 1, 1, 1709209665, 1710322068, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

DROP TABLE IF EXISTS `partner`;
CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `partner_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_key` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perm_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permKey` (`perm_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

DROP TABLE IF EXISTS `privacy_policy`;
CREATE TABLE IF NOT EXISTS `privacy_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `illustrator` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `additonal_info` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `binding` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_pages` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cover` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity_per_unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_size` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `manufacturer_retail_price` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `product_group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `units_in_stock` int(11) DEFAULT NULL,
  `units_on_order` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_product` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_canonical_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

DROP TABLE IF EXISTS `product_attribute`;
CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_order` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_value`
--

DROP TABLE IF EXISTS `product_attribute_value`;
CREATE TABLE IF NOT EXISTS `product_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_order` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `language_parent` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

DROP TABLE IF EXISTS `product_cart`;
CREATE TABLE IF NOT EXISTS `product_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_type` enum('GU','RU') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'GU-Guest User, RU-Registered User',
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `category_order` int(11) DEFAULT NULL,
  `seo_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_canonical_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_files`
--

DROP TABLE IF EXISTS `product_files`;
CREATE TABLE IF NOT EXISTS `product_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `file` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_lg` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_for` enum('IG','VG','O') COLLATE utf8mb4_unicode_ci DEFAULT 'O' COMMENT 'O-Other, IG-Image Gallery, V-Video Gallery',
  `file_type` enum('I','V','L','O') COLLATE utf8mb4_unicode_ci DEFAULT 'O' COMMENT 'I - Image, VL - Video Link, L - Link, O - Other',
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_file_description`
--

DROP TABLE IF EXISTS `product_file_description`;
CREATE TABLE IF NOT EXISTS `product_file_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

DROP TABLE IF EXISTS `product_group`;
CREATE TABLE IF NOT EXISTS `product_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `group_order` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_inquiry`
--

DROP TABLE IF EXISTS `product_inquiry`;
CREATE TABLE IF NOT EXISTS `product_inquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `guest_checkout` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `quotation_id` int(11) DEFAULT NULL,
  `order_ref_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_company` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country_id` int(11) DEFAULT NULL,
  `billing_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_date` int(11) DEFAULT NULL,
  `shipping_first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_company` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country_id` int(11) DEFAULT NULL,
  `shipping_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` enum('D','S','C','P') COLLATE utf8mb4_unicode_ci DEFAULT 'P' COMMENT 'D- Delivered, S - Shipped, C- Cancelled, P-Pending',
  `note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_order` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_details`
--

DROP TABLE IF EXISTS `product_order_details`;
CREATE TABLE IF NOT EXISTS `product_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_status` enum('D','S','C','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'D- Delivered, S - Shipped, C- Cancelled, P-Pending',
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_payment`
--

DROP TABLE IF EXISTS `product_order_payment`;
CREATE TABLE IF NOT EXISTS `product_order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `vat_amount` decimal(10,2) DEFAULT NULL,
  `shipping_charge` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment_option` tinyint(1) DEFAULT NULL COMMENT '1 - Cash on delivery',
  `payment_ref_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_msg` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('P','S','F') COLLATE utf8mb4_unicode_ci DEFAULT 'P' COMMENT 'F-Failed, P-Pending, S-Success',
  `payment_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_order` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_property`
--

DROP TABLE IF EXISTS `product_order_property`;
CREATE TABLE IF NOT EXISTS `product_order_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_details_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_value_id` int(11) DEFAULT NULL,
  `attribute_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_payment_option`
--

DROP TABLE IF EXISTS `product_payment_option`;
CREATE TABLE IF NOT EXISTS `product_payment_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_property`
--

DROP TABLE IF EXISTS `product_property`;
CREATE TABLE IF NOT EXISTS `product_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute_value_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_quotation`
--

DROP TABLE IF EXISTS `product_quotation`;
CREATE TABLE IF NOT EXISTS `product_quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `quotation_ref_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_status` enum('A','C','P','F') COLLATE utf8mb4_unicode_ci DEFAULT 'P' COMMENT 'A-Approved, C- Cancelled, P-Pending, F- Fulfilled',
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_quotation_details`
--

DROP TABLE IF EXISTS `product_quotation_details`;
CREATE TABLE IF NOT EXISTS `product_quotation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_quotation_property`
--

DROP TABLE IF EXISTS `product_quotation_property`;
CREATE TABLE IF NOT EXISTS `product_quotation_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_details_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_value_id` int(11) DEFAULT NULL,
  `attribute_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

DROP TABLE IF EXISTS `product_rating`;
CREATE TABLE IF NOT EXISTS `product_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_shipping_charge`
--

DROP TABLE IF EXISTS `product_shipping_charge`;
CREATE TABLE IF NOT EXISTS `product_shipping_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_box` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

DROP TABLE IF EXISTS `resumes`;
CREATE TABLE IF NOT EXISTS `resumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `career_id` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `resume` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vat` int(11) DEFAULT NULL,
  `contact_email` varchar(250) DEFAULT NULL,
  `order_email` varchar(250) DEFAULT NULL,
  `quotation_email` varchar(250) DEFAULT NULL,
  `call_us` varchar(250) DEFAULT NULL,
  `copyright` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `vat`, `contact_email`, `order_email`, `quotation_email`, `call_us`, `copyright`) VALUES
(1, NULL, 'girie.vst@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

DROP TABLE IF EXISTS `socialmedia`;
CREATE TABLE IF NOT EXISTS `socialmedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `name`, `url`, `status`, `created_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/', 1, '2023-01-02 11:46:03'),
(2, 'instagram', 'https://www.instagram.com/', 1, '2023-01-02 11:46:27'),
(3, 'whatsapp', 'https://wa.me/', 1, '2023-01-02 11:47:35'),
(4, 'twitter', 'https://twitter.com/', 1, '2023-06-02 15:36:51'),
(5, 'linkedin', 'https://www.linkedin.com/', 1, '2023-06-02 15:38:10'),
(6, 'Youtube', 'https://www.youtube.com/', 1, '2023-06-08 15:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_title` text COLLATE utf8mb4_unicode_ci,
  `count` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `title`, `slug_title`, `count`, `created_at`, `created_by`, `active`) VALUES
(1, 'Clients', 'clients', '232', 1708945113, '1', 1),
(2, 'Projects', 'projects', '521', 1708945123, '1', 1),
(3, 'Hours Of Support', 'hours-of-support', '1453', 1708945133, '1', 1),
(4, 'Workers', 'workers', '32', 1708945141, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_of_services`
--

DROP TABLE IF EXISTS `terms_of_services`;
CREATE TABLE IF NOT EXISTS `terms_of_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statement` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_by` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_img` text COLLATE utf8mb4_unicode_ci,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `statement`, `statement_by`, `designation`, `desc_img`, `language`, `language_parent`, `created_by`, `updated_by`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.', 'Saul Goodman', 'Ceo $ Founder', '7f8090ec8d6ffc4a8996b84c295223d5.jpg', 1, 0, 1, 1, 1708945810, 1709366319, 1),
(2, 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.', 'Sara Wilsson', 'Designer', '4932633f7f91683e6a58ea68994b9fbb.jpg', 1, NULL, 1, NULL, 1708945967, NULL, 1),
(3, 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.', 'Jena Karlis', 'Store Owner', '8ced9e1677842e3400042f53749cf957.jpg', 1, NULL, 1, NULL, 1708946038, NULL, 1),
(4, 'Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.', 'Matt Brandon', 'Freelancer', 'fec41a2e726942bc7a825c05e86c1de2.jpg', 1, NULL, 1, NULL, 1708946120, NULL, 1),
(5, 'Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.', 'John Larson', 'Entrepreneur', 'e764e6cef63f0eb32b7abbedecf0e6a9.jpg', 1, NULL, 1, NULL, 1708946163, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Default Password: password',
  `email` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_selector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgotten_password_selector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_on` int(11) UNSIGNED DEFAULT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$10$.dcUf4bc6CsigMee8H1Rc.sCwM9rfCuYjg.dNCKRDqsqXWPA1Wcby', 'admin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1712119396, 1, 'Admin', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `group_id` mediumint(8) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `value` tinyint(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userID` (`user_id`,`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `why_work_with_us`
--

DROP TABLE IF EXISTS `why_work_with_us`;
CREATE TABLE IF NOT EXISTS `why_work_with_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` text COLLATE utf8mb4_unicode_ci,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

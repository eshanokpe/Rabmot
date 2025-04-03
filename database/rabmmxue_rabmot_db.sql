-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2025 at 10:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rabmmxue_rabmot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addvehiclerenewals`
--

CREATE TABLE `addvehiclerenewals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `ownerfullname` varchar(255) DEFAULT NULL,
  `owneremail` varchar(255) DEFAULT NULL,
  `category` bigint(20) UNSIGNED DEFAULT NULL,
  `vehiclemake` varchar(255) DEFAULT NULL,
  `vehiclemodel` varchar(255) DEFAULT NULL,
  `year0fmake` year(4) DEFAULT NULL,
  `platenumber` varchar(255) DEFAULT NULL,
  `chassisnumber` varchar(255) DEFAULT NULL,
  `enginenumber` varchar(255) DEFAULT NULL,
  `vehiclecolor` varchar(255) DEFAULT NULL,
  `vehiclename` varchar(255) DEFAULT NULL,
  `vehicledocumentname` varchar(255) DEFAULT NULL,
  `ownersphonenumber` varchar(255) DEFAULT NULL,
  `registeredaddressofvehicle` text DEFAULT NULL,
  `emailAddress` varchar(255) DEFAULT NULL,
  `vehiclelicenseexpiry` date DEFAULT NULL,
  `insuranceexpiry` date DEFAULT NULL,
  `roadworthinessexpiry` date DEFAULT NULL,
  `hackneypermitexpiry` date DEFAULT NULL,
  `statecarriagepermitexpiry` date DEFAULT NULL,
  `hackneydutypermitexpiry` date DEFAULT NULL,
  `localgovernmentpermitexpiry` date DEFAULT NULL,
  `vehiclelicensepapers` varchar(255) DEFAULT NULL,
  `insurancepapers` varchar(255) DEFAULT NULL,
  `roadworthinesspapers` varchar(255) DEFAULT NULL,
  `hackneypermitpaper` varchar(255) DEFAULT NULL,
  `statecarriagepermit` varchar(255) DEFAULT NULL,
  `localgovernmentpermit` varchar(255) DEFAULT NULL,
  `midyearpermit` varchar(255) DEFAULT NULL,
  `meansofid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addvehiclerenewals`
--

INSERT INTO `addvehiclerenewals` (`id`, `user_id`, `userType`, `state_id`, `user_email`, `ownerfullname`, `owneremail`, `category`, `vehiclemake`, `vehiclemodel`, `year0fmake`, `platenumber`, `chassisnumber`, `enginenumber`, `vehiclecolor`, `vehiclename`, `vehicledocumentname`, `ownersphonenumber`, `registeredaddressofvehicle`, `emailAddress`, `vehiclelicenseexpiry`, `insuranceexpiry`, `roadworthinessexpiry`, `hackneypermitexpiry`, `statecarriagepermitexpiry`, `hackneydutypermitexpiry`, `localgovernmentpermitexpiry`, `vehiclelicensepapers`, `insurancepapers`, `roadworthinesspapers`, `hackneypermitpaper`, `statecarriagepermit`, `localgovernmentpermit`, `midyearpermit`, `meansofid`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, NULL, 'eshanokpe@gmail.com', NULL, NULL, 5, 'Similique in dolorem', 'Voluptate mollit qui', '2013', '994', '537', '231', 'Green', 'Deanna Sutton', 'Ash', '+1 (423) 892-1197', 'Anim ut duis ut mole', 'tususaj@mailinator.com', '1984-06-15', '2003-02-20', '2007-05-15', '2023-12-04', '2009-06-16', '2021-12-02', '1974-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 19:40:10', '2024-09-08 19:40:10'),
(5, 5, NULL, NULL, 'eshanokpe@gmail.com', NULL, NULL, 4, 'In ea cum ea consequ', 'Est dolor cupiditat', '2000', '483', '921', '480', 'Lemon', 'n', 'Black', '+1 (699) 496-6823', 'Ut aut atque delectu', 'divezyc@mailinator.com', '2022-06-12', '2002-06-22', '1971-12-25', '2021-08-08', '2019-07-04', '2004-12-15', '1974-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 19:43:02', '2024-11-12 08:16:45'),
(6, 5, NULL, NULL, 'eshanokpe@gmail.com', NULL, NULL, 5, 'Eius rerum proident', 'Laborum Qui sit odi', '2005', '962', '593', '928', 'Brown', 'Macon Hobbs', 'Black', '+1 (892) 906-4973', 'Veniam mollitia con', 'gisyti@mailinator.com', '2005-01-20', '1976-09-10', '1990-02-19', '1993-07-18', '1976-05-10', '2018-03-05', '1987-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 19:48:04', '2024-09-08 19:48:04'),
(7, 5, 'user', NULL, 'eshanokpe@gmail.com', NULL, NULL, 1, 'Voluptatum ut sit te', 'Qui ducimus fugiat', '2016', '830', '731', '623', 'Silver', 'Adria Holman', 'Black', '+1 (457) 843-2108', 'Eum voluptatem iure', 'himocycy@mailinator.com', '1976-01-01', '2008-11-15', '1972-12-15', '2008-10-03', '1986-03-15', '2009-04-02', '2007-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 19:58:45', '2024-09-08 19:58:45'),
(8, 5, NULL, NULL, NULL, NULL, NULL, 6, 'In sint debitis vel', 'Corporis vitae quas', '2009', '891', '278', '33', 'Cream', NULL, 'Black', '+1 (778) 242-2731', 'Quibusdam est sunt', 'hucex@mailinator.com', '1970-09-09', '2008-11-03', '1970-06-07', '1984-03-24', '1986-07-07', '1984-08-05', '1970-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 20:18:55', '2024-09-08 20:18:55'),
(9, 5, NULL, NULL, NULL, NULL, NULL, 1, 'Fugit explicabo Od', 'Accusamus perspiciat', '2009', '608', '882', '621', 'Cream', NULL, 'Black', '+1 (457) 992-8496', 'Minus a quisquam ven', 'rufup@mailinator.com', '2024-08-25', '2010-09-05', '1991-06-25', '2005-01-06', '1988-09-22', '1980-07-02', '2005-04-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 20:19:57', '2024-09-08 20:19:57'),
(10, 5, 'user', NULL, 'eshanokpe@gmail.com', NULL, NULL, 3, 'Velit numquam dolor', 'Et nihil omnis sed n', '2008', '989', '169', '672', 'Purple', 'Keith Rush', 'Black', '+1 (895) 314-1374', 'Quod ea accusamus mo', 'darejypa@mailinator.com', '1989-05-14', '2005-01-10', '1984-03-16', '1983-08-25', '1970-11-21', '1980-10-04', '1983-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-08 20:25:46', '2024-09-08 20:25:46'),
(11, 4, 'Admin', NULL, 'admin@gmail.com', 'Brian Jefferson', 'jirejypyke@mailinator.com', 2, 'Exercitationem sed m', 'Ut anim magnam commo', '2016', '122', '937', '728', 'Orange', 'Larissa Boyer', 'Individual Name Only', '+1 (434) 402-7559', 'Voluptas enim anim d', 'tenukyfa@mailinator.com', '2007-04-19', '2006-11-07', '1987-08-28', '2003-10-24', '2018-11-10', '2007-10-20', '2018-03-20', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2024-10-05 18:46:02', '2024-10-05 18:46:02'),
(12, 4, 'Admin', NULL, 'admin@gmail.com', 'Rylee Diaz', 'jirejypyke@mailinator.com', 4, 'Ea corrupti aut ad', 'Illo occaecat a et t', '2007', '77', '866', '74', 'White', 'James Sanchez', 'Individual & Company Name', '+1 (215) 976-8765', 'Ea ea ut eum fuga F', 'gehob@mailinator.com', '1974-06-08', '1979-09-11', '2003-10-07', '2003-02-24', '1995-03-12', '1986-10-12', '2000-09-20', 'vehiclerenewals/1728157686_Real Estate Brokage2.jpg', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2024-10-05 18:48:06', '2024-10-05 18:48:06'),
(13, 4, 'Admin', NULL, 'admin@gmail.com', 'Leilani Kent', 'jirejypyke@mailinator.com', 1, 'Nihil quia minim con', 'In nesciunt esse h', '2000', '564', '107', '693', 'Lemon', 'Skyler Stein', 'Company Name Only', '+1 (694) 518-1282', 'Velit corporis labor', 'gejalev@mailinator.com', '1999-05-08', '1999-11-17', '2018-09-05', '2006-12-23', '2011-08-27', '1989-11-04', '2001-08-22', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2024-10-18 17:01:34', '2024-10-18 17:01:34'),
(14, 4, 'Admin', NULL, 'admin@gmail.com', 'Leilani Kent', 'jirejypyke@mailinator.com', 1, 'Nihil quia minim con', 'In nesciunt esse h', '2000', '564', '107', '693', 'Lemon', 'Skyler Stein', 'Company Name Only', '+1 (694) 518-1282', 'Velit corporis labor', 'gejalev@mailinator.com', '1999-05-08', '1999-11-17', '2018-09-05', '2006-12-23', '2011-08-27', '1989-11-04', '2001-08-22', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2024-10-18 17:01:40', '2024-10-18 17:01:40'),
(15, 3, 'agent', NULL, 'agent@gmail.com', 'Dana Sanchez', 'hufebawe@mailinator.com', 1, 'Lorem ullam nesciunt', 'Obcaecati recusandae', '2013', '904', '985', '57', 'Lemon', 'Justina Kirby', 'Company Name Only', '+1 (407) 263-6465', 'Voluptatem rerum ali', 'nabakycyh@mailinator.com', '2008-09-17', '1974-05-09', '2014-08-17', '1978-12-21', '2012-10-19', '1997-04-01', '1994-09-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24 17:26:02', '2024-10-24 17:26:02'),
(16, 3, 'agent', NULL, 'agent@gmail.com', 'Rooney Pacheco', 'sakowylaki@mailinator.com', 3, 'Corrupti in delenit', 'Labore doloremque et', '2003', '832', '401', '608', 'Green', 'Justine Cross', 'Company Name Only', '+1 (114) 468-4367', 'Qui eaque dolorum su', 'vocopy@mailinator.com', '1990-10-22', '1995-02-15', '2019-02-13', '2015-02-16', '1983-10-24', '1991-02-14', '2008-07-13', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2024-10-24 17:40:57', '2024-10-24 17:40:57'),
(17, 10, 'user', NULL, 'eshanokpe@gmail.com', NULL, NULL, 4, 'Amet sit dignissimo', 'Quod magna quidem te', '2018', '438', '709', '312', 'Yellow', 'August Mcknight', 'Ash', '+1 (874) 937-9961', 'Dolor rerum architec', 'fehugywo@mailinator.com', '2025-01-08', '2025-02-06', '2008-12-28', '2025-02-07', '1974-10-23', '1993-12-13', '2004-01-05', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2025-01-01 12:30:56', '2025-02-07 09:04:36'),
(18, 10, 'user', NULL, 'eshanokpe@gmail.com', NULL, NULL, 1, 'Enim ducimus eum no', 'Pariatur Voluptatem', '2030', '754', '831', '739', 'Black', 'Carol Gonzales', 'Black', '+1 (694) 587-4121', 'Ad tempore ex persp', 'kajitub@mailinator.com', '2006-03-26', '1973-03-16', '2010-07-15', '2008-07-03', '1974-09-26', '2015-07-10', '2001-12-20', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', 'vehiclerenewals/', '2025-01-19 22:25:57', '2025-01-19 22:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `add_vehicle_ownerships`
--

CREATE TABLE `add_vehicle_ownerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `ownersfullname` varchar(255) DEFAULT NULL,
  `ownersemail` varchar(255) DEFAULT NULL,
  `category` bigint(20) UNSIGNED DEFAULT NULL,
  `vehiclemake` varchar(255) DEFAULT NULL,
  `vehiclemodel` varchar(255) DEFAULT NULL,
  `yearofmake` year(4) DEFAULT NULL,
  `platenumber` varchar(255) DEFAULT NULL,
  `chassisnumber` varchar(255) DEFAULT NULL,
  `enginenumber` varchar(255) DEFAULT NULL,
  `vehiclecolor` varchar(255) DEFAULT NULL,
  `vehiclepapername` varchar(255) DEFAULT NULL,
  `vehicledocumentname` varchar(255) DEFAULT NULL,
  `registeredaddressofvehicle` text DEFAULT NULL,
  `ownerfullname` varchar(255) DEFAULT NULL,
  `ownersNIN` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `emailaddress` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `vehiclelicenseexpiry` text DEFAULT NULL,
  `insuranceexpiry` text DEFAULT NULL,
  `roadworthinessexpiry` text DEFAULT NULL,
  `hackneypermitexpiry` text DEFAULT NULL,
  `statecarriagepermitexpiry` text DEFAULT NULL,
  `midyearpermit` text DEFAULT NULL,
  `localgovernmentpermitexpiry` text DEFAULT NULL,
  `vehiclelicensepapers` varchar(255) DEFAULT NULL,
  `proofofownership` varchar(255) DEFAULT NULL,
  `agreement` varchar(255) DEFAULT NULL,
  `meansofid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_vehicle_ownerships`
--

INSERT INTO `add_vehicle_ownerships` (`id`, `user_id`, `userType`, `user_email`, `ownersfullname`, `ownersemail`, `category`, `vehiclemake`, `vehiclemodel`, `yearofmake`, `platenumber`, `chassisnumber`, `enginenumber`, `vehiclecolor`, `vehiclepapername`, `vehicledocumentname`, `registeredaddressofvehicle`, `ownerfullname`, `ownersNIN`, `address`, `phonenumber`, `emailaddress`, `gender`, `occupation`, `vehiclelicenseexpiry`, `insuranceexpiry`, `roadworthinessexpiry`, `hackneypermitexpiry`, `statecarriagepermitexpiry`, `midyearpermit`, `localgovernmentpermitexpiry`, `vehiclelicensepapers`, `proofofownership`, `agreement`, `meansofid`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, 'eshanokpe@gmail.com', NULL, NULL, 5, 'Aut harum tempor ad', 'Quia quaerat optio', '2014', '503', '835', '680', 'Lemon', NULL, 'Black', 'Error excepteur face', 'Linda Morris', '77', 'Sunt incididunt odi', '+1 (134) 572-3083', 'nukagi@mailinator.com', 'Male', 'Ipsum placeat nostr', '1984-04-27', '1998-11-09', '1989-05-23', '1992-05-25', '1992-04-24', '1980-07-16', '1978-04-11', NULL, NULL, NULL, NULL, '2024-09-09 13:17:52', '2024-09-09 13:17:52'),
(2, 5, NULL, 'eshanokpe@gmail.com', NULL, NULL, 5, 'Aut harum tempor ad', 'Quia quaerat optio', '2014', '503', '835', '680', 'Lemon', NULL, 'Black', 'Error excepteur face', 'Linda Morris', '77', 'Sunt incididunt odi', '+1 (134) 572-3083', 'nukagi@mailinator.com', 'Male', 'Ipsum placeat nostr', '1984-04-27', '1998-11-09', '1989-05-23', '1992-05-25', '1992-04-24', '1980-07-16', '1978-04-11', NULL, NULL, NULL, NULL, '2024-09-09 13:24:15', '2024-09-09 13:24:15'),
(3, 5, 'user', 'eshanokpe@gmail.com', NULL, NULL, 5, 'Velit impedit Nam i', 'Qui cumque porro ips', '2001', '798', '470', '256', 'Grey', NULL, 'Black', 'Voluptatem Nisi et', 'Warren Chase', '45', 'Eu tenetur cupiditat', '+1 (501) 607-2581', 'getiwu@mailinator.com', 'Male', 'Aut tempor sint enim', '1987-12-28', '2019-07-05', '2012-10-05', '1995-12-27', '1975-11-10', '1979-07-22', '1978-06-08', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-09-09 13:56:19', '2024-09-09 13:56:19'),
(4, 5, 'user', 'eshanokpe@gmail.com', NULL, NULL, 5, 'Amet incidunt offi', 'Cillum velit consequ', '2021', '130', '924', '876', 'Violet', NULL, 'Ash', 'Dolore incididunt mo', 'Castor Montoya', '67', 'Aut ut autem ipsam a', '+1 (251) 374-3295', 'qojufur@mailinator.com', 'Male', 'At quis et elit dol', '1997-07-09', '1979-07-26', '2011-04-08', '1994-12-24', '2009-08-20', '2018-03-15', '2020-10-14', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-09-09 14:01:39', '2024-09-09 14:01:39'),
(5, 5, 'user', 'eshanokpe@gmail.com', NULL, NULL, 5, 'Proident quod ipsum', 'Eaque vero est rerum', '2016', '393', '901', '858', 'Green', 'Anne Carey', 'Black', 'Aute praesentium rem', 'Raven Jenkins', '70', 'Eum quia quas omnis', '+1 (149) 647-2198', 'dylazy@mailinator.com', 'Female', 'Dolor dolor labore i', '1977-02-12', '1978-08-23', '1991-08-16', '2004-10-14', '2015-01-04', '1986-12-13', '2007-05-28', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-09-09 14:04:05', '2024-09-09 14:04:05'),
(6, 5, 'user', 'eshanokpe@gmail.com', NULL, NULL, 2, 'Et consequatur Est', 'Quis neque odit labo', '2020', '856', 'chasis', '365', 'Wine', 'Ignatius Ramseyxxx', 'Ash', 'Blanditiis et non ea', 'Lacota Francis', '41', 'Lagos, Nigeria', '081392679601', 'gmail.com', 'Female', 'Aut fuga Autem cupi', '2017-03-07', NULL, NULL, NULL, NULL, NULL, NULL, 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-09-17 00:46:10', '2024-10-18 16:53:47'),
(7, 4, 'Admin', 'admin@gmail.com', 'Elijah Walter', 'jirejypyke@mailinator.com', 4, 'Aut explicabo Excep', 'Quia soluta autem au', NULL, '419', '94', '855', 'Violet', NULL, 'Ash', 'Totam ullamco ipsam', 'Elijah Walter', '93', 'Eveniet aliquid cum', '+1 (894) 819-3071', 'kezedafytu@mailinator.com', NULL, 'Mollit excepturi sae', '1994-10-10', '1998-06-16', '2017-11-23', '2005-10-21', '2015-12-26', '2002-04-04', '1993-04-26', '1728159645_IMG-20240626-WA0012.jpg', NULL, NULL, NULL, '2024-10-05 19:20:45', '2024-10-05 19:20:45'),
(8, 2, 'Admin', 'admin@gmail.com', 'Kylee Diaz', 'puzebaha@mailinator.com', 4, 'Exercitation ea qui', 'Libero non aperiam s', '2018', '350', '86', '552', 'Silver', NULL, 'Ash', 'Et aspernatur obcaec', 'Kylee Diaz', '68', 'Consectetur esse sit', '+1 (863) 161-6388', 'fufiqyvojy@mailinator.com', 'Female', 'Dignissimos dolore d', '1998-10-12', '1986-08-22', '2019-10-16', '2016-07-15', '1970-04-08', '2009-07-13', '1979-07-25', 'vehicleOwnership/1728159854_IMG-20240626-WA0012.jpg', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-10-05 19:24:14', '2024-10-05 19:24:14'),
(9, 6, 'Admin', 'admin@gmail.com', 'Emily Grimes', 'heqylyliz@mailinator.com', 3, 'Ut aut hic eu porro', 'Tempor magnam ut con', '2005', '509', '935', '919', 'Wine', NULL, 'Black', 'Eos dolor veritatis', 'Emily Grimes', '83', 'Ipsa eos officia mo', '+1 (867) 348-4656', 'zotihyxoge@mailinator.com', 'Female', 'Sed aliqua Corporis', '1991-08-28', '2013-08-28', '1970-09-17', '1985-02-12', '1976-08-28', '2000-02-16', '2002-10-13', 'vehicleOwnership/1728159991_Real Estate Brokage2.jpg', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-10-05 19:26:31', '2024-10-05 19:26:31'),
(10, 2, 'Admin', 'admin@gmail.com', 'James Boyle', 'puzebaha@mailinator.com', 4, 'Qui a numquam sunt', 'Doloribus ipsum et q', '2019', '672', '160', '538', 'Gold', NULL, 'Black', 'Dolor ut nulla quod', 'James Boyle', '38', 'Qui quisquam est omn', '+1 (204) 941-1506', 'pubunysuwa@mailinator.com', 'Female', 'Qui et deleniti cons', '1996-06-08', '1970-12-27', '2021-05-10', '1985-09-23', '2016-03-15', '1975-06-21', '2011-10-26', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-10-18 17:04:06', '2024-10-18 17:04:06'),
(11, 2, 'Admin', 'admin@gmail.com', 'Tanner Thornton', 'puzebaha@mailinator.com', 2, 'Sint nulla ea dolor', 'Harum officia dolore', '2009', '482', '179', '81', 'Ash', 'name', 'Ash', 'Illo et elit sed ab', 'Tanner Thornton', '97', 'Culpa itaque irure f', '626-5617', NULL, 'Female', 'Saepe tenetur volupt', '1996-04-08', NULL, NULL, NULL, NULL, NULL, NULL, 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-10-21 14:18:17', '2024-10-22 10:41:21'),
(12, 3, 'agent', 'agent@gmail.com', 'Imani Guerrero', 'pevopux@mailinator.com', 3, 'Voluptate nihil veri', 'Ullam illo commodo o', '2004', '47', '649', '540', 'Grey', NULL, 'Ash', 'Eos vero vel ullam', 'Imani Guerrero', '93', 'Nisi magni ad dolore', '+1 (213) 599-2787', 'jona@mailinator.com', 'Male', 'Dolor totam quod dol', '2004-10-07', '1971-01-28', '1970-05-08', '1983-12-02', '1994-10-24', '2006-03-21', '1993-12-25', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', 'vehicleOwnership/', '2024-10-24 18:10:37', '2024-10-24 18:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `add_vehicle_registrations`
--

CREATE TABLE `add_vehicle_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `ownerfullname` varchar(255) DEFAULT NULL,
  `owneremail` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `vehiclemake` varchar(255) DEFAULT NULL,
  `vehiclemodel` varchar(255) DEFAULT NULL,
  `year_of_make` year(4) DEFAULT NULL,
  `vehiclelicenseexpiry` date DEFAULT NULL,
  `chassisnumber` varchar(255) DEFAULT NULL,
  `enginenumber` varchar(255) DEFAULT NULL,
  `vehiclecolor` varchar(255) DEFAULT NULL,
  `applicantfullname` varchar(255) DEFAULT NULL,
  `applicantNIN` varchar(255) DEFAULT NULL,
  `residentialaddress` text DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `emailaddress` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `maritalstatus` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `custompapers` varchar(255) DEFAULT NULL,
  `meansofid` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) DEFAULT NULL,
  `created_month` varchar(255) DEFAULT NULL,
  `created_year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_vehicle_registrations`
--

INSERT INTO `add_vehicle_registrations` (`id`, `user_id`, `userType`, `user_email`, `ownerfullname`, `owneremail`, `category`, `vehiclemake`, `vehiclemodel`, `year_of_make`, `vehiclelicenseexpiry`, `chassisnumber`, `enginenumber`, `vehiclecolor`, `applicantfullname`, `applicantNIN`, `residentialaddress`, `phonenumber`, `emailaddress`, `gender`, `occupation`, `dateofbirth`, `maritalstatus`, `state`, `custompapers`, `meansofid`, `created_date`, `created_month`, `created_year`, `created_at`, `updated_at`) VALUES
(8, 3, 'Admin', 'admin@gmail.com', 'Elizabeth Goodman', 'mydamusepo@mailinator.com', '3', 'Assumenda sed nihil', 'Qui do nostrum eius', '2022', NULL, '77', '592', 'Wine', 'Knox Cunningham', '64', 'Velit et repellendus', '+1 (136) 623-2271', 'xywinoreci@mailinator.com', 'Male', 'Ut voluptatem ipsa', '1976-09-04', 'Married', 'Benue', 'vehicleRegistration/1729274610_WhatsApp Image 2024-10-17 at 19.56.54.jpeg', 'vehicleRegistration/1729274610_WhatsApp Image 2024-10-17 at 19.56.542.jpeg', NULL, NULL, NULL, '2024-10-18 17:03:30', '2024-10-18 17:03:30'),
(10, 3, 'agent', 'agent@gmail.com', 'Leah Fleming', 'teqyhanequ@mailinator.com', '1', 'Ut aspernatur provid', 'Aperiam quisquam lab', '2008', NULL, '462', '820', 'Blue', 'Odette Walls', '9', 'Omnis voluptate adip', '+1 (856) 547-3903', 'hulule@mailinator.com', 'Female', 'Dolores sit consecte', '2010-04-10', 'Divorced', 'Borno', 'vehicleRegistration/1729962325_01.jpg', 'vehicleRegistration/1729962325_01.png', '26 October 2024', 'October', '2024', '2024-10-26 16:05:25', '2024-10-26 16:05:25'),
(11, 10, 'user', 'eshanokpe@gmail.com', NULL, NULL, '2', 'Dolorem nihil cillum', 'Ea rerum eiusmod dol', '2001', NULL, '75', '834', 'Green', 'Trevor Fischer', '12', 'Incididunt obcaecati', '+1 (789) 447-9584', 'xapo@mailinator.com', 'Female', 'Velit incididunt eos', '2003-08-26', 'Married', 'Kwara', 'vehicleRegistration/1738917584_143.jpg', 'vehicleRegistration/1738917584_144 (1).jpg', '07 February 2025', 'February', '2025', '2025-02-07 07:39:44', '2025-02-07 07:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `last_login`, `login_ip`, `otp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$SDWpI4m9YUWunhV9hP/spuxDlU25RYtkN52ts4CzC5fZjnHxv.Zwq', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_token` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `status` enum('active','disable','delete') NOT NULL DEFAULT 'active',
  `userType` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `username`, `email`, `email_token`, `fullname`, `phone_no`, `password`, `location`, `gender`, `profile_image`, `status`, `userType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mafisa', 'gihysy@mailinator.com', NULL, 'Jeanette Copeland', '+1 (901) 942-6512', '$2y$10$fD8r7M48THb0.cVqCg3aLOEhRbF4gS1QW6RJf9G8aL7u20v1BT/06', 'Quisquam nulla quo q', 'male', NULL, 'active', 'agent', '2024-10-10 11:20:14', '2024-10-10 11:20:14', NULL),
(3, 'Agent', 'agent@gmail.com', NULL, 'Agent Eshanokpe Daniel', '08139267960', '$2y$10$81KkZA5rC4bPheOcCw/GBOCzQk6F4hFToTX71Hs1VmvNLrbLdfwru', 'Lagos', 'male', NULL, 'active', 'agent', '2024-10-20 06:14:22', '2024-10-20 06:14:22', NULL),
(4, 'natoh', 'hizagowug@mailinator.com', NULL, 'Zeph Crane', '+1 (418) 437-5774', '$2y$10$7xzGR4j.r5w2W/fZH8rj9eweIzn6t7Z1z31O348BQx1w0av50phkG', 'Voluptatem voluptate', 'male', NULL, 'active', 'agent', '2024-10-20 06:15:12', '2024-10-20 06:15:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_password_models`
--

CREATE TABLE `agent_password_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_password_models`
--

INSERT INTO `agent_password_models` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'agent@gmail.com', 'WPmJbwl3AOrURG2nWrjTpJLEhZ7muroK5ANfNuSUuBah0lYMblKhtoVWaVUe0YKT', '2025-02-20 12:04:45', '2025-02-20 12:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `changeof_ownership_prices`
--

CREATE TABLE `changeof_ownership_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `vehicle_type_id` varchar(255) DEFAULT NULL,
  `random_vehicleLicense` int(11) DEFAULT NULL,
  `random_hacneyPermit` int(11) DEFAULT NULL,
  `random_policeCmris` int(11) DEFAULT NULL,
  `random_cost` int(11) DEFAULT NULL,
  `customised_vehicleLicense` int(11) DEFAULT NULL,
  `customised_hacneyPermit` int(11) DEFAULT NULL,
  `customised_policeCmris` int(11) DEFAULT NULL,
  `customised_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `changeof_ownership_prices`
--

INSERT INTO `changeof_ownership_prices` (`id`, `state_id`, `vehicle_type_id`, `random_vehicleLicense`, `random_hacneyPermit`, `random_policeCmris`, `random_cost`, `customised_vehicleLicense`, `customised_hacneyPermit`, `customised_policeCmris`, `customised_cost`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 8200, 8200, 10000, 190400, 8200, 8200, 10000, 250600, '2024-08-24 04:17:10', '2024-08-24 08:17:10'),
(2, '3', '2', 8200, 8200, 10000, 197500, 8200, 8200, 10000, 258500, '2024-08-24 04:19:17', '2024-08-24 08:19:17'),
(3, '2', '7', 8200, 8200, 10000, 200500, 8200, 8200, 10000, 270400, '2024-08-24 04:15:53', '2024-08-24 08:15:53'),
(4, '4', '7', 8200, 8200, 10000, 197500, 4600, 6000, 10000, 258500, '2024-08-24 04:18:27', '2024-08-24 08:18:27'),
(5, '5', '7', 8200, 8200, 10000, 195300, 8200, 8200, 10000, 255300, '2024-08-24 04:16:31', '2024-08-24 08:16:31'),
(6, '6', '1', 4600, 6000, 10000, 85400, 4600, 6000, 10000, 350000, '2024-08-24 05:48:29', '2024-08-24 09:48:29'),
(7, '1', '2', 5600, 6000, 10000, 95000, 5600, 6000, 10000, 370000, '2024-08-24 04:34:34', '2024-08-24 08:34:34'),
(8, '2', '2', 6400, 6700, 10000, 97000, 6400, 6700, 10000, 370000, '2024-08-24 05:26:54', '2024-08-24 09:26:54'),
(9, '3', '2', 5600, 6000, 10000, 95000, 5600, 6000, 10000, 350000, '2024-08-24 05:28:26', '2024-08-24 09:28:26'),
(10, '4', '2', 5600, 6000, 10000, 95000, 5600, 6000, 10000, 350000, '2024-08-24 05:27:58', '2024-08-24 09:27:58'),
(11, '5', '2', 5600, 6000, 10000, 95000, 5600, 6000, 10000, 350000, '2024-08-24 05:27:31', '2024-08-24 09:27:31'),
(12, '6', '2', 5600, 6000, 10000, 95400, 5600, 6000, 10000, 360000, '2024-08-24 05:05:06', '2024-08-24 09:05:06'),
(13, '4', '3', 7500, 7200, 10000, 120000, 7500, 7200, 10000, 350000, '2024-08-24 05:46:48', '2024-08-24 09:46:48'),
(14, '2', '3', 7500, 7200, 10000, 135000, 7500, 7200, 10000, 395000, '2024-08-24 05:32:02', '2024-08-24 09:32:02'),
(15, '3', '3', 7500, 7200, 10000, 120000, 7500, 7200, 10000, 350000, '2024-08-24 05:43:43', '2024-08-24 09:43:43'),
(16, '1', '3', 7500, 7200, 10000, 130000, 7500, 7200, 10000, 385000, '2024-08-24 05:31:02', '2024-08-24 09:31:02'),
(17, '5', '3', 7500, 7200, 10000, 120000, 7500, 7200, 10000, 320000, '2024-08-24 05:45:51', '2024-08-24 09:45:51'),
(18, '6', '3', 7500, 7200, 10000, 120000, 7500, 7200, 10000, 390400, '2024-08-24 05:30:20', '2024-08-24 09:30:20'),
(19, '6', '7', 8200, 8200, 10000, 195200, 8200, 8200, 10000, 255300, '2024-08-24 08:20:36', '2024-08-24 08:20:36'),
(20, '1', '4', 8200, 8200, 10000, 190400, 8200, 8200, 10000, 250600, '2024-08-24 08:23:23', '2024-08-24 08:23:23'),
(21, '2', '4', 8200, 8200, 10000, 200500, 8200, 8200, 10000, 270400, '2024-08-24 08:24:01', '2024-08-24 08:24:01'),
(22, '6', '5', 8200, 8200, 10000, 195200, 8200, 8200, 10000, 255300, '2024-08-24 08:24:49', '2024-08-24 08:24:49'),
(23, '5', '5', 8200, 8200, 10000, 195300, 8200, 8200, 10000, 255300, '2024-08-24 08:25:21', '2024-08-24 08:25:21'),
(24, '3', '5', 8200, 8200, 10000, 197500, 8200, 8200, 10000, 258500, '2024-08-24 08:25:54', '2024-08-24 08:25:54'),
(25, '4', '5', 8200, 8200, 10000, 197500, 8200, 8200, 10000, 258500, '2024-08-24 08:26:33', '2024-08-24 08:26:33'),
(26, '1', '5', 7900, 7900, 10000, 180400, 7900, 7900, 10000, 240600, '2024-08-24 08:27:58', '2024-08-24 08:27:58'),
(27, '2', '5', 7900, 7900, 10000, 190500, 7900, 7900, 10000, 260400, '2024-08-24 08:28:34', '2024-08-24 08:28:34'),
(28, '6', '5', 7900, 7900, 10000, 185200, 7900, 7900, 10000, 245300, '2024-08-24 08:29:16', '2024-08-24 08:29:16'),
(29, '5', '5', 7900, 7900, 10000, 185300, 7900, 7900, 10000, 245300, '2024-08-24 08:29:55', '2024-08-24 08:29:55'),
(30, '3', '5', 7900, 7900, 10000, 187500, 7900, 7900, 10000, 248500, '2024-08-24 08:30:36', '2024-08-24 08:30:36'),
(31, '4', '5', 7900, 7900, 10000, 187500, 7900, 7900, 10000, 248500, '2024-08-24 08:31:07', '2024-08-24 08:31:07'),
(33, '2', '1', 4600, 6000, 10000, 92000, 4600, 6000, 10000, 36500, '2024-08-24 09:51:37', '2024-08-24 09:51:37'),
(34, '5', '1', 4600, 5000, 10000, 90000, 4600, 5000, 10000, 320000, '2024-08-24 09:52:35', '2024-08-24 09:52:35'),
(35, '4', '1', 4600, 5000, 10000, 90000, 4600, 5000, 10000, 340000, '2024-08-24 09:53:33', '2024-08-24 09:53:33'),
(36, '3', '1', 4600, 5000, 10000, 90000, 4600, 5000, 10000, 340000, '2024-08-24 09:54:22', '2024-08-24 09:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `change_of_ownerships`
--

CREATE TABLE `change_of_ownerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `owner_id` int(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `vehicle_category` varchar(255) DEFAULT NULL,
  `vehiclelicenseexpiry_date` varchar(250) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `emailaddress` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `platenumber` text DEFAULT NULL,
  `vehiclelicenseexpiry` text DEFAULT NULL,
  `insuranceexpiry` text DEFAULT NULL,
  `roadworthinessexpiry` text DEFAULT NULL,
  `hackneypermitexpiry` text DEFAULT NULL,
  `statecarriagepermitexpiry` text DEFAULT NULL,
  `hackneydutypermitexpiry` text DEFAULT NULL,
  `localgovernmentpermitexpiry` text DEFAULT NULL,
  `policeCMRIS` double DEFAULT NULL,
  `vehiclelicensepapers` varchar(255) DEFAULT NULL,
  `proofofownership` varchar(255) DEFAULT NULL,
  `agreement` varchar(255) DEFAULT NULL,
  `meansofid` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `totalamount` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `change_of_ownerships`
--

INSERT INTO `change_of_ownerships` (`id`, `user_id`, `user_email`, `owner_id`, `userType`, `process_id`, `process_type`, `vehicle_category`, `vehiclelicenseexpiry_date`, `fullname`, `address`, `phonenumber`, `emailaddress`, `gender`, `occupation`, `platenumber`, `vehiclelicenseexpiry`, `insuranceexpiry`, `roadworthinessexpiry`, `hackneypermitexpiry`, `statecarriagepermitexpiry`, `hackneydutypermitexpiry`, `localgovernmentpermitexpiry`, `policeCMRIS`, `vehiclelicensepapers`, `proofofownership`, `agreement`, `meansofid`, `payment_status`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO667586', 'Change of Ownership', 'TRUCK: (20 tons)', 'lessthan1month', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 188300.00, '2024-10-01 11:03:14', '2024-10-01 11:03:14'),
(2, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO193337', 'Change of Ownership', 'TRUCK: (20 tons)', 'morethan1year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 212000.00, '2024-10-01 11:08:34', '2024-10-01 11:08:34'),
(3, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO759163', 'Change of Ownership', 'TRUCK: (20 tons)', 'morethan1year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 212000.00, '2024-10-01 11:08:40', '2024-10-01 11:08:40'),
(4, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO279707', 'Change of Ownership', 'TRUCK: (20 tons)', 'morethan1year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 212000.00, '2024-10-01 11:08:55', '2024-10-01 11:08:55'),
(5, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO491872', 'Change of Ownership', 'TRUCK: (20 tons)', 'morethan1year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 222000.00, '2024-10-01 11:09:24', '2024-10-01 11:09:24'),
(6, '3', 'agent@gmail.com', 2, 'agent', 'PROCO165330', 'Change of Ownership', 'COASTER BUS', 'morethan1year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 155000.00, '2024-10-26 19:02:51', '2024-10-26 19:02:51'),
(7, '3', 'agent@gmail.com', 12, 'agent', 'PROCO502026', 'Change of Ownership', 'COASTER BUS', 'lessthan1month', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 395000.00, '2024-11-14 03:38:49', '2024-11-14 03:38:49'),
(8, '3', 'agent@gmail.com', 12, 'agent', 'PROCO542791', 'Change of Ownership', 'COASTER BUS', 'morethan1month', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 166900.00, '2024-11-14 03:39:39', '2024-11-14 03:39:39'),
(9, '3', 'agent@gmail.com', 12, 'agent', 'PROCO874563', 'Change of Ownership', 'COASTER BUS', 'morethan1month', NULL, NULL, NULL, NULL, NULL, NULL, 'RPN', 'morethan1month', NULL, NULL, 'morethan3year', NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, '0', 176300.00, '2024-11-14 03:54:09', '2024-11-14 03:54:09'),
(10, '5', 'eshanokpe@gmail.com', NULL, 'user', 'PROCO591995', 'Change of Ownership', 'TRUCK: (20 tons)', 'lessthan1month', NULL, NULL, NULL, NULL, NULL, NULL, 'RPN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 198300.00, '2024-11-27 18:21:04', '2024-11-27 18:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` varchar(250) NOT NULL,
  `comment_id` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(250) NOT NULL,
  `author_pics` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `topic_id`, `comment_id`, `content`, `author`, `author_pics`, `created_at`, `updated_at`) VALUES
(1, '1', 'COMMENTFAWX', 'No, there is no provision in the law that allows for a grace period after the expiration of your document(s).', 'Oladokun Damilola', 'assets/img/profile_img/user.png', '2023-07-04 23:48:18', '2023-07-04 23:32:30'),
(2, '1', 'COMMENT9rJt', 'I don\'t think there\'s grace.', 'Mayowa Lamusa', 'assets/img/profile_img/user.png', '2023-07-04 23:48:18', '2023-07-05 08:48:43'),
(3, '4', 'COMMENTNGXE', 'I think the requirement are custom paper, valid ID card etc.', 'Oladokun Damilola', 'assets/img/profile_img/user.png', '2023-07-04 23:48:18', '2023-07-05 08:54:44'),
(4, '4', 'COMMENTD7jq', 'Okay, thanks.', 'Mayowa Lamusa', 'assets/img/profile_img/user.png', '2023-07-04 23:48:18', '2023-07-05 08:58:11'),
(5, '1', 'COMMENTDDBu', 'gggagagagga', 'Oladokun Damilola', 'assets/img/profile_img/user.png', '2023-07-04 23:48:18', '2023-07-05 20:32:34'),
(6, '1', 'COMMENTfewo', 'Oh, wow there\'s no grace at all..', 'Lamusa Mayowa', 'odd.cr8tives@gmail.com', '2023-07-04 13:48:53', '2023-07-06 14:48:53'),
(7, '1', 'COMMENTwSqt', 'Alright Then...', 'Lamusa Mayowa', 'odd.cr8tives@gmail.com', '2023-07-06 13:59:06', '2023-07-06 14:59:06'),
(8, '1', 'COMMENTgYsG', 'Thanks for your comment.', 'Oladokun Damilola', 'oladokundamiloladaniel@gmail.com', '2023-07-11 06:21:59', '2023-07-11 07:21:59'),
(9, '1', 'COMMENTzwN0', 'make i try comment', 'Oladokun Damilola', 'oladokundamiloladaniel@gmail.com', '2023-07-28 02:53:33', '2023-07-28 03:53:33'),
(10, '3', 'COMMENTmVy4', 'Nothing Happens like that', 'Oladokun Damilola', 'oladokundamiloladaniel@gmail.com', '2023-07-28 04:17:06', '2023-07-28 04:17:06'),
(11, '1', 'COMMENTu46x', 'it\'s good to renew your papers before the expiration date.', 'RIDWAN OLANREWAJU MUILI', 'muiliridwanolanrewaju@gmail.com', '2024-08-19 15:01:59', '2024-08-19 11:01:59'),
(12, '2', 'COMMENTgpGV', 'Checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:20:12', '2024-11-03 05:20:12'),
(13, 'eyJpdiI6Ims5R2JTZEdlb2ZCYVE2Qjg3azIvblE9PSIsInZhbHVlIjoiUHBtUWdSc1BENnplUnR1akZDbmthQT09IiwibWFjIjoiMDM2YzA1ZmRjY2M0Y2U1NTBhYzZiM2UxNzE2Yzk0ZDY2MTU1MTFlOTEzYmQ0OWNmNDUzNzQ5MWQ3NWJlZDVhZSIsInRhZyI6IiJ9', 'COMMENTsgEB', 'Checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:31:41', '2024-11-03 05:31:41'),
(14, '2', 'COMMENTi3Ed', 'this is a test', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:33:01', '2024-11-03 05:33:01'),
(15, '1', 'COMMENTshbt', 'Comment', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:34:44', '2024-11-03 05:34:44'),
(16, '1', 'COMMENT9yhw', 'rrrr', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:35:38', '2024-11-03 05:35:38'),
(17, 'eyJpdiI6IlltYTUvSFcrZlhFbDNiQURsVXpsRVE9PSIsInZhbHVlIjoiMSsyQzY2OC9qdXZJUGRFellGWXZadz09IiwibWFjIjoiZWQzYzIxNDNkNjM0N2VmYzk1NGYxYWExNGZhNmFmZGE2ZGIwMmFhNjJjNzU0Zjc5YTFhN2IwNDAwMmFkYTc1MyIsInRhZyI6IiJ9', 'COMMENTh0YT', 'checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:37:13', '2024-11-03 05:37:13'),
(18, 'eyJpdiI6IlVFMWtEVUh3NUU2M1ZwVWdqSktZMWc9PSIsInZhbHVlIjoiZG1mYkhHSnAzb3puMVZ2dmlEUk1QQT09IiwibWFjIjoiNjM5OGQxNTZmYTNlYmYxZGU3Mzg4NzlkMzIwMmQyYmFlNDIxNTAxOWMyYzExNzI3OWYwZDk1ZjEyMTlkYjg3MiIsInRhZyI6IiJ9', 'COMMENTmP2g', 'checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:37:28', '2024-11-03 05:37:28'),
(19, '1', 'COMMENT52PI', 'checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:38:51', '2024-11-03 05:38:51'),
(20, '1', 'COMMENTwFX8', 'checking', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:39:38', '2024-11-03 05:39:38'),
(21, '1', 'COMMENT0H0Q', 'ok', 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', '2024-11-03 05:42:58', '2024-11-03 05:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `fullname`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'daa', 'esh@gmail.com', '234567890', 'subject', 'message', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dealers_plate_number_prices`
--

CREATE TABLE `dealers_plate_number_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dealers_plate_number_prices`
--

INSERT INTO `dealers_plate_number_prices` (`id`, `state_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '1', 320000, '2024-08-23 09:55:00', '2024-08-23 13:55:00'),
(3, '2', 320000, '2024-08-23 09:56:42', '2024-08-23 13:56:42'),
(4, '3', 320000, '2024-08-23 09:56:59', '2024-08-23 13:56:58'),
(5, '4', 320000, '2024-08-23 13:57:18', '2024-08-23 13:57:18'),
(6, '5', 320000, '2024-08-23 13:57:30', '2024-08-23 13:57:30'),
(7, '6', 320000, '2024-08-23 13:57:43', '2024-08-23 13:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_plate_numbers`
--

CREATE TABLE `dealer_plate_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `state_id` int(250) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) NOT NULL DEFAULT 'Dealer`s Plate Number',
  `process_id` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `maritalstatus` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `placeofbirth` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `localgovernment` varchar(255) DEFAULT NULL,
  `caccertificate` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `companyletterhead` varchar(255) DEFAULT NULL,
  `payment_status` decimal(8,2) NOT NULL DEFAULT 0.00,
  `totalamount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dealer_plate_numbers`
--

INSERT INTO `dealer_plate_numbers` (`id`, `user_id`, `user_email`, `state_id`, `userType`, `fullname`, `companyName`, `process_type`, `process_id`, `email`, `phonenumber`, `gender`, `maritalstatus`, `dateofbirth`, `placeofbirth`, `address`, `state`, `localgovernment`, `caccertificate`, `passport`, `companyletterhead`, `payment_status`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', NULL, 'user', NULL, 'Banks and Perry Trading', 'Dealer`s Plate Number', 'PRODPN477948', 'hicedysej@mailinator.com', '+1 (697) 763-9876', 'Female', 'Married', '2012-07-24', 'Fugiat accusantium d', 'Soluta sapiente adip', 'Niger', 'Eu dicta dolorum sun', NULL, NULL, NULL, 0.00, 320000.00, '2024-09-18 18:41:12', '2024-09-18 18:41:12'),
(2, 5, 'eshanokpe@gmail.com', NULL, 'user', 'Colin Prince', 'Banks and Perry Trading', 'Dealer`s Plate Number', 'PRODPN615362', 'hicedysej@mailinator.com', '+1 (697) 763-9876', 'Female', 'Married', '2012-07-24', 'Fugiat accusantium d', 'Soluta sapiente adip', 'Niger', 'Eu dicta dolorum sun', 'dealerPlateNumber/Perspective.jpg', 'dealerPlateNumber/Perspective.jpg', 'dealerPlateNumber/Perspective.jpg', 0.00, 320000.00, '2024-09-18 18:42:18', '2024-09-18 18:42:18'),
(3, 5, 'eshanokpe@gmail.com', NULL, 'user', 'Uriah Moses', 'Hays and Foster Trading', 'Dealer`s Plate Number', 'PRODPN144920', 'gybi@mailinator.com', '+1 (973) 281-4124', 'Male', 'Divorced', '2003-12-28', 'Maxime ad exercitati', 'Dolor exercitationem', 'Delta', 'Velit corporis quis', 'dealerPlateNumber/1726688838_Perspective.jpg', 'dealerPlateNumber/1726688838_Perspective.jpg', 'dealerPlateNumber/1726688838_Perspective.jpg', 0.00, 320000.00, '2024-09-18 18:47:18', '2024-09-18 18:47:18'),
(4, 5, 'eshanokpe@gmail.com', NULL, 'user', 'Leah Lyons', 'Knight and Farrell Associates', 'Dealer`s Plate Number', 'PRODPN371220', 'hybe@mailinator.com', '+1 (638) 673-2592', 'Female', 'Single', '1983-06-15', 'Et blanditiis sunt e', 'Voluptas quasi enim', 'Niger', 'Obcaecati aut qui si', 'dealerPlateNumber/1726688994_Perspective.jpg', 'dealerPlateNumber/1726688994_Perspective.jpg', 'dealerPlateNumber/1726688994_Perspective.jpg', 0.00, 320000.00, '2024-09-18 18:49:54', '2024-09-18 18:49:54'),
(5, 5, 'eshanokpe@gmail.com', 3, 'user', 'Chloe Mason', 'Blackburn and Cleveland LLC', 'Dealer`s Plate Number', 'PRODPN356181', 'nimepunyg@mailinator.com', '+1 (919) 468-2114', 'Female', 'Divorced', '1980-01-05', 'Est nesciunt quis n', 'Eum quis veniam est', 'Oyo', 'Rerum ut iusto possi', 'dealerPlateNumber/1726750677_Perspective.jpg', 'dealerPlateNumber/1726750677_Perspective.jpg', 'dealerPlateNumber/1726750677_Perspective.jpg', 0.00, 320000.00, '2024-09-19 11:57:57', '2024-09-19 11:57:57'),
(6, 5, 'eshanokpe@gmail.com', 6, 'user', 'Vladimir Klein', 'Sandoval and Blair Inc', 'Dealer`s Plate Number', 'PRODPN479473', 'mehy@mailinator.com', '+1 (818) 596-5008', 'Female', 'Single', '1974-07-29', 'Laborum minima nihil', 'Quia non consequatur', 'Ebonyi', 'Quis alias non ullam', 'dealerPlateNumber/Real estate marketing.jpg', 'dealerPlateNumber/Real Estate Development.jpg', 'dealerPlateNumber/Real Estate Development.jpg', 0.00, 320000.00, '2024-09-26 11:00:45', '2024-09-26 11:00:45'),
(7, 3, 'agent@gmail.com', 3, 'agent', 'Irene Warner', 'Donovan and Mcneil Trading', 'Dealer`s Plate Number', 'PRODPN553867', 'lizygifop@mailinator.com', '+1 (229) 114-7447', 'Female', 'Married', '2023-04-25', 'Sint quis eius bland', 'Neque ipsa iure dol', 'Yobe', 'Non blanditiis fugia', 'dealerPlateNumber/01.jpg', 'dealerPlateNumber/01.png', 'dealerPlateNumber/02.jpg', 0.00, 320000.00, '2024-10-27 15:28:02', '2024-10-27 15:28:02'),
(8, 3, 'agent@gmail.com', 5, 'agent', 'Olga Crosby', 'Lott and Maldonado Traders', 'Dealer`s Plate Number', 'PRODPN799266', 'qyxiwibih@mailinator.com', '+1 (246) 341-1764', 'Male', 'Divorced', '1984-05-13', 'Ratione sapiente ull', 'Et quibusdam qui mag', 'Borno', 'Laborum Est quasi a', 'dealerPlateNumber/01.jpg', 'dealerPlateNumber/01.jpg', 'dealerPlateNumber/02.jpg', 0.00, 320000.00, '2024-10-27 15:34:43', '2024-10-27 15:34:43'),
(9, 5, 'eshanokpe@gmail.com', 1, 'user', 'Jordan Pratt', 'Ballard and Robertson Associates', 'Dealer`s Plate Number', 'PRODPN498205', 'wuzyqehujy@mailinator.com', '+1 (124) 125-3136', 'Female', 'Married', '2013-05-20', 'Tenetur aliquip aut', 'Mollitia a quibusdam', 'Kaduna', 'Tempore in officiis', 'dealerPlateNumber/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 'dealerPlateNumber/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 'dealerPlateNumber/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 0.00, 320000.00, '2024-11-27 18:18:17', '2024-11-27 18:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `driver_license_renewals`
--

CREATE TABLE `driver_license_renewals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) NOT NULL DEFAULT 'Driver License Renewal',
  `state_id` int(11) DEFAULT NULL,
  `lengthofyear` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `payment_status` decimal(10,2) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_license_renewals`
--

INSERT INTO `driver_license_renewals` (`id`, `user_id`, `user_email`, `userType`, `process_id`, `process_type`, `state_id`, `lengthofyear`, `firstname`, `middlename`, `lastname`, `dob`, `email`, `phone`, `address`, `document`, `payment_status`, `totalAmount`, `created_at`, `updated_at`) VALUES
(9, 5, 'eshanokpe@gmail.com', '5', 'PRODLR100024', 'Driver License Renewal', 5, '3', 'Rashad', 'Anthony Houston', 'Pacheco', '1994-08-22', 'Coby Whitney', '+1 (288) 601-1944', 'Sapiente impedit ir', 'driverLicenseRenewal/1726749823_Perspective.jpg', 0.00, 40200.00, '2024-09-19 11:43:43', '2024-09-19 11:43:43'),
(10, 5, 'eshanokpe@gmail.com', '5', 'PRODLR458487', 'Driver License Renewal', 2, '5', 'Aladdin', 'Fitzgerald Morin', 'Simon', '2012-04-06', 'Norman Downs', '+1 (229) 507-1789', 'At ipsum sed pariat', 'driverLicenseRenewal/1726749888_Perspective.jpg', 0.00, 45200.00, '2024-09-19 11:44:48', '2024-09-19 11:44:48'),
(11, 5, 'eshanokpe@gmail.com', '5', 'PRODLR713487', 'Driver License Renewal', 4, '5', 'Gray', 'Karyn White', 'Payne', '1971-11-05', 'Reese Tillman', '+1 (863) 901-9873', 'Eveniet sint et ten', 'driverLicenseRenewal/1726749957_Perspective.jpg', 0.00, 45200.00, '2024-09-19 11:45:57', '2024-09-19 11:45:57'),
(12, 5, 'eshanokpe@gmail.com', '5', 'PRODLR114178', 'Driver License Renewal', 2, '3', 'Daquan', 'Shelby Saunders', 'Finch', '1995-05-14', 'Cally Small', '+1 (741) 194-8481', 'Molestias repellendu', 'driverLicenseRenewal/1726749977_Perspective.jpg', 0.00, 40200.00, '2024-09-19 11:46:17', '2024-09-19 11:46:17'),
(13, 5, 'eshanokpe@gmail.com', '5', 'PRODLR809177', 'Driver License Renewal', 1, '3', 'Halee', 'Bianca Mccarthy', 'Schmidt', '1985-10-25', 'Ora Dawson', '+1 (691) 222-3102', 'Sit neque libero oc', 'driverLicenseRenewal/1726750750_Perspective.jpg', 0.00, 40200.00, '2024-09-19 11:59:10', '2024-09-19 11:59:10'),
(14, 5, 'eshanokpe@gmail.com', '5', 'PRODLR386044', 'Driver License Renewal', 3, '5', 'Caryn', 'Ann Gentry', 'Watkins', '1976-02-24', 'Lani Dennis', '+1 (823) 848-6797', 'Beatae ullam non asp', 'driverLicenseRenewal/1726751032_Perspective.jpg', 0.00, 45200.00, '2024-09-19 12:03:52', '2024-09-19 12:03:52'),
(15, 3, 'agent@gmail.com', '3', 'PRODLR685682', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:31', '2024-10-27 17:47:31'),
(16, 3, 'agent@gmail.com', '3', 'PRODLR770356', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:34', '2024-10-27 17:47:34'),
(17, 3, 'agent@gmail.com', '3', 'PRODLR498052', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:40', '2024-10-27 17:47:40'),
(18, 3, 'agent@gmail.com', '3', 'PRODLR184604', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:42', '2024-10-27 17:47:42'),
(19, 3, 'agent@gmail.com', '3', 'PRODLR896686', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:43', '2024-10-27 17:47:43'),
(20, 3, 'agent@gmail.com', '3', 'PRODLR470503', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:44', '2024-10-27 17:47:44'),
(21, 3, 'agent@gmail.com', '3', 'PRODLR814552', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:47:44', '2024-10-27 17:47:44'),
(22, 3, 'agent@gmail.com', '3', 'PRODLR728149', 'Driver License Renewal', 1, '5', 'Thaddeus', 'Guinevere Wilkins', 'Holder', '1993-07-05', 'Brittany Walsh', '+1 (808) 252-7384', 'Accusantium magna do', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:48:46', '2024-10-27 17:48:46'),
(23, 3, 'agent@gmail.com', 'agent', 'PRODLR385571', 'Driver License Renewal', 1, '5', 'Lucas', 'Alisa Mcgowan', 'Hickman', '1998-09-17', 'Blossom Keller', '+1 (338) 243-5785', 'Laboriosam at aute', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:51:43', '2024-10-27 17:51:43'),
(24, 3, 'agent@gmail.com', 'agent', 'PRODLR889498', 'Driver License Renewal', 1, '5', 'Lucas', 'Alisa Mcgowan', 'Hickman', '1998-09-17', 'Blossom Keller', '+1 (338) 243-5785', 'Laboriosam at aute', 'driverLicenseRenewal/02.jpg', 0.00, 45200.00, '2024-10-27 17:51:45', '2024-10-27 17:51:45'),
(25, 3, 'agent@gmail.com', 'agent', 'PRODLR660666', 'Driver License Renewal', 1, '3', 'Lucas', 'Alisa Mcgowan', 'Hickman', '1998-09-17', 'Blossom Keller', '+1 (338) 243-5785', 'Laboriosam at aute', 'driverLicenseRenewal/02.jpg', 0.00, 40200.00, '2024-10-27 17:52:22', '2024-10-27 17:52:22'),
(26, 3, 'agent@gmail.com', 'agent', 'PRODLR916611', 'Driver License Renewal', 1, '5', 'Wanda', 'Gwendolyn Richards', 'Ortiz', '1975-11-28', 'Dolan Patrick', '+1 (798) 165-8486', 'Distinctio Enim lab', 'driverLicenseRenewal/01.png', 0.00, 45200.00, '2024-10-27 17:56:05', '2024-10-27 17:56:05'),
(27, 3, 'agent@gmail.com', 'agent', 'PRODLR492718', 'Driver License Renewal', 2, '5', 'Jocelyn', 'Valentine Williams', 'Noel', '1997-04-23', 'Noah Parrish', '+1 (373) 259-5465', 'Culpa laboris ex of', 'driverLicenseRenewal/03.jpg', 0.00, 45200.00, '2024-10-27 17:57:15', '2024-10-27 17:57:15'),
(28, 3, 'agent@gmail.com', 'agent', 'PRODLR951013', 'Driver License Renewal', 1, '5', 'Signe', 'Eve Matthews', 'Odonnell', '2020-03-17', 'Orson Reynolds', '+1 (259) 247-9601', 'Sit in iusto in eos', 'driverLicenseRenewal/04.jpg', 0.00, 45200.00, '2024-10-27 17:57:58', '2024-10-27 17:57:58'),
(29, 3, 'agent@gmail.com', 'agent', 'PRODLR679820', 'Driver License Renewal', 1, '5', 'Signe', 'Eve Matthews', 'Odonnell', '2020-03-17', 'Orson Reynolds', '+1 (259) 247-9601', 'Sit in iusto in eos', 'driverLicenseRenewal/04.jpg', 0.00, 45200.00, '2024-10-27 17:58:08', '2024-10-27 17:58:08'),
(30, 3, 'agent@gmail.com', 'agent', 'PRODLR872409', 'Driver License Renewal', 1, '5', 'Signe', 'Eve Matthews', 'Odonnell', '2020-03-17', 'Orson Reynolds', '+1 (259) 247-9601', 'Sit in iusto in eos', 'driverLicenseRenewal/04.jpg', 0.00, 45200.00, '2024-10-27 18:00:09', '2024-10-27 18:00:09'),
(31, 5, 'eshanokpe@gmail.com', '5', 'PRODLR622054', 'Driver License Renewal', 3, '5', 'Bethany', 'Cullen Shepard', 'Cobb', '2004-04-12', 'Selma Carroll', '+1 (617) 975-4257', 'Non cillum quasi omn', 'driverLicenseRenewal/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 0.00, 45200.00, '2024-11-27 18:13:26', '2024-11-27 18:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `driver_license_renewal_prices`
--

CREATE TABLE `driver_license_renewal_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `years_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_license_renewal_prices`
--

INSERT INTO `driver_license_renewal_prices` (`id`, `state_id`, `years_type`, `amount`, `created_at`, `updated_at`) VALUES
(3, '1', '5', 45200.00, '2024-05-24 08:39:11', '2024-05-24 08:39:11'),
(4, '1', '3', 40200.00, '2024-05-24 12:39:29', '2024-05-24 08:39:29'),
(5, '2', '5', 45200.00, '2024-05-24 12:39:38', '2024-05-24 08:39:38'),
(6, '2', '3', 40200.00, '2024-05-24 12:39:50', '2024-05-24 08:39:50'),
(7, '3', '5', 45200.00, '2024-05-24 12:40:02', '2024-05-24 08:40:02'),
(8, '3', '3', 40200.00, '2024-05-24 12:40:21', '2024-05-24 08:40:21'),
(9, '4', '5', 45200.00, '2024-05-24 12:40:36', '2024-05-24 08:40:36'),
(11, '4', '3', 40200.00, '2024-05-24 08:41:53', '2024-05-24 08:41:53'),
(12, '5', '5', 45200.00, '2024-05-24 12:42:13', '2024-05-24 08:42:13'),
(13, '5', '3', 40200.00, '2024-05-24 12:42:24', '2024-05-24 08:42:24'),
(14, '6', '5', 45200.00, '2024-05-24 12:42:36', '2024-05-24 08:42:36'),
(15, '6', '3', 40200.00, '2024-05-24 12:43:12', '2024-05-24 08:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_a_qs`
--

CREATE TABLE `f_a_qs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_qs`
--

INSERT INTO `f_a_qs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'questions', 'answer', '2024-10-19 23:22:44', '2024-10-19 23:22:44'),
(2, 'Autem dolores qui ex4455', 'Et sequi delectus t6555', '2024-10-19 22:46:52', '2024-10-19 23:16:17'),
(3, 'Elit qui nihil sed11', 'Qui qui natus volupt22', '2024-10-19 22:49:16', '2024-10-19 23:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `international_driver_licenses`
--

CREATE TABLE `international_driver_licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `process_type` varchar(255) NOT NULL DEFAULT 'International Driver License',
  `lengthofyear` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `maritalstatus` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `localgovernment` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `localgovtplaceofbirth` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `international_driver_licenses`
--

INSERT INTO `international_driver_licenses` (`id`, `user_id`, `user_email`, `userType`, `process_id`, `process_type`, `lengthofyear`, `firstname`, `middlename`, `lastname`, `email`, `gender`, `dateofbirth`, `maritalstatus`, `address`, `localgovernment`, `state`, `localgovtplaceofbirth`, `phonenumber`, `passport`, `totalAmount`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL747299', 'International Driver License', 1, 'Thor', 'Ciara Butler', 'Bridges', 'Chava Marshall', 'Male', '2024-09-19', 'Single', 'Saepe non consequatu', 'Adele', 'Abia', 'Keefe', '+1 (138) 253-2575', 'internationalDriverLicense/1726757541_Perspective.jpg', NULL, '2024-09-19 13:52:21', '2024-09-19 13:52:21'),
(2, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL693524', 'International Driver License', 1, 'Thor', 'Ciara Butler', 'Bridges', 'Chava Marshall', 'Male', '2024-09-19', 'Single', 'Saepe non consequatu', 'Adele', 'Abia', 'Keefe', '+1 (138) 253-2575', 'internationalDriverLicense/1726757583_Perspective.jpg', 35000.00, '2024-09-19 13:53:03', '2024-09-19 13:53:03'),
(3, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL128009', 'International Driver License', 1, 'Courtney', 'Abigail Powell', 'Gutierrez', 'Moses Figueroa', 'Male', '1989-06-05', 'Married', 'Aspernatur debitis c', 'Zenaida', 'Adamawa', 'Yolanda', '+1 (879) 586-5539', 'internationalDriverLicense/1726757752_Perspective.jpg', 35000.00, '2024-09-19 13:55:52', '2024-09-19 13:55:52'),
(4, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL933802', 'International Driver License', 1, 'Courtney', 'Abigail Powell', 'Gutierrez', 'Moses Figueroa', 'Male', '1989-06-05', 'Married', 'Aspernatur debitis c', 'Zenaida', 'Adamawa', 'Yolanda', '+1 (879) 586-5539', 'internationalDriverLicense/1726757870_Perspective.jpg', 35000.00, '2024-09-19 13:57:50', '2024-09-19 13:57:50'),
(5, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL796361', 'International Driver License', 1, 'Arsenio', 'Upton Andrews', 'Molina', 'Sebastian Golden', 'Male', '2014-03-05', 'Single', 'Debitis veniam dolo', 'Rhonda', 'Akwa Ibom', 'Dara', '+1 (478) 533-8753', 'internationalDriverLicense/1726758165_Perspective.jpg', 35000.00, '2024-09-19 14:02:45', '2024-09-19 14:02:45'),
(6, 3, 'agent@gmail.com', 'agent', 'PROIDL797105', 'International Driver License', 1, 'Rebekah', 'Carson Higgins', 'Bradley', 'Suki Baker', 'Female', '2014-07-04', 'Divorced', 'Qui aperiam labore e', 'Jared', 'Kogi', 'Orla', '+1 (617) 659-4916', 'internationalDriverLicense/01.jpg', 35000.00, '2024-10-27 19:35:37', '2024-10-27 19:35:37'),
(7, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL482506', 'International Driver License', 1, 'Janna', 'Theodore Gibson', 'Nicholson', 'Megan Matthews', 'Male', '1976-02-27', 'Single', 'Labore neque ut dolo', 'Anjolie', 'Abia', 'Stephen', '+1 (732) 247-1311', 'internationalDriverLicense/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 35000.00, '2024-11-27 17:42:19', '2024-11-27 17:42:19'),
(8, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL933606', 'International Driver License', 1, 'Thor', 'Hiroko Blackburn', 'Ramos', 'Chloe Giles', 'Female', '2004-02-24', 'Married', 'Labore neque rerum n', 'James', 'Adamawa', 'Lyle', '+1 (304) 563-6352', 'internationalDriverLicense/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 35000.00, '2024-11-27 18:04:13', '2024-11-27 18:04:13'),
(9, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL868505', 'International Driver License', 1, 'Kelly', 'Ava Schwartz', 'Lancaster', 'Regan Berger', 'Male', '1986-01-25', 'Single', 'Qui est est magna o', 'Slade', 'Abia', 'Wyoming', '+1 (393) 699-9571', 'internationalDriverLicense/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 35000.00, '2024-11-27 18:05:40', '2024-11-27 18:05:40'),
(10, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL214473', 'International Driver License', 1, 'Justin', 'TaShya Stewart', 'Walton', 'Henry Aguirre', 'Female', '2001-11-08', 'Married', 'Sunt libero inventor', 'Hiroko', 'Ebonyi', 'Upton', '+1 (367) 234-9438', 'internationalDriverLicense/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 35000.00, '2024-11-27 18:07:07', '2024-11-27 18:07:07'),
(11, 5, 'eshanokpe@gmail.com', 'user', 'PROIDL901635', 'International Driver License', 1, 'Eliana', 'Jescie Richard', 'Norris', 'Ifeoma Mcleod', 'Male', '2006-01-29', 'Single', 'Accusantium enim ea', 'Cally', 'Abia', 'Fuller', '+1 (294) 855-9526', 'internationalDriverLicense/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 35000.00, '2024-11-27 18:10:59', '2024-11-27 18:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `international_driver_license_prices`
--

CREATE TABLE `international_driver_license_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `years_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `international_driver_license_prices`
--

INSERT INTO `international_driver_license_prices` (`id`, `state_id`, `years_type`, `amount`, `created_at`, `updated_at`) VALUES
(1, '6', '1', 35000.00, '2024-06-16 06:29:24', '2024-06-16 10:29:24'),
(4, '1', '1', 35000.00, '2024-06-17 12:20:51', '2024-06-17 12:20:51'),
(5, '2', '1', 35000.00, '2024-06-21 20:49:13', '2024-06-21 20:49:13'),
(6, '3', '1', 35000.00, '2024-06-21 20:49:24', '2024-06-21 20:49:24'),
(7, '4', '1', 35000.00, '2024-06-21 20:49:33', '2024-06-21 20:49:33'),
(8, '5', '1', 35000.00, '2024-06-21 20:49:42', '2024-06-21 20:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_07_191541_create_vehicle_types_table', 1),
(5, '2024_09_07_191602_create_vehicle_registration_types_table', 1),
(6, '2024_09_07_191614_create_states_table', 1),
(7, '2024_02_03_102720_create_projects_table', 2),
(8, '2024_02_03_102804_create_tasks_table', 2),
(9, '2024_09_08_135516_create_users_table', 3),
(10, '2024_09_08_135755_create_user_tokens_table', 4),
(11, '2024_09_08_153450_create_users_table', 5),
(12, '2024_09_08_153509_user_tokens_table', 5),
(13, '2024_09_08_182821_create_add_vehiclerenewals_table', 6),
(14, '2024_09_08_213424_create_add_vehicle_registrations_table', 7),
(15, '2024_09_09_135110_create_vehicle_categories_table', 8),
(16, '2024_09_09_140526_create_add_vehicle_ownerships_table', 9),
(17, '2024_09_09_141655_create_add_vehicle_ownerships_table', 10),
(18, '2024_09_09_210131_create_vehicle_renewal_prices_table', 11),
(19, '2024_09_15_145147_create_vehicle_paper_renewals_table', 12),
(20, '2024_09_15_171031_create_orders_table', 13),
(21, '2024_09_15_194153_create_vehicle_registration_prices_table', 14),
(22, '2024_09_15_195410_create_vehicle_registration_prices_table', 15),
(23, '2024_09_16_095912_create_vehicle_registrations_table', 16),
(24, '2024_09_17_013828_create_changeof_ownership_prices_table', 17),
(25, '2024_09_18_112318_create_dealers_plate_number_prices_table', 18),
(26, '2024_09_18_190726_create_dealer_plate_numbers_table', 19),
(27, '2024_09_18_202318_create_new_driver_license_prices_table', 20),
(28, '2024_09_19_080515_create_new_driver_licenses_table', 21),
(29, '2024_09_19_092612_create_notifications_table', 22),
(30, '2024_09_19_112030_create_driver_license_renewal_prices_table', 23),
(31, '2024_09_19_114453_create_driver_license_renewals_table', 24),
(32, '2024_09_19_134954_create_international_driver_license_prices_table', 25),
(33, '2024_09_19_135415_create_international_driver_licenses_table', 26),
(34, '2024_09_19_152155_create_other_permit_prices_table', 27),
(35, '2024_09_19_152451_create_other_permit_types_table', 28),
(36, '2024_09_19_193252_create_other_permits_table', 29),
(37, '2024_09_20_130021_create_contact_messages_table', 30),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 31),
(39, '2024_09_23_011737_create_wallet_payments_table', 31),
(40, '2024_09_23_015258_create_process_histories_table', 32),
(41, '2024_09_23_040922_create_payment_models_table', 33),
(42, '2024_09_25_052729_create_topics_table', 34),
(43, '2024_09_25_053913_create_topics_table', 35),
(44, '2024_09_25_054212_create_comments_table', 36),
(45, '2024_10_08_081439_create_admins_table', 37),
(46, '2024_10_10_120523_create_agents_table', 38),
(47, '2024_10_18_182820_create_wallets_table', 39),
(48, '2024_10_19_231115_create_f_a_qs_table', 40),
(49, '2024_09_23_000917_create_shoppingcart_table', 41),
(50, '2024_12_28_024505_create_promo_codes_table', 42),
(51, '2024_12_31_150335_add_referrer_count_to_users_table', 43),
(52, '2024_12_31_171044_create_referral_logs_table', 44),
(53, '2024_12_31_203802_create_notifications_table', 45),
(54, '2025_02_20_130105_create_agent_password_models_table', 46);

-- --------------------------------------------------------

--
-- Table structure for table `new_driver_licenses`
--

CREATE TABLE `new_driver_licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) NOT NULL DEFAULT 'New Driver License',
  `state_id` int(11) DEFAULT NULL,
  `lengthofyear` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mothermaidenname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `maritalstatus` varchar(255) DEFAULT NULL,
  `nin` text DEFAULT NULL,
  `localgovernment` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `localgovtplaceofbirth` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `bloodgroup` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `nextofkinname` varchar(255) DEFAULT NULL,
  `nextofkinphonenumber` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_status` decimal(8,2) NOT NULL DEFAULT 0.00,
  `totalamount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_driver_licenses`
--

INSERT INTO `new_driver_licenses` (`id`, `user_id`, `user_email`, `userType`, `process_id`, `process_type`, `state_id`, `lengthofyear`, `firstname`, `middlename`, `lastname`, `mothermaidenname`, `email`, `gender`, `dateofbirth`, `maritalstatus`, `nin`, `localgovernment`, `state`, `localgovtplaceofbirth`, `phonenumber`, `bloodgroup`, `height`, `nextofkinname`, `nextofkinphonenumber`, `address`, `payment_status`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL339904', 'New Driver License', NULL, 5, 'Elizabeth', 'Reece Cochran', 'Richmond', 'Darryl Hicks', 'Kiayada Collier', 'Male', '2015-01-18', 'Divorced', '67876545678', 'Eveniet tenetur rer', 'Delta', 'Eveniet tenetur rer', '+1 (984) 696-7048', 'B', '+1 (388) 717-4372', 'Adrian Rosario', 'Nihil quis et et cor', 'Sint dolor rem et la', 0.00, 45200.00, '2024-09-19 07:26:10', '2024-09-19 07:26:10'),
(2, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL657386', 'New Driver License', NULL, 5, 'Rama', 'Elton Brown', 'Lindsay', 'Cecilia Howard', 'Chelsea Rivas', 'Male', '1990-11-23', 'Single', '42', 'Pariatur Enim sit', 'Abia', 'Pariatur Enim sit', '+1 (772) 339-6994', 'A', '+1 (521) 751-4153', 'Dominique Hayden', 'Quam mollitia except', 'Ut aliqua Qui et as', 0.00, 45200.00, '2024-09-19 07:28:26', '2024-09-19 07:28:26'),
(3, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL567255', 'New Driver License', NULL, 5, 'Hayley', 'Dane Cardenas', 'Crosby', 'Nissim Crosby', 'Ingrid Lara', 'Male', '1976-10-19', 'Married', '80', 'Aspernatur qui eaque', 'Adamawa', 'Aspernatur qui eaque', '+1 (929) 651-9986', 'B', '+1 (797) 524-8769', 'Geraldine Harris', 'Occaecat ad consecte', 'Voluptatem dolorem n', 0.00, 45200.00, '2024-09-19 07:29:24', '2024-09-19 07:29:24'),
(4, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL981171', 'New Driver License', NULL, 3, 'Marshall', 'Odysseus Lott', 'Yates', 'Whilemina Bailey', 'Elvis Hubbard', 'Female', '1996-07-15', 'Single', '54', 'Praesentium culpa e', 'Benue', 'Praesentium culpa e', '+1 (437) 984-9654', 'AB', '+1 (537) 729-7674', 'Cameron Huffman', 'Assumenda et minus e', 'Unde excepteur ratio', 0.00, 40200.00, '2024-09-19 07:29:58', '2024-09-19 07:29:58'),
(5, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL523507', 'New Driver License', 5, 3, 'McKenzie', 'Arden Trujillo', 'Macdonald', 'Sage Buck', 'Ronan Patrick', 'Male', '1985-03-15', 'Single', '16', 'Rem consectetur qua', 'Abia', 'Rem consectetur qua', '+1 (383) 135-8586', 'A', '+1 (562) 739-2756', 'Amal Whitaker', 'Sapiente perferendis', 'Impedit non et qui', 0.00, 40200.00, '2024-09-19 11:59:44', '2024-09-19 11:59:44'),
(6, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL223301', 'New Driver License', 6, 5, 'Ima', 'Ezekiel Buchanan', 'Hill', 'Brennan Baird', 'Jarrod Page', 'Male', '2012-10-30', 'Divorced', '89', 'Ut voluptatibus exer', 'Abia', 'Ut voluptatibus exer', '+1 (356) 458-1453', 'B', '+1 (101) 668-4192', 'Christen Saunders', 'Ea sit amet ducimu', 'Ab autem consequuntu', 0.00, 45200.00, '2024-09-19 12:08:05', '2024-09-19 12:08:05'),
(7, 3, 'agent@gmail.com', 'agent', 'PRONDL830146', 'New Driver License', 6, 5, 'Maisie', 'Colleen Simpson', 'Kirkland', 'Dillon Dejesus', 'Sigourney Collier', 'Female', '1993-12-14', 'Married', '84', 'Unde et voluptatem d', 'Adamawa', 'Unde et voluptatem d', '+1 (755) 462-2373', 'B', '+1 (485) 506-6525', 'Howard Heath', 'Cillum ipsum et qui', 'Cum est incidunt po', 0.00, 45200.00, '2024-10-27 15:53:49', '2024-10-27 15:53:49'),
(8, 3, 'agent@gmail.com', 'agent', 'PRONDL973625', 'New Driver License', 5, 3, 'Myra', 'Charlotte Rowe', 'Coleman', 'Rebecca Mueller', 'Jonas Schwartz', 'Female', '2018-12-06', 'Single', '8', 'Aut eum nihil labore', 'Kaduna', 'Aut eum nihil labore', '+1 (124) 398-7342', 'B', '+1 (882) 283-6371', 'Zia Watkins', 'Quia dolores volupta', 'Impedit velit eius', 0.00, 40200.00, '2024-10-27 17:35:04', '2024-10-27 17:35:04'),
(9, 5, 'eshanokpe@gmail.com', 'user', 'PRONDL622019', 'New Driver License', 2, 5, 'Shaine', 'Kane Woodward', 'Carpenter', 'Alma Norris', 'Bree Dunn', 'Male', '1977-11-22', 'Single', '43', 'Id ratione ut cum eu', 'Abia', 'Id ratione ut cum eu', '+1 (752) 594-8362', 'Blood Group A-', '+1 (157) 272-3207', 'Kaseem Mckenzie', 'Dolore eum reprehend', 'Sed praesentium sunt', 0.00, 45200.00, '2024-11-27 18:16:22', '2024-11-27 18:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `new_driver_license_prices`
--

CREATE TABLE `new_driver_license_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `years_type` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_driver_license_prices`
--

INSERT INTO `new_driver_license_prices` (`id`, `state_id`, `years_type`, `amount`, `created_at`, `updated_at`) VALUES
(3, '1', '5', 45200.00, '2024-05-24 08:39:11', '2024-05-24 08:39:11'),
(4, '1', '3', 40200.00, '2024-05-24 12:39:29', '2024-05-24 08:39:29'),
(5, '2', '5', 45200.00, '2024-05-24 12:39:38', '2024-05-24 08:39:38'),
(6, '2', '3', 40200.00, '2024-05-24 12:39:50', '2024-05-24 08:39:50'),
(7, '3', '5', 45200.00, '2024-05-24 12:40:02', '2024-05-24 08:40:02'),
(8, '3', '3', 40200.00, '2024-05-24 12:40:21', '2024-05-24 08:40:21'),
(9, '4', '5', 45200.00, '2024-05-24 12:40:36', '2024-05-24 08:40:36'),
(11, '4', '3', 40200.00, '2024-05-24 08:41:53', '2024-05-24 08:41:53'),
(12, '5', '5', 45200.00, '2024-05-24 12:42:13', '2024-05-24 08:42:13'),
(13, '5', '3', 40200.00, '2024-05-24 12:42:24', '2024-05-24 08:42:24'),
(14, '6', '5', 45200.00, '2024-05-24 12:42:36', '2024-05-24 08:42:36'),
(15, '5', '3', 40200.00, '2024-05-24 12:43:12', '2024-10-08 12:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('ede28fce-2476-4679-a365-b6ffd6204124', 'App\\Notifications\\ExpiryNotification', 'App\\Models\\User', 10, '{\"vehicle_id\":17,\"platenumber\":\"438\",\"user_name\":\"Garrison Pace\",\"expiries\":{\"vehiclelicenseexpiry\":\"January 8, 2025\"},\"title\":\"Vehicle Expiry Notification\",\"message\":\"The documents for your vehicle (TRUCK: (15 tons), Plate: 438) are nearing expiry.\"}', '2025-01-03 01:09:42', '2025-01-03 01:00:07', '2025-01-03 01:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `notificationsss_2`
--

CREATE TABLE `notificationsss_2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `read_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificationsss_2`
--

INSERT INTO `notificationsss_2` (`id`, `user_id`, `user_email`, `fullname`, `userType`, `title`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:28:21', '2024-09-19 08:28:21'),
(2, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:28:56', '2024-09-19 08:28:56'),
(3, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:29:13', '2024-09-19 08:29:13'),
(4, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:29:20', '2024-09-19 08:29:20'),
(5, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:31:26', '2024-09-19 08:31:26'),
(6, 7, 'kowafay712@marchub.com', 'Cheryl Burks', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 08:31:34', '2024-09-19 08:31:34'),
(7, 8, 'beboy17347@cetnob.com', 'Vielka Ellison', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 10:07:40', '2024-09-19 10:07:40'),
(8, 8, 'beboy17347@cetnob.com', 'Vielka Ellison', 'user', 'User account creation', 'A new user account has been created.', NULL, '2024-09-19 10:07:48', '2024-09-19 10:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_amount` varchar(255) DEFAULT NULL,
  `product_qty` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `owner_id`, `userType`, `order_number`, `process_id`, `product_name`, `product_amount`, `product_qty`, `total`, `created_at`, `updated_at`) VALUES
(416, 3, 'agent@gmail.com', NULL, 'agent', '555193', 'PRODPN553867', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:43:14', '2024-10-27 15:43:14'),
(417, 3, 'agent@gmail.com', NULL, 'agent', '555193', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:43:14', '2024-10-27 15:43:14'),
(418, 3, 'agent@gmail.com', NULL, 'agent', '416008', 'PRODPN553867', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:43:20', '2024-10-27 15:43:20'),
(419, 3, 'agent@gmail.com', NULL, 'agent', '416008', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:43:20', '2024-10-27 15:43:20'),
(420, 3, 'agent@gmail.com', NULL, 'agent', '403569', 'PRODPN553867', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:44:18', '2024-10-27 15:44:18'),
(421, 3, 'agent@gmail.com', NULL, 'agent', '403569', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 15:44:18', '2024-10-27 15:44:18'),
(422, 3, 'agent@gmail.com', NULL, 'agent', '967974', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:00:14', '2024-10-27 16:00:14'),
(423, 3, 'agent@gmail.com', NULL, 'agent', '967974', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:00:14', '2024-10-27 16:00:14'),
(424, 3, 'agent@gmail.com', NULL, 'agent', '378992', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:00:37', '2024-10-27 16:00:37'),
(425, 3, 'agent@gmail.com', NULL, 'agent', '378992', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:00:37', '2024-10-27 16:00:37'),
(426, 3, 'agent@gmail.com', NULL, 'agent', '012386', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:00:46', '2024-10-27 16:00:46'),
(427, 3, 'agent@gmail.com', NULL, 'agent', '012386', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:00:46', '2024-10-27 16:00:46'),
(428, 3, 'agent@gmail.com', NULL, 'agent', '518702', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:01:12', '2024-10-27 16:01:12'),
(429, 3, 'agent@gmail.com', NULL, 'agent', '518702', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:01:12', '2024-10-27 16:01:12'),
(430, 3, 'agent@gmail.com', NULL, 'agent', '413386', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:01:37', '2024-10-27 16:01:37'),
(431, 3, 'agent@gmail.com', NULL, 'agent', '413386', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:01:37', '2024-10-27 16:01:37'),
(432, 3, 'agent@gmail.com', NULL, 'agent', '569182', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:01:44', '2024-10-27 16:01:44'),
(433, 3, 'agent@gmail.com', NULL, 'agent', '569182', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:01:44', '2024-10-27 16:01:44'),
(434, 3, 'agent@gmail.com', NULL, 'agent', '243400', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:02:49', '2024-10-27 16:02:49'),
(435, 3, 'agent@gmail.com', NULL, 'agent', '243400', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:02:49', '2024-10-27 16:02:49'),
(436, 3, 'agent@gmail.com', NULL, 'agent', '052643', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:02:58', '2024-10-27 16:02:58'),
(437, 3, 'agent@gmail.com', NULL, 'agent', '052643', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:02:58', '2024-10-27 16:02:58'),
(438, 3, 'agent@gmail.com', NULL, 'agent', '255217', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:03:30', '2024-10-27 16:03:30'),
(439, 3, 'agent@gmail.com', NULL, 'agent', '255217', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:03:30', '2024-10-27 16:03:30'),
(440, 3, 'agent@gmail.com', NULL, 'agent', '615888', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:04:23', '2024-10-27 16:04:23'),
(441, 3, 'agent@gmail.com', NULL, 'agent', '615888', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:04:23', '2024-10-27 16:04:23'),
(442, 3, 'agent@gmail.com', NULL, 'agent', '838500', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:14:08', '2024-10-27 16:14:08'),
(443, 3, 'agent@gmail.com', NULL, 'agent', '838500', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:14:08', '2024-10-27 16:14:08'),
(444, 3, 'agent@gmail.com', NULL, 'agent', '078781', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:14:20', '2024-10-27 16:14:20'),
(445, 3, 'agent@gmail.com', NULL, 'agent', '078781', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:14:20', '2024-10-27 16:14:20'),
(446, 3, 'agent@gmail.com', NULL, 'agent', '040243', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:14:28', '2024-10-27 16:14:28'),
(447, 3, 'agent@gmail.com', NULL, 'agent', '040243', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:14:28', '2024-10-27 16:14:28'),
(448, 3, 'agent@gmail.com', NULL, 'agent', '552218', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:14:31', '2024-10-27 16:14:31'),
(449, 3, 'agent@gmail.com', NULL, 'agent', '552218', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:14:31', '2024-10-27 16:14:31'),
(450, 3, 'agent@gmail.com', NULL, 'agent', '040560', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:18:09', '2024-10-27 16:18:09'),
(451, 3, 'agent@gmail.com', NULL, 'agent', '040560', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:18:09', '2024-10-27 16:18:09'),
(452, 3, 'agent@gmail.com', NULL, 'agent', '144922', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:18:16', '2024-10-27 16:18:16'),
(453, 3, 'agent@gmail.com', NULL, 'agent', '144922', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:18:16', '2024-10-27 16:18:16'),
(454, 3, 'agent@gmail.com', NULL, 'agent', '468796', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:18:32', '2024-10-27 16:18:32'),
(455, 3, 'agent@gmail.com', NULL, 'agent', '468796', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:18:32', '2024-10-27 16:18:32'),
(456, 3, 'agent@gmail.com', NULL, 'agent', '247099', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:18:45', '2024-10-27 16:18:45'),
(457, 3, 'agent@gmail.com', NULL, 'agent', '247099', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:18:45', '2024-10-27 16:18:45'),
(458, 3, 'agent@gmail.com', NULL, 'agent', '206482', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:19:15', '2024-10-27 16:19:15'),
(459, 3, 'agent@gmail.com', NULL, 'agent', '206482', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:19:15', '2024-10-27 16:19:15'),
(460, 3, 'agent@gmail.com', NULL, 'agent', '788382', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:25:32', '2024-10-27 16:25:32'),
(461, 3, 'agent@gmail.com', NULL, 'agent', '788382', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:25:32', '2024-10-27 16:25:32'),
(462, 3, 'agent@gmail.com', NULL, 'agent', '247802', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:25:40', '2024-10-27 16:25:40'),
(463, 3, 'agent@gmail.com', NULL, 'agent', '247802', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:25:40', '2024-10-27 16:25:40'),
(464, 3, 'agent@gmail.com', NULL, 'agent', '029475', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:25:43', '2024-10-27 16:25:43'),
(465, 3, 'agent@gmail.com', NULL, 'agent', '029475', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:25:43', '2024-10-27 16:25:43'),
(466, 3, 'agent@gmail.com', NULL, 'agent', '299227', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:25:47', '2024-10-27 16:25:47'),
(467, 3, 'agent@gmail.com', NULL, 'agent', '299227', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:25:47', '2024-10-27 16:25:47'),
(468, 3, 'agent@gmail.com', NULL, 'agent', '399012', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:26:17', '2024-10-27 16:26:17'),
(469, 3, 'agent@gmail.com', NULL, 'agent', '399012', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:26:17', '2024-10-27 16:26:17'),
(470, 3, 'agent@gmail.com', NULL, 'agent', '739922', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:30:28', '2024-10-27 16:30:28'),
(471, 3, 'agent@gmail.com', NULL, 'agent', '739922', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:30:28', '2024-10-27 16:30:28'),
(472, 3, 'agent@gmail.com', NULL, 'agent', '834527', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:32:10', '2024-10-27 16:32:10'),
(473, 3, 'agent@gmail.com', NULL, 'agent', '834527', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:32:10', '2024-10-27 16:32:10'),
(474, 3, 'agent@gmail.com', NULL, 'agent', '860885', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:33:12', '2024-10-27 16:33:12'),
(475, 3, 'agent@gmail.com', NULL, 'agent', '860885', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:33:12', '2024-10-27 16:33:12'),
(476, 3, 'agent@gmail.com', NULL, 'agent', '298267', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:33:55', '2024-10-27 16:33:55'),
(477, 3, 'agent@gmail.com', NULL, 'agent', '298267', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:33:55', '2024-10-27 16:33:55'),
(478, 3, 'agent@gmail.com', NULL, 'agent', '557537', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:34:10', '2024-10-27 16:34:10'),
(479, 3, 'agent@gmail.com', NULL, 'agent', '557537', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:34:10', '2024-10-27 16:34:10'),
(480, 3, 'agent@gmail.com', NULL, 'agent', '080481', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:34:39', '2024-10-27 16:34:39'),
(481, 3, 'agent@gmail.com', NULL, 'agent', '080481', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:34:39', '2024-10-27 16:34:39'),
(482, 3, 'agent@gmail.com', NULL, 'agent', '463201', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:35:39', '2024-10-27 16:35:39'),
(483, 3, 'agent@gmail.com', NULL, 'agent', '463201', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:35:39', '2024-10-27 16:35:39'),
(484, 3, 'agent@gmail.com', NULL, 'agent', '104339', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:35:59', '2024-10-27 16:35:59'),
(485, 3, 'agent@gmail.com', NULL, 'agent', '104339', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:35:59', '2024-10-27 16:35:59'),
(486, 3, 'agent@gmail.com', NULL, 'agent', '806663', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:36:06', '2024-10-27 16:36:06'),
(487, 3, 'agent@gmail.com', NULL, 'agent', '806663', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:36:06', '2024-10-27 16:36:06'),
(488, 3, 'agent@gmail.com', NULL, 'agent', '550224', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:36:27', '2024-10-27 16:36:27'),
(489, 3, 'agent@gmail.com', NULL, 'agent', '550224', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:36:27', '2024-10-27 16:36:27'),
(490, 3, 'agent@gmail.com', NULL, 'agent', '363229', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:42:42', '2024-10-27 16:42:42'),
(491, 3, 'agent@gmail.com', NULL, 'agent', '363229', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:42:42', '2024-10-27 16:42:42'),
(492, 3, 'agent@gmail.com', NULL, 'agent', '001702', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:45:47', '2024-10-27 16:45:47'),
(493, 3, 'agent@gmail.com', NULL, 'agent', '001702', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:45:47', '2024-10-27 16:45:47'),
(494, 3, 'agent@gmail.com', NULL, 'agent', '721459', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:47:09', '2024-10-27 16:47:09'),
(495, 3, 'agent@gmail.com', NULL, 'agent', '721459', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:47:09', '2024-10-27 16:47:09'),
(496, 3, 'agent@gmail.com', NULL, 'agent', '064659', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:48:08', '2024-10-27 16:48:08'),
(497, 3, 'agent@gmail.com', NULL, 'agent', '064659', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:48:08', '2024-10-27 16:48:08'),
(498, 3, 'agent@gmail.com', NULL, 'agent', '709190', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:49:44', '2024-10-27 16:49:44'),
(499, 3, 'agent@gmail.com', NULL, 'agent', '709190', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:49:44', '2024-10-27 16:49:44'),
(500, 3, 'agent@gmail.com', NULL, 'agent', '852295', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:49:57', '2024-10-27 16:49:57'),
(501, 3, 'agent@gmail.com', NULL, 'agent', '852295', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:49:57', '2024-10-27 16:49:57'),
(502, 3, 'agent@gmail.com', NULL, 'agent', '953897', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:51:00', '2024-10-27 16:51:00'),
(503, 3, 'agent@gmail.com', NULL, 'agent', '953897', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:51:00', '2024-10-27 16:51:00'),
(504, 3, 'agent@gmail.com', NULL, 'agent', '909262', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:51:30', '2024-10-27 16:51:30'),
(505, 3, 'agent@gmail.com', NULL, 'agent', '909262', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:51:30', '2024-10-27 16:51:30'),
(506, 3, 'agent@gmail.com', NULL, 'agent', '362333', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 16:58:30', '2024-10-27 16:58:30'),
(507, 3, 'agent@gmail.com', NULL, 'agent', '362333', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 16:58:30', '2024-10-27 16:58:30'),
(508, 3, 'agent@gmail.com', NULL, 'agent', '434423', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:01:03', '2024-10-27 17:01:03'),
(509, 3, 'agent@gmail.com', NULL, 'agent', '434423', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:01:03', '2024-10-27 17:01:03'),
(510, 3, 'agent@gmail.com', NULL, 'agent', '308236', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:01:21', '2024-10-27 17:01:21'),
(511, 3, 'agent@gmail.com', NULL, 'agent', '308236', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:01:21', '2024-10-27 17:01:21'),
(512, 3, 'agent@gmail.com', NULL, 'agent', '861924', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:02:30', '2024-10-27 17:02:30'),
(513, 3, 'agent@gmail.com', NULL, 'agent', '861924', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:02:30', '2024-10-27 17:02:30'),
(514, 3, 'agent@gmail.com', NULL, 'agent', '812251', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:02:38', '2024-10-27 17:02:38'),
(515, 3, 'agent@gmail.com', NULL, 'agent', '812251', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:02:38', '2024-10-27 17:02:38'),
(516, 3, 'agent@gmail.com', NULL, 'agent', '762347', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:02:47', '2024-10-27 17:02:47'),
(517, 3, 'agent@gmail.com', NULL, 'agent', '762347', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:02:47', '2024-10-27 17:02:47'),
(518, 3, 'agent@gmail.com', NULL, 'agent', '462682', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:03:04', '2024-10-27 17:03:04'),
(519, 3, 'agent@gmail.com', NULL, 'agent', '462682', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:03:04', '2024-10-27 17:03:04'),
(520, 3, 'agent@gmail.com', NULL, 'agent', '678387', 'PRONDL830146', 'New Driver License', '45200', '2', 90400.00, '2024-10-27 17:03:21', '2024-10-27 17:03:21'),
(521, 3, 'agent@gmail.com', NULL, 'agent', '678387', 'PRODPN799266', 'Dealer`s Plate Number', '320000', '1', 320000.00, '2024-10-27 17:03:21', '2024-10-27 17:03:21'),
(522, 3, 'agent@gmail.com', NULL, 'agent', '426247', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:36:35', '2024-10-27 17:36:35'),
(523, 3, 'agent@gmail.com', NULL, 'agent', '735467', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:38:38', '2024-10-27 17:38:38'),
(524, 3, 'agent@gmail.com', NULL, 'agent', '790849', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:38:59', '2024-10-27 17:38:59'),
(525, 3, 'agent@gmail.com', NULL, 'agent', '397167', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:39:06', '2024-10-27 17:39:06'),
(526, 3, 'agent@gmail.com', NULL, 'agent', '062790', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:39:10', '2024-10-27 17:39:10'),
(527, 3, 'agent@gmail.com', NULL, 'agent', '604111', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:39:17', '2024-10-27 17:39:17'),
(528, 3, 'agent@gmail.com', NULL, 'agent', '828879', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:40:51', '2024-10-27 17:40:51'),
(529, 3, 'agent@gmail.com', NULL, 'agent', '138901', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:40:58', '2024-10-27 17:40:58'),
(530, 3, 'agent@gmail.com', NULL, 'agent', '403488', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:42:37', '2024-10-27 17:42:37'),
(531, 3, 'agent@gmail.com', NULL, 'agent', '969793', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 17:42:42', '2024-10-27 17:42:42'),
(532, 3, 'agent@gmail.com', NULL, 'agent', '626420', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:09:25', '2024-10-27 18:09:25'),
(533, 3, 'agent@gmail.com', NULL, 'agent', '626420', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:09:25', '2024-10-27 18:09:25'),
(534, 3, 'agent@gmail.com', NULL, 'agent', '979486', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:10:44', '2024-10-27 18:10:44'),
(535, 3, 'agent@gmail.com', NULL, 'agent', '979486', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:10:44', '2024-10-27 18:10:44'),
(536, 3, 'agent@gmail.com', NULL, 'agent', '053025', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:10:50', '2024-10-27 18:10:50'),
(537, 3, 'agent@gmail.com', NULL, 'agent', '053025', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:10:50', '2024-10-27 18:10:50'),
(538, 3, 'agent@gmail.com', NULL, 'agent', '785195', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:11:11', '2024-10-27 18:11:11'),
(539, 3, 'agent@gmail.com', NULL, 'agent', '785195', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:11:11', '2024-10-27 18:11:11'),
(540, 3, 'agent@gmail.com', NULL, 'agent', '256167', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:11:25', '2024-10-27 18:11:25'),
(541, 3, 'agent@gmail.com', NULL, 'agent', '256167', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:11:25', '2024-10-27 18:11:25'),
(542, 3, 'agent@gmail.com', NULL, 'agent', '669608', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:11:37', '2024-10-27 18:11:37'),
(543, 3, 'agent@gmail.com', NULL, 'agent', '669608', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:11:37', '2024-10-27 18:11:37'),
(544, 3, 'agent@gmail.com', NULL, 'agent', '255848', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:11:58', '2024-10-27 18:11:58'),
(545, 3, 'agent@gmail.com', NULL, 'agent', '255848', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:11:58', '2024-10-27 18:11:58'),
(546, 3, 'agent@gmail.com', NULL, 'agent', '793304', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:12:04', '2024-10-27 18:12:04'),
(547, 3, 'agent@gmail.com', NULL, 'agent', '793304', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:12:04', '2024-10-27 18:12:04'),
(548, 3, 'agent@gmail.com', NULL, 'agent', '967119', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:12:08', '2024-10-27 18:12:08'),
(549, 3, 'agent@gmail.com', NULL, 'agent', '967119', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:12:08', '2024-10-27 18:12:08'),
(550, 3, 'agent@gmail.com', NULL, 'agent', '071823', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:12:10', '2024-10-27 18:12:10'),
(551, 3, 'agent@gmail.com', NULL, 'agent', '071823', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:12:11', '2024-10-27 18:12:11'),
(552, 3, 'agent@gmail.com', NULL, 'agent', '490564', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:14:10', '2024-10-27 18:14:10'),
(553, 3, 'agent@gmail.com', NULL, 'agent', '490564', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:14:10', '2024-10-27 18:14:10'),
(554, 3, 'agent@gmail.com', NULL, 'agent', '169977', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:14:19', '2024-10-27 18:14:19'),
(555, 3, 'agent@gmail.com', NULL, 'agent', '169977', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:14:19', '2024-10-27 18:14:19'),
(556, 3, 'agent@gmail.com', NULL, 'agent', '477011', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:15:04', '2024-10-27 18:15:04'),
(557, 3, 'agent@gmail.com', NULL, 'agent', '477011', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:15:04', '2024-10-27 18:15:04'),
(558, 3, 'agent@gmail.com', NULL, 'agent', '439902', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:15:55', '2024-10-27 18:15:55'),
(559, 3, 'agent@gmail.com', NULL, 'agent', '439902', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:15:55', '2024-10-27 18:15:55'),
(560, 3, 'agent@gmail.com', NULL, 'agent', '250705', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:16:02', '2024-10-27 18:16:02'),
(561, 3, 'agent@gmail.com', NULL, 'agent', '250705', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:16:02', '2024-10-27 18:16:02'),
(562, 3, 'agent@gmail.com', NULL, 'agent', '710909', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:16:15', '2024-10-27 18:16:15'),
(563, 3, 'agent@gmail.com', NULL, 'agent', '710909', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:16:15', '2024-10-27 18:16:15'),
(564, 3, 'agent@gmail.com', NULL, 'agent', '071071', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:16:24', '2024-10-27 18:16:24'),
(565, 3, 'agent@gmail.com', NULL, 'agent', '071071', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:16:24', '2024-10-27 18:16:24'),
(566, 3, 'agent@gmail.com', NULL, 'agent', '159835', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:16:30', '2024-10-27 18:16:30'),
(567, 3, 'agent@gmail.com', NULL, 'agent', '159835', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:16:30', '2024-10-27 18:16:30'),
(568, 3, 'agent@gmail.com', NULL, 'agent', '333712', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:16:30', '2024-10-27 18:16:30'),
(569, 3, 'agent@gmail.com', NULL, 'agent', '333712', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:16:30', '2024-10-27 18:16:30'),
(570, 3, 'agent@gmail.com', NULL, 'agent', '078018', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:18:12', '2024-10-27 18:18:12'),
(571, 3, 'agent@gmail.com', NULL, 'agent', '078018', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:18:12', '2024-10-27 18:18:12'),
(572, 3, 'agent@gmail.com', NULL, 'agent', '654680', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:18:29', '2024-10-27 18:18:29'),
(573, 3, 'agent@gmail.com', NULL, 'agent', '654680', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:18:29', '2024-10-27 18:18:29'),
(574, 3, 'agent@gmail.com', NULL, 'agent', '548852', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:18:33', '2024-10-27 18:18:33'),
(575, 3, 'agent@gmail.com', NULL, 'agent', '548852', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:18:33', '2024-10-27 18:18:33'),
(576, 3, 'agent@gmail.com', NULL, 'agent', '368235', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:18:38', '2024-10-27 18:18:38'),
(577, 3, 'agent@gmail.com', NULL, 'agent', '368235', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:18:38', '2024-10-27 18:18:38'),
(578, 3, 'agent@gmail.com', NULL, 'agent', '531045', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:18:55', '2024-10-27 18:18:55'),
(579, 3, 'agent@gmail.com', NULL, 'agent', '531045', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:18:55', '2024-10-27 18:18:55'),
(580, 3, 'agent@gmail.com', NULL, 'agent', '531490', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:19:06', '2024-10-27 18:19:06'),
(581, 3, 'agent@gmail.com', NULL, 'agent', '531490', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:19:06', '2024-10-27 18:19:06'),
(582, 3, 'agent@gmail.com', NULL, 'agent', '525509', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:19:16', '2024-10-27 18:19:16'),
(583, 3, 'agent@gmail.com', NULL, 'agent', '525509', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:19:16', '2024-10-27 18:19:16'),
(584, 3, 'agent@gmail.com', NULL, 'agent', '773596', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:19:49', '2024-10-27 18:19:49'),
(585, 3, 'agent@gmail.com', NULL, 'agent', '773596', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:19:49', '2024-10-27 18:19:49'),
(586, 3, 'agent@gmail.com', NULL, 'agent', '344480', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:19:56', '2024-10-27 18:19:56'),
(587, 3, 'agent@gmail.com', NULL, 'agent', '344480', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:19:56', '2024-10-27 18:19:56'),
(588, 3, 'agent@gmail.com', NULL, 'agent', '642934', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:02', '2024-10-27 18:20:02'),
(589, 3, 'agent@gmail.com', NULL, 'agent', '642934', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:02', '2024-10-27 18:20:02'),
(590, 3, 'agent@gmail.com', NULL, 'agent', '541471', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:06', '2024-10-27 18:20:06'),
(591, 3, 'agent@gmail.com', NULL, 'agent', '541471', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:06', '2024-10-27 18:20:06'),
(592, 3, 'agent@gmail.com', NULL, 'agent', '500209', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:23', '2024-10-27 18:20:23'),
(593, 3, 'agent@gmail.com', NULL, 'agent', '500209', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:23', '2024-10-27 18:20:23'),
(594, 3, 'agent@gmail.com', NULL, 'agent', '510034', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:43', '2024-10-27 18:20:43'),
(595, 3, 'agent@gmail.com', NULL, 'agent', '510034', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:43', '2024-10-27 18:20:43'),
(596, 3, 'agent@gmail.com', NULL, 'agent', '047960', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:55', '2024-10-27 18:20:55'),
(597, 3, 'agent@gmail.com', NULL, 'agent', '047960', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:55', '2024-10-27 18:20:55'),
(598, 3, 'agent@gmail.com', NULL, 'agent', '357945', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:20:59', '2024-10-27 18:20:59'),
(599, 3, 'agent@gmail.com', NULL, 'agent', '357945', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:20:59', '2024-10-27 18:20:59'),
(600, 3, 'agent@gmail.com', NULL, 'agent', '063719', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:21:05', '2024-10-27 18:21:05'),
(601, 3, 'agent@gmail.com', NULL, 'agent', '063719', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:21:05', '2024-10-27 18:21:05'),
(602, 3, 'agent@gmail.com', NULL, 'agent', '307331', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:21:10', '2024-10-27 18:21:10'),
(603, 3, 'agent@gmail.com', NULL, 'agent', '307331', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:21:10', '2024-10-27 18:21:10'),
(604, 3, 'agent@gmail.com', NULL, 'agent', '348772', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:21:14', '2024-10-27 18:21:14'),
(605, 3, 'agent@gmail.com', NULL, 'agent', '348772', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:21:14', '2024-10-27 18:21:14'),
(606, 3, 'agent@gmail.com', NULL, 'agent', '873043', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:21:22', '2024-10-27 18:21:22'),
(607, 3, 'agent@gmail.com', NULL, 'agent', '873043', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:21:22', '2024-10-27 18:21:22'),
(608, 3, 'agent@gmail.com', NULL, 'agent', '228886', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:21:25', '2024-10-27 18:21:25'),
(609, 3, 'agent@gmail.com', NULL, 'agent', '228886', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:21:25', '2024-10-27 18:21:25'),
(610, 3, 'agent@gmail.com', NULL, 'agent', '182299', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:22:53', '2024-10-27 18:22:53'),
(611, 3, 'agent@gmail.com', NULL, 'agent', '182299', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:22:53', '2024-10-27 18:22:53'),
(612, 3, 'agent@gmail.com', NULL, 'agent', '565671', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:23:27', '2024-10-27 18:23:27'),
(613, 3, 'agent@gmail.com', NULL, 'agent', '565671', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:23:27', '2024-10-27 18:23:27'),
(614, 3, 'agent@gmail.com', NULL, 'agent', '637557', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:24:21', '2024-10-27 18:24:21'),
(615, 3, 'agent@gmail.com', NULL, 'agent', '637557', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:24:21', '2024-10-27 18:24:21'),
(616, 3, 'agent@gmail.com', NULL, 'agent', '216657', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:24:35', '2024-10-27 18:24:35'),
(617, 3, 'agent@gmail.com', NULL, 'agent', '216657', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:24:35', '2024-10-27 18:24:35'),
(618, 3, 'agent@gmail.com', NULL, 'agent', '603767', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:24:49', '2024-10-27 18:24:49'),
(619, 3, 'agent@gmail.com', NULL, 'agent', '603767', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:24:49', '2024-10-27 18:24:49'),
(620, 3, 'agent@gmail.com', NULL, 'agent', '617659', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:01', '2024-10-27 18:26:01'),
(621, 3, 'agent@gmail.com', NULL, 'agent', '617659', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:01', '2024-10-27 18:26:01'),
(622, 3, 'agent@gmail.com', NULL, 'agent', '809156', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:14', '2024-10-27 18:26:14'),
(623, 3, 'agent@gmail.com', NULL, 'agent', '809156', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:14', '2024-10-27 18:26:14'),
(624, 3, 'agent@gmail.com', NULL, 'agent', '498213', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:14', '2024-10-27 18:26:14'),
(625, 3, 'agent@gmail.com', NULL, 'agent', '498213', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:14', '2024-10-27 18:26:14'),
(626, 3, 'agent@gmail.com', NULL, 'agent', '616360', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:25', '2024-10-27 18:26:25'),
(627, 3, 'agent@gmail.com', NULL, 'agent', '616360', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:25', '2024-10-27 18:26:25'),
(628, 3, 'agent@gmail.com', NULL, 'agent', '344438', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:35', '2024-10-27 18:26:35'),
(629, 3, 'agent@gmail.com', NULL, 'agent', '344438', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:35', '2024-10-27 18:26:35'),
(630, 3, 'agent@gmail.com', NULL, 'agent', '502286', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:40', '2024-10-27 18:26:40'),
(631, 3, 'agent@gmail.com', NULL, 'agent', '502286', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:40', '2024-10-27 18:26:40'),
(632, 3, 'agent@gmail.com', NULL, 'agent', '298958', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:49', '2024-10-27 18:26:49'),
(633, 3, 'agent@gmail.com', NULL, 'agent', '298958', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:49', '2024-10-27 18:26:49'),
(634, 3, 'agent@gmail.com', NULL, 'agent', '972087', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:26:49', '2024-10-27 18:26:49'),
(635, 3, 'agent@gmail.com', NULL, 'agent', '972087', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:26:49', '2024-10-27 18:26:49'),
(636, 3, 'agent@gmail.com', NULL, 'agent', '211562', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:27:02', '2024-10-27 18:27:02'),
(637, 3, 'agent@gmail.com', NULL, 'agent', '211562', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:27:02', '2024-10-27 18:27:02'),
(638, 3, 'agent@gmail.com', NULL, 'agent', '453504', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:36:30', '2024-10-27 18:36:30'),
(639, 3, 'agent@gmail.com', NULL, 'agent', '453504', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:36:30', '2024-10-27 18:36:30'),
(640, 3, 'agent@gmail.com', NULL, 'agent', '358465', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:39:46', '2024-10-27 18:39:46'),
(641, 3, 'agent@gmail.com', NULL, 'agent', '358465', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:39:46', '2024-10-27 18:39:46'),
(642, 3, 'agent@gmail.com', NULL, 'agent', '330998', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 18:43:50', '2024-10-27 18:43:50'),
(643, 3, 'agent@gmail.com', NULL, 'agent', '330998', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 18:43:50', '2024-10-27 18:43:50'),
(644, 3, 'agent@gmail.com', NULL, 'agent', '683139', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:37:07', '2024-10-27 19:37:07'),
(645, 3, 'agent@gmail.com', NULL, 'agent', '683139', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:37:07', '2024-10-27 19:37:07'),
(646, 3, 'agent@gmail.com', NULL, 'agent', '683139', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:37:07', '2024-10-27 19:37:07'),
(647, 3, 'agent@gmail.com', NULL, 'agent', '076521', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:37:35', '2024-10-27 19:37:35'),
(648, 3, 'agent@gmail.com', NULL, 'agent', '076521', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:37:35', '2024-10-27 19:37:35'),
(649, 3, 'agent@gmail.com', NULL, 'agent', '076521', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:37:35', '2024-10-27 19:37:35'),
(650, 3, 'agent@gmail.com', NULL, 'agent', '542700', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:38:06', '2024-10-27 19:38:06'),
(651, 3, 'agent@gmail.com', NULL, 'agent', '542700', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:38:06', '2024-10-27 19:38:06'),
(652, 3, 'agent@gmail.com', NULL, 'agent', '542700', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:38:06', '2024-10-27 19:38:06'),
(653, 3, 'agent@gmail.com', NULL, 'agent', '491944', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:40:23', '2024-10-27 19:40:23'),
(654, 3, 'agent@gmail.com', NULL, 'agent', '491944', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:40:23', '2024-10-27 19:40:23'),
(655, 3, 'agent@gmail.com', NULL, 'agent', '491944', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:40:23', '2024-10-27 19:40:23'),
(656, 3, 'agent@gmail.com', NULL, 'agent', '506788', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:41:49', '2024-10-27 19:41:49'),
(657, 3, 'agent@gmail.com', NULL, 'agent', '506788', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:41:49', '2024-10-27 19:41:49'),
(658, 3, 'agent@gmail.com', NULL, 'agent', '506788', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:41:49', '2024-10-27 19:41:49'),
(659, 3, 'agent@gmail.com', NULL, 'agent', '228414', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:41:54', '2024-10-27 19:41:54'),
(660, 3, 'agent@gmail.com', NULL, 'agent', '228414', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:41:54', '2024-10-27 19:41:54'),
(661, 3, 'agent@gmail.com', NULL, 'agent', '228414', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:41:54', '2024-10-27 19:41:54'),
(662, 3, 'agent@gmail.com', NULL, 'agent', '330453', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:41:58', '2024-10-27 19:41:58'),
(663, 3, 'agent@gmail.com', NULL, 'agent', '330453', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:41:58', '2024-10-27 19:41:58'),
(664, 3, 'agent@gmail.com', NULL, 'agent', '330453', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:41:58', '2024-10-27 19:41:58'),
(665, 3, 'agent@gmail.com', NULL, 'agent', '228852', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:42:13', '2024-10-27 19:42:13'),
(666, 3, 'agent@gmail.com', NULL, 'agent', '228852', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:42:13', '2024-10-27 19:42:13'),
(667, 3, 'agent@gmail.com', NULL, 'agent', '228852', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:42:13', '2024-10-27 19:42:13'),
(668, 3, 'agent@gmail.com', NULL, 'agent', '570377', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:42:17', '2024-10-27 19:42:17'),
(669, 3, 'agent@gmail.com', NULL, 'agent', '570377', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:42:17', '2024-10-27 19:42:17'),
(670, 3, 'agent@gmail.com', NULL, 'agent', '570377', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:42:17', '2024-10-27 19:42:17'),
(671, 3, 'agent@gmail.com', NULL, 'agent', '315020', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:43:02', '2024-10-27 19:43:02'),
(672, 3, 'agent@gmail.com', NULL, 'agent', '315020', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:43:02', '2024-10-27 19:43:02'),
(673, 3, 'agent@gmail.com', NULL, 'agent', '315020', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:43:02', '2024-10-27 19:43:02'),
(674, 3, 'agent@gmail.com', NULL, 'agent', '673234', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:43:16', '2024-10-27 19:43:16'),
(675, 3, 'agent@gmail.com', NULL, 'agent', '673234', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:43:16', '2024-10-27 19:43:16'),
(676, 3, 'agent@gmail.com', NULL, 'agent', '673234', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:43:16', '2024-10-27 19:43:16'),
(677, 3, 'agent@gmail.com', NULL, 'agent', '343567', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:43:26', '2024-10-27 19:43:26'),
(678, 3, 'agent@gmail.com', NULL, 'agent', '343567', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:43:26', '2024-10-27 19:43:26'),
(679, 3, 'agent@gmail.com', NULL, 'agent', '343567', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:43:26', '2024-10-27 19:43:26'),
(680, 3, 'agent@gmail.com', NULL, 'agent', '977086', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 19:43:39', '2024-10-27 19:43:39'),
(681, 3, 'agent@gmail.com', NULL, 'agent', '977086', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 19:43:39', '2024-10-27 19:43:39'),
(682, 3, 'agent@gmail.com', NULL, 'agent', '977086', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 19:43:39', '2024-10-27 19:43:39'),
(683, 3, 'agent@gmail.com', NULL, 'agent', '120656', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 20:01:43', '2024-10-27 20:01:43'),
(684, 3, 'agent@gmail.com', NULL, 'agent', '120656', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 20:01:43', '2024-10-27 20:01:43'),
(685, 3, 'agent@gmail.com', NULL, 'agent', '120656', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 20:01:43', '2024-10-27 20:01:43'),
(686, 3, 'agent@gmail.com', NULL, 'agent', '120656', 'PROOP942298', 'Other Permit', '10500', '1', 10500.00, '2024-10-27 20:01:43', '2024-10-27 20:01:43'),
(687, 3, 'agent@gmail.com', NULL, 'agent', '242432', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 20:06:13', '2024-10-27 20:06:13'),
(688, 3, 'agent@gmail.com', NULL, 'agent', '242432', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 20:06:13', '2024-10-27 20:06:13'),
(689, 3, 'agent@gmail.com', NULL, 'agent', '242432', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 20:06:13', '2024-10-27 20:06:13'),
(690, 3, 'agent@gmail.com', NULL, 'agent', '242432', 'PROOP942298', 'Other Permit', '10500', '1', 10500.00, '2024-10-27 20:06:13', '2024-10-27 20:06:13'),
(691, 3, 'agent@gmail.com', NULL, 'agent', '390993', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(692, 3, 'agent@gmail.com', NULL, 'agent', '390993', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(693, 3, 'agent@gmail.com', NULL, 'agent', '390993', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(694, 3, 'agent@gmail.com', NULL, 'agent', '390993', 'PROOP942298', 'Other Permit', '10500', '1', 10500.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(695, 3, 'agent@gmail.com', NULL, 'agent', '858350', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(696, 3, 'agent@gmail.com', NULL, 'agent', '858350', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(697, 3, 'agent@gmail.com', NULL, 'agent', '858350', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(698, 3, 'agent@gmail.com', NULL, 'agent', '858350', 'PROOP942298', 'Other Permit', '10500', '1', 10500.00, '2024-10-27 20:19:53', '2024-10-27 20:19:53'),
(699, 3, 'agent@gmail.com', NULL, 'agent', '584418', 'PRONDL973625', 'New Driver License', '40200', '1', 40200.00, '2024-10-27 20:20:43', '2024-10-27 20:20:43'),
(700, 3, 'agent@gmail.com', NULL, 'agent', '584418', 'PRODLR872409', 'Driver License Renewal', '45200', '1', 45200.00, '2024-10-27 20:20:43', '2024-10-27 20:20:43'),
(701, 3, 'agent@gmail.com', NULL, 'agent', '584418', 'PROIDL797105', 'International Driver License', '35000', '1', 35000.00, '2024-10-27 20:20:43', '2024-10-27 20:20:43'),
(702, 3, 'agent@gmail.com', NULL, 'agent', '584418', 'PROOP942298', 'Other Permit', '10500', '1', 10500.00, '2024-10-27 20:20:43', '2024-10-27 20:20:43'),
(703, 5, 'eshanokpe@gmail.com', NULL, 'user', '516979', 'PROVPR195706', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-10-31 18:13:33', '2024-10-31 18:13:33'),
(704, 5, 'eshanokpe@gmail.com', NULL, 'user', '546143', 'PROVPR195706', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-10-31 18:31:13', '2024-10-31 18:31:13'),
(705, 3, 'agent@gmail.com', '15', 'agent', '738160', 'PROVPR888786', 'Vehicle Paper Renewal', '14600', '1', 14600.00, '2024-11-14 03:55:31', '2024-11-14 03:55:31'),
(706, 3, 'agent@gmail.com', '10', 'agent', '738160', 'PRONVR231391', 'Vehicle Registration', '139', '1', 139.00, '2024-11-14 03:55:31', '2024-11-14 03:55:31'),
(707, 3, 'agent@gmail.com', '12', 'agent', '738160', 'PROCO502026', 'Change of Ownership', '395000', '1', 395000.00, '2024-11-14 03:55:31', '2024-11-14 03:55:31'),
(708, 3, 'agent@gmail.com', '12', 'agent', '738160', 'PROCO542791', 'Change of Ownership', '166900', '1', 166900.00, '2024-11-14 03:55:31', '2024-11-14 03:55:31'),
(709, 3, 'agent@gmail.com', '12', 'agent', '738160', 'PROCO874563', 'Change of Ownership', '176300', '1', 176300.00, '2024-11-14 03:55:31', '2024-11-14 03:55:31'),
(710, 3, 'agent@gmail.com', '15', 'agent', '568991', 'PROVPR888786', 'Vehicle Paper Renewal', '14600', '1', 14600.00, '2024-11-14 03:56:02', '2024-11-14 03:56:02'),
(711, 3, 'agent@gmail.com', '10', 'agent', '568991', 'PRONVR231391', 'Vehicle Registration', '139', '1', 139.00, '2024-11-14 03:56:02', '2024-11-14 03:56:02'),
(712, 3, 'agent@gmail.com', '12', 'agent', '568991', 'PROCO502026', 'Change of Ownership', '395000', '1', 395000.00, '2024-11-14 03:56:02', '2024-11-14 03:56:02'),
(713, 3, 'agent@gmail.com', '12', 'agent', '568991', 'PROCO542791', 'Change of Ownership', '166900', '1', 166900.00, '2024-11-14 03:56:02', '2024-11-14 03:56:02'),
(714, 3, 'agent@gmail.com', '12', 'agent', '568991', 'PROCO874563', 'Change of Ownership', '176300', '1', 176300.00, '2024-11-14 03:56:02', '2024-11-14 03:56:02'),
(715, 3, 'agent@gmail.com', '15', 'agent', '033775', 'PROVPR888786', 'Vehicle Paper Renewal', '14600', '1', 14600.00, '2024-11-14 03:56:51', '2024-11-14 03:56:51'),
(716, 3, 'agent@gmail.com', '10', 'agent', '033775', 'PRONVR231391', 'Vehicle Registration', '139', '1', 139.00, '2024-11-14 03:56:51', '2024-11-14 03:56:51'),
(717, 3, 'agent@gmail.com', '12', 'agent', '033775', 'PROCO502026', 'Change of Ownership', '395000', '1', 395000.00, '2024-11-14 03:56:51', '2024-11-14 03:56:51'),
(718, 3, 'agent@gmail.com', '12', 'agent', '033775', 'PROCO542791', 'Change of Ownership', '166900', '1', 166900.00, '2024-11-14 03:56:51', '2024-11-14 03:56:51'),
(719, 3, 'agent@gmail.com', '12', 'agent', '033775', 'PROCO874563', 'Change of Ownership', '176300', '1', 176300.00, '2024-11-14 03:56:51', '2024-11-14 03:56:51'),
(720, 3, 'agent@gmail.com', '15', 'agent', '441839', 'PROVPR888786', 'Vehicle Paper Renewal', '14600', '1', 14600.00, '2024-11-14 03:57:02', '2024-11-14 03:57:02'),
(721, 3, 'agent@gmail.com', '10', 'agent', '441839', 'PRONVR231391', 'Vehicle Registration', '139', '1', 139.00, '2024-11-14 03:57:02', '2024-11-14 03:57:02');
INSERT INTO `orders` (`id`, `user_id`, `user_email`, `owner_id`, `userType`, `order_number`, `process_id`, `product_name`, `product_amount`, `product_qty`, `total`, `created_at`, `updated_at`) VALUES
(722, 3, 'agent@gmail.com', '12', 'agent', '441839', 'PROCO502026', 'Change of Ownership', '395000', '1', 395000.00, '2024-11-14 03:57:02', '2024-11-14 03:57:02'),
(723, 3, 'agent@gmail.com', '12', 'agent', '441839', 'PROCO542791', 'Change of Ownership', '166900', '1', 166900.00, '2024-11-14 03:57:02', '2024-11-14 03:57:02'),
(724, 3, 'agent@gmail.com', '12', 'agent', '441839', 'PROCO874563', 'Change of Ownership', '176300', '1', 176300.00, '2024-11-14 03:57:02', '2024-11-14 03:57:02'),
(725, 3, 'agent@gmail.com', '15', 'agent', '002823', 'PROVPR888786', 'Vehicle Paper Renewal', '14600', '1', 14600.00, '2024-11-14 03:57:06', '2024-11-14 03:57:06'),
(726, 3, 'agent@gmail.com', '10', 'agent', '002823', 'PRONVR231391', 'Vehicle Registration', '139', '1', 139.00, '2024-11-14 03:57:06', '2024-11-14 03:57:06'),
(727, 3, 'agent@gmail.com', '12', 'agent', '002823', 'PROCO502026', 'Change of Ownership', '395000', '1', 395000.00, '2024-11-14 03:57:06', '2024-11-14 03:57:06'),
(728, 3, 'agent@gmail.com', '12', 'agent', '002823', 'PROCO542791', 'Change of Ownership', '166900', '1', 166900.00, '2024-11-14 03:57:06', '2024-11-14 03:57:06'),
(729, 3, 'agent@gmail.com', '12', 'agent', '002823', 'PROCO874563', 'Change of Ownership', '176300', '1', 176300.00, '2024-11-14 03:57:06', '2024-11-14 03:57:06'),
(730, 5, 'eshanokpe@gmail.com', NULL, 'user', '887098', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:29:16', '2024-11-28 01:29:16'),
(731, 5, 'eshanokpe@gmail.com', NULL, 'user', '887098', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:29:16', '2024-11-28 01:29:16'),
(732, 5, 'eshanokpe@gmail.com', NULL, 'user', '887098', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:29:16', '2024-11-28 01:29:16'),
(733, 5, 'eshanokpe@gmail.com', NULL, 'user', '667441', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:29:38', '2024-11-28 01:29:38'),
(734, 5, 'eshanokpe@gmail.com', NULL, 'user', '667441', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:29:38', '2024-11-28 01:29:38'),
(735, 5, 'eshanokpe@gmail.com', NULL, 'user', '667441', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:29:38', '2024-11-28 01:29:38'),
(736, 5, 'eshanokpe@gmail.com', NULL, 'user', '548381', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:29:43', '2024-11-28 01:29:43'),
(737, 5, 'eshanokpe@gmail.com', NULL, 'user', '548381', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:29:43', '2024-11-28 01:29:43'),
(738, 5, 'eshanokpe@gmail.com', NULL, 'user', '548381', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:29:43', '2024-11-28 01:29:43'),
(739, 5, 'eshanokpe@gmail.com', NULL, 'user', '786421', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:29:49', '2024-11-28 01:29:49'),
(740, 5, 'eshanokpe@gmail.com', NULL, 'user', '786421', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:29:49', '2024-11-28 01:29:49'),
(741, 5, 'eshanokpe@gmail.com', NULL, 'user', '786421', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:29:49', '2024-11-28 01:29:49'),
(742, 5, 'eshanokpe@gmail.com', NULL, 'user', '065900', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:29:53', '2024-11-28 01:29:53'),
(743, 5, 'eshanokpe@gmail.com', NULL, 'user', '065900', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:29:53', '2024-11-28 01:29:53'),
(744, 5, 'eshanokpe@gmail.com', NULL, 'user', '065900', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:29:53', '2024-11-28 01:29:53'),
(745, 5, 'eshanokpe@gmail.com', NULL, 'user', '078665', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:30:09', '2024-11-28 01:30:09'),
(746, 5, 'eshanokpe@gmail.com', NULL, 'user', '078665', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:30:09', '2024-11-28 01:30:09'),
(747, 5, 'eshanokpe@gmail.com', NULL, 'user', '078665', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:30:09', '2024-11-28 01:30:09'),
(748, 5, 'eshanokpe@gmail.com', NULL, 'user', '861694', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:31:40', '2024-11-28 01:31:40'),
(749, 5, 'eshanokpe@gmail.com', NULL, 'user', '861694', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:31:40', '2024-11-28 01:31:40'),
(750, 5, 'eshanokpe@gmail.com', NULL, 'user', '861694', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:31:40', '2024-11-28 01:31:40'),
(751, 5, 'eshanokpe@gmail.com', NULL, 'user', '913093', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:41:58', '2024-11-28 01:41:58'),
(752, 5, 'eshanokpe@gmail.com', NULL, 'user', '913093', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:41:58', '2024-11-28 01:41:58'),
(753, 5, 'eshanokpe@gmail.com', NULL, 'user', '913093', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:41:58', '2024-11-28 01:41:58'),
(754, 5, 'eshanokpe@gmail.com', NULL, 'user', '077530', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:42:05', '2024-11-28 01:42:05'),
(755, 5, 'eshanokpe@gmail.com', NULL, 'user', '077530', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:42:05', '2024-11-28 01:42:05'),
(756, 5, 'eshanokpe@gmail.com', NULL, 'user', '077530', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:42:05', '2024-11-28 01:42:05'),
(757, 5, 'eshanokpe@gmail.com', NULL, 'user', '310669', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:44:42', '2024-11-28 01:44:42'),
(758, 5, 'eshanokpe@gmail.com', NULL, 'user', '310669', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:44:42', '2024-11-28 01:44:42'),
(759, 5, 'eshanokpe@gmail.com', NULL, 'user', '310669', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:44:42', '2024-11-28 01:44:42'),
(760, 5, 'eshanokpe@gmail.com', NULL, 'user', '165536', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:44:48', '2024-11-28 01:44:48'),
(761, 5, 'eshanokpe@gmail.com', NULL, 'user', '165536', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:44:48', '2024-11-28 01:44:48'),
(762, 5, 'eshanokpe@gmail.com', NULL, 'user', '165536', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:44:48', '2024-11-28 01:44:48'),
(763, 5, 'eshanokpe@gmail.com', NULL, 'user', '256571', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:45:05', '2024-11-28 01:45:05'),
(764, 5, 'eshanokpe@gmail.com', NULL, 'user', '256571', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:45:05', '2024-11-28 01:45:05'),
(765, 5, 'eshanokpe@gmail.com', NULL, 'user', '256571', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:45:05', '2024-11-28 01:45:05'),
(766, 5, 'eshanokpe@gmail.com', NULL, 'user', '382068', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:45:11', '2024-11-28 01:45:11'),
(767, 5, 'eshanokpe@gmail.com', NULL, 'user', '382068', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:45:11', '2024-11-28 01:45:11'),
(768, 5, 'eshanokpe@gmail.com', NULL, 'user', '382068', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:45:11', '2024-11-28 01:45:11'),
(769, 5, 'eshanokpe@gmail.com', NULL, 'user', '287717', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:51:55', '2024-11-28 01:51:55'),
(770, 5, 'eshanokpe@gmail.com', NULL, 'user', '287717', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:51:55', '2024-11-28 01:51:55'),
(771, 5, 'eshanokpe@gmail.com', NULL, 'user', '287717', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:51:55', '2024-11-28 01:51:55'),
(772, 5, 'eshanokpe@gmail.com', NULL, 'user', '980066', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:52:36', '2024-11-28 01:52:36'),
(773, 5, 'eshanokpe@gmail.com', NULL, 'user', '980066', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:52:36', '2024-11-28 01:52:36'),
(774, 5, 'eshanokpe@gmail.com', NULL, 'user', '980066', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:52:36', '2024-11-28 01:52:36'),
(775, 5, 'eshanokpe@gmail.com', NULL, 'user', '804058', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:52:41', '2024-11-28 01:52:41'),
(776, 5, 'eshanokpe@gmail.com', NULL, 'user', '804058', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:52:41', '2024-11-28 01:52:41'),
(777, 5, 'eshanokpe@gmail.com', NULL, 'user', '804058', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:52:41', '2024-11-28 01:52:41'),
(778, 5, 'eshanokpe@gmail.com', NULL, 'user', '132905', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:07', '2024-11-28 01:54:07'),
(779, 5, 'eshanokpe@gmail.com', NULL, 'user', '132905', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:07', '2024-11-28 01:54:07'),
(780, 5, 'eshanokpe@gmail.com', NULL, 'user', '132905', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:07', '2024-11-28 01:54:07'),
(781, 5, 'eshanokpe@gmail.com', NULL, 'user', '800524', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:16', '2024-11-28 01:54:16'),
(782, 5, 'eshanokpe@gmail.com', NULL, 'user', '800524', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:16', '2024-11-28 01:54:16'),
(783, 5, 'eshanokpe@gmail.com', NULL, 'user', '800524', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:16', '2024-11-28 01:54:16'),
(784, 5, 'eshanokpe@gmail.com', NULL, 'user', '720537', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:22', '2024-11-28 01:54:22'),
(785, 5, 'eshanokpe@gmail.com', NULL, 'user', '720537', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:22', '2024-11-28 01:54:22'),
(786, 5, 'eshanokpe@gmail.com', NULL, 'user', '720537', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:22', '2024-11-28 01:54:22'),
(787, 5, 'eshanokpe@gmail.com', NULL, 'user', '498872', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:33', '2024-11-28 01:54:33'),
(788, 5, 'eshanokpe@gmail.com', NULL, 'user', '498872', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:33', '2024-11-28 01:54:33'),
(789, 5, 'eshanokpe@gmail.com', NULL, 'user', '498872', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:33', '2024-11-28 01:54:33'),
(790, 5, 'eshanokpe@gmail.com', NULL, 'user', '102369', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:40', '2024-11-28 01:54:40'),
(791, 5, 'eshanokpe@gmail.com', NULL, 'user', '102369', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:40', '2024-11-28 01:54:40'),
(792, 5, 'eshanokpe@gmail.com', NULL, 'user', '102369', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:40', '2024-11-28 01:54:40'),
(793, 5, 'eshanokpe@gmail.com', NULL, 'user', '163979', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:54:52', '2024-11-28 01:54:52'),
(794, 5, 'eshanokpe@gmail.com', NULL, 'user', '163979', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:54:52', '2024-11-28 01:54:52'),
(795, 5, 'eshanokpe@gmail.com', NULL, 'user', '163979', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:54:52', '2024-11-28 01:54:52'),
(796, 5, 'eshanokpe@gmail.com', NULL, 'user', '607609', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:55:06', '2024-11-28 01:55:06'),
(797, 5, 'eshanokpe@gmail.com', NULL, 'user', '607609', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:55:06', '2024-11-28 01:55:06'),
(798, 5, 'eshanokpe@gmail.com', NULL, 'user', '607609', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:55:06', '2024-11-28 01:55:06'),
(799, 5, 'eshanokpe@gmail.com', NULL, 'user', '924805', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:55:13', '2024-11-28 01:55:13'),
(800, 5, 'eshanokpe@gmail.com', NULL, 'user', '924805', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:55:13', '2024-11-28 01:55:13'),
(801, 5, 'eshanokpe@gmail.com', NULL, 'user', '924805', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:55:13', '2024-11-28 01:55:13'),
(802, 5, 'eshanokpe@gmail.com', NULL, 'user', '826862', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:56:16', '2024-11-28 01:56:16'),
(803, 5, 'eshanokpe@gmail.com', NULL, 'user', '826862', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:56:16', '2024-11-28 01:56:16'),
(804, 5, 'eshanokpe@gmail.com', NULL, 'user', '826862', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:56:16', '2024-11-28 01:56:16'),
(805, 5, 'eshanokpe@gmail.com', NULL, 'user', '386651', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:56:21', '2024-11-28 01:56:21'),
(806, 5, 'eshanokpe@gmail.com', NULL, 'user', '386651', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:56:21', '2024-11-28 01:56:21'),
(807, 5, 'eshanokpe@gmail.com', NULL, 'user', '386651', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:56:21', '2024-11-28 01:56:21'),
(808, 5, 'eshanokpe@gmail.com', NULL, 'user', '032966', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:56:32', '2024-11-28 01:56:32'),
(809, 5, 'eshanokpe@gmail.com', NULL, 'user', '032966', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:56:32', '2024-11-28 01:56:32'),
(810, 5, 'eshanokpe@gmail.com', NULL, 'user', '032966', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:56:32', '2024-11-28 01:56:32'),
(811, 5, 'eshanokpe@gmail.com', NULL, 'user', '790597', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:56:35', '2024-11-28 01:56:35'),
(812, 5, 'eshanokpe@gmail.com', NULL, 'user', '790597', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:56:35', '2024-11-28 01:56:35'),
(813, 5, 'eshanokpe@gmail.com', NULL, 'user', '790597', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:56:35', '2024-11-28 01:56:35'),
(814, 5, 'eshanokpe@gmail.com', NULL, 'user', '111284', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 01:56:41', '2024-11-28 01:56:41'),
(815, 5, 'eshanokpe@gmail.com', NULL, 'user', '111284', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 01:56:41', '2024-11-28 01:56:41'),
(816, 5, 'eshanokpe@gmail.com', NULL, 'user', '111284', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 01:56:41', '2024-11-28 01:56:41'),
(817, 5, 'eshanokpe@gmail.com', NULL, 'user', '735915', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 02:02:02', '2024-11-28 02:02:02'),
(818, 5, 'eshanokpe@gmail.com', NULL, 'user', '735915', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 02:02:02', '2024-11-28 02:02:02'),
(819, 5, 'eshanokpe@gmail.com', NULL, 'user', '735915', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 02:02:02', '2024-11-28 02:02:02'),
(820, 5, 'eshanokpe@gmail.com', NULL, 'user', '295846', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 02:02:13', '2024-11-28 02:02:13'),
(821, 5, 'eshanokpe@gmail.com', NULL, 'user', '295846', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 02:02:13', '2024-11-28 02:02:13'),
(822, 5, 'eshanokpe@gmail.com', NULL, 'user', '295846', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 02:02:13', '2024-11-28 02:02:13'),
(823, 5, 'eshanokpe@gmail.com', NULL, 'user', '560294', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 02:27:57', '2024-11-28 02:27:57'),
(824, 5, 'eshanokpe@gmail.com', NULL, 'user', '560294', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 02:27:57', '2024-11-28 02:27:57'),
(825, 5, 'eshanokpe@gmail.com', NULL, 'user', '560294', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 02:27:57', '2024-11-28 02:27:57'),
(826, 5, 'eshanokpe@gmail.com', NULL, 'user', '199164', 'PRONVR840617', 'Vehicle Registration', '70200', '1', 70200.00, '2024-11-28 02:32:10', '2024-11-28 02:32:10'),
(827, 5, 'eshanokpe@gmail.com', NULL, 'user', '199164', 'PRONVR362669', 'Vehicle Registration', '80200', '1', 80200.00, '2024-11-28 02:32:10', '2024-11-28 02:32:10'),
(828, 5, 'eshanokpe@gmail.com', NULL, 'user', '199164', 'PROOP527264', 'Other Permit', '10500', '1', 10500.00, '2024-11-28 02:32:10', '2024-11-28 02:32:10'),
(829, 5, 'eshanokpe@gmail.com', NULL, 'user', '142933', 'PRONVR741225', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 15:46:24', '2024-12-05 15:46:24'),
(830, 5, 'eshanokpe@gmail.com', NULL, 'user', '933046', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 17:40:53', '2024-12-05 17:40:53'),
(831, 5, 'eshanokpe@gmail.com', NULL, 'user', '029912', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:07:00', '2024-12-05 19:07:00'),
(832, 5, 'eshanokpe@gmail.com', NULL, 'user', '002717', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:07:19', '2024-12-05 19:07:19'),
(833, 5, 'eshanokpe@gmail.com', NULL, 'user', '128123', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:07:48', '2024-12-05 19:07:48'),
(834, 5, 'eshanokpe@gmail.com', NULL, 'user', '630296', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:08:13', '2024-12-05 19:08:13'),
(835, 5, 'eshanokpe@gmail.com', NULL, 'user', '616667', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:08:49', '2024-12-05 19:08:49'),
(836, 5, 'eshanokpe@gmail.com', NULL, 'user', '982016', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:09:33', '2024-12-05 19:09:33'),
(837, 5, 'eshanokpe@gmail.com', NULL, 'user', '856623', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:10:01', '2024-12-05 19:10:01'),
(838, 5, 'eshanokpe@gmail.com', NULL, 'user', '764316', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:10:27', '2024-12-05 19:10:27'),
(839, 5, 'eshanokpe@gmail.com', NULL, 'user', '759150', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:10:44', '2024-12-05 19:10:44'),
(840, 5, 'eshanokpe@gmail.com', NULL, 'user', '947234', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:11:20', '2024-12-05 19:11:20'),
(841, 5, 'eshanokpe@gmail.com', NULL, 'user', '149308', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:11:41', '2024-12-05 19:11:41'),
(842, 5, 'eshanokpe@gmail.com', NULL, 'user', '896156', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:12:08', '2024-12-05 19:12:08'),
(843, 5, 'eshanokpe@gmail.com', NULL, 'user', '091307', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:21:25', '2024-12-05 19:21:25'),
(844, 5, 'eshanokpe@gmail.com', NULL, 'user', '196874', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:22:32', '2024-12-05 19:22:32'),
(845, 5, 'eshanokpe@gmail.com', NULL, 'user', '552889', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:22:56', '2024-12-05 19:22:56'),
(846, 5, 'eshanokpe@gmail.com', NULL, 'user', '549749', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:24:22', '2024-12-05 19:24:22'),
(847, 5, 'eshanokpe@gmail.com', NULL, 'user', '215813', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:24:51', '2024-12-05 19:24:51'),
(848, 5, 'eshanokpe@gmail.com', NULL, 'user', '047749', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:25:10', '2024-12-05 19:25:10'),
(849, 5, 'eshanokpe@gmail.com', NULL, 'user', '093202', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:25:42', '2024-12-05 19:25:42'),
(850, 5, 'eshanokpe@gmail.com', NULL, 'user', '612990', 'PRONVR179573', 'Vehicle Registration', '80200', '1', 80200.00, '2024-12-05 19:27:28', '2024-12-05 19:27:28'),
(851, 3, 'agent@gmail.com', '10', 'agent', '081910', 'PRONVR418050', 'Vehicle Registration', '57', '1', 57.00, '2024-12-07 05:29:33', '2024-12-07 05:29:33'),
(852, 3, 'agent@gmail.com', '10', 'agent', '672982', 'PRONVR418050', 'Vehicle Registration', '57', '1', 57.00, '2024-12-07 05:32:00', '2024-12-07 05:32:00'),
(853, 3, 'agent@gmail.com', '10', 'agent', '780074', 'PRONVR418050', 'Vehicle Registration', '57', '1', 57.00, '2024-12-07 05:42:11', '2024-12-07 05:42:11'),
(854, 3, 'agent@gmail.com', '15', 'agent', '956458', 'PROVPR148684', 'Vehicle Paper Renewal', '7500', '1', 7500.00, '2024-12-28 01:38:44', '2024-12-28 01:38:44'),
(855, 5, 'eshanokpe@gmail.com', NULL, 'user', '106546', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 02:58:57', '2024-12-28 02:58:57'),
(856, 5, 'eshanokpe@gmail.com', NULL, 'user', '856306', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:00:19', '2024-12-28 03:00:19'),
(857, 5, 'eshanokpe@gmail.com', NULL, 'user', '375650', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:00:54', '2024-12-28 03:00:54'),
(858, 5, 'eshanokpe@gmail.com', NULL, 'user', '063480', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:02:17', '2024-12-28 03:02:17'),
(859, 5, 'eshanokpe@gmail.com', NULL, 'user', '864141', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:02:57', '2024-12-28 03:02:57'),
(860, 5, 'eshanokpe@gmail.com', NULL, 'user', '986152', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:03:42', '2024-12-28 03:03:42'),
(861, 5, 'eshanokpe@gmail.com', NULL, 'user', '114103', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:04:32', '2024-12-28 03:04:32'),
(862, 5, 'eshanokpe@gmail.com', NULL, 'user', '718255', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:07:41', '2024-12-28 03:07:41'),
(863, 5, 'eshanokpe@gmail.com', NULL, 'user', '898716', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:08:16', '2024-12-28 03:08:16'),
(864, 5, 'eshanokpe@gmail.com', NULL, 'user', '642199', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:09:30', '2024-12-28 03:09:30'),
(865, 5, 'eshanokpe@gmail.com', NULL, 'user', '506886', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:09:48', '2024-12-28 03:09:48'),
(866, 5, 'eshanokpe@gmail.com', NULL, 'user', '282977', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:09:59', '2024-12-28 03:09:59'),
(867, 5, 'eshanokpe@gmail.com', NULL, 'user', '538475', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:10:22', '2024-12-28 03:10:22'),
(868, 5, 'eshanokpe@gmail.com', NULL, 'user', '817758', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:10:35', '2024-12-28 03:10:35'),
(869, 5, 'eshanokpe@gmail.com', NULL, 'user', '092689', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:10:44', '2024-12-28 03:10:44'),
(870, 5, 'eshanokpe@gmail.com', NULL, 'user', '723859', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:10:47', '2024-12-28 03:10:47'),
(871, 5, 'eshanokpe@gmail.com', NULL, 'user', '854226', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:12:07', '2024-12-28 03:12:07'),
(872, 5, 'eshanokpe@gmail.com', NULL, 'user', '261068', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:12:53', '2024-12-28 03:12:53'),
(873, 5, 'eshanokpe@gmail.com', NULL, 'user', '870783', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:13:26', '2024-12-28 03:13:26'),
(874, 5, 'eshanokpe@gmail.com', NULL, 'user', '245149', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:13:41', '2024-12-28 03:13:41'),
(875, 5, 'eshanokpe@gmail.com', NULL, 'user', '685497', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:16:25', '2024-12-28 03:16:25'),
(876, 5, 'eshanokpe@gmail.com', NULL, 'user', '872787', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:16:32', '2024-12-28 03:16:32'),
(877, 5, 'eshanokpe@gmail.com', NULL, 'user', '520221', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:17:25', '2024-12-28 03:17:25'),
(878, 5, 'eshanokpe@gmail.com', NULL, 'user', '266867', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:17:37', '2024-12-28 03:17:37'),
(879, 5, 'eshanokpe@gmail.com', NULL, 'user', '839391', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:20:33', '2024-12-28 03:20:33'),
(880, 5, 'eshanokpe@gmail.com', NULL, 'user', '946165', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:20:51', '2024-12-28 03:20:51'),
(881, 5, 'eshanokpe@gmail.com', NULL, 'user', '454244', 'PROVPR463099', 'Vehicle Paper Renewal', '19600', '1', 19600.00, '2024-12-28 03:20:52', '2024-12-28 03:20:52'),
(882, 5, 'eshanokpe@gmail.com', NULL, 'user', '123111', 'PROVPR597615', 'Vehicle Paper Renewal', '24000', '1', 24000.00, '2024-12-28 03:21:37', '2024-12-28 03:21:37'),
(883, 5, 'eshanokpe@gmail.com', NULL, 'user', '137653', 'PROVPR597615', 'Vehicle Paper Renewal', '24000', '1', 24000.00, '2024-12-28 03:24:18', '2024-12-28 03:24:18'),
(884, 5, 'eshanokpe@gmail.com', NULL, 'user', '496876', 'PROVPR597615', 'Vehicle Paper Renewal', '24000', '1', 24000.00, '2024-12-28 03:24:37', '2024-12-28 03:24:37'),
(885, 5, 'eshanokpe@gmail.com', NULL, 'user', '203699', 'PROVPR597615', 'Vehicle Paper Renewal', '24000', '1', 24000.00, '2024-12-28 03:24:38', '2024-12-28 03:24:38'),
(886, 5, 'eshanokpe@gmail.com', NULL, 'user', '615464', 'PROVPR406973', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:25:12', '2024-12-28 03:25:12'),
(887, 5, 'eshanokpe@gmail.com', NULL, 'user', '233427', 'PROVPR607361', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:29:45', '2024-12-28 03:29:45'),
(888, 5, 'eshanokpe@gmail.com', NULL, 'user', '140021', 'PROVPR607361', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:33:03', '2024-12-28 03:33:03'),
(889, 5, 'eshanokpe@gmail.com', NULL, 'user', '702539', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:34:16', '2024-12-28 03:34:16'),
(890, 5, 'eshanokpe@gmail.com', NULL, 'user', '750403', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:34:46', '2024-12-28 03:34:46'),
(891, 5, 'eshanokpe@gmail.com', NULL, 'user', '434294', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:35:03', '2024-12-28 03:35:03'),
(892, 5, 'eshanokpe@gmail.com', NULL, 'user', '530192', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:35:29', '2024-12-28 03:35:29'),
(893, 5, 'eshanokpe@gmail.com', NULL, 'user', '126492', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:35:40', '2024-12-28 03:35:40'),
(894, 5, 'eshanokpe@gmail.com', NULL, 'user', '888769', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:07', '2024-12-28 03:36:07'),
(895, 5, 'eshanokpe@gmail.com', NULL, 'user', '395534', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:26', '2024-12-28 03:36:26'),
(896, 5, 'eshanokpe@gmail.com', NULL, 'user', '974421', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:33', '2024-12-28 03:36:33'),
(897, 5, 'eshanokpe@gmail.com', NULL, 'user', '832979', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:34', '2024-12-28 03:36:34'),
(898, 5, 'eshanokpe@gmail.com', NULL, 'user', '253971', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:44', '2024-12-28 03:36:44'),
(899, 5, 'eshanokpe@gmail.com', NULL, 'user', '389390', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:50', '2024-12-28 03:36:50'),
(900, 5, 'eshanokpe@gmail.com', NULL, 'user', '279513', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:36:59', '2024-12-28 03:36:59'),
(901, 5, 'eshanokpe@gmail.com', NULL, 'user', '079767', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:37:07', '2024-12-28 03:37:07'),
(902, 5, 'eshanokpe@gmail.com', NULL, 'user', '819020', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:38:30', '2024-12-28 03:38:30'),
(903, 5, 'eshanokpe@gmail.com', NULL, 'user', '747304', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:38:46', '2024-12-28 03:38:46'),
(904, 5, 'eshanokpe@gmail.com', NULL, 'user', '256293', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:39:17', '2024-12-28 03:39:17'),
(905, 5, 'eshanokpe@gmail.com', NULL, 'user', '256293', 'PROVPR761950', 'Vehicle Paper Renewal', '17500', '1', 17500.00, '2024-12-28 03:39:17', '2024-12-28 03:39:17'),
(906, 5, 'eshanokpe@gmail.com', NULL, 'user', '421112', 'PROVPR805067', 'Vehicle Paper Renewal', '22500', '1', 22500.00, '2024-12-28 03:39:34', '2024-12-28 03:39:34'),
(907, 5, 'eshanokpe@gmail.com', NULL, 'user', '421112', 'PROVPR761950', 'Vehicle Paper Renewal', '17500', '1', 17500.00, '2024-12-28 03:39:34', '2024-12-28 03:39:34'),
(908, 5, 'eshanokpe@gmail.com', NULL, 'user', '410558', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:40:55', '2024-12-28 03:40:55'),
(909, 5, 'eshanokpe@gmail.com', NULL, 'user', '592785', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:41:11', '2024-12-28 03:41:11'),
(910, 5, 'eshanokpe@gmail.com', NULL, 'user', '254940', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:42:22', '2024-12-28 03:42:22'),
(911, 5, 'eshanokpe@gmail.com', NULL, 'user', '909157', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:42:43', '2024-12-28 03:42:43'),
(912, 5, 'eshanokpe@gmail.com', NULL, 'user', '868564', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:45:39', '2024-12-28 03:45:39'),
(913, 5, 'eshanokpe@gmail.com', NULL, 'user', '533960', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:46:05', '2024-12-28 03:46:05'),
(914, 5, 'eshanokpe@gmail.com', NULL, 'user', '266282', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:48:23', '2024-12-28 03:48:23'),
(915, 5, 'eshanokpe@gmail.com', NULL, 'user', '806241', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:48:50', '2024-12-28 03:48:50'),
(916, 5, 'eshanokpe@gmail.com', NULL, 'user', '668308', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:49:24', '2024-12-28 03:49:24'),
(917, 5, 'eshanokpe@gmail.com', NULL, 'user', '406704', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:49:54', '2024-12-28 03:49:54'),
(918, 5, 'eshanokpe@gmail.com', NULL, 'user', '899543', 'PRONVR880044', 'Vehicle Registration', '70200', '1', 70200.00, '2024-12-28 03:52:26', '2024-12-28 03:52:26'),
(919, 3, 'agent@gmail.com', '15', 'agent', '833015', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:25:48', '2024-12-28 09:25:48'),
(920, 3, 'agent@gmail.com', '15', 'agent', '583909', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:27:10', '2024-12-28 09:27:10'),
(921, 3, 'agent@gmail.com', '15', 'agent', '383199', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:30:52', '2024-12-28 09:30:52'),
(922, 3, 'agent@gmail.com', '15', 'agent', '253940', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:44:13', '2024-12-28 09:44:13'),
(923, 3, 'agent@gmail.com', '15', 'agent', '823326', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:44:21', '2024-12-28 09:44:21'),
(924, 3, 'agent@gmail.com', '15', 'agent', '700896', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:46:32', '2024-12-28 09:46:32'),
(925, 3, 'agent@gmail.com', '15', 'agent', '145374', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:46:38', '2024-12-28 09:46:38'),
(926, 3, 'agent@gmail.com', '15', 'agent', '488650', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:46:45', '2024-12-28 09:46:45'),
(927, 3, 'agent@gmail.com', '15', 'agent', '891540', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:47:21', '2024-12-28 09:47:21'),
(928, 3, 'agent@gmail.com', '15', 'agent', '035806', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:50:17', '2024-12-28 09:50:17'),
(929, 3, 'agent@gmail.com', '15', 'agent', '575146', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:50:24', '2024-12-28 09:50:24'),
(930, 3, 'agent@gmail.com', '15', 'agent', '526985', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:50:42', '2024-12-28 09:50:42'),
(931, 3, 'agent@gmail.com', '15', 'agent', '061767', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:51:01', '2024-12-28 09:51:01'),
(932, 3, 'agent@gmail.com', '15', 'agent', '369815', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:51:41', '2024-12-28 09:51:41'),
(933, 3, 'agent@gmail.com', '15', 'agent', '798777', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:52:14', '2024-12-28 09:52:14'),
(934, 3, 'agent@gmail.com', '15', 'agent', '980929', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:53:02', '2024-12-28 09:53:02'),
(935, 3, 'agent@gmail.com', '15', 'agent', '235708', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:53:24', '2024-12-28 09:53:24'),
(936, 3, 'agent@gmail.com', '15', 'agent', '984506', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:53:33', '2024-12-28 09:53:33'),
(937, 3, 'agent@gmail.com', '15', 'agent', '138946', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:53:49', '2024-12-28 09:53:49'),
(938, 3, 'agent@gmail.com', '15', 'agent', '162333', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:54:15', '2024-12-28 09:54:15'),
(939, 3, 'agent@gmail.com', '15', 'agent', '534974', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:57:03', '2024-12-28 09:57:03'),
(940, 3, 'agent@gmail.com', '15', 'agent', '353796', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:57:11', '2024-12-28 09:57:11'),
(941, 3, 'agent@gmail.com', '15', 'agent', '958308', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:57:20', '2024-12-28 09:57:20'),
(942, 3, 'agent@gmail.com', '15', 'agent', '095975', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:57:54', '2024-12-28 09:57:54'),
(943, 3, 'agent@gmail.com', '15', 'agent', '570800', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:08', '2024-12-28 09:58:08'),
(944, 3, 'agent@gmail.com', '15', 'agent', '170462', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:11', '2024-12-28 09:58:11'),
(945, 3, 'agent@gmail.com', '15', 'agent', '040383', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:17', '2024-12-28 09:58:17'),
(946, 3, 'agent@gmail.com', '15', 'agent', '343078', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:29', '2024-12-28 09:58:29'),
(947, 3, 'agent@gmail.com', '15', 'agent', '333891', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:30', '2024-12-28 09:58:30'),
(948, 3, 'agent@gmail.com', '15', 'agent', '500390', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 09:58:36', '2024-12-28 09:58:36'),
(949, 3, 'agent@gmail.com', '15', 'agent', '324584', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:00:54', '2024-12-28 10:00:54'),
(950, 3, 'agent@gmail.com', '15', 'agent', '012427', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:02:51', '2024-12-28 10:02:51'),
(951, 3, 'agent@gmail.com', '15', 'agent', '123781', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:02:59', '2024-12-28 10:02:59'),
(952, 3, 'agent@gmail.com', '15', 'agent', '223488', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:03:40', '2024-12-28 10:03:40'),
(953, 3, 'agent@gmail.com', '15', 'agent', '993495', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:03:48', '2024-12-28 10:03:48'),
(954, 3, 'agent@gmail.com', '15', 'agent', '831876', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:03:53', '2024-12-28 10:03:53'),
(955, 3, 'agent@gmail.com', '15', 'agent', '121313', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:03:59', '2024-12-28 10:03:59'),
(956, 3, 'agent@gmail.com', '15', 'agent', '885863', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:04:09', '2024-12-28 10:04:09'),
(957, 3, 'agent@gmail.com', '15', 'agent', '951910', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:04:22', '2024-12-28 10:04:22'),
(958, 3, 'agent@gmail.com', '15', 'agent', '534051', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:05:06', '2024-12-28 10:05:06'),
(959, 3, 'agent@gmail.com', '15', 'agent', '443152', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:05:11', '2024-12-28 10:05:11'),
(960, 3, 'agent@gmail.com', '15', 'agent', '918891', 'PROVPR671722', 'Vehicle Paper Renewal', '4600', '1', 4600.00, '2024-12-28 10:05:27', '2024-12-28 10:05:27'),
(961, 10, 'eshanokpe@gmail.com', NULL, 'user', '360396', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:26:22', '2025-01-19 22:26:22'),
(962, 10, 'eshanokpe@gmail.com', NULL, 'user', '842318', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:27:48', '2025-01-19 22:27:48'),
(963, 10, 'eshanokpe@gmail.com', NULL, 'user', '672999', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:28:05', '2025-01-19 22:28:05'),
(964, 10, 'eshanokpe@gmail.com', NULL, 'user', '523574', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:28:23', '2025-01-19 22:28:23'),
(965, 10, 'eshanokpe@gmail.com', NULL, 'user', '819633', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:29:50', '2025-01-19 22:29:50'),
(966, 10, 'eshanokpe@gmail.com', NULL, 'user', '231062', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:30:54', '2025-01-19 22:30:54'),
(967, 10, 'eshanokpe@gmail.com', NULL, 'user', '788415', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:31:59', '2025-01-19 22:31:59'),
(968, 10, 'eshanokpe@gmail.com', NULL, 'user', '431695', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:32:09', '2025-01-19 22:32:09'),
(969, 10, 'eshanokpe@gmail.com', NULL, 'user', '023285', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:32:15', '2025-01-19 22:32:15'),
(970, 10, 'eshanokpe@gmail.com', NULL, 'user', '889065', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:33:13', '2025-01-19 22:33:13'),
(971, 10, 'eshanokpe@gmail.com', NULL, 'user', '665978', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:33:26', '2025-01-19 22:33:26'),
(972, 10, 'eshanokpe@gmail.com', NULL, 'user', '874980', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:35:29', '2025-01-19 22:35:29'),
(973, 10, 'eshanokpe@gmail.com', NULL, 'user', '558194', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:37:08', '2025-01-19 22:37:08'),
(974, 10, 'eshanokpe@gmail.com', NULL, 'user', '330939', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:38:57', '2025-01-19 22:38:57'),
(975, 10, 'eshanokpe@gmail.com', NULL, 'user', '326531', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:39:12', '2025-01-19 22:39:12'),
(976, 10, 'eshanokpe@gmail.com', NULL, 'user', '754757', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:39:45', '2025-01-19 22:39:45'),
(977, 10, 'eshanokpe@gmail.com', NULL, 'user', '422709', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:40:31', '2025-01-19 22:40:31'),
(978, 10, 'eshanokpe@gmail.com', NULL, 'user', '060580', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:41:58', '2025-01-19 22:41:58'),
(979, 10, 'eshanokpe@gmail.com', NULL, 'user', '194823', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:42:49', '2025-01-19 22:42:49'),
(980, 10, 'eshanokpe@gmail.com', NULL, 'user', '027191', 'PROVPR261547', 'Vehicle Paper Renewal', '12100', '1', 12100.00, '2025-01-19 22:44:09', '2025-01-19 22:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `other_permits`
--

CREATE TABLE `other_permits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `permittype` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mothermaidenname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nin` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `maritalstatus` varchar(255) DEFAULT NULL,
  `localgovernment` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `localgovtplaceofbirth` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `bloodgroup` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `nextofkinname` varchar(255) DEFAULT NULL,
  `nextofkinphonenumber` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `meansofID` varchar(255) DEFAULT NULL,
  `proofofownership` varchar(255) DEFAULT NULL,
  `nameofvehicledocuments` varchar(255) DEFAULT NULL,
  `vehicle_make` varchar(255) DEFAULT NULL,
  `vehicle_model` varchar(255) DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `pictureoftheVehicleLicense` varchar(255) DEFAULT NULL,
  `affidavit` varchar(255) DEFAULT NULL,
  `policereport` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `lengthofyears` int(11) DEFAULT NULL,
  `nameondriver` varchar(255) DEFAULT NULL,
  `driverlicensenumber` varchar(255) DEFAULT NULL,
  `nextofkin` varchar(255) DEFAULT NULL,
  `nextofkinphone_no` varchar(255) DEFAULT NULL,
  `classoflicense` varchar(255) DEFAULT NULL,
  `reasonfor` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_permits`
--

INSERT INTO `other_permits` (`id`, `user_id`, `user_email`, `userType`, `process_id`, `process_type`, `permittype`, `amount`, `firstname`, `middlename`, `lastname`, `mothermaidenname`, `email`, `nin`, `gender`, `dateofbirth`, `maritalstatus`, `localgovernment`, `state`, `localgovtplaceofbirth`, `phonenumber`, `bloodgroup`, `height`, `nextofkinname`, `nextofkinphonenumber`, `address`, `passport`, `meansofID`, `proofofownership`, `nameofvehicledocuments`, `vehicle_make`, `vehicle_model`, `reg_number`, `pictureoftheVehicleLicense`, `affidavit`, `policereport`, `purpose`, `lengthofyears`, `nameondriver`, `driverlicensenumber`, `nextofkin`, `nextofkinphone_no`, `classoflicense`, `reasonfor`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', 'user', 'PROOP232319', 'Other Permit', '1', 10500, 'Dolores voluptatem', 'Aliquam praesentium', 'Laboriosam laborum', 'Married', 'Provident commodi c', NULL, 'Male', '1971-03-26', NULL, 'Quis reprehenderit i', 'Abia', 'Velit sunt quisqua', 'Labore labore odit e', 'B', 'Sint excepteur volup', 'Nora Mcfadden', '+1 (299) 774-2859', 'Provident commodi c', 'otherPermit1726775497_Perspective.jpg', 'otherPermit1726775497_Perspective.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-19 18:51:37', '2024-09-19 18:51:37'),
(2, 5, 'eshanokpe@gmail.com', 'user', 'PROOP942830', 'Other Permit', '1', 10500, 'Non dolorem sed dolo', 'Distinctio Enim mol', 'Ipsum beatae enim iu', 'Married', 'Sit exercitation sed', NULL, 'Male', '2018-05-01', NULL, 'Ipsum velit eaque co', 'Abia', 'Sunt voluptatem ull', 'Nostrum mollit ipsum', 'B', 'Suscipit eum delectu', 'Hedwig Parrish', '+1 (776) 457-3921', 'Sit exercitation sed', 'otherPermitPerspective.jpg', 'otherPermitPerspective.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-19 19:01:14', '2024-09-19 19:01:14'),
(3, 5, 'eshanokpe@gmail.com', 'user', 'PROOP584364', 'Other Permit', '2', 15000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit', 'otherPermitPerspective.jpg', NULL, 'Ut est non praesent', 'Reiciendis dolore mi', 'Veniam qui et do co', 'Et omnis possimus a', 'other/PermitIMG-20240626-WA0012.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-19 20:09:18', '2024-09-19 20:09:18'),
(4, 5, 'eshanokpe@gmail.com', 'user', 'PROOP249872', 'Other Permit', '3', 25000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit', 'otherPermitPerspective.jpg', NULL, 'Deserunt quo esse e', 'Dolores ut dolorum a', 'At quia ullam aut si', 'Iste incidunt facer', 'otherPermit/IMG-20240626-WA0012.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-22 08:22:49', '2024-09-22 08:22:49'),
(5, 5, 'eshanokpe@gmail.com', 'user', 'PROOP450722', 'Other Permit', '4', 20000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit', 'otherPermitPerspective.jpg', NULL, 'Id rerum nisi occaec', 'Nisi aut esse volup', 'Incididunt commodi e', 'Cum adipisci earum p', 'otherPermitIMG-20240626-WA0012.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-22 08:28:44', '2024-09-22 08:28:44'),
(6, 5, 'eshanokpe@gmail.com', 'user', 'PROOP539693', 'Other Permit', '5', 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit', 'otherPermitIMG-20240626-WA0012.jpg', NULL, 'Et ratione autem fug', 'Ad nihil voluptas la', 'Quia placeat consec', 'Ea sed qui laborum', 'otherPermitPerspective.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-22 08:32:35', '2024-09-22 08:32:35'),
(7, 5, 'eshanokpe@gmail.com', 'user', 'PROOP494375', 'Other Permit', '6', 33500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', NULL, 'Sint et ut expedita', 'Aut sed eum totam ve', 'Qui deserunt velit e', 'Et culpa voluptatem', 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-22 08:55:16', '2024-09-22 08:55:16'),
(8, 5, 'eshanokpe@gmail.com', 'user', 'PROOP875560', 'Other Permit', '6', 33500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit/IMG-20240626-WA0012.jpg', 'otherPermit/IMG-20240626-WA0012.jpg', NULL, 'Enim aperiam ea temp', 'Facilis eveniet lor', 'Elit quo aliquam in', 'Quis sed ipsam repre', 'otherPermit/SILVERCEST 2 500 pp copy.jpg', 'otherPermit/Perspective.jpg', 'otherPermit/rabmot22.PNG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-22 09:24:29', '2024-09-22 09:24:29'),
(9, 5, 'eshanokpe@gmail.com', 'user', 'PROOP118337', 'Other Permit', '7', 10000, 'Aut voluptates vitae', NULL, 'Nemo vel mollit corp', NULL, NULL, NULL, 'Female', NULL, 'Married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', 'otherPermit/', 'Pariatur Et sit po', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-26 10:53:49', '2024-09-26 10:53:49'),
(10, 5, 'eshanokpe@gmail.com', 'user', 'PROOP272487', 'Other Permit', '11', 10000, 'Repudiandae cillum p', NULL, 'Vel aut blanditiis m', NULL, 'Doloremque quia blan', '480998877653', NULL, NULL, NULL, NULL, NULL, NULL, 'Reprehenderit earum', NULL, NULL, NULL, NULL, 'Doloremque quia blan', 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, 'otherPermit/trending5.jpg', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 08:37:52', '2024-10-01 08:37:52'),
(11, 5, 'eshanokpe@gmail.com', 'user', 'PROOP158842', 'Other Permit', '11', 10000, 'Eshanokpe', NULL, 'Daniel', NULL, 'eshanokpe@gmail.com', '419419419', NULL, NULL, NULL, NULL, NULL, NULL, '08139267960', NULL, NULL, NULL, NULL, 'eshanokpe@gmail.com', 'otherPermit/', 'otherPermit/', 'otherPermit/trending2.jpg', NULL, NULL, NULL, NULL, 'otherPermit/trending1.jpg', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 08:44:55', '2024-10-01 08:44:55'),
(12, 5, 'eshanokpe@gmail.com', 'user', 'PROOP590485', 'Other Permit', '10', 15000, 'Iure dicta non in mo', NULL, 'Aliqua Vel qui quid', NULL, 'pufe@mailinator.com', '56', NULL, NULL, NULL, NULL, NULL, NULL, '92', NULL, NULL, NULL, NULL, 'pufe@mailinator.com', 'otherPermit/', 'otherPermit/', 'otherPermit/trending13.jpg', NULL, NULL, NULL, NULL, 'otherPermit/trending12.jpg', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 08:53:13', '2024-10-01 08:53:13'),
(13, 5, 'eshanokpe@gmail.com', 'user', 'PROOP264364', 'Other Permit', '9', 10000, 'Neque quia exercitat', 'Voluptatem cupidatat', 'Reprehenderit in ap', 'Ullamco minus nulla', 'bumudiwijy@mailinator.com', NULL, 'Female', '1979-06-09', 'Single', 'Sapiente aperiam eni', 'Abia', '2023-12-09', '88', NULL, '57', 'Bianca Jefferson', '413', 'bumudiwijy@mailinator.com', 'otherPermit/trending6.jpg', 'otherPermit/trending1.jpg', 'otherPermit/', NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 09:01:57', '2024-10-01 09:01:57'),
(14, 5, 'eshanokpe@gmail.com', 'user', 'PROOP367022', 'Other Permit', '8', 40200, NULL, NULL, 'Eshanokpe Daniel', NULL, NULL, NULL, NULL, '2024-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Eshanokpe Daniel', '08139267960', NULL, 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, 'otherPermit/trending1.jpg', 'otherPermit/trending2.jpg', 'otherPermit/trending3.jpg', NULL, 5, NULL, NULL, NULL, NULL, 'A', NULL, '2024-10-01 09:14:20', '2024-10-01 09:14:20'),
(15, 3, 'agent@gmail.com', 'agent', 'PROOP942298', 'Other Permit', '1', 10500, 'Dolor ut accusamus n', 'Officiis eligendi qu', 'Dolor tempor accusan', 'Eligendi est aute vo', 'Pariatur Modi et qu', NULL, 'Male', '1978-09-24', 'Single', 'Voluptas id sapiente', 'Abia', 'Quos facilis eum con', 'Ipsa id voluptatum', NULL, 'Sint modi in cillum', 'Selma Raymond', '+1 (222) 939-4418', 'Pariatur Modi et qu', 'otherPermit/01.jpg', 'otherPermit/02.jpg', 'otherPermit/', NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-27 19:58:02', '2024-10-27 19:58:02'),
(16, 5, 'eshanokpe@gmail.com', 'user', 'PROOP527264', 'Other Permit', '1', 10500, 'Provident vel tempo', 'Officia quo ipsa su', 'Numquam quia magni n', 'Dolores magnam archi', 'Et ut quae sed lauda', NULL, 'Male', '2013-01-22', 'Single', 'Ad dicta ut cupidata', 'Adamawa', 'Ipsum proident cons', 'Pariatur Rem anim r', NULL, 'Ab eligendi maiores', 'Kenyon Workman', '+1 (594) 966-8396', 'Et ut quae sed lauda', 'otherPermit/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 'otherPermit/22WhatsApp Image 2024-10-08 at 13.19.18.jpeg', 'otherPermit/', NULL, NULL, NULL, NULL, 'otherPermit/', 'otherPermit/', 'otherPermit/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-27 18:31:40', '2024-11-27 18:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `other_permit_prices`
--

CREATE TABLE `other_permit_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permit_type_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_permit_prices`
--

INSERT INTO `other_permit_prices` (`id`, `permit_type_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 10500.00, '2024-06-17 01:25:38', '2024-06-17 01:25:38'),
(2, 2, 15000.00, '2024-08-23 09:51:07', '2024-08-23 13:51:07'),
(3, 3, 25000.00, '2024-06-17 02:09:31', '2024-06-17 02:09:31'),
(4, 4, 20000.00, '2024-06-17 02:09:50', '2024-06-17 02:09:50'),
(5, 5, 10000.00, '2024-06-17 02:10:03', '2024-06-17 02:10:03'),
(6, 6, 33500.00, '2024-06-17 02:10:16', '2024-06-17 02:10:16'),
(7, 7, 10000.00, '2024-06-17 02:10:29', '2024-06-17 02:10:29'),
(8, 8, 40200.00, '2024-08-23 09:51:51', '2024-08-23 13:51:51'),
(9, 9, 10000.00, '2024-06-19 17:07:36', '2024-06-17 02:11:13'),
(10, 10, 15000.00, '2024-08-23 09:52:11', '2024-08-23 13:52:11'),
(11, 11, 10000.00, '2024-08-23 09:52:33', '2024-08-23 13:52:33'),
(12, 12, 1200.00, '2024-10-08 13:47:33', '2024-10-08 13:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `other_permit_types`
--

CREATE TABLE `other_permit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_permit_types`
--

INSERT INTO `other_permit_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Rider\'s Card (Motorcycle)', '2024-06-17 01:04:30', '2024-06-17 01:04:30'),
(2, 'Local Govt. Permit (Motorcycle)', '2024-06-17 01:12:50', '2024-06-17 01:12:50'),
(3, 'Local Govt. Permit (Cars/Buses/Trucks)', '2024-06-17 01:13:14', '2024-06-17 01:13:14'),
(4, 'JTB Emblem -  (Motorcycle/Cars/Buses/Trucks)', '2024-06-17 01:13:47', '2024-06-17 01:13:47'),
(5, 'Mid-Year Permit  (Cars/Buses/Trucks)', '2024-06-17 01:14:18', '2024-06-17 01:14:18'),
(6, 'License Plates Number Reprint / Replacement', '2024-06-17 01:14:49', '2024-06-17 01:14:49'),
(7, 'Affidavits and Police Report', '2024-06-17 01:15:07', '2024-06-17 01:15:07'),
(8, 'Driver\'s License Re-Issue', '2024-06-17 01:15:31', '2024-06-17 01:15:31'),
(9, 'Learner\'s Permit', '2024-06-17 01:15:49', '2024-06-17 01:15:49'),
(10, 'Tinted Permit', '2024-06-17 01:16:04', '2024-06-17 01:16:04'),
(11, 'CMRIS', '2024-06-17 01:16:17', '2024-06-17 01:16:17'),
(12, 'Checking', '2024-10-08 13:43:46', '2024-10-08 13:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_models`
--

CREATE TABLE `payment_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `paymentReference` varchar(255) DEFAULT NULL,
  `owner_id` int(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `lagos_address` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delivery_option` text DEFAULT NULL,
  `scan_email` text DEFAULT NULL,
  `orderNo` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_models`
--

INSERT INTO `payment_models` (`id`, `process_id`, `process_type`, `paymentReference`, `owner_id`, `userType`, `full_name`, `email`, `location`, `lagos_address`, `address`, `delivery_option`, `scan_email`, `orderNo`, `amount`, `trans_id`, `status`, `created_at`, `updated_at`) VALUES
(18, 'PRONVR179573', 'Vehicle Registration', '507D7F09A211', NULL, NULL, 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', 'Lagos', NULL, NULL, 'Pick Up from nearest location', 'eshanokpe@gmail.com', 933046, 85814.00, NULL, '0', '2024-12-05 19:01:24', '2024-12-05 19:01:24'),
(19, 'PRONVR179573', 'Vehicle Registration', 'A0C3EBDA92E6', NULL, NULL, 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', 'Lagos', 'Isheri Oshun Branch Address: Rilexgroups, Lilian Almaroof St, Ijegun, Ikotun/Ijegun 102213, Lagos, Nigeria.', NULL, 'Pick Up from nearest location', NULL, 612990, 85814.00, NULL, '0', '2024-12-05 19:27:53', '2024-12-05 19:27:53'),
(20, 'PRONVR880044', 'Vehicle Registration', 'EAEBB5794A13', NULL, NULL, 'Ryan Fletcherrmm', 'eshanokpe@gmail.com', NULL, NULL, NULL, 'Scan and Send to Mail', 'eshanokpe@gmail.com', 533960, 3004.56, NULL, '0', '2024-12-28 03:46:15', '2024-12-28 03:46:15'),
(21, 'PROVPR261547', 'Vehicle Paper Renewal', '0D449DA0CDEB', NULL, NULL, 'Garrison Pace', 'eshanokpe@gmail.com', NULL, NULL, NULL, 'Scan and Send to Mail', 'eshanokpe@gmail.com', 27191, 12747.00, NULL, '0', '2025-01-19 22:44:26', '2025-01-19 22:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process_histories`
--

CREATE TABLE `process_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_number` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `process_DLR_lengthofyears` int(11) DEFAULT NULL,
  `process_NDL_lengthofyear` int(11) DEFAULT NULL,
  `process_CO_vc` varchar(255) DEFAULT NULL,
  `process_CO_vl` varchar(255) DEFAULT NULL,
  `process_VR_name` varchar(255) DEFAULT NULL,
  `process_VR_vehicleregistrationType` varchar(255) DEFAULT NULL,
  `process_VR_numberplate` varchar(255) DEFAULT NULL,
  `process_VR_preferrednumber` varchar(255) DEFAULT NULL,
  `process_VPR_vehicleType` varchar(255) DEFAULT NULL,
  `process_VPR_vehicleLicense` varchar(255) DEFAULT NULL,
  `process_VPR_roadWorthiness` double(10,2) DEFAULT NULL,
  `process_VPR_thirdPartyInsurance` double(10,2) DEFAULT NULL,
  `process_VPR_vehicleInspectionPickanddrop` double(10,2) DEFAULT NULL,
  `process_VPR_hackneyPermit` double(10,2) DEFAULT NULL,
  `process_DPN_processtype` varchar(255) DEFAULT NULL,
  `process_DPN_fullname` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `lagos_address` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delivery_option` text DEFAULT NULL,
  `scan_email` text DEFAULT NULL,
  `totalamount` double(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `start_datetime` timestamp NULL DEFAULT NULL,
  `end_datetime` timestamp NULL DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `times_used` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','expired','deactivated') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_percentage`, `start_datetime`, `end_datetime`, `usage_limit`, `times_used`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Y16NKNMV', 20, '2024-12-28 03:16:00', '2024-12-29 03:16:00', 10, 0, 'active', '2024-12-28 02:16:26', '2024-12-28 02:54:11'),
(2, '5R0KN6CY', 96, '2024-12-28 01:06:00', '2024-12-29 08:10:00', 32, 9, 'active', '2024-12-28 02:18:52', '2024-12-28 09:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `referral_logs`
--

CREATE TABLE `referral_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED NOT NULL,
  `referred_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referral_code` text DEFAULT NULL,
  `referred_at` timestamp NULL DEFAULT NULL,
  `rewarded` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_logs`
--

INSERT INTO `referral_logs` (`id`, `referrer_id`, `referred_id`, `referral_code`, `referred_at`, `rewarded`, `created_at`, `updated_at`) VALUES
(1, 10, 13, 'Rabmot53QDTW', '2024-12-31 16:40:45', 0, '2024-12-31 16:40:45', '2024-12-31 16:40:45'),
(2, 10, 14, 'Rabmot53QDTW', '2025-01-15 22:27:57', 0, '2025-01-15 22:27:57', '2025-01-15 22:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('u17vfL0jD5adNfaRoj1Vzet6VhdUiYt8oE6fV1fq', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkNXbU9BSkppVzVlTkkyV3lOS3FvNGc5eTNJb0F6OUppS3NwclBSVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcmljaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1725746313),
('y3GYUtgAlzfr17k8swyZwH8A5TmER1T6R8ABbQpd', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVW0ySWVadUpoOXZtOEExWFJwV2QwQXFKVjlleHo2bndobTY2dXZOdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAzL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMyI7fX0=', 1725743995);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) NOT NULL,
  `instance` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lagos', NULL, NULL),
(2, 'Abuja', NULL, NULL),
(3, 'Abia', NULL, NULL),
(4, 'Port Harcourt', NULL, NULL),
(5, 'Ogun', NULL, NULL),
(6, 'Ibadan', NULL, NULL),
(10, 'Lagoss', '2024-10-18 17:05:08', '2024-10-18 17:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `assigned_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_pics` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic_id`, `title`, `content`, `author`, `author_pics`, `created_at`, `updated_at`) VALUES
(1, 'com123', 'Expiration of my document(s)?', 'Is there a grace period after the expiration of my document(s)?\r\n                                                            ', 'admin', 'assets/img/profile_img/user.png', '2023-07-06 14:36:43', '2023-07-04 18:18:54'),
(2, 'com124', 'Driver\'s licenses validity.', 'Are driver\'s licenses issued from other states valid in Lagos State?\r\n', 'admin', 'assets/img/profile_img/user.png', '2023-07-06 14:36:50', '2023-07-04 20:48:29'),
(6, 'TOPIC8ywa', 'IMPORTANT DOCUMENTS', 'What are the most important documents, that I should go out with often?', 'muili ridwan olanrewaju', 'muiliridwanolanrewaju@gmail.com', '2023-08-04 02:28:45', '2023-08-04 03:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT '3',
  `email_token` varchar(60) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `status` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `know_us` varchar(255) DEFAULT NULL,
  `referred_by` bigint(20) UNSIGNED DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `referrer_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `referralsCount` int(11) NOT NULL DEFAULT 0,
  `referral_count` int(11) NOT NULL DEFAULT 0,
  `transaction_pin` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `state`, `role`, `email_token`, `verified`, `address`, `profile_image`, `gender`, `status_id`, `status`, `password`, `know_us`, `referred_by`, `referral_code`, `referrer_count`, `referralsCount`, `referral_count`, `transaction_pin`, `created_at`, `updated_at`, `remember_token`) VALUES
(2, 'Cassidy Mejia', 'puzebaha@mailinator.com', '+1 (279) 283-6875', NULL, '3', 'ced6067cfdc2ac456bc4f8195365b4ec6d7272b4bb5a84e82a0cdf27279e', 0, NULL, NULL, NULL, 1, NULL, '$2y$12$jgS5BBAFd87I5ThSPjJunOwv5EORwUokbIkhmruYMx135EuhbtQ/W', NULL, NULL, NULL, 0, 0, 0, NULL, '2024-09-08 14:37:15', '2024-09-08 14:37:15', NULL),
(3, 'Dana Zimmerman', 'mydamusepo@mailinator.com', '+1 (136) 398-6468', NULL, '3', '0209c5b80dadb14a565153a6d2f725082bb16d0b259b4b60df4570c7d003', 0, NULL, NULL, NULL, 1, NULL, '$2y$12$ShgnrcCzWFNnKAs0eB0ek.l9t9YoiTJsP4yeQq9HzIqRgXH1OCQRG', NULL, NULL, NULL, 0, 0, 0, NULL, '2024-09-08 14:54:04', '2024-09-08 14:54:04', NULL),
(4, 'Lamar Nguyen', 'jirejypyke@mailinator.com', '+1 (401) 986-4976', NULL, '3', '2f109f210ce8f65de9bf139b25ed69191b6055d3261822dcf35e2f87738e', 0, NULL, NULL, NULL, 1, NULL, '$2y$12$Tk16FUOGlM/DvzAe6tNMTOpr.kLkyWkIGY5ENRcKzYVznqxg8WKUS', NULL, NULL, NULL, 0, 0, 0, NULL, '2024-09-08 14:57:20', '2024-09-08 14:57:20', NULL),
(6, 'Ivy Riggs', 'heqylyliz@mailinator.com', '+1 (208) 273-3894', NULL, '3', '1610a08971acf35ce6f82c5241b0b49fbcdfd4bcdb14fbbfd9afe4f6c931', 0, NULL, NULL, NULL, 1, 'disable', '$2y$12$UpeGJWVK/MNC1dwCM2EYdu/UOjcE1.SDsRerjB4gEHnfMQFt.fP7W', NULL, NULL, NULL, 0, 0, 0, NULL, '2024-09-18 11:02:47', '2024-10-10 10:56:16', NULL),
(10, 'Garrison Pace', 'eshanokpe@gmail.com', '+1 (809) 167-8722', NULL, '3', '7c749ce63985473dad5bfeee212264aea5aea75b10825a80e22b4dd1cc22', 1, NULL, NULL, NULL, 1, 'active', '$2y$10$daGVpSLJP9j47DOKLhHg.eopQXFrvjzaGoG.u/3/PSjjyvEAjyMPy', NULL, NULL, 'Rabmot53QDTW', 4, 0, 0, NULL, '2024-12-31 13:35:37', '2025-01-15 22:27:56', '3f9BETjjyKiBOIqZ1g5NDyhQMYDN9XryGGT7dNFM7OO43q5g3ftBj7fycm1W'),
(11, 'Sigourney Jacobs', 'xatutydalo@mailinator.com', '+1 (338) 802-3064', NULL, '3', '2289bbe02dabcb5a24fb02f92c29ee43088046ae0fd062156f94f75ed992', 0, NULL, NULL, NULL, 1, 'active', '$2y$10$vS3hAO7ZqJ0q/kU7ExD1Ge7/WAheJsyp8VqjD5LMwV1YytsDv1g2i', NULL, NULL, 'Rabmot63QDTW', 0, 0, 0, NULL, '2024-12-31 13:53:10', '2024-12-31 13:53:10', NULL),
(13, 'tedd', 'tes22@gmail.com', '+2348139267960', NULL, '3', '3b25c8426022d085936a291c630a44252f451331db678f2e427b8c42ed9b', 0, NULL, NULL, NULL, 1, 'active', '$2y$10$pXX.ZVm.U.39mqzIwXAgw.skZhx9O6Q4vl0zXdCrLTwabWwX3r3.i', NULL, NULL, 'Rabmot9LB2KG', 0, 0, 0, NULL, '2024-12-31 16:40:45', '2024-12-31 16:40:45', NULL),
(14, 'Testing', 'eshanokpetest@gmail.com', '+2348139267960', NULL, '3', 'fa55da0ef50f29544627e09068e9234cd6f94ac054cf2078693d26e4d82a', 1, NULL, NULL, NULL, 1, 'active', '$2y$10$93IDtvKQH3LVFgdMv2xzjeWnnRyn3YWWBSKF9qLbdgnU2ehj2Cd0G', NULL, NULL, 'Rabmot4WYSBS', 0, 0, 0, NULL, '2025-01-15 22:27:56', '2025-01-15 22:27:56', 'cnVlG1w9Bt6AfVAsRJ4Sxgt7ZumS3JtlhWbCuLR9maYPDdHFUFSvnhrZlF63');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `referral_user_id` varchar(255) DEFAULT NULL,
  `token_count` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `referral_user_id`, `token_count`, `created_at`, `updated_at`) VALUES
(1, '2', NULL, '0', '2024-09-08 14:37:15', '2024-09-08 14:37:15'),
(2, '3', NULL, '0', '2024-09-08 14:54:04', '2024-09-08 14:54:04'),
(3, '4', NULL, '0', '2024-09-08 14:57:20', '2024-09-08 14:57:20'),
(4, '5', NULL, '0', '2024-09-08 15:34:11', '2024-09-08 15:34:11'),
(5, '6', NULL, '0', '2024-09-18 11:02:47', '2024-09-18 11:02:47'),
(6, '7', NULL, '0', '2024-09-19 08:23:14', '2024-09-19 08:23:14'),
(7, '8', NULL, '0', '2024-09-19 10:07:08', '2024-09-19 10:07:08'),
(8, '9', NULL, '0', '2024-09-23 02:31:02', '2024-09-23 02:31:02'),
(9, '10', NULL, '0', '2024-12-31 13:35:37', '2024-12-31 13:35:37'),
(10, '11', NULL, '0', '2024-12-31 13:53:10', '2024-12-31 13:53:10'),
(11, '10', '10', '10', '2024-12-31 14:13:25', '2024-12-31 14:13:25'),
(12, '10', '12', '20', '2024-12-31 16:32:17', '2024-12-31 16:32:17'),
(13, '10', '13', '30', '2024-12-31 16:40:45', '2024-12-31 16:40:45'),
(14, '13', '10', '0', '2024-12-31 16:40:45', '2024-12-31 16:40:45'),
(15, '10', '14', '40', '2025-01-15 22:27:57', '2025-01-15 22:27:57'),
(16, '14', '10', '0', '2025-01-15 22:27:57', '2025-01-15 22:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_paper_renewals`
--

CREATE TABLE `vehicle_paper_renewals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` varchar(255) DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `vehicleCategory` varchar(255) DEFAULT NULL,
  `vehicleType` varchar(255) DEFAULT NULL,
  `vehicleLicense` varchar(255) DEFAULT NULL,
  `roadWorthiness` varchar(255) DEFAULT NULL,
  `thirdPartyInsurance` varchar(255) DEFAULT NULL,
  `proofOfOwnership` varchar(255) DEFAULT NULL,
  `hackneyPermit` varchar(255) DEFAULT NULL,
  `vehicleInspectionPickanddrop` varchar(255) DEFAULT NULL,
  `policeCMRIS` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `totalamount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_paper_renewals`
--

INSERT INTO `vehicle_paper_renewals` (`id`, `user_id`, `user_email`, `owner_id`, `userType`, `process_id`, `process_type`, `vehicleCategory`, `vehicleType`, `vehicleLicense`, `roadWorthiness`, `thirdPartyInsurance`, `proofOfOwnership`, `hackneyPermit`, `vehicleInspectionPickanddrop`, `policeCMRIS`, `payment_status`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR623007', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '7500', '0', '0', '0', '0', '10000', 'pending', 17500.00, '2024-09-15 14:27:13', '2024-09-15 14:27:13'),
(2, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR107056', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-09-15 14:54:46', '2024-09-15 14:54:46'),
(3, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR979329', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-09-15 14:58:59', '2024-09-15 14:58:59'),
(4, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR707044', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-09-15 14:59:05', '2024-09-15 14:59:05'),
(5, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR296703', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-09-15 14:59:21', '2024-09-15 14:59:21'),
(6, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR879461', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '0', '0', '2000', '0', '0', '10000', 'pending', 12000.00, '2024-09-15 15:00:41', '2024-09-15 15:00:41'),
(7, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR266507', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '0', '15000', '0', '0', '20000', '0', 'pending', 35000.00, '2024-09-15 15:03:00', '2024-09-15 15:03:00'),
(8, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR147797', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '11200', '0', '0', '2000', '0', '0', '10000', 'pending', 23200.00, '2024-09-15 16:44:14', '2024-09-15 16:44:14'),
(9, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR653234', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '0', '15000', '0', '0', '20000', '0', 'pending', 35000.00, '2024-09-16 10:01:59', '2024-09-16 10:01:59'),
(10, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR846147', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '9200', '0', '0', '0', '0', '0', '10000', 'pending', 19200.00, '2024-09-22 07:38:57', '2024-09-22 07:38:57'),
(11, 5, 'eshanokpe@gmail.com', '', 'user', 'PROVPR746237', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '5600', '0', '0', '0', '0', '0', '10000', 'pending', 15600.00, '2024-09-23 03:08:00', '2024-09-23 03:08:00'),
(12, 3, 'agent@gmail.com', '', 'user', 'PROVPR791210', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '10000', 'pending', 14600.00, '2024-10-26 12:27:32', '2024-10-26 12:27:32'),
(13, 3, 'agent@gmail.com', '', 'user', 'PROVPR928314', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '5600', '0', '0', '0', '0', '0', '10000', 'pending', 15600.00, '2024-10-26 12:28:23', '2024-10-26 12:28:23'),
(14, 2, 'agent@gmail.com', '2', 'agent', 'PROVPR876605', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '7500', '0', '2000', '5000', '20000', '10000', 'pending', 49100.00, '2024-10-26 13:45:43', '2024-10-26 13:45:43'),
(15, 5, 'agent@gmail.com', '5', 'agent', 'PROVPR818750', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '0', 'pending', 4600.00, '2024-10-26 13:46:35', '2024-10-26 13:46:35'),
(16, 3, 'agent@gmail.com', '2', 'agent', 'PROVPR984017', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '0', '0', '0', '5000', '0', '0', 'pending', 5000.00, '2024-10-26 13:50:03', '2024-10-26 13:50:03'),
(17, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR195706', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '0', 'pending', 4600.00, '2024-10-31 18:13:28', '2024-10-31 18:13:28'),
(18, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR888786', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '10000', 'pending', 14600.00, '2024-11-14 02:40:34', '2024-11-14 02:40:34'),
(19, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR266387', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '0', '0', '5000', '20000', '10000', 'pending', 42500.00, '2024-11-27 18:23:46', '2024-11-27 18:23:46'),
(20, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR775415', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '0', 'pending', 4600.00, '2024-12-28 01:15:49', '2024-12-28 01:15:49'),
(21, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR610889', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '10000', 'pending', 14600.00, '2024-12-28 01:18:49', '2024-12-28 01:18:49'),
(22, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR191757', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '7500', '0', '0', '0', '0', '0', 'pending', 12100.00, '2024-12-28 01:25:03', '2024-12-28 01:25:03'),
(23, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR251427', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '7500', '0', '0', '0', '0', '0', 'pending', 12100.00, '2024-12-28 01:28:57', '2024-12-28 01:28:57'),
(24, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR538882', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '0', '15000', '2000', '0', '0', '0', 'pending', 17000.00, '2024-12-28 01:30:25', '2024-12-28 01:30:25'),
(25, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR790837', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '15000', '0', '0', '0', '0', 'pending', 19600.00, '2024-12-28 01:31:41', '2024-12-28 01:31:41'),
(26, 3, 'agent@gmail.com', '16', 'agent', 'PROVPR104233', 'Vehicle Paper Renewal', '3', 'COASTER BUS', '0', '0', '15000', '0', '0', '0', '10000', 'pending', 25000.00, '2024-12-28 01:32:02', '2024-12-28 01:32:02'),
(27, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR148684', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '0', '0', '0', '0', '0', 'pending', 7500.00, '2024-12-28 01:38:41', '2024-12-28 01:38:41'),
(28, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR463099', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '15000', '0', '0', '0', '0', 'pending', 19600.00, '2024-12-28 02:56:38', '2024-12-28 02:56:38'),
(29, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR597615', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '9000', '15000', '0', '0', '0', '0', 'pending', 24000.00, '2024-12-28 03:21:33', '2024-12-28 03:21:33'),
(30, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR406973', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-12-28 03:25:08', '2024-12-28 03:25:08'),
(31, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR607361', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-12-28 03:29:41', '2024-12-28 03:29:41'),
(32, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR805067', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '15000', '0', '0', '0', '0', 'pending', 22500.00, '2024-12-28 03:34:12', '2024-12-28 03:34:12'),
(33, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR761950', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '0', '7500', '0', '0', '0', '0', '10000', 'pending', 17500.00, '2024-12-28 03:39:13', '2024-12-28 03:39:13'),
(34, 3, 'agent@gmail.com', '15', 'agent', 'PROVPR671722', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '0', '0', '0', '0', '0', '0', 'pending', 4600.00, '2024-12-28 09:25:44', '2024-12-28 09:25:44'),
(35, 10, 'eshanokpe@gmail.com', NULL, 'user', 'PROVPR261547', 'Vehicle Paper Renewal', '1', 'SALOON CAR', '4600', '7500', '0', '0', '0', '0', '0', 'pending', 12100.00, '2025-01-19 22:26:18', '2025-01-19 22:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_registrations`
--

CREATE TABLE `vehicle_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `owner_id` int(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `process_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `process_type` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `registrationType` varchar(255) DEFAULT NULL,
  `plateNumberType` varchar(255) DEFAULT NULL,
  `preferredNumber` varchar(255) DEFAULT NULL,
  `hackneyPermit` int(11) DEFAULT NULL,
  `policeCMRIS` int(11) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `totalamount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_registrations`
--

INSERT INTO `vehicle_registrations` (`id`, `user_id`, `user_email`, `owner_id`, `userType`, `process_id`, `process_type`, `category`, `registrationType`, `plateNumberType`, `preferredNumber`, `hackneyPermit`, `policeCMRIS`, `payment_status`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR185543', 'Vehicle Registration', NULL, NULL, NULL, '13dc32e4U', 0, 5000, 'pending', 85200.00, '2024-09-16 09:27:57', '2024-09-16 09:27:57'),
(2, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR666888', 'Vehicle Registration', '3', '1', 'PCN', 'IWA@4U', 5000, 5000, 'pending', 90200.00, '2024-09-16 09:33:51', '2024-09-16 09:33:51'),
(8, 3, 'agent@gmail.com', 5, 'agent', 'PRONVR635319', 'Vehicle Registration', '1', '2', 'RPN', NULL, 0, 10000, 'pending', 75200.00, '2024-10-26 16:36:51', '2024-10-26 16:36:51'),
(9, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR246615', 'Vehicle Registration', '2', '1', 'RPN', NULL, 5000, 0, 'pending', 80200.00, '2024-11-03 11:32:02', '2024-11-03 11:32:02'),
(10, 3, 'agent@gmail.com', 10, 'agent', 'PRONVR231391', 'Vehicle Registration', '1', '1', 'PCN', NULL, 17, 61, 'pending', 139.00, '2024-11-14 03:23:31', '2024-11-14 03:23:31'),
(11, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR753542', 'Vehicle Registration', '2', '1', 'RPN', NULL, 5000, 0, 'pending', 80200.00, '2024-11-27 18:25:14', '2024-11-27 18:25:14'),
(12, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR840617', 'Vehicle Registration', '2', '2', 'RPN', NULL, 5000, 0, 'pending', 70200.00, '2024-11-27 18:25:55', '2024-11-27 18:25:55'),
(13, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR362669', 'Vehicle Registration', '2', '1', 'RPN', NULL, 5000, 0, 'pending', 80200.00, '2024-11-27 18:27:37', '2024-11-27 18:27:37'),
(14, 3, 'agent@gmail.com', 10, 'agent', 'PRONVR393211', 'Vehicle Registration', '1', '1', 'RPN', NULL, 48, 0, 'pending', 59.00, '2024-12-05 15:05:25', '2024-12-05 15:05:25'),
(15, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR741225', 'Vehicle Registration', '2', '1', 'RPN', NULL, 5000, 0, 'pending', 80200.00, '2024-12-05 15:46:12', '2024-12-05 15:46:12'),
(16, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR179573', 'Vehicle Registration', '2', '1', 'RPN', NULL, 5000, 0, 'pending', 80200.00, '2024-12-05 17:40:49', '2024-12-05 17:40:49'),
(17, 3, 'agent@gmail.com', 10, 'agent', 'PRONVR418050', 'Vehicle Registration', '1', '1', 'RPN', NULL, 0, 46, 'pending', 57.00, '2024-12-07 05:29:28', '2024-12-07 05:29:28'),
(18, 5, 'eshanokpe@gmail.com', NULL, 'user', 'PRONVR880044', 'Vehicle Registration', '2', '2', 'RPN', NULL, 5000, 0, 'pending', 70200.00, '2024-12-28 03:40:51', '2024-12-28 03:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_registration_prices`
--

CREATE TABLE `vehicle_registration_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` text DEFAULT NULL,
  `vehicle_type_id` text DEFAULT NULL,
  `random_private_vehicle_3rd_party_insurance` int(11) DEFAULT NULL,
  `customized_private_vehicle_3rd_party_insurance` int(11) DEFAULT NULL,
  `random_plate_private_vehicle_no_insurance` int(11) DEFAULT NULL,
  `customised_plate_private_vehicle_no_insurance` int(11) DEFAULT NULL,
  `random_commercial_plate_3rd_party_insurance` int(11) DEFAULT NULL,
  `customised_commercial_plate_3rd_party_insurance` int(11) DEFAULT NULL,
  `random_plate_no_commercial_vehicle_no_insurance` int(11) DEFAULT NULL,
  `customized_plate_no_commercial_vehicle_no_insurance` int(11) DEFAULT NULL,
  `random_plate_hackney_permit` int(11) DEFAULT NULL,
  `customized_plate_hackney_permit` int(11) DEFAULT NULL,
  `random_plate_police_cmris` int(11) DEFAULT NULL,
  `customised_plate_police_cmris` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_registration_prices`
--

INSERT INTO `vehicle_registration_prices` (`id`, `state_id`, `vehicle_type_id`, `random_private_vehicle_3rd_party_insurance`, `customized_private_vehicle_3rd_party_insurance`, `random_plate_private_vehicle_no_insurance`, `customised_plate_private_vehicle_no_insurance`, `random_commercial_plate_3rd_party_insurance`, `customised_commercial_plate_3rd_party_insurance`, `random_plate_no_commercial_vehicle_no_insurance`, `customized_plate_no_commercial_vehicle_no_insurance`, `random_plate_hackney_permit`, `customized_plate_hackney_permit`, `random_plate_police_cmris`, `customised_plate_police_cmris`, `created_at`, `updated_at`) VALUES
(13, '1', '2', 75200, 310000, 65200, 300000, 85200, 360000, 75200, 350000, 5000, 5000, 10000, 10000, '2024-08-21 03:39:17', '2024-08-21 07:39:17'),
(14, '2', '1', 105000, 370000, 95000, 360000, 120000, 390000, 110000, 380000, 6000, 6000, 10000, 10000, '2024-08-21 03:43:41', '2024-08-21 07:43:41'),
(15, '3', '1', 77300, 350000, 67300, 340000, 92300, 360000, 82300, 350000, 6000, 6000, 10000, 10000, '2024-08-21 03:52:49', '2024-08-21 07:52:49'),
(16, '4', '1', 82300, 350000, 72300, 340000, 92300, 370000, 82300, 360000, 6000, 6000, 10000, 10000, '2024-08-21 03:45:32', '2024-08-21 07:45:32'),
(17, '5', '1', 75500, 360000, 65500, 350000, 85500, 370000, 75500, 360000, 6000, 6000, 10000, 10000, '2024-08-21 03:54:03', '2024-08-21 07:54:03'),
(18, '6', '1', 75500, 360000, 65500, 350000, 85500, 380000, 75500, 370000, 6000, 6000, 10000, 10000, '2024-08-21 03:51:14', '2024-08-21 07:51:14'),
(19, '1', '3', 80200, 310000, 70200, 300000, 90200, 360000, 80200, 350000, 5000, 6000, 5000, 10000, '2024-05-21 03:58:59', '2024-05-21 07:58:59'),
(20, '2', '3', 110200, 370000, 100200, 360000, 130000, 400000, 120000, 390000, 6000, 6000, 10000, 10000, '2024-08-21 03:41:51', '2024-08-21 07:41:51'),
(21, '3', '3', 87300, 310000, 77300, 300000, 97300, 360000, 87300, 350000, 6000, 6000, 6000, 10000, '2024-05-21 13:14:52', '2024-05-21 17:14:52'),
(22, '4', '3', 88500, 370000, 78500, 360000, 98500, 380000, 88500, 370000, 6000, 6000, 10000, 10000, '2024-08-21 03:48:06', '2024-08-21 07:48:06'),
(23, '5', '3', 85500, 310000, 75500, 300000, 95500, 360000, 85500, 350000, 6000, 6000, 10000, 10000, '2024-05-21 09:46:50', '2024-05-21 09:46:50'),
(24, '6', '3', 85500, 310000, 75500, 300000, 95500, 360000, 85500, 350000, 6000, 6000, 10000, 10000, '2024-05-21 09:48:05', '2024-05-21 09:48:05'),
(26, '1', '1', 11, 61, 71, 90, 55, 57, 32, 94, 48, 17, 46, 61, '2024-10-08 10:56:30', '2024-10-08 10:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_registration_types`
--

CREATE TABLE `vehicle_registration_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_registration_types`
--

INSERT INTO `vehicle_registration_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Private Vehicle With 3rd/P insurance', '2023-07-29 11:40:09', NULL),
(2, 'Private Vehicle With No insurance', '2023-07-29 11:40:09', NULL),
(3, 'Commercial Vehicle With 3rd/P insurance', '2023-07-29 11:40:09', NULL),
(4, 'Commercial Vehicle No insurance', '2023-07-29 11:40:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_renewal_prices`
--

CREATE TABLE `vehicle_renewal_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicleType_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `vehicle_license` double(10,2) NOT NULL,
  `road_worthiness` double(10,2) NOT NULL,
  `third_party_insurance` double(10,2) NOT NULL,
  `proof_of_ownership` double(10,2) NOT NULL,
  `hackney_permit` double(10,2) NOT NULL,
  `vehicle_inspection_pickanddrop` double(10,2) NOT NULL,
  `police_cmris` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_renewal_prices`
--

INSERT INTO `vehicle_renewal_prices` (`id`, `vehicleType_id`, `state_id`, `vehicle_license`, `road_worthiness`, `third_party_insurance`, `proof_of_ownership`, `hackney_permit`, `vehicle_inspection_pickanddrop`, `police_cmris`, `created_at`, `updated_at`) VALUES
(16, 1, 1, 4600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-18 17:10:49', '2024-08-21 07:28:08'),
(17, 3, 2, 6500.00, 9000.00, 15000.00, 0.00, 6000.00, 0.00, 10000.00, '2024-05-18 17:11:38', '2024-08-21 07:31:47'),
(18, 1, 3, 4600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-18 17:12:41', '2024-08-21 07:35:49'),
(19, 1, 5, 4600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-18 17:13:43', '2024-08-21 07:36:12'),
(20, 1, 6, 4600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-18 17:14:42', '2024-08-21 07:36:29'),
(21, 1, 4, 4600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-18 18:06:50', '2024-08-21 07:36:48'),
(22, 3, 1, 5600.00, 7500.00, 15000.00, 2000.00, 5000.00, 20000.00, 10000.00, '2024-05-20 13:32:29', '2024-08-21 07:33:51'),
(24, 1, 2, 5600.00, 9000.00, 15000.00, 0.00, 5000.00, 0.00, 10000.00, '2024-05-21 07:33:27', '2024-08-21 07:34:22'),
(25, 3, 3, 5600.00, 7500.00, 15000.00, 2000.00, 5000.00, 0.00, 10000.00, '2024-05-21 07:34:11', '2024-05-21 07:36:57'),
(26, 3, 4, 5600.00, 7500.00, 15000.00, 2000.00, 5000.00, 0.00, 10000.00, '2024-05-21 07:34:51', '2024-05-21 07:34:51'),
(27, 3, 5, 5600.00, 7500.00, 15000.00, 2000.00, 5000.00, 0.00, 10000.00, '2024-05-21 07:35:20', '2024-05-21 07:35:20'),
(28, 3, 6, 5600.00, 7500.00, 15000.00, 2000.00, 5000.00, 0.00, 10000.00, '2024-05-21 07:36:15', '2024-05-21 07:36:15'),
(29, 6, 1, 8200.00, 15000.00, 100000.00, 2000.00, 8200.00, 25000.00, 10000.00, '2024-08-22 17:44:21', '2024-08-22 17:44:21'),
(30, 7, 2, 8200.00, 15000.00, 100000.00, 2000.00, 8200.00, 25000.00, 10000.00, '2024-08-22 17:44:53', '2024-08-22 17:44:53'),
(31, 7, 3, 8200.00, 15000.00, 100000.00, 2000.00, 8200.00, 25000.00, 10000.00, '2024-08-22 17:45:16', '2024-08-22 17:45:16'),
(32, 7, 4, 8200.00, 15000.00, 100000.00, 2000.00, 8200.00, 25000.00, 10000.00, '2024-08-22 17:45:44', '2024-08-22 17:45:44'),
(33, 7, 5, 8200.00, 15000.00, 100000.00, 2000.00, 8200.00, 25000.00, 10000.00, '2024-08-22 17:46:10', '2024-08-22 17:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SALOON CAR', NULL, NULL),
(2, 'SUV | Jeep | Bus | Pick-Up | Crossover', NULL, NULL),
(3, 'COASTER BUS', NULL, NULL),
(4, 'TRUCK: (15 tons)', NULL, NULL),
(5, 'TRUCK: (20 tons)', NULL, NULL),
(6, 'TRUCK: (30 tons)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `user_email`, `userType`, `amount`, `bank`, `account_number`, `account_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'cse@gmail.com', '2', '2000', 'bank', '123456', 'account_name', '2', '2024-10-20 00:57:03', '2024-10-20 00:17:13'),
(4, 10, 'eshanokpe@gmail.com', 'user', '200', NULL, NULL, NULL, '0', '2025-01-15 23:55:26', '2025-01-15 23:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_payments`
--

CREATE TABLE `wallet_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `process_id` varchar(255) NOT NULL,
  `process_number` varchar(255) NOT NULL,
  `process_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addvehiclerenewals`
--
ALTER TABLE `addvehiclerenewals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_vehicle_ownerships`
--
ALTER TABLE `add_vehicle_ownerships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_vehicle_registrations`
--
ALTER TABLE `add_vehicle_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_vehicle_registrations_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_username_unique` (`username`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `agent_password_models`
--
ALTER TABLE `agent_password_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `changeof_ownership_prices`
--
ALTER TABLE `changeof_ownership_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_of_ownerships`
--
ALTER TABLE `change_of_ownerships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_plate_number_prices`
--
ALTER TABLE `dealers_plate_number_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_plate_numbers`
--
ALTER TABLE `dealer_plate_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_license_renewals`
--
ALTER TABLE `driver_license_renewals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_license_renewal_prices`
--
ALTER TABLE `driver_license_renewal_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `f_a_qs`
--
ALTER TABLE `f_a_qs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_driver_licenses`
--
ALTER TABLE `international_driver_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_driver_license_prices`
--
ALTER TABLE `international_driver_license_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_driver_licenses`
--
ALTER TABLE `new_driver_licenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `new_driver_licenses_email_unique` (`email`);

--
-- Indexes for table `new_driver_license_prices`
--
ALTER TABLE `new_driver_license_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notificationsss_2`
--
ALTER TABLE `notificationsss_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_permits`
--
ALTER TABLE `other_permits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_permit_prices`
--
ALTER TABLE `other_permit_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_permit_types`
--
ALTER TABLE `other_permit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_models`
--
ALTER TABLE `payment_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `process_histories`
--
ALTER TABLE `process_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `process_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_codes_code_unique` (`code`);

--
-- Indexes for table `referral_logs`
--
ALTER TABLE `referral_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_logs_referrer_id_foreign` (`referrer_id`),
  ADD KEY `referral_logs_referred_id_foreign` (`referred_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_assigned_user_id_foreign` (`assigned_user_id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`),
  ADD KEY `tasks_updated_by_foreign` (`updated_by`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_paper_renewals`
--
ALTER TABLE `vehicle_paper_renewals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_registrations`
--
ALTER TABLE `vehicle_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_registration_prices`
--
ALTER TABLE `vehicle_registration_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_registration_types`
--
ALTER TABLE `vehicle_registration_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_renewal_prices`
--
ALTER TABLE `vehicle_renewal_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_payments`
--
ALTER TABLE `wallet_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_payments_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addvehiclerenewals`
--
ALTER TABLE `addvehiclerenewals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `add_vehicle_ownerships`
--
ALTER TABLE `add_vehicle_ownerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `add_vehicle_registrations`
--
ALTER TABLE `add_vehicle_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agent_password_models`
--
ALTER TABLE `agent_password_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `changeof_ownership_prices`
--
ALTER TABLE `changeof_ownership_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `change_of_ownerships`
--
ALTER TABLE `change_of_ownerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dealers_plate_number_prices`
--
ALTER TABLE `dealers_plate_number_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dealer_plate_numbers`
--
ALTER TABLE `dealer_plate_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver_license_renewals`
--
ALTER TABLE `driver_license_renewals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `driver_license_renewal_prices`
--
ALTER TABLE `driver_license_renewal_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_qs`
--
ALTER TABLE `f_a_qs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `international_driver_licenses`
--
ALTER TABLE `international_driver_licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `international_driver_license_prices`
--
ALTER TABLE `international_driver_license_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `new_driver_licenses`
--
ALTER TABLE `new_driver_licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `new_driver_license_prices`
--
ALTER TABLE `new_driver_license_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notificationsss_2`
--
ALTER TABLE `notificationsss_2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=981;

--
-- AUTO_INCREMENT for table `other_permits`
--
ALTER TABLE `other_permits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `other_permit_prices`
--
ALTER TABLE `other_permit_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `other_permit_types`
--
ALTER TABLE `other_permit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_models`
--
ALTER TABLE `payment_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_histories`
--
ALTER TABLE `process_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referral_logs`
--
ALTER TABLE `referral_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vehicle_paper_renewals`
--
ALTER TABLE `vehicle_paper_renewals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `vehicle_registrations`
--
ALTER TABLE `vehicle_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vehicle_registration_prices`
--
ALTER TABLE `vehicle_registration_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vehicle_registration_types`
--
ALTER TABLE `vehicle_registration_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_renewal_prices`
--
ALTER TABLE `vehicle_renewal_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet_payments`
--
ALTER TABLE `wallet_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_vehicle_registrations`
--
ALTER TABLE `add_vehicle_registrations`
  ADD CONSTRAINT `add_vehicle_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `process_histories`
--
ALTER TABLE `process_histories`
  ADD CONSTRAINT `process_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `referral_logs`
--
ALTER TABLE `referral_logs`
  ADD CONSTRAINT `referral_logs_referred_id_foreign` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `referral_logs_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_user_id_foreign` FOREIGN KEY (`assigned_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `tasks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_payments`
--
ALTER TABLE `wallet_payments`
  ADD CONSTRAINT `wallet_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2023 at 11:37 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vividtranstech_lims`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_demo`
--

CREATE TABLE `tbl_demo` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_demo`
--

INSERT INTO `tbl_demo` (`id`, `name`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(8, 'Test1', 1, 0, 0, '2023-04-18 13:43:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discipline_category`
--

CREATE TABLE `tbl_discipline_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_discipline_category`
--

INSERT INTO `tbl_discipline_category` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '2', NULL, 1, 0, NULL, '2023-05-11 13:11:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_detail`
--

CREATE TABLE `tbl_form_detail` (
  `id` int(11) NOT NULL,
  `is_formula` int(11) NOT NULL DEFAULT 0,
  `formheadid` int(11) DEFAULT NULL,
  `name` varchar(75) DEFAULT NULL,
  `label` varchar(75) DEFAULT NULL,
  `value` varchar(75) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `span` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `validators` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`validators`)),
  `rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rules`)),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_form_detail`
--

INSERT INTO `tbl_form_detail` (`id`, `is_formula`, `formheadid`, `name`, `label`, `value`, `type`, `span`, `is_active`, `validators`, `rules`, `is_deleted`) VALUES
(1, 0, 1, 'empty_dish_weight[]', NULL, '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true,\"maxLength\":75}', '[]', 0),
(2, 1, 1, 'sample_weight[]', 'Rank', '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true}', '[]', 0),
(3, 0, 1, 'od_time[]', 'Email', '', 'text', NULL, 1, '{\"required\":true,\"maxLength\":150}', '[]', 0),
(4, 0, 1, 'od_start[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(5, 0, 1, 'od_end[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(6, 1, 1, 'drying_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(7, 0, 1, 'calculation[]', NULL, NULL, NULL, 'rowspan=\"4\"', 1, NULL, NULL, 0),
(8, 0, 1, 'result[]', NULL, NULL, NULL, 'rowspan=\"4\"', 1, NULL, NULL, 0),
(9, 1, 2, 'empty_dish_weight[]', NULL, '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true,\"maxLength\":75}', '[]', 0),
(10, 1, 2, 'sample_weight[]', 'Rank', '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true}', '[]', 0),
(11, 0, 2, 'fa_time[]', 'Email', '', 'text', NULL, 1, '{\"required\":true,\"maxLength\":150}', '[]', 0),
(12, 0, 2, 'fa_start[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(13, 0, 2, 'fa_end[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(14, 1, 2, 'Ashing_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(15, 0, 2, 'calculation[]', NULL, NULL, NULL, 'rowspan=\"4\"', 1, NULL, NULL, 0),
(16, 0, 2, 'result[]', NULL, NULL, NULL, 'rowspan=\"4\"', 1, NULL, NULL, 0),
(17, 0, 3, 'empty_dish_weight[]', NULL, '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true,\"maxLength\":75}', '[]', 0),
(18, 0, 3, 'sample_weight[]', 'Rank', '', 'text', 'rowspan=\"4\"', 1, '{\"required\":true}', '[]', 0),
(19, 0, 3, 'oda_time[]', 'Email', '', 'text', NULL, 1, '{\"required\":true,\"maxLength\":150}', '[]', 0),
(20, 0, 3, 'oda_start[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(21, 0, 3, 'oda_end[]', 'Address', '', 'text', NULL, 1, '{\"maxLength\":1000}', '[]', 0),
(22, 0, 3, 'Ashing_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(23, 0, 3, 'calculation[]', NULL, NULL, NULL, 'rowspan=\"4\"', 1, NULL, NULL, 0),
(24, 0, 3, 'result[]', NULL, NULL, NULL, '', 1, NULL, NULL, 0),
(25, 0, 4, 'sample_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(26, 0, 4, 'empty_soxhlet[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(27, 0, 4, 'eod_time[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(28, 0, 4, 'eod_start[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(29, 0, 4, 'eod_end[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(30, 0, 4, 'final_soxhlet', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(31, 0, 4, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(32, 0, 4, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(33, 0, 5, 'sample_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(34, 0, 5, 'ashing_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(35, 0, 5, 'oda_time[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(36, 0, 5, 'oda_start[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(37, 0, 5, 'oda_end[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(38, 0, 5, 'crucible_ashing[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(39, 0, 5, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(40, 0, 5, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(41, 0, 6, 'sample_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(42, 0, 6, 'sb_time[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(43, 0, 6, 'sb_start[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(44, 0, 6, 'sb_end[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(45, 0, 6, 'titre_value[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(46, 0, 6, 'normality[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(47, 0, 6, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(48, 0, 6, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(49, 0, 7, 'sample_weight[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(50, 0, 7, 'dt_start[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(51, 0, 7, 'dt_end[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(52, 0, 7, 'acid_blank[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(53, 0, 7, 'alkali_blank[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(54, 0, 7, 'acid_test[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(55, 0, 7, 'alkali_test[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(56, 0, 7, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(57, 0, 7, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(58, 0, 8, 'moisture(A)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(59, 0, 8, 'total_protein(B)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(60, 0, 8, 'total_fat(C)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(61, 0, 8, 'total_ash(D)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(62, 0, 8, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(63, 0, 8, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(64, 0, 9, 'total_protein(P)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(65, 0, 9, 'total_fat(F)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(66, 0, 9, 'total_carbohydrate(C)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(67, 0, 9, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(68, 0, 9, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(69, 0, 10, 'sample_wt[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(70, 0, 10, 'mass_sample[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(71, 0, 10, 'conn_aflatoxin[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(72, 0, 10, 'volume_final(P)[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(73, 0, 10, 'flu_extract[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(74, 0, 10, 'flu_std[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(75, 0, 10, 'calculation[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(76, 0, 10, 'aflatoxin[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(77, 0, 11, 'incu_temp[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(78, 0, 11, 'it_start[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(79, 0, 11, 'it_end[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(80, 0, 11, 'non_app_blue[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(81, 0, 11, 'app_blue[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0),
(82, 0, 11, 'result[]', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_heading`
--

CREATE TABLE `tbl_heading` (
  `id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `head_name` varchar(250) NOT NULL,
  `is_main` int(11) NOT NULL DEFAULT 1,
  `is_sub_heading` varchar(250) NOT NULL,
  `span` mediumtext DEFAULT NULL,
  `orderby` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_heading`
--

INSERT INTO `tbl_heading` (`id`, `head_id`, `head_name`, `is_main`, `is_sub_heading`, `span`, `orderby`, `reference_id`) VALUES
(1, 1, 'Empty Dish Weight (g) (M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(2, 1, 'Sample Weight(g)(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(3, 1, 'Oven Drying', 1, '0', 'colspan=\"3\"', 0, 0),
(4, 1, 'M1(M1 After <br>\nDrying Weight(g))', 1, '0', 'rowspan=\"2\"', 0, 0),
(5, 1, 'Calculation', 1, '0', NULL, 0, 0),
(6, 1, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(7, 1, 'Time', 0, '1', NULL, 0, 3),
(8, 1, 'Start', 0, '1', NULL, 0, 3),
(9, 1, 'End', 0, '1', NULL, 0, 3),
(10, 1, '(M1-M2)*100/(M1-M)', 0, '1', NULL, 0, 5),
(11, 2, 'Empty Dish Weight (g) (M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(12, 2, 'Sample Weight (g)(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(13, 2, 'Flaming and Ashing', 1, '0', 'colspan=\"3\"', 0, 0),
(14, 2, 'M1(M1 After\r\nDrying Weight(g))', 1, '0', 'rowspan=\"2\"', 0, 0),
(15, 2, 'Calculation', 1, '0', NULL, 0, 0),
(16, 2, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(17, 2, 'Time', 0, '1', NULL, 0, 13),
(18, 2, 'Start', 0, '1', NULL, 0, 13),
(19, 2, 'End', 0, '1', NULL, 0, 13),
(20, 2, '(M1-M2)*100/(M1-M)', 0, '1', NULL, 0, 15),
(21, 3, 'Empty Dish Weight (g) (M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(22, 3, 'Empty Dish Weight (g)-</br>Sample Weight (g)(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(23, 3, 'Oven Drying and Ashing                              ', 1, '0', 'colspan=\"3\"', 0, 0),
(24, 3, 'M2(M1 After\nAshing Weight(g))', 1, '0', 'rowspan=\"2\"', 0, 0),
(25, 3, 'Calculation', 1, '0', NULL, 0, 0),
(26, 3, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(27, 3, 'Oven Drying Time', 0, '1', NULL, 0, 23),
(28, 3, 'Oven Drying Start', 0, '1', NULL, 0, 23),
(29, 3, 'Oven Drying End', 0, '1', NULL, 0, 23),
(30, 3, '(M1-M2)*100/(M1-M)', 0, '1', NULL, 0, 25),
(31, 4, 'Sample Weight (g)(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(32, 4, 'Empty Soxhlet<br> Flask Weight (g) (M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(33, 4, 'Extraction and Oven Drying', 1, '0', 'colspan=\"3\"', 0, 0),
(34, 4, 'Final Soxhlet Flask Weight (g) (M2)', 1, '0', 'rowspan=\"2\"', 0, 0),
(35, 4, 'Calculation', 1, '0', NULL, 0, 0),
(36, 4, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(37, 4, 'Oven Drying Time', 0, '1', NULL, 0, 33),
(38, 4, 'Oven Drying Start', 0, '1', NULL, 0, 33),
(39, 4, 'Oven Drying End', 0, '1', NULL, 0, 33),
(40, 4, '(M2-M1)*100/M', 0, '1', NULL, 0, 35),
(41, 5, 'Sample Weight (g)(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(42, 5, '(Crucible + Content Weight<br> Before Ashing Weight (g) (M1)', 1, '0', 'rowspan=\"2\"', 0, 0),
(43, 5, 'Oven Drying and Ashing', 1, '0', 'colspan=\"3\"', 0, 0),
(44, 5, '(Crucible + Ash Weight)<br>After Weight (g) (M2)', 1, '0', 'rowspan=\"2\"', 0, 0),
(45, 5, 'Calculation', 1, '0', NULL, 0, 0),
(46, 5, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(47, 5, 'Time', 0, '1', NULL, 0, 43),
(48, 5, 'Start', 0, '1', NULL, 0, 43),
(49, 5, 'End', 0, '1', NULL, 0, 43),
(50, 5, '100*(M1-M2)/M', 0, '1', NULL, 0, 45),
(51, 6, 'Sample Weight (M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(52, 6, 'Stand By', 1, '0', 'colspan=\"3\"', 0, 0),
(53, 6, 'Titre Value(A)', 1, '0', 'rowspan=\"2\"', 0, 0),
(54, 6, 'NaOH Normality(N)', 1, '0', 'rowspan=\"2\"', 0, 0),
(55, 6, 'Calculation 4.9*AN/M', 1, '0', 'rowspan=\"2\"', 0, 0),
(56, 6, 'Result % by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(57, 6, 'Time', 0, '1', NULL, 0, 52),
(58, 6, 'Start', 0, '1', NULL, 0, 52),
(59, 6, 'End', 0, '1', NULL, 0, 52),
(60, 7, 'Sample Weight (g) (W)', 1, '0', 'rowspan=\"2\"', 0, 0),
(61, 7, 'Digestion Time', 1, '0', 'colspan=\"2\"', 0, 0),
(62, 7, 'empty', 1, '0', 'colspan=\"4\"', 0, 0),
(63, 7, 'Calculation', 1, '0', NULL, 0, 0),
(64, 7, 'Result % by Mass \r\nN*6.25*100/W', 1, '0', 'rowspan=\"2\"', 0, 0),
(65, 7, 'Start', 0, '1', NULL, 0, 61),
(66, 7, 'End', 0, '1', NULL, 0, 61),
(67, 7, 'Acid Measured For Blank Distillation (C)', 0, '1', NULL, 0, 62),
(68, 7, 'Alkali Used for back Titration of Blank(D)', 0, '1', NULL, 0, 62),
(69, 7, 'Acid Measured for Test Distillation (A)', 0, '1', NULL, 0, 62),
(70, 7, 'Alkali Used for back Titration of Test(B)', 0, '1', NULL, 0, 62),
(71, 7, 'Nitrogen(N)=[(A-B)-(C-D)]*0.014*Normality of NaoH', 0, '1', NULL, 0, 63),
(72, 8, 'Moisture (A)', 1, '0', 'rowspan=\"2\"', 0, 0),
(73, 8, 'Total Protein(B)', 1, '0', 'rowspan=\"2\"', 0, 0),
(74, 8, 'Total Fat (C)', 1, '0', 'rowspan=\"2\"', 0, 0),
(75, 8, 'Total Ash (D)', 1, '0', 'rowspan=\"2\"', 0, 0),
(76, 8, 'Calculation', 1, '0', NULL, 0, 0),
(77, 8, 'Result\r\n% by Mass', 1, '0', 'rowspan=\"2\"', 0, 0),
(78, 8, 'Total Carbohydrate = 100-(A+B+C+D)', 0, '1', NULL, 0, 76),
(79, 9, 'Total Protein(P)', 1, '0', 'rowspan=\"2\"', 0, 0),
(80, 9, 'Total Fat (F)', 1, '0', 'rowspan=\"2\"', 0, 0),
(81, 9, 'Total Carbohydrate(C)', 1, '0', 'rowspan=\"2\"', 0, 0),
(82, 9, 'Calculation', 1, '0', NULL, 0, 0),
(83, 9, 'Result\nKcal per 100g', 1, '0', 'rowspan=\"2\"', 0, 0),
(84, 9, 'Total Energy= (4*P)+(9*F)+(4*C)', 0, '1', NULL, 0, 82),
(86, 10, 'Sample Weight(g)', 1, '0', 'rowspan=\"2\"', 0, 0),
(87, 10, 'Mass of Sample Applied to Silica Column(M)', 1, '0', 'rowspan=\"2\"', 0, 0),
(88, 10, 'Concentration of Aflatoxin Standard (r)', 1, '0', 'rowspan=\"2\"', 0, 0),
(89, 10, 'Volume of Final Dilution of Sample Extract(Ul) (V)', 1, '', 'rowspan=\"2\"', 0, 0),
(90, 10, 'Fluorescence detected in sample extract (x)', 1, '0', 'rowspan=\"2\"', 0, 0),
(91, 10, 'Fluorescence detected in Standard (S)', 1, '0', 'rowspan=\"2\"', 0, 0),
(92, 10, 'Calculation', 1, '0', NULL, 0, 0),
(93, 10, 'Aflatoxin Ul/kg', 1, '', 'rowspan=\"2\"', 0, 0),
(94, 10, 'S*r*V/X*M', 0, '1', NULL, 0, 92),
(95, 11, 'Incubation Temperature', 1, '0', 'rowspan=\"2\"', 0, 0),
(96, 11, 'Incubation Time', 1, '0', 'colspan=\"2\"', 0, 0),
(97, 11, 'Non Appearance of Blue Colour', 1, '0', 'rowspan=\"2\"', 0, 0),
(98, 11, 'Appearance of Blue Colour', 1, '0', 'rowspan=\"2\"', 0, 0),
(99, 11, 'Result', 1, '0', 'rowspan=\"2\"', 0, 0),
(100, 11, 'Start', 0, '1', NULL, 0, 96),
(101, 11, 'End', 0, '1', NULL, 0, 96);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_main_heading`
--

CREATE TABLE `tbl_main_heading` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_multiple` tinyint(4) NOT NULL DEFAULT 0,
  `calculation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_main_heading`
--

INSERT INTO `tbl_main_heading` (`id`, `name`, `is_multiple`, `calculation`) VALUES
(1, 'Determination of Moisture', 1, '(sample_weight-drying_weight)*100/5.0382'),
(2, 'Determination of Total Ash', 1, '(Ashing_weight-empty_dish_weight)*100/(sample_weight)'),
(3, 'Determination of Acid Insoluble Ash', 1, NULL),
(4, 'Determination of Fat', 1, NULL),
(5, 'Determination of Crude Fibre', 1, NULL),
(6, 'Determination of Alcoholic Acidity', 0, NULL),
(7, 'Determination of Protein', 0, NULL),
(8, 'Determination of Total Carbohydrates', 0, NULL),
(9, 'Determination of Total Energy', 0, NULL),
(10, 'Determination of Aflatoxin', 0, NULL),
(11, 'Determination of Amylase Activity(Qualitative)', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'FOOD AND AGRICULTURAL PRODUCTS', NULL, 1, 0, 1, '2023-04-19 11:07:55', NULL, NULL),
(2, 'NUTRACEUTICALS & FUNCTIONAL FOODS', NULL, 1, 0, NULL, '2023-06-20 16:56:31', NULL, NULL),
(3, 'FOOD AND AGRICULTURAL GROUP', NULL, 1, 0, NULL, '2023-06-20 16:56:31', NULL, NULL),
(6, 'DRUGS & PHARMACEUTICALS', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL),
(7, 'NUTRACEUTICALS AND FUNCTIONAL FOODS', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL),
(8, 'INDUSTRIAL & FINE CHEMICALS', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL),
(9, 'NUTRITIONAL SUPPLEMENTS', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL),
(10, 'INDUSTRIAL FINE CHEMICALS', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL),
(11, 'WATER', NULL, 1, 0, NULL, '2023-06-20 16:58:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_category`
--

CREATE TABLE `tbl_material_category` (
  `id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material_category`
--

INSERT INTO `tbl_material_category` (`id`, `material_id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'RAW MATERIALS', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(5, 1, 'FINISHED GOODS', 'Find the ingerdient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(7, 1, 'INTERMEDIATE PRODUCTS', 'Find the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(23, 1, 'ENVIRONMENTAL AND POLLUTION', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(24, 1, 'HERBS SPICES & CONDIMENTS', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(25, 1, 'SUGAR AND SUGAR PRODUCTS', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(30, 1, 'SOYA PROTEIN ', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(31, 1, 'EDIBLE OILS AND FATS', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(32, 1, 'BAKERY AND CONFECTIONERY PRODUCTS', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(34, 1, 'OIL SEEDS & BY PRODUCTS1', 'asdfgh', 1, 0, 1, '2023-06-20 16:35:18', NULL, NULL),
(36, 1, 'FRUITS &  VEGETABLES PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(37, 1, 'SNACKS AND INSTANT MIXES', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(39, 1, 'EDIBLE COLOURS & FLAVOUR', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(40, 1, 'EGGS & EGG PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(41, 1, 'MILK & DAIRY PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(42, 1, 'CEREAL, PULSES AND CEREAL PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(43, 1, 'STARCH AND STARCH PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(44, 1, 'MULTIGRAIN PUFFS - TANGY TOMATO', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(46, 1, 'DISINFECTANTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(47, 11, 'WATER', 'water', 1, 0, 1, '2023-06-20 16:35:18', NULL, NULL),
(48, 1, 'VITAMINS & MINERALS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(50, 1, 'CEREAL PULSES AND CEREAL PROUDUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(51, 1, 'VITAMINS &  MINERALS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(55, 1, 'NUTRACEUTICALS & FUNCTIONAL FOODS', ' FORTIFIED WHEAT ATTA', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(56, 1, 'COCONUT AND COCONUT PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(57, 1, 'HONEY & HONEY PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(59, 1, 'VITAMIN AND MINERAL PREMIX', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(60, 1, 'COFFEE & COCOA PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(61, 1, 'TEA AND TEA PRODUCT', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(62, 1, 'POULTRY AND POULTRY PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(63, 1, 'FRUITS AND VEGETABLE PRODUCTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(65, 1, 'SOY PROTEIN', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(66, 1, 'CEREAL PULSES AND CEREAL PRODUTS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(67, 1, 'VITAMIN & MINERAL PREMIX FOR MOTHERS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(68, 1, 'SYNTHETIC FOOD COLOR', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(69, 1, 'FORTIFIED BISCUIT', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(70, 1, 'PRESERVATIES', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(71, 1, 'ARTIFICIAL SWEETENERS', '', 1, 0, NULL, '2023-06-20 16:35:18', NULL, NULL),
(72, NULL, 'Select Material Group', NULL, 1, 0, NULL, '2023-06-20 17:49:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_format`
--

CREATE TABLE `tbl_material_format` (
  `id` int(11) NOT NULL,
  `test_grp_id` int(11) DEFAULT NULL,
  `sample_id` int(11) NOT NULL,
  `standard_test_id` int(11) DEFAULT NULL,
  `parameters` varchar(150) DEFAULT NULL,
  `protocols` varchar(150) DEFAULT NULL,
  `specification` varchar(150) DEFAULT NULL,
  `text` varchar(150) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `remark` varchar(150) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material_format`
--

INSERT INTO `tbl_material_format` (`id`, `test_grp_id`, `sample_id`, `standard_test_id`, `parameters`, `protocols`, `specification`, `text`, `unit`, `value`, `remark`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 1, 'Moisture', 'IS 3025 (Part 11 ) :1983', 'min', '5.0', '% by mass', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL),
(2, 1, 1, 1, 'Physical Observation', 'IS 3025 (Part 11 ) :1981', 'max', '6.5 ', 'mg / l', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL),
(3, 2, 1, 1, 'test', 'IS 16072', 'max', '5.0', '% by mass', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL),
(4, 1, 124, 3, 'Moisture', 'IS 3025 (Part 11 ) :1983', 'min', '5.0', '% by mass', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL),
(5, 1, 124, 3, 'Moisture143', 'FSSAI manual of Methods of Analysis of Foods Cereal and cereal products Fssai 03.039:2022 pg No.117-118:2022', 'min', '342', '5554', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_item`
--

CREATE TABLE `tbl_material_item` (
  `id` int(11) NOT NULL,
  `mateial_category_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material_item`
--

INSERT INTO `tbl_material_item` (`id`, `mateial_category_id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 5, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS ( SATHU MAVU) FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(2, 1, 'WHEAT ( WHOLE )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(3, 1, 'SOYABEAN ( WHOLE )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(4, 1, 'RAGI ( WHOLE )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(5, 31, 'FORTIFIED RBD PALMOLEIN OIL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(6, 7, 'WHEAT FLOUR ( ROASTED)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(7, 7, 'SOYABEAN FLOUR ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(8, 5, 'ENERGY DENSE WEANING FOOD', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(9, 5, 'ENERGY DENCE LADDU PREMIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(10, 7, 'ROASTED RAGI FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(11, 7, 'MALTED RAGI FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(12, 7, 'BENGAL GRAM DHAL (ROASTED FLOUR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(13, 5, 'PANJARI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(14, 37, 'QUINOA PUFFS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(15, 37, 'MULTIGRAIN CHIPS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(16, 37, 'RAGI STICKS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(17, 37, 'MULTIGRAIN BALLS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(18, 24, 'ONION MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(19, 5, 'ENERGY DENCE NAM KEEN DALIA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(20, 5, 'ENERGY DENCE MEETHA DALIA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(21, 5, 'ONION MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(22, 33, 'MULTIGRAIN CHIKKI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(23, 7, 'VITAMIN PREMIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(24, 37, 'MULTIGRAIN PUFFS-TANGY TOMATO', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(25, 37, 'MULTIGRAIN BREAD CHIPPS-CHILLI ORANGE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(26, 37, 'MULTIGRAIN BALLS-CHILLY CHATAKA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(27, 33, 'MILLET COOKIES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(28, 42, 'RICE FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(29, 7, 'VITAMINS AND MINERALS PREMIX ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(30, 11, 'Strawberry Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(31, 11, 'Banana Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(32, 11, 'Mango Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(33, 11, 'Banana Powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(34, 11, 'Strawberry Powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(35, 36, 'Mango Fruit powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(36, 11, 'WHOLE MILK POWDER ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(37, 33, 'ORGANIC OATS FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(38, 33, 'BLENDED EXTRUDED MATERIALS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(39, 39, 'VENNILA FLAVOUR ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(40, 40, 'EGG CURRY ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(41, 37, 'KHICHADI MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(42, 37, 'PONGAL MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(43, 37, 'POHA MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(44, 37, 'UPMA MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(45, 5, 'AVAL MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(46, 33, 'SPROUTED RAGI FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(47, 33, 'OATS 100% ORGANIC POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(48, 33, 'BROWN RICE BABY CEREAL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(49, 24, 'GARAM MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(50, 24, 'FISH FRAY MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(51, 24, 'CHILLI POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(52, 39, 'CHLOROPHYLL - EDIBLE COLORS & FLAVOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(53, 49, 'SAMBAR MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(54, 20, 'CHICKEN MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(55, 20, 'TURMERIC  POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(56, 33, 'MILLET & OATS PORRIDGE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(57, 20, 'CUMIN POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(58, 24, 'CURRY MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(59, 7, 'MAIZE FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(60, 1, 'BROKEN RICE ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(61, 11, 'TEA POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(62, 5, 'UPMA MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(63, 7, 'FORTIFIED RICE KERNEL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(64, 11, 'Strawberry cereal powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(65, 11, 'MANGO FRUIT', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(66, 24, 'Sambar Masala', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(67, 24, 'CUMIN (WHOLE)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(68, 24, 'Chicken Masala', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(69, 24, 'TURMERIC POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(70, 24, 'Cumin Powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(71, 42, 'RICE FLAKES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(72, 20, 'JAGGERY  POIWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(73, 25, 'JAGGERY (CONE)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(74, 21, 'VITAMINS & MINERAL PREMIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(75, 20, 'SUGAR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(76, 20, 'MAIDA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(77, 20, 'SOYA FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(78, 33, 'Mighty Puff – Choco Ragi', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(79, 33, 'Mighty Munch – CHEESE & HERBS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(80, 42, 'Mighty Munch - Tangy Tomato', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(81, 25, 'SUGAR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(82, 34, 'EDIBLE GROUNDNUT  FLOUR  (EXPELLER PRESSED) as per IS 4684:1975', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(83, 31, 'GROUNDNUT OIL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(84, 31, 'GINGELY OIL/ SESAME OIL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(85, 33, 'READY TO EAT EXTRUDED SNACK FOOD', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(86, 33, 'RAGI STICK – TANGY MINT', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(87, 33, 'MULTI GRAINS BALLS – CHILLI CHATAKA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(88, 33, 'QUINOA PUFFS – SPICY GARLIC', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(89, 33, 'RAGI STICK – ACHARI MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(90, 33, 'MULTI GRAIN PUFFS – TANGY TOMATO', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(91, 33, 'MULTI GRAINS PUFFS – BUTTER MAKHANA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(92, 33, 'MULTI GRAINS CHIPS – SOUR CREAM ONION', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(93, 33, 'MINI QUINOA PUFFS – CHEESE & HERBS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(94, 33, 'MULTI GRAINS  BREAD CHIPS – CHILLI ORANGE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(95, 41, 'WHOLE MILK POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(96, 36, 'Banana powder', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(97, 33, 'Strawberry Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(98, 33, 'Banana Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(99, 50, 'Mango Cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(100, 37, 'RAGI STICKS –ACHARI MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(101, 33, 'MULTI GRAINS BREAD CHIPS - CHILLI ORANGE ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(102, 33, 'MULTI GRAINS BREAD CHIPS-CHILLI ORANGE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(103, 42, 'PROCESSED CEREAL BASED COMPLEMENTARY FOODS AS PER 11536:2007', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(104, 33, 'PROCESSED CEREAL BASED COMPLEMENTARY FOODS AS PER 11536:2007 ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(105, 42, 'PROTEIN RICH FOOD SUPPLEMENTS FOR THE INFANTS  AND  PRE SCHOOL CHILDREN  AS PER  7021:2017', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(106, 43, 'SAGO', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(107, 37, 'RAGI STICKS-ACHARI MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(108, 37, 'RAGI STICKS- TANGY MINT', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(109, 37, 'QUINO PUFFS-ONION MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(110, 37, 'MINI QUINOA PUFFS-CHEESE AND HERB', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(111, 37, 'MULTIGRAIN PUFFS - BUTTER MAKHANA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(112, 37, 'MULTIGRAIN PUFFS - TANGY TOMATO', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(113, 44, 'MULTIGRAIN PUFFS - TANGY TOMTO', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(114, 43, 'PAPPAD', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(115, 42, 'PEPPER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(116, 24, 'CLOVES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(117, 33, 'SUJI BEFORE TOSTING', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(118, 33, 'SUJI AFTER TOASTING', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(119, 42, 'SATHU MAAVU', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(120, 33, 'SATHU MAAVU', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(121, 40, 'Egg', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(122, 46, 'SODIUM HYPOCHLORITE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(124, 47, 'DRINKING WATER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(125, 48, 'VITAMIN C (ASCORBIC  ACID)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(126, 24, 'pepper', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(127, 48, 'CALCIUM CARBONATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(128, 48, 'VITAMIN - B2 ( RIBOFLAVIN)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(129, 48, 'ELECTROLYTIC IRON ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(130, 42, 'SUJI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(131, 50, 'SUJI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(132, 42, 'SLURRP FARM CEREAL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(133, 37, 'MOONGDAL KHICHDI MIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(134, 42, 'Ragi Wave Chips - Tomato Paradise', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(135, 42, 'QUINOA PUFFS - ONION MASALA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(136, 50, 'SATHUMAAVU', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(137, 50, 'RAGI ALMOND AND BANANA ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(138, 51, 'VITAMIN  - A', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(139, 51, 'VITAMIN -B2 ( Riboflavin)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(140, 47, 'RO WATER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(141, 48, 'VITAMIN PREMIX', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(142, 7, 'VITAMIN PREMIX FOR RECEIPE - 1 & 3', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(143, 7, 'VITAMIN PREMIX FOR RECEIPE - 2', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(144, 55, 'VITAMIN PREMIX FOR RECEIPE - 1 & 3', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(145, 55, 'VITAMIN PREMIX FOR RECEIPE - 2', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(146, 55, 'LOW FAT SOYAFLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(147, 55, 'VITAMIN & MINERALS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(148, 51, 'VITAMIN & MINEARLS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(149, 51, 'VITAMIN PREMIX FOR RECEIPE - 1 & 3', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(150, 51, 'VITAMIN PREMIX FOR RECEIPE - 2 ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(151, 56, 'DESSICATED COCONUT', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(152, 48, 'VITAMINS - B1 ( THIAMINE HYDROCHLORIDE)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(153, 48, 'VITAMINS - B3 ( NIACIN )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(154, 41, 'SKIMMED MILK POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(155, 31, 'REFINED SOYABEAN OIL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(156, 5, 'ATTA MOONG DAL CHEELA FOR CHILDREN AGED  6 MONTH TO 3 YEARS (GREEN GRAM DAL WITH SKIN )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(157, 5, 'ATTA MOONG DAL CHEELA FOR CHILDREN AGED 6 MONTH TO 3 YEARS (GREEN GRAM DAL WITHOUT SKIN)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(158, 50, 'strawberry cereal', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(159, 37, 'MUESLI HONEY AND NUTS ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(160, 5, 'ATTA BEASAN HALWA FOR CHILDREN AGED 6 MONTHS TO 3 YEARS (WITH SKIMMED MILK POWDER)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(161, 5, 'ATTA BEASAN HALWA FOR CHILDREN AGED 6 MONTHS TO 3 YEARS(WITH WHOLE MILK POWDER)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(162, 5, ' BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF COMPLEMENTARY WEANING FOOD CONTAINING AMYLASE ACTIVITY', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(163, 34, 'GINGELLY CAKE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(164, 5, 'SHELF LIFE  SAMPLE - COMPLEMENTARY WEANING FOOD CONTAINING AMYLASE ACTIVITY', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(165, 5, 'BALAMRUTHAM', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(166, 7, 'BENGAL GRAM DHAL FLOUR  (ROASTED)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(167, 48, 'SODIUM BICARBONATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(168, 50, 'GERMINATED RAGI ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(169, 5, 'COMPLEMENTARY FOOD (SATHU MAVU)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(170, 32, 'SESAME CHIKKI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(171, 34, 'GROUNDNUT ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(172, 39, 'Ponceau-4R', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(173, 32, 'MULTI GRAIN  CHIKKI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(174, 60, 'COCOA POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(175, 32, 'MULTIGRAIN COOKIES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(176, 5, ' WEANING FOOD FORMULATION FOR  CHILDREN UP TO 6 YEARS ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(177, 5, 'WEANING FOOD FORMULATION ADOLESCENT GIRLS,PREGNANT & LACTACTING MOTHERS ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(178, 1, 'THOOR DHAL (WHOLE)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(179, 1, 'URID DHAL ( WHOLE )', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(180, 36, 'PISTACHIO NUTS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(181, 25, 'PALM JAGGERY', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(182, 48, ' FOLIC ACID', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(183, 32, 'MULTI GRAIN COOKIES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(184, 57, 'HONEY', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(185, 61, 'TEA POWDER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(186, 51, 'THIAMINE MONONITRATE ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(187, 51, 'POTASSIUM IODATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(188, 51, 'SODIUM BICARBONATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(189, 51, 'SODIUM HEXA META PHOSPHATE(SHMP)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(190, 51, 'CITRIC ACID', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(191, 51, 'FERROUS FUMARATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(192, 62, 'EGG WHOLE ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(193, 62, 'EGG GRAVY', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(194, 63, 'DEHYDRATE FRUITS AND VEGETABLES', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(195, 51, 'CYNOCOBALAMIN', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(196, 51, 'POTASSIUM IODIDE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(197, 51, 'ZINC SULPHATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(198, 36, 'CARROT FLAKES (FORTIFIED)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(199, 7, 'LOW FAT SOYA FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(200, 42, 'QUINOA FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(201, 51, 'NIACIN ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(202, 7, 'SORGHUM FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(203, 1, 'MILLED RICE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(204, 1, 'CUMIN(WHOLE)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(205, 34, 'EDIBLE GROUNDNUT FLOUR ROASTED', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(206, 1, 'GROUNDNUT KERNEL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(207, 55, 'FORTIFIED RICE KERNAL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(208, 25, 'JAGGERY SYRUP', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(209, 7, 'MAIDA ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(210, 31, 'VANASPATI', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(211, 34, 'EDIBLE GROUNDNUT FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(212, 55, 'CHAKKI ATTA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(213, 5, 'SHISHU AAHAR FOR THE CHILDREN IN THE AGE GROUP OF 6 MONTHS TO 3 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(214, 5, 'POUSHTIK MEETHA DALIA FOR THE CHILDREN IN THE AGE GROUP OF 6 MONTHS TO 3 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(215, 5, 'PAUSHTIK NAMKEEN DALIA FOR PREGNANT WOMEN', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(216, 1, 'MILLED PARBOILED RICE ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(217, 5, 'SHISHU AAHAR FOR THE CHILDREN IN THE AGE GROUP OF 6 MONTH TO 3 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(218, 5, 'POUSHTIK MEETHA DALIA FOR PREGNANT WOMEN', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(219, 5, 'POUSHTIK NAMKEEN DALIA FOR LACTATING MOTHER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(220, 5, 'POUSHTIK MEETHA DALIA FOR LACTATING MOTHER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(221, 55, 'FORTIFIED WHEAT ATTA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(222, 5, 'POUSHTIK MEETHA DALIA FOR THE SEVERELY MALNOURISHED CHILDREN IN THE AGE GROUP OF 6 MONTHS TO 6 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(223, 5, 'SHISHU AAHAR FOR THE SEVERELY MALNOURISHED CHILDREN IN THE AGE GROUP OF 6 MONTH TO 6 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(224, 65, 'ROASTED SOYABEAN FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(225, 55, 'ROASTED SOYABEAN FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(226, 51, 'FERRIC PYROPHOSPHATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(227, 5, 'RENISCH TEST', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(228, 55, 'LOW FAT SOYA FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(229, 25, 'JAGGERY(POWDER)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(230, 25, 'JAGGERY (BALL)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(231, 5, ' SATHU MAVU FOR CHILDREN IN THE AGE GROUP OF 6 MONTHS TO 2 YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(232, 5, 'ICDS FOOD SUPPLEMENT(SATHU MAVU) FOR CHILDREN IN THE AGE GROUP OF 2 YEARS TO 6 YEARS(WITH CARDAMOM FLAVOUR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(233, 5, 'SATHU MAVU FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(234, 5, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS (SATHU MAVU) FOR CHILDREN 2 YEARS TO 6 YEARS (WITH CARDAMOM FLAVOR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(235, 42, 'INFANT FOOD - PROCESSED CEREAL BASED COMPLEMENTARY FOODS AS PER 11536:2022', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(236, 1, 'BENGAL GRAM DHAL  WITHOUT HUSK', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(237, 47, 'GROUND WATER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(238, 24, 'RAW MATERIAL ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(239, 1, 'CARDAMOM', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(240, 5, 'ICDS FOOD SUPPLEMENTS (SATHU MAVU) FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(241, 24, 'CARDAMOM', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(242, 5, 'ICDS FOOD SUPPLEMENTS (SATHU MAVU)FOR CHILDREN IN THE AGE GROUP OF 6 MONTHS TO 2 YEARS   ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(243, 5, 'ICDS FOOD SUPPLEMENTS (SATHU MAVU)FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(244, 7, 'VITAMIN & MINERAL PREMIX FOR AN/PN MOTHER', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(245, 7, 'VITAMIN & MINERAL PREMIX FOR CHILDREN IN THE AGE GROUP OF 6MONTHS TO 2YEARS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(246, 1, 'URID DHAL (WITHOUT HUSK)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(247, 5, ' ICDS FOOD SUPPLEMENTS (SATHU MAVU) FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(248, 5, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS (SATHU MAVU) FOR CHILDREN 2 YEARS TO 6 YEARS(WITH CARDAMOM FLAVOR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(249, 5, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS (SATHU MAVU) FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(250, 51, 'PYRIDOXINE HYDROCHLORIDE( B6)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(251, 51, 'BIOTIN', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(252, 51, 'CHOLINE BITARTRATE', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(253, 7, 'ROASTED GROUNDNUT FLOUR ', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(254, 5, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS ( SATHU MAVU) FOR CHILDREN IN THE AGE GROUP OF 2 YEARS TO 6 YEARS ( WITH VANILLA FLAVOUR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(255, 7, 'URID DHAL FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(256, 5, 'ICDS FOOD SUPPLEMENTS (SATHU MAVU ) FOR CHILDREN IN  THE AGE GROUP OF 2 YEARS TO 6 YEARS (WITH VANILLA  FLAVOUR)', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(257, 68, 'FAST GREEN FCF', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(258, 32, 'FORTIFIED BISCUIT', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(259, 70, 'BENZOIC ACID', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(260, 71, 'ASPARTAME', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(261, 7, 'ATTA', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(262, 1, 'PISTACHIO NUTS', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(263, 50, 'ROASTED BENGAL GRAM DHAL FLOUR', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(264, 55, 'FORTIFIED RICE KERNEL', NULL, 1, 0, NULL, '2023-06-20 16:17:55', NULL, NULL),
(265, 1, 'BLEND OF CRITICAL PROCESSED MATERIALS FOR THE MANUFACTURE OF ICDS FOOD SUPPLEMENTS ( SATHU MAVU) FOR AN/PN MOTHERS', NULL, 1, 0, NULL, '2023-06-20 17:26:04', NULL, NULL),
(266, 72, 'ENERGY DENCE NAM KEEN DALIA', NULL, 1, 0, NULL, '2023-06-20 17:49:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_test`
--

CREATE TABLE `tbl_material_test` (
  `id` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `material_category_id` int(11) NOT NULL,
  `material_item_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_test_item`
--

CREATE TABLE `tbl_material_test_item` (
  `id` int(11) NOT NULL,
  `material_test_id` int(11) NOT NULL,
  `test_param` varchar(100) DEFAULT NULL,
  `testing_protocol` varchar(100) DEFAULT NULL,
  `specification` varchar(100) DEFAULT NULL,
  `text_value` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `doc` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `name`, `link`) VALUES
(1, 'index', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`id`, `name`, `description`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '*', 'Not Accredited By NABL', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(2, ':', '<10 cfu/g can be considered as absent in 0.1g', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(3, '#', 'Limit of detection for synthetic colour is20mg/kg', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(4, '+', 'Limit of Detection for fat is 0.1 % by mass', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(5, '@', 'Limit Of Detection 3ppb', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(6, '!', 'BLQ- Below Limit of Quantification', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL),
(7, '$', 'BDL:Below Detection Limit, LOD:Limit of Detection', 1, 0, NULL, '2023-06-20 15:08:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_note_creation`
--

CREATE TABLE `tbl_note_creation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Packing Materials (PM)', 'Packing Materials (PM)1', 1, 0, 1, '2023-05-08 16:04:36', NULL, NULL),
(2, 'Finished Goods (FG)', 'Finished Goods (FG)', 1, 0, 0, '2023-05-08 16:04:46', NULL, NULL),
(3, 'Work In Progress (WIP)', 'Work In Progress (WIP)', 1, 0, 0, '2023-05-08 16:04:57', NULL, NULL),
(6, 'DRINIKING WATER', '.', 1, 0, 1, '2023-06-17 16:46:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sampling_method`
--

CREATE TABLE `tbl_sampling_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sampling_method`
--

INSERT INTO `tbl_sampling_method` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'SOP-03', '1', 1, 0, 0, '2023-05-05 13:29:54', NULL, NULL),
(2, 'QSP-05', '2', 1, 0, 0, '2023-05-05 13:29:54', NULL, NULL),
(6, 'Select Sampling Method', NULL, 1, 0, NULL, '2023-06-15 16:21:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specification`
--

CREATE TABLE `tbl_specification` (
  `id` int(11) NOT NULL,
  `speci_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_standard_test_type`
--

CREATE TABLE `tbl_standard_test_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_standard_test_type`
--

INSERT INTO `tbl_standard_test_type` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'BIS', '', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(2, 'FSSAI', '', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(3, 'AGMARK', '', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(4, 'IN HOUSE', '', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(5, 'CUSTOM', 'Filter the ingredient', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(6, 'OTHERS', '', 1, 0, NULL, '2023-06-20 14:57:32', NULL, NULL),
(7, 'Select Test Type', NULL, 1, 0, NULL, '2023-06-20 17:49:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stp`
--

CREATE TABLE `tbl_stp` (
  `id` int(11) NOT NULL,
  `test_parameters` varchar(250) DEFAULT NULL,
  `testing_protocols` varchar(150) DEFAULT NULL,
  `uploaded_files` text DEFAULT NULL,
  `uploaded_images` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stp`
--

INSERT INTO `tbl_stp` (`id`, `test_parameters`, `testing_protocols`, `uploaded_files`, `uploaded_images`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '5te324323', '564', 'a:1:{i:0;a:1:{i:0;s:14:\"Page Title.pdf\";}}', 'a:2:{i:0;a:1:{i:0;s:0:\"\";}i:1;a:1:{i:0;s:9:\"ADMIN.jpg\";}}', 1, 0, 0, '2023-06-05 17:32:25', 0, NULL),
(2, 't', 'gfd', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 0, 1, 0, '2023-06-06 13:08:35', 0, NULL),
(3, 'Protocol', 'Protocol', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 1, 0, 0, '2023-06-08 15:59:30', 0, NULL),
(4, 'Parameter', 'Protocol', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 0, 1, 0, '2023-06-08 16:00:53', 0, NULL),
(5, 'Parameter1', 'Parameter1', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 0, 1, 0, '2023-06-08 16:01:20', 0, NULL),
(6, 'Parameter11', 'Parameter11', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 0, 1, 0, '2023-06-08 16:01:48', 0, NULL),
(7, 'Parameter11111', 'Parameter11111', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 'a:1:{i:0;a:1:{i:0;s:0:\"\";}}', 1, 0, 0, '2023-06-08 16:01:55', 0, NULL),
(8, 'sdfghj', 'sdfgh', 'a:1:{i:0;a:1:{i:0;s:9:\"Tamil.rar\";}}', 'a:1:{i:0;a:1:{i:0;s:21:\"1685438666432 (1).jpg\";}}', 0, 1, 0, '2023-06-08 16:10:04', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_heading`
--

CREATE TABLE `tbl_sub_heading` (
  `id` int(11) NOT NULL,
  `headid` int(11) NOT NULL,
  `sub_head_name` varchar(250) NOT NULL,
  `orderby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_heading`
--

INSERT INTO `tbl_sub_heading` (`id`, `headid`, `sub_head_name`, `orderby`) VALUES
(1, 3, 'subhead 1', 0),
(2, 3, 'subhead 2', 0),
(3, 3, 'subhead 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testing`
--

CREATE TABLE `tbl_testing` (
  `id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `is_retest` int(11) DEFAULT 0,
  `is_resample` int(11) DEFAULT 0,
  `product_id` int(11) DEFAULT NULL,
  `sample_code` varchar(150) DEFAULT NULL,
  `sampling_date` datetime DEFAULT NULL,
  `sampling_receive_date` datetime DEFAULT NULL,
  `sample_quantity` varchar(150) DEFAULT NULL,
  `test_category_id` varchar(11) DEFAULT NULL,
  `test_start_date` datetime DEFAULT NULL,
  `test_end_date` datetime DEFAULT NULL,
  `env_condition` varchar(150) DEFAULT NULL,
  `temp` varchar(100) DEFAULT NULL,
  `humidity` varchar(100) DEFAULT NULL,
  `sampling_condition` varchar(150) DEFAULT NULL,
  `test_grp_id` int(11) DEFAULT NULL,
  `standard_test_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `material_grp_id` int(11) DEFAULT NULL,
  `sample_id` int(11) DEFAULT NULL,
  `sample_method_id` int(11) DEFAULT NULL,
  `assign_from` varchar(11) DEFAULT NULL,
  `chemical_test_res` varchar(11) DEFAULT NULL,
  `micro_test_res` varchar(11) DEFAULT NULL,
  `test_responsibility` int(11) DEFAULT 0,
  `issued_to` varchar(100) DEFAULT NULL,
  `test_number` varchar(150) DEFAULT NULL,
  `report_date` datetime DEFAULT NULL,
  `report_number` varchar(50) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `otherlabel` text DEFAULT NULL,
  `othervalue` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_testing`
--

INSERT INTO `tbl_testing` (`id`, `status`, `is_retest`, `is_resample`, `product_id`, `sample_code`, `sampling_date`, `sampling_receive_date`, `sample_quantity`, `test_category_id`, `test_start_date`, `test_end_date`, `env_condition`, `temp`, `humidity`, `sampling_condition`, `test_grp_id`, `standard_test_id`, `material_id`, `material_grp_id`, `sample_id`, `sample_method_id`, `assign_from`, `chemical_test_res`, `micro_test_res`, `test_responsibility`, `issued_to`, `test_number`, `report_date`, `report_number`, `reference_id`, `notes`, `otherlabel`, `othervalue`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 0, 0, 0, 1, '12345', '2023-03-20 00:00:00', '2023-03-20 00:00:00', '2kg', '1', '2023-03-20 00:00:00', '2023-03-20 00:00:00', NULL, '1234', '53', '43', 1, 3, 11, 47, 124, 1, '1', NULL, NULL, 4, '54', 'TEST-6043-4239', NULL, NULL, 1, '[\"1\",\"4\"]', '[\"000\",\"23\",\"\",\"\"]', '[\"23\",\"23\",\"\",\"\"]', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testing_logs`
--

CREATE TABLE `tbl_testing_logs` (
  `id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `is_retest` int(11) NOT NULL DEFAULT 0,
  `is_resample` int(11) NOT NULL DEFAULT 0,
  `testing_id` int(11) DEFAULT NULL,
  `prepared_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approve_status` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `approve_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_notify` int(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_testing_logs`
--

INSERT INTO `tbl_testing_logs` (`id`, `status`, `is_retest`, `is_resample`, `testing_id`, `prepared_by`, `approved_by`, `approve_status`, `description`, `approve_date`, `is_notify`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 0, 0, 0, 1, 1, NULL, NULL, NULL, '2023-06-21 10:20:26', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test_category`
--

CREATE TABLE `tbl_test_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_test_category`
--

INSERT INTO `tbl_test_category` (`id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'EXTERNAL SAMPLE', 'Final Testing', 1, 0, NULL, '2023-06-20 12:45:55', NULL, NULL),
(2, 'IN HOUSE SAMPLE', 'Testing Locally', 1, 0, NULL, '2023-06-20 12:45:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test_group`
--

CREATE TABLE `tbl_test_group` (
  `id` int(11) NOT NULL,
  `test_category_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_test_group`
--

INSERT INTO `tbl_test_group` (`id`, `test_category_id`, `name`, `comment`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'CHEMICAL TESTING', NULL, 1, 0, NULL, '2023-06-20 12:48:36', NULL, NULL),
(2, 2, 'BIOLOGICAL TESTING', NULL, 1, 0, NULL, '2023-06-20 12:48:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test_material_format`
--

CREATE TABLE `tbl_test_material_format` (
  `id` int(11) NOT NULL,
  `testing_id` int(11) DEFAULT NULL,
  `parameters` varchar(150) DEFAULT NULL,
  `protocols` varchar(150) DEFAULT NULL,
  `specification` varchar(150) DEFAULT NULL,
  `text` varchar(150) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_test_material_format`
--

INSERT INTO `tbl_test_material_format` (`id`, `testing_id`, `parameters`, `protocols`, `specification`, `text`, `unit`, `value`, `remark`, `status`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Moisture', 'IS 3025 (Part 11 ) :1983', 'min', '5.0', '% by mass', '123', NULL, 0, 1, 0, 1, NULL, NULL, NULL),
(2, 1, 'Moisture143', 'FSSAI manual of Methods of Analysis of Foods Cereal and cereal products Fssai 03.039:2022 pg No.117-118:2022', 'min', '342', '5554', '56', NULL, 0, 1, 0, 1, NULL, NULL, NULL),
(3, 1, 'ph', 'IS 3025 (Part 11 ) :1983', 'text', '6.5 - 8.5', '% by mass', '34', NULL, 0, 1, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`id`, `name`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Admin', 1, 0, 0, '2023-03-01 15:20:36', NULL, NULL),
(2, 'Quality Manager', 1, 0, 0, '2023-03-01 15:20:36', NULL, NULL),
(14, 'Micro Biologist', 1, 0, NULL, '2023-06-07 14:48:35', NULL, NULL),
(15, 'Analyst', 1, 0, NULL, '2023-06-07 14:48:35', NULL, NULL),
(16, 'Senior Analyst', 1, 0, NULL, '2023-06-07 14:49:13', NULL, NULL),
(17, 'Junior Analyst', 1, 0, NULL, '2023-06-07 14:49:13', NULL, NULL),
(25, 'Chief Analyst', 1, 0, 1, '2023-06-15 14:50:02', NULL, NULL),
(26, '123456', 0, 1, 1, '2023-06-17 10:09:38', NULL, NULL),
(27, '54657', 0, 1, 1, '2023-06-17 10:09:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work_sheet`
--

CREATE TABLE `tbl_work_sheet` (
  `id` int(11) NOT NULL,
  `mainheadid` int(11) NOT NULL,
  `testing_id` varchar(50) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_work_sheet`
--

INSERT INTO `tbl_work_sheet` (`id`, `mainheadid`, `testing_id`, `name`, `is_completed`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '1', '{\"empty_dish_weight\":[\"5\"],\"sample_weight\":[\"321\"],\"od_time\":[\"213\"],\"od_start\":[\"1223\"],\"od_end\":[\"32\"],\"drying_weight\":[\"3214\"],\"calculation\":[\"325\"],\"result\":[\"-57421.30\"]}', 1, 1, 0, NULL, '2023-06-05 10:59:21', NULL, NULL),
(2, 2, '1', '{\"empty_dish_weight\":[\"213\",\"347\"],\"sample_weight\":[\"213\",\"2\"],\"fa_time\":[\"21\",\"22\"],\"fa_start\":[\"234\",\"432\"],\"fa_end\":[\"324\",\"432\"],\"Ashing_weight\":[\"432\",\"123\"],\"calculation\":[\"432\",\"432\"],\"result\":[\"102.82\",\"858\"]}', 1, 1, 0, NULL, '2023-06-05 11:00:17', NULL, NULL),
(3, 3, '1', '{\"empty_dish_weight\":[\"453\"],\"sample_weight\":[\"453\"],\"oda_time\":[\"453\"],\"oda_start\":[\"453\"],\"oda_end\":[\"453\"],\"Ashing_weight\":[\"435\"],\"calculation\":[\"435\"],\"result\":[\"543\"]}', 1, 1, 0, NULL, '2023-06-05 11:00:30', NULL, NULL),
(4, 4, '1', '{\"sample_weight\":[\"324\"],\"empty_soxhlet\":[\"342\"],\"eod_time\":[\"432\"],\"eod_start\":[\"35463\"],\"eod_end\":[\"4653546\"],\"final_soxhlet\":[\"3\"],\"calculation\":[\"4343\"],\"result\":[\"4334\"]}', 1, 1, 0, NULL, '2023-06-05 11:02:35', NULL, NULL),
(5, 5, '1', '{\"sample_weight\":[\"43\",\"45\"],\"ashing_weight\":[\"435\",\"435\"],\"oda_time\":[\"435\",\"234\"],\"oda_start\":[\"453\",\"6543\"],\"oda_end\":[\"435\",\"54\"],\"crucible_ashing\":[\"435\",\"435\"],\"calculation\":[\"453\",\"543\"],\"result\":[\"43\",\"63\"]}', 1, 1, 0, NULL, '2023-06-05 11:03:02', NULL, NULL),
(6, 6, '1', '{\"sample_weight\":[\"564\"],\"sb_time\":[\"564\"],\"sb_start\":[\"65\"],\"sb_end\":[\"876\"],\"titre_value\":[\"876\"],\"normality\":[\"7\"],\"calculation\":[\"67\"],\"result\":[\"786\"]}', 1, 1, 0, NULL, '2023-06-05 11:03:18', NULL, NULL),
(7, 7, '1', '{\"sample_weight\":[\"324\"],\"dt_start\":[\"432\"],\"dt_end\":[\"324\"],\"acid_blank\":[\"324\"],\"alkali_blank\":[\"324\"],\"acid_test\":[\"342\"],\"alkali_test\":[\"342\"],\"calculation\":[\"342\"],\"result\":[\"324\"]}', 1, 1, 0, NULL, '2023-06-05 11:03:35', NULL, NULL),
(8, 8, '1', '{\"moisture(A)\":[\"3421\"],\"total_protein(B)\":[\"4321\"],\"total_fat(C)\":[\"4231\"],\"total_ash(D)\":[\"432\"],\"calculation\":[\"432\"],\"result\":[\"43\"]}', 1, 1, 0, NULL, '2023-06-05 11:03:49', NULL, NULL),
(9, 9, '1', '{\"total_protein(P)\":[\"2341\"],\"total_fat(F)\":[\"564\"],\"total_carbohydrate(C)\":[\"6754\"],\"calculation\":[\"76\"],\"result\":[\"675\"]}', 1, 1, 0, NULL, '2023-06-05 11:04:02', NULL, NULL),
(10, 10, '1', '{\"sample_wt\":[\"354543\"],\"mass_sample\":[\"453\"],\"conn_aflatoxin\":[\"345\"],\"volume_final(P)\":[\"435\"],\"flu_extract\":[\"543\"],\"flu_std\":[\"435\"],\"calculation\":[\"435\"],\"aflatoxin\":[\"435\"]}', 1, 1, 0, NULL, '2023-06-05 11:04:15', NULL, NULL),
(11, 11, '1', '{\"incu_temp\":[\"34\"],\"it_start\":[\"45\"],\"it_end\":[\"342\"],\"non_app_blue\":[\"342\"],\"app_blue\":[\"324\"],\"result\":[\"342\"]}', 1, 1, 0, NULL, '2023-06-05 11:06:13', NULL, NULL),
(12, 1, '5', '{\"empty_dish_weight\":[\"432\",\"213\"],\"sample_weight\":[\"5432\",\"321443\"],\"od_time\":[\"54332\",\"43\"],\"od_start\":[\"543\",\"432\"],\"od_end\":[\"543\",\"342\"],\"drying_weight\":[\"54\",\"234\"],\"calculation\":[\"4\",\"234\"],\"result\":[\"106744.47\",\"342\"]}', 0, 1, 0, NULL, '2023-06-07 10:52:27', NULL, NULL),
(13, 2, '5', '{\"empty_dish_weight\":[\"543\"],\"sample_weight\":[\"4\"],\"fa_time\":[\"65\"],\"fa_start\":[\"54\"],\"fa_end\":[\"54\"],\"Ashing_weight\":[\"54\"],\"calculation\":[\"54\"],\"result\":[\"-12225.00\"]}', 0, 1, 0, NULL, '2023-06-07 14:45:39', NULL, NULL),
(14, 1, '2', '{\"empty_dish_weight\":[\"234\"],\"sample_weight\":[\"432\"],\"od_time\":[\"43\"],\"od_start\":[\"43\"],\"od_end\":[\"4\"],\"drying_weight\":[\"34\"],\"calculation\":[\"34\"],\"result\":[\"7899.65\"]}', 1, 1, 0, NULL, '2023-06-17 12:28:15', NULL, NULL),
(15, 1, '13', '{\"empty_dish_weight\":[\"68.4725\"],\"sample_weight\":[\"1.0083\"],\"od_time\":[\"2 hrs\"],\"od_start\":[\"10.20\"],\"od_end\":[\"12.20\"],\"drying_weight\":[\"69.4565\"],\"calculation\":[\"69.4565-69.4808* 100\\/1.0083\"],\"result\":[\"-1358.58\"]}', 0, 1, 0, NULL, '2023-06-17 16:05:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `user_type_id` tinyint(4) DEFAULT NULL,
  `emp_no` varchar(50) DEFAULT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `emp_name` varchar(75) DEFAULT NULL,
  `communication_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `mobile_no` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type_id`, `emp_no`, `company_name`, `emp_name`, `communication_address`, `permanent_address`, `gender`, `phone_no`, `mobile_no`, `email`, `photo`, `is_active`, `is_deleted`, `created_by`, `created_at`) VALUES
(1, 'admin', '$2y$10$bv6nBFt7Ok4dyko.ehyKM.MFrNaQI.MxZV2qh52dsBTV5bLW6.Tx2', 1, '1234', '1', 'Admin', 'chennai', NULL, '1', '1234567', '123456789', 'admin', NULL, 1, 0, 0, '2023-04-05 14:51:33'),
(4, 'user', '$2y$10$isH057v3k6ws8/1/tBBIK.0RyP1w3pVInoGztaR1yaUzUjfgjbDpO', 2, '123', NULL, 'User-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2023-06-08 12:12:16'),
(12, 'User-2', '$2y$10$YWahypsNiQggGqQTt8p/lerqONIrEa0R5bHxLjNLcjvNHH9eRDN/C', 14, '1232', NULL, 'User-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2023-06-14 15:48:35'),
(13, 'User-3', '$2y$10$8cAy.jaYIg6ycOhqxlMcd.MhjgPUFM.sZ7LxpVDHyLBx4m1V4xRvy', 15, '1324', NULL, 'User-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2023-06-14 15:49:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_demo`
--
ALTER TABLE `tbl_demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_discipline_category`
--
ALTER TABLE `tbl_discipline_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_form_detail`
--
ALTER TABLE `tbl_form_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formMasterId` (`formheadid`);

--
-- Indexes for table `tbl_heading`
--
ALTER TABLE `tbl_heading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_main_heading`
--
ALTER TABLE `tbl_main_heading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material_category`
--
ALTER TABLE `tbl_material_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material_format`
--
ALTER TABLE `tbl_material_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material_item`
--
ALTER TABLE `tbl_material_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material_test`
--
ALTER TABLE `tbl_material_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material_test_item`
--
ALTER TABLE `tbl_material_test_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_note_creation`
--
ALTER TABLE `tbl_note_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sampling_method`
--
ALTER TABLE `tbl_sampling_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_standard_test_type`
--
ALTER TABLE `tbl_standard_test_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stp`
--
ALTER TABLE `tbl_stp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sub_heading`
--
ALTER TABLE `tbl_sub_heading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testing`
--
ALTER TABLE `tbl_testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testing_logs`
--
ALTER TABLE `tbl_testing_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_test_category`
--
ALTER TABLE `tbl_test_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_test_group`
--
ALTER TABLE `tbl_test_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_test_material_format`
--
ALTER TABLE `tbl_test_material_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_work_sheet`
--
ALTER TABLE `tbl_work_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_no` (`emp_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_demo`
--
ALTER TABLE `tbl_demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_discipline_category`
--
ALTER TABLE `tbl_discipline_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_form_detail`
--
ALTER TABLE `tbl_form_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_heading`
--
ALTER TABLE `tbl_heading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tbl_main_heading`
--
ALTER TABLE `tbl_main_heading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_material_category`
--
ALTER TABLE `tbl_material_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_material_format`
--
ALTER TABLE `tbl_material_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_material_item`
--
ALTER TABLE `tbl_material_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `tbl_material_test`
--
ALTER TABLE `tbl_material_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material_test_item`
--
ALTER TABLE `tbl_material_test_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_note_creation`
--
ALTER TABLE `tbl_note_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_sampling_method`
--
ALTER TABLE `tbl_sampling_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_standard_test_type`
--
ALTER TABLE `tbl_standard_test_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_stp`
--
ALTER TABLE `tbl_stp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_sub_heading`
--
ALTER TABLE `tbl_sub_heading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_testing`
--
ALTER TABLE `tbl_testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_testing_logs`
--
ALTER TABLE `tbl_testing_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_test_category`
--
ALTER TABLE `tbl_test_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_test_group`
--
ALTER TABLE `tbl_test_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_test_material_format`
--
ALTER TABLE `tbl_test_material_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_work_sheet`
--
ALTER TABLE `tbl_work_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2020 at 08:48 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efl_db_pts`
--

-- --------------------------------------------------------

--
-- Table structure for table `cutting_daily_target`
--

CREATE TABLE `cutting_daily_target` (
  `id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `man_power` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `finishing_daily_target`
--

CREATE TABLE `finishing_daily_target` (
  `id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `target_hour` int(11) NOT NULL,
  `man_power` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `line_daily_target`
--

CREATE TABLE `line_daily_target` (
  `id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `target_hour` int(11) NOT NULL,
  `man_power_1` int(11) NOT NULL,
  `man_power_2` int(11) NOT NULL,
  `man_power_3` int(11) NOT NULL,
  `man_power_4` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aql_status_log`
--

CREATE TABLE `tb_aql_status_log` (
  `id` int(11) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `aql_status` int(11) NOT NULL COMMENT '0=Pending, 1=Pass, 2=Failed',
  `aql_remarks` varchar(255) NOT NULL,
  `aql_status_date` datetime NOT NULL,
  `aql_action_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bundle_cut_detail`
--

CREATE TABLE `tb_bundle_cut_detail` (
  `id` int(11) NOT NULL,
  `cut_tracking_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `cut_table` varchar(255) NOT NULL,
  `cut_no` int(11) NOT NULL,
  `bundle_no` int(11) NOT NULL,
  `bundle_tracking_no` varchar(255) NOT NULL COMMENT 'style_PurchaseOrder_item_cut_size_bundleno',
  `bundle_range` varchar(255) NOT NULL,
  `bundle_range_count` int(11) NOT NULL,
  `layer_group` int(11) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `line_id` int(11) NOT NULL,
  `is_bundle_collar_cuff_scanned_line` int(11) NOT NULL COMMENT '1=true, 0=false',
  `bundle_collar_cuff_scanned_line_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_care_labels`
--

CREATE TABLE `tb_care_labels` (
  `id` int(11) NOT NULL,
  `pc_tracking_no` varchar(255) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `po_type` int(11) NOT NULL COMMENT '0=bulk, 1=size_set, 2=sample',
  `cut_table` varchar(255) NOT NULL,
  `cut_no` varchar(255) NOT NULL,
  `cut_tracking_no` varchar(255) NOT NULL,
  `bundle_no` int(11) NOT NULL,
  `bundle_tracking_no` varchar(255) NOT NULL,
  `bundle_range` varchar(255) NOT NULL,
  `layer_group` int(11) NOT NULL,
  `is_wash_gmt` int(11) NOT NULL COMMENT '1=wash, 0=non-wash',
  `is_reprint_allow` int(11) NOT NULL COMMENT '1=TRUE, 0=FALSE',
  `reprint_allow_date_time` datetime NOT NULL,
  `date_time` datetime NOT NULL,
  `planned_line_id` int(11) NOT NULL,
  `sent_to_production` int(11) NOT NULL COMMENT '1=True, 0=False',
  `sent_to_production_date_time` datetime NOT NULL,
  `package_sent_to_production` int(11) NOT NULL COMMENT '1=TRUE, 0=FALSE',
  `package_sent_to_production_date_time` datetime NOT NULL,
  `is_printed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `printing_date_time` datetime NOT NULL,
  `line_id` int(11) NOT NULL,
  `finishing_floor_id` int(11) NOT NULL,
  `access_points` int(11) NOT NULL COMMENT '1=cutting, 2=line_begin, 3=midline_qc, 4=endline_qc',
  `access_points_status` int(11) NOT NULL COMMENT '1=passed, 2=defect, 3=rejected, 4=end_line_passed',
  `line_input_date_time` datetime NOT NULL,
  `mid_line_qc_date_time` datetime NOT NULL,
  `end_line_qc_date_time` datetime NOT NULL,
  `is_going_wash` int(11) NOT NULL COMMENT '1=true, 0=false',
  `going_wash_scan_date_time` datetime NOT NULL,
  `wash_going_printed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `wash_going_print_date_time` datetime NOT NULL,
  `finishing_qc_status` int(11) NOT NULL COMMENT '1=passed, 2=defect, 3=reject',
  `finishing_qc_date_time` datetime NOT NULL,
  `washing_status` int(11) NOT NULL,
  `washing_date_time` datetime NOT NULL,
  `packing_status` int(11) NOT NULL,
  `packing_date_time` datetime NOT NULL,
  `carton_status` int(11) NOT NULL COMMENT '1=true, 0=false',
  `carton_date_time` datetime NOT NULL,
  `finishing_alter_date_time` datetime NOT NULL,
  `warehouse_qa_type` int(11) NOT NULL COMMENT '1=Warehouse Buyer, 2=Warehouse Factory, 3=Warehouse Trash, 4=Warehouse Production Sample, 5=Other Purpose, 6=Lost, 7=size_set',
  `warehouse_buyer_date_time` datetime NOT NULL,
  `warehouse_factory_date_time` datetime NOT NULL,
  `warehouse_trash_date_time` datetime NOT NULL,
  `warehouse_production_sample_date_time` datetime NOT NULL,
  `warehouse_other_purpose_date_time` datetime NOT NULL,
  `warehouse_sizeset_date_time` datetime NOT NULL,
  `warehouse_last_action_date_time` datetime NOT NULL,
  `warehouse_qa_by` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `other_purpose_remarks` varchar(255) NOT NULL,
  `other_purpose_liable_person` varchar(255) NOT NULL,
  `lost_date_time` datetime NOT NULL,
  `manually_closed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `is_package_ready` int(11) NOT NULL,
  `package_ready_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cut_delete_log`
--

CREATE TABLE `tb_cut_delete_log` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `cut_no` varchar(255) NOT NULL,
  `cut_qty` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cut_no`
--

CREATE TABLE `tb_cut_no` (
  `id` int(11) NOT NULL,
  `cut_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cut_no`
--

INSERT INTO `tb_cut_no` (`id`, `cut_no`) VALUES
(1, '1'),
(2, '1.1'),
(3, '1.2'),
(4, '1.3'),
(5, '2'),
(6, '2.1'),
(7, '2.2'),
(8, '2.3'),
(9, '3'),
(10, '3.1'),
(11, '3.2'),
(12, '3.3'),
(13, '4'),
(14, '4.1'),
(15, '4.2'),
(16, '4.3'),
(17, '5'),
(18, '5.1'),
(19, '5.2'),
(20, '5.3'),
(21, '6'),
(22, '6.1'),
(23, '6.2'),
(24, '6.3'),
(25, '7'),
(26, '7.1'),
(27, '7.2'),
(28, '7.3'),
(29, '8'),
(30, '8.1'),
(31, '8.2'),
(32, '8.3'),
(33, '9'),
(34, '9.1'),
(35, '9.2'),
(36, '9.3'),
(37, '10'),
(38, '10.1'),
(39, '10.2'),
(40, '10.3'),
(41, '11'),
(42, '11.1'),
(43, '11.2'),
(44, '11.3'),
(45, '12'),
(46, '12.1'),
(47, '12.2'),
(48, '12.3'),
(49, '13'),
(50, '13.1'),
(51, '13.2'),
(52, '13.3'),
(53, '14'),
(54, '14.1'),
(55, '14.2'),
(56, '14.3'),
(57, '15'),
(58, '15.1'),
(59, '15.2'),
(60, '15.3'),
(61, '16'),
(62, '16.1'),
(63, '16.2'),
(64, '16.3'),
(65, '17'),
(66, '17.1'),
(67, '17.2'),
(68, '17.3'),
(69, '18'),
(70, '18.1'),
(71, '18.2'),
(72, '18.3'),
(73, '19'),
(74, '19.1'),
(75, '19.2'),
(76, '19.3'),
(77, '20'),
(78, '20.1'),
(79, '20.2'),
(80, '20.3'),
(81, '21'),
(82, '21.1'),
(83, '21.2'),
(84, '21.3'),
(85, '22'),
(86, '22.1'),
(87, '22.2'),
(88, '22.3'),
(89, '23'),
(90, '23.1'),
(91, '23.2'),
(92, '23.3'),
(93, '24'),
(94, '24.1'),
(95, '24.2'),
(96, '24.3'),
(97, '25'),
(98, '25.1'),
(99, '25.2'),
(100, '25.3'),
(101, '26'),
(102, '26.1'),
(103, '26.2'),
(104, '26.3'),
(105, '27'),
(106, '27.1'),
(107, '27.2'),
(108, '27.3'),
(109, '28'),
(110, '28.1'),
(111, '28.2'),
(112, '28.3'),
(113, '29'),
(114, '29.1'),
(115, '29.2'),
(116, '29.3'),
(117, '30'),
(118, '30.1'),
(119, '30.2'),
(120, '30.3'),
(121, '31'),
(122, '31.1'),
(123, '31.2'),
(124, '31.3'),
(125, '32'),
(126, '32.1'),
(127, '32.2'),
(128, '32.3'),
(129, '33'),
(130, '33.1'),
(131, '33.2'),
(132, '33.3'),
(133, '34'),
(134, '34.1'),
(135, '34.2'),
(136, '34.3'),
(137, '35'),
(138, '35.1'),
(139, '35.2'),
(140, '35.3'),
(141, '36'),
(142, '36.1'),
(143, '36.2'),
(144, '36.3'),
(145, '37'),
(146, '37.1'),
(147, '37.2'),
(148, '37.3'),
(149, '38'),
(150, '38.1'),
(151, '38.2'),
(152, '38.3'),
(153, '39'),
(154, '39.1'),
(155, '39.2'),
(156, '39.3'),
(157, '40'),
(158, '40.1'),
(159, '40.2'),
(160, '40.3'),
(161, '41'),
(162, '41.1'),
(163, '41.2'),
(164, '41.3'),
(165, '42'),
(166, '42.1'),
(167, '42.2'),
(168, '43.3'),
(169, '43'),
(170, '43.1'),
(171, '43.2'),
(172, '43.3'),
(173, '44'),
(174, '44.1'),
(175, '44.2'),
(176, '44.3'),
(177, '45'),
(178, '45.1'),
(179, '45.2'),
(180, '45.3'),
(181, '46'),
(182, '46.1'),
(183, '46.2'),
(184, '46.3'),
(185, '47'),
(186, '47.1'),
(187, '47.2'),
(188, '47.3'),
(189, '48'),
(190, '48.1'),
(191, '48.2'),
(192, '48.3'),
(193, '49'),
(194, '49.1'),
(195, '49.2'),
(196, '49.3'),
(197, '50'),
(198, '50.1'),
(199, '50.2'),
(200, '50.3'),
(201, '51'),
(202, '51.1'),
(203, '51.2'),
(204, '51.3'),
(205, '52'),
(206, '52.1'),
(207, '52.2'),
(208, '52.3'),
(209, '53'),
(210, '53.1'),
(211, '53.2'),
(212, '53.3'),
(213, '54'),
(214, '54.1'),
(215, '54.2'),
(216, '54.3'),
(217, '55'),
(218, '55.1'),
(219, '55.2'),
(220, '55.3'),
(221, '56'),
(222, '56.1'),
(223, '56.2'),
(224, '56.3'),
(225, '57'),
(226, '57.1'),
(227, '57.2'),
(228, '57.3'),
(229, '58'),
(230, '58.1'),
(231, '58.2'),
(232, '58.3'),
(233, '59'),
(234, '59.1'),
(235, '59.2'),
(236, '59.3'),
(237, '60'),
(238, '60.1'),
(239, '60.2'),
(240, '60.3'),
(241, '61'),
(242, '61.1'),
(243, '61.2'),
(244, '61.3'),
(245, '62'),
(246, '62.1'),
(247, '62.2'),
(248, '62.3'),
(249, '63'),
(250, '63.1'),
(251, '63.2'),
(252, '63.3'),
(253, '64'),
(254, '64.1'),
(255, '64.2'),
(256, '64.3'),
(257, '65'),
(258, '65.1'),
(259, '65.2'),
(260, '65.3'),
(261, '66'),
(262, '66.1'),
(263, '66.2'),
(264, '66.3'),
(265, '67'),
(266, '67.1'),
(267, '67.2'),
(268, '67.3'),
(269, '68'),
(270, '68.1'),
(271, '68.2'),
(272, '68.3'),
(273, '69'),
(274, '69.1'),
(275, '69.2'),
(276, '69.3'),
(277, '70'),
(278, '70.1'),
(279, '70.2'),
(280, '70.3'),
(281, '71'),
(282, '72'),
(283, '73'),
(284, '74'),
(285, '75'),
(286, '76'),
(287, '77'),
(288, '78'),
(289, '79'),
(290, '80'),
(291, '81'),
(292, '82'),
(293, '83'),
(294, '84'),
(295, '85'),
(296, '86'),
(297, '87'),
(298, '88'),
(299, '89'),
(300, '90'),
(301, '91'),
(302, '92'),
(303, '93'),
(304, '94'),
(305, '95'),
(306, '96'),
(307, '97'),
(308, '98'),
(309, '99'),
(310, '100');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cut_summary`
--

CREATE TABLE `tb_cut_summary` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `brand` varchar(255) NOT NULL,
  `bundle` int(11) NOT NULL,
  `cut_no` varchar(255) NOT NULL,
  `cut_tracking_no` varchar(255) NOT NULL,
  `bundle_tracking_no` varchar(255) NOT NULL,
  `cut_table` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `cut_qty` int(11) NOT NULL,
  `planned_cut_qty` int(11) NOT NULL,
  `cut_layer` int(11) NOT NULL,
  `bundle_range` varchar(255) NOT NULL,
  `bundle_range_start` int(11) NOT NULL,
  `bundle_range_end` int(11) NOT NULL,
  `pc_no_start` varchar(255) NOT NULL,
  `pc_no_end` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `po_type` int(11) NOT NULL COMMENT '0=bulk, 1=size_set, 2=sample',
  `planned_line_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `package_sent_to_production` int(11) NOT NULL COMMENT '1=TRUE, 0=FALSE',
  `package_sent_to_production_date_time` datetime NOT NULL,
  `is_bundle_collar_cuff_scanned_line` int(11) NOT NULL COMMENT '1=true, 0=false',
  `bundle_collar_cuff_scanned_line_date_time` datetime NOT NULL,
  `is_bundle_collar_scanned_line` int(11) NOT NULL COMMENT '1=true, 0=false',
  `bundle_collar_scanned_datetime` datetime NOT NULL,
  `is_bundle_cuff_scanned_line` int(11) NOT NULL COMMENT '1=true, 0=false',
  `bundle_cuff_scanned_datetime` datetime NOT NULL,
  `is_care_label_printed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `is_collar_bundle_printed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `is_cuff_bundle_printed` int(11) NOT NULL COMMENT '1=true, 0=false',
  `is_cutting_collar_bundle_ready` int(11) NOT NULL COMMENT '1=true, 0=false',
  `cutting_collar_bundle_ready_date_time` datetime NOT NULL,
  `is_cutting_cuff_bundle_ready` int(11) NOT NULL COMMENT '1=true, 0=false',
  `cutting_cuff_bundle_ready_date_time` datetime NOT NULL,
  `cutting_collar_cuff_bundle_last_action_date_time` datetime NOT NULL,
  `is_cutting_back_bundle_ready` int(11) NOT NULL,
  `cutting_back_bundle_ready_date_time` datetime NOT NULL,
  `is_cutting_yoke_bundle_ready` int(11) NOT NULL,
  `cutting_yoke_bundle_ready_date_time` datetime NOT NULL,
  `is_cutting_sleeve_bundle_ready` int(11) NOT NULL,
  `cutting_sleeve_bundle_ready_date_time` datetime NOT NULL,
  `is_cutting_sleeve_plkt_bundle_ready` int(11) NOT NULL,
  `cutting_sleeve_plkt_bundle_ready_date_time` datetime NOT NULL,
  `is_cutting_pocket_bundle_ready` int(11) NOT NULL,
  `cutting_pocket_bundle_ready_date_time` datetime NOT NULL,
  `is_package_ready` int(11) NOT NULL,
  `package_ready_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cut_table`
--

CREATE TABLE `tb_cut_table` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `table_description` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cut_table`
--

INSERT INTO `tb_cut_table` (`id`, `table_name`, `table_description`, `u_id`, `date_time`, `status`) VALUES
(1, 'Table-1', 'Table-1', '', '0000-00-00 00:00:00', 1),
(2, 'Table-2', 'Table-2', '', '0000-00-00 00:00:00', 1),
(3, 'Table-3', 'Table-3', '', '0000-00-00 00:00:00', 1),
(4, 'Table-4', 'Table-4', '', '0000-00-00 00:00:00', 1),
(5, 'Table-5', 'Table-5', '', '0000-00-00 00:00:00', 1),
(6, 'Table-6', 'Table-6', '', '0000-00-00 00:00:00', 1),
(7, 'Table-7', 'Table-7', '', '0000-00-00 00:00:00', 1),
(8, 'Table-8', 'Table-8', '', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_daily_cut_summary`
--

CREATE TABLE `tb_daily_cut_summary` (
  `id` int(11) NOT NULL,
  `cut_target` int(11) NOT NULL,
  `normal_output` int(11) NOT NULL,
  `eot_output` int(11) NOT NULL,
  `cut_output` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_daily_finish_summary`
--

CREATE TABLE `tb_daily_finish_summary` (
  `id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `normal_output` int(11) NOT NULL,
  `eot_output` int(11) NOT NULL,
  `output` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_daily_line_summary`
--

CREATE TABLE `tb_daily_line_summary` (
  `id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `normal_output` int(11) NOT NULL,
  `eot_output` int(11) NOT NULL,
  `output` int(11) NOT NULL,
  `work_hour` float NOT NULL,
  `efficiency` float NOT NULL,
  `dhu` float NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_defects_tracking`
--

CREATE TABLE `tb_defects_tracking` (
  `id` int(11) NOT NULL,
  `pc_tracking_no` varchar(255) NOT NULL,
  `line_id` int(11) NOT NULL,
  `qc_point` int(11) NOT NULL COMMENT '3=midline_qc, 4=endline_qc, 5=finishing_qc',
  `defect_part` varchar(255) NOT NULL,
  `defect_code` varchar(255) NOT NULL,
  `defect_recovered` int(11) NOT NULL COMMENT '1=true, 0=false',
  `defect_recovered_date_time` datetime NOT NULL,
  `defect_date_time` datetime NOT NULL,
  `u_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_defect_types`
--

CREATE TABLE `tb_defect_types` (
  `id` int(11) NOT NULL,
  `defect_code` varchar(255) NOT NULL,
  `defect_name` varchar(255) NOT NULL,
  `defect_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_defect_types`
--

INSERT INTO `tb_defect_types` (`id`, `defect_code`, `defect_name`, `defect_description`) VALUES
(1, 'DC0001.', 'Collar Join/Top', 'Collar Join/Top'),
(2, 'DC0002.', 'Cuff Join', 'Cuff Join'),
(3, 'DC0003.', 'Armhole Join/Top', 'Armhole Join/Top'),
(4, 'DC0004.', 'Side Seam', 'Side Seam'),
(5, 'DC0005.', 'Pocket Join', 'Pocket Join'),
(6, 'DC0006.', 'Shoulder Join/Top', 'Shoulder Join/Top'),
(7, 'DC0007.', 'Front Placket', 'Front Placket'),
(8, 'DC0008.', 'Bottom Hem', 'Bottom Hem'),
(9, 'DC0009.', 'Button Attach', 'Button Attach'),
(10, 'DC0010.', 'Spot', 'Spot'),
(11, 'DC0011.', 'Others', 'Others'),
(12, 'DC0012.', 'Uncut Thread', 'Uncut Thread');

-- --------------------------------------------------------

--
-- Table structure for table `tb_floor`
--

CREATE TABLE `tb_floor` (
  `id` int(11) NOT NULL,
  `floor_name` varchar(255) NOT NULL,
  `floor_code` varchar(255) NOT NULL,
  `floor_description` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_floor`
--

INSERT INTO `tb_floor` (`id`, `floor_name`, `floor_code`, `floor_description`, `unit`, `status`) VALUES
(1, '1st Floor', '1', '1st Floor Description', 0, 1),
(2, '2nd Floor', '2', '2nd Floor Description', 0, 1),
(3, 'Ground Floor', '0', 'Ground Floor Description', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gmt_part`
--

CREATE TABLE `tb_gmt_part` (
  `id` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `part_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_gmt_part`
--

INSERT INTO `tb_gmt_part` (`id`, `part_name`, `part_code`, `status`) VALUES
(1, 'COLLAR_OUTER', 'collar_outer', 1),
(2, 'CUFF_OUTER', 'cuff_outer', 1),
(3, 'BACK', 'back', 1),
(4, 'FRONT_L', 'front_l', 1),
(5, 'FRONT_R', 'front_r', 1),
(7, 'YOKE_OUTER', 'yoke_upper', 1),
(8, 'YOKE_INNER', 'yoke_inner', 1),
(9, 'SLEEVE_R', 'sleeve_r', 1),
(10, 'SLEEVE_L', 'sleeve_l', 1),
(11, 'SLV_PLKT_R', 'slv_plkt_r', 1),
(12, 'SLV_PLKT_L', 'slv_plkt_l', 1),
(13, 'POCKET', 'pocket', 1),
(14, 'COLLAR_INNER', 'collar_inner', 1),
(15, 'COLLAR_INNER_2', 'collar_inner_2', 1),
(16, 'COLLAR_OUTER_2', 'collar_outer_2', 1),
(17, 'BAND_OUTER', 'band_upper', 1),
(18, 'BAND_INNER', 'band_inner', 1),
(19, 'CUFF_INNER', 'cuff_inner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hours`
--

CREATE TABLE `tb_hours` (
  `id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_hours`
--

INSERT INTO `tb_hours` (`id`, `hour`, `start_time`, `end_time`, `u_id`) VALUES
(1, 1, '08:00:00', '08:59:59', 0),
(2, 2, '09:00:00', '09:59:59', 0),
(3, 3, '10:00:00', '10:59:59', 0),
(4, 4, '11:00:00', '11:59:59', 0),
(5, 5, '12:00:00', '13:59:59', 0),
(6, 6, '14:00:00', '14:59:59', 0),
(7, 7, '15:00:00', '15:59:59', 0),
(8, 8, '16:00:00', '16:59:59', 0),
(9, 9, '17:00:00', '17:59:59', 0),
(10, 10, '18:00:00', '18:59:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_label_reprint_log`
--

CREATE TABLE `tb_label_reprint_log` (
  `id` int(11) NOT NULL,
  `pc_tracking_no` varchar(255) NOT NULL,
  `lost_point` varchar(255) NOT NULL,
  `line_id` int(11) NOT NULL,
  `access_point` int(11) NOT NULL COMMENT '0= administrator,1=cutting, 2=line_begin, 3=midline_qc, 4=endline_qc, 5=finishing, 6=washing, 7=packing, 8=collar_cuff, 9=carton, 10=wash_going, 100=FLOOR, 200=OPR, 300=QA',
  `reprint_reason` varchar(255) NOT NULL,
  `referenced_by` varchar(255) NOT NULL,
  `printed_by` int(11) NOT NULL,
  `print_date_time` datetime NOT NULL,
  `request_status` int(11) NOT NULL COMMENT '0=Pending, 1=Approve, 2=Deny',
  `approved_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_line`
--

CREATE TABLE `tb_line` (
  `id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `line_code` varchar(255) NOT NULL,
  `line_description` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_line`
--

INSERT INTO `tb_line` (`id`, `line_name`, `line_code`, `line_description`, `unit`, `floor`, `status`) VALUES
(7, 'Line-9', '9', 'Line-9', 0, 1, 1),
(8, 'Line-17', '17', 'Line-17 Modular', 0, 3, 1),
(9, 'Line-10', '10', 'Line-10', 0, 1, 1),
(10, 'Line-18', '18', 'Line-18 Modular', 0, 3, 1),
(11, 'Line-11', '11', 'Line-11', 0, 1, 1),
(12, 'Line-12', '12', 'Line-12', 0, 1, 1),
(13, 'Line-16', '16', 'Line-16', 0, 1, 1),
(14, 'Line-13', '13', 'Line-13', 0, 1, 1),
(15, 'Line-14', '14', 'Line-14', 0, 1, 1),
(16, 'Line-15', '15', 'Line-15', 0, 1, 1),
(17, 'Line-1', '1', 'Line-1', 0, 2, 1),
(18, 'Line-2', '2', 'Line-2', 0, 2, 1),
(19, 'Line-3', '3', 'Line-3', 0, 2, 1),
(20, 'Line-4', '4', 'Line-4', 0, 2, 1),
(21, 'Line-5', '5', 'Line-5', 0, 2, 1),
(22, 'Line-6', '6', 'Line-6', 0, 2, 1),
(23, 'Line-7', '7', 'Line-7', 0, 2, 1),
(24, 'Line-8', '8', 'Line-8', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_line_running_pos`
--

CREATE TABLE `tb_line_running_pos` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `line_id` int(11) NOT NULL,
  `min_line_input_date_time` datetime NOT NULL,
  `count_input_qty_line` int(11) NOT NULL,
  `count_end_line_qc_pass` int(11) NOT NULL,
  `line_po_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_line_scan`
--

CREATE TABLE `tb_line_scan` (
  `id` int(11) NOT NULL,
  `pc_tracking_no` varchar(255) NOT NULL,
  `line_no` int(11) NOT NULL,
  `hour_id` int(11) NOT NULL,
  `begin_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `begin_line_qc_date_time` datetime NOT NULL,
  `mid_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `mid_line_qc_date_time` datetime NOT NULL,
  `output_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `output_line_qc_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_po_detail`
--

CREATE TABLE `tb_po_detail` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `smv` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `created_on` date NOT NULL,
  `changed_on` date NOT NULL,
  `u_id` int(11) NOT NULL,
  `wash_gmt` int(11) NOT NULL COMMENT '1=true, 0=false',
  `is_manual_upload` int(11) NOT NULL COMMENT '1=true, 0=false',
  `upload_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `po_type` int(11) NOT NULL COMMENT '0=bulk, 1=size_set, 2=sample',
  `aql_plan_date` date NOT NULL,
  `aql_status` int(11) NOT NULL COMMENT '0=pending, 1=Pass, 2=Failed',
  `aql_action_date` date NOT NULL,
  `aql_remarks` varchar(255) NOT NULL,
  `aql_action_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_po_part_detail`
--

CREATE TABLE `tb_po_part_detail` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `part_code` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `upload_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_production_summary`
--

CREATE TABLE `tb_production_summary` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `so_no` varchar(255) NOT NULL,
  `purchase_order` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `style_no` varchar(255) NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `ex_factory_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `planned_lines` varchar(255) NOT NULL,
  `responsible_line` varchar(255) NOT NULL,
  `total_order_qty` int(11) NOT NULL,
  `total_cut_qty` int(11) NOT NULL,
  `total_cut_input_qty` int(11) NOT NULL,
  `count_input_qty_line` int(11) NOT NULL,
  `collar_bndl_qty` int(11) NOT NULL,
  `cuff_bndl_qty` int(11) NOT NULL,
  `count_mid_line_qc_pass` int(11) NOT NULL,
  `count_end_line_qc_pass` int(11) NOT NULL,
  `count_washing_qty` int(11) NOT NULL,
  `wash_gmt` int(11) NOT NULL COMMENT '1=True, 0=False',
  `count_washing_pass` int(11) NOT NULL,
  `count_packing_pass` int(11) NOT NULL,
  `count_carton_pass` int(11) NOT NULL,
  `total_wh_qa` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `max_carton_date_time` datetime NOT NULL,
  `po_type` int(11) NOT NULL COMMENT '0=bulk, 1=size_set, 2=sample'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rejection_tracking`
--

CREATE TABLE `tb_rejection_tracking` (
  `id` int(11) NOT NULL,
  `pc_tracking_no` varchar(255) NOT NULL,
  `rejected` int(11) NOT NULL COMMENT '1=true, 0=false',
  `recovered` int(11) NOT NULL COMMENT '1=true, 0=false',
  `begin_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `mid_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `output_line_qc` int(11) NOT NULL COMMENT '1=true, 0=false',
  `line_no` varchar(255) NOT NULL,
  `rejected_date_time` datetime NOT NULL,
  `recovered_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_season`
--

CREATE TABLE `tb_season` (
  `id` int(11) NOT NULL,
  `season` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_segment`
--

CREATE TABLE `tb_segment` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_segment`
--

INSERT INTO `tb_segment` (`id`, `start_time`, `end_time`, `name`, `description`, `status`) VALUES
(1, '08:00:00', '16:59:59', '1st segment', '1st segment', 0),
(2, '17:00:00', '17:59:59', '2nd segment', '2nd segment', 0),
(3, '18:00:00', '18:59:59', '3rd segment', '3rd segment', 0),
(4, '19:00:00', '23:59:59', '4th segment', '4th segment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_size_serial`
--

CREATE TABLE `tb_size_serial` (
  `sl` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `serial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_size_serial`
--

INSERT INTO `tb_size_serial` (`sl`, `size`, `serial`) VALUES
(1, 'XS', 1),
(2, 'S', 2),
(3, 'M', 3),
(4, 'L', 4),
(5, 'XL', 5),
(6, 'XXL', 6),
(7, 'XXXL', 7),
(8, '13', 8),
(9, '13.5', 9),
(10, '14', 10),
(11, '14.5', 11),
(12, '15', 12),
(13, '15.5', 13),
(14, '16', 14),
(15, '16.5', 15),
(16, '17', 16),
(17, '17.5', 17),
(18, '18', 18),
(19, '18.5', 19),
(20, '19', 20),
(21, '19.5', 21),
(22, '20', 22),
(23, '20.5', 23),
(24, '21', 24),
(25, '21.5', 25),
(26, '22', 26),
(27, '22.5', 27),
(28, '23', 28),
(29, '23.5', 29),
(30, '24', 30),
(31, '24.5', 31),
(32, '25', 32),
(33, '25.5', 33),
(34, '26', 34),
(35, '26.5', 35),
(36, '27', 36),
(37, '27.5', 37),
(38, '28', 38),
(39, '28.5', 39),
(40, '29', 40),
(41, '29.5', 41),
(42, '30', 42),
(43, '30.5', 43),
(44, '31', 44),
(45, '31.5', 45),
(46, '32', 46),
(47, '32.5', 47),
(48, '33', 48),
(49, '33.5', 49),
(50, '34', 50),
(51, '34.5', 51),
(52, '35', 52),
(53, '35.5', 53),
(54, '36', 54),
(55, '36.5', 55),
(56, '37', 56),
(57, '37.5', 57),
(58, '38', 58),
(59, '38.5', 59),
(60, '39', 60),
(61, '39.5', 61),
(62, '40', 62),
(63, '40.5', 63),
(64, '41', 64),
(65, '41.5', 65),
(66, '42', 66),
(67, '42.5', 67),
(68, '43', 68),
(69, '43.5', 69),
(70, '44', 70),
(71, '44.5', 71),
(72, '45', 72),
(73, '45.5', 73),
(74, '46', 74),
(75, '46.5', 75),
(76, '47', 76),
(77, '47.5', 77),
(78, '48', 78),
(79, '48.5', 79),
(80, '49', 80),
(81, '49.5', 81),
(82, '50', 82),
(83, '50.5', 83),
(84, '51', 84),
(85, '51.5', 85),
(86, '52', 86),
(87, '52.5', 87),
(88, '53', 88),
(89, '53.5', 89),
(90, '54', 90),
(91, '54.5', 91),
(92, '55', 92),
(93, '55.5', 93),
(94, '56', 94),
(95, '56.5', 95),
(96, '57', 96),
(97, '57.5', 97),
(98, '58', 98),
(99, '58.5', 99),
(100, '59', 100),
(101, '59.5', 101),
(102, '60', 102),
(103, '60.5', 103),
(104, '37R', 104),
(105, '38R', 105),
(106, '39R', 106),
(107, '40R', 107),
(108, '41R', 108),
(109, '42R', 109),
(110, '43R', 110),
(111, '44R', 111),
(112, '45R', 112),
(113, '46R', 113),
(114, '47R', 114),
(115, '48R', 115),
(116, '49R', 116),
(117, '50R', 117),
(118, '51R', 118),
(119, '52R', 119),
(120, '53R', 120),
(121, '54R', 121),
(122, '55R', 122),
(123, '37L', 123),
(124, '38L', 124),
(125, '39L', 125),
(126, '40L', 126),
(127, '41L', 127),
(128, '42L', 128),
(129, '43L', 129),
(130, '44L', 130),
(131, '45L', 131),
(132, '46L', 132),
(133, '47L', 133),
(134, '48L', 134),
(135, '49L', 135),
(136, '50L', 136),
(137, '51L', 137),
(138, '52L', 138),
(139, '53L', 139),
(140, '54L', 140),
(141, '55L', 141),
(142, '37X', 142),
(143, '38X', 143),
(144, '39X', 144),
(145, '40X', 145),
(146, '41X', 146),
(147, '42X', 147),
(148, '43X', 148),
(149, '44X', 149),
(150, '45X', 150),
(151, '46X', 151),
(152, '47X', 152),
(153, '48X', 153),
(154, '49X', 154),
(155, '50X', 155),
(156, '51X', 156),
(157, '52X', 157),
(158, '53X', 158),
(159, '54X', 159),
(160, '55X', 160),
(161, '13R', 161),
(162, '13.5R', 162),
(163, '13.7R', 163),
(164, '14R', 164),
(165, '14.5R', 165),
(166, '14.7R', 166),
(167, '15R', 167),
(168, '15.5R', 168),
(169, '15.7R', 169),
(170, '16R', 170),
(171, '16.5R', 171),
(172, '16.7R', 172),
(173, '17R', 173),
(174, '17.5R', 174),
(175, '17.7R', 175),
(176, '18R', 176),
(177, '18.5R', 177),
(178, '18.7R', 178),
(179, '19R', 179),
(180, '19.5R', 180),
(181, '19.7R', 181),
(182, '20R', 182),
(183, '20.5R', 183),
(184, '20.7R', 184),
(185, '13L', 185),
(186, '13.5L', 186),
(187, '13.7L', 187),
(188, '14L', 188),
(189, '14.5L', 189),
(190, '14.7L', 190),
(191, '15L', 191),
(192, '15.5L', 192),
(193, '15.7L', 193),
(194, '16L', 194),
(195, '16.5L', 195),
(196, '16.7L', 196),
(197, '17L', 197),
(198, '17.5L', 198),
(199, '17.7L', 199),
(200, '18L', 200),
(201, '18.5L', 201),
(202, '18.7L', 202),
(203, '19L', 203),
(204, '19.5L', 204),
(205, '19.7L', 205),
(206, '20L', 206),
(207, '20.5L', 207),
(208, '20.7L', 208),
(209, '13X', 209),
(210, '13.5X', 210),
(211, '13.7X', 211),
(212, '14X', 212),
(213, '14.5X', 213),
(214, '14.7X', 214),
(215, '15X', 215),
(216, '15.5X', 216),
(217, '15.7X', 217),
(218, '16X', 218),
(219, '16.5X', 219),
(220, '16.7X', 220),
(221, '17X', 221),
(222, '17.5X', 222),
(223, '17.7X', 223),
(224, '18X', 224),
(225, '18.5X', 225),
(226, '18.7X', 226),
(227, '19X', 227),
(228, '19.5X', 228),
(229, '19.7X', 229),
(230, '20X', 230),
(231, '20.5X', 231),
(232, '20.7X', 232),
(233, '35/36', 233),
(234, '37/38', 234),
(235, '39/40', 235),
(236, '41/42', 236),
(237, '43/44', 237),
(238, '45/46', 238),
(239, '47/48', 239),
(240, '49/50', 240),
(241, '51/52', 241),
(242, '53/54', 242),
(243, '55/56', 243),
(244, '57/58', 244),
(245, '15A', 245),
(246, '16A', 246),
(247, '17A', 247),
(248, '18A', 248),
(249, '19A', 249),
(250, '20A', 250),
(251, '21A', 251),
(252, '22A', 252),
(253, '23A', 253),
(254, '24A', 254),
(255, '25A', 255),
(256, '26A', 256),
(257, '27A', 257),
(258, '28A', 258),
(259, '29A', 259),
(260, '30A', 260),
(261, '31A', 261),
(262, '32A', 262),
(263, '33A', 263),
(264, '34A', 264),
(265, '35A', 265),
(266, '36A', 266),
(267, '37A', 267),
(268, '38A', 268),
(269, '39A', 269),
(270, '40A', 270),
(271, '41A', 271),
(272, '42A', 272),
(273, '43A', 273),
(274, '44A', 274),
(275, '45A', 275),
(276, '46A', 276),
(277, '47A', 277),
(278, '48A', 278),
(279, '49A', 279),
(280, '50A', 280),
(281, '4XL', 281),
(282, '5XL', 282);

-- --------------------------------------------------------

--
-- Table structure for table `tb_today_finishing_output_qty`
--

CREATE TABLE `tb_today_finishing_output_qty` (
  `id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `qty` int(11) NOT NULL,
  `efficiency` float NOT NULL,
  `wip` int(11) NOT NULL,
  `produce_minute_1` float NOT NULL,
  `work_minute_1` float NOT NULL,
  `produce_minute_2` float NOT NULL,
  `work_minute_2` float NOT NULL,
  `produce_minute_3` float NOT NULL,
  `work_minute_3` float NOT NULL,
  `produce_minute_4` float NOT NULL,
  `work_minute_4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_today_line_output_qty`
--

CREATE TABLE `tb_today_line_output_qty` (
  `id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `qty` int(11) NOT NULL,
  `efficiency` float NOT NULL,
  `wip` int(11) NOT NULL,
  `dhu` float NOT NULL,
  `produce_minute_1` float NOT NULL,
  `work_minute_1` float NOT NULL,
  `work_hour_1` float NOT NULL,
  `produce_minute_2` float NOT NULL,
  `work_minute_2` float NOT NULL,
  `work_hour_2` float NOT NULL,
  `produce_minute_3` float NOT NULL,
  `work_minute_3` float NOT NULL,
  `work_hour_3` float NOT NULL,
  `produce_minute_4` float NOT NULL,
  `work_minute_4` float NOT NULL,
  `work_hour_4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_description` varchar(255) NOT NULL,
  `access_points` int(11) NOT NULL COMMENT '0= administrator,1=cutting, 2=line_begin, 3=midline_qc, 4=endline_qc, 5=finishing, 6=washing, 7=packing, 8=collar_cuff, 9=carton, 10=wash_going, 100=FLOOR, 200=OPR, 300=QA, 400=SD',
  `floor_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive',
  `buyer_condition` varchar(255) NOT NULL COMMENT 'For showing buyer wise report to user',
  `is_print_allowed` int(11) NOT NULL COMMENT '1=TRUE, 0=FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user_name`, `user_password`, `user_description`, `access_points`, `floor_id`, `line_id`, `status`, `buyer_condition`, `is_print_allowed`) VALUES
(1, 'cutting.', '123456', 'CUTTING', 1, 0, 0, 1, '', 0),
(2, 'line_13_b.', '123456', 'INPUT-13', 2, 0, 14, 1, '', 0),
(3, 'line_13_m.', '123456', 'MID-13', 3, 0, 14, 1, '', 0),
(4, 'line_13_e.', '123456', 'END-13', 4, 0, 14, 1, '', 0),
(5, 'line_13_cc.', '123456', 'Collar-Cuff-13', 8, 0, 14, 1, '', 0),
(6, 'line_14_b.', '123456', 'INPUT-14', 2, 0, 15, 1, '', 0),
(7, 'line_14_m.', '123456', 'MID-14', 3, 0, 15, 1, '', 0),
(8, 'line_14_e.', '123456', 'END-14', 4, 0, 15, 1, '', 0),
(9, 'line_14_cc.', '123456', 'Collar-Cuff-14', 8, 0, 15, 1, '', 0),
(10, 'line_15_b.', '123456', 'INPUT-15', 2, 0, 16, 1, '', 0),
(11, 'line_15_m.', '123456', 'MID-15', 3, 0, 16, 1, '', 0),
(12, 'line_15_e.', '123456', 'END-15', 4, 0, 16, 1, '', 0),
(13, 'line_15_cc.', '123456', 'Collar-Cuff-15', 8, 0, 16, 1, '', 0),
(14, 'line_16_b.', '123456', 'INPUT-16', 2, 0, 13, 1, '', 0),
(15, 'line_16_m.', '123456', 'MID-16', 3, 0, 13, 1, '', 0),
(16, 'line_16_e.', '123456', 'END-16', 4, 0, 13, 1, '', 0),
(17, 'line_16_cc.', '123456', 'Collar-Cuff-16', 8, 0, 13, 1, '', 0),
(18, 'line_9_b.', '123456', 'INPUT-9', 2, 0, 7, 1, '', 0),
(19, 'line_9_m.', '123456', 'MID-9', 3, 0, 7, 1, '', 0),
(20, 'line_9_e.', '123456', 'END-9', 4, 0, 7, 1, '', 0),
(21, 'line_9_cc.', '123456', 'Collar-Cuff-9', 8, 0, 7, 1, '', 0),
(22, 'finishing_1.', '123456', 'FINISHING', 5, 0, 0, 1, '', 0),
(23, 'washing_1.', '123456', 'WASHING', 6, 0, 0, 1, '', 0),
(24, 'packing_1.', '123456', 'PACKING', 7, 1, 0, 1, '\'BBD\', \'BMB\', \'BBS\', \'BGM\', \'BMA\', \'BMC\', \'BMS\', \'BOM\', \'HUGO\', \'HUM\'', 1),
(25, 'floor_1.', '123456', 'FLOOR-1', 100, 0, 0, 1, '', 0),
(26, 'opr_1.', '123456', 'OPR-1', 200, 1, 0, 1, '', 0),
(27, 'line_17_e.', '123456', 'END-17', 4, 0, 8, 1, '', 0),
(28, 'line_17_m.', '123456', 'MID-17', 3, 0, 8, 1, '', 0),
(29, 'line_17_b.', '123456', 'INPUT-17', 2, 0, 8, 1, '', 0),
(30, 'line_17_cc.', '123456', 'Collar-Cuff-17', 8, 0, 8, 1, '', 0),
(31, 'line_10_cc.', '123456', 'Collar-Cuff-10', 8, 0, 9, 1, '', 0),
(32, 'line_10_b.', '123456', 'INPUT-10', 2, 0, 9, 1, '', 0),
(33, 'line_10_m.', '123456', 'MID-10', 3, 0, 9, 1, '', 0),
(34, 'line_10_e.', '123456', 'END-10', 4, 0, 9, 1, '', 0),
(35, 'administrator.', '123456', 'ADMIN', 0, 0, 0, 1, '', 0),
(36, 'carton_1.', '123456', 'CARTON', 9, 1, 0, 1, '\'BBD\', \'BMB\', \'BBS\', \'BGM\', \'BMA\', \'BMC\', \'BMS\', \'BOM\', \'HUGO\', \'HUM\'', 0),
(37, 'qa_1.', '123456', 'QA-1', 300, 1, 0, 1, '\'BBD\', \'BBS\', \'BGM\', \'BMA\', \'BMC\', \'BMS\', \'BOM\', \'HUGO\', \'HUM\'', 0),
(38, 'line_18_e.', '123456', 'END-18', 4, 0, 10, 1, '', 0),
(39, 'line_18_m.', '123456', 'MID-18', 3, 0, 10, 1, '', 0),
(40, 'line_18_b.', '123456', 'INPUT-18', 2, 0, 10, 1, '', 0),
(41, 'wash_going_1.', '123456', 'WASH GOING', 10, 0, 0, 1, '', 0),
(42, 'line_11_e.', '123456', 'END-11', 4, 0, 11, 1, '', 0),
(43, 'line_11_m.', '123456', 'MID-11', 3, 0, 11, 1, '', 0),
(44, 'line_11_b.', '123456', 'INPUT-11', 2, 0, 11, 1, '', 0),
(45, 'line_11_cc.', '123456', 'Collar-Cuff-11', 8, 0, 11, 1, '', 0),
(46, 'line_12_cc.', '123456', 'Collar-Cuff-12', 8, 0, 12, 1, '', 0),
(47, 'line_12_b.', '123456', 'INPUT-12', 2, 0, 12, 1, '', 0),
(48, 'line_12_m.', '123456', 'MID-12', 3, 0, 12, 1, '', 0),
(49, 'line_12_e.', '123456', 'END-12', 4, 0, 12, 1, '', 0),
(50, 'line_1_e.', '123456', 'END-1', 4, 0, 17, 1, '', 0),
(51, 'line_1_m.', '123456', 'MID-1', 3, 0, 17, 1, '', 0),
(52, 'line_1_b.', '123456', 'INPUT-1', 2, 0, 17, 1, '', 0),
(53, 'line_1_cc.', '123456', 'Collar-Cuff-1', 8, 0, 17, 1, '', 0),
(54, 'carton_2.', '123456', 'CARTON', 9, 1, 0, 1, '\'M&S T11\', \'TIMBERLAND\'', 0),
(55, 'packing_2.', '123456', 'PACKING', 7, 1, 0, 1, '\'M&S T11\', \'TIMBERLAND\'', 0),
(56, 'qa_2.', '123456', 'QA-2', 300, 1, 0, 1, '\'M&S T11\'', 0),
(57, 'qa_3.', '123456', 'QA-3', 300, 2, 0, 1, '\'OLYMP\'', 0),
(58, 'packing_3.', '123456', 'PACKING', 7, 2, 0, 1, '\'OLYMP\'', 0),
(59, 'carton_3.', '123456', 'CARTON', 9, 2, 0, 1, '\'OLYMP\'', 0),
(60, 'opr_2.', '123456', 'OPR-2', 200, 2, 0, 1, '', 0),
(61, 'line_2_cc.', '123456', 'Collar-Cuff-2', 8, 0, 18, 1, '', 0),
(62, 'line_2_b.', '123456', 'INPUT-2', 2, 0, 18, 1, '', 0),
(63, 'line_2_m.', '123456', 'MID-2', 3, 0, 18, 1, '', 0),
(64, 'line_2_e.', '123456', 'END-2', 4, 0, 18, 1, '', 0),
(65, 'line_3_e.', '123456', 'END-3', 4, 0, 19, 1, '', 0),
(66, 'line_3_m.', '123456', 'MID-3', 3, 0, 19, 1, '', 0),
(67, 'line_3_b.', '123456', 'INPUT-3', 2, 0, 19, 1, '', 0),
(68, 'line_3_cc.', '123456', 'Collar-Cuff-3', 8, 0, 19, 1, '', 0),
(69, 'line_4_cc.', '123456', 'Collar-Cuff-4', 8, 0, 20, 1, '', 0),
(70, 'line_4_b.', '123456', 'INPUT-4', 2, 0, 20, 1, '', 0),
(71, 'line_4_m.', '123456', 'MID-4', 3, 0, 20, 1, '', 0),
(72, 'line_4_e.', '123456', 'END-4', 4, 0, 20, 1, '', 0),
(73, 'line_5_e.', '123456', 'END-5', 4, 0, 21, 1, '', 0),
(74, 'line_5_m.', '123456', 'MID-5', 3, 0, 21, 1, '', 0),
(75, 'line_5_b.', '123456', 'INPUT-5', 2, 0, 21, 1, '', 0),
(76, 'line_5_cc.', '123456', 'Collar-Cuff-5', 8, 0, 21, 1, '', 0),
(77, 'line_6_cc.', '123456', 'Collar-Cuff-6', 8, 0, 22, 1, '', 0),
(78, 'line_6_b.', '123456', 'INPUT-6', 2, 0, 22, 1, '', 0),
(79, 'line_6_m.', '123456', 'MID-6', 3, 0, 22, 1, '', 0),
(80, 'line_6_e.', '123456', 'END-6', 4, 0, 22, 1, '', 0),
(81, 'line_7_e.', '123456', 'END-7', 4, 0, 23, 1, '', 0),
(82, 'line_7_m.', '123456', 'MID-7', 3, 0, 23, 1, '', 0),
(83, 'line_7_b.', '123456', 'INPUT-7', 2, 0, 23, 1, '', 0),
(84, 'line_7_cc.', '123456', 'Collar-Cuff-7', 8, 0, 23, 1, '', 0),
(85, 'line_8_cc.', '123456', 'Collar-Cuff-8', 8, 0, 24, 1, '', 0),
(86, 'line_8_b.', '123456', 'INPUT-8', 2, 0, 24, 1, '', 0),
(87, 'line_8_m.', '123456', 'MID-8', 3, 0, 24, 1, '', 0),
(88, 'line_8_e.', '123456', 'END-8', 4, 0, 24, 1, '', 0),
(89, 'packing_4.', '123456', 'PACKING', 7, 2, 0, 1, '\'OLYMP\'', 0),
(90, 'floor_2.', '123456', 'FLOOR-2', 100, 0, 0, 1, '', 0),
(91, 'sd_olymp.', '123456', 'SD', 400, 0, 0, 1, '', 0),
(92, 'opr_3.', '123456', 'OPR-3', 200, 3, 0, 1, '', 0),
(93, 'Faiaz001.', '123456', 'Faiaz', 500, 0, 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_warehouse_type`
--

CREATE TABLE `tb_warehouse_type` (
  `id` int(11) NOT NULL,
  `warehouse_type` varchar(255) NOT NULL,
  `warehouse_code` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_warehouse_type`
--

INSERT INTO `tb_warehouse_type` (`id`, `warehouse_type`, `warehouse_code`, `Description`) VALUES
(1, 'Warehouse Buyer', 'wb00001.', 'Warehouse Buyer'),
(2, 'Warehouse Factory', 'wf00002.', 'Warehouse Factory'),
(3, 'Warehouse Trash', 'wt00003.', 'Warehouse Trash'),
(4, 'Warehouse Production Sample', 'wp00004.', 'Warehouse Production Sample'),
(5, 'Others', 'wp00005.', 'Others'),
(6, 'Lost', 'wp00006.', 'Lost'),
(7, 'Size Set', 'wp00007.', 'Size Set');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_carton`
-- (See below for the actual view)
--
CREATE TABLE `vt_carton` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`count_carton_pass` bigint(21)
,`max_carton_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_curdate_line_target`
-- (See below for the actual view)
--
CREATE TABLE `vt_curdate_line_target` (
`id` int(11)
,`line_id` int(11)
,`target` int(11)
,`target_hour` int(11)
,`man_power_1` int(11)
,`man_power_2` int(11)
,`man_power_3` int(11)
,`man_power_4` int(11)
,`date` date
,`remarks` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut` (
`id` int(11)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`brand` varchar(255)
,`bundle` int(11)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_tracking_no` varchar(255)
,`cut_table` varchar(255)
,`size` varchar(255)
,`cut_qty` int(11)
,`planned_cut_qty` int(11)
,`cut_layer` int(11)
,`bundle_range` varchar(255)
,`bundle_range_start` int(11)
,`bundle_range_end` int(11)
,`pc_no_start` varchar(255)
,`pc_no_end` varchar(255)
,`u_id` varchar(255)
,`date_time` datetime
,`po_type` int(11)
,`planned_line_id` int(11)
,`line_id` int(11)
,`is_bundle_collar_cuff_scanned_line` int(11)
,`bundle_collar_cuff_scanned_line_date_time` datetime
,`is_bundle_collar_scanned_line` int(11)
,`bundle_collar_scanned_datetime` datetime
,`is_bundle_cuff_scanned_line` int(11)
,`bundle_cuff_scanned_datetime` datetime
,`is_care_label_printed` int(11)
,`is_collar_bundle_printed` int(11)
,`is_cuff_bundle_printed` int(11)
,`is_cutting_collar_bundle_ready` int(11)
,`cutting_collar_bundle_ready_date_time` datetime
,`is_cutting_cuff_bundle_ready` int(11)
,`cutting_cuff_bundle_ready_date_time` datetime
,`cutting_collar_cuff_bundle_last_action_date_time` datetime
,`bundle_start` int(11)
,`bundle_end` int(11)
,`total_cut_qty` decimal(32,0)
,`max_cutting_collar_cuff_bundle_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut_collar_bundle_scan`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut_collar_bundle_scan` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_collar_bundle_ready_date_time` datetime
,`count_cutting_collar_bundle_qty` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut_cuff_bundle_scan`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut_cuff_bundle_scan` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_cuff_bundle_ready_date_time` datetime
,`count_cutting_cuff_bundle_qty` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut_pass` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`total_cut_input_qty` bigint(21)
,`max_sent_to_production_date_time` datetime
,`min_care_label` bigint(21) unsigned
,`max_care_label` bigint(21) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut_summary`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut_summary` (
`id` int(11)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`brand` varchar(255)
,`bundle` int(11)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_tracking_no` varchar(255)
,`cut_table` varchar(255)
,`size` varchar(255)
,`cut_qty` int(11)
,`planned_cut_qty` int(11)
,`cut_layer` int(11)
,`bundle_range` varchar(255)
,`bundle_range_start` int(11)
,`bundle_range_end` int(11)
,`pc_no_start` varchar(255)
,`pc_no_end` varchar(255)
,`u_id` varchar(255)
,`date_time` datetime
,`po_type` int(11)
,`planned_line_id` int(11)
,`line_id` int(11)
,`package_sent_to_production` int(11)
,`package_sent_to_production_date_time` datetime
,`is_bundle_collar_cuff_scanned_line` int(11)
,`bundle_collar_cuff_scanned_line_date_time` datetime
,`is_bundle_collar_scanned_line` int(11)
,`bundle_collar_scanned_datetime` datetime
,`is_bundle_cuff_scanned_line` int(11)
,`bundle_cuff_scanned_datetime` datetime
,`is_care_label_printed` int(11)
,`is_collar_bundle_printed` int(11)
,`is_cuff_bundle_printed` int(11)
,`is_cutting_collar_bundle_ready` int(11)
,`cutting_collar_bundle_ready_date_time` datetime
,`is_cutting_cuff_bundle_ready` int(11)
,`cutting_cuff_bundle_ready_date_time` datetime
,`cutting_collar_cuff_bundle_last_action_date_time` datetime
,`is_cutting_back_bundle_ready` int(11)
,`cutting_back_bundle_ready_date_time` datetime
,`is_cutting_yoke_bundle_ready` int(11)
,`cutting_yoke_bundle_ready_date_time` datetime
,`is_cutting_sleeve_bundle_ready` int(11)
,`cutting_sleeve_bundle_ready_date_time` datetime
,`is_cutting_sleeve_plkt_bundle_ready` int(11)
,`cutting_sleeve_plkt_bundle_ready_date_time` datetime
,`is_cutting_pocket_bundle_ready` int(11)
,`cutting_pocket_bundle_ready_date_time` datetime
,`is_package_ready` int(11)
,`package_ready_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_cut_summary_cutting_dept`
-- (See below for the actual view)
--
CREATE TABLE `vt_cut_summary_cutting_dept` (
`id` int(11)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`brand` varchar(255)
,`bundle` int(11)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_tracking_no` varchar(255)
,`cut_table` varchar(255)
,`size` varchar(255)
,`cut_qty` int(11)
,`planned_cut_qty` int(11)
,`cut_layer` int(11)
,`bundle_range` varchar(255)
,`bundle_range_start` int(11)
,`bundle_range_end` int(11)
,`pc_no_start` varchar(255)
,`pc_no_end` varchar(255)
,`u_id` varchar(255)
,`date_time` datetime
,`po_type` int(11)
,`planned_line_id` int(11)
,`line_id` int(11)
,`is_bundle_collar_cuff_scanned_line` int(11)
,`bundle_collar_cuff_scanned_line_date_time` datetime
,`is_bundle_collar_scanned_line` int(11)
,`bundle_collar_scanned_datetime` datetime
,`is_bundle_cuff_scanned_line` int(11)
,`bundle_cuff_scanned_datetime` datetime
,`is_care_label_printed` int(11)
,`is_collar_bundle_printed` int(11)
,`is_cuff_bundle_printed` int(11)
,`is_cutting_collar_bundle_ready` int(11)
,`cutting_collar_bundle_ready_date_time` datetime
,`is_cutting_cuff_bundle_ready` int(11)
,`cutting_cuff_bundle_ready_date_time` datetime
,`cutting_collar_cuff_bundle_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_end_line_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_end_line_pass` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`line_id` int(11)
,`count_end_line_qc_pass` bigint(21)
,`max_end_line_qc_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_few_days_carton`
-- (See below for the actual view)
--
CREATE TABLE `vt_few_days_carton` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_few_days_cut_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_few_days_cut_pass` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_few_days_line_end_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_few_days_line_end_pass` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`season_id` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_few_days_packing`
-- (See below for the actual view)
--
CREATE TABLE `vt_few_days_packing` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`season_id` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_few_days_po_pcs`
-- (See below for the actual view)
--
CREATE TABLE `vt_few_days_po_pcs` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`po_type` int(11)
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`is_reprint_allow` int(11)
,`reprint_allow_date_time` datetime
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`finishing_alter_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_sizeset_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`season_id` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
,`is_package_ready` int(11)
,`package_ready_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_input_line`
-- (See below for the actual view)
--
CREATE TABLE `vt_input_line` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`line_id` int(11)
,`count_input_qty_line` bigint(21)
,`max_line_input_date_time` datetime
,`min_line_input_date_time` datetime
,`min_care_label` bigint(21) unsigned
,`max_care_label` bigint(21) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_line_wip`
-- (See below for the actual view)
--
CREATE TABLE `vt_line_wip` (
`line_id` int(11)
,`count_wip_qty_line` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_mid_line_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_mid_line_pass` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`line_id` int(11)
,`count_mid_line_qc_pass` bigint(21)
,`max_mid_line_qc_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_packing`
-- (See below for the actual view)
--
CREATE TABLE `vt_packing` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`color` varchar(255)
,`count_packing_pass` bigint(21)
,`max_packing_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_po_detail`
-- (See below for the actual view)
--
CREATE TABLE `vt_po_detail` (
`id` int(11)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`brand` varchar(255)
,`item` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`smv` float
,`quantity` int(11)
,`size` varchar(255)
,`ex_factory_date` date
,`created_on` date
,`changed_on` date
,`u_id` int(11)
,`wash_gmt` int(11)
,`is_manual_upload` int(11)
,`upload_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_po_detail_cutting_dept`
-- (See below for the actual view)
--
CREATE TABLE `vt_po_detail_cutting_dept` (
`id` int(11)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`brand` varchar(255)
,`item` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`smv` float
,`quantity` int(11)
,`size` varchar(255)
,`ex_factory_date` date
,`created_on` date
,`changed_on` date
,`u_id` int(11)
,`wash_gmt` int(11)
,`is_manual_upload` int(11)
,`upload_date` date
,`status` varchar(255)
,`po_type` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_po_summary`
-- (See below for the actual view)
--
CREATE TABLE `vt_po_summary` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`ex_factory_date` date
,`smv` float
,`wash_gmt` int(11)
,`total_order_qty` decimal(32,0)
,`status` varchar(255)
,`po_type` int(11)
,`aql_plan_date` date
,`aql_status` int(11)
,`aql_action_date` date
,`aql_remarks` varchar(255)
,`aql_action_by` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_running_po_pcs`
-- (See below for the actual view)
--
CREATE TABLE `vt_running_po_pcs` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`po_type` int(11)
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`is_reprint_allow` int(11)
,`reprint_allow_date_time` datetime
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`package_sent_to_production` int(11)
,`package_sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`finishing_alter_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_sizeset_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`season_id` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
,`is_package_ready` int(11)
,`package_ready_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_sew_collar_bundle_scan`
-- (See below for the actual view)
--
CREATE TABLE `vt_sew_collar_bundle_scan` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`line_id` int(11)
,`max_bundle_collar_scanned_datetime` datetime
,`count_collar_bundle_qty` decimal(32,0)
,`max_bundle_collar_cuff_scanned_line_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_sew_cuff_bundle_scan`
-- (See below for the actual view)
--
CREATE TABLE `vt_sew_cuff_bundle_scan` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`line_id` int(11)
,`max_bundle_cuff_scanned_datetime` datetime
,`count_cuff_bundle_qty` decimal(32,0)
,`max_bundle_collar_cuff_scanned_line_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_today_line_end_pass`
-- (See below for the actual view)
--
CREATE TABLE `vt_today_line_end_pass` (
`id` int(11)
,`pc_tracking_no` varchar(255)
,`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`brand` varchar(255)
,`size` varchar(255)
,`color` varchar(255)
,`ex_factory_date` date
,`cut_table` varchar(255)
,`cut_no` varchar(255)
,`cut_tracking_no` varchar(255)
,`bundle_no` int(11)
,`bundle_tracking_no` varchar(255)
,`bundle_range` varchar(255)
,`layer_group` int(11)
,`is_wash_gmt` int(11)
,`date_time` datetime
,`planned_line_id` int(11)
,`sent_to_production` int(11)
,`sent_to_production_date_time` datetime
,`is_printed` int(11)
,`printing_date_time` datetime
,`line_id` int(11)
,`finishing_floor_id` int(11)
,`access_points` int(11)
,`access_points_status` int(11)
,`line_input_date_time` datetime
,`mid_line_qc_date_time` datetime
,`end_line_qc_date_time` datetime
,`is_going_wash` int(11)
,`going_wash_scan_date_time` datetime
,`wash_going_printed` int(11)
,`wash_going_print_date_time` datetime
,`finishing_qc_status` int(11)
,`finishing_qc_date_time` datetime
,`washing_status` int(11)
,`washing_date_time` datetime
,`packing_status` int(11)
,`packing_date_time` datetime
,`carton_status` int(11)
,`carton_date_time` datetime
,`warehouse_qa_type` int(11)
,`warehouse_buyer_date_time` datetime
,`warehouse_factory_date_time` datetime
,`warehouse_trash_date_time` datetime
,`warehouse_production_sample_date_time` datetime
,`warehouse_other_purpose_date_time` datetime
,`warehouse_last_action_date_time` datetime
,`warehouse_qa_by` int(11)
,`season_id` int(11)
,`other_purpose_remarks` varchar(255)
,`other_purpose_liable_person` varchar(255)
,`lost_date_time` datetime
,`manually_closed` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_upcoming_pos`
-- (See below for the actual view)
--
CREATE TABLE `vt_upcoming_pos` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`planned_line_id` int(11)
,`line_id` int(11)
,`min_sent_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wash_return`
-- (See below for the actual view)
--
CREATE TABLE `vt_wash_return` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`count_washing_pass` bigint(21)
,`max_washing_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wash_send`
-- (See below for the actual view)
--
CREATE TABLE `vt_wash_send` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`brand` varchar(255)
,`style_no` varchar(255)
,`style_name` varchar(255)
,`count_washing_qty` bigint(21)
,`max_going_wash_scan_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_buyer`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_buyer` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_buyer_date_time` datetime
,`count_wh_buyer` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_factory`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_factory` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_factory_date_time` datetime
,`count_wh_factory` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_lost`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_lost` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_lost_date_time` datetime
,`count_wh_lost` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_others`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_others` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_other_purpose_date_time` datetime
,`count_wh_others` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_prod_sample`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_prod_sample` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_production_sample_date_time` datetime
,`count_wh_prod_sample` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_size_set`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_size_set` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_sizeset_date_time` datetime
,`count_wh_size_set` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt_wh_trash`
-- (See below for the actual view)
--
CREATE TABLE `vt_wh_trash` (
`po_no` varchar(255)
,`so_no` varchar(255)
,`purchase_order` varchar(255)
,`item` varchar(255)
,`brand` varchar(255)
,`quality` varchar(255)
,`color` varchar(255)
,`max_warehouse_trash_date_time` datetime
,`count_wh_trash` bigint(21)
,`max_warehouse_last_action_date_time` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `vt_carton`
--
DROP TABLE IF EXISTS `vt_carton`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_carton`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_carton_pass`,max(`tb_care_labels`.`carton_date_time`) AS `max_carton_date_time` from `tb_care_labels` where ((`tb_care_labels`.`carton_status` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_curdate_line_target`
--
DROP TABLE IF EXISTS `vt_curdate_line_target`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_curdate_line_target`  AS  select `line_daily_target`.`id` AS `id`,`line_daily_target`.`line_id` AS `line_id`,`line_daily_target`.`target` AS `target`,`line_daily_target`.`target_hour` AS `target_hour`,`line_daily_target`.`man_power_1` AS `man_power_1`,`line_daily_target`.`man_power_2` AS `man_power_2`,`line_daily_target`.`man_power_3` AS `man_power_3`,`line_daily_target`.`man_power_4` AS `man_power_4`,`line_daily_target`.`date` AS `date`,`line_daily_target`.`remarks` AS `remarks` from `line_daily_target` where (`line_daily_target`.`date` = curdate()) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut`
--
DROP TABLE IF EXISTS `vt_cut`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut`  AS  select `tb_cut_summary`.`id` AS `id`,`tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`style_no` AS `style_no`,`tb_cut_summary`.`style_name` AS `style_name`,`tb_cut_summary`.`color` AS `color`,`tb_cut_summary`.`ex_factory_date` AS `ex_factory_date`,`tb_cut_summary`.`brand` AS `brand`,`tb_cut_summary`.`bundle` AS `bundle`,`tb_cut_summary`.`cut_no` AS `cut_no`,`tb_cut_summary`.`cut_tracking_no` AS `cut_tracking_no`,`tb_cut_summary`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_cut_summary`.`cut_table` AS `cut_table`,`tb_cut_summary`.`size` AS `size`,`tb_cut_summary`.`cut_qty` AS `cut_qty`,`tb_cut_summary`.`planned_cut_qty` AS `planned_cut_qty`,`tb_cut_summary`.`cut_layer` AS `cut_layer`,`tb_cut_summary`.`bundle_range` AS `bundle_range`,`tb_cut_summary`.`bundle_range_start` AS `bundle_range_start`,`tb_cut_summary`.`bundle_range_end` AS `bundle_range_end`,`tb_cut_summary`.`pc_no_start` AS `pc_no_start`,`tb_cut_summary`.`pc_no_end` AS `pc_no_end`,`tb_cut_summary`.`u_id` AS `u_id`,`tb_cut_summary`.`date_time` AS `date_time`,`tb_cut_summary`.`po_type` AS `po_type`,`tb_cut_summary`.`planned_line_id` AS `planned_line_id`,`tb_cut_summary`.`line_id` AS `line_id`,`tb_cut_summary`.`is_bundle_collar_cuff_scanned_line` AS `is_bundle_collar_cuff_scanned_line`,`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time` AS `bundle_collar_cuff_scanned_line_date_time`,`tb_cut_summary`.`is_bundle_collar_scanned_line` AS `is_bundle_collar_scanned_line`,`tb_cut_summary`.`bundle_collar_scanned_datetime` AS `bundle_collar_scanned_datetime`,`tb_cut_summary`.`is_bundle_cuff_scanned_line` AS `is_bundle_cuff_scanned_line`,`tb_cut_summary`.`bundle_cuff_scanned_datetime` AS `bundle_cuff_scanned_datetime`,`tb_cut_summary`.`is_care_label_printed` AS `is_care_label_printed`,`tb_cut_summary`.`is_collar_bundle_printed` AS `is_collar_bundle_printed`,`tb_cut_summary`.`is_cuff_bundle_printed` AS `is_cuff_bundle_printed`,`tb_cut_summary`.`is_cutting_collar_bundle_ready` AS `is_cutting_collar_bundle_ready`,`tb_cut_summary`.`cutting_collar_bundle_ready_date_time` AS `cutting_collar_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_cuff_bundle_ready` AS `is_cutting_cuff_bundle_ready`,`tb_cut_summary`.`cutting_cuff_bundle_ready_date_time` AS `cutting_cuff_bundle_ready_date_time`,`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time` AS `cutting_collar_cuff_bundle_last_action_date_time`,min(`tb_cut_summary`.`bundle`) AS `bundle_start`,max(`tb_cut_summary`.`bundle`) AS `bundle_end`,sum(`tb_cut_summary`.`cut_qty`) AS `total_cut_qty`,max(`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time`) AS `max_cutting_collar_cuff_bundle_last_action_date_time` from `tb_cut_summary` where (1 and (date_format(`tb_cut_summary`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 90 day))) group by `tb_cut_summary`.`po_no`,`tb_cut_summary`.`so_no`,`tb_cut_summary`.`purchase_order`,`tb_cut_summary`.`item`,`tb_cut_summary`.`quality`,`tb_cut_summary`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut_collar_bundle_scan`
--
DROP TABLE IF EXISTS `vt_cut_collar_bundle_scan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut_collar_bundle_scan`  AS  select `tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`color` AS `color`,max(`tb_cut_summary`.`cutting_collar_bundle_ready_date_time`) AS `max_collar_bundle_ready_date_time`,sum(`tb_cut_summary`.`cut_qty`) AS `count_cutting_collar_bundle_qty` from `tb_cut_summary` where ((`tb_cut_summary`.`is_cutting_collar_bundle_ready` = 1) and (date_format(`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time`,'%Y-%m-%d') between (curdate() - interval 30 day) and (curdate() + interval 90 day))) group by `tb_cut_summary`.`po_no`,`tb_cut_summary`.`so_no`,`tb_cut_summary`.`purchase_order`,`tb_cut_summary`.`item`,`tb_cut_summary`.`quality`,`tb_cut_summary`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut_cuff_bundle_scan`
--
DROP TABLE IF EXISTS `vt_cut_cuff_bundle_scan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut_cuff_bundle_scan`  AS  select `tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`color` AS `color`,max(`tb_cut_summary`.`cutting_cuff_bundle_ready_date_time`) AS `max_cuff_bundle_ready_date_time`,sum(`tb_cut_summary`.`cut_qty`) AS `count_cutting_cuff_bundle_qty` from `tb_cut_summary` where ((`tb_cut_summary`.`is_cutting_cuff_bundle_ready` = 1) and (date_format(`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time`,'%Y-%m-%d') between (curdate() - interval 30 day) and (curdate() + interval 90 day))) group by `tb_cut_summary`.`po_no`,`tb_cut_summary`.`so_no`,`tb_cut_summary`.`purchase_order`,`tb_cut_summary`.`item`,`tb_cut_summary`.`quality`,`tb_cut_summary`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut_pass`
--
DROP TABLE IF EXISTS `vt_cut_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut_pass`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,count(`tb_care_labels`.`id`) AS `total_cut_input_qty`,max(`tb_care_labels`.`sent_to_production_date_time`) AS `max_sent_to_production_date_time`,min(cast(`tb_care_labels`.`pc_tracking_no` as unsigned)) AS `min_care_label`,max(cast(`tb_care_labels`.`pc_tracking_no` as unsigned)) AS `max_care_label` from `tb_care_labels` where ((`tb_care_labels`.`sent_to_production` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut_summary`
--
DROP TABLE IF EXISTS `vt_cut_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut_summary`  AS  select `tb_cut_summary`.`id` AS `id`,`tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`style_no` AS `style_no`,`tb_cut_summary`.`style_name` AS `style_name`,`tb_cut_summary`.`color` AS `color`,`tb_cut_summary`.`ex_factory_date` AS `ex_factory_date`,`tb_cut_summary`.`brand` AS `brand`,`tb_cut_summary`.`bundle` AS `bundle`,`tb_cut_summary`.`cut_no` AS `cut_no`,`tb_cut_summary`.`cut_tracking_no` AS `cut_tracking_no`,`tb_cut_summary`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_cut_summary`.`cut_table` AS `cut_table`,`tb_cut_summary`.`size` AS `size`,`tb_cut_summary`.`cut_qty` AS `cut_qty`,`tb_cut_summary`.`planned_cut_qty` AS `planned_cut_qty`,`tb_cut_summary`.`cut_layer` AS `cut_layer`,`tb_cut_summary`.`bundle_range` AS `bundle_range`,`tb_cut_summary`.`bundle_range_start` AS `bundle_range_start`,`tb_cut_summary`.`bundle_range_end` AS `bundle_range_end`,`tb_cut_summary`.`pc_no_start` AS `pc_no_start`,`tb_cut_summary`.`pc_no_end` AS `pc_no_end`,`tb_cut_summary`.`u_id` AS `u_id`,`tb_cut_summary`.`date_time` AS `date_time`,`tb_cut_summary`.`po_type` AS `po_type`,`tb_cut_summary`.`planned_line_id` AS `planned_line_id`,`tb_cut_summary`.`line_id` AS `line_id`,`tb_cut_summary`.`package_sent_to_production` AS `package_sent_to_production`,`tb_cut_summary`.`package_sent_to_production_date_time` AS `package_sent_to_production_date_time`,`tb_cut_summary`.`is_bundle_collar_cuff_scanned_line` AS `is_bundle_collar_cuff_scanned_line`,`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time` AS `bundle_collar_cuff_scanned_line_date_time`,`tb_cut_summary`.`is_bundle_collar_scanned_line` AS `is_bundle_collar_scanned_line`,`tb_cut_summary`.`bundle_collar_scanned_datetime` AS `bundle_collar_scanned_datetime`,`tb_cut_summary`.`is_bundle_cuff_scanned_line` AS `is_bundle_cuff_scanned_line`,`tb_cut_summary`.`bundle_cuff_scanned_datetime` AS `bundle_cuff_scanned_datetime`,`tb_cut_summary`.`is_care_label_printed` AS `is_care_label_printed`,`tb_cut_summary`.`is_collar_bundle_printed` AS `is_collar_bundle_printed`,`tb_cut_summary`.`is_cuff_bundle_printed` AS `is_cuff_bundle_printed`,`tb_cut_summary`.`is_cutting_collar_bundle_ready` AS `is_cutting_collar_bundle_ready`,`tb_cut_summary`.`cutting_collar_bundle_ready_date_time` AS `cutting_collar_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_cuff_bundle_ready` AS `is_cutting_cuff_bundle_ready`,`tb_cut_summary`.`cutting_cuff_bundle_ready_date_time` AS `cutting_cuff_bundle_ready_date_time`,`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time` AS `cutting_collar_cuff_bundle_last_action_date_time`,`tb_cut_summary`.`is_cutting_back_bundle_ready` AS `is_cutting_back_bundle_ready`,`tb_cut_summary`.`cutting_back_bundle_ready_date_time` AS `cutting_back_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_yoke_bundle_ready` AS `is_cutting_yoke_bundle_ready`,`tb_cut_summary`.`cutting_yoke_bundle_ready_date_time` AS `cutting_yoke_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_sleeve_bundle_ready` AS `is_cutting_sleeve_bundle_ready`,`tb_cut_summary`.`cutting_sleeve_bundle_ready_date_time` AS `cutting_sleeve_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_sleeve_plkt_bundle_ready` AS `is_cutting_sleeve_plkt_bundle_ready`,`tb_cut_summary`.`cutting_sleeve_plkt_bundle_ready_date_time` AS `cutting_sleeve_plkt_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_pocket_bundle_ready` AS `is_cutting_pocket_bundle_ready`,`tb_cut_summary`.`cutting_pocket_bundle_ready_date_time` AS `cutting_pocket_bundle_ready_date_time`,`tb_cut_summary`.`is_package_ready` AS `is_package_ready`,`tb_cut_summary`.`package_ready_date_time` AS `package_ready_date_time` from `tb_cut_summary` where (`tb_cut_summary`.`ex_factory_date` between (curdate() - interval 45 day) and (curdate() + interval 90 day)) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_cut_summary_cutting_dept`
--
DROP TABLE IF EXISTS `vt_cut_summary_cutting_dept`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_cut_summary_cutting_dept`  AS  select `tb_cut_summary`.`id` AS `id`,`tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`style_no` AS `style_no`,`tb_cut_summary`.`style_name` AS `style_name`,`tb_cut_summary`.`color` AS `color`,`tb_cut_summary`.`ex_factory_date` AS `ex_factory_date`,`tb_cut_summary`.`brand` AS `brand`,`tb_cut_summary`.`bundle` AS `bundle`,`tb_cut_summary`.`cut_no` AS `cut_no`,`tb_cut_summary`.`cut_tracking_no` AS `cut_tracking_no`,`tb_cut_summary`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_cut_summary`.`cut_table` AS `cut_table`,`tb_cut_summary`.`size` AS `size`,`tb_cut_summary`.`cut_qty` AS `cut_qty`,`tb_cut_summary`.`planned_cut_qty` AS `planned_cut_qty`,`tb_cut_summary`.`cut_layer` AS `cut_layer`,`tb_cut_summary`.`bundle_range` AS `bundle_range`,`tb_cut_summary`.`bundle_range_start` AS `bundle_range_start`,`tb_cut_summary`.`bundle_range_end` AS `bundle_range_end`,`tb_cut_summary`.`pc_no_start` AS `pc_no_start`,`tb_cut_summary`.`pc_no_end` AS `pc_no_end`,`tb_cut_summary`.`u_id` AS `u_id`,`tb_cut_summary`.`date_time` AS `date_time`,`tb_cut_summary`.`po_type` AS `po_type`,`tb_cut_summary`.`planned_line_id` AS `planned_line_id`,`tb_cut_summary`.`line_id` AS `line_id`,`tb_cut_summary`.`is_bundle_collar_cuff_scanned_line` AS `is_bundle_collar_cuff_scanned_line`,`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time` AS `bundle_collar_cuff_scanned_line_date_time`,`tb_cut_summary`.`is_bundle_collar_scanned_line` AS `is_bundle_collar_scanned_line`,`tb_cut_summary`.`bundle_collar_scanned_datetime` AS `bundle_collar_scanned_datetime`,`tb_cut_summary`.`is_bundle_cuff_scanned_line` AS `is_bundle_cuff_scanned_line`,`tb_cut_summary`.`bundle_cuff_scanned_datetime` AS `bundle_cuff_scanned_datetime`,`tb_cut_summary`.`is_care_label_printed` AS `is_care_label_printed`,`tb_cut_summary`.`is_collar_bundle_printed` AS `is_collar_bundle_printed`,`tb_cut_summary`.`is_cuff_bundle_printed` AS `is_cuff_bundle_printed`,`tb_cut_summary`.`is_cutting_collar_bundle_ready` AS `is_cutting_collar_bundle_ready`,`tb_cut_summary`.`cutting_collar_bundle_ready_date_time` AS `cutting_collar_bundle_ready_date_time`,`tb_cut_summary`.`is_cutting_cuff_bundle_ready` AS `is_cutting_cuff_bundle_ready`,`tb_cut_summary`.`cutting_cuff_bundle_ready_date_time` AS `cutting_cuff_bundle_ready_date_time`,`tb_cut_summary`.`cutting_collar_cuff_bundle_last_action_date_time` AS `cutting_collar_cuff_bundle_last_action_date_time` from `tb_cut_summary` where (`tb_cut_summary`.`ex_factory_date` between (curdate() - interval 75 day) and (curdate() + interval 90 day)) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_end_line_pass`
--
DROP TABLE IF EXISTS `vt_end_line_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_end_line_pass`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`line_id` AS `line_id`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_end_line_qc_pass`,max(`tb_care_labels`.`end_line_qc_date_time`) AS `max_end_line_qc_date_time` from `tb_care_labels` where ((`tb_care_labels`.`line_id` <> 0) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day)) and (`tb_care_labels`.`access_points` = 4) and (`tb_care_labels`.`access_points_status` = 4)) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color`,`tb_care_labels`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_few_days_carton`
--
DROP TABLE IF EXISTS `vt_few_days_carton`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_few_days_carton`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed` from `tb_care_labels` where ((`tb_care_labels`.`finishing_floor_id` <> 0) and (`tb_care_labels`.`carton_status` = 1) and (date_format(`tb_care_labels`.`carton_date_time`,'%Y-%m-%d') between (curdate() - interval 3 day) and curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_few_days_cut_pass`
--
DROP TABLE IF EXISTS `vt_few_days_cut_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_few_days_cut_pass`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed` from `tb_care_labels` where ((`tb_care_labels`.`sent_to_production` = 1) and (date_format(`tb_care_labels`.`sent_to_production_date_time`,'%Y-%m-%d') between (curdate() - interval 3 day) and curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_few_days_line_end_pass`
--
DROP TABLE IF EXISTS `vt_few_days_line_end_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_few_days_line_end_pass`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`ex_factory_date` AS `ex_factory_date`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`season_id` AS `season_id`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed` from `tb_care_labels` where ((`tb_care_labels`.`access_points` = 4) and (`tb_care_labels`.`access_points_status` = 4) and (date_format(`tb_care_labels`.`end_line_qc_date_time`,'%Y-%m-%d') between (curdate() - interval 3 day) and curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_few_days_packing`
--
DROP TABLE IF EXISTS `vt_few_days_packing`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_few_days_packing`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`ex_factory_date` AS `ex_factory_date`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`season_id` AS `season_id`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed` from `tb_care_labels` where ((`tb_care_labels`.`finishing_floor_id` <> 0) and (`tb_care_labels`.`packing_status` = 1) and (date_format(`tb_care_labels`.`packing_date_time`,'%Y-%m-%d') between (curdate() - interval 3 day) and curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_few_days_po_pcs`
--
DROP TABLE IF EXISTS `vt_few_days_po_pcs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_few_days_po_pcs`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`ex_factory_date` AS `ex_factory_date`,`tb_care_labels`.`po_type` AS `po_type`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`is_reprint_allow` AS `is_reprint_allow`,`tb_care_labels`.`reprint_allow_date_time` AS `reprint_allow_date_time`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`finishing_alter_date_time` AS `finishing_alter_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_sizeset_date_time` AS `warehouse_sizeset_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`season_id` AS `season_id`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed`,`tb_care_labels`.`is_package_ready` AS `is_package_ready`,`tb_care_labels`.`package_ready_date_time` AS `package_ready_date_time` from `tb_care_labels` where (1 and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 90 day) and (curdate() + interval 90 day))) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_input_line`
--
DROP TABLE IF EXISTS `vt_input_line`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_input_line`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`line_id` AS `line_id`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_input_qty_line`,max(`tb_care_labels`.`line_input_date_time`) AS `max_line_input_date_time`,min(`tb_care_labels`.`line_input_date_time`) AS `min_line_input_date_time`,min(cast(`tb_care_labels`.`pc_tracking_no` as unsigned)) AS `min_care_label`,max(cast(`tb_care_labels`.`pc_tracking_no` as unsigned)) AS `max_care_label` from `tb_care_labels` where ((`tb_care_labels`.`line_id` <> 0) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color`,`tb_care_labels`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_line_wip`
--
DROP TABLE IF EXISTS `vt_line_wip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_line_wip`  AS  select `tb_care_labels`.`line_id` AS `line_id`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wip_qty_line` from `tb_care_labels` where ((`tb_care_labels`.`line_id` <> 0) and (`tb_care_labels`.`access_points_status` < 4)) group by `tb_care_labels`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_mid_line_pass`
--
DROP TABLE IF EXISTS `vt_mid_line_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_mid_line_pass`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`line_id` AS `line_id`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_mid_line_qc_pass`,max(`tb_care_labels`.`mid_line_qc_date_time`) AS `max_mid_line_qc_date_time` from `tb_care_labels` where ((`tb_care_labels`.`line_id` <> 0) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day)) and (`tb_care_labels`.`access_points` >= 3) and (`tb_care_labels`.`access_points_status` in (1,2,3,4))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color`,`tb_care_labels`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_packing`
--
DROP TABLE IF EXISTS `vt_packing`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_packing`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`color` AS `color`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_packing_pass`,max(`tb_care_labels`.`packing_date_time`) AS `max_packing_date_time` from `tb_care_labels` where ((`tb_care_labels`.`packing_status` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_po_detail`
--
DROP TABLE IF EXISTS `vt_po_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_po_detail`  AS  select `tb_po_detail`.`id` AS `id`,`tb_po_detail`.`po_no` AS `po_no`,`tb_po_detail`.`so_no` AS `so_no`,`tb_po_detail`.`purchase_order` AS `purchase_order`,`tb_po_detail`.`brand` AS `brand`,`tb_po_detail`.`item` AS `item`,`tb_po_detail`.`style_no` AS `style_no`,`tb_po_detail`.`style_name` AS `style_name`,`tb_po_detail`.`quality` AS `quality`,`tb_po_detail`.`color` AS `color`,`tb_po_detail`.`smv` AS `smv`,`tb_po_detail`.`quantity` AS `quantity`,`tb_po_detail`.`size` AS `size`,`tb_po_detail`.`ex_factory_date` AS `ex_factory_date`,`tb_po_detail`.`created_on` AS `created_on`,`tb_po_detail`.`changed_on` AS `changed_on`,`tb_po_detail`.`u_id` AS `u_id`,`tb_po_detail`.`wash_gmt` AS `wash_gmt`,`tb_po_detail`.`is_manual_upload` AS `is_manual_upload`,`tb_po_detail`.`upload_date` AS `upload_date` from `tb_po_detail` where (`tb_po_detail`.`ex_factory_date` between (curdate() - interval 45 day) and (curdate() + interval 60 day)) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_po_detail_cutting_dept`
--
DROP TABLE IF EXISTS `vt_po_detail_cutting_dept`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_po_detail_cutting_dept`  AS  select `tb_po_detail`.`id` AS `id`,`tb_po_detail`.`po_no` AS `po_no`,`tb_po_detail`.`so_no` AS `so_no`,`tb_po_detail`.`purchase_order` AS `purchase_order`,`tb_po_detail`.`brand` AS `brand`,`tb_po_detail`.`item` AS `item`,`tb_po_detail`.`style_no` AS `style_no`,`tb_po_detail`.`style_name` AS `style_name`,`tb_po_detail`.`quality` AS `quality`,`tb_po_detail`.`color` AS `color`,`tb_po_detail`.`smv` AS `smv`,`tb_po_detail`.`quantity` AS `quantity`,`tb_po_detail`.`size` AS `size`,`tb_po_detail`.`ex_factory_date` AS `ex_factory_date`,`tb_po_detail`.`created_on` AS `created_on`,`tb_po_detail`.`changed_on` AS `changed_on`,`tb_po_detail`.`u_id` AS `u_id`,`tb_po_detail`.`wash_gmt` AS `wash_gmt`,`tb_po_detail`.`is_manual_upload` AS `is_manual_upload`,`tb_po_detail`.`upload_date` AS `upload_date`,`tb_po_detail`.`status` AS `status`,`tb_po_detail`.`po_type` AS `po_type` from `tb_po_detail` where (`tb_po_detail`.`ex_factory_date` between (curdate() - interval 75 day) and (curdate() + interval 90 day)) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_po_summary`
--
DROP TABLE IF EXISTS `vt_po_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_po_summary`  AS  select `tb_po_detail`.`po_no` AS `po_no`,`tb_po_detail`.`so_no` AS `so_no`,`tb_po_detail`.`purchase_order` AS `purchase_order`,`tb_po_detail`.`item` AS `item`,`tb_po_detail`.`quality` AS `quality`,`tb_po_detail`.`color` AS `color`,`tb_po_detail`.`style_no` AS `style_no`,`tb_po_detail`.`style_name` AS `style_name`,`tb_po_detail`.`brand` AS `brand`,`tb_po_detail`.`ex_factory_date` AS `ex_factory_date`,`tb_po_detail`.`smv` AS `smv`,`tb_po_detail`.`wash_gmt` AS `wash_gmt`,sum(`tb_po_detail`.`quantity`) AS `total_order_qty`,`tb_po_detail`.`status` AS `status`,`tb_po_detail`.`po_type` AS `po_type`,`tb_po_detail`.`aql_plan_date` AS `aql_plan_date`,`tb_po_detail`.`aql_status` AS `aql_status`,`tb_po_detail`.`aql_action_date` AS `aql_action_date`,`tb_po_detail`.`aql_remarks` AS `aql_remarks`,`tb_po_detail`.`aql_action_by` AS `aql_action_by` from `tb_po_detail` where (date_format(`tb_po_detail`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day)) group by `tb_po_detail`.`po_no`,`tb_po_detail`.`so_no`,`tb_po_detail`.`purchase_order`,`tb_po_detail`.`item`,`tb_po_detail`.`quality`,`tb_po_detail`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_running_po_pcs`
--
DROP TABLE IF EXISTS `vt_running_po_pcs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_running_po_pcs`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`ex_factory_date` AS `ex_factory_date`,`tb_care_labels`.`po_type` AS `po_type`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`is_reprint_allow` AS `is_reprint_allow`,`tb_care_labels`.`reprint_allow_date_time` AS `reprint_allow_date_time`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`package_sent_to_production` AS `package_sent_to_production`,`tb_care_labels`.`package_sent_to_production_date_time` AS `package_sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`finishing_alter_date_time` AS `finishing_alter_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_sizeset_date_time` AS `warehouse_sizeset_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`season_id` AS `season_id`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed`,`tb_care_labels`.`is_package_ready` AS `is_package_ready`,`tb_care_labels`.`package_ready_date_time` AS `package_ready_date_time` from `tb_care_labels` where ((`tb_care_labels`.`carton_status` = 0) or (`tb_care_labels`.`warehouse_qa_type` in (0,1,2,4))) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_sew_collar_bundle_scan`
--
DROP TABLE IF EXISTS `vt_sew_collar_bundle_scan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_sew_collar_bundle_scan`  AS  select `tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`color` AS `color`,`tb_cut_summary`.`line_id` AS `line_id`,max(`tb_cut_summary`.`bundle_collar_scanned_datetime`) AS `max_bundle_collar_scanned_datetime`,sum(`tb_cut_summary`.`cut_qty`) AS `count_collar_bundle_qty`,max(`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time`) AS `max_bundle_collar_cuff_scanned_line_date_time` from `tb_cut_summary` where ((`tb_cut_summary`.`is_bundle_collar_scanned_line` = 1) and (date_format(`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time`,'%Y-%m-%d') between (curdate() - interval 30 day) and (curdate() + interval 90 day))) group by `tb_cut_summary`.`po_no`,`tb_cut_summary`.`so_no`,`tb_cut_summary`.`purchase_order`,`tb_cut_summary`.`item`,`tb_cut_summary`.`quality`,`tb_cut_summary`.`color`,`tb_cut_summary`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_sew_cuff_bundle_scan`
--
DROP TABLE IF EXISTS `vt_sew_cuff_bundle_scan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_sew_cuff_bundle_scan`  AS  select `tb_cut_summary`.`po_no` AS `po_no`,`tb_cut_summary`.`so_no` AS `so_no`,`tb_cut_summary`.`purchase_order` AS `purchase_order`,`tb_cut_summary`.`item` AS `item`,`tb_cut_summary`.`quality` AS `quality`,`tb_cut_summary`.`color` AS `color`,`tb_cut_summary`.`line_id` AS `line_id`,max(`tb_cut_summary`.`bundle_cuff_scanned_datetime`) AS `max_bundle_cuff_scanned_datetime`,sum(`tb_cut_summary`.`cut_qty`) AS `count_cuff_bundle_qty`,max(`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time`) AS `max_bundle_collar_cuff_scanned_line_date_time` from `tb_cut_summary` where ((`tb_cut_summary`.`is_bundle_cuff_scanned_line` = 1) and (date_format(`tb_cut_summary`.`bundle_collar_cuff_scanned_line_date_time`,'%Y-%m-%d') between (curdate() - interval 30 day) and (curdate() + interval 90 day))) group by `tb_cut_summary`.`po_no`,`tb_cut_summary`.`so_no`,`tb_cut_summary`.`purchase_order`,`tb_cut_summary`.`item`,`tb_cut_summary`.`quality`,`tb_cut_summary`.`color`,`tb_cut_summary`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_today_line_end_pass`
--
DROP TABLE IF EXISTS `vt_today_line_end_pass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_today_line_end_pass`  AS  select `tb_care_labels`.`id` AS `id`,`tb_care_labels`.`pc_tracking_no` AS `pc_tracking_no`,`tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`size` AS `size`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`ex_factory_date` AS `ex_factory_date`,`tb_care_labels`.`cut_table` AS `cut_table`,`tb_care_labels`.`cut_no` AS `cut_no`,`tb_care_labels`.`cut_tracking_no` AS `cut_tracking_no`,`tb_care_labels`.`bundle_no` AS `bundle_no`,`tb_care_labels`.`bundle_tracking_no` AS `bundle_tracking_no`,`tb_care_labels`.`bundle_range` AS `bundle_range`,`tb_care_labels`.`layer_group` AS `layer_group`,`tb_care_labels`.`is_wash_gmt` AS `is_wash_gmt`,`tb_care_labels`.`date_time` AS `date_time`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`sent_to_production` AS `sent_to_production`,`tb_care_labels`.`sent_to_production_date_time` AS `sent_to_production_date_time`,`tb_care_labels`.`is_printed` AS `is_printed`,`tb_care_labels`.`printing_date_time` AS `printing_date_time`,`tb_care_labels`.`line_id` AS `line_id`,`tb_care_labels`.`finishing_floor_id` AS `finishing_floor_id`,`tb_care_labels`.`access_points` AS `access_points`,`tb_care_labels`.`access_points_status` AS `access_points_status`,`tb_care_labels`.`line_input_date_time` AS `line_input_date_time`,`tb_care_labels`.`mid_line_qc_date_time` AS `mid_line_qc_date_time`,`tb_care_labels`.`end_line_qc_date_time` AS `end_line_qc_date_time`,`tb_care_labels`.`is_going_wash` AS `is_going_wash`,`tb_care_labels`.`going_wash_scan_date_time` AS `going_wash_scan_date_time`,`tb_care_labels`.`wash_going_printed` AS `wash_going_printed`,`tb_care_labels`.`wash_going_print_date_time` AS `wash_going_print_date_time`,`tb_care_labels`.`finishing_qc_status` AS `finishing_qc_status`,`tb_care_labels`.`finishing_qc_date_time` AS `finishing_qc_date_time`,`tb_care_labels`.`washing_status` AS `washing_status`,`tb_care_labels`.`washing_date_time` AS `washing_date_time`,`tb_care_labels`.`packing_status` AS `packing_status`,`tb_care_labels`.`packing_date_time` AS `packing_date_time`,`tb_care_labels`.`carton_status` AS `carton_status`,`tb_care_labels`.`carton_date_time` AS `carton_date_time`,`tb_care_labels`.`warehouse_qa_type` AS `warehouse_qa_type`,`tb_care_labels`.`warehouse_buyer_date_time` AS `warehouse_buyer_date_time`,`tb_care_labels`.`warehouse_factory_date_time` AS `warehouse_factory_date_time`,`tb_care_labels`.`warehouse_trash_date_time` AS `warehouse_trash_date_time`,`tb_care_labels`.`warehouse_production_sample_date_time` AS `warehouse_production_sample_date_time`,`tb_care_labels`.`warehouse_other_purpose_date_time` AS `warehouse_other_purpose_date_time`,`tb_care_labels`.`warehouse_last_action_date_time` AS `warehouse_last_action_date_time`,`tb_care_labels`.`warehouse_qa_by` AS `warehouse_qa_by`,`tb_care_labels`.`season_id` AS `season_id`,`tb_care_labels`.`other_purpose_remarks` AS `other_purpose_remarks`,`tb_care_labels`.`other_purpose_liable_person` AS `other_purpose_liable_person`,`tb_care_labels`.`lost_date_time` AS `lost_date_time`,`tb_care_labels`.`manually_closed` AS `manually_closed` from `tb_care_labels` where ((`tb_care_labels`.`access_points` = 4) and (`tb_care_labels`.`access_points_status` = 4) and (date_format(`tb_care_labels`.`end_line_qc_date_time`,'%Y-%m-%d') between curdate() and curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `vt_upcoming_pos`
--
DROP TABLE IF EXISTS `vt_upcoming_pos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_upcoming_pos`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,`tb_care_labels`.`planned_line_id` AS `planned_line_id`,`tb_care_labels`.`line_id` AS `line_id`,min(`tb_care_labels`.`sent_to_production_date_time`) AS `min_sent_date_time` from `tb_care_labels` where ((`tb_care_labels`.`planned_line_id` <> 0) and (`tb_care_labels`.`line_id` = 0)) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color`,`tb_care_labels`.`planned_line_id`,`tb_care_labels`.`line_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wash_return`
--
DROP TABLE IF EXISTS `vt_wash_return`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wash_return`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_washing_pass`,max(`tb_care_labels`.`washing_date_time`) AS `max_washing_date_time` from `tb_care_labels` where ((`tb_care_labels`.`washing_status` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wash_send`
--
DROP TABLE IF EXISTS `vt_wash_send`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wash_send`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`style_no` AS `style_no`,`tb_care_labels`.`style_name` AS `style_name`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_washing_qty`,max(`tb_care_labels`.`going_wash_scan_date_time`) AS `max_going_wash_scan_date_time` from `tb_care_labels` where ((`tb_care_labels`.`is_going_wash` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_buyer`
--
DROP TABLE IF EXISTS `vt_wh_buyer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_buyer`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_buyer_date_time`) AS `max_warehouse_buyer_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_buyer`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 1) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_factory`
--
DROP TABLE IF EXISTS `vt_wh_factory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_factory`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_factory_date_time`) AS `max_warehouse_factory_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_factory`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 2) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_lost`
--
DROP TABLE IF EXISTS `vt_wh_lost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_lost`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`lost_date_time`) AS `max_lost_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_lost`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 6) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_others`
--
DROP TABLE IF EXISTS `vt_wh_others`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_others`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_other_purpose_date_time`) AS `max_warehouse_other_purpose_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_others`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 5) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_prod_sample`
--
DROP TABLE IF EXISTS `vt_wh_prod_sample`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_prod_sample`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_production_sample_date_time`) AS `max_warehouse_production_sample_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_prod_sample`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 4) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_size_set`
--
DROP TABLE IF EXISTS `vt_wh_size_set`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_size_set`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_sizeset_date_time`) AS `max_warehouse_sizeset_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_size_set`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 7) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

-- --------------------------------------------------------

--
-- Structure for view `vt_wh_trash`
--
DROP TABLE IF EXISTS `vt_wh_trash`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_wh_trash`  AS  select `tb_care_labels`.`po_no` AS `po_no`,`tb_care_labels`.`so_no` AS `so_no`,`tb_care_labels`.`purchase_order` AS `purchase_order`,`tb_care_labels`.`item` AS `item`,`tb_care_labels`.`brand` AS `brand`,`tb_care_labels`.`quality` AS `quality`,`tb_care_labels`.`color` AS `color`,max(`tb_care_labels`.`warehouse_trash_date_time`) AS `max_warehouse_trash_date_time`,count(`tb_care_labels`.`pc_tracking_no`) AS `count_wh_trash`,max(`tb_care_labels`.`warehouse_last_action_date_time`) AS `max_warehouse_last_action_date_time` from `tb_care_labels` where ((`tb_care_labels`.`warehouse_qa_type` = 3) and (date_format(`tb_care_labels`.`ex_factory_date`,'%Y-%m-%d') between (curdate() - interval 45 day) and (curdate() + interval 60 day))) group by `tb_care_labels`.`po_no`,`tb_care_labels`.`so_no`,`tb_care_labels`.`purchase_order`,`tb_care_labels`.`item`,`tb_care_labels`.`quality`,`tb_care_labels`.`color` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cutting_daily_target`
--
ALTER TABLE `cutting_daily_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finishing_daily_target`
--
ALTER TABLE `finishing_daily_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line_daily_target`
--
ALTER TABLE `line_daily_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_aql_status_log`
--
ALTER TABLE `tb_aql_status_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bundle_cut_detail`
--
ALTER TABLE `tb_bundle_cut_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_care_labels`
--
ALTER TABLE `tb_care_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pc_tracking_no` (`pc_tracking_no`),
  ADD KEY `id` (`id`),
  ADD KEY `bundle_tracking_no` (`bundle_tracking_no`),
  ADD KEY `line_id` (`line_id`),
  ADD KEY `po_no` (`po_no`),
  ADD KEY `size` (`size`),
  ADD KEY `so_no` (`so_no`),
  ADD KEY `purchase_order` (`purchase_order`),
  ADD KEY `item` (`item`),
  ADD KEY `color` (`color`),
  ADD KEY `sent_to_production` (`sent_to_production`,`access_points`,`access_points_status`,`packing_status`,`carton_status`,`warehouse_qa_type`),
  ADD KEY `washing_status` (`washing_status`);

--
-- Indexes for table `tb_cut_delete_log`
--
ALTER TABLE `tb_cut_delete_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cut_no`
--
ALTER TABLE `tb_cut_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cut_summary`
--
ALTER TABLE `tb_cut_summary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundle_tracking_no` (`bundle_tracking_no`),
  ADD KEY `po_no` (`po_no`),
  ADD KEY `purchase_order` (`purchase_order`),
  ADD KEY `item` (`item`),
  ADD KEY `quality` (`quality`),
  ADD KEY `color` (`color`),
  ADD KEY `cut_tracking_no` (`cut_tracking_no`),
  ADD KEY `line_id` (`line_id`),
  ADD KEY `so_no` (`so_no`),
  ADD KEY `size` (`size`);

--
-- Indexes for table `tb_cut_table`
--
ALTER TABLE `tb_cut_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daily_cut_summary`
--
ALTER TABLE `tb_daily_cut_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daily_finish_summary`
--
ALTER TABLE `tb_daily_finish_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daily_line_summary`
--
ALTER TABLE `tb_daily_line_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_defects_tracking`
--
ALTER TABLE `tb_defects_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_defect_types`
--
ALTER TABLE `tb_defect_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_floor`
--
ALTER TABLE `tb_floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_gmt_part`
--
ALTER TABLE `tb_gmt_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hours`
--
ALTER TABLE `tb_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_label_reprint_log`
--
ALTER TABLE `tb_label_reprint_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_line`
--
ALTER TABLE `tb_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_line_running_pos`
--
ALTER TABLE `tb_line_running_pos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_no` (`so_no`),
  ADD KEY `po_no` (`po_no`),
  ADD KEY `line_id` (`line_id`);

--
-- Indexes for table `tb_line_scan`
--
ALTER TABLE `tb_line_scan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_po_detail`
--
ALTER TABLE `tb_po_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_no` (`po_no`),
  ADD KEY `so_no` (`so_no`),
  ADD KEY `purchase_order` (`purchase_order`),
  ADD KEY `item` (`item`),
  ADD KEY `quality` (`quality`),
  ADD KEY `color` (`color`),
  ADD KEY `size` (`size`);

--
-- Indexes for table `tb_po_part_detail`
--
ALTER TABLE `tb_po_part_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_production_summary`
--
ALTER TABLE `tb_production_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rejection_tracking`
--
ALTER TABLE `tb_rejection_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_season`
--
ALTER TABLE `tb_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_segment`
--
ALTER TABLE `tb_segment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_size_serial`
--
ALTER TABLE `tb_size_serial`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `tb_today_finishing_output_qty`
--
ALTER TABLE `tb_today_finishing_output_qty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_today_line_output_qty`
--
ALTER TABLE `tb_today_line_output_qty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_warehouse_type`
--
ALTER TABLE `tb_warehouse_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cutting_daily_target`
--
ALTER TABLE `cutting_daily_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `finishing_daily_target`
--
ALTER TABLE `finishing_daily_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;

--
-- AUTO_INCREMENT for table `line_daily_target`
--
ALTER TABLE `line_daily_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5703;

--
-- AUTO_INCREMENT for table `tb_aql_status_log`
--
ALTER TABLE `tb_aql_status_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `tb_bundle_cut_detail`
--
ALTER TABLE `tb_bundle_cut_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tb_care_labels`
--
ALTER TABLE `tb_care_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3279719;

--
-- AUTO_INCREMENT for table `tb_cut_delete_log`
--
ALTER TABLE `tb_cut_delete_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `tb_cut_no`
--
ALTER TABLE `tb_cut_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `tb_cut_summary`
--
ALTER TABLE `tb_cut_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371936;

--
-- AUTO_INCREMENT for table `tb_cut_table`
--
ALTER TABLE `tb_cut_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_daily_cut_summary`
--
ALTER TABLE `tb_daily_cut_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=608;

--
-- AUTO_INCREMENT for table `tb_daily_finish_summary`
--
ALTER TABLE `tb_daily_finish_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=943;

--
-- AUTO_INCREMENT for table `tb_daily_line_summary`
--
ALTER TABLE `tb_daily_line_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6265;

--
-- AUTO_INCREMENT for table `tb_defects_tracking`
--
ALTER TABLE `tb_defects_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8358;

--
-- AUTO_INCREMENT for table `tb_defect_types`
--
ALTER TABLE `tb_defect_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_floor`
--
ALTER TABLE `tb_floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_gmt_part`
--
ALTER TABLE `tb_gmt_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_hours`
--
ALTER TABLE `tb_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_label_reprint_log`
--
ALTER TABLE `tb_label_reprint_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4667;

--
-- AUTO_INCREMENT for table `tb_line`
--
ALTER TABLE `tb_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_line_running_pos`
--
ALTER TABLE `tb_line_running_pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `tb_line_scan`
--
ALTER TABLE `tb_line_scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_po_detail`
--
ALTER TABLE `tb_po_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92287;

--
-- AUTO_INCREMENT for table `tb_po_part_detail`
--
ALTER TABLE `tb_po_part_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18031;

--
-- AUTO_INCREMENT for table `tb_production_summary`
--
ALTER TABLE `tb_production_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1599;

--
-- AUTO_INCREMENT for table `tb_rejection_tracking`
--
ALTER TABLE `tb_rejection_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_season`
--
ALTER TABLE `tb_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_segment`
--
ALTER TABLE `tb_segment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_size_serial`
--
ALTER TABLE `tb_size_serial`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `tb_today_finishing_output_qty`
--
ALTER TABLE `tb_today_finishing_output_qty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1233;

--
-- AUTO_INCREMENT for table `tb_today_line_output_qty`
--
ALTER TABLE `tb_today_line_output_qty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37179;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tb_warehouse_type`
--
ALTER TABLE `tb_warehouse_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

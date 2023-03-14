-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 07:47 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `act_id` int(11) NOT NULL,
  `act_name` varchar(255) NOT NULL,
  `act_target` varchar(50) NOT NULL,
  `fromdata` text NOT NULL,
  `todata` text NOT NULL,
  `datetime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `provinces_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district_name`, `provinces_id`) VALUES
(1, 'Burera', 1),
(2, 'Gakenke', 1),
(3, 'Musanze', 1),
(4, 'Rulindo', 1),
(5, 'Gicumbi', 1),
(6, 'Kamonyi', 2),
(7, 'Muhanga', 2),
(8, 'Ruhango', 2),
(9, 'Nyanza', 2),
(10, 'Huye', 2),
(11, 'Gisagara', 2),
(12, 'Nyamagabe', 2),
(13, 'Nyaruguru', 2),
(14, 'Nyagatare', 3),
(15, 'Gatsibo', 3),
(16, 'Rwamagana', 3),
(17, 'Kayonza', 3),
(18, 'Ngoma', 3),
(19, 'Kirehe', 3),
(20, 'Bugesera', 3),
(21, 'Nyabihu', 4),
(22, 'Rubavu', 4),
(23, 'Ngororero', 4),
(24, 'Nyamasheke', 4),
(25, 'Karongi', 4),
(26, 'Rutsiro', 4),
(27, 'Rusizi', 4),
(28, 'Gasabo', 5),
(29, 'Nyarugenge', 5),
(30, 'Kicukiro', 5);

-- --------------------------------------------------------

--
-- Table structure for table `doctypes`
--

CREATE TABLE `doctypes` (
  `doc_id` int(50) NOT NULL,
  `doctype` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `deletereason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctypes`
--

INSERT INTO `doctypes` (`doc_id`, `doctype`, `delete_status`, `deletereason`, `regdate`) VALUES
(1, 'Identity Card', 0, '', '2018-06-26'),
(2, 'Driving License', 0, '', '2018-06-26'),
(3, 'School Report', 0, '', '2018-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `losts`
--

CREATE TABLE `losts` (
  `lost_id` int(50) NOT NULL,
  `postoff_id` int(50) NOT NULL,
  `representative_id` int(11) NOT NULL,
  `doctype_id` int(11) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `not_id` int(11) NOT NULL,
  `postoff_id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `regdate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postoffices`
--

CREATE TABLE `postoffices` (
  `postoff_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `representative` int(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `prov_id` int(10) NOT NULL,
  `distr_id` int(10) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `cell` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `deletereason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postoffices`
--

INSERT INTO `postoffices` (`postoff_id`, `name`, `representative`, `phone`, `password`, `prov_id`, `distr_id`, `sector`, `cell`, `address`, `delete_status`, `deletereason`, `regdate`) VALUES
(1, 'Muhima', 1, '0789123321', '923d4b07b9f87f17936ea676335e2f33', 5, 29, '215', 'Kabari', 'Behind Police Station', 0, '', '2018-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(11) NOT NULL,
  `province_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province_name`) VALUES
(1, 'North'),
(2, 'South'),
(3, 'East'),
(4, 'West'),
(5, 'Kigali City');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `queue_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `queue_type` int(11) NOT NULL,
  `queue_identifier` varchar(255) NOT NULL,
  `notification_receive` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `queue_status` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `deletereason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `representative`
--

CREATE TABLE `representative` (
  `rep_id` int(11) NOT NULL,
  `rep_name` varchar(50) NOT NULL,
  `rep_phone` varchar(15) NOT NULL,
  `rep_email` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `deletereason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `representative`
--

INSERT INTO `representative` (`rep_id`, `rep_name`, `rep_phone`, `rep_email`, `delete_status`, `deletereason`, `regdate`) VALUES
(1, 'Igihozo Didier', '0782760179', 'igihozo@gmail.com', 0, '', '2018-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE `reset` (
  `reset_id` int(11) NOT NULL,
  `postoff_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `statusdate` datetime(6) NOT NULL,
  `regdate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`id`, `name`, `district_id`) VALUES
(1, 'Bukure', 5),
(2, 'Bwisige', 5),
(3, 'Byumba', 5),
(4, 'Cyumba', 5),
(5, 'Giti', 5),
(6, 'Kaniga', 5),
(7, 'Manyagiro', 5),
(8, 'Miyove', 5),
(9, 'Kageyo', 5),
(10, 'Mukarange', 5),
(11, 'Muko', 3),
(12, 'Mutete', 5),
(13, 'Nyamiyaga', 5),
(14, 'Rubaya', 5),
(15, 'Rukomo', 5),
(16, 'Rushaki', 5),
(17, 'Rutare', 5),
(18, 'Ruvune', 5),
(19, 'Rwamiko', 5),
(20, 'Shangasha', 5),
(21, 'Nyankenke', 5),
(22, 'Bugwe', 1),
(23, 'Butaro', 1),
(24, 'Cyanika', 1),
(25, 'Cyeru', 1),
(26, 'Gahunga', 1),
(27, 'Gatebe', 1),
(28, 'Gitovu', 1),
(29, 'Kagogo', 1),
(30, 'Kinoni', 1),
(31, 'Kinyababa', 1),
(32, 'Kivuye', 1),
(33, 'Nemba', 1),
(34, 'Rugarama', 1),
(35, 'Rugendabari', 1),
(36, 'Ruhunde', 1),
(37, 'Rusarabuge', 1),
(38, 'Rwerere', 1),
(39, 'Base', 4),
(40, 'Burega', 4),
(41, 'Bushoki', 4),
(42, 'Buyoga', 4),
(43, 'Cyinzuki', 4),
(44, 'Cyungo', 4),
(45, 'Kinihira', 4),
(46, 'Kisaro', 4),
(47, 'Masoro', 4),
(48, 'Mbogo', 4),
(49, 'Murambi', 4),
(50, 'Ngoma', 4),
(51, 'Ntarabana', 4),
(52, 'Rukozo', 4),
(53, 'Rusiga', 4),
(54, 'Shyorongi', 4),
(55, 'Tumba', 4),
(56, 'Busengo', 2),
(57, 'Coko', 2),
(58, 'Cyabingo', 2),
(59, 'Gakenke', 2),
(60, 'Gashenyi', 2),
(61, 'Mugunga', 2),
(62, 'Janja', 2),
(63, 'Kamubuga', 2),
(64, 'Karambo', 2),
(65, 'Kivuruga', 2),
(66, 'Mataba', 2),
(67, 'Minazi', 2),
(68, 'Muhondo', 2),
(69, 'Muyongwe', 2),
(70, 'Muzo', 2),
(71, 'Nemba', 2),
(72, 'Ruli', 2),
(73, 'Rusasa', 2),
(74, 'Rushaki', 2),
(75, 'Busoro', 3),
(76, 'Cyuve', 3),
(77, 'Gacaca', 3),
(78, 'Gashaki', 3),
(79, 'Gataraga', 3),
(80, 'Kimonyi', 3),
(81, 'Kinigi', 3),
(82, 'Muhoza', 3),
(83, 'Muko', 5),
(84, 'Musanze', 3),
(85, 'Nkotsi', 3),
(86, 'Nyange', 3),
(87, 'Remera', 3),
(88, 'Rwaza', 3),
(89, 'Shingiro', 3),
(90, 'Gashora', 20),
(91, 'Juru', 20),
(92, 'Kamabuye', 20),
(93, 'Ntarama', 20),
(94, 'Mareba', 20),
(95, 'Mayange', 20),
(96, 'Musenyi', 20),
(97, 'Mwogo', 20),
(98, 'Ngeruka', 20),
(99, 'Nyamata', 20),
(100, 'Nyarugenge', 20),
(101, 'Rilima', 20),
(102, 'Ruhuha', 20),
(103, 'Rweru', 20),
(104, 'Syara', 20),
(105, 'Gasange', 15),
(106, 'Gatsibo', 15),
(107, 'Gitoki', 15),
(108, 'Kabarore', 15),
(109, 'Kageyo', 15),
(110, 'Kiramuruzi', 15),
(111, 'Kiziguro', 15),
(112, 'Muhura', 15),
(113, 'Murambi', 15),
(114, 'Ngarama', 15),
(115, 'Nyagihanga', 15),
(116, 'Remera', 15),
(117, 'Rugarama', 15),
(118, 'Rwimbogo', 15),
(119, 'Gahini', 17),
(120, 'Kabare', 17),
(121, 'Kabarondo', 17),
(122, 'Mukarange', 17),
(123, 'Murama', 17),
(124, 'Murundi', 17),
(125, 'Mwiri', 17),
(126, 'Ndego', 17),
(127, 'Nyamirama', 17),
(128, 'Rukara', 17),
(129, 'Ruramira', 17),
(130, 'Rwikwavu', 17),
(131, 'Gahara', 19),
(132, 'Gatore', 19),
(133, 'Kigina', 19),
(134, 'Kirehe', 19),
(135, 'Mahama', 19),
(136, 'Mpanga', 19),
(137, 'Musaza', 19),
(138, 'Mushikiri', 19),
(139, 'Nasho', 19),
(140, 'Nyamugari', 19),
(141, 'Nyarubuye', 19),
(142, 'Kigarama', 19),
(143, 'Gashanda', 18),
(144, 'Jarama', 18),
(145, 'Kazo', 18),
(146, 'Kibungo', 18),
(147, 'Mugesera', 18),
(148, 'Murama', 18),
(149, 'Mutenderi', 18),
(150, 'Remera', 18),
(151, 'Rukira', 18),
(152, 'Rukumberi', 18),
(153, 'Rurenge', 18),
(154, 'Sake', 18),
(155, 'Zaza', 18),
(156, 'Karembo', 18),
(157, 'Gatunda', 14),
(158, 'Kiyombe', 14),
(159, 'Karama', 14),
(160, 'Karangazi', 14),
(161, 'Katabagemu', 14),
(162, 'Matimba', 14),
(163, 'Mimuli', 14),
(164, 'Mukama', 14),
(165, 'Musheli', 14),
(166, 'Nyagatare', 14),
(167, 'Rukomo', 14),
(168, 'Rwempasha', 14),
(169, 'Rwimiyaga', 14),
(170, 'Tabagwe', 14),
(171, 'Fumbwe', 16),
(172, 'Gahengeri', 16),
(173, 'Gishari', 16),
(174, 'Karenge', 16),
(175, 'Kigabiro', 16),
(176, 'Muhazi', 16),
(177, 'Munyaga', 16),
(178, 'Munyiginya', 16),
(179, 'Musha', 11),
(180, 'Muyumbu', 16),
(181, 'Mwulire', 16),
(182, 'Nyakariro', 16),
(183, 'Nzige', 16),
(184, 'Rubona', 16),
(185, 'Bumbogo', 28),
(186, 'Gatsata', 28),
(187, 'Jali', 28),
(188, 'Gikomero', 28),
(189, 'Gisozi', 28),
(190, 'Jabana', 28),
(191, 'Kinyinya', 28),
(192, 'Ndera', 28),
(193, 'Nduba', 28),
(194, 'Rusororo', 28),
(195, 'Rutunga', 28),
(196, 'Kacyiru', 28),
(197, 'Kimihurura', 28),
(198, 'Kimironko', 28),
(199, 'Remera', 28),
(200, 'Gahanga', 30),
(201, 'Gatenga', 30),
(202, 'Gikondo', 30),
(203, 'Kagarama', 30),
(204, 'Kanombe', 30),
(205, 'Kicukiro', 30),
(206, 'Kigarama', 30),
(207, 'Masaka', 30),
(208, 'Niboye', 30),
(209, 'Nyarugunga', 30),
(210, 'Gitega', 29),
(211, 'Kanyinya', 29),
(212, 'Kigali', 29),
(213, 'Kimisagara', 29),
(214, 'Mageragere', 29),
(215, 'Muhima', 29),
(216, 'Nyakabanda', 29),
(217, 'Nyamirambo', 29),
(218, 'Rwezamenyo', 29),
(219, 'Nyarugenge', 29),
(220, 'Gikonko', 11),
(221, 'Gishubi', 11),
(222, 'Kansi', 11),
(223, 'Kibilizi', 11),
(224, 'Kigeme', 11),
(225, 'Mamba', 11),
(226, 'Muganza', 11),
(227, 'Mugombwa', 11),
(228, 'Mukindo', 11),
(229, 'Musha', 16),
(230, 'Ndora', 11),
(231, 'Nyanza', 11),
(232, 'Save', 11),
(233, 'Gishanvu', 10),
(234, 'Karama', 10),
(235, 'Kigoma', 10),
(236, 'Kinazi', 10),
(237, 'Maramba', 10),
(238, 'Mbazi', 10),
(239, 'Mukura', 10),
(240, 'Ngoma', 10),
(241, 'Ruhashya', 10),
(242, 'Rusatira', 10),
(243, 'Rwaniro', 10),
(244, 'Simbi', 10),
(245, 'Tumba', 10),
(246, 'Huye', 10),
(247, 'Gacurabwenge', 6),
(248, 'Karama', 6),
(249, 'Kayenzi', 6),
(250, 'Kayumbu', 6),
(251, 'Mugina', 6),
(252, 'Musambira', 6),
(253, 'Ngamba', 6),
(254, 'Nyamiyaga', 6),
(255, 'Nyarubaka', 6),
(256, 'Rugarika', 6),
(257, 'Rukoma', 6),
(258, 'Runda', 6),
(259, 'Cyeza', 7),
(260, 'Kabacuzi', 7),
(261, 'Kibangu', 7),
(262, 'Kiyumba', 7),
(263, 'Muhanga', 7),
(264, 'Mushishiro', 7),
(265, 'Nyabinoni', 7),
(266, 'Nyamabuye', 7),
(267, 'Nyarusange', 7),
(268, 'Rongi', 7),
(269, 'Rugendabari', 7),
(270, 'Shyogwe', 7),
(271, 'Buruhukiro', 12),
(272, 'Cyanika', 12),
(273, 'Gatare', 12),
(274, 'Kaduha', 12),
(275, 'Kamegeli', 12),
(276, 'Kibirizi', 12),
(277, 'Kibumbwe', 12),
(278, 'Kitabi', 12),
(279, 'Mbazi', 12),
(280, 'Mugano', 12),
(281, 'Musange', 12),
(282, 'Musebeya', 12),
(283, 'Mushubi', 12),
(284, 'Nkomane', 12),
(285, 'Gasaka', 12),
(286, 'Tare', 12),
(287, 'Uwinkingi', 12),
(288, 'Busasamana', 9),
(289, 'Busoro', 9),
(290, 'Cyabakamyi', 9),
(291, 'Kibirizi', 9),
(292, 'Kigoma', 9),
(293, 'Mukingo', 9),
(294, 'Rwabicuma', 9),
(295, 'Muyira', 9),
(296, 'Ntyazo', 9),
(297, 'Nyagisozi', 9),
(298, 'Cyahinda', 13),
(299, 'Busanze', 13),
(300, 'Kibeho', 13),
(301, 'Mata', 13),
(302, 'Munini', 13),
(303, 'Kivu', 13),
(304, 'Ngera', 13),
(305, 'Ngoma', 13),
(306, 'Nyabimata', 13),
(307, 'Nyagisozi', 13),
(308, 'Ruheru', 13),
(309, 'Muganza', 13),
(310, 'Ruramba', 13),
(311, 'Rusenge', 13),
(312, 'Bweramana', 8),
(313, 'Byimana', 8),
(314, 'Kabagari', 8),
(315, 'Kinazi', 8),
(316, 'Kinihira', 8),
(317, 'Mbuye', 8),
(318, 'Mwendo', 8),
(319, 'Ntongwe', 8),
(320, 'Ruhango', 8),
(321, 'Bwishyura', 25),
(322, 'Gishari', 25),
(323, 'Gishyita', 25),
(324, 'Gisovu', 25),
(325, 'Gitesi', 25),
(326, 'Kareba', 25),
(327, 'Murambi', 25),
(328, 'Mubuga', 25),
(329, 'Mutuntu', 25),
(330, 'Ndayishimiye', 25),
(331, 'Rugabano', 25),
(332, 'Ruganda', 25),
(333, 'Rwankuba', 25),
(334, 'Tumba', 25),
(335, 'Bwira', 23),
(336, 'Gatumba', 23),
(337, 'Hindiro', 23),
(338, 'Kabaya', 23),
(339, 'Kageyo', 23),
(340, 'Kavumu', 23),
(341, 'Matyazo', 23),
(342, 'Muhanda', 23),
(343, 'Muhororo', 23),
(344, 'Ndaro', 23),
(345, 'Ngororero', 23),
(346, 'Nyange', 23),
(347, 'Sovu', 23),
(348, 'Bigogwe', 21),
(349, 'Jenda', 21),
(350, 'Jomba', 21),
(351, 'Kabatwa', 21),
(352, 'Karago', 21),
(353, 'Kintobo', 21),
(354, 'Mukamira', 21),
(355, 'Muringa', 21),
(356, 'Rambura', 21),
(357, 'Rugera', 21),
(358, 'Rurembo', 21),
(359, 'Shyira', 21),
(360, 'Bushekeri', 24),
(361, 'Bushenge', 24),
(362, 'Cyato', 24),
(363, 'Gihombo', 24),
(364, 'Kagano', 24),
(365, 'Kanjongo', 24),
(366, 'Karambi', 24),
(367, 'Karengera', 24),
(368, 'Kirimbi', 24),
(369, 'Macuba', 24),
(370, 'Mahembe', 24),
(371, 'Nyabitekeri', 24),
(372, 'Rangiro', 24),
(373, 'Ruharambuga', 24),
(374, 'Shangi', 24),
(375, 'Bugeshi', 22),
(376, 'Busasamana', 22),
(377, 'Cyanzarwe', 22),
(378, 'Gisenyi', 22),
(379, 'Kanama', 22),
(380, 'Kanzenze', 22),
(381, 'Mudende', 22),
(382, 'Nyakiliba', 22),
(383, 'Nyamyumba', 22),
(384, 'Nyundo', 22),
(385, 'Rubavu', 22),
(386, 'Rugerero', 22),
(387, 'Bugarama', 27),
(388, 'Butare', 27),
(389, 'Bweyeye', 27),
(390, 'Gikundanvura', 27),
(391, 'Gashonga', 27),
(392, 'Giheke', 27),
(393, 'Gihundwe', 27),
(394, 'Gitambi', 27),
(395, 'Kamembe', 27),
(396, 'Muganza', 27),
(397, 'Mururu', 27),
(398, 'Nkanka', 27),
(399, 'Nkombo', 27),
(400, 'Nkungu', 27),
(401, 'Nyakabuye', 27),
(402, 'Nyakarenzo', 27),
(403, 'Nzahaha', 27),
(404, 'Rwimbogo', 27),
(405, 'Boneza', 26),
(406, 'Gihango', 26),
(407, 'Kigeyo', 26),
(408, 'Kivumu', 26),
(409, 'Manihira', 26),
(410, 'Mukura', 26),
(411, 'Murunda', 26),
(412, 'Musasa', 26),
(413, 'Mushonyi', 26),
(414, 'Mushubati', 26),
(415, 'Nyabirasi', 26),
(416, 'Ruhango', 26),
(417, 'Rusebeya', 26);

-- --------------------------------------------------------

--
-- Table structure for table `sysadmin`
--

CREATE TABLE `sysadmin` (
  `sysadid` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taken`
--

CREATE TABLE `taken` (
  `taken_id` int(50) NOT NULL,
  `losts_id` int(50) NOT NULL,
  `taken_date` datetime(6) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `delete_status`, `delete_reason`, `regdate`) VALUES
(1, 'admin', 'admin@yahoo.com', '2f7535bc6eac9e1a4227b395a3f9a3da', 0, '', '2017-10-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_id` (`provinces_id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`),
  ADD KEY `id_4` (`id`),
  ADD KEY `id_5` (`id`),
  ADD KEY `id_6` (`id`),
  ADD KEY `id_7` (`id`);

--
-- Indexes for table `doctypes`
--
ALTER TABLE `doctypes`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `losts`
--
ALTER TABLE `losts`
  ADD PRIMARY KEY (`lost_id`),
  ADD KEY `postoff_id` (`postoff_id`),
  ADD KEY `lost_id` (`lost_id`),
  ADD KEY `doctype_id` (`doctype_id`),
  ADD KEY `representative_id` (`representative_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`not_id`),
  ADD KEY `postoff_id` (`postoff_id`),
  ADD KEY `queue_id` (`queue_id`);

--
-- Indexes for table `postoffices`
--
ALTER TABLE `postoffices`
  ADD PRIMARY KEY (`postoff_id`),
  ADD KEY `postoff_id` (`postoff_id`),
  ADD KEY `postoff_id_2` (`postoff_id`),
  ADD KEY `representative` (`representative`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `queue_type` (`queue_type`);

--
-- Indexes for table `representative`
--
ALTER TABLE `representative`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `rep_id` (`rep_id`);

--
-- Indexes for table `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`reset_id`),
  ADD KEY `postoff_id` (`postoff_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`),
  ADD KEY `district_id_2` (`district_id`),
  ADD KEY `district_id_3` (`district_id`),
  ADD KEY `district_id_4` (`district_id`),
  ADD KEY `district_id_5` (`district_id`),
  ADD KEY `district_id_6` (`district_id`),
  ADD KEY `district_id_7` (`district_id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `district_id_8` (`district_id`),
  ADD KEY `id_3` (`id`);

--
-- Indexes for table `sysadmin`
--
ALTER TABLE `sysadmin`
  ADD PRIMARY KEY (`sysadid`);

--
-- Indexes for table `taken`
--
ALTER TABLE `taken`
  ADD PRIMARY KEY (`taken_id`),
  ADD KEY `losts_id` (`losts_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `doctypes`
--
ALTER TABLE `doctypes`
  MODIFY `doc_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `losts`
--
ALTER TABLE `losts`
  MODIFY `lost_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `postoffices`
--
ALTER TABLE `postoffices`
  MODIFY `postoff_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queue_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `representative`
--
ALTER TABLE `representative`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reset`
--
ALTER TABLE `reset`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;
--
-- AUTO_INCREMENT for table `sysadmin`
--
ALTER TABLE `sysadmin`
  MODIFY `sysadid` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taken`
--
ALTER TABLE `taken`
  MODIFY `taken_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`provinces_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `losts`
--
ALTER TABLE `losts`
  ADD CONSTRAINT `losts_ibfk_1` FOREIGN KEY (`postoff_id`) REFERENCES `postoffices` (`postoff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `losts_ibfk_2` FOREIGN KEY (`doctype_id`) REFERENCES `doctypes` (`doc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `losts_ibfk_3` FOREIGN KEY (`representative_id`) REFERENCES `representative` (`rep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`postoff_id`) REFERENCES `postoffices` (`postoff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`queue_id`) REFERENCES `queue` (`queue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postoffices`
--
ALTER TABLE `postoffices`
  ADD CONSTRAINT `postoffices_ibfk_1` FOREIGN KEY (`representative`) REFERENCES `representative` (`rep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_ibfk_1` FOREIGN KEY (`queue_type`) REFERENCES `doctypes` (`doc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reset`
--
ALTER TABLE `reset`
  ADD CONSTRAINT `reset_ibfk_1` FOREIGN KEY (`postoff_id`) REFERENCES `postoffices` (`postoff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taken`
--
ALTER TABLE `taken`
  ADD CONSTRAINT `taken_ibfk_1` FOREIGN KEY (`losts_id`) REFERENCES `losts` (`lost_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

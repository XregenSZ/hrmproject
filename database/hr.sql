-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 06:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `asset_id` int(30) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `asset_detail` varchar(255) NOT NULL,
  `asset_file` varchar(255) NOT NULL,
  `emp_borrow_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`asset_id`, `asset_name`, `asset_detail`, `asset_file`, `emp_borrow_id`) VALUES
(1, 'Macbook Pro 16 M3', 'จอภาพ Liquid Retina XDR ขนาด 16 นิ้ว² พอร์ต Thunderbolt 4 จำนวน 3 พอร์ต, พอร์ต HDMI, ช่องเสียบการ์ด SDXC, ช่องต่อหูฟัง, พอร์ต MagSafe 3 Magic Keyboard พร้อม Touch ID แทร็คแพด Force Touch อะแดปเตอร์แปลงไฟ USB-C ขนาด 140 วัตต์', '65eee541724f6.jpg', NULL),
(2, 'Adapter แปลงไฟล์ Type : USB-C', 'Brand	Intek Model	Converter USB 3.0 TO Type-C Black Ports	USB 3.0', '65d61f4b1da18.jpg', 3),
(3, 'Notebook Lenovo Thinkpad T14s G4', '13th Generation Intel® Core™ i7-1360P Processor (E-cores up to 3.70 GHz P-cores up to 5.00 GHz) 32 GB DDR5-5600MHz (16 GB Soldered + 16 GB SODIMM) 512 GB SSD M.2 2280 PCIe Gen4 TLC Opal', '65d61fc91c741.jpg', NULL),
(4, 'เครื่องพิมพ์ PR-W01 (สีขาว)', 'Wifi Printer Barigan ขนาดกระดาษ 80 MM', '65d6204554a02.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_borrow`
--

CREATE TABLE `asset_borrow` (
  `b_id` int(30) NOT NULL,
  `b_create` datetime NOT NULL,
  `asset_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `b_start` date NOT NULL,
  `b_end` date NOT NULL,
  `b_reason` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_borrow`
--

INSERT INTO `asset_borrow` (`b_id`, `b_create`, `asset_id`, `emp_id`, `b_start`, `b_end`, `b_reason`, `status`) VALUES
(1, '2024-02-21 18:37:50', 1, 3, '2024-02-22', '2024-02-29', '77777777777', 'decline'),
(2, '2024-02-24 17:25:39', 4, 13, '2024-02-27', '2024-03-09', 'ต้องการนำไปใช้ support', 'request'),
(3, '2024-02-25 07:35:54', 2, 3, '2024-03-06', '2024-03-08', 'นำไปใช้งานในต่างจังหวัด', 'approve'),
(4, '2024-02-27 05:08:37', 4, 18, '2024-02-29', '2024-02-29', '111', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `resleave`
--

CREATE TABLE `resleave` (
  `leave_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `emp_position` varchar(255) NOT NULL,
  `emp_reason` varchar(999) NOT NULL,
  `emp_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resleave`
--

INSERT INTO `resleave` (`leave_id`, `create_date`, `status`, `start_date`, `end_date`, `emp_id`, `f_name`, `l_name`, `emp_position`, `emp_reason`, `emp_file`) VALUES
(4, '2024-02-22 00:50:15', 'approve', '2024-02-13', '2024-02-16', 3, 'ภูมิน', 'สีจันทร์', 'Programmer', 'hello i go to vacation', '65cb908e6c7e1.jpg'),
(5, '2024-02-22 00:51:45', 'approve', '2024-03-01', '2024-03-03', 3, 'ภูมิน', 'สีจันทร์', 'Programmer', 'ไปต่างจังหวัด', '65cca51887b1c.jpg'),
(6, '2024-02-22 00:52:09', 'decline', '2024-03-01', '2024-03-02', 3, 'ภูมิน', 'สีจันทร์', 'Programmer', 'ไปพักร้อน vacation ที่เกาะสมุย ', ''),
(7, '2024-02-27 11:09:21', 'decline', '2024-03-01', '2024-02-03', 15, 'นพจรณ์', 'ขอนแก่น', 'IT-Support', 'my family want to vacation on this week-end Please :D', '65ccadf570aab.png'),
(8, '2024-02-14 19:14:09', 'request', '2024-02-16', '2024-02-19', 16, 'เดอะร็อค', 'จอนสัน', 'Programmer', 'I have to go to a wrestling match :D', '65ccae9136f70.jpg'),
(9, '2024-02-14 19:16:04', 'request', '2024-02-21', '2024-02-23', 14, 'มนจรณ์', 'สายแก้ว', 'IT-Support', 'i want to go cheering my child please approve this request :D Thank you from my heart <3', '65ccaf048cff5.jpg'),
(10, '2024-02-24 23:22:40', 'request', '2024-03-08', '2024-03-14', 13, 'ภานุพงศ์', 'กากาล', 'Programmer', 'ไปพักผ่อน คลายเครียด', '65da17d0d8eb8.jpg'),
(11, '2024-03-09 19:09:13', 'approve', '2024-03-06', '2024-03-13', 4, 'จันทรา', 'วดี', 'Marketing', 'ต้องการไปพักร้อน\r\nPlease allow me !', '65da18cf82bbc.jpg'),
(12, '2024-02-27 06:07:23', 'request', '2024-03-06', '2024-03-08', 4, 'จันทรา', 'วดี', 'Marketing', 'ต้องการไปพักผ่อน', '65dd19ab23e0d.png'),
(13, '2024-02-27 11:08:05', 'request', '2024-03-06', '2024-03-08', 18, '111', '111', '111', '111', ''),
(14, '2024-03-09 19:07:37', 'request', '2024-03-09', '2024-03-12', 22, 'Peach', 'Maicro', 'Programmer', 'vacation', '65ec510900f0e.jpg'),
(15, '2024-03-10 15:29:26', 'request', '2024-03-13', '2024-03-16', 3, 'ภูมิน', 'สีจันทร์', 'Programmer', 'sssss', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `account_id` int(255) NOT NULL,
  `email_account` varchar(255) NOT NULL,
  `password_account` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`account_id`, `email_account`, `password_account`, `salt`, `role`) VALUES
(3, 'singthong036@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QzAwU05sSzNxaW93OVJrQg$6rz6x9tQxkQoaAR2AEZPF6z4mzDP7d8cDyv60i0cWiU', '5189454e2277553eb8afb2eec3ce6c77f2c2d4ed304b3990baa0499eb2009419ca8c4c085fadcf60bf87f5c36c96efe6092b816cb383a714618802e80133a21664a31358ce6c31d42b9e071fe2b495062da102473becfb98ec076c8e142bbcd4ca29bc2bcd95807e8e4095aab1c67c6a370f55158c850c4068', 'admin'),
(4, 'test@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$TkpXcUEvUUgyTktQNmhDSA$A4ebBi8fWZ5GTxI+C6QxheybnArgc2D3exo7oE0+qpo', '67df3550f2a8bc4b0ef19392d26c6f8e347397e18c9af485acaf8e3dff0db9ddc06994596f790af91a74cd085d394f8d3e02f545ab49a65cb5d1f50825052be5637bedadd02c889d676efb89fbc3002298ea7afd4179f5ab2a077782cde054dfb9c628b8e1639b68eb99', 'member'),
(13, 'panupong@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ZTFlajFDMS5wZkttM2t5OA$Se6OuFYjpAyp8HXEMk28vJ6kO3ZXmP2s3TFBCkraDsg', '1cb4c59c7ac5b005785dca8498157ee95a71630a6758ff35e4bcd9a4a0ba52f666d022e31649d8ef156257c0d85c6776b5c4cfae48ae073b122c0ca25b1d0d90a72fea6e033f8fe2b14ece69efa85806e7eb698583c38d402296c4e2a594180f3c2f2df2b2cde2a5659a1ea16608b6a976530409bcbbc4', 'member'),
(14, 'monjo@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$S2hyYjFFUUk5SGF4U2d6RQ$HAh20Y68i2j7A/sxEHocf2Ogbfa2AyyFrB+sly10XdU', '698eac54fec90cbd4753653f6b5e64afa4954ad18448254cc12085536db81f0c5752d972b8b6d9614fee0f2155da57851890628aa16d2ea434e1234a6689c13f0660d94cfbd705c8005ff7c27f83fdb7c007f190cdfc1f0f93a080bf77e136c8306c43499d72b5749401c62aa789d64f18ac6dc36934024ca8a69dee7f80', 'member'),
(15, 'maja@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$a2lBbllxU3dlTDBLL00uUw$SCC5eFDU+feqZSpj+cqP46II9SzD8juf7ChGA7NHppE', '775a96747fb912ca8f94a197ceffe7242010106f42bbcf0b45d05b8aa82a0528a4847127574fa9ddc09e628b8725ea365f248b8a328a1eea3c3ee0a13aea75eba8cf40229a68ff0cf439b328adb9b25c66efaaf7bf9f947865f12fe7398f93875cbe9acfd1e00b4d821e2fa3bf203e0f707ac3e4118f84fb352a77a9424a6d', 'member'),
(16, 'boja@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$N21TYWdRRjdjQjhQRTYvcA$4FM9EFSM/EDwzVSgxcjUHhmBdTAf5Pz6lIF+Yzf058o', 'f08e97f9a3a851ec558aa3451694661bbc35eac74c295ceda9939af820e63fee548e41c87fb7df1f33c269cd7391d1360fdeb5fee268314118a7171a6be2f617b39d72233fb16347b94be7c581a13c2e34702ae27e2c231d1cb656a77cdd89bd46ca2a6e640f1de873bbcb93d4eb', 'member'),
(17, '111@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bW5YUFIuSkwvdlZMenZiLg$I+P3Pr57Bgr7grVse+og11GtOvy6kPYBs77iPUgQeag', 'a2ec35db2b9cc37b2b6c1ec98224fae7b65ff684b659f50a59fce320613fdc269e376e96407f9eb48f7bb1a0f845a052a9a3cc95764381b8f6984cccb4458cbde6e87d45bcf57ecade6145f442127523a576471d1f6aa821cf33ccbbd89eb37fa6dc7aefd581ab91c21ba4edda6b51e77cdccbd886593eedecc74aa7f72fe7', 'member'),
(18, '111', '$argon2id$v=19$m=65536,t=4,p=1$dk1xYmROdnhEbEhNVzRqVg$DdGuyJp8laVaJ822659fFBcG4zy4PTwGOzeBHflkU5k', 'e3f50208da699c1dec09a1d8873942840a1083d652e9759f9efabdcbc6d2adf8518ed33845888adff6742bda41d4b3f9aaa11827a573792120d5740fff6ecda8d535060c296200f81229111463f573c438d53fc473d6391e7df37f776ab032b77b98ee2f44895a78b3cf909cf13ac2eb308c6152878f97d6da0e64ba16', 'member'),
(19, 'bbb@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VURMRzZLNU5VR21ORlRUcg$AaU2dcioQwFrQXC4zkk4DKFTxXPZMzP0vcr3CE7lM7U', 'a8e1906d843c8c8c9ee09abf032a7976af12794d279ed94eea323c90f4065c605735e852bb70d4265767f09ce222eabb57699567e1e3b64bf4043dc1814cf926f3ed3d6105e30dbcb919185f36e70004c68a5739547257fc5607ab6144ac275195e67dfda6d332e852844a', 'member'),
(20, 'zzz@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NlpHbUpNRFBBOThOL3BZcw$gajrtkLmfF1PYNOwcJoMK4sWrjZ/k5LjBwKNSPpte9E', '65d62138f570985a911259c6e78becd4a00a56f0e111f397bb097b3a4ccc66f5cbb0ed70b31de284e3dcee232400098f562372d21044f893bb84450811691dc3b275f9d454e1b7400b709c0dbc6a31b57718a686b93a79cf328e9abc6912632e1dae0e8af5bac0cbce48611472e7795e840322f78d4d3fdc62685586', 'member'),
(22, 'nnn@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MFNzclVRa203SUl3YWlLOQ$V+lgeIIINXddliGv588HXKCyfXuGmcRyP2HLGRV+7+A', '44c6e4ec66740e821b0570674e64945757ef706022ec74fed5b589ae8989baca96b374b2b9e385967185b4057bd6dda35651316aaaaa09a06e01931ed2af8d06fa9b5b83aab2c108dfeda0ed4547ad6edb0df14657e2c6c8d7dbe22367b7f57b5c2e6be2f995b2d3a5e3464aa4655f895cb559e4babdafd5d777', 'member'),
(23, 'ppp', '$argon2id$v=19$m=65536,t=4,p=1$Y1Y0aHNRVzYwc0VVejdjTw$5Zp4J3KyR+AYyCLhjgAGCwkI5S7k5nvF2YoJKR8Ft68', 'b1016a4d19191ee4f7ef31939d1df6d2e6c0f776e6169fc5adfc0d1e3ed042baa5b8e95da363574b9005a37c7fca02d0194ad547d64723368fb99683c0dc7a133dfd92891fc2c5c363880564f23badb87e6be9113ea6263b3a8765419b77c27051a1d756e98159d7322ee286fb22eeb25b1229b662fe', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `age`, `position`, `rank`, `img`) VALUES
(4, 'จันทรา', 'วดี', '25', 'Marketing', 'employee', '65c096bdcc0ca.jpg'),
(3, 'ภูมิน', 'สีจันทร์', '32', 'Programmer', 'employee', '65c909d3bd033.jpg'),
(13, 'ภานุพงศ์', 'กากาล', '23', 'Programmer', 'employee', '65c90cdd8f6a4.jpg'),
(14, 'มนจรณ์', 'สายแก้ว', '27', 'IT-Support', 'employee', '65c90d3f06a66.jpg'),
(15, 'นพจรณ์', 'ขอนแก่น', '35', 'IT-Support', 'employee', '65c9102463d71.jpg'),
(16, 'เดอะร็อค', 'จอนสัน', '41', 'Programmer', 'employee', '65c910b2ce002.jpg'),
(17, 'Josept', 'Manderson', '29', 'Marketing', 'employee', '65dadbb843c15.png'),
(18, '111', '111', '111', '111', 'employee', '65dd5ff6941d0.png'),
(19, 'มินตรา', 'จันทร์วี', '24', 'Marketing', 'employee', '65ec44451018c.jpg'),
(20, 'Jonh', 'Razz', '31', 'Marketing', 'employee', '65ec466389599.jpg'),
(22, 'Peach', 'Maicro', '24', 'Programmer', 'employee', '65ec5043862a4.jpg'),
(23, '', '', '', '', 'employee', '');

-- --------------------------------------------------------

--
-- Table structure for table `work_io`
--

CREATE TABLE `work_io` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `workdate` date NOT NULL,
  `work_in` time NOT NULL,
  `work_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_io`
--

INSERT INTO `work_io` (`id`, `emp_id`, `workdate`, `work_in`, `work_out`) VALUES
(1, 3, '2024-02-12', '13:54:35', '14:08:33'),
(3, 13, '2024-02-12', '14:17:25', '14:17:40'),
(4, 4, '2024-02-12', '14:19:55', '14:19:58'),
(5, 16, '2024-02-12', '18:32:59', '18:33:09'),
(6, 3, '2024-02-13', '19:27:59', '19:28:05'),
(7, 3, '2024-02-14', '18:27:33', '18:27:40'),
(8, 15, '2024-02-14', '19:09:15', '19:09:17'),
(9, 16, '2024-02-14', '19:13:17', '19:13:19'),
(10, 14, '2024-02-14', '19:15:09', '19:15:11'),
(11, 3, '2024-02-18', '13:10:54', '13:10:57'),
(12, 3, '2024-02-21', '22:04:21', '22:04:25'),
(13, 13, '2024-02-24', '23:21:59', '23:22:01'),
(14, 4, '2024-02-24', '23:26:23', '23:26:26'),
(15, 3, '2024-02-24', '23:29:36', '23:29:39'),
(16, 3, '2024-02-25', '13:16:26', '13:16:27'),
(17, 4, '2024-02-27', '06:05:50', '06:05:52'),
(18, 13, '2024-02-27', '06:08:01', '06:08:03'),
(19, 14, '2024-02-27', '06:08:14', '06:08:16'),
(20, 15, '2024-02-27', '06:08:29', '06:08:30'),
(21, 18, '2024-02-27', '11:07:24', '11:07:30'),
(22, 3, '2024-02-27', '11:09:35', '11:09:38'),
(23, 3, '2024-03-08', '20:18:22', '20:18:24'),
(24, 3, '2024-03-09', '13:00:24', '13:00:38'),
(25, 19, '2024-03-09', '18:13:15', '18:19:14'),
(26, 20, '2024-03-09', '18:24:55', '18:24:58'),
(27, 22, '2024-03-09', '19:04:23', '19:04:27'),
(28, 13, '2024-03-09', '20:04:33', '20:04:41'),
(29, 3, '2024-03-10', '15:28:56', '15:28:58'),
(30, 3, '2024-03-11', '15:01:49', '16:06:45'),
(31, 13, '2024-03-11', '17:06:31', '17:06:33'),
(32, 22, '2024-03-12', '10:34:44', '10:34:47'),
(33, 3, '2024-03-13', '11:57:45', '11:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `asset_borrow`
--
ALTER TABLE `asset_borrow`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `resleave`
--
ALTER TABLE `resleave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `work_io`
--
ALTER TABLE `work_io`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `asset_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asset_borrow`
--
ALTER TABLE `asset_borrow`
  MODIFY `b_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resleave`
--
ALTER TABLE `resleave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `account_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `work_io`
--
ALTER TABLE `work_io`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

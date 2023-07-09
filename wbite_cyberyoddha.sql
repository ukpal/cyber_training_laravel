-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 06:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbite_cyberyoddha`
--

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `username` varchar(250) DEFAULT NULL,
  `token` varchar(256) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `otp_created_on` datetime NOT NULL,
  `otp_count` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `yoddha_id` int(11) NOT NULL,
  `assigner_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('completed','pending') NOT NULL DEFAULT 'pending',
  `title` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `what_to_do` text DEFAULT NULL,
  `docs` text DEFAULT NULL,
  `end_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `yoddha_id`, `assigner_id`, `created_at`, `updated_at`, `status`, `title`, `url`, `what_to_do`, `docs`, `end_at`) VALUES
(2, 2, 12, '2022-05-11', NULL, 'completed', 'Task One', 'http://fb.com', 'description', '[\"1652279530772Survey Result (2).pdf\",\"1652279530460pexels-grabstar-io-8306403.jpg\"]', NULL),
(3, 2, 12, '2022-05-12', NULL, 'pending', 'demo titla', 'http://fb.com', 'analyze', '[\"1652355309275Survey Result (2).pdf\",\"1652355309628pexels-grabstar-io-8306403.jpg\"]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_reply`
--

CREATE TABLE `task_reply` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL COMMENT 'reply,comment,change-status,reopen',
  `status` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `report_files` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_reply`
--

INSERT INTO `task_reply` (`id`, `task_id`, `action`, `status`, `comments`, `observation`, `report_files`, `created_at`, `role`, `user_id`) VALUES
(1, 2, 'reply', 'active', NULL, 'test observation', '[\"1652340585227Instruction for File submission for magazine.pdf\"]', '2022-05-12', 'yoddha-member', 2),
(2, 2, 'comment', NULL, 'check point number 3 and evaluate', NULL, NULL, '2022-05-12', 'mentor-group', 12),
(3, 2, 'comment', 'completed', 'task is now completed', NULL, NULL, '2022-05-12', 'mentor-group', 12),
(4, 2, 'comment', 'active', 'upload one more document', NULL, NULL, '2022-05-12', 'mentor-group', 12),
(5, 2, 'change-status', 'completed', NULL, NULL, NULL, '2022-05-12', 'mentor-group', 12),
(6, 2, 'reopen', 'pending', 're-opening task', NULL, NULL, '2022-05-18', 'mentor-group', 12),
(7, 2, 'comment', NULL, 'new comment', NULL, NULL, '2022-05-18', 'mentor-group', 12),
(8, 2, 'comment', 'completed', NULL, NULL, NULL, '2022-05-30', 'system-admin', 16),
(12, 3, 'reply', NULL, NULL, 'wwwwwwwwwwwwwwwwwww', '[\"1653901034352Datasheet PN_ NX.GY9SI.003.pdf\"]', '2022-05-30', 'yoddha-member', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `token` varchar(256) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `is_loggedin` smallint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `token`, `email`, `password`, `designation`, `organisation`, `role`, `profile_photo`, `created_at`, `updated_at`, `is_active`, `last_login`, `is_loggedin`) VALUES
(1, 'SANJOY CHOWDHURY', '9382492931', '864d30d4f6483a518a2374d0408f54451f5e22dce5a7e4bc1d1942d385fa1038bc70eb4894167900f37a0021fab0344b99f1087a9c1434c1f29e9f184827a820', 'ukpzoom4@gmail.com', NULL, 'director', NULL, 'director', '1.jpg', '2021-12-02 21:56:13', NULL, 1, NULL, 0),
(2, 'SANJOY CHOWDHURY', '9434119317', 'a43dd2edaf4c5abe8ea0612d47dedd34030f7670ec0a47443201628e16ea543e166808f6ce0cd6162895f31f4f5c453126954b358ed5e9f7fbd343e5bc60bae8', 'sanjoyc@aranaxweb.com', NULL, 'DIRECTOR', 'ARANAX TECHNOLOGIES', 'scrutiny-committee', '2.jpg', '2021-12-02 21:56:13', NULL, 1, NULL, 0),
(3, 'KOUSIK PAN', '6296520178', '54bcff53992c500fa81a0fe5d243caf359c503e3e6743db5307abdb314450aff16ebc36ff0b185481acd5acfe4c63e1dcee7a64f510d8382210419bf82cbf79f', 'kousik@aranaxweb.com', NULL, 'MEMBER', 'ARANAX TECHNOLOGIES', 'scrutiny-committee', '3.jpg', '2021-12-02 21:56:13', NULL, 1, NULL, 0),
(10, 'ARNAB ROY', '8754862415', 'b60735668314e4eeb0563c3ba722499e22984e9874efc7dc8cf9d87f410772fafb473ad630b1e6df53f97c5dd0398ff09e875ace28a66fbdb7cabdb6ca4861a1', 'arnabroy466@gmail.com', NULL, 'MEMBER', 'ARANAX TECHNOLOGY PVT LTD.', 'mentor-group', '3.jpg', '2022-01-18 12:09:07', NULL, 1, NULL, 0),
(11, 'ANANTA ROY', '9382492931', 'a3c78bdb53c22f8bc05b6dc5e3b859164dd4eda75fa14ec7254290aa32bb13accd250e8cf7caa030d8df89b91a0f0692c6d69335d30cb031c436be19a0425ac5', 'TESTEMAIL@GMAIL.COM', NULL, 'MEMBER', 'SAMPLE DEPOT', 'scrutiny-committee', NULL, '2022-03-15 11:05:30', NULL, 1, NULL, 0),
(12, 'ANANTA ROY', '9382492931', 'a3c78bdb53c22f8bc05b6dc5e3b859164dd4eda75fa14ec7254290aa32bb13accd250e8cf7caa030d8df89b91a0f0692c6d69335d30cb031c436be19a0425ac5', 'TESTEMAIL@GMAIL.COM', NULL, 'MEMBER', 'SAMPLE DEPOT', 'mentor-group', NULL, '2022-03-15 11:05:31', NULL, 1, NULL, 0),
(14, 'PROMOTESH MONDAL', '0000000000', '61be99178d159d42ce876802295d3624ab42c7cb3578442d5124e802c2f2319e30d1a25b776c1f707c0e6fbd618bf1446bf424d527e3207f86997d962bdcf1ad', '000@WB.GOV.IN', NULL, 'RSD', 'SNLTR', 'scrutiny-committee', NULL, '2022-05-10 14:46:23', NULL, 1, NULL, 0),
(15, 'PROMOTESH MONDAL', '0000000000', '61be99178d159d42ce876802295d3624ab42c7cb3578442d5124e802c2f2319e30d1a25b776c1f707c0e6fbd618bf1446bf424d527e3207f86997d962bdcf1ad', '000@wb.gov.in', NULL, 'RSD', 'SNLTR', 'mentor-group', NULL, '2022-05-10 14:46:23', NULL, 1, NULL, 0),
(16, 'Umakanta Pal', '0000000000', '040b72fa406f597bbea02e58a63989f4a136e73d85eab4b2f5d2ac0545faff0ed5b145fd144a9e342206fdc2ec3612018edd1a8b389ca5a3322c06b4e0518ff2', 'ukp@gmail.com', '123456', 'Admin', 'SNLTR', 'system-admin', NULL, '2022-05-17 13:01:37', '2022-05-17 09:29:03', 1, '2022-05-17 09:29:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yoddha_registrations`
--

CREATE TABLE `yoddha_registrations` (
  `id` int(21) NOT NULL,
  `c_prmt_adress` smallint(5) NOT NULL COMMENT '1=yes,0=no',
  `c_name` varchar(255) NOT NULL,
  `c_phone_no` varchar(50) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_dob` date DEFAULT NULL,
  `cand_step` varchar(50) NOT NULL,
  `c_last_status` varchar(255) NOT NULL,
  `c_org` varchar(255) DEFAULT NULL,
  `c_cntribut1` varchar(255) DEFAULT NULL,
  `c_cntribut2` varchar(255) DEFAULT NULL,
  `c_cntribut3` varchar(255) DEFAULT NULL,
  `c_prf_crtf` int(11) NOT NULL COMMENT '1=yes,0=no',
  `c_year_exp` varchar(50) NOT NULL,
  `c_month_exp` varchar(50) NOT NULL,
  `c_req_crtf` smallint(10) NOT NULL COMMENT '1=yes,0=no',
  `c_awrd_crtf` varchar(255) DEFAULT NULL,
  `c_publc_crtf` smallint(10) NOT NULL COMMENT '1=yes,0=no',
  `c_papr_crtf` varchar(255) DEFAULT NULL,
  `c_thng_crtf` smallint(10) NOT NULL COMMENT '1=yes,0=no',
  `c_thougt_crtf` varchar(255) DEFAULT NULL,
  `othr_inf` text DEFAULT NULL,
  `c_cv` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `c_role` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yoddha_registrations`
--

INSERT INTO `yoddha_registrations` (`id`, `c_prmt_adress`, `c_name`, `c_phone_no`, `c_email`, `c_dob`, `cand_step`, `c_last_status`, `c_org`, `c_cntribut1`, `c_cntribut2`, `c_cntribut3`, `c_prf_crtf`, `c_year_exp`, `c_month_exp`, `c_req_crtf`, `c_awrd_crtf`, `c_publc_crtf`, `c_papr_crtf`, `c_thng_crtf`, `c_thougt_crtf`, `othr_inf`, `c_cv`, `status`, `c_role`, `create_date`, `create_by`) VALUES
(1, 1, 'Arnab Roy', '8159097432', 'arnab@gmail.com', '1998-05-23', 'Industry Professional', 'Full time job', 'aranax technologies pvt ltd.', 'con1', 'con2', 'con3', 1, '1', '0', 1, 'certificate', 1, 'yes i do', 1, 'in my home', 'i m a developer', 'upload/yoddha_register/Arnab Roy20220119063826.pdf', 'approved', 'member', '2022-01-19 06:38:26', 0),
(3, 1, 'jhon doe', '8754862415', 'testemail@gmail.com', '2022-01-01', 'Student', 'Under Graduate', 'sample depot', 'aa', 'aaa', 'aaaa', 0, '0', '0', 0, NULL, 0, NULL, 0, NULL, 'dummy record', 'upload/yoddha_register/jhon doe20220119065233.pdf', 'approved', 'member', '2022-01-19 06:52:33', 0),
(4, 1, 'aa', '8159097432', 'zr@gmail.com', '2022-04-05', 'Student', 'School Level', 'test com', 'aa', 'con2', 'con3', 0, '0', '0', 0, NULL, 0, NULL, 0, NULL, 'ss', 'upload/yoddha_register/aa20220405115108.pdf', 'approved', NULL, '2022-04-05 11:51:08', 0),
(9, 1, 'fffff', '9382492931', 'fg@dfg.cv', '2022-05-19', 'Industry Professional', 'Full time job', 'aaaaaaaa', NULL, NULL, NULL, 0, '0', '0', 0, NULL, 0, NULL, 0, NULL, NULL, 'upload/yoddha_register/fffff20220519073248.pdf', 'rejected', NULL, '2022-05-19 07:32:48', 0),
(11, 1, 'sss', '9382492931', 'ukp@gmail.com', '2022-05-20', 'Student', 'School Level', NULL, NULL, NULL, NULL, 1, '1', '0', 0, NULL, 0, NULL, 0, NULL, NULL, 'upload/yoddha_register/sss20220520041535.pdf', 'pending', NULL, '2022-05-20 04:15:35', 0),
(12, 1, 'nnnnnn', '9382492931', 'ukp@gmail.vob', '2022-05-20', 'Industry Professional', 'Full time job', 'aranax', NULL, NULL, NULL, 1, '2', '0', 0, NULL, 0, NULL, 1, 'demo', NULL, 'upload/yoddha_register/nnnnnn20220520041647.pdf', 'pending', NULL, '2022-05-20 04:16:47', 0),
(13, 1, 'Surajit', '5959595959', 'surajit@gmail.com', '2022-05-20', 'Student', 'Under Graduate', NULL, NULL, NULL, NULL, 0, '0', '0', 0, NULL, 0, NULL, 0, NULL, NULL, 'upload/yoddha_register/Surajit20220520094430.pdf', 'approved', NULL, '2022-05-20 09:44:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yoddha_scutiny`
--

CREATE TABLE `yoddha_scutiny` (
  `s_id` int(11) NOT NULL,
  `yoddha_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `s_status` varchar(20) NOT NULL,
  `s_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yoddha_scutiny`
--

INSERT INTO `yoddha_scutiny` (`s_id`, `yoddha_id`, `user_id`, `s_status`, `s_remarks`) VALUES
(1, 1, 11, 'recommended', 'good'),
(2, 3, 11, 'not_recommended', 'bad'),
(3, 4, 11, 'recommended', 'gygkgbk'),
(4, 4, 2, 'not_recommended', 'hfcfvfvyj'),
(5, 5, 11, 'recommended', 'ffffffffff');

-- --------------------------------------------------------

--
-- Table structure for table `yoddha_spoc`
--

CREATE TABLE `yoddha_spoc` (
  `spoc_id` int(11) NOT NULL,
  `spoc_yoddha_team_id` int(11) NOT NULL,
  `spoc_yoddha_reg_id` int(11) NOT NULL,
  `spoc_nm` varchar(100) NOT NULL,
  `spoc_start_dt` date DEFAULT NULL,
  `spoc_end_dt` date DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `edit_by` int(11) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yoddha_spoc`
--

INSERT INTO `yoddha_spoc` (`spoc_id`, `spoc_yoddha_team_id`, `spoc_yoddha_reg_id`, `spoc_nm`, `spoc_start_dt`, `spoc_end_dt`, `create_by`, `create_date`, `edit_by`, `edit_date`) VALUES
(1, 1, 1, 'ARNAB ROY', '2022-03-25', '2022-03-25', 12, '2022-03-25 08:09:30', 12, '2022-03-25 13:39:30'),
(2, 2, 3, 'JHON DOE', '2022-03-25', '2022-04-26', 12, '2022-04-26 09:00:46', 1, '2022-04-26 14:30:46'),
(3, 1, 1, 'ARNAB ROY', '2022-04-26', '2022-05-08', 1, '2022-05-08 14:39:16', 12, '2022-05-08 20:09:16'),
(4, 3, 4, 'AA', '2022-05-08', NULL, 12, '2022-05-08 14:39:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yoddha_team`
--

CREATE TABLE `yoddha_team` (
  `id` int(11) NOT NULL,
  `yoddha_reg_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `token` varchar(256) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `y_status` varchar(100) NOT NULL,
  `profile_photo` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `is_loggedin` smallint(1) NOT NULL DEFAULT 0,
  `current_task` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yoddha_team`
--

INSERT INTO `yoddha_team` (`id`, `yoddha_reg_id`, `fullname`, `phone`, `token`, `email`, `password`, `designation`, `organisation`, `role`, `y_status`, `profile_photo`, `created_at`, `updated_at`, `is_active`, `last_login`, `is_loggedin`, `current_task`) VALUES
(1, 1, 'ARNAB ROY', '8159097432', '0b8f56c4a564b6aea6e872aa02cddbc3de2769220cf9cd46d36171d7d6349d3458a5bf8deb688531d98df91ea4d98b91d1d54111c1d3ebf015834a0a175c8bac', 'arnab@gmail.com', NULL, 'INDUSTRY PROFESSIONAL', 'ARANAX TECHNOLOGIES PVT LTD.', 'yoddha-member', 'approved', NULL, '2022-03-25 12:10:28', NULL, 0, NULL, 0, 0),
(2, 3, 'JHON DOE', '8754862415', '3e0a18a1778a0a507dfbb9a9667d612554c742c187b4022c3b9179b15224a8a0efd7e3e3b9e812dde0aa4280bf86d40ce02fcbffd12d7b8454a5719604c33e61', 'testemail@gmail.com', NULL, 'STUDENT', 'SAMPLE DEPOT', 'yoddha-member', 'approved', NULL, '2022-03-25 12:10:46', NULL, 1, NULL, 0, 0),
(3, 4, 'AA', '8159097432', 'a89b69a64c4a71e9cb49a52997ce0cd788932215103e6579cc4f5a42bfb2c94f1883281bdadfc369db8c63364c56b727bdc050e06f7c19e36c68f2b63d1427dc', 'zr@gmail.com', NULL, 'STUDENT', 'TEST COM', 'spoc', 'approved', NULL, '2022-05-08 20:04:32', NULL, 1, NULL, 0, 0),
(4, 5, 'UMAKANTA PAL', '9382492931', '49be1ad3203f00d8e1313af4ef1b9191fa084461307ffa5e1cddf4ee08c7fb69af9f13eb4f4f33c691cf654484108964d5da4e9fc27d85301df77252bf367229', 'ukpzoom4@gmail.com', NULL, 'INDUSTRY PROFESSIONAL', 'ARANAX', 'yoddha-member', 'approved', NULL, '2022-05-10 14:56:22', NULL, 1, NULL, 0, 0),
(5, 13, 'SURAJIT', '5959595959', '', 'surajit@gmail.com', NULL, 'STUDENT', '', 'yoddha-member', 'approved', NULL, '2022-05-20 15:58:37', NULL, 1, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD KEY `email` (`username`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yoddha_id` (`yoddha_id`);

--
-- Indexes for table `task_reply`
--
ALTER TABLE `task_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yoddha_registrations`
--
ALTER TABLE `yoddha_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yoddha_scutiny`
--
ALTER TABLE `yoddha_scutiny`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `yoddha_spoc`
--
ALTER TABLE `yoddha_spoc`
  ADD PRIMARY KEY (`spoc_id`);

--
-- Indexes for table `yoddha_team`
--
ALTER TABLE `yoddha_team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_reply`
--
ALTER TABLE `task_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `yoddha_registrations`
--
ALTER TABLE `yoddha_registrations`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `yoddha_scutiny`
--
ALTER TABLE `yoddha_scutiny`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `yoddha_spoc`
--
ALTER TABLE `yoddha_spoc`
  MODIFY `spoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yoddha_team`
--
ALTER TABLE `yoddha_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`yoddha_id`) REFERENCES `yoddha_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `#__jdg_judges`
--

DROP TABLE IF EXISTS `#__jdg_judges`;
CREATE TABLE IF NOT EXISTS `#__jdg_judges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `judge_abbreviation` varchar(3) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `judgestatus` tinyint(1) NOT NULL,
  `judgelevel` tinyint(1) NOT NULL,
  `licensed` int(11) DEFAULT NULL,
  `licensed_until` date DEFAULT NULL,
  `airport` varchar(50) DEFAULT NULL,
  `judge_of_merit` tinyint(1) DEFAULT '0',
  `judge_emeritus` tinyint(1) DEFAULT '0',
  `distinguished_judge` tinyint(1) DEFAULT '0',
  `ring_instructor` tinyint(1) DEFAULT '0',
  `school_instructor` tinyint(1) DEFAULT '0',
  `genetics_instructor` tinyint(1) DEFAULT '0',
  `international` tinyint(1) DEFAULT '0',
  `other` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jdg_judges`
--

INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(1, 1001, 'JAL', '1001_B1ayeaotKs.jpg', 1, 4, 2011, '0000-00-00', 'LHR', 0, 0, 0, 0, 0, 0, 0, ''),
(2, 1002, 'TA', 'andersen_thomas.jpg', 1, 4, 2002, '0000-00-00', 'CPH', 0, 0, 0, 0, 0, 0, 1, ''),
(3, 1003, 'VLA', '1003_zR0VEwjHXw.jpg', 1, 5, 2012, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(4, 1004, 'JA', '1004_tkegxit0Bn.jpg', 1, 3, 2012, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(5, 1005, 'CA', 'arrieta_carlos.jpg', 2, 0, 1989, '0000-00-00', 'EZE', 0, 0, 0, 0, 0, 0, 1, ''),
(6, 1006, 'RB', '', 4, 3, 1994, '0000-00-00', '', 1, 1, 0, 0, 0, 0, 1, '2007 Judge of the Year'),
(7, 1007, 'DB', '', 4, 4, 1998, '0000-00-00', NULL, 0, 1, 1, 0, 0, 0, 0, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(8, 1008, 'CB', 'barton_carol.jpg', 1, 4, 1984, '0000-00-00', 'MRY/SJC/SFO/OAK', 0, 0, 1, 0, 0, 0, 1, ''),
(9, 1009, 'SB', '1009_LkVfv0a5pw.jpg', 4, 4, 1981, '0000-00-00', NULL, 0, 1, 1, 1, 0, 0, 0, '1989 Judge of the Year'),
(10, 1010, 'VB', 'beninya_vlada.jpg', 1, 3, 2006, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(11, 1011, 'EB', 'borras_eduard.jpg', 2, 0, 2008, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(12, 1012, 'ASB', 'broing_asa.jpg', 1, 4, 2012, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(13, 1013, 'DJB', 'brown_debbi.jpg', 1, 4, 1988, '0000-00-00', 'ACT/DFW/AUS', 0, 0, 1, 0, 0, 0, 1, ''),
(14, 1014, 'JBU', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(15, 1015, 'CC', 'campala_catherine.jpg', 1, 3, 2002, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(16, 1016, 'KC', 'chenault_kim.jpg', 1, 4, 2011, '0000-00-00', 'CVG/DAY', 0, 0, 0, 0, 0, 0, 1, ''),
(18, 1018, 'SC', 'corneille_steven.jpg', 1, 4, 2013, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '2016 Judge of the Year'),
(19, 1019, 'JC', 'creech_john.jpg', 5, 0, 2002, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(20, 1020, 'LC', 'cunningham_laura.jpg', 1, 4, 1999, '0000-00-00', 'OAK/SFO', 0, 0, 0, 0, 0, 0, 1, ''),
(21, 1021, 'VD', NULL, 2, 5, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(22, 1022, 'HDV', 'devilbiss_harley.jpg', 1, 4, 2003, '0000-00-00', 'AUS', 0, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(23, 1023, 'LD', 'dickie_lisa.jpg', 1, 3, 2002, '0000-00-00', 'BWI/DCA/IAD', 0, 0, 0, 0, 0, 0, 1, ''),
(24, 1024, 'JE', 'edwards_aubrey.jpg', 1, 4, 1984, '0000-00-00', 'DFW', 0, 0, 1, 1, 0, 0, 1, '2006 Judge of the Year'),
(25, 1025, 'LPF', 'faccioli_luiz.jpg', 1, 0, 1993, '0000-00-00', 'POA/GRU', 1, 0, 0, 1, 1, 0, 1, ''),
(26, 1026, 'VF', 'fisher_vickie.jpg', 1, 4, 1993, '0000-00-00', 'ABQ', 1, 0, 0, 1, 0, 0, 1, ''),
(27, 1027, 'ANG', '1027_5xh7GkCToj.jpg', 1, 4, 1988, '0000-00-00', NULL, 0, 0, 1, 1, 0, 0, 0, ''),
(28, 1028, 'MGR', 'gregg_marilyne.jpg', 1, 4, 1980, '0000-00-00', 'ORF/PGV', 0, 0, 1, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(29, 1029, 'HG', '1029_uJvdIighgb.jpg', 1, 3, 2004, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(30, 1030, 'EH', 'hammond_elektra.jpg', 1, 4, 2000, '0000-00-00', 'PHL/BWI', 0, 0, 0, 0, 0, 0, 1, ''),
(31, 1031, 'MAH', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(32, 1032, 'VJH', 'harrison_vicki.jpg', 1, 4, 1995, '0000-00-00', 'SAT', 1, 0, 0, 1, 1, 0, 1, '2012 Judge of the Year'),
(33, 1033, 'YH', 'hattori_yukimasa.jpg', 1, 4, 1980, '0000-00-00', 'NGO', 0, 0, 1, 1, 0, 0, 1, '2005 Judge of the Year'),
(34, 1034, 'FH', 'hicks_francine.jpg', 1, 4, 2002, '0000-00-00', 'PWM/MHT/BOS', 0, 0, 0, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(35, 1035, 'AH', 'hoehn_ann.jpg', 4, 4, 1988, '0000-00-00', 'ACT/DFW', 0, 1, 1, 0, 0, 0, 1, ''),
(36, 1036, 'PHO', 'holmes_phillipa.jpg', 1, 4, 2009, '0000-00-00', 'LGW/LHR', 0, 0, 0, 1, 1, 0, 0, ''),
(37, 1037, 'YI', 'iwaida_yoshiko.jpg', 2, 0, 1995, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(38, 1038, 'TJ', 'jones_toni.jpg', 1, 4, 2002, '0000-00-00', 'SAT', 0, 0, 0, 1, 1, 0, 1, ''),
(39, 1039, 'NK', 'kaizuka_nahoko.jpg', 1, 4, 2002, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(40, 1040, 'SK', 'kalani_sharon.jpg', 1, 4, 2012, '0000-00-00', 'LAX/LGB', 0, 0, 0, 0, 0, 0, 1, ''),
(41, 1041, 'KKA', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(42, 1042, 'MK', 'kikuchi_mariko.jpg', 1, 4, 1998, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(43, 1043, 'WK', 'klamm_wendy.jpg', 2, 0, 1989, '0000-00-00', 'LFT/BTR', 0, 0, 0, 0, 0, 0, 1, ''),
(44, 1044, 'RK', 'knapp_irene.jpg', 1, 4, 2006, '0000-00-00', 'TPA/ORL', 0, 0, 0, 0, 0, 0, 1, ''),
(45, 1045, 'KK', 'krenn_katharina.jpg', 1, 4, 2010, '0000-00-00', 'VIE', 0, 0, 0, 1, 1, 0, 1, ''),
(46, 1046, 'PL', 'lahey_paul.jpg', 1, 4, 1990, '0000-00-00', 'PHL/BWI', 0, 0, 1, 0, 0, 0, 1, ''),
(47, 1047, 'MLD', 'landtsheer_marylise.jpg', 1, 4, 1999, '0000-00-00', 'BRU', 0, 0, 0, 1, 1, 0, 1, ''),
(48, 1048, 'SLA', 'lawson_steve.jpg', 1, 4, 2011, '0000-00-00', 'TPA/SRQ', 0, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(49, 1049, 'SHH', 'lee_sun.jpg', 1, 5, 2014, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, 'AA Only'),
(50, 1050, 'BL', 'lee_william.jpg', 2, 0, 2004, '0000-00-00', 'LAN/DTW/FNT/GRR', 0, 0, 0, 0, 0, 0, 1, ''),
(51, 1051, 'LL', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(52, 1052, 'CL', 'lopez_carlos.jpg', 1, 4, 1998, '0000-00-00', 'EZE', 0, 0, 0, 1, 1, 0, 1, ''),
(53, 1053, 'EM', NULL, 2, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(54, 1054, 'FM', 'mays_lafayette.jpg', 1, 4, 1991, '0000-00-00', 'CRP', 0, 0, 1, 1, 1, 0, 1, '1997 Judge of the Year'),
(55, 1055, 'BM', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(56, 1056, 'GM', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(57, 1057, 'MN', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(58, 1058, 'EO', 'odaka_eriko.jpg', 1, 4, 1989, '0000-00-00', '', 0, 0, 1, 0, 0, 0, 1, ''),
(59, 1059, 'MO', 'oizumi_motoko.jpg', 1, 4, 1988, '0000-00-00', '', 0, 0, 1, 1, 0, 0, 1, ''),
(60, 1060, 'NP', '1060_E5n8HNEzcF.jpg', 1, 4, 1986, '0000-00-00', NULL, 0, 0, 1, 1, 1, 0, 0, '2003 Judge of the Year'),
(61, 1061, 'YP', 'patrick_yvonne.jpg', 1, 4, 1979, '0000-00-00', 'YVR/BLI/SEA', 0, 0, 1, 1, 1, 0, 1, '1986 Judge of the Year');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(62, 1062, 'SP', 'pflueger_solveig.jpg', 2, 0, 1979, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, '1992 Judge of the Year'),
(63, 1063, 'PP', 'portelas_pascale.jpg', 1, 4, 1994, '0000-00-00', 'NTE', 1, 0, 0, 1, 1, 0, 1, ''),
(64, 1064, 'JR', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(65, 1065, 'PR', 'remy_pascal.jpg', 1, 4, 2005, '0000-00-00', 'LYS/GVA', 0, 0, 0, 0, 0, 0, 1, ''),
(66, 1066, 'AR', NULL, 2, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(67, 1067, 'JRO', 'roberts_jeffrey.jpg', 2, 0, 2005, '0000-00-00', 'SMF/SFO', 0, 0, 0, 0, 0, 0, 1, ''),
(68, 1068, 'BRU', 'russo_brenda.jpg', 1, 4, 2012, '0000-00-00', 'PHL/BWI/EWR/JFK', 0, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(69, 1069, 'SS', 'savant_steven.jpg', 1, 4, 1985, '0000-00-00', 'LFT', 0, 0, 1, 1, 1, 0, 1, ''),
(70, 1070, 'ASM', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(71, 1071, 'RSK', 'seliskar_robert.jpg', 1, 3, 2007, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(72, 1072, 'AS', 'shchukin_alexey.jpg', 1, 3, 1997, '0000-00-00', '', 1, 0, 0, 0, 0, 0, 1, ''),
(73, 1073, 'LOS', 'shelton_lorraine.jpg', 1, 3, 2013, '0000-00-00', 'LAX/ONT/SNA', 0, 0, 0, 0, 0, 1, 1, ''),
(74, 1074, 'VS', 'shields_vickie.jpg', 1, 4, 1989, '0000-00-00', 'ABQ', 0, 0, 1, 1, 1, 0, 1, ''),
(75, 1075, 'EMS', 'smith_edith-mary.jpg', 1, 4, 1986, '0000-00-00', 'YWG', 0, 0, 1, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(76, 1076, 'AMS', 'sosa_ana.jpg', 1, 3, 2003, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(77, 1077, 'HT', 'tasaki_hisae.jpg', 1, 4, 2005, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(78, 1078, 'HTO', 'tomonari_haruyo.jpg', 1, 4, 1988, '0000-00-00', '', 0, 0, 1, 1, 0, 0, 1, ''),
(79, 1079, 'BT', 'tullo_bobbie.jpg', 5, 0, 1982, '0000-00-00', 'PHX', 0, 0, 0, 0, 0, 0, 1, '2000 Judge of the Year'),
(80, 1080, 'KV', 'vlach_kurt.jpg', 1, 4, 1999, '0000-00-00', '', 0, 0, 0, 1, 1, 0, 1, ''),
(81, 1081, 'AW', 'walbrun_allen.jpg', 1, 4, 1998, '0000-00-00', 'JAN', 0, 0, 0, 1, 1, 0, 1, ''),
(82, 1082, 'RW', 'whyte_robert.jpg', 1, 4, 1997, '0000-00-00', 'JAN', 1, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(83, 1083, 'LW', NULL, 2, 5, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(84, 1084, 'NY', 'yano_nozomu.jpg', 1, 3, 1995, '0000-00-00', '', 1, 0, 0, 0, 0, 0, 1, ''),
(85, 1085, 'JY', NULL, 2, 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(86, 1086, 'FYG', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(87, 1087, 'RA', 'allen_roslyn.jpg', 2, 0, 0, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(88, 1088, 'MA', 'anderson_marylou.jpg', 1, 4, 2001, '0000-00-00', '', 0, 0, 0, 1, 1, 0, 1, ''),
(89, 1089, 'DA', 'armel_donna.jpg', 1, 3, 2012, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(90, 1090, 'MAR', 'arnold_mary.jpg', 1, 4, 1986, '0000-00-00', 'MRY/SJC/SFO', 0, 0, 1, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(91, 1091, 'LKA', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(92, 1092, 'JB', '1092_xTsYlzNmTr.jpg', 1, 4, 2006, '0000-00-00', 'OAK/SFO', 0, 0, 0, 0, 0, 0, 1, ''),
(93, 1093, 'PB', 'barrett_pamela.jpg', 1, 4, 1987, '0000-00-00', 'PDX', 0, 0, 1, 0, 0, 0, 1, '2015 Judge of the Year'),
(94, 1094, 'GB', 'basquine_genevieve.jpg', 1, 4, 1996, '0000-00-00', 'CDG/ORL', 1, 0, 0, 1, 1, 0, 1, ''),
(95, 1095, 'IVB', '1095_Z2q5GD3e8I.jpg', 1, 3, 2002, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(96, 1096, 'BB', 'berthelon_brigitte.jpg', 1, 3, 2006, '0000-00-00', 'CDG', 0, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(97, 1097, 'AB', 'bright_amanda.jpg', 1, 3, 1996, '0000-00-00', 'YYZ', 1, 0, 0, 0, 0, 0, 1, ''),
(99, 210, 'EV', 'cb_judge_profile_picture_210_5b4f5ee3ae930.jpg', 1, 3, 2014, '2018-02-02', 'VIE', 0, 0, 0, 0, 0, 0, 0, ''),
(100, 1100, 'MC', 'caillard_martine.jpg', 1, 4, 1995, '0000-00-00', '', 1, 0, 0, 1, 1, 0, 1, ''),
(101, 1101, 'DC', 'caruthers_don.jpg', 1, 4, 1985, '0000-00-00', 'DFW', 0, 0, 1, 1, 1, 0, 1, '1994 Judge of the Year'),
(102, 1102, 'AC', '1102_Dsy8faIKCP.jpg', 1, 4, 2005, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(103, 1103, 'MCO', 'coleman_mark.jpg', 4, 4, 1984, '0000-00-00', 'SBP', 0, 1, 1, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(104, 1104, 'NC', 'crandall-seibert_nikki.jpg', 1, 3, 2014, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, ''),
(105, 1105, 'MD', '1105_hB9xcCGiXZ.jpg', 1, 4, 2002, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(106, 1106, 'MFD', 'dendauw_marie.jpg', 4, 4, 2002, '0000-00-00', '', 0, 1, 0, 0, 0, 0, 1, ''),
(107, 1107, 'KDV', 'devilbiss_kay.jpg', 1, 4, 1999, '0000-00-00', 'AUS', 0, 0, 0, 0, 0, 0, 1, ''),
(108, 1108, 'RD', 'doi_ryoko.jpg', 1, 4, 2002, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(109, 1109, 'WJV', 'eijkhof_willem-jan.jpg', 2, 0, 0, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(110, 1110, 'AF', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(111, 1111, 'FG', 'gagern_francesca.jpg', 1, 4, 2002, '0000-00-00', 'VIE', 0, 0, 0, 0, 0, 0, 1, ''),
(112, 1112, 'PG', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(113, 1113, 'LJG', 'grillo_lindajean.jpg', 1, 4, 1981, '0000-00-00', 'RNO', 0, 0, 1, 1, 1, 0, 1, '1990 Judge of the Year'),
(114, 1114, 'TH', 'hamano_tamami.jpg', 1, 3, 2003, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(115, 1115, 'MH', 'hammond_michael.jpg', 1, 3, 2002, '0000-00-00', 'PHL/BWI', 0, 0, 0, 0, 0, 0, 1, ''),
(116, 1116, 'PH', 'harding_pat.jpg', 4, 4, 1979, '0000-00-00', 'ABQ', 0, 1, 1, 0, 0, 0, 1, ''),
(117, 1117, 'SHJ', 'hart-jones_sue.jpg', 1, 3, 2011, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(118, 1118, 'EHW', '1118_pR8F1ybUMP.jpg', 1, 4, 2005, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(119, 1119, 'RH', 'higgins_robin.jpg', 1, 4, 1984, '0000-00-00', 'ATH/ATL', 0, 0, 1, 1, 0, 0, 1, ''),
(120, 1120, 'CH', 'hogan_cheryl.jpg', 4, 2, 2003, '0000-00-00', '', 0, 1, 0, 0, 0, 0, 1, ''),
(121, 1121, 'VH', 'howell_vicki.jpg', 2, 0, 2008, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(122, 1122, 'MI', 'iwata_mamiko.jpg', 1, 2, 1997, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(123, 1123, 'LJ', 'judge_lynn.jpg', 4, 4, 1989, '0000-00-00', 'YVR/BLI/SEA/YXX', 0, 1, 1, 0, 0, 0, 1, ''),
(124, 1124, 'AK', '1124_ZSfACxhbRk.jpg', 1, 4, 1992, '0000-00-00', NULL, 0, 0, 1, 1, 1, 1, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(125, 1125, 'YK', '1125_cafI0o2fJ1.jpg', 2, 4, 1988, '0000-00-00', NULL, 0, 0, 1, 0, 0, 0, 0, ''),
(126, 1126, 'TK', 'kempton_theresa.jpg', 1, 4, 2008, '0000-00-00', 'TPA', 0, 0, 0, 0, 0, 0, 1, ''),
(127, 1127, 'BK', 'kissinger_barbara.jpg', 1, 4, 2007, '0000-00-00', 'MCO', 0, 0, 0, 0, 0, 0, 1, ''),
(128, 1128, 'CK', 'knapp_clint.jpg', 1, 4, 2010, '0000-00-00', 'TPA/ORL', 0, 0, 0, 0, 0, 0, 0, ''),
(129, 1129, 'DAK', 'kovic_d\'ann.jpg', 1, 4, 1988, '0000-00-00', 'DFW', 0, 0, 1, 1, 1, 0, 1, ''),
(130, 1130, 'JML', 'lagarde_jean.jpg', 1, 4, 2007, '0000-00-00', 'TLS', 0, 0, 0, 0, 0, 0, 1, ''),
(131, 1131, 'OL', 'lamoureux_odette.jpg', 1, 4, 1994, '0000-00-00', 'YUL', 1, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(132, 1132, 'CLA', 'lawson_carol.jpg', 1, 4, 2011, '0000-00-00', 'TPA/SRQ', 0, 0, 0, 0, 0, 0, 1, ''),
(133, 1133, 'AL', 'leal_alberto.jpg', 1, 4, 1989, '0000-00-00', '', 0, 0, 1, 1, 1, 0, 1, '2009 Judge of the Year'),
(134, 1134, 'SL', 'lee_susan.jpg', 2, 0, 2006, '0000-00-00', 'LAN/DTW/FNT/GRR', 0, 0, 0, 0, 0, 0, 1, ''),
(135, 1135, 'DL', 'lewis_dorothy.jpg', 2, 0, 1980, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(136, 1136, 'DLO', 'lopeman_debbie.jpg', 1, 4, 2000, '0000-00-00', 'BMI/ORD/MDW', 0, 0, 0, 1, 0, 0, 1, ''),
(137, 3573, 'DM', 'madison_donna.jpg', 1, 4, 2004, '0000-00-00', 'PWM/MHT/BOS', 0, 0, 0, 1, 1, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(138, 1138, 'SMA', '1138_xsKNLDBHRo.jpg', 1, 4, 2000, '0000-00-00', 'PHX', 0, 0, 0, 0, 0, 0, 1, ''),
(139, 1139, 'KM', '1139_7RO0Ks07Hl.jpg', 1, 4, 1984, '0000-00-00', NULL, 0, 0, 1, 1, 0, 0, 0, ''),
(140, 1140, 'TM', 'meisberger_toni.jpg', 1, 3, 2013, '0000-00-00', 'ABI', 0, 0, 0, 0, 0, 0, 1, ''),
(141, 1141, 'NN', 'nolen_nancy.jpg', 4, 4, 1984, '0000-00-00', 'ACT/DFW', 0, 1, 1, 0, 0, 0, 1, '1991 Judge of the Year'),
(142, 1142, 'DN', 'nudleman_david.jpg', 1, 3, 2011, '0000-00-00', 'JFK/LGA', 0, 0, 0, 0, 0, 0, 1, ''),
(143, 1143, 'CO', 'ohira_chieko.jpg', 2, 0, 1979, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, '1996 Judge of the Year');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(144, 1144, 'HO', 'osada_hiromi.jpg', 1, 4, 2001, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(145, 1145, 'MPA', 'parsley_melissa.jpg', 1, 4, 2000, '0000-00-00', 'SEA', 0, 0, 0, 0, 0, 0, 1, ''),
(146, 1146, 'LP', '1146_6gAjH6biAR.jpg', 1, 3, 2011, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(147, 1147, 'MP', 'picardello_angelo.jpg', 1, 4, 1993, '0000-00-00', 'FCO', 1, 0, 0, 1, 1, 1, 1, ''),
(148, 1148, 'BR', 'ray_barbara.jpg', 1, 4, 1990, '0000-00-00', 'BHM', 0, 0, 1, 0, 0, 0, 1, ''),
(149, 1149, 'JRE', 'reardon_james.jpg', 2, 0, 2002, '0000-00-00', 'BOS', 0, 0, 0, 0, 0, 0, 0, ''),
(150, 1150, 'ARH', 'rhea_alice.jpg', 5, 0, 1988, '0000-00-00', 'LAS', 0, 0, 0, 0, 0, 0, 1, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(151, 1151, 'HR', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(152, 1152, 'DR', 'rudge_delsa.jpg', 1, 3, 2014, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, ''),
(153, 1153, 'KR', 'ruttan_kathrine.jpg', 1, 4, 1984, '0000-00-00', 'SMF', 0, 0, 0, 0, 0, 0, 1, ''),
(154, 1154, 'TS', 'scarboro_toni.jpg', 1, 4, 2010, '0000-00-00', 'HSV/BNA/BHM', 0, 0, 0, 0, 0, 0, 1, ''),
(155, 1155, 'LS', 'schiff_laurie.jpg', 1, 4, 2001, '0000-00-00', 'SNA', 0, 0, 0, 0, 0, 0, 1, ''),
(156, 1156, 'RAU', '1156_NbWdzzNRdY.jpg', 1, 4, 1998, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(157, 1157, 'CS', '1157_VwNqNP0S8m.jpg', 1, 2, 2016, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(158, 1158, 'LYS', '1158_grKbbPe8uO.jpg', 1, 4, 1986, '0000-00-00', NULL, 0, 0, 1, 1, 0, 0, 0, ''),
(159, 1159, 'JS', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(160, 1160, 'SSM', 'smith_stephanie.jpg', 1, 4, 2007, '0000-00-00', 'TYS', 0, 0, 0, 0, 0, 0, 1, ''),
(161, 1161, 'KS', 'stinson_karen.jpg', 1, 4, 2006, '0000-00-00', 'IAH/HOU', 0, 0, 0, 0, 0, 0, 1, ''),
(162, 1162, 'KT', 'tomlin_kim.jpg', 1, 4, 2007, '0000-00-00', 'MGM/BHM/ATL', 0, 0, 0, 1, 1, 0, 1, ''),
(163, 1163, 'MT', 'tsuruoka_mimi.jpg', 1, 3, 2008, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(164, 1164, 'CU', 'unangst_chris.jpg', 1, 4, 2001, '0000-00-00', 'TOL/DTW', 0, 0, 0, 0, 0, 0, 1, '2008 Judge of the Year');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(165, 1165, 'TV', 'vlach_tomoko.jpg', 1, 4, 2000, '0000-00-00', 'VIE', 0, 0, 0, 1, 0, 0, 1, ''),
(166, 1166, 'CW', 'webb_constance.jpg', 1, 0, 1992, '0000-00-00', 'PHL', 0, 0, 1, 1, 1, 0, 1, '2011 Judge of the Year'),
(167, 1167, 'GW', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(168, 1168, 'HY', 'yamada_hisako.jpg', 1, 4, 1983, '0000-00-00', 'ABQ', 0, 0, 1, 1, 1, 0, 1, ''),
(169, 5147, 'MS', '5147_LoShG2Pc5l.jpg', 1, 3, 2011, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(170, 14659, 'KYO', '14659_QnVmvocegi.jpg', 1, 3, 1997, '0000-00-00', NULL, 1, 0, 0, 0, 0, 0, 0, ''),
(171, 1171, 'FY', NULL, 2, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(172, 1210, 'TBA', NULL, 1, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(173, 3318, 'EC', '3318_37cXzbBbQt.jpg', 1, 4, 1985, '0000-00-00', NULL, 0, 0, 1, 1, 0, 0, 0, ''),
(174, 3224, 'JCH', 'christian_jamie.jpg', 1, 3, 2012, '0000-00-00', 'TOL/DTW', 0, 0, 0, 0, 0, 0, 1, '2017 Judge of the Year'),
(175, 3241, 'YME', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(176, 3242, 'NPI', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(177, 3324, 'CBR', 'brooks_canie.jpg', 1, 4, 2009, '0000-00-00', 'LAX/LGB/SNA', 0, 0, 0, 0, 0, 0, 1, ''),
(178, 3372, 'IGU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(179, 3534, 'NFR', '', 1, 5, 2018, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(180, 4749, 'EVM', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(181, 4892, 'ERR', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(182, 4893, 'CHU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(183, 4894, 'ANH', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(184, 4895, 'WAT', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(185, 4896, 'CHL', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(186, 4897, 'JVR', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(187, 5140, 'TTA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(188, 3305, 'AFE', '3305_byrwdv8fvI.jpg', 1, 5, 2016, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, 'SA Only'),
(189, 3543, 'CBA', 'baumer_christina.jpg', 0, 2, 2016, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, ''),
(190, 5079, 'IBO', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(192, 5844, 'DIS', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(193, 5845, 'VME', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(194, 6013, 'FDU', '6013_mv43DP8DNn.jpg', 1, 7, 2016, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(195, 6014, 'CCC', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(196, 6227, 'ASA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(197, 6357, 'MLV', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(200, 4535, 'DP', 'prince_debbie.jpg', 1, 3, 2014, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, ''),
(201, 6822, 'VZA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(202, 6840, 'AMI', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(203, 6975, 'MZH', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(204, 6974, 'IMY', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(205, 5641, 'ICH', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(206, 4563, 'NRU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(207, 7300, 'SBU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(208, 7301, 'PBU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(209, 7324, 'GHE', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(210, 7424, 'EFD', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(211, 7603, 'IGO', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(212, 3867, 'ALM', 'marinets_alexandra.jpg', 1, 3, 2015, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 1, ''),
(213, 3998, 'GTE', '3998_PjA0r224rb.jpg', 1, 5, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(214, 7968, 'EBR', '7968_yRg2uaNJky.jpg', 1, 7, 2014, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, '');
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(215, 8032, 'AKU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(216, 4889, 'SSH', '4889_9xyZjPLSXi.jpg', 1, 2, 2016, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(217, 5628, 'TKA', 'kalani_tatyana.jpg', 1, 2, 2015, '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, ''),
(218, 8453, 'GJP', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(219, 8466, 'AKR', '8466_NpJqEhHLUp.jpg', 1, 7, 2015, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(220, 4524, 'ASH', '4524_rL6l0q2B37.jpg', 1, 5, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(221, 6546, 'HRA', NULL, 2, 8, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(222, 4453, 'SME', '4453_Zpw1fHazff.jpg', 1, 2, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(223, 7428, 'DGU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(224, 8812, 'ABR', '8812_YPa0vDZbs1.jpg', 1, 5, 2015, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, 'SA Only'),
(225, 9009, 'ANZ', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(226, 9087, 'CHS', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(227, 9110, 'LMO', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(228, 6450, 'KHV', '6450_Kf8OJSJbn1.jpg', 1, 3, 2015, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(229, 3173, 'PGO', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(230, 9324, 'ODN', '9324_0h6yKlYbYA.jpg', 1, 5, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(231, 3202, 'HCU', '3202_jo5e5RjoNU.jpg', 1, 5, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(232, 5673, 'ACJ', '5673_IOBBKTBlbC.jpg', 1, 5, 2017, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(233, 5065, 'RHO', '5065_z6rxmVdPV0.jpg', 1, 3, 2016, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(234, 9588, 'AMB', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(235, 9725, 'YLA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(236, 9777, 'KRU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(237, 10330, 'EIG', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(238, 10388, 'FCA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(239, 4231, 'JG', '4231_TEemS6LAhi.jpg', 1, 5, 2018, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(240, 8332, 'BEL', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(241, 11329, 'YLV', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(242, 4502, 'BLW', '4502_SFj394zC1f.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(243, 8732, 'EMA', '8732_CGsPfLzRbg.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(244, 12263, 'AHV', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(245, 12262, 'IJS', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(246, 12261, 'BPG', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(247, 4648, 'CCA', '4648_eg7zotfPJQ.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(248, 8644, 'JGA', '8644_QCYkfdCTpN.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(249, 4165, 'VMO', '4165_xyOahocgR5.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(250, 13420, 'DGH', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(251, 13641, 'AAY', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(252, 13771, 'EFB', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL);
INSERT IGNORE INTO `#__jdg_judges` (`id`, `user_id`, `judge_abbreviation`, `photo`, `judgestatus`, `judgelevel`, `licensed`, `licensed_until`, `airport`, `judge_of_merit`, `judge_emeritus`, `distinguished_judge`, `ring_instructor`, `school_instructor`, `genetics_instructor`, `international`, `other`) VALUES
(253, 8300, 'RYS', '8300_Xz1IKjhFi9.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(254, 14057, 'VSA', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(255, 14425, 'GTH', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(256, 14456, 'EMU', NULL, 2, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(257, 10402, 'LDU', NULL, 1, 8, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(258, 8115, 'PFR', NULL, 1, 8, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL),
(259, 4667, 'DCR', '4667_56NSG8Wylo.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, ''),
(260, 3386, 'LVM', '3386_kyJivOn23k.jpg', 1, 8, 0, '0000-00-00', NULL, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jdg_judge_level`
--

DROP TABLE IF EXISTS `#__jdg_judge_level`;
CREATE TABLE IF NOT EXISTS `#__jdg_judge_level` (
  `judge_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `judge_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judge_fee` float DEFAULT NULL,
  `judge_level_organization` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`judge_level_id`),
  UNIQUE KEY `status_UNIQUE` (`judge_level`) USING BTREE,
  KEY `fk_judge_level__organization_idx` (`judge_level_organization`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `#__jdg_judge_level`
--

INSERT IGNORE INTO `#__jdg_judge_level` (`judge_level_id`, `judge_level`, `judge_fee`, `judge_level_organization`) VALUES
(1, 'Applicant', 0, 1),
(2, 'Approved Specialty', 0.65, 1),
(3, 'Provisional Allbreed', 0.85, 1),
(4, 'Approved Allbreed', 1.1, 1),
(5, 'Probationary Specialty', 0.55, 1),
(6, 'Guest Judge', 0.85, 1),
(7, 'Licensed Guest Judge', 0.85, 1),
(8, 'Trainee', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jdg_judge_status`
--

DROP TABLE IF EXISTS `#__jdg_judge_status`;
CREATE TABLE IF NOT EXISTS `#__jdg_judge_status` (
  `judge_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `judge_status` varchar(45) NOT NULL,
  `judge_status_organization` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`judge_status_id`),
  UNIQUE KEY `status_UNIQUE` (`judge_status`),
  KEY `fk_organization_idx` (`judge_status_organization`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jdg_judge_status`
--

INSERT IGNORE INTO `#__jdg_judge_status` (`judge_status_id`, `judge_status`, `judge_status_organization`) VALUES
(1, 'Active', 1),
(2, 'Inactive', 1),
(3, 'Suspended', 1),
(4, 'Retired', 1),
(5, 'Deceased', 1);
COMMIT;

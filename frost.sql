-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2016 at 02:56 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `frost`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_data`
--

CREATE TABLE IF NOT EXISTS `cat_data` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_data`
--

INSERT INTO `cat_data` (`cat_id`, `name`, `description`) VALUES
(1, 'Maps', ''),
(2, 'Plan & Performance Graphs', ''),
(3, 'Well Status', ''),
(4, 'REC', ''),
(5, 'Profiles', ''),
(6, 'PVT', ''),
(7, 'Core Data', ''),
(8, 'Logs', ''),
(9, 'Development Well Testing Results', ''),
(10, 'Exploratory Well Testing Results', ''),
(11, 'Locations Available', ''),
(12, 'Minutes of ADB & other meetings', ''),
(13, 'Communication', ''),
(14, 'FR & Reports', ''),
(15, 'Appraisals & Presentations', ''),
(16, 'Pressure Data', ''),
(17, 'Reference Literature', '');

-- --------------------------------------------------------

--
-- Table structure for table `field_data`
--

CREATE TABLE IF NOT EXISTS `field_data` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `map_path` varchar(255) NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `field_data`
--

INSERT INTO `field_data` (`field_id`, `name`, `description`, `map_path`) VALUES
(1, 'Mumbai High', 'Bombay High, also known as Mumbai High, is an offshore oilfield 176 kilometres (109 mi) off the coast of Mumbai, India, in about 75 m of water. The oil operations are run by India''s Oil and Natural Gas Corporation (ONGC). \n\nBombay High field was discovered by a Russian and Indian oil exploration team operating from the seismic exploration vessel Academic Arkhangelsky during mapping of the Gulf of Khambhat (earlier Cambay) in 1964-67, followed by a detailed survey in 1972. The naming of the field is attributed to a team from a survey run in 1965 analysed in the Rashmi building in Peddar Road, Cumballa Hill, Bombay. The first offshore well was sunk in 1974.\n\nThis is a carbonate reservoir, the main producing zone, L-III, consisting of sedimentary cycles of lagoonal, algal mound, foraminiferal mound and then coastal marsh, capped by a post-middle Miocene shale. Bombay High has three blocks separated by east-west trending faults, all three with different gas-oil contacts but approximately 1355 m deep.\n', '/uploads/western_offshore.jpg'),
(2, 'Kalol', 'Western Onshore', ''),
(3, 'Cluster 7', '', '/uploads/MH-MARGINAL.jpg'),
(4, 'WO Series', '', '/uploads/MH-MARGINAL.jpg'),
(5, 'B127', '', '/uploads/MH-MARGINAL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `repo_data`
--

CREATE TABLE IF NOT EXISTS `repo_data` (
  `field_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repo_data`
--

INSERT INTO `repo_data` (`field_id`, `cat_id`, `title`, `tags`, `content`, `path`, `filename`) VALUES
(1, 1, 'MAp', '', 'Location Map', 'uploads/Mumbai High/Maps/', '61005_1463744222_MH-loc-map.pdf'),
(1, 14, 'FDP-MHS-Phase-III', 'FDP', 'FDP', 'uploads/Mumbai High/FR & Reports/', '61005_1463745314_FDP_MHSRD Ph-III_Post Approval.pdf'),
(1, 4, 'Rec estimate 2015', 'Mumbai High', 'Layer wise rec estimate as on 01.04.2015', 'uploads/Mumbai High/REC/', '61005_1463983200_REC-2015.xls'),
(1, 4, 'Rec estimate 2015', 'Marginal Field', 'Layer wise rec estimate as on 01.04.2015', 'uploads/Mumbai High/REC/', '61005_1463983355_REC-2015-marginal fields.xls'),
(1, 14, 'MHNRD Ph-III FR post approval', '', 'Phase-III', 'uploads/Mumbai High/FR & Reports/', '61005_1464064441_FDP_MHNRD Ph-III_Post Approval.pdf'),
(1, 2, 'Production plan_May''16', '', '', 'uploads/Mumbai High/Plan & Performance Graphs/', '61005_1464064790_Prod_Plan_May16.xlsx'),
(1, 10, 'Exploratory Well Testing_MH', '', '', 'uploads/Mumbai High/Exploratory Well Testing Results/', '61005_1464068041_Testing results _expl wells.pdf'),
(1, 16, 'MHN-Pressure data', '', '', 'uploads/Mumbai High/Pressure Data/', '61005_1464068110_Press-MHN-1603-22-Mar-16.xls'),
(1, 14, 'L-I report-MHS-15-16', 'MHS', 'Simulation report PDF', 'uploads/Mumbai High/FR & Reports/', '61005_1464069293_IRS-MH-15-16-L1-MHS-IR.15.I07IMU.001_PDF-MAR2016.rar'),
(1, 14, 'S1 Simulation report-15-16', 'MHS', 'Simulation Study of S1 Reservoir of Mumbai High Field', 'uploads/Mumbai High/FR & Reports/', '61005_1464069529_IRS-MH-15-16-S1-IR.15I.07IMU.004_Word_Final.rar'),
(1, 14, 'Basal Clastic report-15-16', 'MHS', 'Performance Review of Basal Clastics in Mumbai High Field', 'uploads/Mumbai High/FR & Reports/', '61005_1464069758_IRS-MH-15-16-BC-IR.15I.07IMU.003_Word_Final.rar'),
(1, 14, 'Online Report-15-16', 'MHS', 'Waterflood Surveillance in L-III Reservoir  of Mumbai High South', 'uploads/Mumbai High/FR & Reports/', '61005_1464069856_OL_MHS_15-16_25042016_Final.rar'),
(1, 1, 'ISOBAR MAP-L-II', 'MHN', 'ISOBAR MAP MHN L-II AS ON 01.01.2016', 'uploads/Mumbai High/Maps/', '61005_1464073082_ISOBAR MAP MHN L-II AS ON 01.01.2016.pdf'),
(1, 1, 'ISOBAR MAP-L-III', 'MHN', 'ISOBAR MAP MHN L-III  AS ON 01.01.2016', 'uploads/Mumbai High/Maps/', '61005_1464073514_ISOBAR MAP MHN L-III AS ON 01.01.2016.pdf'),
(1, 1, 'ISOBAR MAP MHS L-III ', 'MHS', 'ISOBAR MAP MHS L-III AS ON 01.01.2016', 'uploads/Mumbai High/Maps/', '61005_1464073562_ISOBAR MAP MHS L-III AS ON 01.01.2016.pdf'),
(1, 1, 'ISOBAR MAP-S1-MH', 'MH', 'ISOBAR MAP S1 MH AS ON 01.01.2016', 'uploads/Mumbai High/Maps/', '61005_1464075427_ISOBAR MAP S1 MHA AS ON 01.01.2016.pdf'),
(1, 14, 'Report on Isobars', 'MH Asset', 'Report on Isobars MH Asset 2016', 'uploads/Mumbai High/FR & Reports/', '61005_1464075505_Report on Isobars+ Maps MH Asset 2016.pdf'),
(1, 2, 'All Reservoir summary', 'MH-summary', 'Monthly Reservoir production &Injection info', 'uploads/Mumbai High/Plan & Performance Graphs/', '61005_1464086666_All-reservoir-Basic-20052016.xlsm'),
(1, 16, '', '', '', 'uploads/Mumbai High/Pressure Data/', '61005_1464093201_Press-MHN-1603-22-Mar-16.xls'),
(1, 1, 'PML Map', 'PML', 'PML map of W.Offshore', 'uploads/Mumbai High/Maps/', '61005_1464172135_PML-Map-of-Western-Offshore.jpg'),
(1, 1, 'Surface Network Map of Mumbai High', 'MAP', 'Excel file showing the surface network lines', 'uploads/Mumbai High/Maps/', '61005_1464172298_MH-Surface-Network-Map.xls'),
(1, 1, 'General Stratigraphy of Mumbai High', 'Maps', 'Stratigraphy ', 'uploads/Mumbai High/Maps/', '61005_1464172477_General-Stratigraphy-WOff.pdf'),
(1, 14, '', '', '', 'uploads/Mumbai High/FR & Reports/', '61005_1464257050_'),
(1, 8, '', '', '', 'uploads/Mumbai High/Logs/', '61005_1464257092_'),
(3, 5, 'Cluster-7 Profile', '', '', 'uploads/Cluster 7/Profiles/', '61005_1465297177_Marginal Fields-MH Asset-FR- Profile.xlsx'),
(1, 1, 'Location Map of L-III MH North', '', '', 'uploads/Mumbai High/Maps/', '61005_1465297299_L-III map Update-Jun-16.pdf'),
(1, 14, 'GEOPIC Study on Basal Clastics (2016)', 'Basal Clastics', 'Reservoir Characterisation of Basal Clastics', 'uploads/Mumbai High/FR & Reports/', '61005_1465297720_Reserevoir Characterization of Basal Clastics in MH Field.pdf'),
(4, 14, 'ADB proposal of WO-16 cluster', '', 'ADB proposal of WO-16 cluster', 'uploads/WO Series/FR & Reports/', '61005_1465382821_ADB Proposal of WO-16 cluster.pdf'),
(4, 14, 'Production profile of WO series', '', 'Production profile of WO series', 'uploads/WO Series/FR & Reports/', '61005_1465382859_Profile of WO-16 cal.xls'),
(1, 1, 'Location map of L-II MH North', '', 'Location map of L-II MH North', 'uploads/Mumbai High/Maps/', '61005_1465383026_L-II Location Map_may16.pdf'),
(1, 1, 'Location Map of L-I MH North as on Jun-16', '', 'Location Map of L-I MH North', 'uploads/Mumbai High/Maps/', '61005_1465383931_L-I Location Map_Jun-16.pdf'),
(1, 14, 'Online Report_2015-16', '', 'Waterflood Surveillance in L-II and L-III Reservoir of Mumbai High North', 'uploads/Mumbai High/FR & Reports/', '61005_1465384100_Waterflood Survelliance in L-II and L-III reservoirs of MHN_2015-16.pdf'),
(3, 1, 'Oil_Isopay_L-II-TOP.REC', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452553_Oil_Isopay_L-II.pdf'),
(3, 1, 'Oil_Isopay_Mukta', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452595_Oil_Isopay_Mukta.pdf'),
(3, 1, 'Oil_Isopay_Panvel_L-I', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452624_Oil_Isopay_Panvel_L-I.pdf'),
(3, 1, 'Oil_Isopay_Panvel_L-III', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452657_Oil_Isopay_Panvel_L-III.pdf'),
(3, 1, 'Phi_he_So_L-II', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452712_Phi_he_So_L-II.pdf'),
(3, 1, '', '', '', 'uploads/Cluster 7/Maps/', '61005_1465452774_'),
(3, 1, 'Phi_he_So_Mukta', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452774_Phi_he_So_Mukta.pdf'),
(3, 1, 'Phi_he_So_Panvel_L-I', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452804_Phi_he_So_Panvel_L-I.pdf'),
(3, 1, 'Phi_he_So_Panvel_L-III', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452857_Phi_he_So_Panvel_L-III.pdf'),
(3, 1, 'Structure_L-II', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452887_Structure_L-II.pdf'),
(3, 1, 'Structure_Mukta', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452923_Structure_Mukta.pdf'),
(3, 1, 'Structure_Panvel_L-I', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465452960_Structure_Panvel_L-I.pdf'),
(3, 1, 'Structure_Panvel_L-III', '', 'REC-MAP B-192', 'uploads/Cluster 7/Maps/', '61005_1465453011_Structure_Panvel_L-III.pdf'),
(3, 2, 'FIELD PERFORMANCE-TILL DEC-2015', '', 'B-192', 'uploads/Cluster 7/Plan & Performance Graphs/', '61005_1465453166_B-192-WellPerformance.pptx'),
(3, 6, 'B-192-10 Gas Report', '', 'Gas report', 'uploads/Cluster 7/PVT/', '61005_1465453385_B-192-10 Gas Report.pdf'),
(3, 6, 'PVT Analysis of MDT-Sample of B-192-10 (B-192-J)', '', 'PVT', 'uploads/Cluster 7/PVT/', '61005_1465453455_PVT Reports.pdf'),
(3, 6, 'PRODUCTION TESTING SAMPLE ANALYSIS OF B-192-10', '', 'TESTING', 'uploads/Cluster 7/PVT/', '61005_1465453586_oil report B-192 PT.pdf'),
(3, 8, 'CORE GAMMA LOG OF B-192-11', '', 'B-192', 'uploads/Cluster 7/Logs/', '61005_1465454087_kkB-192-11CGL.pdf'),
(3, 15, 'CLUSTER-7 PRESENTATION', '', 'PREPARED IN 2013', 'uploads/Cluster 7/Appraisals & Presentations/', '61005_1465454354_Cluster-7.ppt'),
(4, 1, 'Structure contour map on top of Bassein L-I', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462766_Bassein L-I Structure.pdf'),
(4, 1, 'Oil Isopay map on top of Bassein L-I', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462835_Bassein L-I Isopay Oil.pdf'),
(4, 1, 'Gas Isopay map on top of Bassein L-I', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462849_Bassein L-I Isopay Gas.pdf'),
(4, 1, 'Structure contour map on top of Bassein L-II', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462875_Bassein L-II Structure.pdf'),
(4, 1, 'Oil Isopay map on top of Bassein L-II', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462894_Bassein L-II Isopay Oil.pdf'),
(4, 1, 'Structure contour map on top of L-V', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465462957_L-V top Structure.pdf'),
(4, 1, 'Oil Isopay map on top of L-V', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465464326_L-V Oil-Isopay.pdf'),
(4, 1, 'Gas Isopay map on top of L-V', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465464349_L-V Gas-Isopay.pdf'),
(4, 1, 'Structure contour map on top of L-VI', '', 'WO-16 Map', 'uploads/WO Series/Maps/', '61005_1465464379_L-VI Structure.pdf'),
(4, 1, 'Oil Isopay map on top of L-VI', '', 'WO-16 (B-121/119)Map', 'uploads/WO Series/Maps/', '61005_1465464484_L-VI Oil-Isopay.pdf'),
(4, 1, 'Gas Isopay map on top of L-VI', '', 'WO-16 (B-121/119)Map', 'uploads/WO Series/Maps/', '61005_1465464502_L-VI Isopay 2.pdf'),
(4, 1, 'Structure contour map on top of Mukta', '', 'WO-16 (WO-5)Map', 'uploads/WO Series/Maps/', '61005_1465464798_Mukta Structure.pdf'),
(4, 1, 'Structure contour map on top of Basement', '', 'WO-16 (B-121/119)Map', 'uploads/WO Series/Maps/', '61005_1465464963_Basement-H5 top Structure.pdf'),
(4, 1, 'Oil Isopay map on top of Basement', '', 'WO-16 (B-121/119)Map', 'uploads/WO Series/Maps/', '61005_1465465019_Basement oil-Isopay.pdf'),
(4, 1, 'Gas Isopay map on top of Basement', '', 'WO-16 (B-121/119)Map', 'uploads/WO Series/Maps/', '61005_1465465038_Basement gas-Isopay.pdf'),
(4, 10, ' Exploratory wells testing details of WO-5 structure', '', 'Exploratory testing & crude oil analysis detail', 'uploads/WO Series/Exploratory Well Testing Results/', '61005_1465465281_WO-5.xlsx'),
(4, 10, 'Exploratory Well Testing_WO-16 structure', '', 'Exploratory Well Testing_WO-16 structure', 'uploads/WO Series/Exploratory Well Testing Results/', '61005_1465465392_WO-16 Testing.xlsx'),
(1, 6, 'PVT Studies of Basal-Basement', '', 'Basal Basement', 'uploads/Mumbai High/PVT/', '61005_1465467719_Table-3 PVT study of Basal Clastics and Basement.pdf'),
(1, 10, 'Status of Wells drilled to Basal/Basement', '', 'Well Status', 'uploads/Mumbai High/Exploratory Well Testing Results/', '61005_1465467784_Table-1 Data of 94 wells penetrated Basal Clastics.pdf'),
(1, 6, '', '', '', 'uploads/Mumbai High/PVT/', '61005_1465468202_'),
(1, 6, 'Mumbai High PVT Data Analysis-S2S Project', '', 'PVT', 'uploads/Mumbai High/PVT/', '61005_1465468202_Mumbai_High_PVT_Data Analysis.pdf'),
(1, 1, 'Location Map of MH South ', '', 'Location Map of MH South (with Phase-III locations)', 'uploads/Mumbai High/Maps/', '61005_1465471026_MHSRDPhase-III_Locations.pdf'),
(4, 8, 'WO-16A-3_8.5in_Composite Log_15-Nov-13', '', 'LOG', 'uploads/WO Series/Logs/', '61005_1465471660_CHT-131102_WO-16A-3_8.5in_Composite Log_15-Nov-13.Pdf'),
(4, 8, 'WO-16A-5', '', 'Log', 'uploads/WO Series/Logs/', '61005_1465471718_WO_16A_5_8.50in_4170m_4860m_RM_Final.pdf'),
(4, 8, 'WO-16A-2', '', 'WO-16', 'uploads/WO Series/Logs/', '61005_1465471759_WO-16A#2_8.5in section_Final_Log.pdf'),
(4, 8, 'WO-16A-1H', '', 'LOG', 'uploads/WO Series/Logs/', '61005_1465471786_WO-16A-1H_8.5in_EcoSCOPE Image Service_RM_Log_2775m-3103m MD.pdf'),
(4, 8, 'WO-16A-4H', '', 'LOG', 'uploads/WO Series/Logs/', '61005_1465471813_WO-16A-4H_8.5in_VISION Service_RM_Log_2525m-3204m.Pdf'),
(3, 14, 'ADB proposal of Cluster-7', 'Cluster-7', 'ADB proposal of Cluster-7', 'uploads/Cluster 7/FR & Reports/', '61005_1465550107_3. MH ADB 2012 Proposal_Cluster-7.pdf'),
(1, 1, 'Structure contour map on top of A1-MH North', 'MHN', 'Structure contour map on top of A1-MH North', 'uploads/Mumbai High/Maps/', '61005_1465965801_MHN_Structure Map A1top.pdf'),
(1, 1, 'Structure contour map on top of A1-MH South', 'MHS', 'Structure contour map on top of A1-MH South', 'uploads/Mumbai High/Maps/', '61005_1465965823_MHS_Structure Map A1 top.pdf'),
(1, 1, 'Structure contour map on top of L-I-MH North', 'MHN L-I', 'REC map-01.04.2014', 'uploads/Mumbai High/Maps/', '61005_1465966078_MHN L1 structure_REC_01.04.2014.pdf'),
(1, 1, 'Phi-he-So map of L-I_MH North', 'MHN L-I', 'REC map-01.04.2014', 'uploads/Mumbai High/Maps/', '61005_1465966146_MHN L1 equivalent oil_REC_01.04.2014.pdf'),
(1, 1, 'Phi-he-Sg map of L-I_MH North', 'MHN L-I', 'REC map-01.04.2014', 'uploads/Mumbai High/Maps/', '61005_1465966165_MHN L1 equivalent gas_REC_01.04.2014.pdf'),
(3, 1, 'Structure contour map on top of Basal clastic', 'B-192', 'REC map-01.04.2014', 'uploads/Cluster 7/Maps/', '61005_1465986582_Structure.pdf'),
(3, 1, 'Oil Isopay map  of Basal clastic', 'B-192', 'REC map-01.04.2014', 'uploads/Cluster 7/Maps/', '61005_1465986626_Iso saturation.pdf'),
(3, 14, 'Integrated Geo-Cellular Model of B-192 Field', 'B-192', 'GCM Reports_IRS G&G_201516', 'uploads/Cluster 7/FR & Reports/', '61005_1465986858_B192__Final_Report_April2015-09feb15.pdf'),
(3, 2, 'All Reservoir data of Marginal Field_Mar16', 'B-192', 'All Reservoir data of Marginal Field_Mar16', 'uploads/Cluster 7/Plan & Performance Graphs/', '61005_1465990571_Marginal-All reservoir data.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`first_name`, `last_name`, `cpf`, `password`) VALUES
('Arpit', 'Buddhiwant', '125413', 'password'),
('Pallavi', 'Chatterjee', '123424', 'password'),
('D K', 'Nautiyal', '61005', 'password');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

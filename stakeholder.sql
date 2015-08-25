-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2015 at 11:30 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stakeholder`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
`ac_id` int(4) NOT NULL,
  `ac_no` int(4) NOT NULL,
  `ac_name` varchar(200) NOT NULL,
  `ac_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ac_id`, `ac_no`, `ac_name`, `ac_type`, `status`, `position`, `description`, `created`) VALUES
(1, 1, 'การระบุความเสี่ยงและการประเมินความเสี่ยง', 'risk', 'activated', '["3","4","5","6"]', 'testing', '2015-02-08 15:38:18'),
(2, 2, 'การระบุผู้มีส่วนได้ส่วนเสีย', 'stakeholder', 'activated', '["1","2"]', 'ทดสอบ', '2015-02-08 15:38:18'),
(3, 3, 'SWOT Analysis and TOWS MATRIX', 'swot-tows', 'activated', '["7","8","9","10","11","12","13","14"]', 'SWOT and TOWS ', '2015-02-28 10:59:03'),
(4, 0, 'Knowledge Verifing', 'custom', 'unactivated', '["15","16"]', '-', '2015-04-30 03:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`ans_id` int(4) NOT NULL,
  `ac_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `ans_detail` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ans_id`, `ac_id`, `user_id`, `ans_detail`) VALUES
(1, 1, 2, '[["การทำงานหนัก","5","4","20"],["ความสามัคคี","3","4","12"],["ความคิดสร้างสรรค์","2","4","8"]]'),
(2, 2, 2, '[["พนักงาน","มีสวัสดิการที่ดีขึ้น"],["เพื่อนร่วมงาน","มีความสามัคคีมากขึ้น"]]'),
(3, 3, 2, '[["• Starbucks has a strong market share of about 40%, this is beneficial for the company to expand ahead globally specifically as a coffee market.\n\n• Starbucks has gone for market extension in beverage category by introducing Starbucks coffee liquor drink linked with Jim Beams brand.\n\n• Currently, Starbucks is operating 15,000 international and expects to expand further in countries like Russia, China which will further increase its revenue growth.\n\n• Technological advancement can help Starbucks improve its services.","Threats\n\n• The political, economic and weather conditions in some countries outside the domestic market like India can adversely affect the business.\n\n• The rise in dairy prices can be a threat to Starbucks as milk and dairy products usually get 3% or 5% of sales and its consistently increase in prices could affect the company’s operations.\n\n• Starbucks must be careful of the emerging competition especially in the domestic market, any major competitor can hit the market, therefore Starbucks must be competitive on all levels to retain its position as the world’s leading coffee retailer.","• Starbucks has a strong brand presence, which is leading as a global organization with more than 16,000 retail stores in 48 countries across the entire world.\n\n• Best known for its high quality and services.\n\n• Strong brand loyalty.\n\n• It provides an atmosphere of sophistication, calmness and style that represents its own functional and emotional benefits to consumers.\n\n• Has the Wi-Fi facility in all of its retail stores.\n\n• Have fewer competitions in the market.\n\n• Starbucks treats employees as partners who hold the urge to provide message to its customers which is significant to the product line.\n\n• Starbucks has the competitive advantage of providing innovative products more quickly in the all of the same retail stores. ","1- The major strength of Starbucks is its global presence and its strong customer loyalty which helps to increase its market share and growth in the coffee market. (S1,O1) (S3,O1)\n\n2- By constantly introducing new innovative products in each store, Starbucks can continue to increase its revenue by expanding in other countries as well. (S8,O3)\n\n3- Starbucks is well known for its quality and fast services throughout the world, in order to upgrade its services according to customer’s requirement is to come up with more technological advancements. (S2,O4) ","1- One of the major threats that Starbucks could face is against its competitors. For this purpose, Starbucks should innovate or diversify its products more often to retain its position in the market. Frappucino light blended coffee is one of its examples. (S8,T3)\n\n2- Due to economic/political instability in some countries that affect the business operations. However with its strong global image, Starbucks can shift its operation elsewhere where it seems to have more potential growth. Another way is to change their market strategy by reducing their prices to penetrate in the foreign market. (S3, T1). ","• Starbucks generates 85% of revenues from US, its domestic market. Being known as an international brand, the organization needs to obtain some revenues from outside the US market.\n\n• Starbucks relies more greatly on creating innovation in beverages, at the time of economy slowdown it will be risky for the company as to how long they will be able to sustain.\n\n• Starbucks faces some difficulties internationally, as one of its market expansion failed miserably like Japan so this affects the international growth of the company.","1- As Starbucks has large market share of about 85% in the US market, they must take advantage of their market expansion to increase its market share outside its domestic market. (W1,O1)\n\n2- If Starbucks face difficulties to operate internationally, they must take advantage of their products and adapt them according to the consumer’s demand and environment through product diversification or market extension strategy. (W3,O2)","1- Starbucks when faced with political/economic instability outside the domestic market (US) needs to extend its product line in beverages. (W1,T1) (W2, T1).\n\n2- To avoid this threat such as rise in the cost of dairy products is to diversify its products that do not include any dairy items. (W2,T2)"]]'),
(4, 1, 3, '[["การทำงานด้อยประสิทธิภาพ","4","5","20"],["การขาดประสบการณ์","5","5","25"]]'),
(5, 2, 3, '[["เจ้านาย","ผลกำไร,ขยายธุรกิจ"],["ลูกน้อง","เงินเดือน,โบนัส,เลื่อนตำแหน่ง"]]'),
(6, 3, 3, '[["S","W","O","T","SO","ST","WO","WT"]]');

-- --------------------------------------------------------

--
-- Table structure for table `composite_grp_act`
--

CREATE TABLE IF NOT EXISTS `composite_grp_act` (
`com_id` int(4) NOT NULL,
  `group_id` int(4) NOT NULL,
  `ac_id` int(4) NOT NULL,
  `no` int(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composite_grp_act`
--

INSERT INTO `composite_grp_act` (`com_id`, `group_id`, `ac_id`, `no`, `created`, `status`) VALUES
(1, 1, 1, 0, '2015-02-08 03:19:10', 'activated'),
(2, 1, 2, 0, '2015-02-09 03:19:10', 'activated'),
(3, 1, 3, 0, '2015-02-10 03:19:10', 'activated'),
(5, 3, 1, 0, '2015-04-30 03:06:51', 'unactivated');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`group_id` int(4) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `created`) VALUES
(0, 'admin', '2015-02-01 17:00:00'),
(1, 'MRT.', '2015-02-03 00:36:20'),
(2, 'การประปานครหลวง', '2015-02-05 02:20:40'),
(3, 'NC Housing', '2015-04-30 03:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder`
--

CREATE TABLE IF NOT EXISTS `stakeholder` (
`stk_id` int(4) NOT NULL,
  `ac_id` int(4) NOT NULL,
  `stklist_id` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stakeholder`
--

INSERT INTO `stakeholder` (`stk_id`, `ac_id`, `stklist_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 2, 1),
(6, 2, 2),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(19, 4, 15),
(20, 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_list`
--

CREATE TABLE IF NOT EXISTS `stakeholder_list` (
`stklist_id` int(4) NOT NULL,
  `stklist_name` varchar(200) NOT NULL,
  `stklist_type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stakeholder_list`
--

INSERT INTO `stakeholder_list` (`stklist_id`, `stklist_name`, `stklist_type`) VALUES
(1, 'Stakeholder', 'text'),
(2, 'Interest', 'text'),
(3, 'ประเภทความเสี่ยง', 'text'),
(4, 'โอกาส', 'level'),
(5, 'ผลกระทบ', 'level'),
(6, 'ระดับความเสี่ยง', 'sum'),
(7, '(S) Internal Strengths', 'text'),
(8, '(W) Internal Weaknesses', 'text'),
(9, '(O) External Opportunities', 'text'),
(10, '(T) External Threats', 'text'),
(11, 'SO "Maxi-Maxi Strategy"', 'text'),
(12, 'ST "Maxi-Mini Strategy"', 'text'),
(13, 'WO "Mini-Maxi Strategy"', 'text'),
(14, 'WT "Mini-Mini Strategy"', 'text'),
(15, 'เร่งด่วน', 'level'),
(16, 'จำเป็น', 'level');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `group_id` int(4) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `group_id`, `name`, `created`) VALUES
(1, 'root', 'SPydCL1ZXOL+0Q/m3sWjuaL2wRdVTO1I75pG8W5v6JF2ex2sEIKGCyPRvfsCZm0/ZEE9PJGCD8lRff3m1ZZI/y9wjSfd5ZXMXZOa+Eah/Xy67qAbwl+kdg+OF51exP0L|Ey9XhyXDr+/jVAt+dKkO5mEmcNYhMSb/sjHXP8dkFQU=', 'admin', 0, '@Wise_Admin', '2015-04-29 08:29:17'),
(2, 'user1', 'NiafjSVp6bZJ9czYZpfXcp0BExL5yXxZMsb0xA3GGq5/ZnSlxbgrQbTD1JEOgEidpY4uX3BbKoqIZhZota7j2Uvga/v7O74rLYe6aziVNrZN/5XeDumYB6jENGlSiDjc|w59zx72W/olAWwKFnnDn4WDBPqCb5OZSzGO++lQ6hHo=', 'user', 1, 'ฝ่าย Training', '2015-04-29 08:30:27'),
(3, 'user2', 'o+pxlgNMbgg7DGb3xE2hUvB+R1jCYSh4M4lrgPVoBwu3aCS0Ync4tEzd5qXcZc1+6LPjwfxn/PAThb3BDnMU0LDX8B+Kmh4FtdppHnJcnAtOQbwpKK2bpXZs0aYP5WEN|xyi8xDxuBQCUkHyexpyVJXHfHBkhqit7CQJ5zgnd480=', 'user', 1, 'ฝ่าย IT', '2015-04-29 08:30:49'),
(4, 'atw577994', 'tjHRYA6E9XMO3eSra5cciOeC2tHk+i7HcZCol18VS9c0kJ2vGX/eG3eav7W5NBmEizr1wuxPUHUQqPm6YHri4LV04VqfHC+++mzJODDyd7NPT0Xm61EdDE/tEEyby+WW|FgSFDMvMGsbNQt5vrXn+KkyYxqX6nAO/wQZzGQuRniE=', 'user', 2, 'กลุ่มที่ 1', '2015-03-26 18:20:01'),
(5, 'atw641576', 'QbiblRW92jY8mq0PC1VbBCkejhfCydqDi2tMTnB4bZU0HqKpHsBVPGatb9nnVaNFx1+jDSpAu9XYTeItj298AN6TpLkERnRRkzxE+MrVyiElw93OC/pSHaz5MaxHEZRv|U/iNOdk6N2IpPvpJXlJV0NeR/i1NtYlnLjXd0FOgAkQ=', 'user', 2, 'กลุ่มที่ 2', '2015-03-26 18:20:01'),
(6, 'atw969810', '65jOQTDqTAug76vKkTPnDqxtptcapTgeSxEewXLj/xYZA9Id9tsyGU8lkdfr+8PrDFzqr3iTnjEZJZwE3r1BNBIP6cXTshKOq1alVfnt/pnTLkPz81yIHTXzwK8XO/Jd|oSJNDdfoFh/8jxOybFx741iw+EGICwm3BPoIeBsK0pM=', 'user', 2, 'กลุ่มที่ 3', '2015-03-26 18:20:01'),
(7, 'atw454243', 'hOnrsWbKsWKXyTbyVy3d6DpMJsB7ltAG4HxqmBqUwClakd5rpx/Q9oYk3BqQFaLuO4D3QFTtRzTZLRW9nDnSKtMJxKVyi0g34HCz2L4gFtyguYXKwmRhMqzHILTS/Dki|2LwZD/R67T4Qq9D4ziBRP1p1tFox1WkmZckAyb/wNCk=', 'user', 2, 'กลุ่มที่ 4', '2015-03-26 18:20:01'),
(8, 'atw083187', 'TgOjqJQRR0DFQ4OvAbmE+5SHqCjQWddI3id4sJv8UjSAVNp+NICkuBGPZrbAJMymfrnHE+gfdTwqxiZ9jKD0PE+dZSDnngZNeZzQO9Q1qcN5U53tiElPKvqQs7a+o1zg|YeF7b/nDf97shVGMzmkdGH2IRL/ZJp/5UmS9cX4bNC0=', 'user', 2, 'กลุ่มที่ 5', '2015-03-26 18:20:01'),
(9, 'user3', 'NKLSYDRAfKQg1aFAvs+SBCAdtQB3iH9/j8hgvAq90QKAVfscYn/yflmAweFR5C/yqTh8AwgM1GIq26Y592hYrLRbwJ3EJ7oVSfUNYfRXzk+GhlGJDrCpQSBe9IU5GuvX|rN4RVBM8xPnw5sN5NE64sVlIDu+iIQzbpDGoypEYolw=', 'user', 1, 'ฝ่าย KM', '2015-03-26 19:29:44'),
(11, 'atw502968', 'VZGYRoPb07inzN6wizZ33Nz8ZDsJYfUxB/4XQ0EoXu0Res1IPiO38kWyL2heL7LbVuhwkzK+S9L1po3YBEEmbhIBc4K8bv0Dwa2oeCGNv6PeoLVXHkW6r9pFOHLv35dV|wE1TNR94ubjJD7fRVrYYM+NTGBHCn3tto0qghwePNos=', 'user', 1, 'กลุ่มที่ 2', '2015-04-30 03:05:05'),
(12, 'atw893505', '/YVpTVwZC0MTmwzs7PNFlDcVh4caSFk1iYXt3i2mNq7K7eroqAKdPATWP6yEyAoyrZp8R1tsWrGXduycr4e3BDbFnSD8+VNBvP/O7O3uf3s3sOxLEuS4UQqEAfdYNjBV|FdMFSt9KGQk7f4Mt7kTbZhB4nucZ2/o1cmn/PhUEbvA=', 'user', 1, 'กลุ่มที่ 3', '2015-04-30 03:05:05'),
(13, 'atw796542', 'efgu0ZBhMRoMcuh11ajr2Uvg9s1LYhkY66EHrHLDKg4zoWEEeenwpf+wCZQMdOX0Y0JJ+9Ku42vfc2JlBR92HZLRARMXv3nUZR92QjeitU+tJ8guavF3O0u696JqDoyJ|fqJMw8gt/HISlXpM6ImWe1bFlKkyA84B95yPGXuEecY=', 'user', 1, 'กลุ่มที่ 4', '2015-04-30 03:05:05'),
(14, 'atw814891', '5XA2YZ8ewd3yOwaDpFp0i+7MbMXHJiV7QNBdT4y6AwJ9CmBxmzbdcECRKeZbRaclG1Eoh/6IB8OHxPM1cO0Prdpl83GY/skPucZV7/bkRY5URsNetTGxx2IUp3ca9yKL|VFnJLTf4NTa+l77aEQoBu2qJ23FtRQjWTDadWZQNSdc=', 'user', 1, 'กลุ่มที่ 5', '2015-04-30 03:05:05'),
(15, 'atw006828', 'ecz0XTD7BAj1TD+BB/AMLGjX9v6zp8aKZmhiq9D19KcNNuNlCqIb2XAbfGnP7M9EuZgPDRexFSWbz7TRzXtV7nIfD8NxJZaDrvr4rV6qqlY4QO3dEa96zYrmbHIPKyAh|wKMaWKr+6lz4AYNKMe7xLuU6lgCI60DReFeVAJmU4ZM=', 'user', 1, 'กลุ่มที่ 6', '2015-04-30 03:05:05'),
(16, 'atw624763', 'niTE+1Q5WkTxNgcKGdWt3XIGaGEPs7+hTezi5FtaRf8HaK/IjUdzqRY84hijfAm6Us+ot1AcUXCMUOQMiItyGcefvJHVss8jxXyWPVYZtyLLiKL6aPLa2Ca6VvbW999F|rN3MhRpwDGxWLAUiRkqbd20oZLRePyadMPvT0fNC0AY=', 'user', 1, 'กลุ่มที่ 7', '2015-04-30 03:05:05'),
(17, 'atw062060', 'hEC5OH/SpXs7I7WGME5ImjJ8qeLy562SbRfqocC1PQdVlh9U5dW0gefRXu8R+xh0l4sKLGkk33DVOAcSgnfIY7f+OCnwzD5wkegA6H6FAyz1d815Z53KUHiSDMwPBsMQ|T1+sh6TDvKna+TmGs6rD3+O6cI6GUvkM8QnHvYy/G4Q=', 'user', 1, 'กลุ่มที่ 8', '2015-04-30 03:05:05'),
(18, 'atw920709', 'G5mm4TWt/YhPFuXnxNGZoT4vDv9zh/oU/962dwA+7giWtibYb4Fulv0lSNG/iDc3CQPLd2pBw8QX2kYtjKs+8j3wZKRPdWUu+UWRDxPBHa32E6wCOLB9CGjR6/Rq64V9|BHhd6awVLwiZpENHfi+1JuWZe+PuNVmFpgcl8tz5HEQ=', 'user', 1, 'กลุ่มที่ 9', '2015-04-30 03:05:05'),
(19, 'atw683223', '2Fjz9WKeS5yaoQ+s/5b/0P39hnrUSEEqRMo5AXp+ilzhVdvBrtNQ+1UwQQfW2GjGL4rdk+DhBYDKW9iNhCYfC2fd7CxTQEY7zYEa/n6lCKER8PUOxPcjBqUYRnlZbXCw|rh+XOleybBGYq7NElleboqGW1TvXyH4CMKfAhQRlZUQ=', 'user', 1, 'กลุ่มที่ 10', '2015-04-30 03:05:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `composite_grp_act`
--
ALTER TABLE `composite_grp_act`
 ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `stakeholder`
--
ALTER TABLE `stakeholder`
 ADD PRIMARY KEY (`stk_id`);

--
-- Indexes for table `stakeholder_list`
--
ALTER TABLE `stakeholder_list`
 ADD PRIMARY KEY (`stklist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
MODIFY `ac_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `ans_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `composite_grp_act`
--
ALTER TABLE `composite_grp_act`
MODIFY `com_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `group_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stakeholder`
--
ALTER TABLE `stakeholder`
MODIFY `stk_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `stakeholder_list`
--
ALTER TABLE `stakeholder_list`
MODIFY `stklist_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

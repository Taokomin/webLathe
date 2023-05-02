-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 01:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_accept_material`
--

CREATE TABLE `tb_accept_material` (
  `accept_material_number` int(11) NOT NULL,
  `accept_material_id` varchar(250) NOT NULL,
  `accept_material_day` date NOT NULL,
  `ref_buy_material_id` varchar(250) NOT NULL,
  `ref_buy_material_day` date NOT NULL,
  `ref_buy_material_detail` varchar(250) NOT NULL,
  `ref_equipment_number` varchar(250) NOT NULL,
  `ref_buy_material_quantity` varchar(250) NOT NULL,
  `ref_unit_number` varchar(250) NOT NULL,
  `ref_equipment_type` varchar(250) NOT NULL,
  `ref_employee_number` varchar(250) NOT NULL,
  `ref_partners_number` varchar(250) NOT NULL,
  `pickup_material_number` varchar(255) DEFAULT NULL,
  `pickup_material_id` varchar(255) DEFAULT NULL,
  `pickup_material_day` date DEFAULT NULL,
  `ref_equipment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_accept_material`
--

INSERT INTO `tb_accept_material` (`accept_material_number`, `accept_material_id`, `accept_material_day`, `ref_buy_material_id`, `ref_buy_material_day`, `ref_buy_material_detail`, `ref_equipment_number`, `ref_buy_material_quantity`, `ref_unit_number`, `ref_equipment_type`, `ref_employee_number`, `ref_partners_number`, `pickup_material_number`, `pickup_material_id`, `pickup_material_day`, `ref_equipment_id`) VALUES
(1, 'AM01', '2023-03-12', 'BM01', '2023-03-12', 'เหล็กเส้น', 'สว่าน', '30', 'ตัว', 'ใช้แล้วหมดไป', 'ginmo jatun', 'สายใจ', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_buy_material`
--

CREATE TABLE `tb_buy_material` (
  `buy_material_number` int(11) NOT NULL,
  `buy_material_id` varchar(250) NOT NULL,
  `buy_material_day` date NOT NULL,
  `buy_material_detail` varchar(250) NOT NULL,
  `ref_equipment_number` varchar(250) NOT NULL COMMENT 'รหัสวัสดุและอุปกรณ์',
  `buy_material_quantity` varchar(250) NOT NULL,
  `ref_unit_number` int(11) NOT NULL COMMENT 'รหัสหน่วยนับ',
  `ref_equipment_type` int(11) NOT NULL COMMENT 'รหัสประเภทวัสดุและอุปกรณ์',
  `ref_employee_number` varchar(250) NOT NULL,
  `ref_partners_number` int(11) NOT NULL COMMENT 'รหัสคู่ค้า',
  `buy_material_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_buy_material`
--

INSERT INTO `tb_buy_material` (`buy_material_number`, `buy_material_id`, `buy_material_day`, `buy_material_detail`, `ref_equipment_number`, `buy_material_quantity`, `ref_unit_number`, `ref_equipment_type`, `ref_employee_number`, `ref_partners_number`, `buy_material_status`) VALUES
(1, 'BM01', '2023-03-12', 'เหล็กเส้น', '1', '30\r\n', 1, 1, 'ginmo jatun', 1, 'รออนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `customer_number` int(11) NOT NULL,
  `customer_id` varchar(250) NOT NULL,
  `ref_nameprefix_number` int(11) NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
  `customer_fname` varchar(250) NOT NULL,
  `customer_lname` varchar(250) NOT NULL,
  `customer_phone` varchar(250) NOT NULL,
  `customer_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`customer_number`, `customer_id`, `ref_nameprefix_number`, `customer_fname`, `customer_lname`, `customer_phone`, `customer_email`) VALUES
(1, 'CM01', 1, 'Komin', 'junta', '0838953613', 'taokomin87@gmail.com'),
(4, 'CM02', 2, 'qwwe', 'rqwr', '12345678910', 'loninjarun@gmial.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer_order`
--

CREATE TABLE `tb_customer_order` (
  `customer_order_number` int(11) NOT NULL,
  `customer_order_id` varchar(250) NOT NULL,
  `customer_order_day` date NOT NULL,
  `customer_order_detail` varchar(250) NOT NULL,
  `customer_order_quantity` varchar(250) NOT NULL,
  `ref_unit_number` int(11) NOT NULL COMMENT 'รหัสหน่วยนับ',
  `ref_customer_number` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `ref_employee_number` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer_order`
--

INSERT INTO `tb_customer_order` (`customer_order_number`, `customer_order_id`, `customer_order_day`, `customer_order_detail`, `customer_order_quantity`, `ref_unit_number`, `ref_customer_number`, `ref_employee_number`) VALUES
(1, 'PO01', '2023-02-28', 'ตะกร้าไม้ไผ่', '6', 1, 1, 'ginmo jatun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_deliver`
--

CREATE TABLE `tb_deliver` (
  `deliver_number` int(11) NOT NULL,
  `deliver_id` varchar(250) NOT NULL,
  `deliver_day` date NOT NULL,
  `ref_customer_order_id` varchar(250) NOT NULL,
  `ref_customer_order_day` date NOT NULL,
  `ref_customer_order_detail` varchar(250) NOT NULL,
  `ref_customer_order_quantity` varchar(250) NOT NULL,
  `ref_unit_name` varchar(250) NOT NULL,
  `ref_customer_fname` varchar(250) NOT NULL,
  `deliver_address` varchar(250) NOT NULL,
  `ref_employee_number` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_deliver`
--

INSERT INTO `tb_deliver` (`deliver_number`, `deliver_id`, `deliver_day`, `ref_customer_order_id`, `ref_customer_order_day`, `ref_customer_order_detail`, `ref_customer_order_quantity`, `ref_unit_name`, `ref_customer_fname`, `deliver_address`, `ref_employee_number`) VALUES
(1, 'DV01', '2023-03-12', 'PO01', '2023-02-28', 'ตะกร้าไม้ไผ่', '6', 'ตัว', 'Komin', '4455 Landing Lange, APT 4\r\nLouisville, KY 40018-1234', 'ginmo jatun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `employee_number` int(11) NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `ref_nameprefix_number` int(11) NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
  `employee_fname` varchar(250) NOT NULL,
  `employee_lname` varchar(250) NOT NULL,
  `employee_phone` varchar(250) NOT NULL,
  `employee_address` varchar(250) NOT NULL,
  `ref_employee_type_number` int(11) NOT NULL COMMENT 'รหัสประเภทพนักงาน',
  `employee_license` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`employee_number`, `employee_id`, `ref_nameprefix_number`, `employee_fname`, `employee_lname`, `employee_phone`, `employee_address`, `ref_employee_type_number`, `employee_license`) VALUES
(1, 'EM01', 2, 'ชะรอย', 'จุติมา', '0838953613', '91 หมู่2 ต.บางพลบัว อ.โพธิ์ทองจ.อ่างทอง 14120', 1, 'พนักงาน');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee_type`
--

CREATE TABLE `tb_employee_type` (
  `employee_type_number` int(11) NOT NULL,
  `employee_type_id` varchar(255) NOT NULL,
  `employee_type_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee_type`
--

INSERT INTO `tb_employee_type` (`employee_type_number`, `employee_type_id`, `employee_type_name`) VALUES
(1, 'ET01', 'ประจำ'),
(2, 'ET02', 'พาร์ทไทม์');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment`
--

CREATE TABLE `tb_equipment` (
  `equipment_number` int(11) NOT NULL,
  `equipment_id` varchar(250) NOT NULL,
  `equipment_name` varchar(250) NOT NULL,
  `equipment_quantity` varchar(250) NOT NULL,
  `ref_unit_number` int(11) NOT NULL COMMENT 'รหัสหน่วยนับ',
  `ref_equipment_type_number` int(11) NOT NULL COMMENT 'รหัสประเภทวัสดุและอุปกรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_equipment`
--

INSERT INTO `tb_equipment` (`equipment_number`, `equipment_id`, `equipment_name`, `equipment_quantity`, `ref_unit_number`, `ref_equipment_type_number`) VALUES
(1, 'MR01', 'สว่าน', '2', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment_type`
--

CREATE TABLE `tb_equipment_type` (
  `equipment_type_number` int(11) NOT NULL,
  `equipment_type_id` varchar(250) NOT NULL,
  `equipment_type_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_equipment_type`
--

INSERT INTO `tb_equipment_type` (`equipment_type_number`, `equipment_type_id`, `equipment_type_name`) VALUES
(1, 'MT01', 'ใช้แล้วหมดไป'),
(2, 'MT02', 'ใช้แล้วไม่หมดไป');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nameprefix`
--

CREATE TABLE `tb_nameprefix` (
  `prefix_number` int(11) NOT NULL,
  `prefix_id` varchar(255) NOT NULL,
  `prefix_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_nameprefix`
--

INSERT INTO `tb_nameprefix` (`prefix_number`, `prefix_id`, `prefix_name`) VALUES
(1, 'PN01', 'นาย'),
(2, 'PN02', 'นาง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_partners`
--

CREATE TABLE `tb_partners` (
  `partners_number` int(11) NOT NULL,
  `partners_id` varchar(250) NOT NULL,
  `ref_nameprefix_number` int(11) NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
  `partners_fname` varchar(250) NOT NULL,
  `partners_lname` varchar(250) NOT NULL,
  `partners_phone` varchar(250) NOT NULL,
  `partners_company` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_partners`
--

INSERT INTO `tb_partners` (`partners_number`, `partners_id`, `ref_nameprefix_number`, `partners_fname`, `partners_lname`, `partners_phone`, `partners_company`) VALUES
(1, 'PR01', 1, 'สายใจ', 'เกาะมหาสนุก', '0902015648', 'สตาร์อินดัสตรี้');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pickup_material`
--

CREATE TABLE `tb_pickup_material` (
  `pickup_material_number` int(11) NOT NULL,
  `pickup_material_id` varchar(250) NOT NULL,
  `pickup_material_day` date NOT NULL,
  `ref_equipment_id` varchar(250) NOT NULL,
  `ref_equipment_name` varchar(250) NOT NULL,
  `ref_equipment_quantity` varchar(250) NOT NULL,
  `ref_unit_name` varchar(250) NOT NULL,
  `ref_equipment_type_number` varchar(250) NOT NULL,
  `ref_employee_number` varchar(250) NOT NULL,
  `ref_pickup_material_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_pickup_material`
--

INSERT INTO `tb_pickup_material` (`pickup_material_number`, `pickup_material_id`, `pickup_material_day`, `ref_equipment_id`, `ref_equipment_name`, `ref_equipment_quantity`, `ref_unit_name`, `ref_equipment_type_number`, `ref_employee_number`, `ref_pickup_material_status`) VALUES
(1, 'PM01', '2023-03-13', 'MR01', 'สว่าน', '2', 'เครื่อง', 'ใช้แล้วหมดไป', 'ginmo jatun', 'รออนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_takeback`
--

CREATE TABLE `tb_takeback` (
  `takeback_number` int(11) NOT NULL,
  `takeback_id` varchar(250) NOT NULL,
  `takeback_day` date NOT NULL,
  `ref_equipment_id` varchar(250) NOT NULL,
  `ref_equipment_name` varchar(250) NOT NULL,
  `ref_equipment_quantity` varchar(250) NOT NULL,
  `ref_unit_name` varchar(250) NOT NULL,
  `ref_equipment_type_number` varchar(250) NOT NULL,
  `ref_employee_number` varchar(250) NOT NULL,
  `ref_pickup_material_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_takeback`
--

INSERT INTO `tb_takeback` (`takeback_number`, `takeback_id`, `takeback_day`, `ref_equipment_id`, `ref_equipment_name`, `ref_equipment_quantity`, `ref_unit_name`, `ref_equipment_type_number`, `ref_employee_number`, `ref_pickup_material_status`) VALUES
(1, 'TM01', '2023-03-18', 'PM01', 'สว่าน', '2', 'เครื่อง', 'ใช้แล้วหมดไป', 'ginmo jatun', 'รออนุมัติ'),
(2, 'TM02', '2023-03-18', 'PM02', 'สว่าน', '2', 'เครื่อง', 'ใช้แล้วหมดไป', 'ginmo jatun ', 'รออนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `unit_number` int(11) NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `unit_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`unit_number`, `unit_id`, `unit_name`) VALUES
(1, 'UN01', 'ตัว'),
(2, 'UN02', 'ชิ้น'),
(3, 'UN03', 'เครื่อง');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(5) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Userlevel` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `Userlevel`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'komin', 'junta', 'A'),
(2, 'member', '827ccb0eea8a706c4c34a16891f84e7b', 'ginmo', 'jatun', 'M'),
(3, 'member2', '827ccb0eea8a706c4c34a16891f84e7b', 'momo', 'juju', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_accept_material`
--
ALTER TABLE `tb_accept_material`
  ADD PRIMARY KEY (`accept_material_number`);

--
-- Indexes for table `tb_buy_material`
--
ALTER TABLE `tb_buy_material`
  ADD PRIMARY KEY (`buy_material_number`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`customer_number`);

--
-- Indexes for table `tb_customer_order`
--
ALTER TABLE `tb_customer_order`
  ADD PRIMARY KEY (`customer_order_number`);

--
-- Indexes for table `tb_deliver`
--
ALTER TABLE `tb_deliver`
  ADD PRIMARY KEY (`deliver_number`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`employee_number`);

--
-- Indexes for table `tb_employee_type`
--
ALTER TABLE `tb_employee_type`
  ADD PRIMARY KEY (`employee_type_number`);

--
-- Indexes for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD PRIMARY KEY (`equipment_number`);

--
-- Indexes for table `tb_equipment_type`
--
ALTER TABLE `tb_equipment_type`
  ADD PRIMARY KEY (`equipment_type_number`);

--
-- Indexes for table `tb_nameprefix`
--
ALTER TABLE `tb_nameprefix`
  ADD PRIMARY KEY (`prefix_number`);

--
-- Indexes for table `tb_partners`
--
ALTER TABLE `tb_partners`
  ADD PRIMARY KEY (`partners_number`);

--
-- Indexes for table `tb_pickup_material`
--
ALTER TABLE `tb_pickup_material`
  ADD PRIMARY KEY (`pickup_material_number`);

--
-- Indexes for table `tb_takeback`
--
ALTER TABLE `tb_takeback`
  ADD PRIMARY KEY (`takeback_number`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`unit_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_accept_material`
--
ALTER TABLE `tb_accept_material`
  MODIFY `accept_material_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_buy_material`
--
ALTER TABLE `tb_buy_material`
  MODIFY `buy_material_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `customer_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_customer_order`
--
ALTER TABLE `tb_customer_order`
  MODIFY `customer_order_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_deliver`
--
ALTER TABLE `tb_deliver`
  MODIFY `deliver_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_employee_type`
--
ALTER TABLE `tb_employee_type`
  MODIFY `employee_type_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  MODIFY `equipment_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_equipment_type`
--
ALTER TABLE `tb_equipment_type`
  MODIFY `equipment_type_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_nameprefix`
--
ALTER TABLE `tb_nameprefix`
  MODIFY `prefix_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_partners`
--
ALTER TABLE `tb_partners`
  MODIFY `partners_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pickup_material`
--
ALTER TABLE `tb_pickup_material`
  MODIFY `pickup_material_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_takeback`
--
ALTER TABLE `tb_takeback`
  MODIFY `takeback_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `unit_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

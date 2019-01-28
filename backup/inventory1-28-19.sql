-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 02:53 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `branch_contact` varchar(50) NOT NULL,
  `skin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `branch_contact`, `skin`) VALUES
(10, 'Bongabong branch', 'Bongabong Oriental Mindoro', '09', 'red'),
(11, 'Bansud branch', 'Bansud Oriental Mindoro', '09', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Bayer'),
(2, 'Syngenta'),
(3, 'Sinochem'),
(4, 'Jardines'),
(5, 'Vast'),
(6, 'Texicon'),
(7, 'Plant Care'),
(8, 'Leads'),
(9, 'Aldiz'),
(10, 'Mark Bustarga'),
(11, 'FMC'),
(12, 'DuPont'),
(13, 'C.B Andrew'),
(14, 'Corteva'),
(15, 'Jaconami'),
(16, 'Biosdtad'),
(17, 'Crop King'),
(18, 'Others'),
(19, 'RNE'),
(20, 'Allied Botanical'),
(21, 'Ka Lumeng'),
(22, 'Team Agro'),
(23, 'ICTC'),
(24, 'Aljay'),
(25, 'Yara'),
(26, 'Atlas'),
(27, 'Philphos'),
(28, 'Marka Bulaklak'),
(29, 'Golden Agin'),
(30, 'Ron 3'),
(31, 'East West'),
(32, 'Kaneko'),
(33, 'Bmeg'),
(34, 'Ladeco'),
(35, 'Three Kings'),
(36, 'Planters'),
(37, 'Sagrex'),
(38, 'Jocanima');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_first` varchar(50) NOT NULL,
  `cust_last` varchar(30) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_contact` varchar(30) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `cust_pic` varchar(300) NOT NULL,
  `bday` date NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `house_status` varchar(30) NOT NULL,
  `years` varchar(20) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_no` varchar(30) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_year` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `spouse` varchar(30) NOT NULL,
  `spouse_no` varchar(30) NOT NULL,
  `spouse_emp` varchar(50) NOT NULL,
  `spouse_details` varchar(100) NOT NULL,
  `spouse_income` decimal(10,2) NOT NULL,
  `comaker` varchar(30) NOT NULL,
  `comaker_details` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_status` varchar(10) NOT NULL,
  `ci_remarks` varchar(1000) NOT NULL,
  `ci_name` varchar(50) NOT NULL,
  `ci_date` date NOT NULL,
  `payslip` int(11) NOT NULL,
  `valid_id` int(11) NOT NULL,
  `cert` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `income` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_first`, `cust_last`, `cust_address`, `cust_contact`, `balance`, `cust_pic`, `bday`, `nickname`, `house_status`, `years`, `rent`, `emp_name`, `emp_no`, `emp_address`, `emp_year`, `occupation`, `salary`, `spouse`, `spouse_no`, `spouse_emp`, `spouse_details`, `spouse_income`, `comaker`, `comaker_details`, `branch_id`, `credit_status`, `ci_remarks`, `ci_name`, `ci_date`, `payslip`, `valid_id`, `cert`, `cedula`, `income`) VALUES
(1, 'Carmen', 'Aporo', 'Breeding', '09775556598', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(2, '', 'Abet & kambal', '', '09854655655', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(3, 'Benjie', 'Roxas ', 'Pinamalayan', '09182325652', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(4, 'Dodong', 'Bernardo', 'Bansud', '0989888888', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(5, '', 'Walk in', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(6, 'Rey', 'Hernandez', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(7, 'Oliver', 'Rollon', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(8, 'Lody/val', 'Coloma', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(9, 'Nante', 'Larga', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(10, 'Ka Isko', 'Banaag', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(11, 'Lolit', 'ka', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(12, 'Tony', 'Madlangbayan', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(13, 'Celing', 'Laberez ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(14, 'Chestine', 'Bayanay', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(15, 'Farmers', 'Mangyan', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(16, 'Floren', 'Tatay ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(17, 'Arceli', 'Lopez', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(18, 'Loding/Doc Aga', 'Ka ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(19, 'Ligaya', 'Nanay ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(20, 'Boy', 'Calingasan ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(21, 'Elmer', 'Kuya ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(22, 'Lamberto', 'Sir ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(23, 'Warren', 'Ka', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(24, 'in', 'Walk', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 10, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(25, 'Input', 'Wrong ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(26, 'Input', 'Wrong ', '', '', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 10, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(27, 'mark', 'Blando', 'bb1', '2000', '18000.00', 'default.gif', '0000-00-00', '', 'owned', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, 'Approved', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(28, 'dahlia', 'Blando', 'bb1', '2000', '0.00', 'default.gif', '0000-00-00', '', 'owned', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 10, 'Approved', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(29, 'Joel', 'De Guzman', 'bb2', '09083903380', '0.00', 'default.gif', '0000-00-00', '', 'owned', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 11, 'Approved', '', '', '0000-00-00', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masterfile`
--

CREATE TABLE `masterfile` (
  `master_id` int(7) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_for` date NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `or_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `pr_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_tendered` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `cash_change` decimal(10,2) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `modeofpayment` varchar(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sales_details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `profit` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `dist_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`) VALUES
(1, 'Joel & Lou Agri-Vet Supply', 'Bongabong Oriental Mindoro', '09266061252'),
(2, 'Three Kings', 'Pinamalayan', '091888888888'),
(3, 'Aldiz', 'Manila', '09185656564'),
(4, 'Concepcion Agricultural Supply', 'Calapan City', '09185654256'),
(5, 'JL Bicol', 'Bicol', '09758565241'),
(6, 'Baliwag', 'Baliwag Bulacan', '09125632589'),
(7, 'Leads', 'Makati', '09156532548'),
(8, 'Jaconami', 'Bacolod', '09185652864'),
(9, 'Team Agro', 'Socorro Or. Mindoro', '09186532598'),
(10, 'Crop King', 'Calapan', '09186532568'),
(11, 'Ylcee', 'Naujan', '09186532598'),
(12, 'Sagrex', 'Manila', '09185554689'),
(13, 'Ka Lumeng Agri', 'San Juan Batangas', '09775652864');

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE `temp_trans` (
  `temp_trans_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `payable_for` varchar(10) NOT NULL,
  `term` varchar(11) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `payment_start` date NOT NULL,
  `down` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `status`, `branch_id`) VALUES
(6, 'administrator', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Giu Matthew', 'active', 0),
(10, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Pableona', 'active', 8),
(11, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Pableona', 'active', 9),
(12, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Pableona', 'active', 10),
(13, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Pableona', 'active', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `history_log`
--
ALTER TABLE `history_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `masterfile`
--
ALTER TABLE `masterfile`
  ADD PRIMARY KEY (`master_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sales_details_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `temp_trans`
--
ALTER TABLE `temp_trans`
  ADD PRIMARY KEY (`temp_trans_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `history_log`
--
ALTER TABLE `history_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `masterfile`
--
ALTER TABLE `masterfile`
  MODIFY `master_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `sales_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

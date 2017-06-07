-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2017 at 10:04 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE Mfun;
USE Mfun;
--
-- Database: `Mfun`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `cid` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `tel` char(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `idn` varchar(15) NOT NULL,
  `notes` text,
  `uname` varchar(25) NOT NULL,
  `sid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cid`, `fname`, `lname`, `line_1`, `line_2`, `line_3`, `city`, `tel`, `email`, `idn`, `notes`, `uname`, `sid`) VALUES
(1, 'Lakindu', 'Akash', 'Ebetota,Karangoda,Ratnapura', '70018', '', 'Ratnapura', '0716875404', 'lakinduakash@gmail.com', '950580143v', '9555', 'admin1', 3),
(2, 'Dulip', 'Gunasinhe', '21/8', 'Main Road', 'Walana', 'Walana', '+94756575404', 'hhahhaga@gmail.com', '954882147v', 'Urgent', 'admin1', 3),
(3, 'Ravindu', 'Munaweera', 'Gonapala', '', '', 'Katukurunda', '0725844552', '', '985214420v', 'Urgent', 'sales3', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `c_sales_by_sid`
--
CREATE TABLE `c_sales_by_sid` (
`sid` int(10)
,`total` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE `Items` (
  `item_c` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(5) NOT NULL DEFAULT '0',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Items`
--

INSERT INTO `Items` (`item_c`, `price`, `qty`, `description`) VALUES
('55', '82000.00', 45, 'cupboard-grey'),
('a1', '30000.00', 18, 'bed-Brown'),
('a4', '80700.00', 11, 'Table and Chair set-Black'),
('c1', '60000.00', 52, 'sofa - black'),
('c2', '20000.00', 12, 'sofa - black/green');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Item_p`
--
CREATE TABLE `Item_p` (
`item_c` varchar(10)
,`price` decimal(10,2)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `item_sold`
--
CREATE TABLE `item_sold` (
`item_c` varchar(10)
,`total_qty` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `Levels`
--

CREATE TABLE `Levels` (
  `ulevel` int(2) NOT NULL,
  `level_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Levels`
--

INSERT INTO `Levels` (`ulevel`, `level_name`) VALUES
(1, 'Admin'),
(2, 'Stock'),
(3, 'Sales'),
(4, 'Stock admin'),
(5, 'Sales+Stock');

-- --------------------------------------------------------

--
-- Stand-in structure for view `n_sales_by_sid`
--
CREATE TABLE `n_sales_by_sid` (
`sid` int(10)
,`total` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `oid` int(10) NOT NULL,
  `orderd_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_delivered` date DEFAULT NULL,
  `cid` int(10) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `status` int(3) NOT NULL,
  `astimate_d_date` date NOT NULL,
  `item_c` varchar(10) NOT NULL,
  `qty` int(5) NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  `line_3` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `Notes` text,
  `total` decimal(15,2) DEFAULT NULL,
  `uname` varchar(25) NOT NULL,
  `sid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`oid`, `orderd_date`, `date_delivered`, `cid`, `paid_amount`, `status`, `astimate_d_date`, `item_c`, `qty`, `line_1`, `line_2`, `line_3`, `city`, `Notes`, `total`, `uname`, `sid`) VALUES
(3, '2017-05-28 15:49:05', NULL, 1, '40052.00', 4, '2017-05-31', 'c2', 2, 'Ebetota,Karangoda,Ratnapura', '70018', 'Ratnapura', 'Ratnapura', NULL, '50000.00', 'admin1', 3),
(4, '2017-05-28 15:50:16', NULL, 1, '30000.00', 1, '2017-05-31', 'c2', 2, 'Ebetota,Karangoda,Ratnapura', '70018', 'Ratnapura', 'Ratnapura', NULL, '65000.00', 'admin1', 3),
(5, '2017-05-28 23:06:07', '2017-05-29', 2, '6000.00', 6, '2017-06-27', 'a1', 2, 'Ebetota,Karangoda,Ratnapura', '', 'Ratnapura', 'Ratnapura', NULL, '210000.00', 'admin1', 3),
(6, '2017-05-28 23:07:31', NULL, 2, '80000.00', 1, '2017-05-31', 'c2', 8, 'Ebetota,Karangoda,Ratnapura', '', 'Ratnapura', 'Ratnapura', NULL, '30000.00', 'admin1', 3),
(7, '2017-06-03 00:22:17', NULL, 2, '600000.00', 2, '2017-06-29', 'c2', 5, '4', NULL, NULL, '55', NULL, '39000.00', 'admin1', 3),
(8, '2017-06-03 14:53:31', '2017-06-03', 3, '60000.00', 6, '2017-06-06', 'a1', 2, 'Katukurunda', '', '', 'Gonapola', NULL, '60000.00', 'sales3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Showroom`
--

CREATE TABLE `Showroom` (
  `sid` int(10) NOT NULL,
  `distric` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Showroom`
--

INSERT INTO `Showroom` (`sid`, `distric`) VALUES
(1, 'Moratuwa'),
(3, 'Ratnapura'),
(4, 'Kandy'),
(5, 'Gampaha'),
(6, 'Colombo-Nugegoda');

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE `Status` (
  `status` int(3) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Status`
--

INSERT INTO `Status` (`status`, `name`) VALUES
(1, 'Added'),
(2, 'Added For Manufacturing'),
(3, 'Delivering to customer'),
(4, 'Manufacturing'),
(5, 'Manufacture ok'),
(6, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `To_make`
--

CREATE TABLE `To_make` (
  `item_c` varchar(10) NOT NULL,
  `oid` int(10) NOT NULL,
  `qty` int(5) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `uname` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ulevel` int(2) NOT NULL,
  `sid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`uname`, `password`, `ulevel`, `sid`) VALUES
('admin1', '77d8257191b5ca8415369a5b3be1c81be2a4e67e4c59c852c2ddf12a5909b257', 1, 3),
('admin2', 'adf2c0a0fa0f9a298bf90a0549cc1e269d9aba9e7ffb54742e5fbcb0b645ef63', 1, 3),
('sales1', 'acfc0a1b19929b82d035fd9c169f36ebaa8b781b2c1165418a5bd123d12dde10', 3, 5),
('sales2', '49d14ac20a04eb60365fb8cd4d874e9d3ce2b5505733986f194be27e0da5c376', 3, 1),
('sales3', '052b4c5ad89e27fbe085304d2e4c6ad30817be06f3fe33b5d751e16987035820', 3, 4),
('salesstock1', '40e18c279d24b822889d9460f787b2aa23ed46ed9e56393b13af3bb9798d68dc', 5, 4),
('stock1', '1b38984ace65ea855dd230f798f561b2c32edc528ce09f8948c111bfcd52088e', 2, 1),
('stockad1', '7b703729c310485234aa8b2091a17e2e3c46e787ea39e39848db6c978b7818dd', 4, 1);

-- --------------------------------------------------------

--
-- Structure for view `c_sales_by_sid`
--
DROP TABLE IF EXISTS `c_sales_by_sid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `c_sales_by_sid`  AS  select `Orders`.`sid` AS `sid`,sum(`Orders`.`paid_amount`) AS `total` from `Orders` group by `Orders`.`sid` ;

-- --------------------------------------------------------

--
-- Structure for view `Item_p`
--
DROP TABLE IF EXISTS `Item_p`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Item_p`  AS  select `Items`.`item_c` AS `item_c`,`Items`.`price` AS `price`,`Items`.`description` AS `description` from `Items` ;

-- --------------------------------------------------------

--
-- Structure for view `item_sold`
--
DROP TABLE IF EXISTS `item_sold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `item_sold`  AS  select `Orders`.`item_c` AS `item_c`,sum(`Orders`.`qty`) AS `total_qty` from `Orders` group by `Orders`.`item_c` ;

-- --------------------------------------------------------

--
-- Structure for view `n_sales_by_sid`
--
DROP TABLE IF EXISTS `n_sales_by_sid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `n_sales_by_sid`  AS  select `Orders`.`sid` AS `sid`,sum((`Orders`.`qty` * `Items`.`price`)) AS `total` from (`Orders` join `Items` on((`Orders`.`item_c` = `Items`.`item_c`))) group by `Orders`.`sid` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `idn` (`idn`),
  ADD KEY `uname` (`uname`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`item_c`);

--
-- Indexes for table `Levels`
--
ALTER TABLE `Levels`
  ADD PRIMARY KEY (`ulevel`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `item_c` (`item_c`),
  ADD KEY `cid` (`cid`),
  ADD KEY `uname` (`uname`),
  ADD KEY `sid` (`sid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `Showroom`
--
ALTER TABLE `Showroom`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `To_make`
--
ALTER TABLE `To_make`
  ADD PRIMARY KEY (`item_c`,`oid`),
  ADD KEY `oid` (`oid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`uname`),
  ADD KEY `ulevel` (`ulevel`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Showroom`
--
ALTER TABLE `Showroom`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `Users` (`uname`),
  ADD CONSTRAINT `Customer_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `Showroom` (`sid`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`item_c`) REFERENCES `Items` (`item_c`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `Customer` (`cid`),
  ADD CONSTRAINT `Orders_ibfk_3` FOREIGN KEY (`uname`) REFERENCES `Users` (`uname`),
  ADD CONSTRAINT `Orders_ibfk_4` FOREIGN KEY (`sid`) REFERENCES `Showroom` (`sid`),
  ADD CONSTRAINT `Orders_ibfk_5` FOREIGN KEY (`status`) REFERENCES `Status` (`status`);

--
-- Constraints for table `To_make`
--
ALTER TABLE `To_make`
  ADD CONSTRAINT `To_make_ibfk_1` FOREIGN KEY (`item_c`) REFERENCES `Items` (`item_c`),
  ADD CONSTRAINT `To_make_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `Orders` (`oid`),
  ADD CONSTRAINT `To_make_ibfk_3` FOREIGN KEY (`status`) REFERENCES `Status` (`status`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`ulevel`) REFERENCES `Levels` (`ulevel`),
  ADD CONSTRAINT `Users_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `Showroom` (`sid`);

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin@123';
CREATE USER 'stock'@'localhost' IDENTIFIED BY 'stock@123';
CREATE USER 'sales'@'localhost' IDENTIFIED BY 'sales@123';
CREATE USER 'stockad'@'localhost' IDENTIFIED BY 'stockad@123';
CREATE USER 'stocksales'@'localhost' IDENTIFIED BY 'stocksales@123';
CREATE USER 'customer'@'localhost' IDENTIFIED BY 'customer@123';


GRANT ALL PRIVILEGES ON 
  Mfun.* TO 'admin'@'localhost';

GRANT SELECT,UPDATE,INSERT ON
  Mfun.Orders TO 'sales'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Items TO 'sales'@'localhost';

GRANT SELECT,UPDATE,INSERT ON
  Mfun.Customer TO 'sales'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun3.Orders TO 'stock'@'localhost';

GRANT SELECT ON
  Mfun.Customer TO 'stock'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Items TO 'stock'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Orders TO 'stocksales'@'localhost';

GRANT SELECT ON
  Mfun.Customer TO 'stocksales'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Items TO 'stocksales'@'localhost';

GRANT SELECT,UPDATE,INSERT ON
  Mfun.Orders TO 'stocksales'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Items TO 'stocksales'@'localhost';

GRANT SELECT,UPDATE,INSERT ON
  Mfun.Customer TO 'stocksales'@'localhost';

GRANT SELECT,UPDATE ON
  Mfun.Orders TO 'stockad'@'localhost';

GRANT SELECT,UPDATE,DELETE,INSERT ON
  Mfun.Items TO 'stockad'@'localhost';

GRANT SELECT ON Mfun.item_sold TO 'stockad'@'localhost';

GRANT SELECT ON
  Mfun.Orders TO 'customer'@'localhost';

GRANT SELECT ON
  Mfun.Customer TO 'customer'@'localhost';

GRANT SELECT ON Mfun.Item_p TO 'sales'@'localhost','customer'@'localhost',
'stockad'@'localhost','stocksales'@'localhost','stock'@'localhost';



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE DATABASE Mfun;
USE Mfun;

CREATE TABLE `Customer`(
  `cid` INT(10) NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(50) NOT NULL,
  `lname` VARCHAR(50) NOT NULL,
  `line_1` VARCHAR(255) NOT NULL,
  `line_2` VARCHAR(255),
  `line_3` VARCHAR(255),
  `city` VARCHAR(50) NOT NULL,
  `tel` CHAR(13) NOT NULL,
  `email` VARCHAR(50),
  `idn` VARCHAR(15) NOT NULL UNIQUE,
  `notes` TEXT,
  `uname` VARCHAR(25) NOT NULL,
  `sid` INT(10) NOT NULL,
  PRIMARY KEY(`cid`),
  FOREIGN KEY(`uname`) REFERENCES Users(`uname`),
  FOREIGN KEY(`sid`) REFERENCES Showroom(`sid`)
) ENGINE = InnoDB;
CREATE TABLE `Orders`(
  `oid` INT(10) NOT NULL AUTO_INCREMENT,
  `orderd_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_delivered` DATE NULL DEFAULT NULL ,
  `cid` INT(10) NOT NULL,
  `paid_amount` DECIMAL(10, 2) NOT NULL,
  `status` INT(3) NOT NULL,
  `astimate_d_date` DATE NOT NULL,
  `item_c` VARCHAR(10) NOT NULL,
  `qty` INT(5) NOT NULL,
  `line_1` VARCHAR(255) NOT NULL,
  `line_2` VARCHAR(255),
  `line_3` VARCHAR(255),
  `city` VARCHAR(50) NOT NULL,
  `Notes` TEXT,
  `total` DECIMAL(15,2) NULL DEFAULT NULL,
  `uname` VARCHAR(25) NOT NULL,
  `sid` INT(10) NOT NULL,
  PRIMARY KEY(`oid`),
  FOREIGN KEY(`item_c`) REFERENCES Items(`item_c`) ON DELETE RESTRICT,
  FOREIGN KEY(`cid`) REFERENCES Customer(`cid`) ON DELETE RESTRICT,
  FOREIGN KEY(`uname`) REFERENCES Users(`uname`),
  FOREIGN KEY(`sid`) REFERENCES Showroom(`sid`),
  FOREIGN KEY(`status`) REFERENCES Status (`status`)
) ENGINE = InnoDB;

CREATE TABLE `Showroom`(
 `sid` INT(10) AUTO_INCREMENT,
 `distric` VARCHAR(100) NOT NULL,
 PRIMARY KEY(`sid`)
)ENGINE = InnoDB;


CREATE TABLE `Items`(
  `item_c` VARCHAR(10) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `qty` INT(5) NOT NULL DEFAULT 0,
  `description` TEXT NULL,
  PRIMARY KEY(`item_c`),
  CONSTRAINT CHK_qty CHECK (qty>=0)
) ENGINE = InnoDB;


CREATE TABLE `Status`(
  `status` INT(3),
  `name` VARCHAR(100),
  PRIMARY KEY(`status`)
) ENGINE = InnoDB;
CREATE TABLE `Users`(
  `uname` VARCHAR(25),
  `password` VARCHAR(255) NOT NULL,
  `ulevel` INT(2) NOT NULL,
  `sid` INT(10) NOT NULL,
  PRIMARY KEY(`uname`),
  FOREIGN KEY(`ulevel`) REFERENCES Levels(`ulevel`),
  FOREIGN KEY(`sid`) REFERENCES Showroom(`sid`) ON DELETE RESTRICT
) ENGINE = InnoDB;
CREATE TABLE `Levels`(
  `ulevel` INT(2) NOT NULL,
  `level_name` VARCHAR(255),
  PRIMARY KEY(`ulevel`)
) ENGINE = InnoDB;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cid`, `fname`, `lname`, `line_1`, `line_2`, `line_3`, `city`, `tel`, `email`, `idn`, `notes`, `uname`, `sid`) VALUES
(1, 'Lakindu', 'Akash', 'Ebetota,Karangoda,Ratnapura', '70018', '', 'Ratnapura', '0716875404', 'lakinduakash@gmail.com', '950580143v', '9555', 'admin1', 3),
(2, 'Dulip', 'Gunasinhe', '21/8', 'Main Road', 'Walana', 'Walana', '+94756575404', 'hhahhaga@gmail.com', '954882147v', 'Urgent', 'admin1', 3),
(3, 'Ravindu', 'Munaweera', 'Gonapala', '', '', 'Katukurunda', '0725844552', '', '985214420v', 'Urgent', 'sales3', 4);

-- --------------------------------------------------------

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
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`oid`, `orderd_date`, `date_delivered`, `cid`, `paid_amount`, `status`, `astimate_d_date`, `item_c`, `qty`, `line_1`, `line_2`, `line_3`, `city`, `Notes`, `total`, `uname`, `sid`) VALUES
(3, '2017-05-28 15:49:05', NULL, 1, '40052.00', 4, '2017-05-31', 'c2', 2, 'Ebetota,Karangoda,Ratnapura', '70018', 'Ratnapura', 'Ratnapura', NULL, 50000, 'admin1', 3),
(4, '2017-05-28 15:50:16', NULL, 1, '30000.00', 1, '2017-05-31', 'c2', 2, 'Ebetota,Karangoda,Ratnapura', '70018', 'Ratnapura', 'Ratnapura', NULL, 65000, 'admin1', 3),
(5, '2017-05-28 23:06:07', '2017-05-29', 2, '6000.00', 6, '2017-06-27', 'a1', 2, 'Ebetota,Karangoda,Ratnapura', '', 'Ratnapura', 'Ratnapura', NULL, 210000, 'admin1', 3),
(6, '2017-05-28 23:07:31', NULL, 2, '80000.00', 1, '2017-05-31', 'c2', 8, 'Ebetota,Karangoda,Ratnapura', '', 'Ratnapura', 'Ratnapura', NULL, 30000, 'admin1', 3),
(7, '2017-06-03 00:22:17', NULL, 2, '600000.00', 2, '2017-06-29', 'c2', 5, '4', NULL, NULL, '55', NULL, 39000, 'admin1', 3),
(8, '2017-06-03 14:53:31', '2017-06-03', 3, '60000.00', 6, '2017-06-06', 'a1', 2, 'Katukurunda', '', '', 'Gonapola', NULL, '60000.00', 'sales3', 4);

-- --------------------------------------------------------

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




CREATE VIEW c_sales_by_sid AS SELECT sid, SUM(paid_amount) AS total FROM Orders GROUP BY sid;

CREATE VIEW n_sales_by_sid AS SELECT Orders.sid, SUM(Orders.qty*Items.price) AS total FROM Orders INNER JOIN Items ON Orders.item_c=Items.item_c GROUP BY Orders.sid;

CREATE VIEW item_sold AS SELECT item_c,SUM(qty) AS total_qty FROM Orders GROUP BY item_c;

CREATE VIEW Item_p AS SELECT item_c,price,description FROM Items;


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




SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `address` (
  `username` varchar(30) NOT NULL,
  `address` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

CREATE TABLE `customer` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer` (`username`, `name`, `email`, `password`, `contact_no`) VALUES
('user_1', 'user_1', 'user_1@abc.com', 'user_1', '1234567890');

CREATE TABLE `manager` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `R_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `manager` (`username`, `name`, `email`, `address`, `password`, `contact_no`, `R_ID`) VALUES
('manager_1', 'manager_1', 'manager_1@abc.com', 'abc road', 'manager', '1234567890', 2);

CREATE TABLE `menu_item` (
  `item_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `R_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `menu_item` (`item_ID`, `name`, `price`, `description`, `R_ID`) VALUES
(1, 'Paneer Butter Masala ', 150, 'description', 2),
(2, 'Kadhai Paneer ', 125, 'description', 2),
(3, 'Butter Chicken', 132, 'description', 2),
(4, 'Malai Kofta ', 185, 'description', 2),
(11, 'Tandoori Roti', 20, 'description', 2),
(12, 'Chole Bhature', 120, 'description', 3),
(13, 'Kadai Chicken', 180, 'Spicy', 2);


CREATE TABLE `orders` (
  `order_ID` int(30) NOT NULL,
  `total_price` varchar(30) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(30) NOT NULL,
  `delivery_address` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL,
  `R_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `order_item` (
  `order_ID` int(30) NOT NULL,
  `item_ID` int(30) NOT NULL,
  `quantity` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `payment` (
  `payment_ID` int(30) NOT NULL,
  `amount` int(30) NOT NULL,
  `payment_date` date NOT NULL,
  `order_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `restaurant` (
  `R_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `rating` float(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `restaurant` (`R_ID`, `name`, `location`, `phone_number`, `rating`) VALUES
(2, 'Smart Pind', 'Mg road', '1234567890', 3.5),
(3, 'Peep Kitchen', 'Abcd Road', '1234567890', 3.0),
(16, 'Heritage', 'Nice road', '09932977700', 3.0),
(18, 'Dakshin', 'church street', '9912345612', 3.0);



CREATE TABLE `review` (
  `review_ID` int(30) NOT NULL,
  `rating` int(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `order_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `address`
  ADD PRIMARY KEY (`username`,`address`);


ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);


ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);


ALTER TABLE `manager`
  ADD PRIMARY KEY (`username`),
  ADD KEY `manager_ibfk_1` (`R_ID`);


ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `menu_item_ibfk_1` (`R_ID`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `username` (`username`),
  ADD KEY `R_ID` (`R_ID`);

ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_ID`,`item_ID`),
  ADD KEY `item_ID` (`item_ID`);


ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `order_ID` (`order_ID`);


ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`R_ID`);


ALTER TABLE `review`
  ADD PRIMARY KEY (`review_ID`),
  ADD KEY `order_ID` (`order_ID`);

ALTER TABLE `menu_item`
  MODIFY `item_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `orders`
  MODIFY `order_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `payment`
  MODIFY `payment_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `restaurant`
  MODIFY `R_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


ALTER TABLE `review`
  MODIFY `review_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`R_ID`) REFERENCES `restaurant` (`R_ID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `menu_item`
  ADD CONSTRAINT `menu_item_ibfk_1` FOREIGN KEY (`R_ID`) REFERENCES `restaurant` (`R_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`R_ID`) REFERENCES `restaurant` (`R_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `menu_item` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`);
COMMIT;


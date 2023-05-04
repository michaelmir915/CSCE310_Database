-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 12:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenity`
--

CREATE TABLE `amenity` (
  `AMENITY_CODE` int(11) NOT NULL,
  `DESCRIPTION` mediumtext NOT NULL,
  `AVAILABILITY` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenity`
--

INSERT INTO `amenity` (`AMENITY_CODE`, `DESCRIPTION`, `AVAILABILITY`) VALUES
(1, 'Airport Shuttle', 1),
(2, 'Meeting Room Rental', 1),
(3, 'Business Center ', 1),
(4, 'Late Check-Out', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOKING_KEY` int(11) NOT NULL,
  `USERNAME` varchar(48) NOT NULL,
  `BOOKING_COST` double NOT NULL,
  `BOOKING_START` date NOT NULL,
  `BOOKING_END` date NOT NULL,
  `BOOKING_NOTES` text NOT NULL,
  `BOOKING_FOOD` int(11) NOT NULL,
  `LOCATION_NUMBER` int(11) NOT NULL,
  `ROOM_NUMBER` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOKING_KEY`, `USERNAME`, `BOOKING_COST`, `BOOKING_START`, `BOOKING_END`, `BOOKING_NOTES`, `BOOKING_FOOD`, `LOCATION_NUMBER`, `ROOM_NUMBER`) VALUES
(1, 'MyKell', 149.99, '2023-05-03', '2023-05-08', 'Hate this room\r\n', 0, 1, '101');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_NUMBER` int(11) NOT NULL,
  `IS_MANAGER` int(11) DEFAULT NULL,
  `POSITION` tinytext NOT NULL,
  `PAY_RATE_HOUR` double DEFAULT NULL,
  `EMPLOYEE_PAY` double DEFAULT NULL,
  `EMPLOYEE_HIRE_DATE` date NOT NULL,
  `EMPLOYEE_TERMANATION_DATE` date DEFAULT NULL,
  `EMPLOYEE_NOTES` mediumtext NOT NULL,
  `EMPLOYEE_ADRESS` mediumtext NOT NULL,
  `EMPLOYEE_STANDARD_HOURS` tinytext NOT NULL,
  `LOCATION_NUM` int(11) NOT NULL,
  `EMPLOYEE_EMAIL` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `LOCATION_NUMBER` int(11) NOT NULL,
  `ITEM_NUMBER` int(11) NOT NULL,
  `COST` double NOT NULL,
  `FOOD_NAME` text NOT NULL,
  `FOOD_INGREDIENTS` mediumtext NOT NULL,
  `FOOD_AVAILABILITY` int(11) NOT NULL,
  `FOOD_NOTES` mediumtext NOT NULL,
  `FOOD_LOCATION_NOTES` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`LOCATION_NUMBER`, `ITEM_NUMBER`, `COST`, `FOOD_NAME`, `FOOD_INGREDIENTS`, `FOOD_AVAILABILITY`, `FOOD_NOTES`, `FOOD_LOCATION_NOTES`) VALUES
(1, 1, 8.99, 'Cheeseburger', 'Beef Patty, American Cheese, Lettuce, Tomato, Pickles, Onions', 9999, '', ''),
(1, 2, 3.99, 'Fries', 'Potatoes, Salt', 9999, '', ''),
(1, 3, 2.99, 'Potato Chips', 'Potatoes, Salt, Pepper', 9999, '', ''),
(1, 4, 9.99, 'Caesar Salad', 'Romaine lettuce, Croutons, Parmesan cheese', 9999, '', ''),
(1, 5, 10.99, 'Club Sandwich', 'Bacon, Lettuce, Tomato, Chicken, Mayo', 9999, '', ''),
(1, 6, 17.99, 'New York Strip Steak', 'New York strip steak, mashed potatoes, grilled asparagus, and red wine sauce', 9999, '', ''),
(1, 7, 12.99, 'Chicken Parmesan', 'Breaded chicken breast, tomato sauce, mozzarella cheese, parmesan cheese, and spaghetti pasta', 9999, '', ''),
(1, 8, 6.99, 'Chocolate Cake', 'Chocolate cake, chocolate frosting, and optionally whipped cream and berries', 9999, '', ''),
(1, 9, 7.99, 'Tiramisu', 'Layers of ladyfingers soaked in espresso and liquor, with a creamy mixture of mascarpone cheese, sugar, and whipped cream, dusted with cocoa powder on top', 9999, '', ''),
(1, 10, 1.99, 'Bottled Water', 'Filtered water', 9999, '', ''),
(1, 11, 2.99, 'Soft Drink', 'Your choice of Coke, Sprite, Ginger Ale, Sweet, or Unsweet Tea', 9999, '', ''),
(1, 12, 4.99, 'Domestic Beer', 'Your choice of Budweiser, Miller Lite, Coors Light, Bud Light, Yuengling Lager, and Shiner Bock', 9999, '', ''),
(1, 13, 5.99, 'Imported Beer', 'Your choice of Corona Extra, Heineken, Stella Artois, Guinness Draught, Dos Equis, and Modelo Especial', 9999, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `food_list`
--

CREATE TABLE `food_list` (
  `LOCATION_NUMBER` int(11) NOT NULL,
  `ORDER_NUMBER` double NOT NULL,
  `ITEM_NUMBER` int(11) NOT NULL,
  `ROOM_NUMBER` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `USERNAME` varchar(48) NOT NULL,
  `CC_NUMBER` tinytext NOT NULL,
  `CC_CCV` int(11) NOT NULL,
  `CC_EXP` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`USERNAME`, `CC_NUMBER`, `CC_CCV`, `CC_EXP`) VALUES
('regularUser', '2250894712345647', 456, '04/22');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `LOCATION_NUMBER` int(11) NOT NULL,
  `HOTEL_NAME` tinytext NOT NULL,
  `HOTEL_PHONE_AREA` int(11) NOT NULL,
  `HOTEL_PHONE` int(11) NOT NULL,
  `HOTEL_EMAIL` tinytext NOT NULL,
  `HOTEL_ADDRESS` text NOT NULL,
  `HOTEL_RATING` double NOT NULL,
  `HOTEL_MANAGER_NUMBER` int(11) NOT NULL,
  `AMENITY_CODE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- --------------------ALEX TUNG---------------------------
--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `REVIEW_ID` int(11) NOT NULL,
  `LOCATION_NUMBER` int(11) NOT NULL,
  `USERNAME` varchar(48) NOT NULL,
  `REVIEW_TITLE` tinytext NOT NULL,
  `REVIEW_RATING` int(11) NOT NULL,
  `REVIEW_BODY` longtext NOT NULL,
  `REVIEW_TIME_OF_STAY` date NOT NULL,
  `REVIEW_DAYS_STAYED` int(11) NOT NULL,
  `REVIEW_TIME_CREATED` date NOT NULL,
  `REVIEW_HELPFUL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`REVIEW_ID`, `LOCATION_NUMBER`, `USERNAME`, `REVIEW_TITLE`, `REVIEW_RATING`, `REVIEW_BODY`, `REVIEW_TIME_OF_STAY`, `REVIEW_DAYS_STAYED`, `REVIEW_TIME_CREATED`, `REVIEW_HELPFUL`) VALUES 
(1, 1, 'smittylife', 'Great hotel', 5, 'I had an amazing stay at this hotel. The staff was friendly, the rooms were clean and comfortable, and the location was perfect.', '2022-03-15', 3, '2022-03-20', 10),
(2, 4, 'lilybelle33', 'Disappointing experience', 2, 'I was very disappointed with my stay at this hotel. The room was dirty, the staff was unfriendly, and the amenities were not as advertised.', '2022-04-01', 2, '2022-04-03', 2),
(3, 5, 'thecoffeeguru', 'Average hotel', 3, 'This hotel was okay. The room was clean but small, and the staff was average. The location was convenient, but there were some issues with noise.', '2022-05-10', 5, '2022-05-13', 5),
(4, 3, 'bluerose99', 'Excellent stay', 5, 'I had an excellent stay at this hotel. The room was spacious and comfortable, and the staff was very helpful. The location was also great.', '2022-06-20', 7, '2022-06-25', 20),
(5, 2, 'spunkykid45', 'Terrible experience', 1, 'I had a terrible experience at this hotel. The room was dirty and smelly, the staff was rude, and the amenities were non-existent. I would never stay here again.', '2022-07-05', 1, '2022-07-06', 0),
(6, 1, 'rockstar81', 'Wonderful stay', 5, 'I had an amazing time at this location! The staff were friendly, the facilities were clean and comfortable, and the food was delicious. I would definitely recommend this place to anyone looking for a relaxing getaway.', '2022-04-15', 3, '2022-05-03', 10),
(7, 5, 'happymomma4', 'Disappointing experience', 2, 'I had high hopes for this location, but unfortunately it fell short in many ways. The room was not very clean, the staff were unfriendly, and the food was mediocre at best. I would not recommend this place.', '2022-03-10', 2, '2022-05-02', 2),
(8, 3, 'greeneyedgirl', 'Great location, but noisy', 4, 'The location of this place was perfect for exploring the city, but unfortunately the noise level was quite high. The walls seemed thin and I could hear my neighbors conversations. Otherwise, everything was great!', '2022-05-01', 5, '2022-05-01', 7),
(9, 4, 'mountainclimber7', 'Lovely property', 5, 'This property was absolutely gorgeous. The grounds were well-maintained and the room was spacious and comfortable. The staff were also very friendly and helpful. I would definitely stay here again!', '2022-04-20', 2, '2022-04-30', 20),
(10, 1, 'beachlover23', 'Mixed feelings', 3, 'My stay at this location was a bit of a mixed bag. On the one hand, the staff were very helpful and the room was clean. On the other hand, the facilities were a bit outdated and the location was not very convenient. Overall, an okay experience.', '2022-04-05', 4, '2022-04-29', 5),
(11, 3, 'craftygal88', 'Wonderful stay', 5, 'I had a fantastic stay at this location. The staff were very friendly and accommodating. The room was clean and comfortable, and the amenities were great. I especially loved the pool and fitness center. The location was also perfect, with easy access to shopping and restaurants. I highly recommend this hotel!', '2022-04-15', 3, '2022-04-19', 23),
(12, 2, 'bookworm42', 'Disappointing experience', 2, 'Unfortunately, I was very disappointed with my stay at this hotel. The room was not very clean and had a strange odor. The staff were not very friendly or helpful. I also had some issues with the amenities - the pool was closed for maintenance during my stay, and the fitness center was not well-maintained. The location was okay, but there were not many good dining options nearby. Overall, I would not recommend this hotel.', '2022-05-01', 2, '2022-05-04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `LOCATION_NUM` int(11) NOT NULL,
  `ROOM_NUMBER` varchar(48) NOT NULL,
  `ROOM_TYPE` tinytext NOT NULL,
  `ROOM_COST` double NOT NULL,
  `BOOKING_KEY` int(11) NOT NULL,
  `AMENITY_CODE` int(11) NOT NULL,
  `NOTES` mediumtext NOT NULL,
  `ROOM_PHOTOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`LOCATION_NUM`, `ROOM_NUMBER`, `ROOM_TYPE`, `ROOM_COST`, `BOOKING_KEY`, `AMENITY_CODE`, `NOTES`, `ROOM_PHOTOS`) VALUES
(1, '101', 'Single', 149.99, 1, 1, 'First floor room #101 Single ', 0),
(1, '102', 'Double', 209.99, 2, 1, 'Two bedroom', 0),
(1, '103', 'Conjoined Double', 249.99, 3, 1, 'Two bedroom one bed each first floor', 0),
(1, '201', 'Single', 149.99, 1, 1, 'Second floor room #101 Single ', 0),
(1, '202', 'Double', 209.99, 2, 1, 'Two bedroom Second floor', 0),
(1, '203', 'Conjoined Double', 249.99, 3, 1, 'Two bedroom one bed each second floor', 0),
(1, '301', 'Single', 149.99, 1, 1, 'Third floor room #101 Single ', 0),
(1, '302', 'Double', 209.99, 2, 1, 'Two bedroom Third floor', 0),
(1, '303', 'Conjoined Double', 249.99, 3, 1, 'Two bedroom one bed each third floor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_hotel`
--

CREATE TABLE `user_hotel` (
  `ACCOUNT_NUMBER` bigint(255) NOT NULL,
  `USERNAME` varchar(48) NOT NULL,
  `EMPLOYEE_NUMBER` int(11) DEFAULT NULL,
  `PASSWORD` tinytext NOT NULL,
  `FIRST_NAME` tinytext NOT NULL,
  `LAST_NAME` tinytext NOT NULL,
  `USER_EMAIL` text NOT NULL,
  `USER_AREA_CODE` int(11) NOT NULL,
  `USER_NUMBER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_hotel`
--

INSERT INTO `user_hotel` (`ACCOUNT_NUMBER`, `USERNAME`, `EMPLOYEE_NUMBER`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `USER_EMAIL`, `USER_AREA_CODE`, `USER_NUMBER`) VALUES
(1, 'admin', 0, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Boss', 'Man', 'bossMan@demo.hotel.com', 800, 5555829),
(2, 'regularUser', NULL, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Regular', 'User', 'regulardude@rmail.com', 123, 4567890),
(3, 'mykel', NULL, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Mykel', 'NoLast', 'mykel@defReal.email.gov', 987, 6543210);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenity`
--
ALTER TABLE `amenity`
  ADD PRIMARY KEY (`AMENITY_CODE`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOKING_KEY`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_NUMBER`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`LOCATION_NUMBER`,`ITEM_NUMBER`);

--
-- Indexes for table `food_list`
--
ALTER TABLE `food_list`
  ADD PRIMARY KEY (`LOCATION_NUMBER`,`ORDER_NUMBER`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`LOCATION_NUMBER`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`REVIEW_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`LOCATION_NUM`,`ROOM_NUMBER`);

--
-- Indexes for table `user_hotel`
--
ALTER TABLE `user_hotel`
  ADD PRIMARY KEY (`ACCOUNT_NUMBER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOKING_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_hotel`
--
ALTER TABLE `user_hotel`
  MODIFY `ACCOUNT_NUMBER` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

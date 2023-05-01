-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 01:21 AM
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
  `AVAILABILITY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOKING_KEY` int(11) NOT NULL,
  `USERNAME` varchar(48) NOT NULL,
  `BOOKING_COST` double NOT NULL,
  `BOOKING_DATE` date NOT NULL,
  `BOOKING_DURRATION` int(11) NOT NULL,
  `BOOKING_NOTES` text NOT NULL,
  `BOOKING_FOOD` int(11) NOT NULL,
  `LOCATION_NUMBER` int(11) NOT NULL,
  `ROOM_NUBER` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOKING_KEY`, `USERNAME`, `BOOKING_COST`, `BOOKING_DATE`, `BOOKING_DURRATION`, `BOOKING_NOTES`, `BOOKING_FOOD`, `LOCATION_NUMBER`, `ROOM_NUBER`) VALUES
(1, 'MyKell', 149.99, '2023-05-03', 3, 'first book', 0, 1, '101');

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
  `CC_NUMBER` int(11) NOT NULL,
  `CC_CCV` int(11) NOT NULL,
  `CC_EXP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `ACCOUNT_NUMBER` int(11) NOT NULL,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

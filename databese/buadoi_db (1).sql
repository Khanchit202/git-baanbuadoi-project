-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 03:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buadoi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `bookTel` varchar(10) NOT NULL,
  `bookDateStart` datetime NOT NULL,
  `bookDateEnd` datetime NOT NULL,
  `bookPrice` decimal(8,2) NOT NULL,
  `bookDate` datetime NOT NULL,
  `bookDetail` varchar(500) NOT NULL,
  `bookConfirm` tinyint(1) NOT NULL,
  `bookStatus` tinyint(1) NOT NULL,
  `bookCancel` tinyint(1) NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `pmtID` tinyint(5) UNSIGNED ZEROFILL NOT NULL,
  `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookID`, `bookName`, `bookTel`, `bookDateStart`, `bookDateEnd`, `bookPrice`, `bookDate`, `bookDetail`, `bookConfirm`, `bookStatus`, `bookCancel`, `userID`, `pmtID`, `roomID`, `serviceID`) VALUES
(00003, 'สมชาย', '0830026319', '2024-08-27 18:55:02', '2024-08-27 18:55:02', '500.00', '2024-08-27 18:55:02', 'จองห้องพัก', 1, 1, 0, 00003, 00001, 00007, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `booking_bill`
--

CREATE TABLE `booking_bill` (
  `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `payID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `bookID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_bill`
--

INSERT INTO `booking_bill` (`billID`, `payID`, `bookID`, `userID`, `roomID`, `serviceID`) VALUES
(00003, 00001, 00003, 00003, 00007, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `booking_payment`
--

CREATE TABLE `booking_payment` (
  `payID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `payPic` varchar(100) NOT NULL,
  `payDate` datetime NOT NULL,
  `payNameAc` varchar(100) NOT NULL,
  `payManey` decimal(8,2) NOT NULL,
  `payStatus` tinyint(1) NOT NULL,
  `bookID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_payment`
--

INSERT INTO `booking_payment` (`payID`, `payPic`, `payDate`, `payNameAc`, `payManey`, `payStatus`, `bookID`, `userID`, `roomID`, `serviceID`) VALUES
(00001, 'pay.jpg', '2024-08-27 18:57:08', 'somchai', '250.00', 1, 00003, 00003, 00007, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `checking`
--

CREATE TABLE `checking` (
  `checkID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `checkDate` datetime NOT NULL,
  `checkStatus` varchar(45) NOT NULL,
  `user_userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checking`
--

INSERT INTO `checking` (`checkID`, `checkDate`, `checkStatus`, `user_userID`, `billID`) VALUES
(00001, '2024-08-27 18:58:19', 'สำเร็จ', 00003, 00003);

-- --------------------------------------------------------

--
-- Table structure for table `checking_fine`
--

CREATE TABLE `checking_fine` (
  `fineID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `fineDetail` varchar(255) NOT NULL,
  `finePrice` decimal(8,2) NOT NULL,
  `fineStatus` tinyint(1) NOT NULL,
  `fineType` varchar(5) NOT NULL,
  `fineDate` datetime NOT NULL,
  `checkID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `newTitle` varchar(100) NOT NULL,
  `newDetail` varchar(500) NOT NULL,
  `newPic` varchar(100) NOT NULL,
  `newType` varchar(8) NOT NULL,
  `newDate` datetime NOT NULL,
  `user_userID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newID`, `newTitle`, `newDetail`, `newPic`, `newType`, `newDate`, `user_userID`) VALUES
(00002, 'งานย้อมผ้าจากสีธรรมชาติ', 'งานย้อมผ้าจากสีธรรมชาติ', 'img.jpg', 'ชุมชน', '2024-08-17 16:45:53', 00003),
(00003, 'ฤดูดอกซากุระ', 'ฤดูดอกซากุระ', 'img1.jpg', 'เทศกาล', '2024-08-17 13:43:26', 00003),
(00004, 'งานเข้าพรรษาชุมชน', 'งานเข้าพรรษาชุมชน', 'img2.jpg', 'ชุมชน', '2024-08-17 13:49:18', 00003),
(00006, 'อะโวคาโด สายพันธุ์Has', 'อะโวคาโด สายพันธุ์Has', 'avo.jpg', 'สินค้า', '2024-08-18 07:45:28', 00003),
(00010, 'บัวหิมะสด', 'บัวหิมะสด', 'bua.jpg', 'สินค้า', '2024-08-18 08:31:05', 00003),
(00011, 'สมุนไพรเจียวกู่หลาน', 'สมุนไพรเจียวกู่หลาน', 'jsl.jpg', 'สินค้า', '2024-08-18 08:32:34', 00003),
(00012, 'สมุนไพรปู่เฒ่าทิ้งไม้เท้า', 'สมุนไพรปู่เฒ่าทิ้งไม้เท้า', 'butal.jpg', 'สินค้า', '2024-08-18 08:33:10', 00003),
(00013, 'สมุนไพรปู่เฒ่าทิ้งไม้เท้า', 'สมุนไพรปู่เฒ่าทิ้งไม้เท้า', 'butal.jpg', 'สินค้า', '2024-08-18 08:33:10', 00003),
(00015, 'ประเพณีงานหนุ่มสาวชุมชนบ้านนอแล', 'กิจกรรมช่วงก่อนออกพรรษาทางหนุ่มสาวบ้านนอแลจะมีการทำบุญและมีกิจกรรมร่วมกันเพื่อสร้างความสามัคคีกัน และเป็นการเชิญช่วนให้คนหนุ่มสาวหันมาเข้าวัดทำบุญกันมากขึ้น', 'about1.jpg', 'ชุมชน', '2024-08-18 08:33:10', 00003);

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `stdID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `stdDetail` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`stdID`, `stdDetail`) VALUES
(00001, 'ว่าง'),
(00002, 'ไม่ว่าง'),
(00003, 'รอสักครู่');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `pmtID` tinyint(5) UNSIGNED ZEROFILL NOT NULL,
  `pmtTitle` varchar(100) NOT NULL,
  `pmtDetail` varchar(255) NOT NULL,
  `pmtCode` varchar(10) NOT NULL,
  `pmtDiscont` decimal(8,2) NOT NULL,
  `pmtUnit` text NOT NULL,
  `pmtDate` datetime NOT NULL,
  `pmtStartDate` datetime NOT NULL,
  `pmtEndDate` datetime NOT NULL,
  `pmtPic` varchar(100) NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`pmtID`, `pmtTitle`, `pmtDetail`, `pmtCode`, `pmtDiscont`, `pmtUnit`, `pmtDate`, `pmtStartDate`, `pmtEndDate`, `pmtPic`, `userID`) VALUES
(00001, 'ลดราคา', 'Tour bus', '00001', '100.00', 'ฺB', '2024-08-27 18:52:40', '2024-08-27 18:52:40', '2024-08-27 18:52:40', 'pomo.jpg', 00003);

-- --------------------------------------------------------

--
-- Table structure for table `reviws_room`
--

CREATE TABLE `reviws_room` (
  `rvrID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `rvrDetail` varchar(255) NOT NULL,
  `rvrScore` smallint(5) NOT NULL,
  `rvrDate` datetime NOT NULL,
  `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `checkID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviws_room`
--

INSERT INTO `reviws_room` (`rvrID`, `rvrDetail`, `rvrScore`, `rvrDate`, `roomID`, `checkID`, `userID`, `billID`) VALUES
(00000000002, 'รีวิวห้องพัก', 2, '2024-08-27 18:59:11', 00007, 00001, 00003, 00003);

-- --------------------------------------------------------

--
-- Table structure for table `reviws_service`
--

CREATE TABLE `reviws_service` (
  `rvsID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `rvsDetail` varchar(255) NOT NULL,
  `rvsScore` smallint(5) NOT NULL,
  `rvsDate` datetime NOT NULL,
  `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `checkID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_product`
--

CREATE TABLE `room_product` (
  `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `roomPrice` decimal(8,2) NOT NULL,
  `roomName` varchar(100) NOT NULL,
  `roomDetail` varchar(500) NOT NULL,
  `roomBed` smallint(3) NOT NULL,
  `roomBath` smallint(3) NOT NULL,
  `roomLocation` varchar(500) NOT NULL,
  `roomPic` varchar(100) NOT NULL,
  `roomMax` smallint(2) NOT NULL,
  `roomMin` tinyint(1) NOT NULL,
  `stdID` smallint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_product`
--

INSERT INTO `room_product` (`roomID`, `roomPrice`, `roomName`, `roomDetail`, `roomBed`, `roomBath`, `roomLocation`, `roomPic`, `roomMax`, `roomMin`, `stdID`) VALUES
(00007, '500.00', 'ห้องส่วนตัว', 'ห้องส่วนตัว', 2, 1, 'ห้องส่วนตัว', 'room1.jpg', 3, 1, 00001),
(00008, '300.00', 'ห้องเดียว', 'ห้องเดียว', 1, 1, 'ห้องเดียว', 'room2.jpg', 1, 1, 00002),
(00009, '300.00', 'ห้องเดียว', 'ห้องเดียว', 1, 1, 'ห้องเดียว', 'room3.jpg', 1, 1, 00003),
(00010, '300.00', 'ห้องเดียว', 'ห้องเดียว', 1, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00011, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room3.jpg', 1, 1, 00001),
(00012, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00013, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room2.jpg', 1, 1, 00001),
(00014, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00015, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00016, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00017, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00018, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00019, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001),
(00020, '500.00', 'ห้องส่วนตัว', 'ห้องเดียว', 2, 1, 'ห้องเดียว', 'room1.jpg', 1, 1, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `service_product`
--

CREATE TABLE `service_product` (
  `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `serviceName` varchar(100) NOT NULL,
  `serviceDetail` varchar(500) NOT NULL,
  `servicePrice` decimal(8,2) NOT NULL,
  `serviceTotal` smallint(5) NOT NULL,
  `serviceTime` smallint(3) NOT NULL,
  `stdID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `servicePic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_product`
--

INSERT INTO `service_product` (`serviceID`, `serviceName`, `serviceDetail`, `servicePrice`, `serviceTotal`, `serviceTime`, `stdID`, `servicePic`) VALUES
(00001, 'เต้นฑ์', 'เต้นฑ์', '150.00', 0, 1, 00001, 'service1.png'),
(00002, 'รถนำเที่ยว', 'รถนำเที่ยว', '500.00', 3, 2, 00002, 'car1.jpg'),
(00003, 'ไกด์นำเที่ยว', 'ไกด์นำเที่ยว', '100.00', 3, 2, 00001, 'peple.jpg'),
(00004, 'เซทหมูกระทะ', 'เซทหมูกระทะ', '500.00', 10, 2, 00003, 'pig.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `counterID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `counterDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userFName` varchar(255) NOT NULL,
  `userLName` varchar(255) NOT NULL,
  `userTel` varchar(10) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userLavelID` tinyint(1) UNSIGNED ZEROFILL NOT NULL,
  `userImg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPass`, `userFName`, `userLName`, `userTel`, `userEmail`, `userLavelID`, `userImg`) VALUES
(00001, 'admin', '$2y$10$9THP/QOe9XU8yawf3gwyFeRrxkBaPQvjZAvpXB5esoS8sdnDY8m..', 'admin', 'test', '022222222', 'admin@buadoi.ac.th', 1, 'img/profile/profile_1.jpg'),
(00002, 'owner', '$2y$10$HY6cvbKUxCAdTlafCj4J0eTUIJxRajqmV2OsX1ef844CnMZD/xilC', 'owner', 'test', '022222222', 'owner@buadoi.ac.th', 2, 'img/profile/profile_1.jpg'),
(00003, 'emp', '$2y$10$TR.cHBGCl6oux5shnYyBC.8RNh0jr/ljP9sQwHQB7EmWS8fQs.25q', 'employee', 'test', '022222222', 'employee@buadoi.ac.th', 3, 'img/profile/profile_1.jpg'),
(00004, 'member', '$2y$10$7y0j5hzGnJZAgqELMzLHQeYlqrUJ3NYiXFOl6FxgoIyEaeCTDahKa', 'member', 'test', '01111111', 'member@buadoi.ac.th', 4, 'img/profile/profile_1.jpg'),
(00018, 'khanchit', '$2y$10$3hcxGrtp4YZ/q0V/93V8UOa/DiK2.sCuVwgmcOPoOu3tJ6KZbYagq', 'khanchit', 'Bangphra', '0958053137', 'khanchit202@gmail.com', 1, 'img/profile/profile_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_lavel`
--

CREATE TABLE `user_lavel` (
  `userLavelID` tinyint(1) UNSIGNED ZEROFILL NOT NULL,
  `userLavelName` varchar(6) NOT NULL,
  `userLavelTitle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_lavel`
--

INSERT INTO `user_lavel` (`userLavelID`, `userLavelName`, `userLavelTitle`) VALUES
(1, 'admin', 'ผู้ดูแลระบบ'),
(2, 'owner', 'เจ้าของกิจการ'),
(3, 'emp', 'พนักงาน'),
(4, 'member', 'สมาชิก');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `pmtID` (`pmtID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `booking_bill`
--
ALTER TABLE `booking_bill`
  ADD PRIMARY KEY (`billID`),
  ADD KEY `payID` (`payID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `booking_payment`
--
ALTER TABLE `booking_payment`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `checking`
--
ALTER TABLE `checking`
  ADD PRIMARY KEY (`checkID`),
  ADD KEY `user_userID` (`user_userID`),
  ADD KEY `billID` (`billID`);

--
-- Indexes for table `checking_fine`
--
ALTER TABLE `checking_fine`
  ADD PRIMARY KEY (`fineID`),
  ADD KEY `checkID` (`checkID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `billID` (`billID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newID`),
  ADD KEY `user_userID` (`user_userID`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`stdID`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`pmtID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `reviws_room`
--
ALTER TABLE `reviws_room`
  ADD PRIMARY KEY (`rvrID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `checkID` (`checkID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `billID` (`billID`);

--
-- Indexes for table `reviws_service`
--
ALTER TABLE `reviws_service`
  ADD PRIMARY KEY (`rvsID`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `checkID` (`checkID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `billID` (`billID`);

--
-- Indexes for table `room_product`
--
ALTER TABLE `room_product`
  ADD PRIMARY KEY (`roomID`),
  ADD KEY `stdID` (`stdID`);

--
-- Indexes for table `service_product`
--
ALTER TABLE `service_product`
  ADD PRIMARY KEY (`serviceID`),
  ADD KEY `stdID` (`stdID`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`counterID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userLavelID` (`userLavelID`);

--
-- Indexes for table `user_lavel`
--
ALTER TABLE `user_lavel`
  ADD PRIMARY KEY (`userLavelID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_bill`
--
ALTER TABLE `booking_bill`
  MODIFY `billID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_payment`
--
ALTER TABLE `booking_payment`
  MODIFY `payID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checking`
--
ALTER TABLE `checking`
  MODIFY `checkID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checking_fine`
--
ALTER TABLE `checking_fine`
  MODIFY `fineID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `stdID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `pmtID` tinyint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviws_room`
--
ALTER TABLE `reviws_room`
  MODIFY `rvrID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviws_service`
--
ALTER TABLE `reviws_service`
  MODIFY `rvsID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_product`
--
ALTER TABLE `room_product`
  MODIFY `roomID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service_product`
--
ALTER TABLE `service_product`
  MODIFY `serviceID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `counterID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_lavel`
--
ALTER TABLE `user_lavel`
  MODIFY `userLavelID` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`pmtID`) REFERENCES `promotions` (`pmtID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`roomID`) REFERENCES `room_product` (`roomID`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`serviceID`) REFERENCES `service_product` (`serviceID`);

--
-- Constraints for table `booking_bill`
--
ALTER TABLE `booking_bill`
  ADD CONSTRAINT `booking_bill_ibfk_1` FOREIGN KEY (`payID`) REFERENCES `booking_payment` (`payID`),
  ADD CONSTRAINT `booking_bill_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `booking` (`bookID`),
  ADD CONSTRAINT `booking_bill_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `booking_bill_ibfk_4` FOREIGN KEY (`roomID`) REFERENCES `room_product` (`roomID`),
  ADD CONSTRAINT `booking_bill_ibfk_5` FOREIGN KEY (`serviceID`) REFERENCES `service_product` (`serviceID`);

--
-- Constraints for table `booking_payment`
--
ALTER TABLE `booking_payment`
  ADD CONSTRAINT `booking_payment_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `booking` (`bookID`),
  ADD CONSTRAINT `booking_payment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `booking_payment_ibfk_3` FOREIGN KEY (`roomID`) REFERENCES `room_product` (`roomID`),
  ADD CONSTRAINT `booking_payment_ibfk_4` FOREIGN KEY (`serviceID`) REFERENCES `service_product` (`serviceID`);

--
-- Constraints for table `checking`
--
ALTER TABLE `checking`
  ADD CONSTRAINT `checking_ibfk_1` FOREIGN KEY (`user_userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `checking_ibfk_2` FOREIGN KEY (`billID`) REFERENCES `booking_bill` (`billID`);

--
-- Constraints for table `checking_fine`
--
ALTER TABLE `checking_fine`
  ADD CONSTRAINT `checking_fine_ibfk_1` FOREIGN KEY (`checkID`) REFERENCES `checking` (`checkID`),
  ADD CONSTRAINT `checking_fine_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `checking_fine_ibfk_3` FOREIGN KEY (`billID`) REFERENCES `booking_bill` (`billID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reviws_room`
--
ALTER TABLE `reviws_room`
  ADD CONSTRAINT `reviws_room_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `room_product` (`roomID`),
  ADD CONSTRAINT `reviws_room_ibfk_2` FOREIGN KEY (`checkID`) REFERENCES `checking` (`checkID`),
  ADD CONSTRAINT `reviws_room_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reviws_room_ibfk_4` FOREIGN KEY (`billID`) REFERENCES `booking_bill` (`billID`);

--
-- Constraints for table `reviws_service`
--
ALTER TABLE `reviws_service`
  ADD CONSTRAINT `reviws_service_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service_product` (`serviceID`),
  ADD CONSTRAINT `reviws_service_ibfk_2` FOREIGN KEY (`checkID`) REFERENCES `checking` (`checkID`),
  ADD CONSTRAINT `reviws_service_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reviws_service_ibfk_4` FOREIGN KEY (`billID`) REFERENCES `booking_bill` (`billID`);

--
-- Constraints for table `room_product`
--
ALTER TABLE `room_product`
  ADD CONSTRAINT `room_product_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `product_status` (`stdID`);

--
-- Constraints for table `service_product`
--
ALTER TABLE `service_product`
  ADD CONSTRAINT `service_product_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `product_status` (`stdID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userLavelID`) REFERENCES `user_lavel` (`userLavelID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

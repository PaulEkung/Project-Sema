-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2024 at 09:55 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crsema`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaintId` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `context` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `writer` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaintId`, `subject`, `context`, `image`, `writer`, `date`) VALUES
(5, 'This is a complaint subject', ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam tempora odit praesentium tempore, error harum natus delectus hic? Dolor dolores commodi non corrupti nam odit saepe repellat, quia asperiores aut.\r\n', 'This is a complaint subject65083747839581.81394181.jfif', 'Supervisor(Adagom1 settlement)', '2023-09-18 11:40:55'),
(6, 'Blabalabalabalabal', 'balabalabalabalabalabalabnalanbakanbak', '', 'Supervisor(Adagom1 settlement)', '2023-09-18 12:58:37'),
(7, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore culpa optio quasi. A natus eaque omnis et ducimus consequuntur optio distinctio sequi nobis dolores saepe voluptatum unde, sint ratione reprehenderit.', 'Lorem Ipsum6508b8571b7f43.20647277.jpg', 'Supervisor(Ukende settlement)', '2023-10-09 23:00:42'),
(8, 'Another Lorem', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore culpa optio quasi. A natus eaque omnis et ducimus consequuntur optio distinctio sequi nobis dolores saepe voluptatum unde, sint ratione reprehenderit.', '', 'Supervisor(Ukende settlement)', '2023-10-09 23:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `crimes`
--

CREATE TABLE `crimes` (
  `crimeId` int(11) NOT NULL,
  `OffendersName` varchar(50) NOT NULL,
  `progressNumber` varchar(50) NOT NULL,
  `age` varchar(11) NOT NULL,
  `offendersImage` varchar(100) DEFAULT NULL,
  `settlement` varchar(50) NOT NULL,
  `houseAddress` varchar(100) NOT NULL,
  `crimeCase` varchar(50) NOT NULL,
  `crimeDescription` varchar(250) NOT NULL,
  `crimeCategory` varchar(50) NOT NULL,
  `crimePlacement` varchar(50) NOT NULL,
  `crimeDate` varchar(20) NOT NULL,
  `reporter` varchar(50) NOT NULL,
  `approvalStatus` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shareStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crimes`
--

INSERT INTO `crimes` (`crimeId`, `OffendersName`, `progressNumber`, `age`, `offendersImage`, `settlement`, `houseAddress`, `crimeCase`, `crimeDescription`, `crimeCategory`, `crimePlacement`, `crimeDate`, `reporter`, `approvalStatus`, `date`, `shareStatus`) VALUES
(7, 'Shalom P Ekung', '720-0045585', '27', '720-00455856501d7806a89d2.38478444.jpg', 'Adagom1 settlement', 'C26-H17', 'Inciting a riot', 'Incited and headed a riot against the SEMA and a lot more ooo..', 'Felony Category', 'Public Order Crime', '2023-09-11', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-10-01 00:21:44', ''),
(11, 'Sedrick Atanga', '720-34533202', '53', '', 'Adagom1 settlement', 'C22-H17', 'Grand theft', 'Blabalabalabalabal for sika say wtin?', 'Felony Category', 'Property Crime', '2023-09-06', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-10-01 00:17:30', ''),
(13, 'Sedrick Atanga Leo', '720-00023787', '26', '720-000237876504286871dba8.96110621.jpg', 'Adagom1 settlement', 'C22-H10', 'Vandalism', 'Another rarararrarrarrarrarraa', 'Misdemeanor Category', 'Misdemeanor Crime', '2023-09-13', 'Supervisor(Adagom1 settlement)', 'Approved', '2023-10-09 21:02:05', ''),
(14, 'Legin Bright Otu', '720-00023211', '43', '', 'Ukende settlement', 'C12-H17', 'Rape', 'lorem ipsum dollar sit ammet renon portos avias canda landa mango tree toton toton.', 'Felony Category', 'Sex Crime', '2023-09-18', 'Supervisor(Ukende settlement)', 'Under investigation', '2023-10-09 23:07:16', ''),
(15, 'Melani Eseka Bate', '720-0000230', '43', '', 'Adagom1 settlement', 'C27-H11', 'Identity theft', 'lorem ipsum dolar for another sit wey dey ammet inside all kind thing them.', 'Felony Category', 'Property Crime', '2023-09-18', 'Supervisor(Ukende settlement)', 'Under investigation', '2023-10-09 23:07:17', ''),
(16, 'Kenny Blaq Achu', '720-00012467', '39', '720-000124676508c6b12a46a9.18129471.jpg', 'Adagom3 settlement', 'C2-H11', 'Petty theft', 'Stole some petit stuffs you know...', 'Misdemeanor Category', 'Misdemeanor Crime', '2023-09-17', 'Supervisor(Ukende settlement)', 'Approved', '2023-10-09 23:07:17', 'Yes'),
(17, 'Joe Pero Mbutu', '720-00032881', '51', '', 'Okende settlement', 'C12-H9', 'Identity theft', 'Blablablablablablablablan\r\nAnother blablablablablanb', 'Felony Category', 'Property Crime', '2023-09-18', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-09-23 10:48:16', 'Yes'),
(19, 'Precious manyo Odaga', '720-00047896', '43', '', 'Adagom3 settlement', 'C12-H9', 'Identity theft', 'Lorem ipsum sita git amet for amet wey no commot road dey tire person.', 'Felony Category', 'Property Crime', '2023-09-18', 'Supervisor(Adagom3 settlement)', 'Approved', '2023-09-25 16:13:27', ''),
(21, 'Bate Encash(aka Vision Bearer)', '720-00049099', '32', '', 'Adagom1 settlement', 'C20-H5', '', 'lalalalalalalalalalalalalalallalalalalala', 'Simple Offense', 'Simple crime', '2023-09-20', 'Supervisor(Ukende settlement)', 'Approved', '2023-10-09 23:07:17', ''),
(39, 'Batibo Mondolo Agi', '720-00019011', '34', '', 'Ukende settlement', 'C12-H9', 'Burglary', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde temporibus dolores accusantium maxime excepturi nam molestiae aliquam laboriosam dicta facilis! Necessitatibus repellendus molestias officiis beatae. Delectus deleniti quia nulla.', 'Felony Category', 'Property Crime', '2023-09-24', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-10-09 23:07:17', 'Yes'),
(55, 'Mechene Isaac Eda', '720-0002345', '37', '720-00023456512d16bd6fd28.97728381.jpg', 'Adagom1 settlement', 'C27-H19', 'Identity theft', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero consequatur quia possimus blanditiis nemo accusantium accusamus vitae, ratione magni sequi. Nostrum quis hic facere nulla? Eveniet, excepturi dolorem! Pariatur, quae.', 'Felony Category', 'Property Crime', '2023-09-25', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-09-26 12:41:15', ''),
(56, 'Mechene Isaac Eda', '720-0002345', '37', '720-00023456512eb90e009b5.21825788.jpg', 'Adagom1 settlement', 'C27-H19', 'Assault', 'Lorem ipsum sita git ammet for another offende after ipsum had ammet.', 'Felony Category', 'Violent Crime', '2023-09-26', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-09-26 14:32:48', ''),
(57, 'Ekung Paul Ekarekup', '720-0004556', '29', '720-0004556651300a0c92071.84645042.jpg', 'Adagom1 settlement', 'C12-H17', 'Robbery', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolorum neque, ea ratione inventore sed?', 'Felony Category', 'Violent Crime', '2023-09-26', 'Supervisor(Adagom1 settlement)', 'Approved', '2023-09-26 16:40:29', ''),
(58, 'Ekung Paul Ekarekup', '720-0004556', '29', '720-00045566513016e88f078.54332579.jpg', '', 'C12-H17', 'Sale', 'Caught selling vade drugs.', 'Felony Category', 'Drug Crime', '2023-09-26', 'Supervisor(Adagom1 settlement)', 'Approved', '2023-10-09 23:07:17', ''),
(60, 'Ekung Paul Ekarekup', '720-0004556', '29', '720-000455665130296110c04.21704821.jpg', 'Adagom1 settlement', 'C12-H17', 'Assault', 'Roses are blue violets are some colors green is not just a color but a dammn color.', 'Felony Category', 'Violent Crime', '2023-09-26', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-09-26 16:11:02', ''),
(61, 'Bate Neville Ojong', '720-443044', '34', '720-443044652e917fd36982.74493494.jpg', 'Adagom1 settlement', 'C22-H7', 'Trespassing', 'De man like for trespass ehhhh...', 'Misdemeanor Category', 'Misdemeanor Crime', '2023-10-17', 'Supervisor(Adagom1 settlement)', 'Under investigation', '2023-10-17 13:51:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `fieldworkernotifications`
--

CREATE TABLE `fieldworkernotifications` (
  `notificationId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `message` varchar(250) NOT NULL,
  `img` varchar(50) NOT NULL,
  `reciever` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fieldworkernotifications`
--

INSERT INTO `fieldworkernotifications` (`notificationId`, `username`, `message`, `img`, `reciever`, `date`) VALUES
(12, 'AD1FIELDWORKER', 'Please we have an urgent case this afternoon from the settlement.', 'AD1FIELDWORKER65365e264d9fc6.64872406.jpg', 'Supervisor(Adagom1 settlement)', '2023-10-23 11:51:02'),
(21, 'AD1FIELDWORKER', 'Lorem ipsum sita git amet lores tas deuw reta', '', 'Supervisor(Adagom1 settlement)', '2023-11-17 11:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `username`, `password`, `image`, `phone`) VALUES
(1, 'PMSEMA', '$2y$10$6Hic/wrM.H2gSOFs7qISC.jY2JpRH0i/EfNeBcYIVQW6Ho12SMrpi', 'PMSEMA652a7564950db2.91455389.jpg', '+2349162757642'),
(4, 'DGSEMA', '$2y$10$53DDjTr18qZK7t7qUl0k3.n8uFfSG//mL178U7lD6CqUPKic/PlGC', 'DGSEMA652ab01778b0f7.37847891.jpg', ''),
(5, 'AD1SEMASUP', '$2y$10$2cO4vfKCYgcYkmPyLzzNouIjXcPpTp51Blhe/dk7OUWfMrIwUgHci', 'AD1SEMASUP652aead3163cc5.68799159.jpg', '+2349067476828'),
(6, 'AD3SEMASUP', '$2y$10$OXUV/WGHoeaVm73WK1lTcu94bF/ul/0WskI9TlbUcVABwjk9yeUmS', 'AD3SEMASUP652aabd68c6092.45733228.jpg', '+2347058954588'),
(7, 'OKSEMASUP', '$2y$10$OoWbULSvgLqj3rho6vc0A.fAspjRR7Enl3AML3Dml/SBlxHCeTvum', 'OKSEMASUP652aab9f771005.16308698.jpg', '+2347058954588');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaintId`);

--
-- Indexes for table `crimes`
--
ALTER TABLE `crimes`
  ADD PRIMARY KEY (`crimeId`);

--
-- Indexes for table `fieldworkernotifications`
--
ALTER TABLE `fieldworkernotifications`
  ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaintId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crimes`
--
ALTER TABLE `crimes`
  MODIFY `crimeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `fieldworkernotifications`
--
ALTER TABLE `fieldworkernotifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2023 at 05:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Deadline` date NOT NULL,
  `State` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `UserID`, `Title`, `Description`, `Deadline`, `State`) VALUES
(1, 1, 'Hotel Brief', 'Making the frontend and backend of this project.', '2023-02-01', 'do'),
(3, 1, 'Fix a button', 'Fix the function of the button with JS.', '2023-01-26', 'do'),
(4, 1, 'Red Thread', 'Work on your final project.', '2023-01-27', 'doing'),
(5, 1, '4th brief', 'Complete the 4th brief.', '2022-12-15', 'done'),
(6, 1, 'Modify the header', 'Modify the header so it can be fixed at the top of the page.', '2023-01-05', 'done'),
(14, 1, 'Test 1', 'Description', '2023-01-27', 'doing'),
(15, 1, 'Task one', 'Description one', '2023-01-25', 'do'),
(16, 1, 'Task two', 'Descr two', '2023-01-26', 'doing'),
(17, 1, 'Task Three', 'Desc Three', '2023-01-27', 'done'),
(18, 1, 'Tilte of the task', 'Descri', '2023-01-26', 'do'),
(20, 1, '', 'fghfhghfhgf', '2023-01-27', 'do');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Username` varchar(16) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Username`, `Email`, `Password`) VALUES
(1, 'El Mahdi', 'mahdi', 'mahdi@gmail.com', '$2y$10$Bul4VHkY9WsEtRcmYzv6MePLNj59zWBshFWkQ3XIlf6cwdbXlzkoy'),
(2, 'Mohammed', 'm7md7', 'mohammed@gmail.com', '$2y$10$ejvjP0V4F7afbei34TDenur/H.bzek1RrBO.TxlCgwUvB8JwZtYqm'),
(3, 'Ahmed', 'Ahmed7', 'ahmed@gmail.com', '$2y$10$MLp//6YYdJpVCj0nzvYG0uFBgG6pwU/Qj2x8FfHorVedjGniEKWSG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

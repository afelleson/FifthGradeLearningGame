-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2024 at 05:52 AM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Game1`
--

-- --------------------------------------------------------

--
-- Table structure for table `AllTimeLeaderboard`
--

CREATE TABLE `AllTimeLeaderboard` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `Avatar` varchar(20) NOT NULL DEFAULT '&#128512;',
  `Score` int(11) NOT NULL DEFAULT 0,
  `FirstTry` tinyint(4) NOT NULL DEFAULT 0,
  `Five` tinyint(4) NOT NULL DEFAULT 0,
  `Ten` tinyint(4) NOT NULL DEFAULT 0,
  `Coins` tinyint(4) NOT NULL DEFAULT 0,
  `Mars` tinyint(4) NOT NULL DEFAULT 0,
  `Jupiter` tinyint(4) NOT NULL DEFAULT 0,
  `Saturn` tinyint(4) NOT NULL DEFAULT 0,
  `Uranus` tinyint(4) NOT NULL DEFAULT 0,
  `Neptune` tinyint(4) NOT NULL DEFAULT 0,
  `Pluto` tinyint(4) NOT NULL DEFAULT 0,
  `Space` tinyint(4) NOT NULL DEFAULT 0,
  `FiveAsteroids` tinyint(4) NOT NULL DEFAULT 0,
  `DayChamp` tinyint(4) NOT NULL DEFAULT 0,
  `WeekChamp` tinyint(4) NOT NULL DEFAULT 0,
  `LongestStreak` tinyint(4) NOT NULL DEFAULT 0,
  `LongestActiveStreak` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AllTimeLeaderboard`
--

INSERT INTO `AllTimeLeaderboard` (`user_id`, `Name`, `Avatar`, `Score`, `FirstTry`, `Five`, `Ten`, `Coins`, `Mars`, `Jupiter`, `Saturn`, `Uranus`, `Neptune`, `Pluto`, `Space`, `FiveAsteroids`, `DayChamp`, `WeekChamp`, `LongestStreak`, `LongestActiveStreak`) VALUES
(1, 'Test User', '&#9989;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'newuser_yay', '&#128512;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DayLeaderboard`
--

CREATE TABLE `DayLeaderboard` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `Avatar` varchar(20) NOT NULL DEFAULT '&#128512;',
  `Score` int(11) NOT NULL DEFAULT 0,
  `FirstTry` tinyint(4) NOT NULL DEFAULT 0,
  `Five` tinyint(4) NOT NULL DEFAULT 0,
  `Ten` tinyint(4) NOT NULL DEFAULT 0,
  `Coins` tinyint(4) NOT NULL DEFAULT 0,
  `Mars` tinyint(4) NOT NULL DEFAULT 0,
  `Jupiter` tinyint(4) NOT NULL DEFAULT 0,
  `Saturn` tinyint(4) NOT NULL DEFAULT 0,
  `Uranus` tinyint(4) NOT NULL DEFAULT 0,
  `Neptune` tinyint(4) NOT NULL DEFAULT 0,
  `Pluto` tinyint(4) NOT NULL DEFAULT 0,
  `Space` tinyint(4) NOT NULL DEFAULT 0,
  `FiveAsteroids` tinyint(4) NOT NULL DEFAULT 0,
  `DayChamp` tinyint(4) NOT NULL DEFAULT 0,
  `WeekChamp` tinyint(4) NOT NULL DEFAULT 0,
  `LongestStreak` tinyint(4) NOT NULL DEFAULT 0,
  `LongestActiveStreak` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DayLeaderboard`
--

INSERT INTO `DayLeaderboard` (`user_id`, `Name`, `Avatar`, `Score`, `FirstTry`, `Five`, `Ten`, `Coins`, `Mars`, `Jupiter`, `Saturn`, `Uranus`, `Neptune`, `Pluto`, `Space`, `FiveAsteroids`, `DayChamp`, `WeekChamp`, `LongestStreak`, `LongestActiveStreak`) VALUES
(1, 'Test User', '&#9989;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'newuser_yay', '&#128512;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Leaderboard`
--

CREATE TABLE `Leaderboard` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `Avatar` varchar(20) NOT NULL DEFAULT '&#128512;',
  `DayScore` int(11) NOT NULL DEFAULT 0,
  `WeekScore` int(11) NOT NULL DEFAULT 0,
  `MonthScore` int(11) NOT NULL DEFAULT 0,
  `AllTimeScore` int(11) NOT NULL DEFAULT 0,
  `FirstTry` tinyint(4) NOT NULL DEFAULT 0,
  `Five` tinyint(4) NOT NULL DEFAULT 0,
  `Ten` tinyint(4) NOT NULL DEFAULT 0,
  `Coins` tinyint(4) NOT NULL DEFAULT 0,
  `Mars` tinyint(4) NOT NULL DEFAULT 0,
  `Jupiter` tinyint(4) NOT NULL DEFAULT 0,
  `Saturn` tinyint(4) NOT NULL DEFAULT 0,
  `Uranus` tinyint(4) NOT NULL DEFAULT 0,
  `Neptune` tinyint(4) NOT NULL DEFAULT 0,
  `Pluto` tinyint(4) NOT NULL DEFAULT 0,
  `Space` tinyint(4) NOT NULL DEFAULT 0,
  `FiveAsteroids` tinyint(4) NOT NULL DEFAULT 0,
  `DayChamp` tinyint(4) NOT NULL DEFAULT 0,
  `WeekChamp` tinyint(4) NOT NULL DEFAULT 0,
  `LongestStreak` tinyint(4) NOT NULL DEFAULT 0,
  `LongestActiveStreak` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Leaderboard`
--

INSERT INTO `Leaderboard` (`user_id`, `Name`, `Avatar`, `DayScore`, `WeekScore`, `MonthScore`, `AllTimeScore`, `FirstTry`, `Five`, `Ten`, `Coins`, `Mars`, `Jupiter`, `Saturn`, `Uranus`, `Neptune`, `Pluto`, `Space`, `FiveAsteroids`, `DayChamp`, `WeekChamp`, `LongestStreak`, `LongestActiveStreak`) VALUES
(1, 'Test User', '&#9989;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'newuser_yay', '&#128512;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `LoginCreds`
--

CREATE TABLE `LoginCreds` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LoginCreds`
--

INSERT INTO `LoginCreds` (`user_id`, `username`, `password`) VALUES
(1, 'testuser', '123456'),
(4, 'newuser_yay', '123456');

--
-- Triggers `LoginCreds`
--
DELIMITER $$
CREATE TRIGGER `after_logincreds_insert` AFTER INSERT ON `LoginCreds` FOR EACH ROW BEGIN
    INSERT INTO Leaderboard (user_id, Name)
    VALUES (NEW.user_id, NEW.username);
    
    INSERT INTO WeekLeaderboard (user_id, Name)
    VALUES (NEW.user_id, NEW.username);
    
    INSERT INTO MonthLeaderboard (user_id, Name)
    VALUES (NEW.user_id, NEW.username);
    
    INSERT INTO AllTimeLeaderboard (user_id, Name)
    VALUES (NEW.user_id, NEW.username);
    
    INSERT INTO DayLeaderboard (user_id, Name)
    VALUES (NEW.user_id, NEW.username);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_logincreds_user_deleted` AFTER DELETE ON `LoginCreds` FOR EACH ROW BEGIN
    DELETE FROM Leaderboard WHERE user_id = OLD.user_id;
    DELETE FROM WeekLeaderboard WHERE user_id = OLD.user_id;
    DELETE FROM MonthLeaderboard WHERE user_id = OLD.user_id;
    DELETE FROM AllTimeLeaderboard WHERE user_id = OLD.user_id;
    DELETE FROM DayLeaderboard WHERE user_id = OLD.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `MonthLeaderboard`
--

CREATE TABLE `MonthLeaderboard` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `Avatar` varchar(20) NOT NULL DEFAULT '&#128512;',
  `Score` int(11) NOT NULL DEFAULT 0,
  `FirstTry` tinyint(4) NOT NULL DEFAULT 0,
  `Five` tinyint(4) NOT NULL DEFAULT 0,
  `Ten` tinyint(4) NOT NULL DEFAULT 0,
  `Coins` tinyint(4) NOT NULL DEFAULT 0,
  `Mars` tinyint(4) NOT NULL DEFAULT 0,
  `Jupiter` tinyint(4) NOT NULL DEFAULT 0,
  `Saturn` tinyint(4) NOT NULL DEFAULT 0,
  `Uranus` tinyint(4) NOT NULL DEFAULT 0,
  `Neptune` tinyint(4) NOT NULL DEFAULT 0,
  `Pluto` tinyint(4) NOT NULL DEFAULT 0,
  `Space` tinyint(4) NOT NULL DEFAULT 0,
  `FiveAsteroids` tinyint(4) NOT NULL DEFAULT 0,
  `DayChamp` tinyint(4) NOT NULL DEFAULT 0,
  `WeekChamp` tinyint(4) NOT NULL DEFAULT 0,
  `LongestStreak` tinyint(4) NOT NULL DEFAULT 0,
  `LongestActiveStreak` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MonthLeaderboard`
--

INSERT INTO `MonthLeaderboard` (`user_id`, `Name`, `Avatar`, `Score`, `FirstTry`, `Five`, `Ten`, `Coins`, `Mars`, `Jupiter`, `Saturn`, `Uranus`, `Neptune`, `Pluto`, `Space`, `FiveAsteroids`, `DayChamp`, `WeekChamp`, `LongestStreak`, `LongestActiveStreak`) VALUES
(1, 'Test User', '&#9989;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'newuser_yay', '&#128512;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `WeekLeaderboard`
--

CREATE TABLE `WeekLeaderboard` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `Avatar` varchar(20) NOT NULL DEFAULT '&#128512;',
  `Score` int(11) NOT NULL DEFAULT 0,
  `FirstTry` tinyint(4) NOT NULL DEFAULT 0,
  `Five` tinyint(4) NOT NULL DEFAULT 0,
  `Ten` tinyint(4) NOT NULL DEFAULT 0,
  `Coins` tinyint(4) NOT NULL DEFAULT 0,
  `Mars` tinyint(4) NOT NULL DEFAULT 0,
  `Jupiter` tinyint(4) NOT NULL DEFAULT 0,
  `Saturn` tinyint(4) NOT NULL DEFAULT 0,
  `Uranus` tinyint(4) NOT NULL DEFAULT 0,
  `Neptune` tinyint(4) NOT NULL DEFAULT 0,
  `Pluto` tinyint(4) NOT NULL DEFAULT 0,
  `Space` tinyint(4) NOT NULL DEFAULT 0,
  `FiveAsteroids` tinyint(4) NOT NULL DEFAULT 0,
  `DayChamp` tinyint(4) NOT NULL DEFAULT 0,
  `WeekChamp` tinyint(4) NOT NULL DEFAULT 0,
  `LongestStreak` tinyint(4) NOT NULL DEFAULT 0,
  `LongestActiveStreak` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `WeekLeaderboard`
--

INSERT INTO `WeekLeaderboard` (`user_id`, `Name`, `Avatar`, `Score`, `FirstTry`, `Five`, `Ten`, `Coins`, `Mars`, `Jupiter`, `Saturn`, `Uranus`, `Neptune`, `Pluto`, `Space`, `FiveAsteroids`, `DayChamp`, `WeekChamp`, `LongestStreak`, `LongestActiveStreak`) VALUES
(1, 'Test User', '&#9989;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'newuser_yay', '&#128512;', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AllTimeLeaderboard`
--
ALTER TABLE `AllTimeLeaderboard`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `DayLeaderboard`
--
ALTER TABLE `DayLeaderboard`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Leaderboard`
--
ALTER TABLE `Leaderboard`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `LoginCreds`
--
ALTER TABLE `LoginCreds`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `MonthLeaderboard`
--
ALTER TABLE `MonthLeaderboard`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `WeekLeaderboard`
--
ALTER TABLE `WeekLeaderboard`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AllTimeLeaderboard`
--
ALTER TABLE `AllTimeLeaderboard`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `DayLeaderboard`
--
ALTER TABLE `DayLeaderboard`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Leaderboard`
--
ALTER TABLE `Leaderboard`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `LoginCreds`
--
ALTER TABLE `LoginCreds`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `MonthLeaderboard`
--
ALTER TABLE `MonthLeaderboard`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `WeekLeaderboard`
--
ALTER TABLE `WeekLeaderboard`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `ClearMonthScore` ON SCHEDULE EVERY 1 MONTH STARTS '2024-02-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE Leaderboard SET MonthScore = 0;
    UPDATE MonthLeaderboard SET Score = 0;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `ClearWeekScore` ON SCHEDULE EVERY 1 WEEK STARTS '2024-01-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN 
    UPDATE Leaderboard SET WeekScore = 0;
    UPDATE WeekLeaderboard SET Score = 0;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `ClearDayScore` ON SCHEDULE EVERY 1 DAY STARTS '2024-01-25 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE Leaderboard SET DayScore = 0;
    UPDATE DayLeaderboard SET Score = 0;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

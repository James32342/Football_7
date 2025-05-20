-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 10:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `name` varchar(255) NOT NULL,
  `pos` int(5) NOT NULL,
  `rec` varchar(15) NOT NULL,
  `stad` text NOT NULL,
  `sqsize` int(5) NOT NULL,
  `manager` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `round` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`name`, `pos`, `rec`, `stad`, `sqsize`, `manager`, `logo`, `round`, `id`) VALUES
('AC Milan', 6, '21-8-7', 'San Siro', 29, 'Sergio Conceicao', 'acmilan.jpeg', 'Quarter-Finals', 21),
('AS Roma', 4, '22-7-6', 'Stadio Olimpico', 30, 'Daniele De Rossi', 'roma.jpg', 'Round of 16', 26),
('Bayern Munich', 1, '26-4-4', 'Allianz Arena', 30, 'Vincent Company', 'bayern.jpeg', 'Semi-Finals', 58),
('FC Barcelona', 1, '25-1-3', 'Camp Nou', 32, 'Hansi Flick', 'barca.jpg', 'Semi-Finals', 19),
('Inter Milan', 1, '29-4-3', 'San Siro', 32, 'Simeone Inzaghi', 'intermilan.jpg', 'Semi-Finals', 24),
('Juventus', 3, '28-4-0', 'Allianz Stadium', 26, 'Thiago Motta', 'juve,jpeg', 'Quarter-Finals', 31),
('PSG', 1, '30-2-2', 'Parc des Princes', 32, 'Luis Enrique', 'psg.jpg', 'Finals', 17);

--
-- Triggers `club`
--
DELIMITER $$
CREATE TRIGGER `before_club_delete` BEFORE DELETE ON `club` FOR EACH ROW BEGIN
    -- Insert a new record into the deletion_log table
    INSERT INTO deletion_log (table_name, deleted_record_id, deleted_data, deleted_by, deleted_at)
    VALUES ('clubs', OLD.id, 
            JSON_OBJECT(
                'id', OLD.id,
                'name', OLD.name,
                'pos', OLD.pos,
                'rec', OLD.rec,
                'round', OLD.round,
                'stad', OLD.stad,
                'sqsize', OLD.sqsize,
                'manager', OLD.manager,
                'logo', OLD.logo
            ),
            USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_sqsize_before_insert` BEFORE INSERT ON `club` FOR EACH ROW BEGIN
    IF NEW.sqsize < 24 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Squad size must be at least 24 for insertion.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_sqsize_before_update` BEFORE UPDATE ON `club` FOR EACH ROW BEGIN
    IF NEW.sqsize < 24 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Squad size must be at least 24 for update.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_club_insert_check` BEFORE INSERT ON `club` FOR EACH ROW BEGIN
    IF NEW.sqsize < 24 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Squad size must be at least 24 to insert';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_club_update_check` BEFORE UPDATE ON `club` FOR EACH ROW BEGIN
    IF NEW.sqsize < 24 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Squad size must be at least 24 to update';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `deletion_log`
--

CREATE TABLE `deletion_log` (
  `id` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `deleted_record_id` varchar(100) NOT NULL,
  `deleted_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deleted_data`)),
  `deleted_by` varchar(100) DEFAULT NULL,
  `deleted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deletion_log`
--

INSERT INTO `deletion_log` (`id`, `table_name`, `deleted_record_id`, `deleted_data`, `deleted_by`, `deleted_at`) VALUES
(1, 'trophy', '8', '{\"id\": 8, \"name\": \"FA Cup\", \"type\": \"Domestic Cup\", \"association\": \"PFA\", \"currentholders\": \"Newcastle United\", \"venue\": \"St James Park\"}', 'root@localhost', '2025-05-15 11:02:00'),
(2, 'clubs', '71', '{\"id\": 71, \"name\": \"Real Madrid\", \"pos\": 1, \"rec\": \"22-4-4\", \"round\": \"Finals\", \"stad\": \"Santiago Bernabeu\", \"sqsize\": 26, \"manager\": \"Carlo Ancellotti\", \"logo\": \"real.jpg\"}', 'root@localhost', '2025-05-15 11:16:52'),
(3, 'players', '15', '{\"id\": 15, \"name\": \"Mykhailo Mudryk\", \"age\": 23, \"position\": \"Left winger\", \"club\": \"Chelsea\", \"nationality\": \"Ukraine\", \"transfervalue\": \"100 million $\"}', 'root@localhost', '2025-05-15 11:19:12'),
(4, 'transfers', '2', '{\"id\": 2, \"name\": \"Paulo Dybala\", \"age\": 26, \"position\": \"Attacking Midfielder\", \"clubfrom\": \"AC Milan\", \"clubto\": \"AS Roma\", \"wage\": \"100,000 $/week\", \"transferfee\": \"32 million $\"}', 'root@localhost', '2025-05-15 11:20:47'),
(8, 'transfers', '1', '{\"id\": 1, \"name\": \"Eden Hazard\", \"age\": 28, \"position\": \"Attacking Midfielder\", \"clubfrom\": \"Lille FC\", \"clubto\": \"Chelsea FC\", \"wage\": \"180,000 $/week\", \"transferfee\": \"80 M $\"}', 'root@localhost', '2025-05-15 11:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` int(30) NOT NULL,
  `transfervalue` varchar(60) NOT NULL,
  `club` varchar(40) NOT NULL,
  `position` varchar(20) NOT NULL,
  `nationality` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `age`, `transfervalue`, `club`, `position`, `nationality`) VALUES
(9, 'Lionel Messi', 39, '25 million $', 'Inter Miami', 'RW', 'Argentinian'),
(14, 'Antoinne Griezmann', 32, '40 million $', 'Atletico Madrid', 'Second Striker', 'France');

--
-- Triggers `players`
--
DELIMITER $$
CREATE TRIGGER `before_player_delete` BEFORE DELETE ON `players` FOR EACH ROW BEGIN
    -- Insert a new record into the deletion_log table
    INSERT INTO deletion_log (table_name, deleted_record_id, deleted_data, deleted_by, deleted_at)
    VALUES ('players', OLD.id, 
            JSON_OBJECT(
                'id', OLD.id,
                'name', OLD.name,
                'age', OLD.age,
                'position', OLD.position,
                'club', OLD.club,
                'nationality', OLD.nationality,
                'transfervalue', OLD.transfervalue
            ),
            USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_player_age_before_insert` BEFORE INSERT ON `players` FOR EACH ROW BEGIN
    IF NEW.age < 16 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Player age must be at least 16 to be added.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_player_age_before_update` BEFORE UPDATE ON `players` FOR EACH ROW BEGIN
    IF NEW.age < 16 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Player age must be at least 16 to update.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `matches` int(50) NOT NULL,
  `goals` int(50) NOT NULL,
  `assists` int(30) NOT NULL,
  `clubs` int(30) NOT NULL,
  `trophieswon` int(20) NOT NULL,
  `redcard` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `name`, `matches`, `goals`, `assists`, `clubs`, `trophieswon`, `redcard`) VALUES
(1, 'Cristiano Ronaldo', 1180, 933, 285, 4, 31, 12),
(3, 'Lionel Messi', 800, 700, 324, 3, 43, 2),
(4, 'Eden Hazard', 705, 423, 287, 3, 13, 3);

--
-- Triggers `statistics`
--
DELIMITER $$
CREATE TRIGGER `before_player_stats_delete` BEFORE DELETE ON `statistics` FOR EACH ROW BEGIN
    INSERT INTO deleted_player_stats (player_id, player_name, matches, goals, assists, clubs, trophieswon, redcard)
    VALUES (OLD.id, OLD.name, OLD.matches, OLD.goals, OLD.assists, OLD.clubs, OLD.trophieswon, OLD.redcard);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `position` varchar(30) NOT NULL,
  `clubfrom` varchar(30) NOT NULL,
  `clubto` varchar(30) NOT NULL,
  `transferfee` varchar(255) NOT NULL,
  `wage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `name`, `age`, `position`, `clubfrom`, `clubto`, `transferfee`, `wage`) VALUES
(5, 'Lionel Messi', 32, 'Right Winger', 'FC Barcelona', 'PSG', '80 M $', '300,000 $/week');

--
-- Triggers `transfers`
--
DELIMITER $$
CREATE TRIGGER `before_transfer_delete` BEFORE DELETE ON `transfers` FOR EACH ROW BEGIN
    -- Insert a new record into the deletion_log table
    INSERT INTO deletion_log (table_name, deleted_record_id, deleted_data, deleted_by, deleted_at)
    VALUES ('transfers', OLD.id, 
            JSON_OBJECT(
                'id', OLD.id,
                'name', OLD.name,
                'age', OLD.age,
                'position', OLD.position,
                'clubfrom', OLD.clubfrom,
                'clubto', OLD.clubto,
                'wage', OLD.wage,
                'transferfee', OLD.transferfee
            ),
            USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prevent_low_wage_transfer` BEFORE INSERT ON `transfers` FOR EACH ROW BEGIN
    -- Remove commas and dollar sign, then convert to numeric value
    DECLARE cleaned_wage INT;
    SET cleaned_wage = CAST(REPLACE(REPLACE(NEW.wage, ',', ''), '$', '') AS UNSIGNED);

    -- Check if the wage exceeds 100K, and block if it's less
    IF cleaned_wage < 100000 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Wage must be at least 100K!';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prevent_low_wage_update` BEFORE UPDATE ON `transfers` FOR EACH ROW BEGIN
    -- Remove commas and dollar sign, then convert to numeric value
    DECLARE cleaned_wage INT;
    SET cleaned_wage = CAST(REPLACE(REPLACE(NEW.wage, ',', ''), '$', '') AS UNSIGNED);

    -- Check if the wage exceeds 100K, and block if it's less
    IF cleaned_wage < 100000 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Wage must be at least 100K!';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trophy`
--

CREATE TABLE `trophy` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `association` varchar(30) NOT NULL,
  `currentholders` varchar(30) NOT NULL,
  `venue` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trophy`
--

INSERT INTO `trophy` (`id`, `name`, `type`, `association`, `currentholders`, `venue`) VALUES
(1, 'UCL', 'Continental Cup', 'UEFA', 'Real Madrid', 'London'),
(2, 'EPL', 'League', 'PFA', 'Liverpool', 'Anfield'),
(4, 'Serie A', 'League', 'FIGC', 'Inter Milan', 'San Siro'),
(6, 'Laliga', 'League', 'RFEF', 'FC Barcelona', 'Camp Nou');

--
-- Triggers `trophy`
--
DELIMITER $$
CREATE TRIGGER `before_trophy_delete` BEFORE DELETE ON `trophy` FOR EACH ROW BEGIN
    INSERT INTO deletion_log (
        table_name,
        deleted_record_id,
        deleted_data,
        deleted_by,
        deleted_at
    ) VALUES (
        'trophy',
        OLD.id,
        JSON_OBJECT(
            'id', OLD.id,
            'name', OLD.name,
            'type', OLD.type,
            'association', OLD.association,
            'currentholders', OLD.currentholders,
            'venue', OLD.venue
        ),
        CURRENT_USER(),
        NOW()
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validate_trophy_type_insert` BEFORE INSERT ON `trophy` FOR EACH ROW BEGIN
    IF NOT NEW.type IN ('Domestic Cup', 'Continental Cup', 'League') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid trophy type. Must be Domestic, Continental, Cup, or League.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validate_trophy_type_update` BEFORE UPDATE ON `trophy` FOR EACH ROW BEGIN
    IF NOT NEW.type IN ('Domestic Cup', 'Continental Cup', 'League') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid trophy type. Must be Domestic Cup, Continental Cup or League.';
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `deletion_log`
--
ALTER TABLE `deletion_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trophy`
--
ALTER TABLE `trophy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `deletion_log`
--
ALTER TABLE `deletion_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trophy`
--
ALTER TABLE `trophy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

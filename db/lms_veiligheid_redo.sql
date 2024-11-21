-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 12:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_veiligheid_redo`
--

-- --------------------------------------------------------

---- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 12:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: lms_veiligheid_redo
--

-- --------------------------------------------------------

--
-- Table structure for table faq
--

DROP DATABASE IF EXISTS lms_veiligheid_redo;
CREATE DATABASE lms_veiligheid_redo;
USE lms_veiligheid_redo;

CREATE TABLE faq (
  id int(8) NOT NULL,
  question varchar(512) NOT NULL,
  answer varchar(512) NOT NULL,
  photo varchar(255) NOT NULL,
  date_created datetime(6) NOT NULL,
  last_updated datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table faq
--

INSERT INTO faq (id, question, answer, photo, date_created, last_updated) VALUES
(1, 'Wat is de website van MBORijnland?', 'De MBORijnland website is https://mborijnland.nl/', '', '2024-11-20 19:03:50.000000', '2024-11-20 19:03:50.000000'),
(2, 'Hoe maak ik een incident aan?', 'Ga naar meldingen -> nieuw incident', '', '2024-11-20 19:03:50.000000', '2024-11-20 19:03:50.000000');

-- --------------------------------------------------------

--
-- Table structure for table incidents
--

CREATE TABLE incidents (
  id int(16) NOT NULL,
  user_id int(16) NOT NULL,
  title varchar(128) NOT NULL,
  description varchar(1024) NOT NULL,
  priority int(1) NOT NULL,
  category int(1) NOT NULL,
  create_date datetime(6) NOT NULL,
  last_updated datetime(6) NOT NULL,
  status int(1) NOT NULL,
  tower varchar(1) NOT NULL,
  floor int(2) NOT NULL,
  class_area varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table incidents
--

INSERT INTO incidents (id, user_id, title, description, priority, category, create_date, last_updated, status, tower, floor, class_area) VALUES
(1, 3, 'Netwerk problee', 'Er is geen wifi verbinding op de 3e verdieping', 2, 3, '2024-11-20 18:11:05.000000', '2024-11-20 18:11:05.000000', 1, 'A', 3, ''),
(2, 3, 'Stoel kapot 3e', 'Er is een stoel kapot in de gang op de 3e', 5, 2, '2024-11-20 18:11:05.000000', '2024-11-20 18:11:05.000000', 1, 'B', 3, ''),
(3, 4, 'Projector kapot', 'De projector in lokaal A925 werkt niet', 2, 3, '2024-11-20 18:11:05.000000', '2024-11-20 18:11:05.000000', 1, 'A', 9, '25');

-- --------------------------------------------------------

--
-- Table structure for table incident_replies
--

CREATE TABLE incident_replies (
  id int(16) NOT NULL,
  incident_id int(16) NOT NULL,
  user_id int(16) NOT NULL,
  message varchar(1024) NOT NULL,
  photo varchar(255) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table incident_replies
--

INSERT INTO incident_replies (id, incident_id, user_id, message, photo, create_date) VALUES
(1, 1, 1, 'Zie je het wifi netwerk wel in de lijst staan op je telefoon?', '', '0000-00-00 00:00:00.000000'),
(2, 1, 3, 'Ja, hij staat er wel bij', '', '0000-00-00 00:00:00.000000'),
(3, 3, 4, 'Laat maar, ik heb hem uit en aan gezet en hij werkt weer', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table news
--

CREATE TABLE news (
  id int(10) NOT NULL,
  photo varchar(255) DEFAULT NULL,
  title varchar(128) DEFAULT NULL,
  text varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table news
--

INSERT INTO news (id, photo, title, text) VALUES
(1, 'news1.jpg', 'New Office Opening', 'We are excited to announce the opening of our new office.'),
(2, 'news2.jpg', 'Annual Company Picnic', 'Join us for the annual company picnic this weekend.');

-- --------------------------------------------------------

--
-- Table structure for table rights
--

CREATE TABLE rights (
  id int(8) NOT NULL,
  name varchar(16) NOT NULL,
  description varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table rights
--

INSERT INTO rights (id, name, description) VALUES
(1, 'edit_users', 'Kan nieuwe gebruikers aanmaken, verwijderen en aanpassen'),
(2, 'manage_incident', 'Kan meldingen archiveren, aanpassen en sluiten'),
(3, 'view_incidents', 'Kan alle incidenten bekijken');

-- --------------------------------------------------------

--
-- Table structure for table roles
--

CREATE TABLE roles (
  id int(4) NOT NULL,
  name varchar(16) NOT NULL,
  description varchar(512) NOT NULL,
  parent_role_id int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table roles
--

INSERT INTO roles (id, name, description, parent_role_id) VALUES
(1, 'Admin', '', 0),
(2, 'Manager', '', 1),
(3, 'User', '', 2),
(4, 'viewer', 'Niet ingelogt', 3);

-- --------------------------------------------------------

--
-- Table structure for table roles_rights
--

CREATE TABLE roles_rights (
  role_id int(4) NOT NULL,
  right_id int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table roles_rights
--

INSERT INTO roles_rights (role_id, right_id) VALUES
(3, 3),
(2, 2),
(1, 1),
(4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id int(16) NOT NULL,
  e_mail varchar(64) NOT NULL,
  password varchar(512) NOT NULL,
  first_name varchar(64) NOT NULL,
  particle varchar(8) NOT NULL,
  last_name varchar(64) NOT NULL,
  phone varchar(16) NOT NULL,
  photo varchar(255) NOT NULL,
  role_id int(4) NOT NULL,
  create_date datetime DEFAULT NULL,
  last_login datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table users
--

INSERT INTO users (id, e_mail, password, first_name, particle, last_name, phone, photo, role_id, create_date, last_login) VALUES
(1, 'admin@example.com', 'password123', 'John', '', 'Pork', '1234567890', 'john.jpg', 1, NULL, NULL),
(2, 'manager@example.com', 'password123', 'Alex', '', 'Johnson', '1234567890', 'alex.jpg', 2, NULL, NULL),
(3, 'user1@example.com', 'password456', 'Jane', 'van', 'Smith', '2147483627', 'jane.jpg', 3, NULL, NULL),
(4, 'user2@example.com', 'password123', 'john', '', 'doe', '1273819381', 'johndoe.png', 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table faq
--
ALTER TABLE faq
  ADD PRIMARY KEY (id);

--
-- Indexes for table incidents
--
ALTER TABLE incidents
  ADD PRIMARY KEY (id),
  ADD KEY userIDD (user_id);

--
-- Indexes for table incident_replies
--
ALTER TABLE incident_replies
  ADD PRIMARY KEY (id),
  ADD KEY incidentID (incident_id),
  ADD KEY userID (user_id);

--
-- Indexes for table news
--
ALTER TABLE news
  ADD PRIMARY KEY (id);

--
-- Indexes for table rights
--
ALTER TABLE rights
  ADD PRIMARY KEY (id);

--
-- Indexes for table roles
--
ALTER TABLE roles
  ADD PRIMARY KEY (id);

--
-- Indexes for table roles_rights
--
ALTER TABLE roles_rights
  ADD KEY rightID (right_id),
  ADD KEY roleIDD (role_id);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD KEY roleID (role_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table faq
--
ALTER TABLE faq
  MODIFY id int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table incidents
--
ALTER TABLE incidents
  MODIFY id int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table incident_replies
--
ALTER TABLE incident_replies
  MODIFY id int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table rights
--
ALTER TABLE rights
  MODIFY id int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table roles
--
ALTER TABLE roles
  MODIFY id int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table incidents
--
ALTER TABLE incidents
  ADD CONSTRAINT userIDD FOREIGN KEY (user_id) REFERENCES users (id);

--
-- Constraints for table incident_replies
--
ALTER TABLE incident_replies
  ADD CONSTRAINT incidentID FOREIGN KEY (incident_id) REFERENCES incidents (id),
  ADD CONSTRAINT userID FOREIGN KEY (user_id) REFERENCES users (id);

--
-- Constraints for table roles_rights
--
ALTER TABLE roles_rights
  ADD CONSTRAINT rightID FOREIGN KEY (right_id) REFERENCES rights (id),
  ADD CONSTRAINT roleIDD FOREIGN KEY (role_id) REFERENCES roles (id);

--
-- Constraints for table users
--
ALTER TABLE users
  ADD CONSTRAINT roleID FOREIGN KEY (role_id) REFERENCES roles (id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
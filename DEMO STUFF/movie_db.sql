-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 12:37 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `complex`
--

CREATE TABLE `complex` (
  `complexID` int(11) NOT NULL,
  `numTheatres` int(11) DEFAULT NULL,
  `complexName` varchar(50) DEFAULT NULL,
  `streetNum` int(11) DEFAULT NULL,
  `streetName` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postalCode` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complex`
--

INSERT INTO `complex` (`complexID`, `numTheatres`, `complexName`, `streetNum`, `streetName`, `city`, `province`, `postalCode`) VALUES
(1, 20, 'SilverCity Oakville & VIP Cinemas', 3531, 'Wyecroft Rd', 'Oakville', 'Ontario', 'L6L 0B7'),
(2, 15, 'Cineplex Odeon Gardiners Road Cinemas', 626, 'Gardiners Rd', 'Kingston', 'Ontario', 'K7M 3X9'),
(3, 8, 'Cineplex Odeon Sainte-Foy Cinemas', 1200, 'Duplessis Hwy', 'Qucbec City', 'Qucbec', 'G2G 2B5');

-- --------------------------------------------------------

--
-- Table structure for table `complexphonenum`
--

CREATE TABLE `complexphonenum` (
  `complexID` int(11) NOT NULL,
  `phoneNum` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complexphonenum`
--

INSERT INTO `complexphonenum` (`complexID`, `phoneNum`) VALUES
(1, '9058085555'),
(2, '4162325555'),
(3, '6062315555');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieID` int(11) NOT NULL,
  `movieTitle` varchar(50) NOT NULL,
  `runningTime` int(11) DEFAULT NULL,
  `rating` varchar(2) DEFAULT NULL,
  `plot` varchar(600) DEFAULT NULL,
  `actors` varchar(50) DEFAULT NULL,
  `director` varchar(50) DEFAULT NULL,
  `productionCompany` varchar(50) DEFAULT NULL,
  `supplierID` int(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieID`, `movieTitle`, `runningTime`, `rating`, `plot`, `actors`, `director`, `productionCompany`, `supplierID`, `startDate`, `endDate`) VALUES
(1, 'Peter Rabbit', 93, 'PG', 'Peter Rabbit and his three sisters -- Flopsy, Mopsy and Cotton-Tail -- enjoy spending their days in Mr. McGregor\'s vegetable garden. When one of McGregor\'s relatives suddenly moves in, he\'s less than thrilled to discover a family of rabbits in his new home. A battle of wills soon breaks out as the new owner hatches scheme after scheme to get rid of Peter -- a resourceful rabbit who proves to be a worthy and wily opponent.', 'Rose Byrne', 'Will Gluck, Domhnall Gleeson', 'Columbia Pictures', 3, '2018-02-09', '2018-05-30'),
(2, 'Game Night', 100, 'R', 'Max and Annie\'s weekly game night gets kicked up a notch when Max\'s brother Brooks arranges a murder mystery party -- complete with fake thugs and federal agents. So when Brooks gets kidnapped, it\'s all supposed to be part of the game. As the competitors set out to solve the case, they start to learn that neither the game nor Brooks are what they seem to be. The friends soon find themselves in over their heads as each twist leads to another unexpected turn over the course of one chaotic night.', 'Jason Bateman, Rachel McAdams', 'John Francis Daley, Jonathan M. Goldstein', 'New Line Cinema', 2, '2018-02-23', '2018-04-20'),
(3, 'The Avengers', 143, 'PG', 'When Thor\'s evil brother, Loki (Tom Hiddleston), gains access to the unlimited power of the energy cube called the Tesseract, Nick Fury (Samuel L. Jackson), director of S.H.I.E.L.D., initiates a superhero recruitment effort to defeat the unprecedented threat to Earth. Joining Fury\'s \"dream team\" are Iron Man (Robert Downey Jr.), Captain America (Chris Evans), the Hulk (Mark Ruffalo), Thor (Chris Hemsworth), the Black Widow (Scarlett Johansson) and Hawkeye (Jeremy Renner).', 'Robert Downey Jr., Chris Evans', 'Joss Whedon', 'Marvel Studios', 1, '2018-01-14', '2018-04-08'),
(4, 'Black Panther', 134, 'PG', 'After the death of his father, T\'Challa returns home to the African nation of Wakanda to take his rightful place as king. When a powerful enemy suddenly reappears, T\'Challa\'s mettle as king -- and as Black Panther -- gets tested when he\'s drawn into a conflict that puts the fate of Wakanda and the entire world at risk. Faced with treachery and danger, the young king must rally his allies and release the full power of Black Panther to defeat his foes and secure the safety of his people.', 'Chadwick Boseman, Michael B. Jordan', 'Ryan Coogler', 'Marvel Studios', 1, '2018-02-16', '2018-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `movieID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `reviewText` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`movieID`, `accountID`, `reviewText`) VALUES
(1, 1, 'The kids loved it!'),
(2, 1, '6/10, wasn\'t the best.'),
(3, 1, 'This is a must see!'),
(4, 2, 'Great movie! I would rate it 10/10!');

-- --------------------------------------------------------

--
-- Table structure for table `showing`
--

CREATE TABLE `showing` (
  `showingID` int(11) NOT NULL,
  `theatreID` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `avalSeats` int(11) DEFAULT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showing`
--

INSERT INTO `showing` (`showingID`, `theatreID`, `startTime`, `avalSeats`, `movieID`) VALUES
(1, 1, '2018-04-04 09:00:00', NULL, 4),
(2, 2, '2018-04-04 09:30:00', NULL, 3),
(3, 7, '2018-04-04 12:00:00', NULL, 4),
(4, 18, '2018-03-30 17:00:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(50) DEFAULT NULL,
  `streetNum` int(11) DEFAULT NULL,
  `streetName` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postalCode` char(7) NOT NULL,
  `contactName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `streetNum`, `streetName`, `city`, `province`, `postalCode`, `contactName`) VALUES
(1, 'Walt Disney Studios Motion Pictures', 555, 'Movie Lane', 'Somewhereville', 'Ontario', 'A2C 4E6', 'John Doe'),
(2, 'Warner Bros. Pictures', 123, 'Warner Drive', 'Toronto', 'Ontario', 'A8F 8A2', 'Tim Smith'),
(3, 'Sony Pictures Releasing', 822, 'Scotts Lane', 'Tofino', 'British Columbia', 'V0R 2Z0', 'Joe Guy');

-- --------------------------------------------------------

--
-- Table structure for table `supplierphonenum`
--

CREATE TABLE `supplierphonenum` (
  `supplierID` int(11) NOT NULL,
  `phoneNum` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplierphonenum`
--

INSERT INTO `supplierphonenum` (`supplierID`, `phoneNum`) VALUES
(1, '5555555555'),
(2, '6666666666'),
(3, '1111111111');

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE `theatre` (
  `theatreID` int(11) NOT NULL,
  `theatreNum` int(11) NOT NULL,
  `complexID` int(11) NOT NULL,
  `numSeats` int(11) NOT NULL,
  `screenSize` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`theatreID`, `theatreNum`, `complexID`, `numSeats`, `screenSize`) VALUES
(0, 1, 1, 150, 'S'),
(24, 1, 2, 150, 'S'),
(35, 1, 3, 150, 'S'),
(13, 2, 1, 150, 'S'),
(26, 2, 2, 150, 'S'),
(38, 2, 3, 150, 'S'),
(16, 3, 1, 150, 'S'),
(27, 3, 2, 150, 'S'),
(36, 3, 3, 150, 'S'),
(10, 4, 1, 150, 'S'),
(32, 4, 2, 150, 'S'),
(40, 4, 3, 150, 'S'),
(2, 5, 1, 220, 'M'),
(22, 5, 2, 220, 'M'),
(42, 5, 3, 220, 'M'),
(4, 6, 1, 220, 'M'),
(30, 6, 2, 220, 'M'),
(41, 6, 3, 220, 'M'),
(7, 7, 1, 220, 'M'),
(33, 7, 2, 220, 'M'),
(39, 7, 3, 300, 'L'),
(19, 8, 1, 220, 'M'),
(20, 8, 2, 220, 'M'),
(37, 8, 3, 300, 'L'),
(11, 9, 1, 220, 'M'),
(31, 9, 2, 220, 'M'),
(12, 10, 1, 220, 'M'),
(29, 10, 2, 220, 'M'),
(6, 11, 1, 220, 'M'),
(21, 11, 2, 220, 'M'),
(15, 12, 1, 220, 'M'),
(23, 12, 2, 220, 'M'),
(1, 13, 1, 220, 'M'),
(28, 13, 2, 220, 'M'),
(3, 14, 1, 220, 'M'),
(34, 14, 2, 220, 'M'),
(5, 15, 1, 220, 'M'),
(25, 15, 2, 300, 'L'),
(14, 16, 1, 300, 'L'),
(17, 17, 1, 300, 'L'),
(9, 18, 1, 300, 'L'),
(8, 19, 1, 300, 'L'),
(18, 20, 1, 300, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `seatNum` int(11) DEFAULT NULL,
  `showingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketID`, `accountID`, `seatNum`, `showingID`) VALUES
(0, 888, NULL, 1),
(9, 1, 0, 3),
(10, 1, 0, 4),
(11, 1, 0, 2),
(12, 1, 0, 2),
(13, 1, 0, 2),
(14, 1, 0, 2),
(15, 1, 0, 3),
(16, 1, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `userphonenum`
--

CREATE TABLE `userphonenum` (
  `accountID` int(11) NOT NULL,
  `phoneNum` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userphonenum`
--

INSERT INTO `userphonenum` (`accountID`, `phoneNum`) VALUES
(1, '5225925555'),
(2, '9051235500');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `accountID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `streetNum` int(11) DEFAULT NULL,
  `streetName` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postalCode` char(7) NOT NULL,
  `email` varchar(50) NOT NULL,
  `creditNum` varchar(16) DEFAULT NULL,
  `creditExp` varchar(4) DEFAULT NULL,
  `adminFlag` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`accountID`, `username`, `password`, `firstName`, `lastName`, `streetNum`, `streetName`, `city`, `province`, `postalCode`, `email`, `creditNum`, `creditExp`, `adminFlag`) VALUES
(1, 'rman123', 'hunter2', 'Rob', 'Smith', 52, 'Johnson Street', 'Kingston', 'Ontario', 'K7L 2B2', 'rsmith@someemail.com', '6781254780812567', '1219', '1'),
(2, 'nbone', 'hunter21', 'John', 'Doe', 973, 'Howell Road', 'Oakville', 'Ontario', 'L7R 2J1', 'johndoe12@anotheremail.ca', '5163473257812678', '0920', '0'),
(3, 'test3', 'pass3', 'Joe', 'Last', 555, 'Some Street', 'Toronto', 'Ontario', 'T6G 2G6', 'test3@testemail.com', '7538291029586546', '1222', '0'),
(4, 'test4', 'password4', 'Luke', 'Look', 752, 'Another Road', 'Quebec City', 'Quebec', 'Q4T 5R2', 'luketest4@lukemail.com', '010101010101010', '0121', '0'),
(5, 'test5', 'password5', 'Harry', 'Potter', 51251, 'Other Blvd', 'Burlington', 'Ontario', 'B6L 7F2', 'hp@mail.com', '1928592969492018', '0520', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complex`
--
ALTER TABLE `complex`
  ADD PRIMARY KEY (`complexID`);

--
-- Indexes for table `complexphonenum`
--
ALTER TABLE `complexphonenum`
  ADD PRIMARY KEY (`complexID`,`phoneNum`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`movieID`,`accountID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `showing`
--
ALTER TABLE `showing`
  ADD PRIMARY KEY (`showingID`) USING BTREE,
  ADD KEY `theatreID` (`theatreID`),
  ADD KEY `movieID` (`movieID`) USING BTREE;

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `supplierphonenum`
--
ALTER TABLE `supplierphonenum`
  ADD PRIMARY KEY (`supplierID`,`phoneNum`);

--
-- Indexes for table `theatre`
--
ALTER TABLE `theatre`
  ADD PRIMARY KEY (`theatreNum`,`complexID`,`theatreID`) USING BTREE,
  ADD KEY `complexID` (`complexID`),
  ADD KEY `theatreID` (`theatreID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `showingID` (`showingID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `userphonenum`
--
ALTER TABLE `userphonenum`
  ADD PRIMARY KEY (`accountID`,`phoneNum`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`accountID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complexphonenum`
--
ALTER TABLE `complexphonenum`
  ADD CONSTRAINT `complexphonenum_ibfk_1` FOREIGN KEY (`complexID`) REFERENCES `complex` (`complexID`);

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `users` (`accountID`);

--
-- Constraints for table `showing`
--
ALTER TABLE `showing`
  ADD CONSTRAINT `movie_id_cont` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_theatre_cont` FOREIGN KEY (`theatreID`) REFERENCES `theatre` (`theatreID`) ON DELETE CASCADE;

--
-- Constraints for table `supplierphonenum`
--
ALTER TABLE `supplierphonenum`
  ADD CONSTRAINT `supplierphonenum_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `theatre`
--
ALTER TABLE `theatre`
  ADD CONSTRAINT `theatre_ibfk_1` FOREIGN KEY (`complexID`) REFERENCES `complex` (`complexID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`showingID`) REFERENCES `showing` (`showingID`);

--
-- Constraints for table `userphonenum`
--
ALTER TABLE `userphonenum`
  ADD CONSTRAINT `userphonenum_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `users` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

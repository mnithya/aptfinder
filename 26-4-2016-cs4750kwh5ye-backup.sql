-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2016 at 08:13 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4750kwh5ye`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE IF NOT EXISTS `Address` (
  `address_id` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL COMMENT 'state abbrev.',
  `zipcode` int(10) NOT NULL,
  `street_num` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`address_id`, `street`, `city`, `state`, `zipcode`, `street_num`) VALUES
(1, 'Western Avenue', 'Seattle', 'WA', 98121, 2800),
(2, 'Elliott Ave', 'Seattle', 'WA', 98121, 2334),
(3, 'Elliott Ave W.', 'Seattle', 'WA', 98119, 600),
(4, 'Wall Street', 'Seattle', 'WA', 98121, 500),
(5, 'Wall Street', 'Seattle', 'WA', 98121, 400),
(6, 'Western Avenue', 'Seattle', 'WA', 98121, 2922),
(7, '10th Ave E', 'Seattle', 'WA', 98102, 215),
(8, 'Westlake Ave', 'Seattle', 'WA', 98101, 1942),
(9, 'First Avenue', 'Seattle', 'WA', 98121, 2615),
(10, 'Second Ave. West', 'Seattle', 'WA', 98119, 312),
(11, '3rd Avenue', 'Seattle', 'WA', 98121, 2312),
(12, 'Western Ave', 'Seattle', 'WA', 98121, 2801),
(13, 'Western Ave', 'Seattle', 'WA', 98104, 888),
(14, 'West 52nd St.', 'New York', 'NY', 10019, 515),
(15, '1st Ave.', 'New York', 'NY', 10009, 252),
(16, 'John St', 'New York', 'NY', 10038, 100),
(17, 'West 28th St', 'New York', 'NY', 10001, 525),
(18, 'East 82nd St', 'New York', 'NY', 10028, 200),
(19, 'Morningside Dr', 'New York', 'NY', 10025, 1),
(20, 'West 37th St', 'New York', 'NY', 10018, 400),
(21, 'Stewart Ave', 'Las Vegas', 'NV', 89110, 5250),
(22, 'Bermuda Rd', 'Las Vegas', 'NV', 89123, 9490),
(23, 'Cambridge St', 'Las Vegas', 'NV', 89169, 3675),
(24, 'Pennwood Ave', 'Las Vegas', 'NV', 89102, 3820),
(25, 'Dumont Blvd', 'Las Vegas', 'NV', 89169, 1001),
(26, 'Starboard Dr', 'Las Vegas', 'NV', 89117, 8600),
(27, 'Swenson St', 'Las Vegas', 'NV', 89119, 3955),
(28, 'Arville St', 'Las Vegas', 'NV', 89103, 4020),
(29, 'Losee Rd', 'Las Vegas', 'NV', 89081, 5005),
(30, 'Polk St.', 'San Francisco', 'CA', 94102, 101),
(31, 'Market St.', 'San Francisco', 'CA', 94102, 1390),
(32, 'Ninth St.', 'San Francisco', 'CA', 94103, 55),
(33, 'Octavia St.', 'San Francisco', 'CA', 94102, 325),
(34, 'Folsom St.', 'San Francisco', 'CA', 94107, 900),
(42, 'Western Avenue', 'Seattle', 'WA', 98121, 2922),
(43, 'Queens Blvd', 'Forest Hills', 'NY', 11375, 112),
(44, 'Queens Blvd ', 'Forest Hills', 'NY', 11375, 112),
(45, 'walking', 'Seattle', 'WA', 98121, 7887),
(46, 'Wall', 'Seattle', 'WA', 98121, 400);

-- --------------------------------------------------------

--
-- Table structure for table `Amenity`
--

CREATE TABLE IF NOT EXISTS `Amenity` (
  `amenity_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Amenity`
--

INSERT INTO `Amenity` (`amenity_id`, `name`) VALUES
(1, 'Pool'),
(2, 'Fitness Center'),
(3, 'Water View'),
(4, 'In Apartment Washer-Dryer'),
(5, 'Parking'),
(6, 'Balcony'),
(7, 'Air Conditioning'),
(8, 'Dishwasher'),
(9, 'Courtyard'),
(10, 'Common Area Kitchen'),
(11, 'Printing Center'),
(12, 'Common Area WiFi'),
(13, 'Rooftop Deck'),
(14, 'Guest Suites'),
(15, 'Game Room'),
(16, 'City View'),
(17, 'Refridgerator'),
(18, 'Microwave'),
(19, 'Heating'),
(20, 'Cable'),
(21, 'Walk-In Closet');

-- --------------------------------------------------------

--
-- Table structure for table `Apartment`
--

CREATE TABLE IF NOT EXISTS `Apartment` (
  `building_id` int(11) NOT NULL,
  `apt_num` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  `num_bathrooms` int(11) NOT NULL DEFAULT '1',
  `num_bedrooms` int(11) NOT NULL DEFAULT '1',
  `rent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Apartment`
--

INSERT INTO `Apartment` (`building_id`, `apt_num`, `availability`, `num_bathrooms`, `num_bedrooms`, `rent`) VALUES
(1, 330, 1, 2, 2, 2357),
(2, 124, 1, 1, 1, 2700),
(2, 328, 1, 1, 1, 1200),
(3, 345, 0, 1, 2, 2970),
(4, 203, 0, 1, 1, 1500),
(4, 213, 1, 1, 1, 1526),
(5, 108, 0, 1, 2, 2500),
(5, 123, 1, 1, 2, 3250),
(6, 112, 1, 2, 2, 2500),
(6, 408, 1, 2, 2, 2500),
(6, 425, 0, 2, 2, 3250),
(6, 714, 1, 2, 3, 3300),
(7, 12, 1, 2, 2, 5785),
(7, 22, 1, 1, 1, 3956),
(7, 101, 1, 1, 1, 3081),
(7, 102, 1, 1, 1, 2912),
(8, 103, 1, 1, 1, 3589),
(8, 278, 1, 1, 1, 3455),
(9, 153, 1, 2, 2, 1255),
(9, 312, 0, 2, 2, 1200),
(9, 353, 1, 2, 2, 1234),
(9, 512, 1, 1, 1, 860),
(9, 514, 1, 1, 1, 860),
(9, 521, 1, 2, 3, 1383),
(9, 619, 1, 1, 2, 1192),
(9, 632, 1, 1, 2, 1292),
(24, 404, 1, 1, 2, 2),
(25, 314, 1, 2, 2, 2220),
(28, 404, 1, 2, 2, 2700);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Apt_Availability`
--
CREATE TABLE IF NOT EXISTS `Apt_Availability` (
`bldg_id` int(11)
,`bldg_name` varchar(100)
,`apt_totals` bigint(21)
,`vacancy` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `Building`
--

CREATE TABLE IF NOT EXISTS `Building` (
  `building_id` int(11) NOT NULL COMMENT 'key',
  `address_id` int(11) DEFAULT NULL,
  `website_url` varchar(100) DEFAULT NULL,
  `walk_score` float DEFAULT NULL,
  `pets_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `rating` float DEFAULT NULL,
  `bldg-company_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Building`
--

INSERT INTO `Building` (`building_id`, `address_id`, `website_url`, `walk_score`, `pets_allowed`, `rating`, `bldg-company_id`, `name`) VALUES
(1, 10, 'http://www.equityapartments.com/seattle/lower-queen-anne/harrison-square-apartments#', 93, 1, 4.25, 1, 'Harrison Square'),
(2, 13, 'http://www.thepostseattle.com/', 99, 0, 3.7, 3, 'The Post'),
(3, 1, 'http://www.avaloncommunities.com/washington/seattle-apartments/ava-belltown/pictures', 94, 1, 3.5, 2, 'AVA Belltown'),
(4, 2, 'http://www.arthouseseattle.com/#home', 94, 1, 4.5, 3, 'ArtHouse'),
(5, 3, 'http://www.canvasonelliott.com/index.aspx', 81, 1, 3.8, 3, 'CANVAS'),
(6, 20, 'http://www.equityapartments.com/new-york-city/midtown-west/hudson-crossing-apartments', 99, 1, 4.2, 1, 'Hudson Crossing'),
(7, 14, 'http://www.avaloncommunities.com/new-york/new-york-city-apartments/avalon-clinton', 97, 1, 4.4, 2, 'Avalon Clinton'),
(8, 15, 'http://www.stuytown.com/no-fee-apartments-nyc', 99, 1, 4.3, 4, 'Stuyvesant Town'),
(9, 16, 'http://www.renaissanceapt.com/', 100, 1, 2.1, 5, 'The Renaissance'),
(10, 17, 'http://www.avaloncommunities.com/new-york/new-york-city-apartments/ava-high-line', 91, 1, 4.6, 2, 'AVA High Line'),
(11, 19, 'http://www.avaloncommunities.com/new-york/new-york-city-apartments/avalon-morningside-park', 98, 1, 4.5, 2, 'Avalon Morningside Park'),
(12, 18, 'http://thewimbledon.com/', 100, 1, 4.5, 6, 'The Wimbledon'),
(14, 31, 'http://www.essexapartmenthomes.com/california/san-francisco-bay-area-apartments/san-francisco-apartm', 79, 1, 4.5, 3, 'Fox Plaza'),
(15, 32, 'http://www.rent.com/california/san-francisco-apartments/ava-55-ninth-4-64348039', 98, 1, 4.8, 8, 'AVA 55 Ninth'),
(16, 33, 'http://www.rent.com/california/san-francisco-apartments/avalon-hayes-valley-4-100048849', 90, 1, 4.7, 2, 'Avalon Hayes Valley'),
(17, 34, 'http://www.rent.com/california/san-francisco-apartments/mosso-apartments-4-100045450', 88, 1, 4.5, 6, 'Mosso Apartments'),
(18, 30, 'http://www.apartments.com/the-civic-san-francisco-ca/32sh4lf/', 99, 0, 5, 3, 'The Civic'),
(24, 42, 'http://www.essexapartmenthomes.com/washington/seattle-area-apartments/seattle-apartments/the-audrey-', 96, 1, 3.5, NULL, 'Audrey at Belltown'),
(25, 43, 'http://www.thepinnacleatforesthills.com/', 88, 1, 3.9, 3, 'Pinnacle Condominium'),
(28, 46, 'http://www.sidneyapts.com/', 98, 1, 4, 3, 'Sidney Belltown');

--
-- Triggers `Building`
--
DELIMITER $$
CREATE TRIGGER `limit_building_input` BEFORE INSERT ON `Building`
 FOR EACH ROW BEGIN
	DECLARE msg varchar(255);
	if new.walk_score < 0 OR new.walk_score > 100 OR new.rating < 0 OR new.rating > 5 THEN
		set msg = concat('Allowed ranges: 0 < walk score < 100 and 0 < rating < 5');
		SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = msg;
	end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Building_Amenity`
--

CREATE TABLE IF NOT EXISTS `Building_Amenity` (
  `ba-amenity_id` int(11) NOT NULL,
  `ba-building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Building_Amenity`
--

INSERT INTO `Building_Amenity` (`ba-amenity_id`, `ba-building_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(6, 2),
(7, 2),
(8, 2),
(12, 2),
(16, 2),
(2, 3),
(4, 3),
(5, 3),
(8, 3),
(9, 3),
(12, 3),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(8, 4),
(12, 4),
(13, 4),
(6, 5),
(10, 5),
(12, 5),
(13, 5),
(2, 6),
(4, 6),
(5, 6),
(7, 6),
(13, 6),
(16, 6),
(2, 7),
(12, 7),
(13, 7),
(16, 7),
(2, 8),
(4, 8),
(5, 8),
(7, 8),
(4, 9),
(7, 9),
(8, 9),
(10, 9),
(2, 10),
(3, 10),
(5, 10),
(9, 10),
(10, 10),
(12, 10),
(2, 11),
(5, 11),
(12, 11),
(15, 11),
(2, 12),
(4, 12),
(6, 12),
(7, 12),
(13, 12),
(16, 12),
(5, 25),
(7, 25),
(8, 25),
(12, 25),
(16, 25),
(10, 28),
(11, 28),
(16, 28);

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE IF NOT EXISTS `Company` (
  `name` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `website` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`name`, `phone`, `website`, `email`, `company_id`) VALUES
('Equity Apartments', '(206) 577-9038', 'http://www.equityapartments.com/', '', 1),
('Avalon Communities', '', 'http://www.avaloncommunities.com/about-us', '', 2),
('Pinnacle', '(214)-891-7800', 'http://ienjoy.pinnacleliving.com/', '', 3),
('StuyTown', '(877)-774-1849', 'http://www.stuytown.com/', '', 4),
('Amurcon', '(804)-320-8898', 'http://www.amurcon.com/', '', 5),
('Rockpoint Group', '(415)-438-7920', 'http://rockpointgroup.com/Contact.htm', 'info@rockpointgroup.com', 6),
('Westdale', '(214)-515-7000', 'www.westdale.com', '', 7),
('Professional Equity Management', '(480)-422-6930', 'www.pemreg.com', 'contact@pemreg.com', 8);

-- --------------------------------------------------------

--
-- Table structure for table `Favorites`
--

CREATE TABLE IF NOT EXISTS `Favorites` (
  `fav-user_id` int(11) NOT NULL,
  `fav-apt_id` int(11) NOT NULL,
  `fav-building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Favorites`
--

INSERT INTO `Favorites` (`fav-user_id`, `fav-apt_id`, `fav-building_id`) VALUES
(5, 330, 1),
(5, 425, 6),
(10, 314, 25),
(10, 404, 28),
(10, 425, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Images`
--

CREATE TABLE IF NOT EXISTS `Images` (
  `img_id` int(11) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `purpose_building_id` int(11) DEFAULT NULL COMMENT 'id of building, apartment or user',
  `purpose_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Images`
--

INSERT INTO `Images` (`img_id`, `img_url`, `purpose_building_id`, `purpose_user_id`) VALUES
(1, 'http://media.equityapartments.com/images/q_50/4106-1/harrison-square-apartments-exterior.jpg', 1, 5),
(2, 'http://www.thepostseattle.com/images/neighbors/gallery/72020092_01.jpg', 5, 5),
(3, 'http://i.imgur.com/XkPUnIh.jpg', 3, 5),
(4, 'https://www.djc.com/stories/images/20141027/ArtHouse_big.jpg', 4, 5),
(5, 'http://i.imgur.com/waRDGCq.jpg', 5, 5),
(6, 'http://i.imgur.com/Wq06QuA.jpg', 6, 5),
(7, 'http://i.imgur.com/ipST48J.jpg', 7, 5),
(8, 'http://i.imgur.com/bLAmICt.jpg', 8, 5),
(9, 'http://i.imgur.com/jyN25k0.jpg', 9, 5),
(10, 'http://i.imgur.com/xEjWtT8.jpg', 10, 5),
(11, 'http://i.imgur.com/neZOM6N.jpg', 11, 5),
(12, 'http://i.imgur.com/nHfE09U.jpg', 12, 5),
(13, 'http://i.imgur.com/aHmCnqL.jpg', 25, NULL),
(15, 'https://s3-media2.fl.yelpcdn.com/bphoto/RDFF5F9S79l9oACeepHS3Q/ls.jpg', 28, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `FirstN` varchar(25) NOT NULL,
  `LastN` varchar(25) NOT NULL,
  `Age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temp table for homework';

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`FirstN`, `LastN`, `Age`) VALUES
('George', 'Lucas', 60),
('James', 'Cameron', 56),
('John', 'Doe', 35),
('Peter', 'Jackson', 46),
('Quentin', 'Tarantino', 41),
('Richard', 'Donner', 63),
('Steven', 'Spielberg', 58),
('K', 'Hi', 21),
('1', '1', 1),
('George', 'Lucas', 60),
('James', 'Cameron', 56),
('John', 'Doe', 35),
('Peter', 'Jackson', 46),
('Quentin', 'Tarantino', 41),
('Richard', 'Donner', 63),
('Steven', 'Spielberg', 58),
('K', 'Hi', 21),
('1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Rents`
--

CREATE TABLE IF NOT EXISTS `Rents` (
  `rents-user_id` int(11) NOT NULL,
  `rents-apt_num` int(11) NOT NULL,
  `rents-building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rents`
--

INSERT INTO `Rents` (`rents-user_id`, `rents-apt_num`, `rents-building_id`) VALUES
(9, 345, 3),
(5, 203, 4),
(11, 425, 6),
(10, 312, 9);

--
-- Triggers `Rents`
--
DELIMITER $$
CREATE TRIGGER `change_availability` AFTER INSERT ON `Rents`
 FOR EACH ROW BEGIN
       DECLARE is_available Boolean;
       -- Check Apartment table
       SELECT 1
       INTO @is_available
       FROM Apartment
       WHERE Apartment.availability = 1 AND apt_num = NEW.`rents-apt_num` AND building_id = NEW.`rents-building_id`;

       IF @is_available = 1
       THEN
           UPDATE Apartment
           SET availability = 0
           WHERE apt_num = NEW.`rents-apt_num` AND building_id = NEW.`rents-building_id`;
       END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `make_available_unrent` AFTER DELETE ON `Rents`
 FOR EACH ROW begin
    UPDATE Apartment
    SET availability = 1
    WHERE apt_num = old.`rents-apt_num` AND building_id = old.`rents-building_id`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sailors`
--

CREATE TABLE IF NOT EXISTS `sailors` (
  `sid` int(11) NOT NULL,
  `sname` varchar(15) NOT NULL,
  `rating` int(11) NOT NULL,
  `age` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for ajax activity';

--
-- Dumping data for table `sailors`
--

INSERT INTO `sailors` (`sid`, `sname`, `rating`, `age`) VALUES
(22, 'Yuppy', 9, 35),
(31, 'Lubber', 8, 55.5),
(44, 'Guppy', 5, 35),
(48, 'Ole Red', 8, 92.3),
(58, 'Rusty', 10, 40),
(22, 'Yuppy', 9, 35),
(31, 'Lubber', 8, 55.5),
(44, 'Guppy', 5, 35),
(48, 'Ole Red', 8, 92.3),
(58, 'Rusty', 10, 40);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Total_Apts_Per_Bldg`
--
CREATE TABLE IF NOT EXISTS `Total_Apts_Per_Bldg` (
`bldg_id` int(11)
,`bldg_name` varchar(100)
,`apt_totals` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `username`, `pword`, `email`, `first_name`, `last_name`, `isAdmin`) VALUES
(5, 'hello', '$2y$10$.n79koL3xVaW5OkVN.BGTemMFNnQR0qvFa7vNSs0Dwudu0qjd7Fz.', 'hellokitty@gmail.com', 'hello', 'kitty', 1),
(6, 'user', '$2y$10$LuuMZ98KETOyzIuB9F9pw.LeFuF8Ehygdx1CHrfkW9Fnt8BqxJnZS', 'email', 'User', 'name', 0),
(7, 'helenap', '$2y$10$JLOae3SBYfrWgu8tX9HDuOEkzjYrbEiL1h0uSDqHnBcJ7hq60x6VS', 'helena.pierce@gmail.com', 'Helena', 'Pierce', 1),
(8, 'K', '$2y$10$O9GhQIelSmOiL.LaPKxu9uplUZdc9K8vbpjzKaKvnzg3QiQ1KPHEC', 'hikkhi123@gmail.com', 'Kk', 'Hi', 0),
(9, 'bubble', '$2y$10$jyUoXMkKic1mh87S4flAzOQLBxnsyz4lElz1udRzu1bPwtc41kt5.', 'bdfjdkj', 'bublbe', 'tea', 0),
(10, 'kk', '$2y$10$nh.WAJsG7LECO5GM8Fhs/.KknTPOfkPwbvcyC3Z1zMaaRnPrjh6My', 'kk@gmail.com', 'Kate', 'Highnammmmm', 0),
(11, 'osmrenter', '$2y$10$ysnCNx2sRwhHris89hwqGOK36dl/aFxOy6Tf096izKpDHuKlFU1jm', 'renter123456@gmail.com', 'RenterA', 'Renter', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Vacancies`
--
CREATE TABLE IF NOT EXISTS `Vacancies` (
`bldg_id` int(11)
,`bldg_name` varchar(100)
,`vacant` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `Apt_Availability`
--
DROP TABLE IF EXISTS `Apt_Availability`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750kwh5ye`@`%` SQL SECURITY DEFINER VIEW `Apt_Availability` AS select `Total_Apts_Per_Bldg`.`bldg_id` AS `bldg_id`,`Total_Apts_Per_Bldg`.`bldg_name` AS `bldg_name`,`Total_Apts_Per_Bldg`.`apt_totals` AS `apt_totals`,ifnull(`Vacancies`.`vacant`,0) AS `vacancy` from (`Total_Apts_Per_Bldg` left join `Vacancies` on(((`Total_Apts_Per_Bldg`.`bldg_id` = `Vacancies`.`bldg_id`) and (`Total_Apts_Per_Bldg`.`bldg_name` = `Vacancies`.`bldg_name`))));

-- --------------------------------------------------------

--
-- Structure for view `Total_Apts_Per_Bldg`
--
DROP TABLE IF EXISTS `Total_Apts_Per_Bldg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750kwh5ye`@`%` SQL SECURITY DEFINER VIEW `Total_Apts_Per_Bldg` AS select `Building`.`building_id` AS `bldg_id`,`Building`.`name` AS `bldg_name`,count(`Apartment`.`building_id`) AS `apt_totals` from (`Building` join `Apartment` on((`Apartment`.`building_id` = `Building`.`building_id`))) group by `Apartment`.`building_id`;

-- --------------------------------------------------------

--
-- Structure for view `Vacancies`
--
DROP TABLE IF EXISTS `Vacancies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750kwh5ye`@`%` SQL SECURITY DEFINER VIEW `Vacancies` AS select `Building`.`building_id` AS `bldg_id`,`Building`.`name` AS `bldg_name`,count(`Apartment`.`building_id`) AS `vacant` from (`Building` join `Apartment` on((`Apartment`.`building_id` = `Building`.`building_id`))) where (`Apartment`.`availability` = 1) group by `Apartment`.`building_id`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `Amenity`
--
ALTER TABLE `Amenity`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `Apartment`
--
ALTER TABLE `Apartment`
  ADD PRIMARY KEY (`building_id`,`apt_num`);

--
-- Indexes for table `Building`
--
ALTER TABLE `Building`
  ADD PRIMARY KEY (`building_id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `company_index` (`bldg-company_id`);

--
-- Indexes for table `Building_Amenity`
--
ALTER TABLE `Building_Amenity`
  ADD PRIMARY KEY (`ba-amenity_id`,`ba-building_id`), ADD KEY `ba-building_index` (`ba-building_id`), ADD KEY `ba-amenity_index` (`ba-amenity_id`);

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `Favorites`
--
ALTER TABLE `Favorites`
  ADD PRIMARY KEY (`fav-user_id`,`fav-apt_id`,`fav-building_id`), ADD KEY `fav_user_id_index` (`fav-user_id`), ADD KEY `fav_apt_pk_index` (`fav-building_id`,`fav-apt_id`), ADD KEY `favorites_ibfk_2` (`fav-building_id`,`fav-apt_id`);

--
-- Indexes for table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`img_id`), ADD KEY `img_bldg_index` (`purpose_building_id`), ADD KEY `img_user_index` (`purpose_user_id`);

--
-- Indexes for table `Rents`
--
ALTER TABLE `Rents`
  ADD PRIMARY KEY (`rents-user_id`), ADD KEY `rents_apt_pk_index` (`rents-building_id`,`rents-apt_num`), ADD KEY `rents_ibfk_2` (`rents-building_id`,`rents-apt_num`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `Amenity`
--
ALTER TABLE `Amenity`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `Building`
--
ALTER TABLE `Building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'key',AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Images`
--
ALTER TABLE `Images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Apartment`
--
ALTER TABLE `Apartment`
ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `Building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Building`
--
ALTER TABLE `Building`
ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`bldg-company_id`) REFERENCES `Company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Building_Amenity`
--
ALTER TABLE `Building_Amenity`
ADD CONSTRAINT `ba_ibfk_1` FOREIGN KEY (`ba-amenity_id`) REFERENCES `Amenity` (`amenity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ba_ibfk_2` FOREIGN KEY (`ba-building_id`) REFERENCES `Building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Favorites`
--
ALTER TABLE `Favorites`
ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`fav-building_id`, `fav-apt_id`) REFERENCES `Apartment` (`building_id`, `apt_num`),
ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`fav-user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Images`
--
ALTER TABLE `Images`
ADD CONSTRAINT `img_ibfk` FOREIGN KEY (`purpose_user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`purpose_building_id`) REFERENCES `Building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Rents`
--
ALTER TABLE `Rents`
ADD CONSTRAINT `rents_ibfk_2` FOREIGN KEY (`rents-building_id`, `rents-apt_num`) REFERENCES `Apartment` (`building_id`, `apt_num`),
ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`rents-user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

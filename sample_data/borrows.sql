--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `book_id` int(11) unsigned NOT NULL,
  `borrow_date` varchar(10) DEFAULT (CURRENT_DATE),
  `return_date` varchar(10) DEFAULT(DATE_ADD(CURRENT_DATE, INTERVAL 60 DAY)),
  PRIMARY KEY (`borrow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `genre` varchar(64) NOT NULL,
  `available` int(2) NOT NULL,
  `borrowed` int(4) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `FK_BookAuthor` (`author_id`),
  CONSTRAINT `FK_BookAuthor` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
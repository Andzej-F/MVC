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



--
-- Sample data for table `books`
--
INSERT INTO `books` (`book_id`, `title`, `author_id`, `genre`, `available`, `borrowed`) VALUES
(NULL, 'The Three Musketeers', '4', 'Historical novel', '6', '2'),
(NULL, 'Treasure Island', '6', 'Adventure', '5', '2'),
(NULL, 'King Solomon\'s Mines', '8', 'Lost World', '4', '0'),
(NULL, 'Journey to the Center of the Earth', '5', 'Science Fiction, Adventure', '4', '1'),
(NULL, 'The Count of Monte Cristo', '4', 'Historical novel, Adventure', '7', '0'),
(NULL, 'Ivanhoe', '9', 'Historical novel, chivalric romance', '4', '0'),
(NULL, 'Tarzan of the Apes', '10', 'Adventure', '4', '1'),
(NULL, 'Heart of Darkness', '11', 'Novella', '3', '0'),
(NULL, 'Hatchet', '12', 'Young adult novel', '0', '3'),
(NULL, 'The Jungle Book', '14', 'Children\'s book', '1', '6'),
(NULL, 'And Then There Were None', '18', 'Mystery', '3', '1'),
(NULL, 'Evil Under the Sun', '18', 'Crime', '5', '0'),
(NULL, 'Bridget Jones\'s Diary', '19', 'Comedy novel', '2', '3'),
(NULL, 'Harry Potter and the Philosopher\'s Stone', '20', 'Fantasy', '1', '5'),
(NULL, 'The Casual Vacancy', '20', 'Fiction, tragicomedy', '3', '3'),
(NULL, 'Shantaram', '21', 'Autobiography', '2', '3')

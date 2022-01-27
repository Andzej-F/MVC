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
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Sample data for table `books`
--
INSERT INTO `books` (`book_id`, `title`, `author_id`, `genre`, `available`, `borrowed`) VALUES
(NULL, 'The Three Musketeers', '1', 'Historical novel', '6', '2'),
(NULL, 'Treasure Island', '3', 'Adventure', '5', '2'),
(NULL, 'King Solomon\'s Mines', '4', 'Lost World', '4', '0'),
(NULL, 'Journey to the Center of the Earth', '2', 'Science Fiction, Adventure', '4', '1'),
(NULL, 'The Count of Monte Cristo', '1', 'Historical novel, Adventure', '7', '0'),
(NULL, 'Ivanhoe', '5', 'Historical novel, chivalric romance', '4', '0'),
(NULL, 'Tarzan of the Apes', '6', 'Adventure', '4', '1'),
(NULL, 'Heart of Darkness', '7', 'Novella', '3', '0'),
(NULL, 'Hatchet', '8', 'Young adult novel', '0', '3'),
(NULL, 'The Jungle Book', '10', 'Children\'s book', '1', '6'),
(NULL, 'And Then There Were None', '11', 'Mystery', '3', '1'),
(NULL, 'Evil Under the Sun', '11', 'Crime', '5', '0'),
(NULL, 'Bridget Jones\'s Diary', '12', 'Comedy novel', '2', '3'),
(NULL, 'Harry Potter and the Philosopher\'s Stone', '13', 'Fantasy', '1', '5'),
(NULL, 'The Casual Vacancy', '13', 'Fiction, tragicomedy', '3', '3'),
(NULL, 'Shantaram', '14', 'Autobiography', '2', '3')

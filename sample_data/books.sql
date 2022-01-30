--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `genre` varchar(64) NOT NULL,
  `available` int(2) NOT NULL,
  `borrowed` int(2) DEFAULT 0,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sample data for table `books`
--
INSERT INTO `books` (`book_id`, `title`, `author_id`, `genre`, `available`) VALUES
(1, 'The Three Musketeers', '1', 'Historical novel', '6'),
(2, 'Treasure Island', '3', 'Adventure', '6'),
(3, 'King Solomon\'s Mines', '4', 'Lost World', '6'),
(4, 'Journey to the Center of the Earth', '2', 'Science Fiction, Adventure', '6'),
(5, 'The Count of Monte Cristo', '1', 'Historical novel, Adventure', '6'),
(6, 'Ivanhoe', '5', 'Historical novel, chivalric romance', '6'),
(7, 'Tarzan of the Apes', '6', 'Adventure', '6'),
(8, 'Heart of Darkness', '7', 'Novella', '6'),
(9, 'Hatchet', '8', 'Young adult novel', '6'),
(10, 'The Jungle Book', '10', 'Children\'s book', '6'),
(11, 'And Then There Were None', '11', 'Mystery', '6'),
(12, 'Evil Under the Sun', '11', 'Crime', '6'),
(13, 'Bridget Jones\'s Diary', '12', 'Comedy novel', '6'),
(14, 'Harry Potter and the Philosopher\'s Stone', '13', 'Fantasy', '6'),
(15, 'The Casual Vacancy', '13', 'Fiction, tragicomedy', '6'),
(16, 'Shantaram', '14', 'Autobiography', '6')
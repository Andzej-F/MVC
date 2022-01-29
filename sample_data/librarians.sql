-- 
-- Table structure for `librarians`
-- 

CREATE TABLE `librarians` (
  `librarian_id` int(11) NOT NULL AUTO_INCREMENT,
  `librarian_name` varchar(50) NOT NULL,
  `librarian_surname` varchar(64) NOT NULL,
  `librarian_email` varchar(255) NOT NULL,
  `librarian_book_count` int(11) DEFAULT 0,
  `librarian_password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
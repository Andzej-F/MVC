-- 
-- Table structure for `readers`
-- 

CREATE TABLE `readers` (
  `reader_id` int(11) NOT NULL AUTO_INCREMENT,
  `reader_name` varchar(50) NOT NULL,
  `reader_surname` varchar(64) NOT NULL,
  `reader_email` varchar(255) NOT NULL,
  `reader_book_count` int(11) DEFAULT 0,
  `reader_password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`reader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

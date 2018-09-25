--Database: `chatbox`
--------------------------------------------------------
CREATE TABLE `logs` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `msg` text NOT NULL
);
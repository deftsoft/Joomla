CREATE TABLE `#__calendar_events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `tag_id` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `details` MEDIUMTEXT NOT NULL,
  `website` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact_details` MEDIUMTEXT NOT NULL,
  `verified` tinyint(1) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__calendar_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__calendar_user_tags` (
  `user_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__calendar_events` (`id`, `name`, `alias`, `tag_id`, `date`, `details`, `website`, `location`, `contact_details`, `verified`) VALUES
('1', 'Highlands Fling', 'highlands-fling', '1\,3', '2011-03-12', 'This event is held for everyone to enjoy.', 'http://www.wildhorizons.com.au', 'Wingello, NSW', 'Contact Wildhorizons at info@wildhorizons.com.au', '1'),
('2', 'CORC Club Race', 'corc-club-race', '2\,4', '2011-03-13', 'Local CORC club race.', 'http://www.corc.asn.au', 'Canberra, ACT', 'Contact Russ at on 0425 345 834', '1'),
('3', 'Scott 24 Hour', 'scott-24-hour', '4', '2011-03-15', '24 hour MTB race.', 'http://www.scott24.com.au', 'Mt Stromlo, Canberra, NSW', 'Contact Scott24 crew at info@scott24.com.au', '1'),
('4', 'CORC Club Race', 'corc-club-race', '2\,4', '2011-03-27', 'Local CORC club race.', 'http://www.corc.asn.au', 'Canberra, ACT', 'Contact Russ at on 0425 345 834', '0');

INSERT INTO `#__calendar_tags` (`id`, `name`) VALUES
('1', 'Wild Horizons'),
('2', 'CORC'),
('3', 'NSW'),
('4', 'ACT');

INSERT INTO `#__calendar_user_tags` (`user_id`, `tag_id`) VALUES
('42', '1'),
('42', '3');
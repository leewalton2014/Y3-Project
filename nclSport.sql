DROP TABLE IF EXISTS `ncl_users`;
CREATE TABLE IF NOT EXISTS `ncl_users` (
  `userID` int(10) NOT NULL auto_increment,
  `forename` varchar(255) default NULL,
  `surname` varchar(400) default NULL,
  `dob` date default NULL,
  `email` time default NULL,
  `gender` varchar(10) default NULL,
  `userType` varchar(10) default NULL,
  `passwordHash` varchar(100) default NULL,
  `membershipEXP` date default NULL,
  `postcode` varchar(100) default NULL,
  `addrL2` varchar(100) default NULL,
  `addrL1` varchar(100) default NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_account_type`;
CREATE TABLE IF NOT EXISTS `ncl_account_type` (
  `accountTypeID` varchar(10) NOT NULL default ``,
  `role` varchar(30) default NULL,
  PRIMARY KEY (`accountTypeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ncl_events`;
CREATE TABLE IF NOT EXISTS `ncl_events` (
  `eventID` int(10) NOT NULL auto_increment,
  `eventTitle` varchar(100) default NULL,
  `eventDescription` varchar(1000) default NULL,
  `eventDate` date default NULL,
  `eventTime` time default NULL,
  `eventDuration` time default NULL,
  `facilityID` int(10) default NULL,
  `eventBookingLimit` int(10) default NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_facilities`;
CREATE TABLE IF NOT EXISTS `ncl_facilities` (
  `facilityID` int(10) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_bookings`;
CREATE TABLE IF NOT EXISTS `ncl_bookings` (
  `bookingID` int(10) NOT NULL auto_increment,
  `eventID` int(10) default NULL,
  `userID` int(10) default NULL,
  PRIMARY KEY (`bookingID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_cms_content`;
CREATE TABLE IF NOT EXISTS `ncl_cms_content` (
  `contentID` int(10) NOT NULL auto_increment,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  `publisher` varchar(30) default NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_cms_tags`;
CREATE TABLE IF NOT EXISTS `ncl_cms_tags` (
  `tagID` int(10) NOT NULL auto_increment,
  `tagName` varchar(30) default NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;




INSERT INTO 'ncl_users' ('userID', 'forename', 'surname', 'dob', 'email', 'gender',
  'userType', 'passwordHash', 'membershipEXP', 'postcode', 'addrL2', 'addrL1') VALUES
  ('1', 'Lee', 'Walton', '16/02/1999', 'lee.walton2014@outlook.com', 'Male',
    '1', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'DH87RH', 'Consett', '17 New Black Street'),
  ('1', 'Adam', 'Carr', '12/01/2000', 'admb445@gmail.com', 'Male',
    '1', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'NE81AQ', 'Gateshead', '202 High Street');

INSERT INTO 'ncl_account_type' ('accountTypeID', 'role') VALUES
('a1', 'user'),
('a2', 'member'),
('a3', 'staff'),
('a4', 'admin');

INSERT INTO 'ncl_events' ('eventID', 'eventTitle', 'eventDescription', 'eventDate', 'eventTime', 'facilityID') VALUES
('1', 'Yoga', 'The art of movement, you will learn from the start the basics and will be led by the best instructor in the NE.', '12/07/20', '15:00', '00:45', '1'),
('1', 'Squash', 'Advanced squash, you will have access to the best squash coach to help you improove your technique.', '12/07/20', '13:00', '01:30', '2');

INSERT INTO 'ncl_cms_tags' ('tagID', 'tagName') VALUES
('1', 'index'),
('2', 'about'),
('3', 'Nutrition'),
('4', 'News');

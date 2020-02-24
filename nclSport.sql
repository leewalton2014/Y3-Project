DROP TABLE IF EXISTS `ncl_users`;
CREATE TABLE IF NOT EXISTS `ncl_users` (
  `userID` int(10) NOT NULL auto_increment,
  `username` varchar(200) default NULL,
  `forename` varchar(200) default NULL,
  `surname` varchar(200) default NULL,
  `dob` date default NULL,
  `email` varchar(300) default NULL,
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
  `accountTypeID` int(10) default NULL,
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
  `capacity` int(10) default NULL,
  PRIMARY KEY (`facilityID`)
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
  `date` date default NULL,
  `time` time default NULL,
  `version` varchar(30) default NULL,
  `contentTitle` varchar(300) default NULL,
  `contentBody` varchar(5000) default NULL,
  `contentTag` varchar(10) default NULL,
  PRIMARY KEY (`contentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `ncl_cms_tags`;
CREATE TABLE IF NOT EXISTS `ncl_cms_tags` (
  `tagID` int(10) NOT NULL auto_increment,
  `tagName` varchar(30) default NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;




INSERT INTO ncl_users (userID, username, forename, surname, dob, email, gender,
  userType, passwordHash, membershipEXP, postcode, addrL2, addrL1) VALUES
  ('1', 'lee.walton', 'Lee', 'Walton', '16/02/16', 'lee.walton2014@outlook.com', 'Male',
    '3', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'DH87RH', 'Consett', '17 New Black Street'),
  ('2', 'adam.carr', 'Adam', 'Carr', '2000/01/11', 'admb445@gmail.com', 'Male',
    '3', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'NE81AQ', 'Gateshead', '202 High Street'),
  ('3', 'adamcarr1999', 'Adam', 'Carr', '2000/01/11', 'admb443@gmail.com', 'Male',
    '2', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '2029-01-20', 'NE81AQ', 'Gateshead', '202 High Street');

INSERT INTO ncl_account_type (accountTypeID, role) VALUES
('1', 'user'),
('2', 'member'),
('3', 'staff'),
('4', 'admin');

INSERT INTO ncl_events (eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, facilityID) VALUES
('100', 'Yoga', 'The art of movement, you will learn from the start the basics and will be led by the best instructor in the NE.', '20/07/20', '15:00', '00:45', '1'),
('101', 'Squash', 'Advanced squash, you will have access to the best squash coach to help you improove your technique.', '20/07/20', '13:00', '01:30', '2');

INSERT INTO ncl_cms_tags (tagID, tagName) VALUES
('1', 'index'),
('2', 'about'),
('3', 'Nutrition'),
('4', 'News');

INSERT INTO ncl_facilities (description, capacity) VALUES
('sports hall', '200'),
('squash court', '10');

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

INSERT INTO 'ncl_users' ('userID', 'forename', 'surname', 'dob', 'email', 'gender',
  'userType', 'passwordHash', 'membershipEXP', 'postcode', 'addrL2', 'addrL1') VALUES
  ('1', 'Lee', 'Walton', '16/02/1999', 'lee.walton2014@outlook.com', 'Male',
    '1', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'DH87RH', 'Consett', '17 New Black Street'),
  ('1', 'Adam', 'Carr', '12/01/2000', 'admb445@gmail.com', 'Male',
    '1', '$2y$12$AhcoeDloQQj4CPwwWqA30.SCI0ZIq1Gs3FlYeH5i4UCHA2QrQDjli', '', 'NE81AQ', 'Gateshead', '202 High Street');

DROP TABLE IF EXISTS `ncl_account_type`;
CREATE TABLE IF NOT EXISTS `ncl_account_type` (
  `accountTypeID` varchar(10) NOT NULL default ``,
  `role` varchar(30) default NULL,
  PRIMARY KEY (`accountTypeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO 'ncl_account_type' ('accountTypeID', 'role') VALUES
('a1', 'user'),
('a2', 'member'),
('a3', 'staff'),
('a4', 'admin');







DROP TABLE IF EXISTS `aa_event_stage`;
CREATE TABLE IF NOT EXISTS `aa_event_stage` (
  `stageID` varchar(10) NOT NULL default ``,
  `stageNumber` varchar(7) default NULL,
  `stageCapacity` varchar(7) default NULL,
  PRIMARY KEY (`stageID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO 'aa_event_stage' ('stageID', 'stageNumber', 'stageCapacity') VALUES
('s1', '1', '11000'),
('s2', '2', '500'),
('s3', '3', '500'),
('s4', '4', '5000'),
('s5', '5', '2000');

DROP TABLE IF EXISTS `aa_customers`;
CREATE TABLE IF NOT EXISTS `aa_customers` (
  `custID` int(10) NOT NULL auto_increment,
  `custForename` varchar(255) default NULL,
  `custSurname` varchar(255) default NULL,
  `custEmail` varchar(255) default NULL,
  `custUsername` varchar(30) default NULL,
  `custPasswordHash` varchar(255) default NULL,
  PRIMARY KEY (`custID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=979;

DROP TABLE IF EXISTS `aa_sales`;
CREATE TABLE IF NOT EXISTS `aa_sales` (
  `saleID` int(10) NOT NULL auto_increment,
  `custID` varchar(10) default NULL,
  `eventID` varchar(10) default NULL,
  `saleQuantity` int(6) default NULL,
  `orderNumber` varchar(255) default NULL,
  `orderDate` date default NULL,
  PRIMARY KEY (`saleID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=979;

DROP TABLE IF EXISTS `aa_cart`;
CREATE TABLE IF NOT EXISTS `aa_cart` (
  `cartItemID` int(10) NOT NULL auto_increment,
  `custID` varchar(10) default NULL,
  `eventID` varchar(10) default NULL,
  `cartItemQuantity` int(6) default NULL,
  PRIMARY KEY (`cartItemID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `aa_blog`;
CREATE TABLE IF NOT EXISTS `aa_blog` (
  `postID` int(10) NOT NULL auto_increment,
  `postTitle` varchar(255) default NULL,
  `postBody` varchar(10000) default NULL,
  `postDate` date default NULL,
  PRIMARY KEY (`postID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

DROP TABLE IF EXISTS `aa_admins`;
CREATE TABLE IF NOT EXISTS `aa_admins` (
  `adminID` int(10) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `passwordHash` varchar(255) default NULL,
  `forename` varchar(225) default NULL,
  `surname` varchar(225) default NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=100;

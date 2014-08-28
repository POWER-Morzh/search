CREATE TABLE IF NOT EXISTS `#__comprofiler` (
	`id` int(11) NOT NULL default '0',
	`user_id` int(11) NOT NULL default '0',
	`firstname` VARCHAR( 100 ),
	`middlename` VARCHAR( 100 ) ,
	`lastname` VARCHAR( 100 ),
	`hits` int(11) NOT NULL default '0',
	`avatar` varchar(255) default NULL,
	`avatarapproved` tinyint(4) default '1',
	`approved` tinyint(4) NOT NULL default '1',
	`confirmed` tinyint(4) NOT NULL default '1',
	`lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
	`banned` tinyint(4) NOT NULL default '0',
	`banneddate` datetime default NULL,
	`bannedby` int(11) default NULL,
	`bannedreason` mediumtext,
	`acceptedterms` tinyint(1) NOT NULL default '0',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__comprofiler_field_values` (
	`fieldvalueid` int(11) NOT NULL auto_increment,
	`fieldid` int(11) NOT NULL default '0',
	`fieldtitle` varchar(50) NOT NULL default '',
	`ordering` int(11) NOT NULL default '0',
	`sys` tinyint(4) NOT NULL default '0',
	PRIMARY KEY  (`fieldvalueid`)
) ENGINE=MyISAM AUTO_INCREMENT=16;

CREATE TABLE IF NOT EXISTS `#__comprofiler_fields` (
	`fieldid` int(11) NOT NULL auto_increment,
	`name` varchar(50) NOT NULL default '',
	`table` varchar(50) NOT NULL default '#__comprofiler',
	`title` varchar(255) NOT NULL default '',
	`type` varchar(50) NOT NULL default '',
	`maxlength` int(11) default NULL,
	`size` int(11) default NULL,
	`required` tinyint(4) default '0',
	`tabid` int(11) default NULL,
	`ordering` int(11) default NULL,
	`cols` int(11) default NULL,
	`rows` int(11) default NULL,
	`value` varchar(50) default NULL,
	`default` MEDIUMTEXT default NULL,
	`published` tinyint(1) NOT NULL default '1',
	`registration` tinyint(1) NOT NULL default '0',
	`profile` tinyint(1) NOT NULL default '1',
	`readonly` TINYINT( 1 ) DEFAULT '0' NOT NULL,
	`calculated` tinyint(1) NOT NULL default '0',
	`sys` tinyint(4) NOT NULL default '0',
	PRIMARY KEY  (`fieldid`)
) ENGINE=MyISAM AUTO_INCREMENT=54;

CREATE TABLE IF NOT EXISTS `#__comprofiler_lists` (
	`listid` int(11) NOT NULL auto_increment,
	`title` varchar(255) NOT NULL default '',
	`description` mediumtext,
	`published` tinyint(1) NOT NULL default '0',
	`default` tinyint(1) DEFAULT '0' NOT NULL, 
	`usergroupids` varchar(255) NULL,
	`sortfields` varchar(255) NULL,
	`ordering` int(11) NOT NULL default '0',
	`col1title` varchar(255) default NULL,
	`col1enabled` tinyint(1) NOT NULL default '0',
	`col1fields` mediumtext,
	`col2title` varchar(255) default NULL,
	`col2enabled` tinyint(1) NOT NULL default '0',
	`col1captions` tinyint(1) NOT NULL default '0',
	`col2fields` mediumtext,
	`col2captions` tinyint(1) NOT NULL default '0',
	`col3title` varchar(255) default NULL,
	`col3enabled` tinyint(1) NOT NULL default '0',
	`col3fields` mediumtext,
	`col3captions` tinyint(1) NOT NULL default '0',
	`col4title` varchar(255) default NULL,
	`col4enabled` tinyint(1) NOT NULL default '0',
	`col4fields` mediumtext,
	`col4captions` tinyint(1) NOT NULL default '0',
	PRIMARY KEY  (`listid`)
) ENGINE=MyISAM AUTO_INCREMENT=4;

CREATE TABLE IF NOT EXISTS `#__comprofiler_tabs` (
	`tabid` int(11) NOT NULL auto_increment,
	`title` varchar(50) NOT NULL default '',
	`description` text,
	`ordering` int(11) NOT NULL default '0',
	`width` VARCHAR( 10 ) DEFAULT '.5' NOT NULL ,
	`enabled` TINYINT( 1 ) DEFAULT '1' NOT NULL , 
	`plugin` VARCHAR( 255 ) DEFAULT NULL ,
	`sys` tinyint(4) NOT NULL default '0',
	PRIMARY KEY  (`tabid`)
) ENGINE=MyISAM AUTO_INCREMENT=11;

CREATE TABLE IF NOT EXISTS `#__comprofiler_userreports` (
	`reportid` int(11) NOT NULL auto_increment,
	`reporteduser` int(11) NOT NULL default '0',
	`reportedbyuser` int(11) NOT NULL default '0',
	`reportedondate` date NOT NULL default '0000-00-00',
	`reportexplaination` text NOT NULL,
	`reportedstatus` tinyint(4) NOT NULL default '0',
	PRIMARY KEY  (`reportid`)
) ENGINE=MyISAM AUTO_INCREMENT=11;

CREATE TABLE IF NOT EXISTS `#__comprofiler_members` (
	`referenceid` int(11) NOT NULL default '0',
	`memberid` int(11) NOT NULL default '0',
	`accepted` tinyint(1) NOT NULL default '1',
	`pending` tinyint(1) NOT NULL default '0',
	`membersince` date NOT NULL default '0000-00-00',
	`description` varchar(255) default NULL,
	`type` MEDIUMTEXT default NULL,
	PRIMARY KEY  (`referenceid`,`memberid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__comprofiler_views` (
	`viewer_id` int(11) NOT NULL default '0',
	`profile_id` int(11) NOT NULL default '0',
	`lastip` varchar(50) NOT NULL default '',
	`lastview` datetime NOT NULL default '0000-00-00 00:00:00',
	`viewscount` int(11) NOT NULL default '0',
	`vote` tinyint(3) default NULL,
	`lastvote` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (`viewer_id`,`profile_id`,`lastip`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__comprofiler_plugin` (
	`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
	`name` varchar( 100 ) NOT NULL default '',
	`element` varchar( 100 ) NOT NULL default '',
	`type` varchar( 100 ) NULL default '',
	`folder` varchar( 100 ) NULL default '',
	`access` tinyint( 3 ) unsigned NOT NULL default '0',
	`ordering` int( 11 ) NOT NULL default '0',
	`published` tinyint( 3 ) NOT NULL default '0',
	`iscore` tinyint( 3 ) NOT NULL default '0',
	`client_id` tinyint( 3 ) NOT NULL default '0',
	`checked_out` int( 11 ) unsigned NOT NULL default '0',
	`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
	`params` text NOT NULL ,
	PRIMARY KEY ( `id` ) ,
	KEY `idx_folder` ( `published` , `client_id` , `access` , `folder` )
) ENGINE=MyISAM AUTO_INCREMENT=500;

INSERT IGNORE INTO `#__comprofiler_fields` (`fieldid`, `name`, `table`, `title`, `type`, `maxlength`, `size`, `required`, `tabid`, `ordering`, `cols`, `rows`, `value`, `default`, `published`, `registration`, `profile`, `calculated`, `sys`) 
VALUES (41, 'name', '#__users', '_UE_NAME', 'predefined', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(26, 'NA', '#__comprofiler', '_UE_ONLINESTATUS', 'status', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(27, 'lastvisitDate', '#__users', '_UE_LASTONLINE', 'date', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(28, 'registerDate', '#__users', '_UE_MEMBERSINCE', 'date', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(29, 'avatar', '#__comprofiler', '_UE_IMAGE', 'image', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(42, 'username', '#__users', '_UE_UNAME', 'predefined', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1), 
		(45, 'NA', '#__comprofiler', '_UE_FORMATNAME', 'formatname', NULL , NULL , 0, NULL , NULL , NULL , NULL , NULL , NULL , 1, 0, 1, 1, 1),
		(46, 'firstname', '#__comprofiler', '_UE_YOUR_FNAME', 'predefined', NULL, NULL, 0, NULL , NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1),
		(47, 'middlename', '#__comprofiler', '_UE_YOUR_MNAME', 'predefined', NULL, NULL, 0, NULL , NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1),
		(48, 'lastname', '#__comprofiler', '_UE_YOUR_LNAME', 'predefined', NULL, NULL, 0, NULL , NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1),
		(49, 'lastupdatedate', '#__comprofiler', '_UE_LASTUPDATEDON', 'date', NULL , NULL , 0, NULL , NULL , NULL , NULL , NULL , NULL , 1, 0, 1, 1, 1),
		(50, 'email', '#__users', '_UE_EMAIL', 'primaryemailaddress', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1);

INSERT IGNORE INTO #__comprofiler (id,user_id) SELECT id,id FROM #__users;

INSERT IGNORE INTO `#__comprofiler_plugin` (`id`, `name`, `element`, `type`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) 
VALUES (1, 'CB Core', 'cb.core', 'user', 'plug_cbcore', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(2, 'CB Connections', 'cb.connections', 'user', 'plug_cbconnections', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(3, 'Content Author', 'cb.authortab', 'user', 'plug_cbmamboauthortab', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(4, 'Forum integration', 'cb.simpleboardtab', 'user', 'plug_cbsimpleboardtab', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(5, 'Mamblog Blog', 'cb.mamblogtab', 'user', 'plug_cbmamblogtab', 0, 6, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(6, 'YaNC Newsletters', 'yanc', 'user', 'plug_yancintegration', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''), 
		(7, 'Default', 'default', 'templates', 'default', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(8, 'WinClassic', 'winclassic', 'templates', 'winclassic', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(9, 'WebFX', 'webfx', 'templates', 'webfx', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(10, 'OSX', 'osx', 'templates', 'osx', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(11, 'Luna', 'luna', 'templates', 'luna', 0, 5, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(12, 'Dark', 'dark', 'templates', 'dark', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(13, 'Default language (English)', 'default_language', 'language', 'default_language', 0, -1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(14, 'CB Menu', 'cb.menu', 'user', 'plug_cbmenu', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
		(15, 'PMS MyPMS and Pro', 'pms.mypmspro', 'user', 'plug_pms_mypmspro', 0, 8, 0, 1, 0, 0, '0000-00-00 00:00:00', '');

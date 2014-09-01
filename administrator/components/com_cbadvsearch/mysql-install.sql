DROP TABLE IF EXISTS `#__cbadvsearch`;

CREATE TABLE `#__cbadvsearch` (
  `id` int(11) NOT NULL auto_increment,
  `field_id` varchar(50) null default null comment 'the ids of the used field',
  `label` varchar(50) null default null comment 'the label of the field',
  `published` tinyint(1) NOT NULL default '1' comment 'it appeares in the search or not',
  `searchable` tinyint(1) NOT NULL default '1' comment 'it appeares in the search fields and/or in the results',
  `appears_results` TINYINT(1) NOT NULL DEFAULT '1' comment 'it appeares in the search results',
  `ordering` int(11) NOT NULL,
  `description` varchar(250) NULL default NULL comment 'the description of the field',
  `thesearch` SMALLINT(3) NOT NULL DEFAULT '1' COMMENT 'the search the field is included',
  `comparison_sign` char(5) NULL DEFAULT '=' COMMENT 'the comparison sign of the search: =, <, >, like',
  `fill_in_text` varchar(20) NULL DEFAULT '' COMMENT 'the text that appears inside a textfield or textarea',
  `css_class` varchar(20) NULL DEFAULT null COMMENT 'the css class for the result column',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearchsdesc`;

CREATE TABLE `#__cbadvsearchsdesc` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(250) NULL default NULL comment 'the description of the search',
  `listing` tinyint(1) not NULL default '0' comment 'listing the results: 0 = vertical, 1 = horizontal',
  `searches` SMALLINT(3) NOT NULL DEFAULT '1' COMMENT 'number of searches',
  `empty_fields` tinyint(1) not NULL default '1' comment 'if 1 the it appears the option for the frontend to list the empty fields or not',
  `order_by` varchar(50) not NULL default 'id asc' comment 'the order of the search: random or asc/desc by a field',
  `show_order_by` tinyint(1) not NULL default '1' comment 'show the order by field in the frontend',
  `show_avatar` tinyint(1) not NULL default '1' comment 'show the avatar in the results list',
  `show_numbers` tinyint(1) not NULL default '1' comment 'show the numbers in the results list',
  `user_groups` varchar(250) NULL default NULL comment 'the user groups you want to search',
  `show_the_searchfield` tinyint(1) not NULL default '1' comment '1 for show the search field yes, 0 for no',
  `search_by_fields_or_cblists` tinyint(1) not NULL default '0' comment '0 for search by fiels, 1 for search by list',
  `cblist_id` int(10) unsigned not NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearchconfig`;

CREATE TABLE `#__cbadvsearchconfig` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearchlanguages`;

CREATE TABLE if not exists `#__cbadvsearchlanguages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `iso` varchar(20) DEFAULT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `shortcode` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `fallback_code` varchar(20) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearch_forms_saved`;

CREATE TABLE `#__cbadvsearch_forms_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) NOT NULL,
  `cb_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `default_form` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unic` (`form_name`,`cb_user_id`),
  KEY `name` (`form_name`),
  KEY `owner` (`cb_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearch_forms_saved_items`;

CREATE TABLE `#__cbadvsearch_forms_saved_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` varchar(255) NOT NULL,
  `cb_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cb_field_name` char(30) not null,
  `cb_field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unic` (`form_id`,`cb_user_id`),
  KEY `form_id` (`form_id`),
  KEY `owner` (`cb_user_id`),
  KEY `field_name` (`cb_field_name`),
  KEY `field_value` (`cb_field_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearch_result_list_ignored`;

CREATE TABLE `#__cbadvsearch_result_list_ignored` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cb_user_owner_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cb_user_ignored_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unic` (`cb_user_owner_id`,`cb_user_ignored_id`),
  KEY `owner` (`cb_user_owner_id`),
  KEY `ignored` (`cb_user_ignored_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearch_result_list_saved`;

CREATE TABLE `#__cbadvsearch_result_list_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL,
  `cb_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unic` (`list_name`,`cb_user_id`),
  KEY `cb_user_id` (`cb_user_id`),
  KEY `list_name` (`list_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__cbadvsearch_result_list_saved_items`;

CREATE TABLE `#__cbadvsearch_result_list_saved_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cb_search_list_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cb_user_owner_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cb_user_found_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unic` (`cb_search_list_id`,`cb_user_owner_id`,`cb_user_found_id`),
  KEY `list` (`cb_search_list_id`),
  KEY `owner` (`cb_user_owner_id`),
  KEY `found` (`cb_user_found_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

<?php
/**
* Joomla/Mambo Community Builder
* @version $Id: install.comprofiler.php 1828 2012-09-26 14:19:29Z beat $
* @package Community Builder
* @subpackage install.comprofiler.php
* @author JoomlaJoe and Beat
* @copyright (C) JoomlaJoe and Beat, www.joomlapolis.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// Ensure is being included by Joomla installer and not accessed directly:
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

// Try to set timeout limit and memory limit to ensure a complete install as could take awhile:
@set_time_limit( 240 );

$memMax				=	trim( @ini_get( 'memory_limit' ) );

if ( $memMax ) {
	$last			=	strtolower( $memMax{strlen( $memMax ) - 1} );

	switch( $last ) {
		case 'g':
			$memMax	*=	1024;
		case 'm':
			$memMax	*=	1024;
		case 'k':
			$memMax	*=	1024;
	}

	if ( $memMax < 16000000 ) {
		@ini_set( 'memory_limit', '16M' );
	}

	if ( $memMax < 32000000 ) {
		@ini_set( 'memory_limit', '32M' );
	}

	if ( $memMax < 48000000 ) {
		@ini_set( 'memory_limit', '48M' );
	}

	if ( $memMax < 64000000 ) {
		@ini_set( 'memory_limit', '64M' );
	}

	if ( $memMax < 80000000 ) {
		@ini_set( 'memory_limit', '80M' );
	}
}

ignore_user_abort( true );

// Define J1.6 and greater installer class; does nothing on other versions:
class Com_ComprofilerInstallerScript {

	public function install( $parent ) {
		return com_install();
	}

	public function discover_install( $parent ) {
		return $this->install( $parent );
	}

	public function update( $parent ) {
		return $this->install( $parent );
	}

	public function preflight( $type, $parent ) {
		// Fix "Can not build admin menus" error on upgrades:
		if ( ! in_array($type, array( 'install', 'discover_install' ) ) ) {
			$db			=	JFactory::getDbo();

			$query		=	$db->getQuery( true );
			$query->select( 'id' );
			$query->from( '#__menu' );
			$query->where( $db->qn( 'type' ) . ' = ' . $db->q( 'component' ) );
			$query->where( $db->qn( 'menutype' ) . ' = ' . $db->q( 'main' ) );
			$query->where( $db->qn( 'client_id' ) . ' = ' . $db->q( '1' ) );
			$query->where( $db->qn( 'link' ) .' LIKE ' . $db->q( 'index.php?option=com_comprofiler%' ) );
			$db->setQuery( $query );
			$ids		=	$db->loadColumn();

			if ( $ids ) foreach( $ids as $id ) {
				$query	=	$db->getQuery( true );
				$query->delete( '#__menu' );
				$query->where( $db->qn( 'id' ) . ' = ' . $db->q( $id ) );
				$db->setQuery( $query );
				$db->query();
			}
		}
	}
}

function cbInstaller_field_exists( $table, $field ) {
	global $_CB_database;

	static $cache			=	array();

	if ( ! isset( $cache[$table] ) ) {
		$tableDesc			=	$_CB_database->getTableFields( array( $table ) );

		if ( isset( $tableDesc[$table] ) && is_array( $tableDesc[$table] ) ) {
			$cache[$table]	=	$tableDesc[$table];
		}
	}

	if ( isset( $cache[$table] ) ) {
		return isset( $cache[$table][$field] );
	}

	return false;
}

// Complete install and upgrade of CB component:
function com_install() {
	global $_CB_framework, $_CB_database, $_CB_adminpath, $ueConfig, $mainframe;

	// Ensure PHP version is adaquete for CB:
	if ( version_compare( phpversion(), '5.0.0', '<' ) ) {
		echo '<div class="cbError error" style="font-size:120%;color:red;font-weight:bold;margin-bottom:20px;">' . htmlspecialchars( sprintf( "As stated in README and prerequisites list, PHP Version %s, which is obsolete since 2008-08-08 and insecure, is not compatible with %s: Please upgrade to PHP %s or greater (CB is also compatible with PHP 5.3.x) as soon as possible.", phpversion(), 'Community Builder', sprintf( "at least version %s, recommended version %s", '5.0.0', '5.2.6' ) ) ) . '</div>';
		echo '<div class="cbError error" style="font-size:140%;color:red;font-weight:bold;">' . htmlspecialchars( sprintf( 'Installation failed. In all cases, please require your hoster to upgrade your PHP version as soon as possible.' ) ) . '</div>';
		return;
	}

	// Determine path to CBs backend file structure:
	if ( defined( 'JPATH_ADMINISTRATOR' ) ) {
		$_CB_adminpath						=	JPATH_ADMINISTRATOR . '/components/com_comprofiler/';
	} else {
		$_CB_adminpath						=	$mainframe->getCfg( 'absolute_path' ). '/administrator/components/com_comprofiler/';
	}

	// CB Configuration missing; try to copy default:
	if ( ! file_exists( $_CB_adminpath . 'ue_config.php' ) ) {
		include_once( $_CB_adminpath . 'library/cb/cb.adminfilesystem.php');

		$adminFS							=&	cbAdminFileSystem::getInstance();

		if ( ! $adminFS->copy( $_CB_adminpath . 'ue_config_first.php', $_CB_adminpath . 'ue_config.php' ) ) {
			echo sprintf( 'Error copying initial configuration file in place from %s to %s', $_CB_adminpath . 'ue_config_first.php', $_CB_adminpath . 'ue_config.php' ) . "<br /><br />\n";
			return;
		}
	}

	include_once( $_CB_adminpath . 'plugin.foundation.php' );

	// Set location to backend:
	$_CB_framework->cbset( '_ui', 2 );

	if ( $_CB_framework->getCfg( 'debug' ) ) {
		ini_set( 'display_errors', true );
		error_reporting( E_ALL );
	}

	// Load in CB API:
	cbimport( 'cb.tabs' );
	cbimport( 'cb.adminfilesystem' );
	cbimport( 'cb.xml.simplexml' );
	cbimport( 'cb.dbchecker' );

	// Define CB backend filesystem API:
	$adminFS								=&	cbAdminFileSystem::getInstance();

	// If J1.6 or greater ensure XML and backend root component file is present:
	if ( checkJversion() >= 2 ) {
		if ( ! $adminFS->copy( $_CB_adminpath . 'comprofileg.xml', $_CB_adminpath . 'comprofiler.xml' ) ) {
			echo sprintf( 'Error copying initial xml file in place from %s to %s', $_CB_adminpath . 'comprofileg.xml', $_CB_adminpath . 'comprofiler.xml' ) . "<br /><br />\n";
			return false;
		}

		if ( ! $adminFS->copy( $_CB_adminpath . 'admin.comprofiler.php', $_CB_adminpath . 'comprofiler.php' ) ) {
			echo sprintf( 'Error copying admin file in place from %s to %s', $_CB_adminpath . 'admin.comprofiler.php', $_CB_adminpath . 'comprofiler.php' ) . "<br /><br />\n";
			return false;
		}
	}

	$return									=	'<div style="text-align:left;margin-bottom:10px;">'
											.		'<table width="100%" border="0">'
											.			'<tr>'
											.				'<td>'
											.					'<img alt="CB Logo" src="../components/com_comprofiler/images/smcblogo.gif" />'
											.				'</td>'
											.			'</tr>'
											.			'<tr>'
											.				'<td>'
											.					'<br />Copyright 2004-2013 MamboJoe/JoomlaJoe, Beat and CB team on joomlapolis.com . This component is released under the GNU/GPL version 2 License. All copyright statements must be kept. Derivate work must prominently duly acknowledge original work and include visible online links. Official site: <a href="http://www.joomlapolis.com">www.joomlapolis.com</a><br />'
											.				'</td>'
											.			'</tr>'
											.			'<tr>'
											.				'<td style="background-color:#F0F0F0;" colspan="2">'
											.					'<div>';

	// Fix admin menu links:
	if ( checkJversion() >= 2 ) {
		$query								=	'SELECT ' . $_CB_database->NameQuote( 'extension_id' )
											.	"\n FROM " . $_CB_database->NameQuote( '#__extensions' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'type' ) . " = " . $_CB_database->Quote( 'component' )
											.	"\n AND " . $_CB_database->NameQuote( 'element' ) . " = " . $_CB_database->Quote( 'com_comprofiler' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'extension_id' ) . " DESC";
		$_CB_database->setQuery( $query, 0, 1 );
		$componentId						=	$_CB_database->loadResult();

		if ( $componentId ) {
			$query							=	'UPDATE ' . $_CB_database->NameQuote( '#__menu' )
											.	"\n SET " . $_CB_database->NameQuote( 'component_id' ) . " = " . (int) $componentId
											.	"\n WHERE " . $_CB_database->NameQuote( 'type' ) . " = " . $_CB_database->Quote( 'component' )
											.	"\n AND " . $_CB_database->NameQuote( 'link' ) . " LIKE " . $_CB_database->Quote( '%option=com_comprofiler%' );
			$_CB_database->setQuery( $query );
			$_CB_database->query();
		}
	} elseif ( checkJversion() <= 1 ) {
		$iconResults						=	array();

		// Userlist Management icon:
		if ( checkJversion() >= 1 ) {
			$icon							=	'js/ThemeOffice/static.png';
		} else {
			$icon							=	'js/ThemeOffice/content.png';
		}

		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( $icon )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showLists' );
		$_CB_database->setQuery( $query );
		$iconResults[0]						=	$_CB_database->query();

		// Field Management icon:
		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( 'js/ThemeOffice/content.png' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showField' );
		$_CB_database->setQuery( $query );
		$iconResults[1]						=	$_CB_database->query();

		// Tab Management iocn:
		if ( checkJversion() >= 1 ) {
			$icon							=	'js/ThemeOffice/article.png';
		} else {
			$icon							=	'js/ThemeOffice/content.png';
		}

		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( $icon )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showTab' );
		$_CB_database->setQuery( $query );
		$iconResults[2]						=	$_CB_database->query();

		// Configuration icon:
		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( 'js/ThemeOffice/config.png' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showconfig' );
		$_CB_database->setQuery( $query );
		$iconResults[3]						=	$_CB_database->query();

		// User Management icon:
		if ( checkJversion() >= 1 ) {
			$icon							=	'js/ThemeOffice/user.png';
		} else {
			$icon							=	'js/ThemeOffice/users.png';
		}

		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( $icon )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showusers' );
		$_CB_database->setQuery( $query );
		$iconResults[4]						=	$_CB_database->query();

		// Plugin Management icon:
		if ( checkJversion() >= 1 ) {
			$icon							=	'js/ThemeOffice/plugin.png';
		} else {
			$icon							=	'js/ThemeOffice/install.png';
		}

		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( $icon )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler&task=showPlugins' );
		$_CB_database->setQuery( $query );
		$iconResults[5]						=	$_CB_database->query();

		// Community Builder icon:
		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__components' )
											.	"\n SET " . $_CB_database->NameQuote( 'admin_menu_img' ) . " = " . $_CB_database->Quote( '../components/com_comprofiler/plugin/templates/luna/images/header/icon-16-cb.png' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'admin_menu_link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler' );
		$_CB_database->setQuery( $query );
		$iconResults[6]						=	$_CB_database->query();

		foreach ( $iconResults as $i => $iconResult ) {
			if ( ! $iconResult ) {
				$return						.=						'<span style="color:red;">ERROR:</span> Image of administration menu entry $i could not be corrected.<br />';
			}
		}

		// Delete invalid components:
		$query								=	'SELECT COUNT(*)'
											.	"\n FROM " . $_CB_database->NameQuote( '#__components' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler' );
		$_CB_database->setQuery( $query );
		$components							=	$_CB_database->loadResult();

		if ( $components >= 1 ) {
			$query							=	'SELECT ' . $_CB_database->NameQuote( 'id' )
											.	"\n FROM " . $_CB_database->NameQuote( '#__components' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'id' ) . " DESC";
			$_CB_database->setQuery( $query, 0, 1 );
			$componentId					=	$_CB_database->loadResult();

			if ( $componentId ) {
				$query						=	'DELETE '
											.	"\n FROM " . $_CB_database->NameQuote( '#__components' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'link' ) . " = " . $_CB_database->Quote( 'option=com_comprofiler' )
											.	"\n AND " . $_CB_database->NameQuote( 'id' ) . " != " . (int) $componentId;
				$_CB_database->setQuery( $query );
				$_CB_database->query();

				$query						=	'DELETE '
											.	"\n FROM " . $_CB_database->NameQuote( '#__components' )
											.	"\n WHERE " . $_CB_database->NameQuote( 'option' ) . " = " . $_CB_database->Quote( 'com_comprofiler' )
											.	"\n AND " . $_CB_database->NameQuote( 'id' ) . " != " . (int) $componentId
											.	"\n AND " . $_CB_database->NameQuote( 'parent' ) . " != " . (int) $componentId;
				$_CB_database->setQuery( $query );
				$_CB_database->query();

				$query						=	'UPDATE ' . $_CB_database->NameQuote( '#__menu' )
											.	"\n SET " . $_CB_database->NameQuote( 'componentid' ) . " = " . (int) $componentId
											.	"\n WHERE " . $_CB_database->NameQuote( 'type' ) . " = " . $_CB_database->Quote( 'component' )
											.	"\n AND " . $_CB_database->NameQuote( 'link' ) . " LIKE " . $_CB_database->Quote( '%option=com_comprofiler%' );
				$_CB_database->setQuery( $query );
				$_CB_database->query();
			}

			$return							.=						'<span style="color:green;">Administrator and frontend menus corrected.</span><br />';
		}
	}

	$dbUpgrades								=	array();

	// Beta 3 upgrades:
	$dbUpgrades[0]['test']					=	array( 'default', '#__comprofiler_lists' );
	$dbUpgrades[0]['updates'][0]			=	"ALTER TABLE `#__comprofiler_lists`"
											.	"\n ADD `default` TINYINT( 1 ) DEFAULT '0' NOT NULL,"
											.	"\n ADD `usergroupids` VARCHAR( 255 ),"
											.	"\n ADD `sortfields` VARCHAR( 255 ),"
											.	"\n ADD `ordering` INT( 11 ) DEFAULT '0' NOT NULL AFTER `published`";
	$dbUpgrades[0]['updates'][1]			=	"UPDATE #__comprofiler_lists SET `default`=1 WHERE published =1";
	$dbUpgrades[0]['updates'][2]			=	"UPDATE #__comprofiler_lists SET usergroupids = '29, 18, 19, 20, 21, 30, 23, 24, 25', sortfields = '`username` ASC'";
	$dbUpgrades[0]['updates'][3]			=	"ALTER TABLE `#__comprofiler` ADD `acceptedterms` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `bannedreason`";
	$dbUpgrades[0]['message']				=	"1.0 Beta 2 to 1.0 Beta 3";

	// Beta 4 upgrades:
	$dbUpgrades[1]['test']					=	array( 'firstname', '#__comprofiler' );
	$dbUpgrades[1]['updates'][0]			=	"ALTER TABLE #__comprofiler ADD `firstname` VARCHAR( 100 ) AFTER `user_id` ,"
											.	"\n ADD `middlename` VARCHAR( 100 ) AFTER `firstname` ,"
											.	"\n ADD `lastname` VARCHAR( 100 ) AFTER `middlename` ";
	$dbUpgrades[1]['updates'][1]			=	"ALTER TABLE `#__comprofiler_fields` ADD `readonly` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `profile`";
	$dbUpgrades[1]['updates'][3]			=	"ALTER TABLE `#__comprofiler_tabs` ADD `width` VARCHAR( 10 ) DEFAULT '.5' NOT NULL AFTER `ordering` ,"
											.	"\n ADD `enabled` TINYINT( 1 ) DEFAULT '1' NOT NULL AFTER `width` ,"
											.	"\n ADD `plugin` VARCHAR( 255 ) DEFAULT NULL AFTER `enabled`" ;
	$dbUpgrades[1]['message']				=	"1.0 Beta 3 to 1.0 Beta 4";

	// RC 1 upgrades:
	$dbUpgrades[2]['test']					=	array( 'fields', '#__comprofiler_tabs' );
	$dbUpgrades[2]['updates'][0]			=	"ALTER TABLE #__comprofiler_tabs ADD `plugin_include` VARCHAR( 255 ) AFTER `plugin` ,"
											.	"\n ADD `fields` TINYINT( 1 ) DEFAULT '1' NOT NULL AFTER `plugin_include` ";
	$dbUpgrades[2]['updates'][1]			=	"INSERT INTO `#__comprofiler_tabs` ( `title`, `description`, `ordering`, `width`, `enabled`, `plugin`, `plugin_include`, `fields`, `sys`) VALUES "
											.	"\n ( '_UE_CONTACT_INFO_HEADER', '', -4, '1', 1, 'getContactTab', NULL, 1, 1),"
											.	"\n ( '_UE_AUTHORTAB', '', -3, '1', 0, 'getAuthorTab', NULL, 0, 1),"
											.	"\n ( '_UE_FORUMTAB', '', -2, '1', 0, 'getForumTab', NULL, 0, 1),"
											.	"\n ( '_UE_BLOGTAB', '', -1, '1', 0, 'getBlogTab', NULL, 0, 1);";
	$dbUpgrades[2]['updates'][2]			=	"ALTER TABLE `#__comprofiler_lists` ADD `filterfields` VARCHAR( 255 ) AFTER `sortfields`;";
	$dbUpgrades[2]['message']				=	"1.0 Beta 4 to 1.0 RC 1";

	// RC 2 Part 1 upgrades:
	$dbUpgrades[3]['test']					=	array( 'description', '#__comprofiler_fields' );
	$dbUpgrades[3]['updates'][0]			=	"ALTER TABLE `#__comprofiler_fields` ADD `description` MEDIUMTEXT  NOT NULL default '' AFTER `title` ";
	$dbUpgrades[3]['updates'][1]			=	"ALTER TABLE `#__comprofiler_fields` CHANGE `title` `title` VARCHAR( 255 ) NOT NULL";
	$dbUpgrades[3]['updates'][2]			=	"INSERT INTO `#__comprofiler_tabs` (`title`, `description`, `ordering`, `width`, `enabled`, `plugin`, `plugin_include`, `fields`, `sys`) VALUES "
											.	"\n ( '_UE_CONNECTION', '',99, '1', 0, 'getConnectionTab', NULL, 0, 1);";
	$dbUpgrades[3]['updates'][3]			=	"INSERT INTO `#__comprofiler_tabs` (`title`, `description`, `ordering`, `width`, `enabled`, `plugin`, `plugin_include`, `fields`, `sys`) VALUES "
											.	"\n ( '_UE_NEWSLETTER_HEADER', '_UE_NEWSLETTER_INTRODCUTION', 99, '1', 0, 'getNewslettersTab', NULL, 0, 1);";
	$dbUpgrades[3]['updates'][4]			=	"UPDATE `#__comprofiler_tabs` SET sys=2, enabled=1 WHERE plugin='getContactTab' ";
	$dbUpgrades[3]['updates'][5]			=	"ALTER TABLE `#__comprofiler_lists` ADD `useraccessgroupid` INT( 9 ) DEFAULT '18' NOT NULL AFTER `usergroupids` ";
	$dbUpgrades[3]['message']				=	"1.0 RC 1 to 1.0 RC 2 part 1";

	// RC 2 Part 2 upgrades:
	$dbUpgrades[4]['test']					=	array( 'params', '#__comprofiler_tabs' );
	$dbUpgrades[4]['updates'][0]			=	"ALTER TABLE `#__comprofiler_tabs` CHANGE `plugin` `pluginclass` VARCHAR( 255 ) DEFAULT NULL , "
											.	"\n CHANGE `plugin_include` `pluginid` INT( 11 ) DEFAULT NULL ";
	$dbUpgrades[4]['updates'][1]			=	"ALTER TABLE `#__comprofiler_tabs` ADD `params` MEDIUMTEXT AFTER `fields` ;";
	$dbUpgrades[4]['updates'][2]			=	"ALTER TABLE `#__comprofiler_fields` ADD `pluginid` INT( 11 ) , "
											.	"\n ADD `params` MEDIUMTEXT; ";
	$dbUpgrades[4]['updates'][3]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=1 WHERE pluginclass='getContactTab' ";
	$dbUpgrades[4]['updates'][4]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=1 WHERE pluginclass='getConnectionTab' ";
	$dbUpgrades[4]['updates'][5]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=3 WHERE pluginclass='getAuthorTab' ";
	$dbUpgrades[4]['updates'][6]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=4 WHERE pluginclass='getForumTab' ";
	$dbUpgrades[4]['updates'][7]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=5 WHERE pluginclass='getBlogTab' ";
	$dbUpgrades[4]['updates'][8]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=6 WHERE pluginclass='getNewslettersTab' ";
	$dbUpgrades[4]['message']				=	"1.0 RC 1 to 1.0 RC 2 part 2";

	// RC 2 Part 3 upgrades:
	$dbUpgrades[5]['test']					=	array( 'position', '#__comprofiler_tabs' );
	$dbUpgrades[5]['updates'][1]			=	"ALTER TABLE `#__comprofiler_tabs`"
											.	"\n ADD `position` VARCHAR( 255 ) DEFAULT '' NOT NULL,"
											.	"\n ADD `displaytype` VARCHAR( 255 ) DEFAULT '' NOT NULL AFTER `sys`";
	$dbUpgrades[5]['updates'][2]			=	"UPDATE `#__comprofiler_tabs` SET position='cb_tabmain', displaytype='tab' ";
	$dbUpgrades[5]['updates'][3]			=	"INSERT INTO `#__comprofiler_tabs` (`title`, `description`, `ordering`, `width`, `enabled`, `pluginclass`, `pluginid`, `fields`, `sys`, `position`, `displaytype`) VALUES "
											.	"\n ( '_UE_MENU', '', -10, '1', 1, 'getMenuTab', 14, 0, 1, 'cb_head', 'html'),"
											.	"\n ( '_UE_CONNECTIONPATHS', '', -9, '1', 1, 'getConnectionPathsTab', 2, 0, 1, 'cb_head', 'html'),"
											.	"\n ( '_UE_PROFILE_PAGE_TITLE', '', -8, '1', 1, 'getPageTitleTab', 1, 0, 1, 'cb_head', 'html'),"
											.	"\n ( '_UE_PORTRAIT', '', -7, '1', 1, 'getPortraitTab', 1, 0, 1, 'cb_middle', 'html'),"
											.	"\n ( '_UE_USER_STATUS', '', -6, '.5', 1, 'getStatusTab', 14, 0, 1, 'cb_right', 'html'),"
											.	"\n ( '_UE_PMSTAB', '', -5, '.5', 0, 'getmypmsproTab', 15, 0, 1, 'cb_right', 'html');";
	$dbUpgrades[5]['updates'][5]			=	"UPDATE `#__comprofiler_tabs` SET pluginid=2 WHERE pluginclass='getConnectionTab' ";
	$dbUpgrades[5]['updates'][6]			=	"ALTER TABLE `#__comprofiler_members` ADD `reason` MEDIUMTEXT default NULL AFTER `membersince` ";
	$dbUpgrades[5]['updates'][7]			=	"UPDATE `#__comprofiler_tabs` SET `pluginclass`=NULL, `pluginid`=NULL WHERE `pluginclass` != 'getContactTab' AND `fields` = 1";
	$dbUpgrades[5]['message']				=	"1.0 RC 1 to 1.0 RC 2 part 3";

	// 1.0.2 upgrades:
	$dbUpgrades[6]['test']					=	array( 'cbactivation', '#__comprofiler' );
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_fields` CHANGE `default` `default` MEDIUMTEXT DEFAULT NULL;";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_fields` CHANGE `tabid` `tabid` int(11) DEFAULT NULL;";

	if ( checkJversion() < 2 ) {
		$dbUpgrades[6]['updates'][]			=	"UPDATE `#__users` SET usertype='Registered' WHERE usertype='';";
	}

	$dbUpgrades[6]['updates'][]				=	"UPDATE `#__comprofiler_fields` SET `table`='#__users' WHERE name='email';";
	$dbUpgrades[6]['updates'][]				=	"UPDATE `#__comprofiler_fields` SET `table`='#__users' WHERE name='lastvisitDate';";
	$dbUpgrades[6]['updates'][]				=	"UPDATE `#__comprofiler_fields` SET `table`='#__users' WHERE name='registerDate';";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE #__comprofiler ADD `registeripaddr` VARCHAR( 50 ) DEFAULT '' NOT NULL AFTER `lastupdatedate`;";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE #__comprofiler ADD `cbactivation` VARCHAR( 50 ) DEFAULT '' NOT NULL AFTER `registeripaddr`;";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE #__comprofiler ADD `message_last_sent` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `hits`;";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE #__comprofiler ADD `message_number_sent` INT( 11 ) DEFAULT 0 NOT NULL AFTER `message_last_sent`;";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_field_values` ADD INDEX fieldid_ordering (`fieldid`, `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_fields` ADD INDEX `tabid_pub_prof_order` ( `tabid` , `published` , `profile` , `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_fields` ADD INDEX `readonly_published_tabid` ( `readonly` , `published` , `tabid` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_fields` ADD INDEX `registration_published_order` ( `registration` , `published` , `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_members` ADD INDEX `pamr` ( `pending` , `accepted` , `memberid` , `referenceid` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_members` ADD INDEX `aprm` ( `accepted` , `pending` , `referenceid` , `memberid` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_members` ADD INDEX `membrefid` ( `memberid` , `referenceid` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_plugin` ADD INDEX `type_pub_order` ( `type` , `published` , `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_tabs` ADD INDEX `enabled_position_ordering` ( `enabled` , `position` , `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_lists` ADD INDEX `pub_ordering` ( `published` , `ordering` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_lists` ADD INDEX `default_published` ( `default` , `published` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_userreports` ADD INDEX `status_user_date` ( `reportedstatus` , `reporteduser` , `reportedondate` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_userreports` ADD INDEX `reportedbyuser_ondate` ( `reportedbyuser` , `reportedondate` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_views` ADD INDEX `lastview` ( `lastview` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler_views` ADD INDEX `profile_id_lastview` (`profile_id`,`lastview`);";
	$dbUpgrades[6]['updates'][]				=	"UPDATE `#__comprofiler` SET `user_id`=`id` WHERE 1>0;";	// fix in case something corrupt for unique key
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD UNIQUE KEY user_id (`user_id`);";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD INDEX `apprconfbanid` ( `approved` , `confirmed` , `banned` , `id` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD INDEX `avatappr_apr_conf_ban_avatar` ( `avatarapproved` , `approved` , `confirmed` , `banned` , `avatar` );";
	$dbUpgrades[6]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD INDEX `lastupdatedate` ( `lastupdatedate` );";
	$dbUpgrades[6]['message']				=	"1.0 RC 2, 1.0 and 1.0.1 to 1.0.2";

	// 1.1 upgrades:
	$dbUpgrades[7]['test']					=	array( 'ordering_register', '#__comprofiler_tabs' );
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler_plugin` ADD `backend_menu` VARCHAR(255) NOT NULL DEFAULT '' AFTER `folder`;";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler_tabs` ADD `ordering_register` int(11) NOT NULL DEFAULT 10 AFTER `ordering`;";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler_tabs` ADD `useraccessgroupid` int(9) DEFAULT -2 NOT NULL AFTER `position`;";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler_tabs` ADD INDEX `orderreg_enabled_pos_order` ( `enabled` , `ordering_register` , `position` , `ordering` );";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD `unbannedby` int(11) default NULL AFTER `bannedby`;";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler` ADD `unbanneddate` datetime default NULL AFTER `banneddate`;";
	$dbUpgrades[7]['updates'][]				=	"ALTER TABLE `#__comprofiler_field_values` CHANGE `fieldtitle` `fieldtitle` VARCHAR(255) NOT NULL DEFAULT '';";
	$dbUpgrades[7]['message']				=	"1.0.2 to 1.1";

	// Perform database upgrades:
	foreach ( $dbUpgrades as $dbUpgrade ) {
		if ( ! cbInstaller_field_exists( $dbUpgrade['test'][1], $dbUpgrade['test'][0] ) ) {
			foreach( $dbUpgrade['updates'] as $query ) {
				$_CB_database->setQuery( $query );

				if ( ! $_CB_database->query() ) {
					$return					.=						'<span style="color:red;">' . $dbUpgrade['message'] . ' failed! Error: ' . $_CB_database->stderr( true ) . '</span><br />';
				}
			}

			$return							.=						'<span style="color:green;">' . $dbUpgrade['message'] . ' Upgrade Applied Successfully.</span><br />';
		}
	}

	// Correct userlist orders:
	$query									=	'SELECT ' . $_CB_database->NameQuote( 'listid' )
											.	"\n FROM " . $_CB_database->NameQuote( '#__comprofiler_lists' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'ordering' ) . " ASC, " . $_CB_database->NameQuote( 'published' ) . " DESC";
	$_CB_database->setQuery( $query );
	$lists									=	$_CB_database->loadObjectList();

	$order									=	0;

	if ( $lists ) foreach ( $lists AS $list ) {
		$query								=	'UPDATE ' . $_CB_database->NameQuote( '#__comprofiler_lists' )
											.	"\n SET " . $_CB_database->NameQuote( 'ordering' ) . " = " . (int) $order
											.	"\n WHERE " . $_CB_database->NameQuote( 'listid' ) . " = " . (int) $list->listid;
		$_CB_database->setQuery( $query );
		$_CB_database->query();

		$order++;
	}

	// Core database fixes:
	$dbChecker								=	new CBdbChecker( $_CB_database );
	$result									=	$dbChecker->checkCBMandatoryDb( false );

	if ( ! $result ) {
		$dbChecker							=	new CBdbChecker( $_CB_database );
		$result								=	$dbChecker->checkCBMandatoryDb( true, false );

		if ( $result == true ) {
			$return							.=						'<p><span style="color:green;">Automatic database fixes of old core tabs and fields applied successfully.</span></p>';
		} elseif ( is_string( $result ) ) {
			$return							.=						'<p><span style="color:red;">' . $result . '</span></p>';
		} else {
			$errors							=	$dbChecker->getErrors( false );

			if ( $errors ) {
				$return						.=						'<div style="color:red;">'
											.							'<h3><span style="color:red;">Database fixing errors:</span></h3>';

				foreach ( $errors as $error ) {
					$return					.=							'<div style="font-size:115%">' . $error[0];

					if ( $error[1] ) {
						$return				.=								'<div style="font-size:90%">' . $error[1] . '</div>';
					}

					$return					.=							'</div>';
				}

				$return						.=						'</div>';
			}
		}

		if ( ( checkJversion() < 1 ) || ( $_CB_framework->getCfg( 'session_handler' ) != 'database' ) ) {
			$logs							=	$dbChecker->getLogs( false );

			if ( count( $logs ) > 0 ) {
				$return						.=						'<div><a href="#" id="cbdetailsLinkShowOld" onclick="document.getElementById(\'cbdetailsdbcheckOld\').style.display=\'\';return false;">Click to Show details</a></div>'
											.						'<div id="cbdetailsdbcheckOld" style="color:green;display:none;">';

				foreach ( $logs as $log ) {
					$return					.=							'<div>' . $log[0];

					if ( $log[1] ) {
						$return				.=								'<div style="font-size:90%">' . $log[1] . '</div>';
					}

					$return					.=							'</div>';
				}

				$return						.=						'</div>';
			}
		}
	}

	$dbChecker								=	new CBdbChecker( $_CB_database );
	$result									=	$dbChecker->checkDatabase( true, false );

	if ( $result == true ) {
		$return								.=						'<p><span style="color:green;">Automatic database upgrade to current version applied successfully.</span></p>';
	} elseif ( is_string( $result ) ) {
		$return								.=						'<p><span style="color:red;">' . $result . '</span></p>';
	} else {
		$errors								=	$dbChecker->getErrors( false );

		if ( $errors ) {
			$return							.=						'<div style="color:red;">'
											.							'<h3><span style="color:red;">Database fixing errors:</span></h3>';

			foreach ( $errors as $error ) {
				$return						.=							'<div style="font-size:115%">' . $error[0];

				if ( $error[1] ) {
					$return					.=								'<div style="font-size:90%">' . $error[1] . '</div>';
				}

				$return						.=							'</div>';
			}

			$return							.=						'</div>';
		}
	}

	if ( ( checkJversion() < 1 ) || ( $_CB_framework->getCfg( 'session_handler' ) != 'database' ) ) {
		$logs								=	$dbChecker->getLogs( false );

		if ( count( $logs ) > 0 ) {
			$return							.=						'<div><a href="#" id="cbdetailsLinkShow" onclick="document.getElementById(\'cbdetailsdbcheck\').style.display=\'\';return false;">Click to Show details</a></div>'
											.						'<div id="cbdetailsdbcheck" style="color:green;display:none;">';

			foreach ( $logs as $log ) {
				$return						.=							'<div>' . $log[0];

				if ( $log[1] ) {
					$return					.=								'<div style="font-size:90%">' . $log[1] . '</div>';
				}

				$return						.=							'</div>';
			}

			$return							.=						'</div>';
		}
	}

	$return									.=					'</div>'
											.				'</td>'
											.			'</tr>'
											.			'<tr>'
											.				'<td>';

	// Fix images:
	$imagesPath								=	$_CB_framework->getCfg( 'absolute_path' ) . '/images';
	$cbImages								=	$imagesPath . '/comprofiler';
	$cbImagesGallery						=	$cbImages . '/gallery';

	if ( $adminFS->isUsingStandardPHP() && ( ! $adminFS->file_exists( $cbImages ) ) && ( ! $adminFS->is_writable( $_CB_framework->getCfg( 'absolute_path' ) . '/images/' ) ) ) {
		$return								.=					'<span style="color:red;">' . $imagesPath . '/ is not writable!</span><br />';
	} else {
		if ( ! $adminFS->file_exists( $cbImages ) ) {
			if ( $adminFS->mkdir( $cbImages ) ) {
				$return						.=					'<span style="color:green;">' . $cbImages . '/ Successfully added.</span><br />';
			} else {
				$return						.=					'<span style="color:red;">' . $cbImages . '/ failed to be to be created, please do so manually!</span><br />';
			}
		}

		if ( ! $adminFS->file_exists( $cbImagesGallery ) ) {
			if ( $adminFS->mkdir( $cbImagesGallery ) ) {
				$return						.=					'<span style="color:green;">' . $cbImagesGallery . '/ Successfully added.</span><br />';
			} else {
				$return						.=					'<span style="color:red;">' . $cbImagesGallery . '/ failed to be to be created, please do so manually!</span><br />';
			}
		}

		if ( $adminFS->file_exists( $cbImages ) ) {
			if ( ! is_writable( $cbImages ) ) {
				if ( ! $adminFS->chmod( $cbImages, 0775 ) ) {
					if ( ! @chmod( $cbImages, 0775 ) ) {
						$return				.=					'<span style="color:red;">' . $cbImages . '/ failed to chmod to 775 please do so manually!</span><br />';
					}
				}
			}

			if ( ! is_writable( $cbImages ) ) {
				$return						.=					'<span style="color:red;">' . $cbImages . '/ is not writable and failed to chmod to 775 please do so manually!</span><br />';
			}
		}

		if ( $adminFS->file_exists( $cbImagesGallery ) ) {
			if ( ! is_writable( $cbImagesGallery ) ) {
				if ( ! $adminFS->chmod( $cbImagesGallery, 0775 ) ) {
					if ( ! @chmod( $cbImagesGallery, 0775 ) ) {
						$return				.=					'<span style="color:red;">' . $cbImagesGallery . '/ failed to chmod to 775 please do so manually!</span><br />';
					}
				}
			}

			if ( ! is_writable( $cbImagesGallery ) ) {
				$return						.=					'<span style="color:red;">' . $cbImagesGallery . '/ is not writable and failed to chmod to 775 please do so manually!</span><br />';
			}

			$galleryFiles					=	array(	'airplane.gif', 'ball.gif', 'butterfly.gif', 'car.gif',
														'dog.gif', 'duck.gif', 'fish.gif', 'frog.gif', 'guitar.gif',
														'kick.gif', 'pinkflower.gif', 'redflower.gif', 'skater.gif', 'index.html'
													);

			foreach ( $galleryFiles as $galleryFile ) {
				if ( ! ( file_exists( $cbImagesGallery . '/' . $galleryFile ) && is_readable( $cbImagesGallery . '/' . $galleryFile ) ) ) {
					$result					=	@copy( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/images/gallery/' . $galleryFile, $cbImagesGallery . '/' . $galleryFile );

					if ( ! $result ) {
						$result				=	$adminFS->copy( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/images/gallery/' . $galleryFile, $cbImagesGallery . '/' . $galleryFile );
					}

					if ( ! $result ) {
						$return				.=					'<span style="color:red;">' . $galleryFile . ' failed to be added to the gallery please do so manually!</span><br />';
					}
				}
			}
		}
	}

	if ( ! ( $adminFS->file_exists( $cbImages ) && is_writable( $cbImages ) && $adminFS->file_exists( $cbImagesGallery ) ) ) {
		$return								.=					'<br /><span style="color:red;">Manually do the following:<br /> 1.) create ' . $cbImages . '/ directory <br /> 2.) chmod it to 755 or if needed to 775 <br /> 3.) create ' . $cbImagesGallery . '/ <br /> 4.) chmod it to 755 or if needed to 775 <br />5.) copy ' . $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/images/gallery/ and its contents to ' . $cbImagesGallery . '/</span><br />';
	}

	$return									.=				'</td>'
											.			'</tr>'
											.		'</table>'
											.	'</div>';

	$_CB_framework->setUserState( 'com_comprofiler_install', $return );

	if ( is_callable( array( $_CB_framework, 'backendUrl' ) ) ) {
		$stepTwoUrl							=	$_CB_framework->backendUrl( 'index.php?option=com_comprofiler&task=finishinstallation', false );
	} else {
		$stepTwoUrl							=	( checkJversion() < 1 ? 'index2.php' : 'index.php' ) . '?option=com_comprofiler&task=finishinstallation';
	}

	$return									=	'<div id="cbInstallNextStep" style="font-weight:bold;font-size:120%;background:#ffffdd;border:2px orange solid;padding:5px;">WAIT PLEASE: DO NOT INTERRUPT INSTALLATION PROCESS: PERFORMING SECOND INSTALLATION STEP: UNCOMPRESSING CORE PLUGINS: THIS CAN TAKE UP TO 2 MINUTES.</div>'
											.	$return;

	echo $return;

	$jsStepTwo								=	"$( '#cbInstallNextStep' ).hide().fadeIn( '1500', function() {"
											.		"$( this ).fadeOut( '1000', function() {"
											.			"$( this ).fadeIn( '1500', function() {"
											.				"window.location = '" . addslashes( $stepTwoUrl ) . "';"
											.			"})"
											.		"})"
											.	"});";

	$_CB_framework->document->_outputToHeadCollectionStart();

	if ( checkJversion() > 1 ) {
		$_CB_framework->document->setCmsDoc( null );
	}

	$_CB_framework->outputCbJQuery( $jsStepTwo );
	$_CB_framework->getAllJsPageCodes();

	echo $_CB_framework->document->_outputToHead();

	return true;
}
?>
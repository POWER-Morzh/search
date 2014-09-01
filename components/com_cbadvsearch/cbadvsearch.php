<?php
/**
 * entry point file for CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
@error_reporting(0);
define('DS', DIRECTORY_SEPARATOR);

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Require specific controller if requested
if ($controller = JRequest::getVar('controller')) {
	@require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
}

// Create the controller
$classname	= 'CbadvsearchController'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();

?>

<?php
/**
 * @package    cbadvsearch
 * @subpackage Components
 * @license    GNU/GPL
 */

@error_reporting(0);
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
define('DS', DIRECTORY_SEPARATOR);
// Require the base controller

@require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
$controller = JRequest::getWord('controller');
$controller = empty($controller) ? "cbadvsearch" : $controller;

if (!empty($controller))
{
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (@file_exists($path)) require_once $path;
		else	$controller = '';
}

// Create the controller
$classname	= 'CbadvsearchsController'.$controller;
$controller	= new $classname();

// Perform the Request task
$task = JRequest::getVar( 'task' );
if (empty($task)) $task = "manager";
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();

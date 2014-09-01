<?php
/**
 * entry point file for CB Adv. Search Saved Lists module
 * 
 * @package    cbadvsearch
 * @license		GNU/GPL
 */
//@error_reporting(0);
// no direct access
defined('_JEXEC') or die('Restricted access');

$showSavedFormsListResults = $showIgnoredResultsListResults = $showSavedResultsListResults = "";
$user =& JFactory::getUser();
if (!empty($user->id))
	{
// Include the syndicate functions only once
define('DS', DIRECTORY_SEPARATOR);
require_once dirname(__FILE__).DS.'cbadvsearch_saved_lists.php';
$cbadvsearch = new modCbadvsearchModelSavedListsCbadvsearch();
$showSavedFormsList = $params->get('showSavedFormsList');
$showIgnoredResultsList = $params->get('showIgnoredResultsList');
$showSavedResultsList = $params->get('showSavedResultsList');
$operation = JRequest::getString('cboperation', '', 'post');
$operation_values = JRequest::getString('cboperation-values', '', 'post');
$operation_values_array = explode(",", $operation_values);
$first = 0;
foreach($operation_values_array as $v) if (!empty($v))	{ $first = $v;	break;	}

switch($operation)
	{
		case "delete form": $cbadvsearch->delete_form($user->id, $operation_values_array);	$operation = "saved-form"; break;
		case "set default form": $cbadvsearch->set_default_form($user->id, $first);	$operation = "saved-form"; break;
		case "delete list": $cbadvsearch->delete_list($user->id, $operation_values_array);	$operation = "saved-results"; break;
		case "delete item ignored": $cbadvsearch->delete_item_ignored($user->id, $operation_values_array);	$operation = "ignored-results"; break;
		case "delete item saved": $cbadvsearch->delete_item_saved($user->id, $operation_values_array);	$operation = "saved-results"; break;
		default:	break;
	}

if (!empty($showSavedFormsList)) $showSavedFormsListResults = $cbadvsearch->showSavedFormsList($user->id);
if (!empty($showIgnoredResultsList)) $showIgnoredResultsListResults = $cbadvsearch->showIgnoredResultsList($user->id);
if (!empty($showSavedResultsList)) $showSavedResultsListResults = $cbadvsearch->showSavedResultsList($user->id);
if (!empty($showSavedResultsList) && $operation=="saved-results-items")
	$showSavedResultsListResultsItems = $cbadvsearch->showSaveResultsListItems($user->id, $first);
	}
require JModuleHelper::getLayoutPath('mod_cbadvsearch_saved_lists', $params->get('layout', 'default'));
?>

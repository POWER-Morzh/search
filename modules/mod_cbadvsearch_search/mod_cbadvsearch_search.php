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
// Include the syndicate functions only once
require_once dirname(__FILE__).DS.'cbadvsearch_search.php';

$cbadvsearch = new modCbadvsearchModelCbadvsearchSearch();
$number = $params->get('searchNumber');	if (empty($number)) $number = 1;
$searchURL = $params->get('searchURL');	//	if (empty($searchURL) || strpos($searchURL, "/")<0) $searchURL = "";
$results = $cbadvsearch->getTheSearch($number, $searchURL);

require JModuleHelper::getLayoutPath('mod_cbadvsearch_search', $params->get('layout', 'default'));
?>

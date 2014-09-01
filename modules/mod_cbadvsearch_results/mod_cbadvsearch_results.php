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
@define('DS', DIRECTORY_SEPARATOR);
// Include the syndicate functions only once
require_once dirname(__FILE__).DS.'cbadvsearch_results.php';

$cbadvsearch = new modCbadvsearchModelCbadvsearchResults();
$number = $params->get('searchNumber');	if (empty($number)) $number = 1;
$results = $cbadvsearch->getTheSearch($number);

require JModuleHelper::getLayoutPath('mod_cbadvsearch_results', $params->get('layout', 'default'));
?>

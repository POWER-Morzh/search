<?php
/**
 * CB Adv. Search default controller
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 */
//error_reporting(0);
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * CB Adv. Search Component Controller
 *
 * @subpackage Components
 */
class CbadvsearchsController extends JControllerLegacy
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	protected $default_view = 'default'; 
	
	function display($cachable = false, $urlparams = false)
	{
		parent::display();
		return $this;
	}
}


/**
 * CB Adv. Search Component Controller
 *
 * @subpackage Components
 */
/*class CbadvsearchsController extends JControllerLegacy
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
/*	function display()
	{
	echo "plural";
		parent::display();
	}
}*/
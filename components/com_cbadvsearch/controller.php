<?php
/**
 * CB Adv. Search default controller
 * 
 * @package    cbadvsearch
 * @license		GNU/GPL
 */

//	error_reporting(0);
jimport('joomla.application.component.controller');

/**
 * CB Adv. Search Component Controller
 *
 * @package		cbadvsearch
 */
class CbadvsearchController extends JControllerLegacy
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	protected $default_view = 'default'; 
	
	function display($cachable = false, $urlparams = false)
	{
		JRequest::setVar('view','cbadvsearch');
		parent::display();
	}
	function search($cachable = false, $urlparams = false)
	{
		JRequest::setVar( 'view', 'cbadvsearch' );
		parent::display();
	}
}
?>

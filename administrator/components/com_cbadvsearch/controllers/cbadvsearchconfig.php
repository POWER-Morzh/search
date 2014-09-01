<?php
/**
 * CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 *  
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * CB Adv. Search Controller
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class cbadvsearchsControllercbadvsearchConfig extends cbadvsearchsController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->registerTask('add','edit');
	}
	
	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar('view', 'cbadvsearchconfig');
		JRequest::setVar('layout', 'form');
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function add()
	{
		JRequest::setVar('view', 'cbadvsearchconfig');
		JRequest::setVar('layout', 'form');
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * display the description form
	 * @return void
	 */
	function description()
	{
		JRequest::setVar( 'view', 'cbadvsearchsdesc' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 0);

		parent::display();
	}
	
	/**
	 * display the translation list
	 * @return void
	 */
	function configs()
	{
		JRequest::setVar( 'view', 'cbadvsearchconfigs' );
		JRequest::setVar( 'layout', 'default'  );
		JRequest::setVar('hidemainmenu', 0);

		parent::display();
	}
	
	/**
	 * display the managers
	 * @return void
	 */
	function manager()
	{
		JRequest::setVar('view','cbadvsearchs');
		JRequest::setVar('layout', 'default');
		JRequest::setVar('hidemainmenu', 0);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$post = JRequest::get('post');
		$model = $this->getModel('cbadvsearchconfig');
		if (is_numeric($post['id']) && !empty($post['id']))	$model->store_configuration($post);
			else	{
						if (($post['id']=$model->store($post))>0)	$msg = JText::_('Field Saved!');
							else	$msg = JText::_('Error Saving Field');
					}
		
		// Check the table in so it can be edited.... we are done with it anyway
	//	$this->setRedirect('index.php?option=com_cbadvsearch&view=cbadvsearchconfigs&task=edit&cid='.$post['id'], $msg);
		$this->setRedirect('index.php?option=com_cbadvsearch&view=cbadvsearchconfigs', $msg);
	}
	
	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('cbadvsearchconfig');
		if(!$model->delete()) {
			$msg = JText::_('Error: One or More Field Could not be Deleted');
		} else {
			$msg = JText::_('Field(s) Deleted');
		}
		$this->setRedirect('index.php?option=com_cbadvsearch&view=cbadvsearchconfigs', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_('Operation Cancelled');
		$this->setRedirect('index.php?option=com_cbadvsearch&view=cbadvsearchconfigs', $msg );
	}

}

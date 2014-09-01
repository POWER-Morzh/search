<?php
/**
 * CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
/**
 * CB Adv. Search Controller
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class CbadvsearchsControllerCbadvsearch extends CbadvsearchsController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		global $mainframe, $option;
 
        // Get pagination request variables
		if (!empty($mainframe))
			$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        //$this->setState('limit', $limit);
        //$this->setState('limitstart', $limitstart);
		// Register Extra tasks
		$this->registerTask( 'add', 'edit' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'cbadvsearch' );
		JRequest::setVar( 'layout', 'form'  );
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
		JRequest::setVar('view', 'cbadvsearchs');
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
		$post = JRequest::get( 'post' );
		$current_search	= JRequest::getVar( 'thesearch', array(), 'post', 'array' );
		$current_search = !empty($post['thesearch']) ? $post['thesearch'] : 1;
		if ($post['id']=="description")	$this->savedescription();
			else	{
						$model = $this->getModel('cbadvsearch');
						if ($model->store($post))	$msg = JText::_( 'Field Saved!' );
							else	$msg = JText::_( 'Error Saving Field' );
					}
		
		// Check the table in so it can be edited.... we are done with it anyway
		$this->setRedirect('index.php?option=com_cbadvsearch&current_search='.$current_search, $msg);
	}
	
	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$model = $this->getModel('cbadvsearch');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Field Could not be Deleted' );
		} else {
			$msg = JText::_( 'Field(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}

	/**
	 * publish a record
	 * @return void
	 */

	function publish()
	{ 
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		$model =& $this->getModel( 'cbadvsearch' );
		if ($model->setItemState($cid, 1)) {
			$msg = JText::sprintf( 'Search Field Published', count( $cid ) );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}
	
	/**
	 * unpublish a record
	 * @return void
	 */

	function unpublish()
	{ 
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		$model =& $this->getModel( 'cbadvsearch' );
		if ($model->setItemState($cid, 0)) {
			$msg = JText::sprintf( 'Search Field Unpublished', count( $cid ) );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}
	
	
	/**
	* Save the item(s) to the menu selected
	*/
	function orderup()
	{
		// Check for request forgeries
		//JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		JArrayHelper::toInteger($cid);

		if (isset($cid[0]) && $cid[0]) {
			$id = $cid[0];
		} else {
			$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, JText::_('No Items Selected') );
			return false;
		}

		$model =& $this->getModel( 'cbadvsearch' );
		if ($model->orderItem($id, -1)) {
			$msg = JText::_( 'Item Moved Up' );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}

	/**
	* Change the current search for linsting the items
	*/
	function changeSearch()
	{
		// Check for request forgeries
		//JRequest::checkToken() or jexit( 'Invalid Token' );
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, '' );
	}

	/**
	* Save the item(s) to the menu selected
	*/
	function orderdown()
	{
		// Check for request forgeries
		//JRequest::checkToken() or jexit( 'Invalid Token' );

		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (isset($cid[0]) && $cid[0]) {
			$id = $cid[0];
		} else {
			$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, JText::_('No Items Selected') );
			return false;
		}

		$model =& $this->getModel( 'cbadvsearch' );
		if ($model->orderItem($id, 1)) {
			$msg = JText::_( 'Item Moved Down' );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}

	/**
	* Save the item(s) to the menu selected
	*/
	function saveorder()
	{
		// Check for request forgeries
		//JRequest::checkToken() or jexit( 'Invalid Token' );

		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		$model =& $this->getModel( 'cbadvsearch' );
		if ($model->setOrder($cid)) {
			$msg = JText::_( 'New ordering saved' );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg );
	}
	
	
	/**
	 * Retrieves the cbadvsearch description
	 * @return array Array of objects containing the data from the database
	 */
	function getDescription()
	{
		$this->_data = $this->_getList( 'SELECT d.* FROM #__cbadvsearchsdesc d' );
		
		return $this->_data;
	}
	
	/**
	 * save a record of the description (and redirect to main page)
	 * @return void
	 */
	function savedescription()
	{
		$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
		$current_search = !empty($current_search[0]) ? $current_search[0] : 1;
		$model = $this->getModel('cbadvsearchsdesc');
		$model->truncate_table("#__cbadvsearchsdesc");
		$data = JRequest::get( 'post' );
		$model->store_description($data);
		
		// Check the table in so it can be edited.... we are done with it anyway
		$this->setRedirect($link = 'index.php?option=com_cbadvsearch&current_search='.$current_search, $msg);
	}
}

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

jimport('joomla.application.component.model');

/**
 * CB Adv. Search Model
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class CbadvsearchsModelCbadvsearch extends JModelLegacy
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the cbadvsearch identifier
	 *
	 * @access	public
	 * @param	int Cbadvsearch identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a cbadvsearch
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__cbadvsearch '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;		$this->_data->field_id = null;
			$this->_data->label = null;	$this->_data->ordering = null;
		}
		return $this->_data;
	}
	
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{
		$row =& $this->getTable();

		$data = JRequest::get( 'post' );
		$data['field_id'] = @implode(",", $data['field_id']);
		
		// Bind the form fields to the cbadvsearch table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the cbadvsearch record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}
		if (empty($data['id'])) $data['id'] = $this->_db->insertid();
		/* joomla 1.5 does not save the description so it it must be saved manually*/
		$this->_db->setQuery('update #__cbadvsearch set description="'.$data['description'].'", searchable="'.$data['searchable'].'", 
			appears_results="'.$data['appears_results'].'", thesearch="'.$data['thesearch'].'", comparison_sign="'.$data['comparison_sign'].'", 
			fill_in_text="'.$data['fill_in_text'].'", css_class="'.$data['css_class'].'" where id="'.$data['id'].'"');
		$this->_db->query();
		return true;
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
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}
	
	
	/**
	 * Method to get a fields from comprofiler_fields
	 * @return object with data
	 */
	function getFieldData()
	{
		// Load the data
			$query = " SELECT fieldid, name FROM #__comprofiler_fields ".
					"  WHERE published = 1 order by name asc";
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObjectList();

		return $this->_data;
	}
	
	/**
	* Set the state of selected field items
	*/
	function setItemState( $items, $state )
	{
		if(is_array($items))
		{
			$row =& $this->getTable();
			
			foreach ($items as $id)
			{ 
				$row->load( $id );

				if ($row->home != 1) {
					$row->published = $state;

					if ($state != 1) {
						$db = &$this->getDBO();
						$query = "UPDATE #__cbadvsearch SET published = '1' WHERE id = ".(int)$id;
						$db->setQuery( $query );
						if (!$db->query()) {
							$this->setError( $db->getErrorMsg() );
							return false;
						}
					}

					if (!$row->check()) {
						$this->setError($row->getError());
						return false;
					}
					if (!$row->store()) {
						$this->setError($row->getError());
						return false;
					}
				} else {
					JError::raiseWarning( 'SOME_ERROR_CODE', JText::_('You cannot unpublish the default field'));
					return false;
				}
			}
		}
		return true;
	}
	
	/**
	* Set the state of selected field items
	*/
	function setSearchableState( $items, $state )
	{
		if(is_array($items))
		{
			$row =& $this->getTable();
			
			foreach ($items as $id)
			{ 
				$row->load( $id );

				if ($row->home != 1) {
					$row->searchable = $state;

					if ($state != 1) {
						$db = &$this->getDBO();
						$query = "UPDATE #__cbadvsearch SET searchable = '1' WHERE id = ".(int)$id;
						$db->setQuery( $query );
						if (!$db->query()) {
							$this->setError( $db->getErrorMsg() );
							return false;
						}
					}

					if (!$row->check()) {
						$this->setError($row->getError());
						return false;
					}
					if (!$row->store()) {
						$this->setError($row->getError());
						return false;
					}
				} else {
					JError::raiseWarning( 'SOME_ERROR_CODE', JText::_('You cannot exclude from the search the default field'));
					return false;
				}
			}
		}
		return true;
	}
	
	function orderItem($item, $movement)
	{
		$row =& $this->getTable();
		$row->load( $item );
		if (!$row->move( $movement)) {
			$this->setError($row->getError());
			return false;
		}
		return true;
	}

	function setOrder($items)
	{
		$total		= count( $items );
		$row		=& $this->getTable();
		$groupings	= array();

		$order		= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($order);

		// update ordering values
		for( $i=0; $i < $total; $i++ ) {
			$row->load( $items[$i] );
			// track parents
			$groupings[] = $row->parent;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($row->getError());
					return false;
				}
			} // if
		} // for

		// execute updateOrder for each parent group
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
			$row->reorder();
		}

		return true;
	}
	
	/**
	 * Retrieves the cbadvsearch configuration
	 * @return array Array of objects containing the data from the database
	 */
	function getConfiguration()
  	{
		// Load the data
		return $this->_getList('SELECT * FROM #__cbadvsearchconfig');
	}

}
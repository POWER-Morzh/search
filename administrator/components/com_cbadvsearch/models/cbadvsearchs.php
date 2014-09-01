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

jimport( 'joomla.application.component.model' );

/**
 * CB Adv. Search
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class CbadvsearchsModelCbadvsearchs extends JModelLegacy
{
	/**
	 * Cbadvsearchs data array
	 *
	 * @var array
	 */
	var $_data;

	/**
	   * Items total
	   * @var integer
	   */
	  var $_total = null;
	 
	  /**
	   * Pagination object
	   * @var object
	   */
	  var $_pagination = null;

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery($conditions = "")
	{
		$the_search = empty($conditions['current_search']) ? 1 : $conditions['current_search'];
		$query = ' SELECT m.*, b.name as field_name '
			. ' FROM #__cbadvsearch m LEFT JOIN #__comprofiler_fields b ON m.field_id=b.fieldid where 1=1 ';

		$query .= ' and m.thesearch="'.$the_search.'" order by m.ordering asc ';

		return $query;
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
	 * Retrieves the cbadvsearch data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		$current_search	= JRequest::getVar( 'current_search', array(), 'get', 'array' );
		if (empty($current_search))	{	$current_search = array(); $current_search[] = 1;	}
		$conditions = array("current_search" => $current_search[0]);
	//	if (empty( $this->_data ))
		{
			$query = $this->_buildQuery($conditions);
			$this->_data = $this->_getList( $query );
		}
		return $this->_data;
	}
	
	function getTotal()
  	{
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
  	}
	
	function getPagination()
  	{
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
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
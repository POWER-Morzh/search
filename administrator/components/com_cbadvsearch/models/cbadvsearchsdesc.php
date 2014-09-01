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
class cbadvsearchsModelCbadvsearchsdesc extends JModelLegacy
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
	function _buildQuery()
	{
		$query = ' SELECT d.* FROM #__cbadvsearchsdesc d ';

		return $query;
	}

	/**
	 * Retrieves the cbadvsearch description
	 * @return array Array of objects containing the data from the database
	 */
	function getDescription()
	{
		$this->_data = $this->_getList( 'SELECT d.* FROM #__cbadvsearchsdesc d order by id asc' );
		
		return $this->_data;
	}
	
	/**
	 * Retrieves the cbadvsearch result listing
	 * @return array Array of objects containing the data from the database
	 */
	function getListing()
	{
		$this->_data = $this->_getList( 'SELECT d.listing FROM #__cbadvsearchsdesc d' );
		
		return $this->_data;
	}
	
	/**
	 * Retrieves the Community Builder lists
	 * @return array Array of objects containing the data from the database
	 */
	function getCBLists()
	{
		$this->_data = $this->_getList('SELECT d.* FROM #__comprofiler_lists d');
		return $this->_data;
	}
	
	/**
	 * Retrieves the cbadvsearch data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
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
				include_once('cbpaging.php');
				$this->_pagination = new JPaginationadv($this->_total, $this->getState('limitstart'), $this->getState('limit') );
				//jimport('joomla.html.pagination');
				//$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  	}

	/**
	 * Method to truncate a table
	 * @return object with data
	 */
	function &truncate_table($table = '')
	{
		// truncate te table and return the result
		if (!empty($table))
			{
				$this->_db->setQuery('truncate table '.$table);
				$this->_db->query();
			//	$this->_data = $this->_db->loadObject();
			}
		return;
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
	 * Method to store a description
	 * @return object with data
	 */
	function &store_description($data = "")
	{
		if (empty($data)) return;
		$this->_db->setQuery("CREATE TABLE if not exists `#__cbadvsearchsdesc` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(250) NULL default NULL comment 'the description of the search',
  `listing` tinyint(1) not NULL default '0' comment 'listing the results: 0 = vertical, 1 = horizontal',
  `searches` SMALLINT(3) NOT NULL DEFAULT '1' COMMENT 'number of searches',
  `empty_fields` tinyint(1) not NULL default '1' comment 'if 1 the it appears the option for the frontend to list the empty fields or not',
  `order_by` varchar(50) not NULL default 'id asc' comment 'the order of the search: random or asc/desc by a field',
  `show_order_by` tinyint(1) not NULL default '1' comment 'show the order by field in the frontend',
  `show_avatar` tinyint(1) not NULL default '1' comment 'show the avatar in the results list',
  `show_numbers` tinyint(1) not NULL default '1' comment 'show the numbers in the results list',
  `user_groups` varchar(250) NULL default NULL comment 'the user groups you want to search',
  `show_the_searchfield` tinyint(1) not NULL default 1 comment '1 for show the search field yes, 0 for no',
  `search_by_fields_or_cblists` tinyint(1) not NULL default 0 comment '0 for search by fiels, 1 for search by list',
  `cblist_id` int(10) unsigned not NULL default 0,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");
		$this->_db->query();

		for($i=0; $i<$data['searches']; $i++)
			{
				if (empty($data['description'.$i])) $data['description'.$i] = $data['description0'];
				if (empty($data['listing'.$i])) $data['listing'.$i] = $data['listing0'];
				$data['empty_fields'.$i] = empty($data['empty_fields'.$i]) ? 1 : $data['empty_fields'.$i]-1;
				
				if (empty($data['order_by'.$i])) $data['order_by'.$i] = "id asc";
				$this->_db->setQuery('insert into #__cbadvsearchsdesc (description, listing, searches, empty_fields, order_by, 
					show_order_by, show_avatar, show_numbers, user_groups, show_the_searchfield, search_by_fields_or_cblists, 
					cblist_id) 
					values ("'.$data['description'.$i].'", "'.$data['listing'.$i].'", "'.$data['searches'].'", 
					"'.$data['empty_fields'.$i].'", "'.$data['order_by'.$i].'", "'.$data['show_order_by'.$i].'", 
					"'.$data['avatar'.$i].'", "'.$data['numbers'.$i].'", "'.@implode(",", $data['usergroups'.$i]).'", 
					"'.$data['show_the_searchfield'.$i].'", "'.$data['search_fields_cblists'.$i].'", 
					"'.$data['cblistid'.$i].'")');
				$this->_db->query();
			}
		return;
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
	
	/**
	 * Retrieves the usergroups list
	 * @return array Array of objects containing the data from the database
	 */
	function getUserGroups()
  	{
		// Load the data
		return $this->_getList('SELECT * FROM #__usergroups');
	}
	
}
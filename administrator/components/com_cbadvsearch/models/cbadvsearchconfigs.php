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
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * CB Adv. Search Model
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class cbadvsearchsModelcbadvsearchConfigs extends JModelLegacy
{
	/**
	 * cbadvsearch data array
	 *
	 * @var array
	 */
	var $_data;

	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */

	/**
	 * Retrieves the cbadvsearchconfig data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		$query = 'SELECT m.*, u.name as language_name, u.code as lang_code 
				FROM #__cbadvsearchconfig m 
				LEFT JOIN #__cbadvsearchlanguages u ON u.code=m.language 
				order by u.name asc';
		$this->_data = $this->_getList( $query );
		return $this->_data;
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
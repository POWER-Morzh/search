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
class cbadvsearchsModelcbadvsearchConfig extends JModelLegacy
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
	 * @param	int cbadvsearch identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * display the configuration form
	 * @return void
	 */
	function config()
	{
		JRequest::setVar('view', 'cbadvsearchconfig');
		JRequest::setVar('layout', 'form');
		JRequest::setVar('hidemainmenu', 0);

		parent::display();
	}

	/**
	 * Method to get a cbadvsearch
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$this->_db->setQuery('SELECT * FROM #__cbadvsearchconfig WHERE id = "'.$this->_id.'"');
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
		$data = JRequest::get( 'post' );
		$this->verify_columns_and_variables($data);
		
		if (empty($data['language'])) $data['language'] = "en-GB";
		
		$row =& $this->getTable();
		// Bind the form fields to the cbadvsearch table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return 0;// false;
		}

		// Make sure the cbadvsearch record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return 0;//false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			return 0;//false;
		}

		if (empty($data['id'])) $data['id'] = $this->_db->insertid();
		/* joomla 1.5 does not save the description so it it must be saved manually*/
		$this->store_configuration($data);
		
		return $data['id'];//true;
	}
	
	function verify_columns_and_variables($data)
	{
		$this->_db->setQuery("show columns from #__cbadvsearchconfig");
		$columns = $this->_getList("show columns from #__cbadvsearchconfig");
		
		for(reset($data); $key=key($data); next($data))
			{
				$coloana = substr($key, 6);
				if (strpos(" ".$key, "value_"))
					{
						$add = true;
						foreach($columns as $c)
							if ($coloana==$c->Field)	{	$add = false;	break;	}
						if ($add==true)
							{
								$this->_db->setQuery("alter table #__cbadvsearchconfig add column `".$coloana."` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL;");
								$this->_db->query();
							}
					}
			}
	}
	
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store_configuration($data)
		{
			if (empty($data)) return;
			$this->verify_columns_and_variables($data);
			
			$db =& JFactory::getDBO();
			if (empty($data['id']))
					$this->_db->setQuery("insert into #__cbadvsearchconfig (`language`) values ('".$data['language']."')");
				else
					$this->_db->setQuery("update #__cbadvsearchconfig set `language`='".$data['language']."' where id='".$data['id']."'");
			$this->_db->query();
			$query = "update #__cbadvsearchconfig set";
			for(reset($data); $key=key($data); next($data))
				{
					if (strpos(" ".$key, "value_"))
						{
							$query .= ", `".substr($key, 6)."` = '".addslashes(str_replace("'", "\"", $data[$key]))."'";
						}
				}
			$query = str_replace("#__cbadvsearchconfig set,", "#__cbadvsearchconfig set ", $query);
			$query .= " where id='".$data['id']."'";
			$this->_db->setQuery($query);
			$this->_db->query();
		}

	/**
	 * Retrieves the cbadvsearch description
	 * @return array Array of objects containing the data from the database
	 */
	function getLanguages()
	{
		$this->_data = $this->_getList( 'SELECT d.* FROM #__cbadvsearchlanguages d' );
		if (empty($this->_data))
			{
				$this->_db->setQuery("INSERT INTO `#__cbadvsearchlanguages` (`id`, `name`, `active`, `iso`, `code`, `shortcode`, `image`, `fallback_code`, `params`, `ordering`) VALUES
					(1, 'English (United Kingdom)', 1, 'en_GB.utf8, en_GB.UT', 'en-GB', 'en', '', '', '', 1)");
				$this->_db->query();
				$this->_db->setQuery("INSERT INTO `#__cbadvsearchlanguages` (`id`, `name`, `active`, `iso`, `code`, `shortcode`, `image`, `fallback_code`, `params`, `ordering`) VALUES
					(2, 'German (Deutchland)', 1, 'de_De.utf8, de_De.UT', 'de-DE', 'de', '', '', '', 2)");
				$this->_db->query();
				$this->_db->setQuery("INSERT INTO `#__cbadvsearchlanguages` (`id`, `name`, `active`, `iso`, `code`, `shortcode`, `image`, `fallback_code`, `params`, `ordering`) VALUES
					(3, 'French (France)', 1, 'fr_FR.utf8, fr_FR.UT', 'fr-FR', 'fr', '', '', '', 3)");
				$this->_db->query();
				$this->_data = $this->_getList( 'SELECT d.* FROM #__cbadvsearchlanguages d' );
			}
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
	 * Retrieves the cbadvsearch configuration
	 * @return array Array of objects containing the data from the database
	 */
	function getConfiguration()
  	{
		// Load the data
		return $this->_getList('SELECT * FROM #__cbadvsearchconfig');
	}
}
<?php
/**
 * CB Adv. Search table class
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 *  
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * CB Adv. Search class
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class Tablecbadvsearchconfig extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $field_id = null;

	/**
	 * @var string
	 */
	var $label = null;
	
	/**
	 * @var int
	 */
	var $published = null;

	/**
	 * @var int
	 */
	var $ordering = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function Tablecbadvsearchconfig(& $db) {
		parent::__construct('#__cbadvsearchconfig', 'id', $db);
	}
}
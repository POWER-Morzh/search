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

jimport( 'joomla.application.component.view' );

/**
 * Cbadvsearch View
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class cbadvsearchsViewcbadvsearchsdesc extends JViewLegacy
{
	/**
	 * display method of Cbadvsearch view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the cbadvsearch
		$cbadvsearch		=& $this->get('Data');
		
		$model =& $this->getModel();
		$configuration = $model->getConfiguration();
		$lang = empty($user->admin_language) ? "en-GB" : $user->admin_language;
		
		include('../components/com_cbadvsearch/language_en.php' );
		$this->assignRef('default_language', $language_cbadvsearch);
		if (!empty($configuration))
			foreach($configuration as $cf)
				{
					if ($cf->language==$lang)	{ $configuration = $cf;	break;	}
				}
			else	$configuration = (object)$language_cbadvsearch;
		$this->assignRef('configuration', $configuration);
		
		JToolBarHelper::title(   JText::_( 'CB Adv. Search' ).': <small><small>[ ' . JText::_( $configuration->edit_the_configuration ).' ]</small></small>' );
		JToolBarHelper::custom('manager', 'manager', 'manager', $configuration->manager, false, false);
		JToolBarHelper::custom('configs', 'translation', 'translation', $configuration->translation, false, false);
		JToolBarHelper::save();
		JToolBarHelper::cancel( 'cancel', 'Close' );
		JHTML::_('stylesheet', 'cbadvsearch.css', 'administrator/components/com_cbadvsearch/css/');

		$this->assignRef('cbadvsearch', $cbadvsearch);
		
		// Get data from the model
		$items = $model->getDescription();		$this->assignRef('description', $items);
        $items2 = $model->getFieldData();		$this->assignRef('fields', $items2);
        $usergroups = $model->getUserGroups();	$this->assignRef('usergroups', $usergroups);
        $CBLists = $model->getCBLists();		$this->assignRef('CBLists', $CBLists);
		parent::display($tpl);
	}
}
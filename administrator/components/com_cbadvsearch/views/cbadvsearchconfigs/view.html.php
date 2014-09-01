<?php
/**
 * CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 *  
 */
//error_reporting(0);
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * CB Adv. Search View
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class cbadvsearchsViewcbadvsearchConfigs extends JViewLegacy
{
	/**
	 * cbadvsearch view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		$user =& JFactory::getUser();
		$model =& $this->getModel();
		$lang = empty($user->admin_language) ? "en-GB" : $user->admin_language;
		
		$configuration = $model->getConfiguration();
		include('../components/com_cbadvsearch/language_en.php' );
		$this->assignRef('default_language', $language_cbadvsearch);
		if (!empty($configuration))
			foreach($configuration as $cf)
				{
					if ($cf->language==$lang)	{ $configuration = $cf;	break;	}
				}
			else	$configuration = (object)$language_cbadvsearch;
		$this->assignRef('configuration', $configuration);
		
		JToolBarHelper::title(   JText::_( 'CB Adv. Search '.$configuration->translator ), 'generic.png' );
		JToolBarHelper::deleteList();
		JToolBarHelper::editList();
		JToolBarHelper::addNew('add', $configuration->add_new);
	//	JToolBarHelper::editListX();
	//	JToolBarHelper::addNewX('add', $configuration->add_new);
		JToolBarHelper::custom('description', 'config', 'config', $configuration->the_configuration, false, false);
		JToolBarHelper::custom('manager', 'manager', 'manager', $configuration->manager, false, false);
		JToolBarHelper::help('en-help.html', true);
		JHTML::_('stylesheet', 'cbadvsearch.css', 'administrator/components/com_cbadvsearch/css/');
		
		// Get data from the model
        $items = & $this->get('Data');
        // push data into the template
        $this->assignRef('items', $items);
		
		parent::display($tpl);
	}
}
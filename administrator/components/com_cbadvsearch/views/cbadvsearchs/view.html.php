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
 * CB Adv. Search View
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class CbadvsearchsViewCbadvsearchs extends JViewLegacy
{
	/**
	 * Cbadvsearch view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		$lang = empty($user->admin_language) ? "en-GB" : $user->admin_language;
		$model =& $this->getModel();
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
		
		JToolBarHelper::title(JText::_( 'CB Adv. Search '.$configuration->manager ), 'generic.png' );
		JToolBarHelper::custom('description', 'config', 'config', $configuration->the_configuration, false, false);
		JToolBarHelper::custom('configs', 'translation', 'translation', $configuration->translation, false, false);
		JToolBarHelper::deleteList();
		JToolBarHelper::editList();
		JToolBarHelper::addNew('add', $configuration->add_new.' '.$configuration->search_field);
	//	JToolBarHelper::editListX();
	//	JToolBarHelper::addNewX('add', $configuration->add_new.'<BR>'.$configuration->search_field);
		JToolBarHelper::help('en-help.html', true);
		JHTML::_('stylesheet', 'cbadvsearch.css', 'administrator/components/com_cbadvsearch/css/');
		
		$current_search	= JRequest::getVar( 'current_search', array(), 'get', 'array' );
		if (empty($current_search))	{	$current_search = array(); $current_search[] = 1;	}

		// Get data from the model
        $items = & $this->get('Data');
		if (empty($items) && empty($current_search))
			{
				$current_search	= JRequest::getVar( 'current_search', array(), 'post', 'array' );
				if (empty($current_search))	{	$current_search = array(); $current_search[] = 1;	}
			}
		$this->assignRef('current_search', $current_search[0]);
        $pagination = & $this->get('Pagination');
		$config = & $this->get('Description');

        // push data into the template
        $this->assignRef('items', $items);
		$this->assignRef('ordering', $ordering);   
        $this->assignRef('searches', $config);
        $this->assignRef('pagination', $pagination);
		
		parent::display($tpl);
	}
}
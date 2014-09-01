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

jimport( 'joomla.application.component.view' );

/**
 * cbadvsearch View
 *
 * @package    cbadvsearch
 * @subpackage Components
 */
class cbadvsearchsViewcbadvsearchConfig extends JViewLegacy
{
	/**
	 * display method of cbadvsearch view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$model =& $this->getModel();
		//get the cbadvsearch
		$cbadvsearch		= $model->getData();
		$isNew		= ($cbadvsearch->id < 1);
		$cbadvsearch->powered_by = $isNew ? 1 : $cbadvsearch->powered_by;
		$this->assignRef('cbadvsearch', $cbadvsearch);
		
		$user =& JFactory::getUser();
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
		
		$text = $isNew ? JText::_( $configuration->nnew ) : JText::_( $configuration->edit );
		JToolBarHelper::title(JText::_( 'CB Adv. Search '.$configuration->the_configuration ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		JToolBarHelper::custom('description', 'config', 'config', $configuration->the_configuration, false, false);
		JToolBarHelper::custom('configs', 'translation', 'translation', $configuration->translation, false, false);
		JHTML::_('stylesheet', 'cbadvsearch.css', '/administrator/components/com_cbadvsearch/css/');

		// Get data from the model
		$items = $model->getLanguages();		$this->assignRef('languages', $items);
		
		parent::display($tpl);
	}
}
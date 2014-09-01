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
class CbadvsearchsViewCbadvsearch extends JViewLegacy
{
	/**
	 * display method of Cbadvsearch view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$lang = empty($user->admin_language) ? "en-GB" : $user->admin_language;
		//get the cbadvsearch
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
		
		$cbadvsearch		=& $this->get('Data');
		$isNew		= ($cbadvsearch->id < 1);

		$text = $isNew ? JText::_( $configuration->nnew ) : JText::_( $configuration->edit );
		JToolBarHelper::title(   JText::_( 'CB Adv. Search' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('cbadvsearch', $cbadvsearch);
		
		// Get data from the model
        $items = $model->getFieldData();		$this->assignRef('fields', $items);
		$config = & $this->get('Description');	$this->assignRef('searches', $config[0]->searches);
		
		parent::display($tpl);
	}
}
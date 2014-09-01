<?php 
/**
 * Cbadvsearch Saved Lists Model for CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
@error_reporting(0);

/**
 * CB Adv. Search saved lists
 *
 */
class modCbadvsearchModelSavedListsCbadvsearch
{
	 
	function showSavedFormsList($userid = "")
  	{
		if (empty($userid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__cbadvsearch_forms_saved where cb_user_id='".$userid."' order by form_name asc");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function showIgnoredResultsList($userid = "")
  	{
		if (empty($userid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT ig.*, c.* FROM #__cbadvsearch_result_list_ignored ig
			left join #__comprofiler c on c.user_id = ig.cb_user_ignored_id 
			where ig.cb_user_owner_id='".$userid."' order by c.lastname asc");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function showSavedResultsList($userid = "")
  	{
		if (empty($userid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__cbadvsearch_result_list_saved where cb_user_id='".$userid."' order by list_name asc");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function showSaveResultsListItems($userid = "", $listid = "")
  	{
		if (empty($userid) || empty($listid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT ig.*, c.*, list.list_name FROM #__cbadvsearch_result_list_saved_items ig
			left join #__comprofiler c on c.user_id = ig.cb_user_found_id 
			left join #__cbadvsearch_result_list_saved list on list.id = ig.cb_search_list_id  
			where ig.cb_user_owner_id='".$userid."' and ig.cb_search_list_id='".$listid."' order by c.lastname asc");
		
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function delete_form($userid = "", $listid = "")
	{
		if (empty($userid) || empty($listid)) return false;
		$db =& JFactory::getDBO();
		foreach($listid as $l)
			{
				$db->setQuery("delete FROM #__cbadvsearch_forms_saved where cb_user_id='".$userid."' and id='".$l."'");
				$db->query();
				$db->setQuery("delete FROM #__cbadvsearch_forms_saved_items where cb_user_id='".$userid."' and form_id='".$l."'");
				$db->query();
			}
		return true;
	}
	
	function set_default_form($userid = "", $listid = "")
	{
		if (empty($userid) || empty($listid)) return false;
		$db =& JFactory::getDBO();
		$db->setQuery("update #__cbadvsearch_forms_saved set default_form=0");
		$db->query();
		$db->setQuery("update #__cbadvsearch_forms_saved set default_form=1 where cb_user_id='".$userid."' and id='".$listid."'");
		$db->query();
		return true;
	}
	
	function delete_list($userid = "", $listid = "")
	{
		if (empty($userid) || empty($listid)) return false;
		$db =& JFactory::getDBO();
		foreach($listid as $l)
			{
				$db->setQuery("delete FROM #__cbadvsearch_result_list_saved where cb_user_id='".$userid."' and id='".$l."'");
				$db->query();
				$db->setQuery("delete FROM #__cbadvsearch_result_list_saved_items where cb_user_owner_id='".$userid."' 
					and cb_search_list_id='".$l."'");
				$db->query();
			}
		return true;
	}
	
	function delete_item_ignored($userid = "", $listid = "")
	{
		if (empty($userid) || empty($listid)) return false;
		$db =& JFactory::getDBO();
		foreach($listid as $l)
			{
				$db->setQuery("delete FROM #__cbadvsearch_result_list_ignored where cb_user_owner_id='".$userid."' 
					and cb_user_ignored_id='".$l."'");
				$db->query();
			}
		return true;
	}
	
	function delete_item_saved($userid = "", $listid = "")
	{
		if (empty($userid) || empty($listid)) return false;
		$db =& JFactory::getDBO();
		foreach($listid as $l)
			{
				$db->setQuery("delete FROM #__cbadvsearch_result_list_saved_items where cb_user_owner_id='".$userid."' 
					and cb_user_found_id='".$l."'");
				$db->query();
			}
		return true;
	}
}
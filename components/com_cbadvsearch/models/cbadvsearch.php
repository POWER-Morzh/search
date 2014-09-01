<?php 
/**
 * Cbadvsearch Model for CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
@error_reporting(0);
jimport( 'joomla.application.component.model' );

/**
 * CB Adv. Search
 *
 */
class CbadvsearchModelCbadvsearch extends JModelLegacy
{
	/**
	 * Gets the fields
	 * @return object
	 */
	 
 	 var $_total = null;
 	 var $_limitstart = null;
 	 var $_limit = null;
   /**
   * Pagination object
   * @var object
   */
 	 var $_pagination = null;
	 
	function save_search_form($userid = "", $name_of_the_search = "", $fields_to_save = null)
  	{
		if (empty($userid) || empty($name_of_the_search) || empty($fields_to_save)) return false;
		$result = 2;
		$db =& JFactory::getDBO();
		$db->setQuery("delete from #__cbadvsearch_forms_saved where `form_name`='".$name_of_the_search."' and `cb_user_id`='".$userid."'");
		$db->query();
		$db->setQuery("insert into #__cbadvsearch_forms_saved (`form_name`, `cb_user_id`, `default_form`) 
				values ('".$name_of_the_search."', '".$userid."', '0')");
	//	$db->setQuery("insert into #__cbadvsearch_forms_saved (`form_name`, `cb_user_id`, `default_form`) values ('".$name_of_the_search."', '".$userid."', '1')");
		$db->query();
		$form = $db->insertid();
		foreach($fields_to_save as $field)
			try	{
					$db->setQuery("insert into #__cbadvsearch_forms_saved_items (`form_id`, `cb_user_id`, `cb_field_name`, `cb_field_value`) 
						values ('".$form."', '".$userid."', '".$field[0]."', '".$field[1]."')");
					$db->query();
				}catch (RuntimeException $e)
					{	/*	$e->getMessage();	    JLog::add('This query failed: '.$query);	*/
							$result = 1;	}
		return $result;
	}
	
	function get_default_form_values($userid = 0)
	{
		if (empty($userid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT a.form_name, a.cb_user_id, b.cb_field_name, b.cb_field_value
			FROM #__cbadvsearch_forms_saved a left JOIN #__cbadvsearch_forms_saved_items b on a.id=b.form_id 
			where a.default_form='1' and a.cb_user_id='".$userid."'");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function save_search_results($userid = "", $name_of_the_search = "", $CB_user_list = null)
  	{
		if (empty($userid) || empty($name_of_the_search) || empty($CB_user_list)) return 1;
		$result = 2;
		$db =& JFactory::getDBO();
		try	{
				$db->setQuery("insert into #__cbadvsearch_result_list_saved (`list_name`, `cb_user_id`) 
					values ('".$name_of_the_search."', '".$userid."')");
				$db->query();
				$list_id = $db->insertid();
				if (empty($list_id))
					{
						$db->setQuery("SELECT id FROM #__cbadvsearch_result_list_saved 
								where list_name='".$name_of_the_search."' and cb_user_id='".$userid."'");
						$ids = $db->loadObjectList();	$list_id = $ids[0]->id;
					}
			}catch (RuntimeException $e)
				{
					try	{
						$db->setQuery("SELECT id FROM #__cbadvsearch_result_list_saved 
								where list_name='".$name_of_the_search."' and cb_user_id='".$userid."'");
						$ids = $db->loadObjectList();	$list_id = $ids[0]->id;
					}catch (RuntimeException $e)
						{	/*	$e->getMessage();	    JLog::add('This query failed: '.$query);	*/
							$result = 1;	}
				}
		$cbusers = explode(",", $CB_user_list);
		foreach($cbusers as $cbu)
			if (!empty($cbu))
				try	{
						$db->setQuery("insert into #__cbadvsearch_result_list_saved_items (`cb_search_list_id`, `cb_user_owner_id`, `cb_user_found_id`) 
							values ('".$list_id."', '".$userid."', '".$cbu."')");
						$db->query();
					}catch (RuntimeException $e)
						{	/*	$e->getMessage();	    JLog::add('This query failed: '.$query);	*/
							$result = 1;	}
		return $result;
	}
	
	function ignore_search_results($userid = "", $CB_user_list = null)
  	{
		if (empty($userid) || empty($CB_user_list)) return 1;
		$result = 2;
		$db =& JFactory::getDBO();
		$users = explode(",", $CB_user_list);
		foreach($users as $user)
			if (!empty($user))
				try	{
						$db->setQuery("insert into #__cbadvsearch_result_list_ignored (`cb_user_owner_id`, `cb_user_ignored_id`) 
							values ('".$userid."', '".$user."')");
						$db->query();
					}catch (RuntimeException $e)
					{	/*	$e->getMessage();	    JLog::add('This query failed: '.$query);	*/
							$result = 1;	}
		return $result;
	}
	
	function get_ignored_search_results($userid = "")
  	{
		if (empty($userid)) return "";
		$db =& JFactory::getDBO();
		try	{
			$db->setQuery("select cb_user_ignored_id from #__cbadvsearch_result_list_ignored 
				where `cb_user_owner_id`='".$userid."'");
			$users = $db->loadObjectList();
			$new_users = array();	$new_users[] = "0";
			foreach($users as $u) $new_users[] = $u->cb_user_ignored_id;
			
			return implode(",", $new_users);
		}catch (RuntimeException $e)
			{	/*	$e->getMessage();	    JLog::add('This query failed: '.$query);	*/	return "";	}
		return "";
	}
	
	function getFields($search = 1)
	{
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT a.*, b.name as field_name, b.type as field_type 
			FROM #__cbadvsearch a left JOIN #__comprofiler_fields b on a.field_id=b.fieldid 
			where a.published='1' and a.thesearch='".$search."' order by a.ordering asc");
		$Obj = $db->loadObjectList();
		$n = count($Obj);
		
		for($i=0; $i<$n; $i++)
			{
				$ids = explode(",", $Obj[$i]->field_id);
				$m = count($ids);
				if ($m>1)
					{
						$db->setQuery("SELECT b.name as field_name, b.type as field_type 
							FROM #__comprofiler_fields b 
							where b.fieldid in (".$Obj[$i]->field_id.")");
						$additional = $db->loadObjectList();	$field_name = array();
						for($j=0; $j<=$m; $j++)
							{
								if (!empty($additional[$j]->field_name)) $field_name[] = $additional[$j]->field_name;
							}
						$Obj[$i]->field_name = @implode(",", $field_name);
					}
			}
		return $Obj;
	}
	
	function getFieldValues($fieldId)
	{
		$db =& JFactory::getDBO();
		$db->setQuery( 'SELECT fieldtitle FROM #__comprofiler_field_values where fieldid="'.$fieldId.'"' );
		$Obj = $db->loadObjectList();
		return $Obj;
	}	
	
	function getConfiguration($search = "")
	{
		$db =& JFactory::getDBO();
		$query = empty($search) ? 'SELECT * FROM #__cbadvsearchsdesc' : 'SELECT * FROM #__cbadvsearchsdesc where id="'.$search.'"';
		$db->setQuery($query);
		$Obj = $db->loadObjectList();
		return $Obj;
	}	
	
	/*	current page = the current page;
		total = total number of pages;
		number_items = number of items on each page */
	function page_list($current_page = 1, $total = 1, $number_items = 25, $number_page_list = 1)
		{
			if (empty($current_page)) $current_page = 1;
			if (empty($total)) $total = 1;
			if ($total>1)
				{
					$previous = $current_page==1 ? 1 : $current_page-1;
					$previous = '<a id="relative_left_padding5" href="javascript: setPage('.$previous.');" class="pagina" style="width: 100px; clear: left;">previous</a>';
					$next = $current_page==$total ? $total : $current_page+1;
					$next = '<a id="relative_left_padding5" href="javascript: setPage('.$next.');" class="pagina" style="width: 100px;">next</a>';
				}
			
			$page_list = '<div id="relative_left_padding5" align="center" style="margin: 1px; font-weight: bold; font-size: 12px; width: 100%; clear: both;">';
	if ($current_page>5) $page_list .= '<a id="relative_left_padding5" href="javascript: setPage(1);" class="pagina" style="width: 50px;">1</a>';
	for($i=$current_page-5; $i<=$current_page+5; $i++) if ($i>0 && $i<=$total)
		{
			if ($i==$current_page) $page_list .= '<span id="relative_left_padding5" style="font-weight: normal; width: 15px;">'.$i.'</span>';
				else $page_list .= '<a id="relative_left_padding5" href="javascript: setPage('.$i.');" style="font-weight: bold; width: 50px;">'.$i."</a>";
		}
	if ($total>$current_page+5) $page_list .= '<a id="relative_left_padding5" href="javascript: setPage(\''.$total.'\');" class="pagina" style="margin-right: auto; width: 50px;">'.$total.'</a>';
	
	$page_list .= $previous.$next.'<div id="relative_left_padding5">Display #</div>
	<select name="limit'.$number_page_list.'" id="limit'.$number_page_list.'" style="position: relative; float: left; padding: 5px;" size="1" onchange="javascript: setNumber(this.value);">';
	
	if ($number_items==5) $page_list .= '<option value="5" selected>5</option>'; else $page_list .= '<option value="5">5</option>';
	if ($number_items==10) $page_list .= '<option value="10" selected>10</option>'; else $page_list .= '<option value="10">10</option>';
	if ($number_items==15) $page_list .= '<option value="15" selected>15</option>'; else $page_list .= '<option value="15">15</option>';
	if ($number_items==20) $page_list .= '<option value="20" selected>20</option>'; else $page_list .= '<option value="20">20</option>';
	if ($number_items==25) $page_list .= '<option value="25" selected>25</option>'; else $page_list .= '<option value="25">25</option>';
	if ($number_items==30) $page_list .= '<option value="30" selected>30</option>'; else $page_list .= '<option value="30">30</option>';
	if ($number_items==50) $page_list .= '<option value="50" selected>50</option>'; else $page_list .= '<option value="50">50</option>';
	if ($number_items==100) $page_list .= '<option value="100" selected>100</option>'; else $page_list .= '<option value="100">100</option>';
	if ($number_items==-1) $page_list .= '<option value="-1" selected>All</option>'; else $page_list .= '<option value="-1">All</option>';
	$page_list .= '</select></div>';

			return $page_list;
		}
	
	function getSearch($conditions = '', $tables = '', $order_by = '', $limitstart = 0, $limit = 25, $user_groups = '', $contorx = 0)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$db->setQuery( 'SELECT * FROM #__comprofiler_fields' );
		$ObjFields = $db->loadObjectList();
		
		$count = 0;
		$fields = array();
		foreach($tables as $t)
			if ($t!="#__comprofiler")
			{
				for($i=0; $i<count($ObjFields); $i++)
					if ($ObjFields[$i]->table==$t) $fields[] = " a".$count.".".$ObjFields[$i]->name." as ".$ObjFields[$i]->name." ";
				$count++;
			}
		if ($contorx==0) $query = count($fields)>0 ? "SELECT a.*, ".implode(",", $fields)." FROM #__comprofiler a " : "SELECT a.* FROM #__comprofiler a ";
			else	$query = "SELECT count(a.id) contor FROM #__comprofiler a ";
		$count = $user_count = 0;
		foreach($tables as $t)
			if ($t!="#__comprofiler" && $t!="#__user_usergroup_map")
				{
					$query .= " left join ".$t." a".$count." on (a.user_id=a".$count.".id) ";
					if ($t=="#__users") $user_count = $count;
					$count++;
				}
		$query .= " left join #__user_usergroup_map a".$count." on (a".$user_count.".id=a".$count.".user_id) ";
		if (!empty($user_groups))
			{
				$conditions .= " and (";
				if (count($user_groups)>1 || is_array($user_groups) || strtolower($user_groups)=="array")
						foreach($user_groups as $group) $conditions .= " or a".$count.".group_id='".$group."'";
					else $conditions .= " or a".$count.".group_id='".$user_groups."'";
				$conditions .= ")";
			}
		if (!empty($conditions)) $query .= " where ".$conditions;
		if (!empty($order_by)) $query .= " order by ".$order_by;
		if ($limit>0) $query .= " limit ".$limitstart.", ".$limit;
		
		$query = str_replace("or ()", "", str_replace("and ()", "", 
			str_replace("() or", "", str_replace("() and", "", 
			str_replace("( and", "(", str_replace("( or", "(", $query))))));
		$db->setQuery("SET NAMES utf8");//, $limitstart, $limit, "#__" );
		$db->setQuery($query);//, $limitstart, $limit, "#__" );
		
	//	if (getenv('REMOTE_ADDR')=="89.120.215.183") echo "<br /><br />".$query."<br /><br />";
		
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function getListFields($listid = "")
	{
		if (empty($listid)) return null;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT l.*, c1.`name` as name1, c2.`name` as name2, c3.`name` as name3, c4.`name` as name4 
			FROM #__comprofiler_lists l
			left join #__comprofiler_fields c1 on c1.fieldid=l.col1fields 
			left join #__comprofiler_fields c2 on c2.fieldid=l.col2fields 
			left join #__comprofiler_fields c3 on c3.fieldid=l.col3fields 
			left join #__comprofiler_fields c4 on c4.fieldid=l.col4fields 
			where listid='".$listid."' and l.published='1'");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function getListSearch($listid = "", $searchword = "", $ignored_users = "", $limitstart = 0, $limit = 25)
	{
		if (empty($listid)) return null;
		
		global $mainframe;
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__comprofiler_lists where listid='".$listid."' and published='1'");
		$list = $db->loadObjectList();
		if (empty($list)) return null;
		
		$db->setQuery("SELECT `fieldid`, `name`, `tablecolumns`, `table` FROM #__comprofiler_fields");
		$fields = $db->loadObjectList();
		
		$conditions_extra = array();	$query_fields = "";
		foreach($fields as $f)
			{
				if (($f->fieldid==$list[0]->col1fields && $list[0]->col1enabled==1) || 
					($f->fieldid==$list[0]->col2fields && $list[0]->col2enabled==1) || 
					($f->fieldid==$list[0]->col3fields && $list[0]->col3enabled==1) || 
					($f->fieldid==$list[0]->col4fields && $list[0]->col4enabled==1))
					{
						if (!empty($f->tablecolumns)) if (strpos($f->tablecolumns, ",")>0) $column = explode(",", $f->tablecolumns);
														else $column = $f->tablecolumns;
								else $column = $f->name;
						if ($f->table=="#__users")
							{
								if (is_array($column) || strtolower($column)=="array")
									{
										foreach($column as $v) if (!empty($v))
											{
												$query_fields .= "u.`".$v."`, ";
												if (!empty($searchword)) $conditions_extra[] = "u.`".$v."` like '%".$searchword."%'";
											}
									}
									else {
								$query_fields .= "u.`".$column."`, ";
								if (!empty($searchword)) $conditions_extra[] = "u.`".$column."` like '%".$searchword."%'";
										}
							}
						if ($f->table=="#__comprofiler")
							{
								if (is_array($column) || strtolower($column)=="array")
									{
										foreach($column as $v) if (!empty($v))
											{
												$query_fields .= "cb.`".$v."`, ";
												if (!empty($searchword)) $conditions_extra[] = "cb.`".$v."` like '%".$searchword."%'";
											}
									}
									else {
								if ($column=="formatname") $query_fields .= "u.`name` as formatname, ";
									else $query_fields .= "cb.`".$column."`, ";
								if (!empty($searchword)) $conditions_extra[] = "cb.`".$column."` like '%".$searchword."%'";
										}
								$initial = "cb";
							}
					}
				if ($f->table=="#__users") $initial = "u";
				if ($f->table=="#__comprofiler") $initial = "cb";
				$list[0]->filterfields = str_replace("`".$f->name."`", $initial.".`".$f->name."`", $list[0]->filterfields);
				$list[0]->sortfields = str_replace("`".$f->name."`", $initial.".`".$f->name."`", $list[0]->sortfields);
			}
		$filterfields = !empty($list[0]->filterfields) ? str_replace("%25", "%", str_replace("s(", "", str_replace(")", "", $list[0]->filterfields))) : "1=1";
		$query = "SELECT ".$query_fields."cb.`id` FROM #__comprofiler cb
			left join #__users u on u.id=cb.user_id 
			where ".$filterfields;
		$conditions_extra = str_replace("()", "(1=1)", $conditions_extra);
		if (!empty($conditions_extra)) $query .= " and (".implode(" or ", $conditions_extra).")";
		if (!empty($ignored_users)) $query .= " and cb.`user_id` not in (".$ignored_users.")";
		$query .= " order by ".$list[0]->sortfields;
		if ($limit>0) $query .= " limit ".$limitstart.", ".$limit;
		
		$query = str_replace('cb.`formatname`', 'concat_ws(lower(cb.`firstname`),lower(cb.`middlename`),lower(cb.`lastname`))', $query);
	//	echo "<br /><br />".$query."<br /><br />";
		$db->setQuery("SET NAMES utf8");//, $limitstart, $limit, "#__");
		$db->setQuery($query);//, $limitstart, $limit, "#__");
		$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	function getPagination($total = 0)
	{
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $total, $this->getState('limitstart'), $this->getState('limit') );
		}	
	}

	function getInformationSchemaField()
	{
		$db =& JFactory::getDBO();

		$query = "DESC #__comprofiler";
		$db->setQuery( $query );
		$Obj = $db->loadObjectList();

		return $Obj;
	}
	
	/**
	 * Retrieves the cbadvsearch configuration
	 * @return array Array of objects containing the data from the database
	 */
	function getConfigurationTranslation()
  	{
		// Load the data
		return $this->_getList('SELECT * FROM #__cbadvsearchconfig');
	}
	
}

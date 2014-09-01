<?php 
/**
 * Cbadvsearch Model for CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @subpackage Components
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
@error_reporting(0);

/**
 * CB Adv. Search
 *
 */
class modCbadvsearchModelCbadvsearchSearch
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
	 
	/**
	 * checks if there is the table #__user_usergroup_map
	 * @return true of yes, false if no
	 */
	function is_user_usergroup_map()
  	{
		$db =& JFactory::getDBO();
		$result = $db->loadObjectList("show tables like '%_user_usergroup_map%'");
		if (count($result)>0) return true;
		return false;
	}
	
	function save_search_form($userid = "", $name_of_the_search = "", $fields_to_save = null)
  	{
		if (empty($userid) || empty($name_of_the_search) || empty($fields_to_save)) return 1;
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
		if (empty($userid) || empty($CB_user_list)) return false;
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
	
	public static function getFields($search = 1)
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
	
	public static function getFieldValues($fieldId)
	{
		$db =& JFactory::getDBO();
		$db->setQuery( 'SELECT fieldtitle FROM #__comprofiler_field_values where fieldid="'.$fieldId.'"' );
		$Obj = $db->loadObjectList();
		return $Obj;
	}	
	
	public static function getConfiguration($search = "")
	{
		$db =& JFactory::getDBO();
		$query = empty($search) ? 'SELECT * FROM #__cbadvsearchsdesc' : 'SELECT * FROM #__cbadvsearchsdesc where id="'.$search.'"';
		$db->setQuery($query);
		$Obj = $db->loadObjectList();
		return $Obj;
	}	
	
	public function getSearch($conditions = '', $tables = '', $order_by = '', $limitstart = 0, $limit = 25, $user_groups = "", $contorx = 0)
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
		if ($countx==0) $query = count($fields)>0 ? "SELECT a.*, ".implode(",", $fields)." FROM #__comprofiler a " : "SELECT a.* FROM #__comprofiler a ";
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
				if (count($user_groups)>1) foreach($user_groups as $group) $conditions .= " or a".$count.".group_id='".$group."'";
					else $conditions .= " or a".$count.".group_id='".$user_groups."'";
				$conditions .= ")";
			}
		if (!empty($conditions)) $query .= " where ".$conditions;
		if (!empty($order_by)) $query .= " order by ".$order_by;
		if ($limit>0) $query .= " limit ".$limitstart.", ".$limit;
		$query = str_replace("or ()", "", str_replace("and ()", "", 
			str_replace("() or", "", str_replace("() and", "", 
			str_replace("( and", "(", str_replace("( or", "(", $query))))));
	//	$db->setQuery("SET NAMES utf8");//, $limitstart, $limit, "#__" );
	//	$db->setQuery($query);//, $limitstart, $limit, "#__" );
	//	$Obj = $db->loadObjectList();
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
								$query_fields .= "u.`".$column."`, ";
								if (!empty($searchword)) $conditions_extra[] = "u.`".$column."` like '%".$searchword."%'";
							}
						if ($f->table=="#__comprofiler")
							{
								if ($column=="formatname") $query_fields .= "u.`name` as formatname, ";
									else $query_fields .= "cb.`".$column."`, ";
								if (!empty($searchword)) $conditions_extra[] = "cb.`".$column."` like '%".$searchword."%'";
								$initial = "cb";
							}
					}
				if ($f->table=="#__users") $initial = "u";
				if ($f->table=="#__comprofiler") $initial = "cb";
				$list[0]->filterfields = str_replace("`".$f->name."`", $initial.".`".$f->name."`", $list[0]->filterfields);
				$list[0]->sortfields = str_replace("`".$f->name."`", $initial.".`".$f->name."`", $list[0]->sortfields);
			}
		$query = "SELECT ".$query_fields."cb.`id` FROM #__comprofiler cb
			left join #__users u on u.id=cb.user_id 
			where ".str_replace("%25", "%", str_replace("s(", "", str_replace(")", "", $list[0]->filterfields)));
		if (!empty($conditions_extra)) $query .= " and (".implode(" or ", $conditions_extra).")";
		if (!empty($ignored_users)) $query .= " and cb.`user_id` not in (".$ignored_users.")";
		$query .= " order by ".$list[0]->sortfields;
		if ($limit>0) $query .= " limit ".$limitstart.", ".$limit;
		$query = str_replace('cb.`formatname`', 'concat_ws(lower(cb.`firstname`),lower(cb.`middlename`),lower(cb.`lastname`))', $query);
	//	$db->setQuery("SET NAMES utf8");//, $limitstart, $limit, "#__");
	//	$db->setQuery($query);//, $limitstart, $limit, "#__");
	//	$Obj = $db->loadObjectList();
		return $Obj;
	}
	
	public static function getInformationSchemaField()
	{
		$db =& JFactory::getDBO();

		$query = "DESC #__comprofiler";
		$db->setQuery( $query );
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
			
			$page_list = '<div id="relative_left_padding5" align="center" style="margin: 1px; font-weight: bold; font-size: 12px; width: 100%; clear: both;">';
	if ($current_page>5) $page_list .= '<a id="relative_left_padding5" href="javascript: setPage_module(1);" class="pagina" style="width: 50px;">1</a>';
	for($i=$current_page-5; $i<=$current_page+5; $i++) if ($i>0 && $i<=$total)
		{
			if ($i==$current_page) $page_list .= '<span id="relative_left_padding5" style="font-weight: normal; width: 15px;">'.$i.'</span>';
				else $page_list .= '<a id="relative_left_padding5" href="javascript: setPage_module('.$i.');" style="font-weight: bold; width: 15px;">'.$i."</a>";
		}
	if ($total>$current_page+5) $page_list .= '<a id="relative_left_padding5" href="javascript: setPage_module(\''.$total.'\');" class="pagina" style="margin-right: auto; width: 50px;">'.$total.'</a>';
	
	$page_list .= '<div id="relative_left_padding5">Display #</div>
	<select name="limit'.$number_page_list.'" id="limit'.$number_page_list.'" style="position: relative; float: left; padding: 5px;" size="1" onchange="javascript: setNumber_module(this.value);">';
	
	if ($number_items==5) $page_list .= '<option value="5" selected>5</option>'; else $page_list .= '<option value="5">5</option>';
	if ($number_items==10) $page_list .= '<option value="10" selected>10</option>'; else $page_list .= '<option value="10">10</option>';
	if ($number_items==15) $page_list .= '<option value="15" selected>15</option>'; else $page_list .= '<option value="15">15</option>';
	if ($number_items==20) $page_list .= '<option value="20" selected>20</option>'; else $page_list .= '<option value="20">20</option>';
	if ($number_items==25) $page_list .= '<option value="25" selected>25</option>'; else $page_list .= '<option value="25">25</option>';
	if ($number_items==30) $page_list .= '<option value="30" selected>30</option>'; else $page_list .= '<option value="30">30</option>';
	if ($number_items==50) $page_list .= '<option value="50" selected>50</option>'; else $page_list .= '<option value="50">50</option>';
	if ($number_items==100) $page_list .= '<option value="100" selected>100</option>'; else $page_list .= '<option value="100">100</option>';
	if ($number_items==0) $page_list .= '<option value="0" selected>All</option>'; else $page_list .= '<option value="0">All</option>';
	$page_list .= '</select></div>';

			return $page_list;
		}
	
	function getTheSearch($search = 1, $searchURL = "")
	{
		$configuration = $this->getConfigurationTranslation();
		$user =& JFactory::getUser();
					
		$lang = JRequest::getString('lang', '', 'post');
		if (empty($lang)) $lang = JRequest::getString('lang', '', 'get');
		if (empty($lang) || $lang=="en") $lang = "en-GB";
		
		include('components/com_cbadvsearch/language_en.php' );
		if (!empty($configuration))
			foreach($configuration as $cf)
				{
					if ($cf->language==$lang)	{ $configuration = $cf;	break;	}
				}
			else	$configuration = (object)$language_cbadvsearch;
		$fieldsconfig = $this->getConfiguration($search);
		$badchars = array('#','>','<','\\'); 
		$searchword = trim(str_replace($badchars, '', JRequest::getString('searchword_mod', null, 'post')));
		$search_type = JRequest::getString("search_type", null, 'post');
		
		$list_hidden = JRequest::getString("list-hidden", null, 'post');
		$list_hidden = empty($list_hidden) ? "yes" : $list_hidden;
		
		$number_items = JRequest::getString('number_items', null, 'post');
		$number_items = empty($number_items) || !is_numeric($number_items) ? 25 : $number_items;
		$current_page = JRequest::getString('current_page', null, 'post');
		$current_page = empty($current_page) || !is_numeric($current_page) ? 1 : $current_page;
		
		$order_field = JRequest::getString("order_field", null, 'post');
		$order_asc = JRequest::getString("order_asc", null, 'post');
		$order_asc = empty($order_asc) ? "asc" : $order_asc;
		$order_field = $order_field=="rand()" ? $order_field : $order_field." ".$order_asc;
		$order_by = empty($order_field) ? $fieldsconfig[0]->order_by : $order_field;
		
		$empty_fields = JRequest::getString("empty_fields", null, 'post');
		$empty_fields = empty($empty_fields) ? $fieldsconfig[0]->empty_fields : $empty_fields;
		
		$user_groups = $fieldsconfig[0]->user_groups;
		
		$words = array("searchword_mod", "Search", "view", "task", "", "language", "limit", "limit1", "limit2", "limitstart", 
			"option", "search_type", "list-hidden", "order_field", "order_asc", "number_items", "current_page", "lang", 
			"searchword", "layout", "save_ignore_users_action_module", "save_ignore_users_values_module", "cbuserlista", "save_the_search",
			"name_of_the_search", "checkentirelist", "cbuserlistaModule");
		$save_the_search = trim(str_replace($badchars, '', JRequest::getString('save_the_search', null, 'post')));
		$name_of_the_search = trim(str_replace($badchars, '', JRequest::getString('name_of_the_search', null, 'post')));
		
		$save_ignore_users_action_module = trim(str_replace($badchars, '', JRequest::getString('save_ignore_users_action_module', null, 'post')));
		$save_ignore_users_values_module = trim(str_replace($badchars, '', JRequest::getString('save_ignore_users_values_module', null, 'post')));
		
		if (!empty($user->id) && $save_ignore_users_action_module=="ignore" && !empty($save_ignore_users_values_module))
			{
				$save_ignore_users_action_result = $this->ignore_search_results($user->id, $save_ignore_users_values_module);
			}
		if (!empty($user->id) && $save_ignore_users_action_module=="save" && !empty($save_ignore_users_values_module) && !empty($name_of_the_search))
			{
				$save_ignore_users_action_result = $this->save_search_results($user->id, $name_of_the_search, $save_ignore_users_values_module);
			}
		$ignored_users = !empty($user->id) ? $this->get_ignored_search_results($user->id) : "";
		if ($fieldsconfig[0]->search_by_fields_or_cblists==1) /* the search is done by the CB lists */
			{
				$fieldsconfig[0]->show_the_searchfield = 1;
				if ($search_type=="module")
					{
						$list_fields = $this->getListFields($fieldsconfig[0]->cblist_id);
						
						$searchTotalResult = $this->getListSearch($fieldsconfig[0]->cblist_id, $searchword, $ignored_users, 0, 0);
						$number_items2 = $number_items==-1 ? $searchTotalResult : $number_items;
						
						$searchResult = $this->getListSearch($fieldsconfig[0]->cblist_id, $searchword, $ignored_users, ($current_page-1)*$number_items2, $number_items2);
						$total = ceil(count($searchTotalResult)/$number_items2);
						$searchPagination1 = $this->page_list($current_page, $total, $number_items, 1);
						$searchPagination2 = $this->page_list($current_page, $total, $number_items, 2);
					}
			}
		if ($fieldsconfig[0]->search_by_fields_or_cblists==0) /* the search is done by the CB fields */
			{
	//	$this->assignRef('description', $fieldsconfig[0]->description);
	//	$this->assignRef('listing', $fieldsconfig[0]->listing);
		$fields = $this->getFields($search);
		$field_id = $arrField_name = $fieldLabel = $fieldLabelSearcable = $field_type = $fileDescription = $field_searchable = 
			$fill_in_text = $css_class = $searchFields = array();
		
		$default_form_values = $this->get_default_form_values($user->id);
		for ($i=0, $n=count($fields); $i < $n; $i++)
		{
			$field_id = $fields[$i]->field_id;
			$arrField_name[] = $field_name = $fields[$i]->field_name;
			$appears_results[] = $fields[$i]->appears_results;
			$fieldLabel[] = $field_label = $fields[$i]->label;
			$field_type = $fields[$i]->field_type;
			$fileDescription[] = $field_description = $fields[$i]->description;
			
			$fields[$i]->fill_in_text = @addslashes(strtolower($fields[$i]->fill_in_text));
			$css_class[] = $fields[$i]->css_class;
			
			$field_searchable = $fields[$i]->searchable;
			$field_name_post = JRequest::getString($field_name, $fields[$i]->fill_in_text, 'post');
			
			if (empty($_POST)) if (!empty($default_form_values)) foreach($default_form_values as $dfv)
				if ($dfv->cb_field_name==$field_name)	{	$field_name_post = $dfv->cb_field_value; break;	}
			
			if (!empty($field_searchable))
				{
					$fieldLabelSearcable[] = $field_label;
					$fileDescriptionSearcable[] = $field_description;
					$values = array("text", "date", "textarea", "webaddress", "emailaddress", "predefined", "primaryemailaddress", "counter");
					$values2 = array("image");
			if (in_array($field_type, $values))
			{
				$searchFields[] = strpos(" ".$field_name_post, "'") ? '<input type="text" name="'.$field_name.'" value="'.$field_name_post.'" />' 
					: "<input type='text' name='".$field_name."' value='".$field_name_post."' />";
			}
			elseif ($field_type == 'select' || $field_type == 'multiselect')
			{
				if (!empty($_POST)) $field_name_post = JRequest::getVar($field_name, '', '', 'array');
					else $field_name_post = explode(",", $field_name_post);

				$select = $field_type == 'multiselect' ? "<select multiple name='".$field_name."[]' />" : "<select name='".$field_name."[]' />";
				$select .= "<option value=''>".$configuration->select."</option>";

				$fieldValues = $this->getFieldValues($field_id);
				for ($j=0, $m=count($fieldValues); $j < $m; $j++)
				{
					$field_v = $fieldValues[$j]->fieldtitle;
					$selected = false;
					foreach($field_name_post as $p)
						{
							if ($p == $field_v)
								{
									$select .= strpos(" ".$field_v, "'") ? '<option value="'.$field_v.'" selected>'.$field_v.'</option>' 
										: "<option value='".$field_v."' selected>".$field_v."</option>";
									$selected = true;
								}
						}
						if ($selected==false) $select .= strpos(" ".$field_v, "'") ? '<option value="'.$field_v.'">'.$field_v.'</option>' 
										: "<option value='".$field_v."'>".$field_v."</option>";
				}
				$select .= "</select>";		$searchFields[] = $select;
			}
			elseif($field_type == 'radio')
			{
				$radio = "";
				$fieldValues = $this->getFieldValues($field_id);
				for ($j=0, $m=count($fieldValues); $j < $m; $j++)
				{
					$field_v = $fieldValues[$j]->fieldtitle;
					$checked = $field_name_post == $field_v ? "checked" : "";
					$radio .= strpos(" ".$field_v, "'") ? '<input type="radio" value="'.$field_v.'" name="'.$field_name.'" '.$checked.' />&nbsp;'.$field_v.'&nbsp;&nbsp;' 
						: "<input type='radio' value='".$field_v."' name='".$field_name."' ".$checked." />&nbsp;".$field_v."&nbsp;&nbsp;";
				}	
				$searchFields[] = $radio;	$searchFields2[] = $radio2;
			}
			elseif($field_type == 'checkbox')
			{
				$checkbox = $checkbox2 = "";
				$fieldValues = $this->getFieldValues($field_id);
				for ($j=0, $m=count($fieldValues); $j < $m; $j++)
				{
					$field_v = $fieldValues[$j]->fieldtitle;
					$checked = $field_name_post == $field_v ? "checked" : "";
					$checkbox .= strpos(" ".$field_v, "'") ? '<input type="checkbox" value="'.$field_v.'" name="'.$field_name.'" '.$checked.' />&nbsp;'.$field_v.'&nbsp;&nbsp;' 
						: "<input type='checkbox' value='".$field_v."' name='".$field_name."' ".$checked." />&nbsp;".$field_v."&nbsp;&nbsp;";
				}	
				$searchFields[] = $checkbox;		$searchFields2[] = $checkbox2;
			}
			elseif($field_type == 'multicheckbox')
			{
				$checkbox = " ";
				$fieldValues = $this->getFieldValues($field_id);
				if (!empty($_POST)) $field_name_post = JRequest::getVar($field_name, '', '', 'array');
					else $field_name_post = explode(",", $field_name_post);
				
				$count = 0;
				for ($j=0, $m=count($fieldValues); $j < $m; $j++)
				{
					$count++;
					$field_v = $fieldValues[$j]->fieldtitle;
					$break = $count%3==0 ? "<br />" : "";
					foreach($field_name_post as $p)
						{
							$addp = @addslashes($p);
							$checked = $p==$field_v || $addp==$field_v ? "checked" : "";
							if ($p == $field_v || $addp==$field_v)
								if (strpos(" ".$field_v, "'"))
										$checkbox .= '<input type="checkbox" value="'.$field_v.'" name="'.$field_name.'[]" '.$checked.' />&nbsp;'.$field_v.'&nbsp;&nbsp;';
									else $checkbox .= "<input type='checkbox' value='".$field_v."' name='".$field_name."[]' ".$checked." />&nbsp;".$field_v."&nbsp;&nbsp;";
						}
					if (strpos($checkbox, "<input type='checkbox' value='".$field_v."' name='".$field_name."[]' ")==false && strpos($checkbox, '<input type="checkbox" value="'.$field_v.'" name="'.$field_name.'[]"')==false)
							$checkbox .= strpos(" ".$field_v, "'") ? '<input type="checkbox" value="'.$field_v.'" name="'.$field_name.'[]" '.$checked.' />&nbsp;'.$field_v.'&nbsp;&nbsp;' 
								: "<input type='checkbox' value='".$field_v."' name='".$field_name."[]' ".$checked." />&nbsp;".$field_v."&nbsp;&nbsp;";
				}	
				$searchFields[] = $checkbox;
			}
			else	if (in_array($field_type, $values2))	$searchFields[] = "<br>";
				}
		}
		if ($search_type=="module")
			{
			$query = "select * from #__comprofiler_fields";
			$db =& JFactory::getDBO();		$db->setQuery($query);
			$result = $db->loadAssocList();
			$tables = array();
			foreach($result as $r)
				{
					if (!in_array($r['table'], $tables) &$r['table']!="#__comprofiler") $tables[] = $r['table'];
				}
			if (!empty($user_groups))
				{
					$user_groups = explode(",", $user_groups);
					if (!in_array("#__users", $tables)) $tables[] = "#__users";
					if ($this->is_user_usergroup_map()==true) $tables[] = "#__user_usergroup_map";
				}
			$tables_size = count($tables);
			
			$conditions = "(";
			if ($searchword != "")
				{
					$fieldsx = $this->getInformationSchemaField();
					$strFields = "";
					$nx=count($fieldsx);
					for ($i=0; $i < $nx; $i++)
						{
							$strFields .= ', lower(a.`'.$fieldsx[$i]->Field.'`)';
						}

					$arrSearchWord = explode(" ", $searchword);
					// list of exception words
					$arrExceptionWords = array('a','an','the','of','in','into','for');
	
					for($i=0; $i<count($arrSearchWord); $i++)
						if(!empty($arrSearchWord[$i]) && !in_array($arrSearchWord[$i], $arrExceptionWords))
						{
							if($conditions == "(")
								$conditions .= "concat_ws(' '$strFields) like '%".strtolower($arrSearchWord[$i])."%'";
							else
								$conditions .= " OR concat_ws(' '$strFields) like '%".strtolower($arrSearchWord[$i])."%'";
						}			
				}
			$conditions .= ")";
			
			if (!empty($user_groups) && $this->is_user_usergroup_map()==false)
				{
					for($i=0; $i<$tables_size; $i++)
						if ($tables[$i]=="#__users")	{	$field = "`a".$i."`.`usertype`";	break;	}
					$conditions .= " and (";
					foreach($user_groups as $group) $conditions .= " or ".$field." like '%".$group."%'";
					$conditions .= ")";
				}
			for($i=0; $i<$tables_size; $i++)
				{
					if ($tables[$i]=="#__users")	$conditions .= " and `a".$i."`.`block`=0 ";
				}
			$conditions .= " and `a`.`approved`=1 and `a`.`confirmed`=1 ";
			if ($conditions=="()") $conditions = "(1=1)";
			$fields_to_save = array();
			foreach($_POST as $key => $value)
				if (!empty($value))
				{
					if(!in_array($key, $words))
						{
							if (is_array($value)) $value_to_save = implode(",", $value);
								elseif (strtolower($value)=="array")
									{
										$values_to_save = array();
										foreach($value as $v) if (!empty($v))
											{
												$v = trim(strip_tags($v));
												if (strpos("\\", $v)>0) $v = @addslashes($v);
												$values_to_save[] = $v;
											}
										$value_to_save = implode(",", $values_to_save);
									}else $value_to_save = $value;
							$fields_to_save[] = array($key, $value_to_save);
							
							$keys = explode(",", $key);	$nk = count($keys);
							$conditions .= " and (";
							foreach($keys as $key)
								{
							$field = "a.`".$key."`";
							foreach($result as $r)
								{
									if ($r['name']==$key && $r['table']!="#__comprofiler")
										for($i=0; $i<$tables_size; $i++)
											if ($tables[$i]==$r['table'])	$field = "`a".$i."`.`".$key."`";
									if ($r['name']==$key && $r['table']=="#__comprofiler")
										$field = "`a`.`".$key."`";
									if ($r['name']==$key && empty($r['tablecolumns'])) $field = "";
								}
							if (empty($field)) continue;
							$comparison_sign = "like";	$continue_search = 1;
							for ($i=0; $i < $n; $i++)
								if ($key==$fields[$i]->field_name)
								{
									$comparison_sign = $fields[$i]->comparison_sign;
									if ($value==$fields[$i]->fill_in_text || @addslashes($value)==$fields[$i]->fill_in_text) $continue_search = 0;
									break;
								}
							$comparison_sign = str_replace("&lt", "<", $comparison_sign);
							if ($continue_search==1)
							if ($key == "cb_sex")	$conditions .= " or ".$field." = '".$value."'";
								elseif (is_array($value))
									{
										$conditions .= " and (";
										foreach($value as $v) if (!empty($v))
											{
												$v = trim(strip_tags($v));
												if (strpos("\\", $v)>0) $v = @addslashes($v);
												$conditions .= $comparison_sign=="like" ? " or lower(".$field.") like '%".strtolower($v)."%'"
													: " or lower(".$field.") ".$comparison_sign." '".strtolower($v)."'";
											}
										$conditions .= ") ";
									}
								elseif (strtolower($value)=="array")
									{
										$conditions .= " and (";
										foreach($value as $v) if (!empty($v))
											{
												$v = trim(strip_tags($v));
												if (strpos("\\", $v)>0) $v = @addslashes($v);
												$conditions .= $comparison_sign=="like" ? " or lower(".$field.") like '%".strtolower($v)."%'"
													: " or lower(".$field.") ".$comparison_sign." '".strtolower($v)."'";
											}
										$conditions .= ") ";
									}	else	{
													$value = trim(strip_tags($value));
													if (strpos("\\", $value)>0) $value = @addslashes($value);
													$conditions .= $comparison_sign=="like" ? " or lower(".$field.") like '%".strtolower($value)."%'"
														: " or lower(".$field.") ".$comparison_sign." '".strtolower($value)."'";
												}
								}
								$conditions .= " ) ";
						}
				}
			if (!empty($user->id) && !empty($save_the_search) && !empty($fields_to_save))
				{
					$this->save_search_form($user->id, $name_of_the_search, $fields_to_save);
				}
			$conditions = str_replace("or ( )", "", str_replace("or ()", "", str_replace("and ()", "", str_replace("and ( )", "", 
				str_replace("() or", "", str_replace("() and", "", 
				str_replace("( and", "(", str_replace("( or", "(", $conditions))))))));
			if (!empty($ignored_users)) $conditions.= " and a.user_id not in (".$ignored_users.")";
			if ($conditions!="(1=1)")
				{
					$searchTotalResult = $this->getSearch($conditions, $tables, "", 0, 0, $user_groups, 1);
					$number_items2 = $number_items==-1 ? $searchTotalResult[0]->contor : $number_items;
					$searchResult = $this->getSearch($conditions, $tables, $order_by, ($current_page-1)*$number_items2, $number_items2, $user_groups, 0);
					$total = ceil($searchTotalResult[0]->contor/$number_items2);
					$searchPagination1 = $this->page_list($current_page, $total, $number_items, 1);
					$searchPagination2 = $this->page_list($current_page, $total, $number_items, 2);
				}
			}
		}
		
		//get the cbadvsearch
		$object = array();
		$object[] = array("searchword" => $searchword);
		$object[] = array("fieldsconfig" => $fieldsconfig);
		$object[] = array("description" => $fieldsconfig[0]->description);
		$object[] = array("listing" => $fieldsconfig[0]->listing);
		$object[] = array("arrField_name" => $arrField_name);
		
		$object[] = array("fieldLabels" => $fieldLabel);
		$object[] = array("fieldLabelSearcable" => $fieldLabelSearcable);
		$object[] = array("searchFields" => $searchFields);
		$object[] = array("fileDescription" => $fileDescription);
		$object[] = array("fileDescriptionSearcable" => $fileDescriptionSearcable);
		
		$object[] = array("searchResult" => $searchResult);
		$object[] = array("searchPagination1" => $searchPagination1);
		$object[] = array("search_type" => $search_type);
		$object[] = array("list_hidden" => $list_hidden);
		$object[] = array("order_by" => $order_by);
		
		$object[] = array("empty_fields" => $empty_fields);
		$object[] = array("show_order_by" => $fieldsconfig[0]->show_order_by);
		$object[] = array("show_avatar" => $fieldsconfig[0]->show_avatar);
		$object[] = array("show_numbers" => $fieldsconfig[0]->show_numbers);
		$object[] = array("number_items" => $number_items);
		
		$object[] = array("current_page" => $current_page);
		$object[] = array("total" => count($searchResult));
		$object[] = array("searchPagination2" => $searchPagination2);
		$object[] = array("language_shortcode" => $lang);
		$object[] = array("configuration" => $configuration);
		
		$object[] = array("default_language" => $language_cbadvsearch);
		$object[] = array("show_the_searchfield" => $fieldsconfig[0]->show_the_searchfield);
		$object[] = array("user_groups" => $user_groups);
		$object[] = array("css_class" => $css_class);
		$object[] = array("searchTotalResult" => $searchTotalResult[0]->contor);
		
		$object[] = array("search_by_fields_or_cblists" => $fieldsconfig[0]->search_by_fields_or_cblists);
		$object[] = array("list_fields" => $list_fields);
		$object[] = array("CBuser" => $user);
		$object[] = array("save_the_search" => $save_the_search);
		$object[] = array("name_of_the_search" => $name_of_the_search);
		
		$object[] = array("save_ignore_users_action_module" => $save_ignore_users_action_module);
		$object[] = array("save_ignore_users_values_module" => $save_ignore_users_values_module);
		$object[] = array("save_ignore_users_action_result" => $save_ignore_users_action_result);
		$object[] = array("appears_results" => $appears_results);
		$object[] = array("searchURL" => $searchURL);
		return $object;
	}
	
	/**
	 * Retrieves the cbadvsearch configuration
	 * @return array Array of objects containing the data from the database
	 */
	function getConfigurationTranslation()
  	{
		// Load the data
		$db =& JFactory::getDBO();
		$db->setQuery('SELECT * FROM #__cbadvsearchconfig');
		return $db->loadObjectList();
	}
}
?>
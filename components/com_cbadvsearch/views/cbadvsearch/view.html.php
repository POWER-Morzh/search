<?php
/**
 * CB Adv. Search Component
 * 
 * @package    cbadvsearch
 * @license		GNU/GPL
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the cbadvsearch Component
 *
 * @package		cbadvsearch
 * @subpackage	Components
 */
				
class CbadvsearchViewCbadvsearch extends JViewLegacy
{
	function display($tpl = null)
	{
		$user =& JFactory::getUser();
		$this->assignRef('CBuser',$user);
		$lang = JRequest::getString('lang', '', 'post');
		if (empty($lang)) $lang = JRequest::getString('lang', '', 'get');
		if (empty($lang) || $lang=="en") $lang = "en-GB";
		$this->assignRef('language_shortcode', $lang);
		
		//get the cbadvsearch
		$model =& $this->getModel();
		$configuration = $model->getConfigurationTranslation();
		
		include('components/com_cbadvsearch/language_en.php' );
		$this->assignRef('default_language', $language_cbadvsearch);
		if (!empty($configuration))
			foreach($configuration as $cf)
				{
					if ($cf->language==$lang)	{ $configuration = $cf;	break;	}
				}
			else	$configuration = (object)$language_cbadvsearch;
		$this->assignRef('configuration', $configuration);
		
		$badchars = array('#','>','<','\\'); 
		$searchword = trim(str_replace($badchars, '', JRequest::getString('searchword', null, 'post')));
		$this->assignRef('searchword', $searchword);
		$search_type = JRequest::getString("search_type", null, 'post');
		$this->assignRef('search_type', $search_type);
		$didSearch = trim(str_replace($badchars, '', JRequest::getString('task', null, 'post')));
		$this->assignRef('task',$didSearch);
		
		$model = $this->getModel('Cbadvsearch');
		$fields = $model->getConfiguration(1);
		$this->assignRef('description', $fields[0]->description);
		$this->assignRef('listing', $fields[0]->listing);
		
		$this->assignRef('show_order_by', $fields[0]->show_order_by);
		$this->assignRef('show_avatar', $fields[0]->show_avatar);
		$this->assignRef('show_numbers', $fields[0]->show_numbers);
		
		$user_groups = $fields[0]->user_groups;
		
		$number_items = JRequest::getString('number_items', null, 'post');
		$number_items = empty($number_items) || !is_numeric($number_items) ? 25 : $number_items;
		$this->assignRef('number_items', $number_items);
		$current_page = JRequest::getString('current_page', null, 'post');
		$current_page = empty($current_page) || !is_numeric($current_page) ? 1 : $current_page;
		$this->assignRef('current_page', $current_page);
		
		$this->assignRef('search_by_fields_or_cblists', $fields[0]->search_by_fields_or_cblists);
		
		$words = array("searchword_mod", "Search", "view", "task", "", "language", "limit", "limit1", "limit2", "limitstart", 
			"option", "search_type", "list-hidden", "order_field", "order_asc", "number_items", "current_page", "lang", 
			"searchword", "layout", "save_ignore_users_action", "save_ignore_users_values", "cbuserlista", "save_the_search",
			"name_of_the_search", "checkentirelist");
		$save_the_search = trim(str_replace($badchars, '', JRequest::getString('save_the_search', null, 'post')));
		$this->assignRef('save_the_search',$save_the_search);
		$name_of_the_search = trim(str_replace($badchars, '', JRequest::getString('name_of_the_search', null, 'post')));
		$this->assignRef('name_of_the_search',$name_of_the_search);
		
		$save_ignore_users_action = trim(str_replace($badchars, '', JRequest::getString('save_ignore_users_action', null, 'post')));
		$this->assignRef('save_ignore_users_action',$save_ignore_users_action);
		$save_ignore_users_values = trim(str_replace($badchars, '', JRequest::getString('save_ignore_users_values', null, 'post')));
		$this->assignRef('save_ignore_users_values',$save_ignore_users_values);
		
		if (!empty($user->id) && $save_ignore_users_action=="ignore" && !empty($save_ignore_users_values))
			{
				$save_ignore_users_action_result = $model->ignore_search_results($user->id, $save_ignore_users_values);
			}
		if (!empty($user->id) && $save_ignore_users_action=="save" && !empty($save_ignore_users_values) && !empty($name_of_the_search))
			{
				$save_ignore_users_action_result = $model->save_search_results($user->id, $name_of_the_search, $save_ignore_users_values);
			}
		$ignored_users = !empty($user->id) ? $model->get_ignored_search_results($user->id) : "";
		$this->assignRef('save_ignore_users_action_result', $save_ignore_users_action_result);
		
		if ($fields[0]->search_by_fields_or_cblists==1) /* the search is done by the CB lists */
			{
				$fields[0]->show_the_searchfield = 1;
				if ($didSearch != "" && $search_type=="component")
					{
						$list_fields = $model->getListFields($fields[0]->cblist_id);
						$this->assignRef('list_fields', $list_fields);
						
						$searchTotalResult = $model->getListSearch($fields[0]->cblist_id, $searchword, $ignored_users, 0, 0);
						$number_items2 = $number_items==-1 ? $searchTotalResult : $number_items;
						
						$searchResult = $model->getListSearch($fields[0]->cblist_id, $searchword, $ignored_users, ($current_page-1)*$number_items2, $number_items2);
						$total = ceil(count($searchTotalResult)/$number_items2);
						$searchPagination1 = $model->page_list($current_page, $total, $number_items, 1);
						$searchPagination2 = $model->page_list($current_page, $total, $number_items, 2);
						
						$this->assignRef('searchResult',$searchResult);
						$this->assignRef('searchTotalResult',count($searchTotalResult));
						$this->assignRef('pagination1', $searchPagination1);
						$this->assignRef('pagination2', $searchPagination2);
					}
			}
		$this->assignRef('show_the_searchfield', $fields[0]->show_the_searchfield);
		if ($fields[0]->search_by_fields_or_cblists==0) /* the search is done by the CB fields */
			{
		$list_hidden = JRequest::getString("list-hidden", null, 'post');
		$list_hidden = empty($list_hidden) ? "yes" : $list_hidden;
		$this->assignRef('list_hidden', $list_hidden);
		
		$order_field = JRequest::getString("order_field", null, 'post');
		$order_asc = JRequest::getString("order_asc", null, 'post');
		if (empty($order_field) && empty($order_asc) && !empty($fields[0]->order_by))
			{
				$order_by = explode(" ", $fields[0]->order_by);	$order_field = $order_by[0];	$order_asc = $order_by[1];
			}
		$order_asc = empty($order_asc) ? "asc" : $order_asc;
		$order_field = $order_field=="rand()" ? $order_field : $order_field." ".$order_asc;
		$order_by = empty($order_field) ? $fields[0]->order_by : $order_field;
		
		$empty_fields = JRequest::getString("empty_fields", null, 'post');
		$empty_fields = empty($empty_fields) ? $fields[0]->empty_fields : $empty_fields;
		
		$this->assignRef('order_by', $order_by);
		$this->assignRef('empty_fields', $empty_fields);
		
		$default_form_values = $model->get_default_form_values($user->id);
		
		$fields = $model->getFields();
		$field_id = $arrField_name = $fieldLabel = $fieldLabelSearcable = $field_type = $fileDescription = $field_searchable = 
			$fill_in_text = $css_class = $appears_results = array();
		
		$n=count($fields);
		for ($i=0; $i < $n; $i++)
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

				$select = $field_type == 'multiselect' ? "<select multiple name='".$field_name."[]' />" : "<select name='".$field_name."' />";
				$select .= "<option value=''>".$configuration->select."</option>";

				$fieldValues = $model->getFieldValues($field_id);
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
				$fieldValues = $model->getFieldValues($field_id);
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
				$fieldValues = $model->getFieldValues($field_id);
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
				$checkbox = " ";	$count = 0;
				$fieldValues = $model->getFieldValues($field_id);
				if (!empty($_POST)) $field_name_post = JRequest::getVar($field_name, '', '', 'array');
					else $field_name_post = explode(",", $field_name_post);
				
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
		
		$this->assignRef('arrField_name', $arrField_name);
		$this->assignRef('appears_results', $appears_results);
		$this->assignRef('fieldLabels', $fieldLabel);
		$this->assignRef('field_searchable', $field_searchable);
		$this->assignRef('fieldLabelSearcable', $fieldLabelSearcable);
		$this->assignRef('searchFields', $searchFields);
		$this->assignRef('fileDescription', $fileDescription);
		$this->assignRef('fileDescriptionSearcable', $fileDescriptionSearcable);
		$this->assignRef('css_class', $css_class);

		if ($didSearch != "" && $search_type=="component")
		{
			$db =& JFactory::getDBO();		$db->setQuery("select * from #__comprofiler_fields");
			$result = $db->loadAssocList();
			$tables = array();
			foreach($result as $r)
				{
					if (!in_array($r['table'], $tables)) $tables[] = $r['table'];
				}
			if (!empty($user_groups))
				{
					$user_groups = explode(",", $user_groups);
					if (!in_array("#__users", $tables)) $tables[] = "#__users";
					if (!in_array("#__user_usergroup_map", $tables)) $tables[] = "#__user_usergroup_map";
				}
			$tables_size = count($tables);
			
			$conditions = "(";
			if ($searchword != "")
				{
					$fieldsx = $model->getInformationSchemaField();
					$strFields = "";
					$nx=count($fieldsx);
					for ($i=0; $i < $nx; $i++)
						{
							$strFields .= ', lower(a.`'.$fieldsx[$i]->Field.'`)';
						}

					$arrSearchWord = explode(" ", $searchword);
					$arrSearchWord2 = explode(" ", $searchword2);
					// list of exception words
					$arrExceptionWords = array('a','an','the','of','in','into','for');
			
					for($i=0; $i<count($arrSearchWord); $i++)
						if (!empty($arrSearchWord[$i]) && !in_array($arrSearchWord[$i], $arrExceptionWords))
						{
							if($conditions == "(")
								$conditions .= "concat_ws(' '$strFields) like '%".strtolower($arrSearchWord[$i])."%'";
							else
								$conditions .= " OR concat_ws(' '$strFields) like '%".strtolower($arrSearchWord[$i])."%'";
						}			
				}
			$conditions .= ")";
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
									if (!empty($fields[$i]->fill_in_text) && ($value==$fields[$i]->fill_in_text || @addslashes($value)==$fields[$i]->fill_in_text)) $continue_search = 0;
									break;
								}
							$comparison_sign = str_replace("&lt", "<", $comparison_sign);
							if ($continue_search==1)
							if ($key == "cb_sex")	$conditions .= " and ".$field." = '".$value."'";
								elseif (is_array($value))
									{
										$conditions .= " and (";	$vi = 0;
										foreach($value as $v) if (!empty($v))
											{
												$vi++;	$v = trim(strip_tags($v));
												if (strpos("\\", $v)>0) $v = @addslashes($v);
												$conditions .= $comparison_sign=="like" ? " and lower(".$field.") like '%".strtolower($v)."%'"
													: " and lower(".$field.") ".$comparison_sign." '".strtolower($v)."'";
											}
										if ($vi==0) $conditions .= "1=1";
										$conditions .= ") ";
									}
								elseif (strtolower($value)=="array")
									{
										$conditions .= " and (";	$vi = 0;
										foreach($value as $v) if (!empty($v))
											{
												$vi++;	$v = trim(strip_tags($v));
												if (strpos("\\", $v)>0) $v = @addslashes($v);
												$conditions .= $comparison_sign=="like" ? " and lower(".$field.") like '%".strtolower($v)."%'"
													: " and lower(".$field.") ".$comparison_sign." '".strtolower($v)."'";
											}
										if ($vi==0) $conditions .= "1=1";
										$conditions .= ") ";
									}	else	{
													$value = trim(strip_tags($value));
													if (strpos("\\", $value)>0) $value = @addslashes($value);
													$conditions .= $comparison_sign=="like" ? " and lower(".$field.") like '%".strtolower($value)."%'"
														: " and lower(".$field.") ".$comparison_sign." '".strtolower($value)."'";
												}
								}
							$conditions .= " ) ";
						}
				}
			
			if (!empty($user->id) && !empty($save_the_search) && !empty($fields_to_save))
				{
					$model->save_search_form($user->id, $name_of_the_search, $fields_to_save);
				}
			$conditions = str_replace("or ( )", "", str_replace("or ()", "", str_replace("and ()", "", str_replace("and ( )", "", 
				str_replace("() or", "", str_replace("() and", "", 
				str_replace("( and", "(", str_replace("( or", "(", $conditions))))))));
			if (!empty($ignored_users)) $conditions.= " and a.user_id not in (".$ignored_users.")";
			if ($conditions!="(1=1)")
				{
					$searchTotalResult = $model->getSearch($conditions, $tables, "", 0, 0, 1);
					$number_items2 = $number_items==-1 ? $searchTotalResult[0]->contor : $number_items;
					$searchResult = $model->getSearch($conditions, $tables, $order_by, ($current_page-1)*$number_items2, $number_items2, 0);
					$total = ceil($searchTotalResult[0]->contor/$number_items2);
					$searchPagination1 = $model->page_list($current_page, $total, $number_items, 1);
					$searchPagination2 = $model->page_list($current_page, $total, $number_items, 2);
				}
			$this->assignRef('searchResult',$searchResult);
			$this->assignRef('searchTotalResult',$searchTotalResult[0]->contor);
			$this->assignRef('pagination1', $searchPagination1);
			$this->assignRef('pagination2', $searchPagination2);
		}
		}
		//}	
		parent::display($tpl);
	}
}
?>
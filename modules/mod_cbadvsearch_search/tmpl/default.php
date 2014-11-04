<?php
/**
 * @version		$Id: default.php
 * @package		CB Advanched Search
 * @subpackage	mod_cbadvsearch
 * @copyright	Copyright (C) 2009 - 2011  All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
@error_reporting(0);
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.keepalive');

//	$description = & $fieldsconfig[0]->description;		$listing = & $fieldsconfig[0]->listing;
$searchword = $results[0]['searchword'];
$fieldsconfig = $results[1]['fieldsconfig'];
$description = $results[2]['description'];
$listing = $results[3]['listing'];
$arrField_name = $results[4]['arrField_name'];

$fieldLabels = $results[5]['fieldLabels'];
$fieldLabelSearcable = $results[6]['fieldLabelSearcable'];
$searchFields = $results[7]['searchFields'];
$fileDescription = $results[8]['fileDescription'];
$fileDescriptionSearcable = $results[9]['fileDescriptionSearcable'];

$searchResult = $results[10]['searchResult'];
$searchPagination1 = $results[11]['searchPagination1'];
$search_type = $results[12]['search_type'];
$list_hidden = $results[13]['list_hidden'];
$order_by = $results[14]['order_by'];

$empty_fields = $results[15]['empty_fields'];
$show_order_by = $results[16]['show_order_by'];
$show_avatar = $results[17]['show_avatar'];
$show_numbers = $results[18]['show_numbers'];
$limit = $results[19]['limit'];

$limit_start = $results[20]['limit_start'];
$total = $results[21]['total'];
$searchPagination2 = $results[22]['searchPagination2'];
$language_shortcode = $results[23]['language_shortcode'];
$configuration = $results[24]['configuration'];

$default_language = $results[25]['default_language'];
$show_the_searchfield = $results[26]['show_the_searchfield'];
$user_groups = $results[27]['user_groups'];
$css_class = $results[28]['css_class'];
$searchTotalResult = $results[29]['searchTotalResult'];

$search_by_fields_or_cblists = $results[30]['search_by_fields_or_cblists'];
$list_fields = $results[31]['list_fields'];
$CBuser = $results[32]['CBuser'];
$save_the_search = $results[33]['save_the_search'];
$name_of_the_search = $results[34]['name_of_the_search'];
		
$save_ignore_users_action_module = $results[35]['save_ignore_users_action_module'];
$save_ignore_users_values_module = $results[36]['save_ignore_users_values_module'];
$save_ignore_users_action_result = $results[37]['save_ignore_users_action_result'];
$appears_results = $results[38]['appears_results'];
$searchURL = $results[39]['searchURL'];

$uri = &JFactory::getURI();
?>

<style type="text/css">
.first-search {
	font-family: Tahoma, Georgia, "Times New Roman", Times, serif;
	font-size: 12px;	font-style: normal;	font-weight: normal;
	color: #000000;		background-color: #eeeeee;
}
#number
{
	margin: 5px; margin-left: 10px; margin-right: 10px; position: relative; float: left; font-size: bold; clear: left;
}
#field_name
{
	position: relative; float: left; padding: 4px 0px;
	font-size: 14px;	font-weight: bold; width: 150px; overflow: hidden;
}
#result
{
	position: relative; float: left; padding:4px 0px; width: 150px; overflow: hidden;
}
#view-details
{
	clear: both;	font-weight: bold; position: relative; float: left;	height: 25px;
}
#list-hidden
{
	width: 100px;
}
.cell
{
	width: 360px;	position: relative;	float: right;	padding-bottom: 5px;
}
.cell_image
{
	margin: 5px; width: 150px; height: 150px; overflow: hidden;
	position: relative;	float: right;
}
.cell_field
{
	width: 150px;	position: relative;	float: right;	padding-bottom: 5px;	clear: both;
}
.resultcell
{
	width: 330px;	height: 160px;	position: relative;	float: right;
	margin: 5px;	border: 1px solid #000000;	overflow: hidden;
}
#list_field_name, #cbuserlistaModule
{
	position: relative; float: left;
}
.field_label
{
}
.field_content
{
}
.field_description
{
}
</style>
	<table>
	<?php if (!empty($description)) { ?>
		<tr>
			<td nowrap="nowrap">
				<label>
					<?php echo JText::_( $configuration->description ).": ".$description; ?>
				</label>
			</td>
		</tr><?php } ?>
		<tr>
			<td nowrap="nowrap">
<form id="searchFormCBAdvSearchModule" name="searchFormCBAdvSearchModule" action="<?php echo !empty($searchURL) ? $searchURL : "";// echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post">
			<!-- the beginning of the search form -->
	<table>
		<?php if (empty($show_the_searchfield))	{  ?>
		<input type="hidden" name="searchword_mod" id="search_searchword" value="" />
		
	<?php }	else	{  ?>
		<tr><td>	<div nowrap="nowrap">	<label>
					<?php echo JText::_($configuration->search_keyword); ?>:
				</label>	</div>	<div nowrap="nowrap">
					<input type="text" name="searchword_mod" id="search_searchword" size="30" maxlength="20" value="<?php echo $searchword; ?>" class="inputbox" />
				</div>		<div nowrap="nowrap"></div>	</td></tr>
		<?php	}	for ($i=0, $n=count($searchFields); $i < $n; $i++)	{	?>
		
		<tr><td>
			<div nowrap="nowrap" valign="top">
				<label>
					<?php echo JText::_($fieldLabelSearcable[$i]); ?>:
				</label>
			</div>
			<div nowrap="nowrap">
				<?php echo $searchFields[$i]; ?>
			</div>
			<div nowrap="nowrap" valign="top">
				<label>
					<?php echo $fileDescriptionSearcable[$i]; ?>
				</label>
			</div>
		</td></tr>	
		<?php	}
			if ($listing==0 && $empty_fields==1 && empty($search_by_fields_or_cblists))
			{	/* vertical listing and if the select is allowed from the backend */	?>
		<tr><td>
			<div nowrap="nowrap">
				<label>
					<?php echo JText::_($configuration->list_the_empty_fields); ?>
				</label>
			</div>
			<div nowrap="nowrap">
				<select name="list-hidden" id="list-hidden">
					<option value='yes' <?php echo $list_hidden=="yes" ? "selected" : "" ?>><?php echo $configuration->yes; ?></option>
					<option value='no' <?php echo $list_hidden=="no" ? "selected" : "" ?>><?php echo $configuration->no; ?></option>
				</select>
			</div>
			<div nowrap="nowrap"></div>
		</td></tr>
		<?php	}
		$m=count($arrField_name);
		if ($show_order_by==0) {
			if (!empty($order_by))
				{
					$order_fields = explode(" ", $order_by);
					$order_field = $order_fields[0];
					$order_asc = strpos($order_by, "asc")>0 ? "asc" : "desc";
				}
			if (empty($order_field))
				{	$order_field = "rand()";	$order_asc = "";	}
		//	if (strpos(" ".$order_by, "rand()")>0) $order_field = "rand()";
			for ($j=0; $j < $m; $j++)
				{	$field = strtolower($arrField_name[$j]);
					if (strpos(" ".$order_by, $arrField_name[$j])>0) $order_field = $arrField_name[$j];	}	?>
<input type="hidden" name="order_field" id="order_field" value="<?php echo $order_field; ?>" />
<input type="hidden" name="order_asc" id="order_asc" value="<?php echo $order_asc; ?>" />
		<?php	} else	{	?>
		<tr><td>
			<div nowrap="nowrap">
				<label>
					<?php echo JText::_($configuration->order_by); ?>
				</label>
			</div>
			<div nowrap="nowrap">
				<select name="order_field" id="order_field">
					<option value='rand()' <?php echo strpos(" ".$order_by, "rand()")>0 ? "selected" : "" ?>><?php echo $configuration->random; ?></option>
				<?php 
					for ($j=0; $j < $m; $j++)
						{
							$field = strtolower($arrField_name[$j]);	?>
							<option value='<?php echo $arrField_name[$j]; ?>' <?php echo strpos(" ".$order_by, $arrField_name[$j])>0 ? "selected" : "" ?>><?php echo $fieldLabels[$j]; ?></option>
				<?php	}	?>
				</select>
			</div>
			<div nowrap="nowrap">
				<select name="order_asc" id="order_asc">
					<option value='asc' <?php echo strpos($order_by, "asc")>0 ? "selected" : "" ?>><?php echo $configuration->ascendent; ?></option>
					<option value='desc' <?php echo strpos($order_by, "desc")>0 ? "selected" : "" ?>><?php echo $configuration->descendent; ?></option>
				</select>
			</div>
		</td></tr><?php }	?>
	</table>
			<!-- the end of the search form -->
			</td>
		</tr>
		<tr>
			<td width="100%" nowrap="nowrap" colspan="2">
				<button name="Search" onclick="javascript: document.forms['searchFormModule'].submit();" class="button"><?php echo JText::_($configuration->search);?></button>
			</td>
		</tr>
		<?php	if (!empty($CBuser->id)) { ?>
		<tr>
			<td nowrap="nowrap">
			</td>
		</tr>
		<tr>
			<td nowrap="nowrap">
			</td>
		</tr><?php	if ($save_ignore_users_action_result>0)
			{	?>
		<tr>
			<td nowrap="nowrap">
				<label style="font-weight: bold;">
					<?php if ($save_ignore_users_action_result==1) echo JText::_($configuration->operation_not_successful);
						elseif ($save_ignore_users_action_result==2) echo JText::_($configuration->operation_successful);	?>
				</label>
			</td>
		</tr>
		<?php	}	} ?>
	</table>
<input type="hidden" name="task" value="search" />
<input type="hidden" name="number_items" id="number_items_module" value="<?php echo $number_items; ?>" />
<input type="hidden" name="current_page" id="current_page_module" value="<?php echo $current_page; ?>" />
<?php	$lang = JRequest::getString('lang', '', 'post');
		if (empty($lang)) $lang = JRequest::getString('lang', '', 'get');
		if (empty($lang)) $lang = "en-GB";	?>
<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
<input type="hidden" name="save_ignore_users_action_module" id="save_ignore_users_action_module" value="" />
<input type="hidden" name="save_ignore_users_values_module" id="save_ignore_users_values_module" value="" />
<div style="clear:both">&nbsp;</div>
<input type="hidden" name="search_type" value="module" />
</form>

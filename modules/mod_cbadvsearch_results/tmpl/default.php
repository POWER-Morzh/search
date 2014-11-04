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
</style>
<script type="text/javascript">
function setNumber_module(valoare)
	{
		if (valoare==0 || valoare.length==0) valoare = 25;
		document.getElementById('number_items_module2').value = valoare;
		document.forms['searchFormCBAdvSearchModule2'].submit();
	}

function setPage_module(valoare)
	{
		if (valoare==0 || valoare.length==0) valoare = 1;
		document.getElementById('current_page_module2').value = valoare;
		document.getElementById('number_items_module2').value = document.getElementById('limit1').value;
		document.forms['searchFormCBAdvSearchModule2'].submit();
	}
function save_selected_users_module()
	{
		if (document.getElementById('name_of_the_search2').value=='')
			{	alert('<?php echo JText::_($configuration->have_to_enter_the_name_of_the_search); ?>');	return;	}
		var lista = '', primul = 0;
		for (i=0; i<document.searchFormCBAdvSearchModule2.cbuserlistaModule.length; i++)
			if (document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].checked)
				{
					if (primul==0) primul = document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].value;
					lista += document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_($configuration->have_to_select_at_least_one_CB_user); ?>');	return;	}
		document.getElementById('save_ignore_users_action_module2').value = 'save';
		document.getElementById('save_ignore_users_values_module2').value = lista;
		
		document.forms['searchFormCBAdvSearchModule2'].submit();
	}
function ignore_selected_users_module()
	{
		var lista = '', primul = 0;
		for (i=0; i<document.searchFormCBAdvSearchModule2.cbuserlistaModule.length; i++)
			if (document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].checked)
				{
					if (primul==0) primul = document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].value;
					lista += document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_($configuration->have_to_select_at_least_one_CB_user); ?>');	return;	}
		document.getElementById('save_ignore_users_action_module2').value = 'ignore';
		document.getElementById('save_ignore_users_values_module2').value = lista;
		document.forms['searchFormCBAdvSearchModule2'].submit();
	}
</script>
<div style="clear:both">&nbsp;</div>
<form id="searchFormCBAdvSearchModule2" name="searchFormCBAdvSearchModule2" action="" method="post">
			<!-- the beginning of the search form -->
	<div style="display: none;">
		<?php if (empty($show_the_searchfield))	{  ?>
		<input type="hidden" name="searchword_mod" id="search_searchword" value="" />
		
	<?php }	else	{  ?>
	<input type="text" name="searchword_mod" id="search_searchword" size="30" maxlength="20" value="<?php echo $searchword; ?>" class="inputbox" />
	<?php	}	for ($i=0, $n=count($searchFields); $i < $n; $i++)
					echo $searchFields[$i];
			if ($listing==0 && $empty_fields==1 && empty($search_by_fields_or_cblists))
			{	/* vertical listing and if the select is allowed from the backend */	?>

				<select name="list-hidden" id="list-hidden">
					<option value='yes' <?php echo $list_hidden=="yes" ? "selected" : "" ?>><?php echo $configuration->yes; ?></option>
					<option value='no' <?php echo $list_hidden=="no" ? "selected" : "" ?>><?php echo $configuration->no; ?></option>
				</select>
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

			<select name="order_field" id="order_field">
					<option value='rand()' <?php echo strpos(" ".$order_by, "rand()")>0 ? "selected" : "" ?>><?php echo $configuration->random; ?></option>
				<?php 
					for ($j=0; $j < $m; $j++)
						{
							$field = strtolower($arrField_name[$j]);	?>
							<option value='<?php echo $arrField_name[$j]; ?>' <?php echo strpos(" ".$order_by, $arrField_name[$j])>0 ? "selected" : "" ?>><?php echo $fieldLabels[$j]; ?></option>
				<?php	}	?>
				</select>

				<select name="order_asc" id="order_asc">
					<option value='asc' <?php echo strpos($order_by, "asc")>0 ? "selected" : "" ?>><?php echo $configuration->ascendent; ?></option>
					<option value='desc' <?php echo strpos($order_by, "desc")>0 ? "selected" : "" ?>><?php echo $configuration->descendent; ?></option>
				</select>
		<?php }	?>
	</div>
<input type="hidden" name="task" value="search" />
<input type="hidden" name="number_items" id="number_items_module2" value="<?php echo $number_items; ?>" />
<input type="hidden" name="current_page" id="current_page_module2" value="<?php echo $current_page; ?>" />
<?php	$lang = JRequest::getString('lang', '', 'post');
		if (empty($lang)) $lang = JRequest::getString('lang', '', 'get');
		if (empty($lang)) $lang = "en-GB";	?>
<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
<input type="hidden" name="save_ignore_users_action_module" id="save_ignore_users_action_module2" value="<?php echo $save_ignore_users_action_module; ?>" />
<input type="hidden" name="save_ignore_users_values_module" id="save_ignore_users_values_module2" value="<?php echo $save_ignore_users_action_module; ?>" />
<div style="clear:both">&nbsp;</div>
<input type="hidden" name="search_type" value="module" />

<?php	if ($search_type=="module" && empty($search_by_fields_or_cblists))
		{
	if ($searchResult)
		{
			$n=count($searchResult);
			echo "<div>".$configuration->search_results.": <b>".$n."</b> / ".$searchTotalResult." ".$configuration->results_found."!</div><div><hr size='1' /></div>";
			echo $searchPagination1;	if ($n>0 && !empty($CBuser->id))	{	?>

		<?php	} ?>

<?php	$m=count($arrField_name);
		if ($listing==0)	{	/* vertical listing */
			for ($i=0; $i < $n; $i++)
				{
			//	$userName = $searchResult[$i]->username;	$firstName = $searchResult[$i]->firstname;	$lastName = $searchResult[$i]->lastname;
				$uId = $searchResult[$i]->user_id;
				$avatar = $searchResult[$i]->avatar;
			//	$address = $searchResult[$i]->address;	$city = $searchResult[$i]->city;	$state = $searchResult[$i]->state;	$country = $searchResult[$i]->country;
// 				echo '<INPUT TYPE="checkbox" NAME="cbuserlistaModule" id="cbuserlistaModule" value="'.$uId.'" onClick="">&nbsp;&nbsp;';
			if ($avatar != "" && $show_avatar==1)	{	?>
				<div style="margin:10px 0px; clear: left;"><a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $uId; ?>'><img src="<?php echo JURI::root().'images/comprofiler/'.$avatar; ?>" width="100px;"/></a></div>
				<?php	}
				if ($show_numbers==1) { ?>	<div class="<?php if ($i%2==1) echo "first-search"; ?>" id="number" style=""><?php echo ($i+1); ?></div><?php }
					for ($j=0; $j < $m; $j++)
						if ($appears_results[$j]==1)
						{
							$field = strtolower($arrField_name[$j]);	$virgula = strpos($field, ",");
							if ($virgula>0) $field = substr($field, 0, $virgula);
							$contentx = str_replace("|*|",", ",substr($searchResult[$i]->$field, 0, 100));
							if (($list_hidden=="no" && !empty($contentx)) || $list_hidden=="yes") {	?>
							<div class="<?php echo $css_class[$j]; ?>" style="padding:4px 0px; clear: left; width: 100%; clear: both;"><span style="font-weight:bold;"><?php echo $fieldLabels[$j]; ?> : </span>
							<?php echo (strpos($contentx, "@")>0 && strpos($contentx, ".")>0) ? "<a href='mailto: ".$contentx."'>".$contentx."</a>" : JText::_($contentx); ?></div>
				<?php 	}	}	?>
							<div class="view-details" style="width: 100%; clear: both;"><a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $uId.'&Itemid='.$Itemid; ?>'><?php echo $configuration->view_details; ?></a></div>
					<?php	}
				}
			
			if ($listing==1)	{	/* horizontal listing */	?>
	
	<div style="margin: 10px; position: relative; float: left; clear: both; width: <?php echo $m*175; ?>px; border-bottom: 1px solid #000;">
	<?php	for ($j=0; $j < $m; $j++)
		if ($appears_results[$j]==1) {	$field = strtolower($arrField_name[$j]);		?>
 		<div id="field_name" class="" style=""><span style=""><?php echo $fieldLabels[$j]; ?></span></div>
		<?php 	}	else echo '<div id="field_name" class="" style="">&nbsp;</span></div>';	?>
	</div>	
	<?php	for ($i=0; $i < $n; $i++)
				{
			//	$userName = $searchResult[$i]->username;	$firstName = $searchResult[$i]->firstname;	$lastName = $searchResult[$i]->lastname;
				$uId = $searchResult[$i]->user_id;
				$avatar = $searchResult[$i]->avatar;
			//	$address = $searchResult[$i]->address;	$city = $searchResult[$i]->city;	$state = $searchResult[$i]->state;	$country = $searchResult[$i]->country;	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: <?php echo $m*175; ?>px; border-bottom: 1px solid #000;">
	<?php	echo '<INPUT TYPE="checkbox" NAME="cbuserlistaModule" id="cbuserlistaModule" value="'.$uId.'" onClick="">&nbsp;&nbsp;';
	if ($show_numbers==1) { ?>	<div class="<?php if ($i%2==1) echo "first-search"; ?>" id="number" style=""><?php echo ($i+1); ?></div><?php } ?>
<?php	if($avatar != "" && $show_avatar==1)	{	?>
	<div class="class_avatar"><a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $uId; ?>&lang=en'><img src="<?php echo JURI::root().'images/comprofiler/'.$avatar; ?>" width="100px;"/></a></div>
	<?php	}
		for ($j=0; $j < $m; $j++) if ($appears_results[$j]==1)
		{
			$field = strtolower($arrField_name[$j]);	$virgula = strpos($field, ",");
			if ($virgula>0) $field = substr($field, 0, $virgula);
			$contentx = str_replace("|*|",", ",substr($searchResult[$i]->$field, 0, 100));	?>
 		<div id="result" class="<?php if (!empty($css_class[$j])) echo $css_class[$j]; elseif ($i%2==1) echo "first-search"; ?>">
			<?php echo (strpos($contentx, "@")>0 && strpos($contentx, ".")>0) ? "<a href='mailto: ".$contentx."'>".$contentx."</a>" : $contentx; ?></div>
	<?php	}	else echo '<div id="field_name" class="" style="">&nbsp;</div>';	?>
	<div class="view-details" style="width: 100%;"><a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $uId.'&Itemid='.$Itemid; ?>&lang=en'><?php echo $configuration->view_details; ?></a></div>
</div>
<!--</div>-->
<?php		}	}
		echo $searchPagination2;
}
else
{
	echo "<div>".$configuration->search_results.": <b>".$configuration->no_results_found."!</b></div>";
	echo "<div><hr size='1' /></div>";
}
	}
if ($search_type=="module" && !empty($search_by_fields_or_cblists))
{
	if ($searchResult)
		{
			$n = count($searchResult);
			echo "<div>".$configuration->search_results.": <b>".$n."</b> / ".$searchTotalResult." ".$configuration->results_found."!</div><div><hr size='1' /></div>";
			echo $searchPagination1;	if ($n>0 && !empty($CBuser->id))	{	?>
	<table>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: save_selected_users_module();" class="button"><?php echo JText::_($configuration->save_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: ignore_selected_users_module();" class="button"><?php echo JText::_($configuration->ignore_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.searchFormCBAdvSearchModule2.checkentirelist.checked==false)
							{	//	document.searchFormCBAdvSearchModule2.checkentirelist.checked = true;
						for (i=0; i<document.searchFormCBAdvSearchModule2.cbuserlistaModule.length; i++) document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].checked = false;	}
							else	{
					//	document.searchFormCBAdvSearchModule2.checkentirelist.checked = false;
						for (i=0; i<document.searchFormCBAdvSearchModule2.cbuserlistaModule.length; i++) document.searchFormCBAdvSearchModule2.cbuserlistaModule[i].checked = true;	}">
					<b><?php echo JText::_($configuration->check_all);?></b>
			</td>
		</tr>
	</table><input type="checkbox" name="cbuserlistaModule" id="cbuserlistaModule" value="0" style="display: none;">
			
		<?php	}	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: 100%; border-bottom: 1px solid #000;">
	<?php	
	
		if ($list_fields[0]->col1enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $list_fields[0]->col1title; ?></span></div>
		<?php 	}
		if ($list_fields[0]->col2enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $list_fields[0]->col2title; ?></span></div>
		<?php 	}
		if ($list_fields[0]->col3enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $list_fields[0]->col3title; ?></span></div>
		<?php 	}
		if ($list_fields[0]->col4enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $list_fields[0]->col4title; ?></span></div>
		<?php 	}	?>
	</div>	
	<?php	$name1 = $list_fields[0]->name1;	$name2 = $list_fields[0]->name2;
		$name3 = $list_fields[0]->name3;	$name4 = $list_fields[0]->name4;
		for ($i=0; $i < $n; $i++)	{	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: 100%; border-bottom: 1px solid #000;">
	<?php	echo '<INPUT TYPE="checkbox" NAME="cbuserlistaModule" id="cbuserlistaModule" value="'.$searchResult[$i]->id.'" onClick="">&nbsp;&nbsp;';
	
		if ($list_fields[0]->col1enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $searchResult[0]->id; ?>&lang=en'><?php echo $searchResult[$i]->$name1; ?></a>
		</div>
		<?php 	}
		if ($list_fields[0]->col2enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $searchResult[0]->id; ?>&lang=en'><?php echo $searchResult[$i]->$name2; ?></a>
		</div>
		<?php 	}
		if ($list_fields[0]->col3enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $searchResult[0]->id; ?>&lang=en'><?php echo $searchResult[$i]->$name3; ?></a>
		</div>
		<?php 	}
		if ($list_fields[0]->col4enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $searchResult[0]->id; ?>&lang=en'><?php echo $searchResult[$i]->$name4; ?></a>
		</div><?php }	?>
	</div>
<?php	}
	echo $searchPagination2;
	}
	else	{
		echo "<div>".$configuration->search_results.": <b>".$configuration->no_results_found."!</b></div>";
		echo "<div><hr size='1' /></div>";
			}
}
?>
</form>

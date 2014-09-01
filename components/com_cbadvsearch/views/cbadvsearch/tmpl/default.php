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
.class_avatar
{
	margin: 10px 0px; position: relative; float: left;
}
#relative_left
{
	position: relative; float: left;
}
#relative_left_padding5
{
	position: relative;	float: left;	padding: 5px;
}
#relative_right
{
	position: relative; float: right;
}
#relative_right_padding5
{
	position: relative; float: right;	padding: 5px;
}
#list_field_name, #cbuserlista
{
	position: relative; float: left;
}
</style>
<script type="text/javascript">
function setNumber(valoare)
	{
		if (valoare==0 || valoare.length==0) valoare = 25;
		document.getElementById('number_items').value = valoare;
		document.forms['searchForm'].submit();
	}

function setPage(valoare)
	{
		if (valoare==0 || valoare.length==0) valoare = 1;
		document.getElementById('current_page').value = valoare;
		document.getElementById('number_items').value = document.getElementById('limit1').value;
		document.forms['searchForm'].submit();
	}
function save_selected_users()
	{
		if (document.getElementById('name_of_the_search').value=='')
			{	alert('<?php echo JText::_($this->configuration->have_to_enter_the_name_of_the_search); ?>');	return;	}
		var lista = '', primul = 0;
		for (i=0; i<document.searchForm.cbuserlista.length; i++)
			if (document.searchForm.cbuserlista[i].checked)
				{
					if (primul==0) primul = document.searchForm.cbuserlista[i].value;
					lista += document.searchForm.cbuserlista[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_($this->configuration->have_to_select_at_least_one_CB_user); ?>');	return;	}
		document.getElementById('save_ignore_users_action').value = 'save';
		document.getElementById('save_ignore_users_values').value = lista;
		document.forms['searchForm'].submit();
	}
function ignore_selected_users()
	{
		var lista = '', primul = 0;
		for (i=0; i<document.searchForm.cbuserlista.length; i++)
			if (document.searchForm.cbuserlista[i].checked)
				{
					if (primul==0) primul = document.searchForm.cbuserlista[i].value;
					lista += document.searchForm.cbuserlista[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_($this->configuration->have_to_select_at_least_one_CB_user); ?>');	return;	}
		document.getElementById('save_ignore_users_action').value = 'ignore';
		document.getElementById('save_ignore_users_values').value = lista;
		document.forms['searchForm'].submit();
	}
</script>

<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$Itemid = JRequest::getString('Itemid', null, 'get');
$Itemid = empty($Itemid) || !is_numeric($Itemid) ? 166 : $Itemid;
if ($Itemid!=166) $Itemid = 166;
$uri = &JFactory::getURI();	?>
	<table>
	<?php if (!empty($this->description)) { ?>
		<tr>
			<td nowrap="nowrap">
				<label>
					<?php echo $this->description; ?>
				</label>
			</td>
		</tr>
	<?php } ?>
		<tr>
			<td nowrap="nowrap">
<form name="searchForm" id="searchForm" action="<?php if (strpos($uri->toString(), "?option=com_cbadvsearch")>0) echo "index.php?option=com_cbadvsearch&Itemid=".$Itemid;?>" method="post">
			<!-- the beginning of the search form -->
	<table>
	<?php if (empty($this->show_the_searchfield))	{  ?>
		<input type="hidden" name="searchword" id="search_searchword" value="" />
		
	<?php }	else	{  ?>
		<tr>	<td nowrap="nowrap">	<label>
					<?php echo JText::_($this->configuration->search_keyword); ?>:
				</label>	</td>	<td nowrap="nowrap">
					<input type="text" name="searchword" id="search_searchword" size="30" maxlength="20" value="<?php echo $this->escape($this->searchword); ?>" class="inputbox" />
				</td>		<td nowrap="nowrap"></td>	</tr>
		<?php	}	for ($i=0, $n=count($this->searchFields); $i < $n; $i++)	{	?>
		<tr>
			<td nowrap="nowrap" valign="top">
				<label>
					<?php echo $this->fieldLabelSearcable[$i]; ?>:
				</label>
			</td>
			<td nowrap="nowrap">
				<?php echo $this->searchFields[$i]; ?>
			</td>
			<td nowrap="nowrap" valign="top">
				<label>
					<?php echo $this->fileDescriptionSearcable[$i]; ?>
				</label>
			</td>
		</tr>	
		<?php	}
			if ($this->listing==0 && $this->empty_fields==1 && empty($this->search_by_fields_or_cblists))
				{	/* vertical listing and if the select is allowed from the backend */	?>
		<tr>
			<td nowrap="nowrap">
				<label>
					<?php echo JText::_($this->configuration->list_the_empty_fields); ?>
				</label>
			</td>
			<td nowrap="nowrap">
				<select name="list-hidden" id="list-hidden">
					<option value='yes' <?php echo $this->list_hidden=="yes" ? "selected" : "" ?>><?php echo $this->configuration->yes; ?></option>
					<option value='no' <?php echo $this->list_hidden=="no" ? "selected" : "" ?>><?php echo $this->configuration->no; ?></option>
				</select>
			</td>
			<td nowrap="nowrap"></td>
		</tr>
		<?php	}
		$m=count($this->arrField_name);
		if ($this->show_order_by==0) {
			$order_field = "rand()";
			if (!empty($this->order_by))
				{
					$order_fields = explode(" ", $this->order_by);
					$order_field = $order_fields[0];
				}
		//	if (strpos(" ".$this->order_by, "rand()")>0) $order_field = "rand()";
			for ($j=0; $j < $m; $j++)
				{	$field = strtolower($this->arrField_name[$j]);
					if (strpos(" ".$this->order_by, $this->arrField_name[$j])>0) $order_field = $this->arrField_name[$j];	}	?>
<input type="hidden" name="order_field" id="order_field" value="<?php echo $order_field; ?>" />
<input type="hidden" name="order_asc" id="order_asc" value="<?php echo $order_asc = strpos($this->order_by, "asc")>0 ? "asc" : "desc"; ?>" />
		<?php	} else	{	?>
		<tr>
			<td nowrap="nowrap">
				<label>
					<?php echo JText::_($this->configuration->order_by); ?>
				</label>
			</td>
			<td nowrap="nowrap">
				<select name="order_field" id="order_field">
					<option value='rand()' <?php echo strpos(" ".$this->order_by, "rand()")>0 ? "selected" : "" ?>><?php echo $this->configuration->random; ?></option>
				<?php 
					for ($j=0; $j < $m; $j++)
						{
							$field = strtolower($this->arrField_name[$j]);	?>
							<option value='<?php echo $this->arrField_name[$j]; ?>' <?php echo strpos(" ".$this->order_by, $this->arrField_name[$j])>0 ? "selected" : "" ?>><?php echo $this->fieldLabels[$j]; ?></option>
				<?php	}	?>
				</select>
			</td>
			<td nowrap="nowrap">
				<select name="order_asc" id="order_asc">
					<option value='asc' <?php echo strpos($this->order_by, "asc")>0 ? "selected" : "" ?>><?php echo $this->configuration->ascendent; ?></option>
					<option value='desc' <?php echo strpos($this->order_by, "desc")>0 ? "selected" : "" ?>><?php echo $this->configuration->descendent; ?></option>
				</select>
			</td>
		</tr><?php }	?>
	</table>
			<!-- the end of the search form -->
			</td>
		</tr>
		<tr>
			<td width="100%" nowrap="nowrap" colspan="2">
				<button name="Search" onclick="javascript: document.forms['searchForm'].submit();" class="button"><?php echo JText::_($this->configuration->search);?></button>
			</td>
		</tr>
		<?php if (!empty($this->CBuser->id)) {
			 if (empty($this->search_by_fields_or_cblists)) { ?>
		<tr style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
			<td nowrap="nowrap">
				<INPUT TYPE="CHECKBOX" NAME="save_the_search" id="save_the_search" onClick="" value="1" <?php echo empty($this->save_the_search) ? "" : "checked"; ?>>
				&nbsp;&nbsp;<label>
					<?php echo JText::_($this->configuration->save_the_search_form); ?>
				</label>
			</td>
		</tr><?php }	?>
		<tr>
			<td nowrap="nowrap">
				<label>
					<?php echo JText::_($this->configuration->enter_the_name_of_the_search); ?>: 
				</label>
			</td>
		</tr>
		<tr>
			<td nowrap="nowrap">
				<input type="text" name="name_of_the_search" id="name_of_the_search" value="<?php echo $this->name_of_the_search; ?>" />
			</td>
		</tr><?php	if ($save_ignore_users_action_result>0)
			{	?>
		<tr>
			<td nowrap="nowrap">
				<label style="font-weight: bold;">
					<?php if ($this->save_ignore_users_action_result==1) echo JText::_($configuration->operation_not_successful);
						elseif ($this->save_ignore_users_action_result==2) echo JText::_($configuration->operation_successful);	?>
				</label>
			</td>
		</tr>
		<?php	}	} ?>
	</table>
<input type="hidden" name="task"  value="search" />
<input type="hidden" name="number_items" id="number_items" value="<?php echo $this->number_items; ?>" />
<input type="hidden" name="current_page" id="current_page" value="<?php echo $this->current_page; ?>" />
<input type="hidden" name="save_ignore_users_action" id="save_ignore_users_action" value="" />
<input type="hidden" name="save_ignore_users_values" id="save_ignore_users_values" value="" />
<?php	$lang = JRequest::getString('lang', '', 'post');
		if (empty($lang)) $lang = JRequest::getString('lang', '', 'get');
		if (empty($lang)) $lang = "en-GB";	?>
<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
<div style="clear:both">&nbsp;</div>

<?php	
if ($this->task && $this->search_type=="component" && empty($this->search_by_fields_or_cblists))
{
//	if (getenv('REMOTE_ADDR')=="89.120.215.183") var_dump($this->searchResult);
	if ($this->searchResult)
		{
			$n=count($this->searchResult);
			echo "<div>".$this->configuration->search_results.": <b>".$n."</b> / ".$this->searchTotalResult." ".$this->configuration->results_found."!</div><div><hr size='1' /></div>";
			echo $this->pagination1;	if ($n>0 && !empty($this->CBuser->id))	{	?>
	<table>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: save_selected_users();" class="button"><?php echo JText::_($this->configuration->save_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: ignore_selected_users();" class="button"><?php echo JText::_($this->configuration->ignore_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.searchForm.checkentirelist.checked==false)
							{		document.searchForm.checkentirelist.checked = true;
						for (i=0; i<document.searchForm.cbuserlista.length; i++) document.searchForm.cbuserlista[i].checked = false;	}
							else	{
						document.searchForm.checkentirelist.checked = false;
						for (i=0; i<document.searchForm.cbuserlista.length; i++) document.searchForm.cbuserlista[i].checked = true;	}">
					<b><?php echo JText::_($this->configuration->check_all);?></b>
			</td>
		</tr>

			</table><input type="checkbox" name="cbuserlista" id="cbuserlista" value="0" style="display: none;">
			
		<?	}	if ($this->listing==0)	{	/* vertical listing */
			for ($i=0; $i < $n; $i++)
				{
			//	$userName = $this->searchResult[$i]->username;	$firstName = $this->searchResult[$i]->firstname;	$lastName = $this->searchResult[$i]->lastname;
				$uId = $this->searchResult[$i]->user_id;
				$avatar = $this->searchResult[$i]->avatar;
			//	$address = $this->searchResult[$i]->address;	$city = $this->searchResult[$i]->city;	$state = $this->searchResult[$i]->state;	$country = $this->searchResult[$i]->country;
			echo '<INPUT TYPE="checkbox" NAME="cbuserlista" id="cbuserlista" value="'.$uId.'" onClick="">&nbsp;&nbsp;';
			if ($avatar != "" && $this->show_avatar==1)	{	?>
				<div style="margin:10px 0px; clear: left;"><a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $uId; ?>'><img src="<?php echo JURI::root().'images/comprofiler/'.$avatar; ?>" width="100px;"/></a></div>
				<?php	}
				if ($this->show_numbers==1) { ?>	<div class="<?php if ($i%2==1) echo "first-search"; ?>" id="number" style=""><?php echo ($i+1); ?></div><?php }
					for ($j=0; $j < $m; $j++)
						if ($this->appears_results[$j]==1)
						{
							$field = strtolower($this->arrField_name[$j]);	$virgula = strpos($field, ",");
							if ($virgula>0) $field = substr($field, 0, $virgula);
							$contentx = str_replace("|*|",", ",substr($this->searchResult[$i]->$field, 0, 100));
							if (($this->list_hidden=="no" && !empty($contentx)) || $this->list_hidden=="yes")	{	?>
							<div class="<?php echo $this->css_class[$j]; ?>" style="padding:4px 0px; clear: left; width: 100%; clear: both;"><span style="font-weight:bold;"><?php echo $this->fieldLabels[$j]; ?> : </span>
							<?php echo (strpos($contentx, "@")>0 && strpos($contentx, ".")>0) ? "<a href='mailto: ".$contentx."'>".$contentx."</a>" : $contentx; ?></div>
				<?php 	}	}	?>
							<div class="view-details" style="width: 100%; clear: both;"><a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $uId.'&Itemid='.$Itemid; ?>'><?php echo $this->configuration->view_details; ?></a></div>
					<?php	}
				}
			
			if ($this->listing==1)	{	/* horizontal listing */	?>
	
	<div style="margin: 10px; position: relative; float: left; clear: both; width: <?php echo $m*175; ?>px; border-bottom: 1px solid #000;">
	<?php	for ($j=0; $j < $m; $j++)
		if ($this->appears_results[$j]==1) {	$field = strtolower($this->arrField_name[$j]);		?>
 		<div id="field_name" class="" style=""><span style=""><?php echo $this->fieldLabels[$j]; ?></span></div>
		<?php 	}	else echo '<div id="field_name" class="" style="">&nbsp;</span></div>';	?>
	</div>	
	<?php	for ($i=0; $i < $n; $i++)
				{
			//	$userName = $this->searchResult[$i]->username;	$firstName = $this->searchResult[$i]->firstname;	$lastName = $this->searchResult[$i]->lastname;
				$uId = $this->searchResult[$i]->user_id;
				$avatar = $this->searchResult[$i]->avatar;
			//	$address = $this->searchResult[$i]->address;	$city = $this->searchResult[$i]->city;	$state = $this->searchResult[$i]->state;	$country = $this->searchResult[$i]->country;	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: <?php echo $m*175; ?>px; border-bottom: 1px solid #000;">
	<?php	echo '<INPUT TYPE="checkbox" NAME="cbuserlista" id="cbuserlista" value="'.$uId.'" onClick="">&nbsp;&nbsp;';
	if ($this->show_numbers==1) { ?>	<div class="<?php if ($i%2==1) echo "first-search"; ?>" id="number" style=""><?php echo ($i+1); ?></div><?php } ?>
<?php	if($avatar != "" && $this->show_avatar==1)	{	?>
	<div class="class_avatar"><a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $uId; ?>&lang=en'><img src="<?php echo JURI::root().'images/comprofiler/'.$avatar; ?>" width="100px;"/></a></div>
	<?php	}
		for ($j=0; $j < $m; $j++) if ($this->appears_results[$j]==1)
		{
			$field = strtolower($this->arrField_name[$j]);	$virgula = strpos($field, ",");
			if ($virgula>0) $field = substr($field, 0, $virgula);
			$contentx = str_replace("|*|",", ",substr($this->searchResult[$i]->$field, 0, 100));	?>
 		<div id="result" class="<?php if (!empty($this->css_class[$j])) echo $this->css_class[$j]; elseif ($i%2==1) echo "first-search"; ?>">
			<?php echo (strpos($contentx, "@")>0 && strpos($contentx, ".")>0) ? "<a href='mailto: ".$contentx."'>".$contentx."</a>" : $contentx; ?></div>
	<?php	}	else echo '<div id="field_name" class="" style="">&nbsp;</div>';	?>
	<div class="view-details" style="width: 100%;"><a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $uId.'&Itemid='.$Itemid; ?>&lang=en'><?php echo $this->configuration->view_details; ?></a></div>
</div>
<!--</div>-->

<?php		}	}
	echo $this->pagination2;
	}
	else	{
		echo "<div>".$this->configuration->search_results.": <b>".$this->configuration->no_results_found."!</b></div>";
		echo "<div><hr size='1' /></div>";
			}
}

if ($this->task && $this->search_type=="component" && !empty($this->search_by_fields_or_cblists))
{
	if ($this->searchResult)
		{
			$n = count($this->searchResult);
			echo "<div>".$this->configuration->search_results.": <b>".$n."</b> / ".$this->searchTotalResult." ".$this->configuration->results_found."!</div><div><hr size='1' /></div>";
			echo $this->pagination1;	if ($n>0 && !empty($this->CBuser->id))	{	?>
	<table>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: save_selected_users();" class="button"><?php echo JText::_($this->configuration->save_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<button name="Search" onclick="javascript: ignore_selected_users();" class="button"><?php echo JText::_($this->configuration->ignore_the_selected_results);?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.searchForm.checkentirelist.checked==false)
							{		document.searchForm.checkentirelist.checked = true;
						for (i=0; i<document.searchForm.cbuserlista.length; i++) document.searchForm.cbuserlista[i].checked = false;	}
							else	{
						document.searchForm.checkentirelist.checked = false;
						for (i=0; i<document.searchForm.cbuserlista.length; i++) document.searchForm.cbuserlista[i].checked = true;	}">
					<b><?php echo JText::_($this->configuration->check_all);?></b>
			</td>
		</tr>
	</table><input type="checkbox" name="cbuserlista" id="cbuserlista" value="0" style="display: none;">
			
		<?	}	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: 100%; border-bottom: 1px solid #000;">
	<?php	
	
		if ($this->list_fields[0]->col1enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $this->list_fields[0]->col1title; ?></span></div>
		<?php 	}
		if ($this->list_fields[0]->col2enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $this->list_fields[0]->col2title; ?></span></div>
		<?php 	}
		if ($this->list_fields[0]->col3enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $this->list_fields[0]->col3title; ?></span></div>
		<?php 	}
		if ($this->list_fields[0]->col4enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%"><span style=""><?php echo $this->list_fields[0]->col4title; ?></span></div>
		<?php 	}	?>
	</div>	
	<?php	$name1 = $this->list_fields[0]->name1;	$name2 = $this->list_fields[0]->name2;
		$name3 = $this->list_fields[0]->name3;	$name4 = $this->list_fields[0]->name4;
		for ($i=0; $i < $n; $i++)	{	?>
	<div style="margin: 10px; position: relative; float: left; clear: both; width: 100%; border-bottom: 1px solid #000;">
	<?php	echo '<INPUT TYPE="checkbox" NAME="cbuserlista" id="cbuserlista" value="'.$this->searchResult[$i]->id.'" onClick="">&nbsp;&nbsp;';
	
		if ($this->list_fields[0]->col1enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $this->searchResult[0]->id; ?>&lang=en'><?php echo $this->searchResult[$i]->$name1; ?></a>
		</div>
		<?php 	}
		if ($this->list_fields[0]->col2enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $this->searchResult[0]->id; ?>&lang=en'><?php echo $this->searchResult[$i]->$name2; ?></a>
		</div>
		<?php 	}
		if ($this->list_fields[0]->col3enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $this->searchResult[0]->id; ?>&lang=en'><?php echo $this->searchResult[$i]->$name3; ?></a>
		</div>
		<?php 	}
		if ($this->list_fields[0]->col4enabled==1)	{	?>
 		<div id="list_field_name" class="" style="width: 25%">
			<a href='index.php?option=com_comprofiler&task=userprofile&user=<?php echo $this->searchResult[0]->id; ?>&lang=en'><?php echo $this->searchResult[$i]->$name4; ?></a>
		</div><?php }	?>
	</div>
<?php	}
	echo $this->pagination2;
	}
	else	{
		echo "<div>".$this->configuration->search_results.": <b>".$this->configuration->no_results_found."!</b></div>";
		echo "<div><hr size='1' /></div>";
			}
}
?>
<input type="hidden" name="search_type" value="component" />
</form>

<?php defined('_JEXEC') or die('Restricted access');
	$searches = $this->description[0]->searches;
	$id = $this->description[0]->id;	?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( $this->configuration->save_the_configuration ); ?></legend>
		<table class="admintable">
		<tr>
			<td colspan="2" align="center">	<hr style="width: 80%;" />	</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_number_of_searches ); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="searches" id="searches" size="32" maxlength="250" value="<?php echo $searches; ?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">	<hr style="width: 80%;" />	</td>
		</tr>
		<?php	if (empty($searches)) {	?>
			<input type="hidden" name="description0" id="description0" value="No description" />
			<input type="hidden" name="listing0" id="listing0" value="0" />
		<?php }	
		for($i=0; $i<$searches; $i++)
			{
				$description = $this->description[$i]->description;			$listing = $this->description[$i]->listing;
				$empty_fields = $this->description[$i]->empty_fields;		$order_by = $this->description[$i]->order_by;
				$avatar = $this->description[$i]->show_avatar;				$numbers = $this->description[$i]->show_numbers;
				$show_order_by = $this->description[$i]->show_order_by;		$user_groups = explode(",", $this->description[$i]->user_groups);
				$show_the_searchfield = $this->description[$i]->show_the_searchfield;
				$search_fields_cblists = $this->description[$i]->search_by_fields_or_cblists;
				$cblist_id = $this->description[$i]->cblist_id;	?>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_description_of_the_search.' #'.($i+1) ); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="description<?php echo $i; ?>" id="description<?php echo $i; ?>" size="32" maxlength="250" value="<?php echo $description; ?>" />
			</td>
			
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->allow_the_users_to_select_the_listing_of_empty_fields ); ?>:
				</label>
			</td>
			<td>
				<select name="empty_fields<?php echo $i; ?>" id="empty_fields<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="1"<?php if ($empty_fields==0) echo " selected"; ?>><?php echo $this->configuration->no; ?></option>
					<option value="2"<?php if ($empty_fields==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
			
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_listing_of_the_results ); ?>:
				</label>
			</td>
			<td>
				<select name="listing<?php echo $i; ?>" id="listing<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($listing==0) echo " selected"; ?>><?php echo $this->configuration->vertical; ?></option>
					<option value="1"<?php if ($listing==1) echo " selected"; ?>><?php echo $this->configuration->horizontal; ?></option>
				</select>
			</td>
			
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_searches_will_be_ordered_by ); ?>:
				</label>
			</td>
			<td>
				<select name="order_by<?php echo $i; ?>" id="order_by<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="rand()"<?php if ($order_by=="rand()") echo " selected"; ?>><?php echo $this->configuration->random_order; ?></option>
		<?php	for ($j=0, $n=count( $this->fields ); $j < $n; $j++)	{
					$field_name = $this->fields[$j]->name;
					if ($order_by == $field_name." asc")
							echo "<option value='".$field_name." asc' selected>".$field_name." asc</option>";
						else
							echo "<option value='".$field_name." asc'>".$field_name." asc</option>";
					if ($order_by == $field_name." desc")
							echo "<option value='".$field_name." desc' selected>".$field_name." desc</option>";
						else
							echo "<option value='".$field_name." desc'>".$field_name." desc</option>";
					}	?>
			
					<option value="1"<?php if ($order_by==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->show_the_avatar_in_the_results_list ); ?>:
				</label>
			</td>
			<td>
				<select name="avatar<?php echo $i; ?>" id="avatar<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($avatar==0) echo " selected"; ?>><?php echo $this->configuration->no; ?></option>
					<option value="1"<?php if ($avatar==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
			
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->show_the_numbers_in_the_results_list ); ?>:
				</label>
			</td>
			<td>
				<select name="numbers<?php echo $i; ?>" id="numbers<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($numbers==0) echo " selected"; ?>><?php echo $this->configuration->no; ?></option>
					<option value="1"<?php if ($numbers==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->show_the_order_by_criteria_in_the_frontend ); ?>:
				</label>
			</td>
			<td>
				<select name="show_order_by<?php echo $i; ?>" id="show_order_by<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($show_order_by==0) echo " selected"; ?>><?php echo $this->configuration->no; ?></option>
					<option value="1"<?php if ($show_order_by==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
			
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->show_the_searchfield ); ?>:
				</label>
			</td>
			<td>
				<select name="show_the_searchfield<?php echo $i; ?>" id="show_the_searchfield<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($show_the_searchfield==0) echo " selected"; ?>><?php echo $this->configuration->no; ?></option>
					<option value="1"<?php if ($show_the_searchfield==1) echo " selected"; ?>><?php echo $this->configuration->yes; ?></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->select_the_user_groups_you_want_to_search_in); ?>:
				</label>
			</td>
			<td>
				<select name="usergroups<?php echo $i; ?>[]" id="usergroups<?php echo $i; ?>" multiple="multiple" style="width: 250px; height: 150px; line-height: 25px; clear: both;">
					<option value=""<?php if (in_array("", $user_groups)) echo " selected"; ?>><?php echo JText::_( $this->configuration->no_user_group); ?></option>
				<?php foreach($this->usergroups as $group) {
					$selected = false;	if (in_array($group->id, $user_groups)) $selected = true;	?>
					<option value="<?php echo $group->id; ?>"<?php if ($selected==true) echo ' selected="selected"'; ?>><?php echo $group->title; ?></option>
					<?php } ?>
				</select>
			</td>
			
			<td align="right" class="key" colspan="2">
				<label for="greeting">
				<?php echo JText::_( ' ' );?>
				</label>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->search_by_fields_or_cblists ); ?>:
				</label>
			</td>
			<td>
				<select name="search_fields_cblists<?php echo $i; ?>" id="search_fields_cblists<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"<?php if ($search_fields_cblists==0) echo " selected"; ?>><?php echo $this->configuration->search_by_fields; ?></option>
					<option value="1"<?php if ($search_fields_cblists==1) echo " selected"; ?>><?php echo $this->configuration->search_by_cblists; ?></option>
				</select>
			</td>
			
			<td width="400" align="right" class="key" colspan="2">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->search_by_fields_or_cblists_help ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->select_a_cblists ); ?>:
				</label>
			</td>
			<td>
				<select name="cblistid<?php echo $i; ?>" id="cblistid<?php echo $i; ?>" size="1" style="width: 250px; clear: both;">
					<option value="0"><?php echo $this->configuration->select_a_cblists; ?></option>
		<?php	for ($j=0, $n=count($this->CBLists); $j < $n; $j++)
					{
					if ($cblist_id == $this->CBLists[$j]->listid)
							echo "<option value='".$this->CBLists[$j]->listid."' selected>".$this->CBLists[$j]->title."</option>";
						else
							echo "<option value='".$this->CBLists[$j]->listid."'>".$this->CBLists[$j]->title."</option>";
					}	?>
				</select>
			</td>
			<td align="right" class="key" colspan="2">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">	<hr style="width: 80%; height: 4px;" />	</td>
		</tr>
		<?php	}	?>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_cbadvsearch" />
<input type="hidden" name="id" value="description" />
<input type="hidden" name="task" value="savedescription" />
<input type="hidden" name="controller" value="cbadvsearch" />
</form>

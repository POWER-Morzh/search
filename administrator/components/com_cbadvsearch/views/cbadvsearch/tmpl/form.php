<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( $this->configuration->details ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->label ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="label" id="label" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->label;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->field ); ?>:
				</label>
			</td>
			<td>
				<!--<input class="text_area" type="text" name="field_id" id="field_id" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->field_id;?>" />-->
				<?php	$saved_fields = explode(",", $this->cbadvsearch->field_id);
				echo '<input type="hidden" name="ordering" value="'.$this->cbadvsearch->ordering.'" />';	?>
				<select name="field_id[]" id="field_id" style="width: 150px; height: 150px;" multiple>
		<?php	for ($i=0, $n=count( $this->fields ); $i < $n; $i++)	{
					$field_id = &$this->fields[$i]->fieldid;
					$field_name = &$this->fields[$i]->name;
					$ordering = &$this->fields[$i]->ordering;
					if (@in_array($field_id, $saved_fields))
							echo "<option value='".$field_id."' selected>".$field_name."</option>";
						else
							echo "<option value='".$field_id."'>".$field_name."</option>";
					}	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->description ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="description" id="description" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->description;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->searchable_it_will_be_used_to_search ); ?>:
				</label>
			</td>
			<td>
				<select name="searchable" id="searchable">
				<?php echo $this->cbadvsearch->searchable == 0 ? "<option value='0' selected>".$this->configuration->no."</option>" : "<option value='0'>".$this->configuration->no."</option>";	?>
				<?php echo $this->cbadvsearch->searchable == 1 ? "<option value='1' selected>".$this->configuration->yes."</option>" : "<option value='1'>".$this->configuration->yes."</option>";	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->appears_in_the_results ); ?>:
				</label>
			</td>
			<td>
				<select name="appears_results" id="appears_results">
				<?php echo $this->cbadvsearch->appears_results == 0 ? "<option value='0' selected>".$this->configuration->no."</option>" : "<option value='0'>".$this->configuration->no."</option>";	?>
				<?php echo $this->cbadvsearch->appears_results == 1 ? "<option value='1' selected>".$this->configuration->yes."</option>" : "<option value='1'>".$this->configuration->yes."</option>";	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_comparison_sign ); ?>:
				</label>
			</td>
			<td>
				<select name="comparison_sign" id="comparison_sign">
				<?php echo $this->cbadvsearch->comparison_sign == "=" ? "<option value='=' selected>".$this->configuration->equal."</option>" : "<option value='='>".$this->configuration->equal."</option>";
					echo $this->cbadvsearch->comparison_sign == "&lt" ? "<option value='&lt' selected>".$this->configuration->less."</option>" : "<option value='&lt'>".$this->configuration->less."</option>";
					echo $this->cbadvsearch->comparison_sign == "&lt=" ? "<option value='&lt=' selected>".$this->configuration->less_or_equal."</option>" : "<option value='&lt='>".$this->configuration->less_or_equal."</option>";
					echo $this->cbadvsearch->comparison_sign == ">" ? "<option value='>' selected>".$this->configuration->greater."</option>" : "<option value='>'>".$this->configuration->greater."</option>";
					echo $this->cbadvsearch->comparison_sign == ">=" ? "<option value='>=' selected>".$this->configuration->greater_or_equal."</option>" : "<option value='>='>".$this->configuration->greater_or_equal."</option>";
					echo $this->cbadvsearch->comparison_sign == "like" ? "<option value='like' selected>".$this->configuration->like."</option>" : "<option value='like'>".$this->configuration->like."</option>";	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_search_number ); ?>:
				</label>
			</td>
			<td>
				<!--<input class="text_area" type="text" name="field_id" id="field_id" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->field_id;?>" />-->
				<?php	echo '<input type="hidden" name="ordering" value="'.$this->cbadvsearch->ordering.'" />';	?>
				<select name="thesearch" id="thesearch" size="1" style="width: 50px; clear: both;">
				<?php for($i=1; $i<=$this->searches; $i++) { ?>
					<option value="<?php echo $i; ?>"<?php if ($i==$this->cbadvsearch->thesearch) echo " selected"; ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->content_of_the_field ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="fill_in_text" id="fill_in_text" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->fill_in_text;?>" />
				<br /><br /><label for="greeting">
					<?php echo JText::_( $this->configuration->only_for_textfields ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->css_class_for_this_field_in_results ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="css_class" id="css_class" size="32" maxlength="50" value="<?php echo $this->cbadvsearch->css_class;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_cbadvsearch" />
<input type="hidden" name="id" value="<?php echo $this->cbadvsearch->id; ?>" />
<input type="hidden" name="current_search" value="<?php echo $this->cbadvsearch->thesearch; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="cbadvsearch" />
</form>

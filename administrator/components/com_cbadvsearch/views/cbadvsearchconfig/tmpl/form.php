<?php defined('_JEXEC') or die('Restricted access');	?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_($this->configuration->select_a_language); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( $this->configuration->the_language ); ?>:
				</label>
			</td>
			<td>
				<select name="language" id="language">
				<?php foreach($this->languages as $l) {
					$selected = $l->code==$this->cbadvsearch->language ? "selected" : ""; ?>
				<option value='<?php echo $l->code; ?>' <?php echo $selected; ?>><?php echo $l->name; ?></option>
				<?php } ?>
				</select>
			</td>
			<td width="500" align="right" class="key"></td>
		</tr>
	</table>
	</fieldset>
<div class="clr"></div>

<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_($this->configuration->language_translation ); ?></legend>

		<table class="admintable">
<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( '#' ); ?>
			</th>
			<th>
				<?php //echo JText::_( $this->configuration->variable ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->current_value ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->original_value_english ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;	$n=count( $this->default_language );
	$i = 0;
	for(reset($this->default_language); $key=key($this->default_language); next($this->default_language))	{	?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $i."<br>"; ?>
			</td>
			<td align="center">
				<?php //	echo $key; ?>
			</td>
			<td align="center">
				<textarea name="value_<?php echo $key; ?>" id="value_<?php echo $key; ?>" style="width: 300px; height: 60px;"><?php echo empty($this->cbadvsearch->$key) ? $this->default_language[$key] : $this->cbadvsearch->$key; ?></textarea>
			</td>
			<td align="left">
				<?php echo $this->default_language[$key]; ?>
			</td>
		</tr>
		<?php	$i++;	}	?>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_cbadvsearch" />
<input type="hidden" name="id" value="<?php echo $this->cbadvsearch->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="return" id="return" value="" />
<input type="hidden" name="controller" value="cbadvsearchconfig" />
</form>

<?php defined('_JEXEC') or die('Restricted access');
	$the_search = !empty($this->current_search) ? $this->current_search : $this->items[0]->thesearch;	?>
<form action="index.php" method="post" id="adminForm" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">	&nbsp;	</th>
			<th width="20">	&nbsp;	</th>			
			<th>
				<?php echo JText::_( $this->configuration->this_is_search_number.' '.$the_search); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->go_to_the_search ); ?>
			</th>
			<th>
				<select name="current_search" id="current_search" size="1" style="width: 50px; clear: both;" onChange="javascript: change_search();">
				<?php for($i=1; $i<=$this->searches[0]->searches; $i++) { ?>
					<option value="<?php echo $i; ?>"<?php if ($i==$the_search) echo " selected"; ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</th>
			<th>	&nbsp;	</th>			
			<th>	&nbsp;	</th>			
			<th width="15%">	&nbsp;	</th>			
		</tr>
		<tr>
			<th width="5">
				<?php echo JText::_( '#' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th>
				<?php echo JText::_( $this->configuration->title_as_showed_in_search_form ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->cb_field_name ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->description ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->publish_on_search_form ); ?>
			</th>
			<th>
				<?php echo JText::_( $this->configuration->searchable ); ?>
			</th>
			<th width="15%">
			<?php echo JText::_( $this->configuration->order_on_search_form ); ?>
				<?php echo JHTML::_('grid.order',  $this->items ); ?>
			</th>
		</tr>
	</thead>
	<!--<tfoot>
		<tr>
			<td colspan="12">
				<?php //echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>-->	
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_cbadvsearch&controller=cbadvsearch&task=edit&cid[]='. $row->id );
		$published 	= JHTML::_('grid.published', $row, $i );	?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->label; ?></a>
			</td>
			<td>
				<?php echo $row->field_name; ?>
			</td>
			<td>
				<?php echo $row->description; ?>
			</td>
			<td align="center">
				<?php echo $published;?>
			</td>
			<td align="center">
				<?php echo $row->searchable==1 ? "yes" : "no" ;?>
			</td>
			<td class="order" nowrap="nowrap">
				<span><?php echo $this->pagination->orderUpIcon( $i, $row->parent == 0 || $row->parent == @$rows[$i-1]->parent, 'orderup', 'Move Up'); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, $row->parent == 0 || $row->parent == @$rows[$i+1]->parent, 'orderdown', 'Move Down'); ?></span>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" id="option" name="option" value="com_cbadvsearch" />
<input type="hidden" id="task" name="task" value="" />
<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="cbadvsearch" />
</form>
<script type="text/javascript">
function change_search()
	{
		document.getElementById('task').value = "changeSearch";
		document.getElementById('boxchecked').value = "0";
		document.adminForm.submit();
	}
</script>

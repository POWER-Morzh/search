<?php defined('_JEXEC') or die('Restricted access');	?>
<form action="index.php" method="post" id="adminForm" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( '#' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th style="text-align: left;">
				<?php echo JText::_( $this->configuration->the_language ); ?>
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
	$task	= JRequest::getVar( 'task', array(), 'get', 'array' );
	$cid	= JRequest::getVar( 'cid', array(), 'get', 'array' );
	$k = 0;	$n=count( $this->items );
	for ($i=0; $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id', $i, $row->id );	?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php echo $row->language_name; ?></a>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}	?>
	</table>
</div>

<input type="hidden" id="option" name="option" value="com_cbadvsearch" />
<input type="hidden" id="task" name="task" value="<?php //echo $task[0]; ?>" />
<input type="hidden" id="boxchecked" name="boxchecked" value="<?php echo !empty($cid[0]) ? $cid[0] : "0"; ?>" />
<input type="hidden" name="controller" value="cbadvsearchconfig" />
</form>
<script type="text/javascript">
<?php	if (!empty($task) && !empty($cid))
			{
				echo "for(var i=0; i<".$n."; i++) if (document.getElementById('cb'+i).value==".$cid[0].") document.getElementById('cb'+i).checked=true;\n";
				echo "hideMainMenu(); submitbutton('edit');";
			}	?>
</script>

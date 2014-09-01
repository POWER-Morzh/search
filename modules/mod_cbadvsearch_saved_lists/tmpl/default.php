<?php
/**
 * @version		$Id: default.php
 * @package		CB Advanched Search
 * @subpackage	mod_cbadvsearch_saved_lists
 * @copyright	Copyright (C) 2009 - 2013  All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
error_reporting(0);
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
function show_saved_forms()
	{
		document.getElementById('cboperation').value = 'saved-form';
		document.forms['showsavedignoredform'].submit();
	}
function show_saved_results()
	{
		document.getElementById('cboperation').value = 'saved-results';
		document.forms['showsavedignoredform'].submit();
	}
function show_ignored_results()
	{
		document.getElementById('cboperation').value = 'ignored-results';
		document.forms['showsavedignoredform'].submit();
	}

function delete_form()
	{
		var lista = '', primul = 0;
		for (i=0; i<document.showsavedignoredform.result.length; i++)
			if (document.showsavedignoredform.result[i].checked)
				{
					if (primul==0) primul = document.showsavedignoredform.result[i].value;
					lista += document.showsavedignoredform.result[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_YOU_HAVE_TO_SELECT_AT_LEAST_ONE_ITEM_LIST'); ?>');	return;	}
		document.getElementById('cboperation').value = 'delete form';
		document.getElementById('cboperation-values').value = lista;
		document.forms['showsavedignoredform'].submit();
	}
function set_default_form()
	{
		var lista = '', primul = 0;
		for (i=0; i<document.showsavedignoredform.result.length; i++)
			if (document.showsavedignoredform.result[i].checked)
				{
					if (primul==0) primul = document.showsavedignoredform.result[i].value;
					lista += document.showsavedignoredform.result[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_YOU_HAVE_TO_SELECT_AT_LEAST_ONE_ITEM_LIST'); ?>');	return;	}
		document.getElementById('cboperation').value = 'set default form';
		document.getElementById('cboperation-values').value = lista;
		document.forms['showsavedignoredform'].submit();
	}
function delete_list()
	{
		var lista = '', primul = 0;
		for (i=0; i<document.showsavedignoredform.result.length; i++)
			if (document.showsavedignoredform.result[i].checked)
				{
					if (primul==0) primul = document.showsavedignoredform.result[i].value;
					lista += document.showsavedignoredform.result[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_YOU_HAVE_TO_SELECT_AT_LEAST_ONE_ITEM_LIST'); ?>');	return;	}
		document.getElementById('cboperation').value = 'delete list';
		document.getElementById('cboperation-values').value = lista;
		document.forms['showsavedignoredform'].submit();
	}
function show_list(value)
	{
		var lista = '', primul = 0;
		for (i=0; i<document.showsavedignoredform.result.length; i++)
			if (document.showsavedignoredform.result[i].checked)
				{
					if (primul==0) primul = document.showsavedignoredform.result[i].value;
					lista += document.showsavedignoredform.result[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_YOU_HAVE_TO_SELECT_AT_LEAST_ONE_ITEM_LIST'); ?>');	return;	}
		document.getElementById('cboperation').value = value;
		document.getElementById('cboperation-values').value = lista;
		document.forms['showsavedignoredform'].submit();
	}
function delete_item(value)
	{
		var lista = '', primul = 0;
		for (i=0; i<document.showsavedignoredform.result.length; i++)
			if (document.showsavedignoredform.result[i].checked)
				{
					if (primul==0) primul = document.showsavedignoredform.result[i].value;
					lista += document.showsavedignoredform.result[i].value + ',';
				}
		if (lista=='')	{	alert('<?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_YOU_HAVE_TO_SELECT_AT_LEAST_ONE_ITEM_LIST'); ?>');	return;	}
		document.getElementById('cboperation').value = 'delete item ' + value;
		document.getElementById('cboperation-values').value = lista;
		document.forms['showsavedignoredform'].submit();
	}
</script>

<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$uri = &JFactory::getURI();
?>
<form id="showsavedignoredform" name="showsavedignoredform" action="<?php // echo $uri->toString(); ?>" method="post">
<input type="hidden" name="cboperation" id="cboperation" value="" />
<input type="hidden" name="cboperation-values" id="cboperation-values" value="" />
<input type="checkbox" name="result" id="result" value="0" style="display: none;">

	<table><?php if (!empty($showSavedFormsList)) { ?>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="showforms" class="button" onclick="javascript: show_saved_forms();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_SAVED_FORMS_LIST_LABEL');?></button>
			</td>
		</tr><?php } if (!empty($showSavedResultsList)) { ?>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="showsaved" class="button" onclick="javascript: show_saved_results();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_SAVED_RESULTS_LIST_LABEL');?></button>
			</td>
		</tr><?php } if (!empty($showIgnoredResultsList)) { ?>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="showignored" class="button" onclick="javascript: show_ignored_results();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_IGNORED_RESULTS_LIST_LABEL');?></button>
			</td>
		</tr><?php }?>
	</table>
		<?php if ($operation=="saved-form") { ?>
	<table>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_SAVED_FORMS_LIST_LABEL'); ?></label>
			</td>
		</tr>
		<?php if (empty($showSavedFormsListResults)) { ?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_NO_RESULTS');?></label>
			</td>
		</tr>
		<?php }	else {	?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.showsavedignoredform.checkentirelist.checked==false)
							{	//	document.showsavedignoredform.checkentirelist.checked = true;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = false;	}
							else	{
					//	document.showsavedignoredform.checkentirelist.checked = false;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = true;	}">
					<b><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_CHECK_ALL');?></b>
			</td>
		</tr>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="deleteform" class="button" onclick="javascript: delete_form();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_DELETE_FORM');?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<button name="setdefaultform" class="button" onclick="javascript: set_default_form();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SET_DEFAULT_FORM');?></button>
			</td>
		</tr><?php }	?>
			
		<?php foreach($showSavedFormsListResults as $r)	{ ?>
		<tr>
			<td nowrap="nowrap" width="150">
				<?php echo '<INPUT TYPE="checkbox" NAME="result" id="result" value="'.$r->id.'" onClick="">&nbsp;&nbsp;'; ?>
			</td>
			<td nowrap="nowrap" width="150">
				<label><?php echo $r->form_name;	if ($r->default_form==1) echo " (".JText::_('MOD_CBADVSEARCH_SAVED_LISTS_DEFAULT_FORM').")"; ?></label>
			</td>
		</tr>
		<?php }	?>
	</table>
		<?php	}	?>
		
		
		<?php if ($operation=="saved-results") { ?>
	<table>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_SAVED_RESULTS_LIST_LABEL');?></label>
			</td>
		</tr>
		<?php if (empty($showSavedResultsList)) { ?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_NO_RESULTS');?></label>
			</td>
		</tr>
		<?php }	else {	?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.showsavedignoredform.checkentirelist.checked==false)
							{	//	document.showsavedignoredform.checkentirelist.checked = true;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = false;	}
							else	{
					//	document.showsavedignoredform.checkentirelist.checked = false;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = true;	}">
					<b><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_CHECK_ALL');?></b>
			</td>
		</tr>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="deletelist" class="button" onclick="javascript: delete_list();"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_DELETE_LIST');?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				<button name="setdefaultform" class="button" onclick="javascript: show_list('saved-results-items');"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_LIST');?></button>
			</td>
		</tr><?php }?>
			
		<?php foreach($showSavedResultsListResults as $r)	{ ?>
		<tr>
			<td nowrap="nowrap" width="50">
				<?php echo '<INPUT TYPE="checkbox" NAME="result" id="result" value="'.$r->id.'" onClick="">&nbsp;&nbsp;'; ?>
			</td>
			<td nowrap="nowrap">
				<label><?php echo $r->list_name; ?></label>
			</td>
		</tr>
		<?php }	?>
	</table><?php }	?>
	
	
		<?php if ($operation=="saved-results-items") { ?>
	<table>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_SAVED_RESULTS_LIST_LABEL')." '".$showSavedResultsListResultsItems[0]->list_name."'";?></label>
			</td>
		</tr>
		<?php if (empty($showSavedResultsList)) { ?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_NO_RESULTS');?></label>
			</td>
		</tr>
		<?php }	else {	?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.showsavedignoredform.checkentirelist.checked==false)
							{	//	document.showsavedignoredform.checkentirelist.checked = true;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = false;	}
							else	{
					//	document.showsavedignoredform.checkentirelist.checked = false;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = true;	}">
					<b><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_CHECK_ALL');?></b>
			</td>
		</tr>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="deleteitem" class="button" onclick="javascript: delete_item('saved');"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_DELETE_ITEM');?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				&nbsp;
			</td>
		</tr><?php }?>
			
		<?php foreach($showSavedResultsListResultsItems as $r)	{ ?>
		<tr>
			<td nowrap="nowrap" width="50">
				<?php echo '<INPUT TYPE="checkbox" NAME="result" id="result" value="'.$r->id.'" onClick="">&nbsp;&nbsp;'; ?>
			</td>
			<td nowrap="nowrap">
				<a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $r->user_id; ?>'>
					<?php echo $r->firstname." ".$r->lastname; ?></a>
			</td>
		</tr>
		<?php }	?>
	</table><?php }?>
	
	
		<?php if ($operation=="ignored-results") { ?>
	<table>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_SHOW_IGNORED_RESULTS_LIST_LABEL');?></label>
			</td>
		</tr>
		<?php if (empty($showSavedResultsList)) { ?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<label><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_NO_RESULTS');?></label>
			</td>
		</tr>
		<?php }	else {	?>
		<tr>
			<td nowrap="nowrap" colspan="2">
				<input type="checkbox" name="checkentirelist" id="checkentirelist" value="yes"
                    onClick="javascript: if (document.showsavedignoredform.checkentirelist.checked==false)
							{	//	document.showsavedignoredform.checkentirelist.checked = true;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = false;	}
							else	{
					//	document.showsavedignoredform.checkentirelist.checked = false;
						for (i=0; i<document.showsavedignoredform.result.length; i++) document.showsavedignoredform.result[i].checked = true;	}">
					<b><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_CHECK_ALL');?></b>
			</td>
		</tr>
		<tr>
			<td width="150px" nowrap="nowrap">
				<button name="deletelist" class="button" onclick="javascript: delete_item('ignored');"><?php echo JText::_('MOD_CBADVSEARCH_SAVED_LISTS_DELETE_ITEM');?></button>
			</td>
			<td width="150px" nowrap="nowrap">
				&nbsp;
			</td>
		</tr><?php }?>
			
		<?php foreach($showIgnoredResultsListResults as $r)	{ ?>
		<tr>
			<td nowrap="nowrap" width="50">
				<?php echo '<INPUT TYPE="checkbox" NAME="result" id="result" value="'.$r->id.'" onClick="">&nbsp;&nbsp;'; ?>
			</td>
			<td nowrap="nowrap">
				<a href='index.php?option=com_comprofiler&task=userProfile&user=<?php echo $r->user_id; ?>'>
					<?php echo $r->firstname." ".$r->lastname; ?></a>
			</td>
		</tr>
		<?php }	?>
	</table>
	<?php	}	?>
</form>

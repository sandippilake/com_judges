<?php
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');

$listOrder	= $this->state->get('list.ordering');

$listDirn	= $this->state->get('list.direction');

?>

<form action="index.php" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
	<?php endif;?>
	
	<div id="j-main-container" <?php if (!empty( $this->sidebar)) { echo 'class="span10"';} ?> >
		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" class="hasTooltip" title="<?php echo JHtml::tooltipText('COM_JUDGES_SEARCH_JUDGES'); ?>" />
			</div>
			<div class="btn-group pull-left">
				<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
					<i class="icon-search"></i>
				</button>
				<button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_RESET'); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
					<i class="icon-remove"></i>
				</button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</div>
		<div class="clr" style="clear:both"> </div>
 
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'COM_JUDGES_FIRST_NAME', 'c.firstname', $listDirn, $listOrder); ?>
					</th>
					<th class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'COM_JUDGES_LAST_NAME', 'c.lastname', $listDirn, $listOrder); ?>
					</th>
					<th class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'COM_JUDGES_EMAIL', 'u.email', $listDirn, $listOrder); ?>
					</th>
					<th class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'COM_JUDGES_JUDGE_LEVEL', 'j.judgelevel', $listDirn, $listOrder); ?>
					</th>
					<th class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'COM_JUDGES_STATUS', 's.judgestatus', $listDirn, $listOrder); ?>
					</th>
					<th  width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'j.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php foreach ($this->items as $i => $item) :
				$canChange  = $user->authorise('core.edit.state', 'judges.' . $item->id) ;
				
			?>
			
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center">
						<?php echo $item->firstname; ?>
					</td>
					<td class="center">
						<?php echo $item->lastname; ?>
					</td>
					<td class="center">
						<?php echo $item->email; ?>
					</td>
					<td class="center">
						<?php echo $item->judge_level; ?>
					</td>
					<td class="center">
						<?php echo $item->judge_status; ?>
					</td>
					<td class="center">
						<?php echo (int) $item->id; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
	<input type="hidden" name="view" value="judges" />
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>

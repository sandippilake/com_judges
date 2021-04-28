<?php
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

?>
<form action="index.php" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
	<?php endif;?>
	
	<div id="j-main-container" <?php if (!empty( $this->sidebar)) { echo 'class="span10"';} ?> >
		<table class="table table-striped">
			<thead>
				<tr>
					<th  width="5%" class="nowrap center">
						<?php echo JText::_('JGRID_HEADING_ID'); ?>
					</th>
					<th class="nowrap">
						<?php echo JText::_('COM_JUDGES_JUDGE_LEVEL'); ?>
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
			<?php foreach ($this->items as $i => $item) : ?>

				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo (int) $item->judge_level_id; ?>
					</td>
					<td >
						<?php echo $item->judge_level; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
	<input type="hidden" name="view" value="levels" />
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>

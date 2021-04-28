<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');
$user	= JFactory::getUser();
$userId	= $user->get('id');
$extension	= $this->escape($this->state->get('filter.extension'));
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_comapre');

?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
		
		
	}
	function setDefault(def,id){
		var J=jQuery.noConflict();
			 J.ajax({
        url: "index.php?option=com_compare&task=country.setDefault",
        type: "post",
        data: {def:def,id:id},
        success: function(text){
           window.location.reload(true);
        }
      
    });
			}
	function setHightPripority(h,id){
		var J=jQuery.noConflict();
			 J.ajax({
        url: "index.php?option=com_compare&task=country.setHightPripority",
        type: "post",
        data: {h:h,id:id},
        success: function(text){
           window.location.reload(true);
        }
      
    });
			}
</script>
<form action="<?php ///echo JRoute::_('index.php?option=com_carparts&view=brands');?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
      <?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif;?>
	<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search btn-group pull-left">
			<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" class="hasTooltip" title="<?php echo JHtml::tooltipText('COM_USERS_SEARCH_USERS'); ?>" />
		</div>
		<div class="btn-group pull-left">
			<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
			<button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_RESET'); ?>" onclick="document.id('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
		</div>
		<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></label>
				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
					<option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
					<option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');  ?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
					<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
				</select>
			</div>
			
			
	</div>
 <div class="clr" style="clear:both"> </div>
 <table class="table table-striped">
		<thead>
			<tr>
			 
			 	<th width="1%" class="nowrap center">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th width="20%" class="nowrap center">
				<?php echo JHtml::_('grid.sort',  JText::_('COM_COMPARE_COMPANY_NAME'), 'a.company', $listDirn, $listOrder); ?>
				</th>
				<th width="20%" class="nowrap center">
				<?php echo JHtml::_('grid.sort',  JText::_('COM_COMPARE_HIGH_PRIPORITY'), 'a.company', $listDirn, $listOrder); ?>
				</th>
				<th width="20%" class="nowrap center">
				<?php echo JHtml::_('grid.sort',  JText::_('COM_COMPARE_DEFAULT'), 'a.company', $listDirn, $listOrder); ?>
				</th>
				<th width="20%" class="nowrap center">
				<?php echo JHtml::_('grid.sort',  JText::_('JSTATUS'), 'a.company', $listDirn, $listOrder); ?>
				</th>

              
                <th  width="1%" class="nowrap center">
                    <?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.cf_id', $listDirn, $listOrder); ?>
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
		 $canChange  = $user->authorise('core.edit.state', $extension . '.countries.' . $item->id) ;

			?>
			
			<tr class="row<?php echo $i % 2; ?>">
			 <td class="center">
					 
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					 
				</td>
				<td class="left">
					<a href="<?php echo JRoute::_('index.php?option=com_compare&task=country.edit&id='.(int) $item->id); ?>" title="<?php echo JText::sprintf('COM_CARPART_EDIT_USER', $this->escape($item->country)); ?>"><?php echo $item->country;?></a>
				</td>
				<td class="center">  <a class="btn btn-micro  hasToolti "href="javascript:void()" onclick="setHightPripority(<?php echo $item->high_pripority?>,<?php echo $item->id?>)">
				<?php if($item->high_pripority) 
				$class="icon-publish";
				else
				$class="icon-unpublish";	?>
				<li class="<?php echo $class?>"></li>
				</a></td>
				<td class="center">  <a class="btn btn-micro  hasToolti "href="javascript:void()" onclick="setDefault(<?php echo $item->default?>,<?php echo $item->id?>)">
				<?php if($item->default) 
				$class="icon-publish";
				else
				$class="icon-unpublish";	?>
				<li class="<?php echo $class?>"></li>
				</a></td>
				
 
                <td class="center">
							<?php echo JHtml::_('jgrid.published', $item->state, $i, 'countries.', $canChange); ?>
						</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
               
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
            <input type="hidden" name="boxchecked" value="0" />
          <input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
           <input type="hidden" name="view" value="countries" />
           <input type="hidden" name="task" value="" />
           <?php echo JHtml::_('form.token'); ?>
           
</form>

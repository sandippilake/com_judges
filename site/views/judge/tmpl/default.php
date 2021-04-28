<?php
defined('_JEXEC') or die('Restricted Access');

JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior2.select2', select);

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_judges/assets/style.css');

?>
<script>
	jQuery(document).ready(function() {
		// jQuery('#jform_user_id').select2({
		// 	ajax: {
		// 		url: 'index.php?option=com_judges&task=getUsers',
		// 		data: function (params) {
		// 			var query = {
		// 				search: params.term
		// 			}
		// 			// Query parameters will be ?search=[term]
		// 			return query;
		// 		},
		// 		processResults: function (data) {
		// 			// Tranforms the top-level key of the response object from 'items' to 'results'
		// 			return {
		// 				results: data.items
		// 			};
		// 		}
		// 	}
		// });

		jQuery("#jform_judgelevel").on('change',function(){
			var cval = jQuery('#jform_judgelevel option:selected').val();
			if(cval == 6) {
				jQuery('#licensed_until_div').show();
			} else {
				jQuery('#licensed_until_div').hide();
			}
		});
		jQuery("#jform_user_id").on('change',function(){
			var cval = jQuery('#jform_user_id option:selected').val();
			jQuery.ajax({
				url: 'index.php?option=com_judges&controller=judges&task=getuserdetails&id='+cval+'&tmpl=component',
				type: 'post',
				onRequest: function(){},
			}).done(function(responseText){
				if(responseText != '')
				{
					var n= responseText.split('|');
					jQuery("#firstname").html(n[0]);
					jQuery("#middlename").html(n[1]);
					jQuery("#lastname").html(n[2]);
					jQuery("#jphone").html(n[3]);
					jQuery("#jemail").html(n[4]);
					jQuery("#address_line_1").html(n[5]);
					jQuery("#address_line_2").html(n[6]);
					jQuery("#address_line_3").html(n[7]);
					jQuery("#address_city_name").html(n[8]);
					jQuery("#address_state_name").html(n[9]);
					jQuery("#address_zip_code").html(n[10]);
					jQuery("#address_country_name").html(n[11]);
					jQuery("#ticaregion").html(n[12]);	
					jQuery("#jform_airport").html(n[13]);	
				}
			});	
		});
	});
</script>

<form action="<?php echo JRoute::_('index.php?option=com_judges&view=judge&id=' . (int)$this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="judge-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">
				<?php if ($this->item->user_id) { ?>
					<input type="hidden" name="user_id" value="<?php echo $this->item->user_id; ?>" />
				<?php } else { ?>
					<?php //echo $this->form->renderField('user_id'); ?>

					<div class="control-group">
						<div class="control-label"><?php echo JText::_('COM_JUDGES_SELECT_USERS');?></div>
						<div class="controls">
							<?php echo JHtml::_('select.genericlist', $this->users, 'jform[user_id]', 'style="width:auto;" data-minimum-input-length="3"', 'value', 'text', null, 'jform_user_id'); ?>
						</div>	
					</div>
					
				<?php } ?>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_FIRST_NAME_DESC');?></div>
					<div class="controls">
						<span id="firstname"><?php echo $this->item->firstname; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_MIDDLE_NAME_LABEL');?></div>
					<div class="controls">
						<span id="middlename"><?php echo $this->item->middlename; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_LAST_NAME_LABEL');?></div>
					<div class="controls">
						<span id="lastname"><?php echo $this->item->lastname; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_EMAIL_LABEL');?></div>
					<div class="controls">
						<span id="jemail"><?php echo $this->item->email; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_PHONE_LABEL');?></div>
					<div class="controls">
						<span id="jphone"><?php echo $this->item->cb_phonenumber; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_SELECT_TICA_REGION');?></div>
					<div class="controls">
						<span id="ticaregion"><?php echo $this->item->competitive_region_name; ?></span>
					</div>	
				</div>

				<div class="control-group">
					<div class="control-label">Address 1</div>
					<div class="controls">
						<span id="address_line_1"><?php echo $this->item->cb_address1?$this->item->cb_address1:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Address 2</div>
					<div class="controls">
						<span id="address_line_2"><?php echo $this->item->cb_address2?$this->item->cb_address2:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Address 3</div>
					<div class="controls">
						<span id="address_line_3"><?php echo $this->item->cb_address3?$this->item->cb_address3:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">City</div>
					<div class="controls">
						<span id="address_city_name"><?php echo $this->item->cb_city?$this->item->cb_city:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">State</div>
					<div class="controls">
						<span id="address_state_name"><?php echo $this->item->cb_state?$this->item->cb_state:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Zip code</div>
					<div class="controls">
						<span id="address_zip_code"><?php echo $this->item->cb_zip?$this->item->cb_zip:'-'; ?></span>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Country</div>
					<div class="controls">
						<span id="address_country_name"><?php echo $this->item->cb_country?$this->item->cb_country:'-'; ?></span>
					</div>	
				</div>
						
				<?php echo $this->form->renderField('judge_abbreviation'); ?>
				<?php echo $this->form->renderField('judgestatus'); ?>
				<?php echo $this->form->renderField('judgelevel'); ?>
				<?php echo $this->form->renderField('licensed'); ?>
				
				<div id="licensed_until_div" style="<?php echo ($this->item->judgelevel != 6 && $this->item->judgelevel != null) ?"display:none":"";?>" >
					<?php echo $this->form->renderField('licensed_until'); ?>
				</div>	
				<?php /*
				<div id="licensed_until_div" style="<?php echo $this->item->judgelevel != 6?"display:none":"";?>" >
					<?php echo $this->form->renderField('licensed_until'); ?>
				</div> */ ?>					
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_AIRPORT_LABEL');?></div>
					<div class="controls">
						<span id="jform_airport" value="<?php ?>" name="jform_airport"> </span>
						<?php echo $this->item->cb_airport; ?>
					</div>	
				</div>
				<?php echo $this->form->renderField('judge_of_merit'); ?>
				<?php echo $this->form->renderField('judge_emeritus'); ?>
				<?php echo $this->form->renderField('distinguished_judge'); ?>
				<?php echo $this->form->renderField('ring_instructor'); ?>
				<?php echo $this->form->renderField('school_instructor'); ?>
				<?php echo $this->form->renderField('genetics_instructor'); ?>
				<?php /* echo $this->form->renderField('international'); */ ?>
				<?php echo $this->form->renderField('other'); ?>
				
				<?php echo $this->form->renderField('photo'); ?>
				<?php if ($this->item->photo && file_exists(JPATH_ROOT . '/images/judges/' . $this->item->photo)) { ?>
					<div class="control-group">
						<div class="control-label"><label>&nbsp;</label></div>
						<div class="controls">
							<img width="120" src="<?php echo JURI::root() . 'images/judges/' . $this->item->photo; ?>"/>
						</div>	
					</div>
					<input type="hidden" class="photo" id="photo" name="photo" value="<?php echo $this->item->photo; ?>" />
				<?php } ?>

				<?php echo $this->form->renderField('id'); ?>
            </fieldset>
            <div class="control-group">
				<div class="" style="">
					<input type="submit" value="Save" class="btn"/>
					<input type="button" class="btn" value="Cancel" onclick="window.location.href='<?php echo JRoute::_('index.php?option=com_judges');?>'"/>
				</div>
			</div>
        </div>
        
		<input type="hidden" name="option" value="<?php echo JRequest::getVar('option'); ?>" /> 
		<input type="hidden" name="view" value="judge" />
        <input type="hidden" name="task" value="judgesave" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

<?php
/**
 * @version     1.0.0
 * @package     com_carparts
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      vaishali <vaishali.dubal27@gmail.com> - http://
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
$document = JFactory::getDocument();
$params = JComponentHelper::getParams('com_judges');
$googlemapkey = $params->get('map_key');
?>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500"> 
<script>
jQuery(document).ready(function() {
	var fname = jQuery("#jform_firstname").val();
	var mname = jQuery("#jform_middlename").val();
	var lname = jQuery("#jform_lastname").val();
	
	var full_name = fname + ' ' + mname + ' ' + lname;
	if(full_name)
	{
		jQuery("#jform_fullname").val(full_name);
	}
			jQuery("select#jform_user_id").change(function(){
				
			var cval= jQuery( '#jform_user_id option:selected' ).val();
			//alert(cval);
			jQuery.ajax({
                url: 'index.php?option=com_judges&task=judge.getuserdetails&id='+cval+'&tmpl=component',
                type: 'post',
                onRequest: function(){},
            }).done(function(responseText){
				console.log(responseText);
				
							if(responseText != '')
							{
								var n= responseText.split('|');
								//var cbimg = 'images/comprofiler/';
								var cbimg = '<?php echo JURI::root().'images/comprofiler/'
							?>';
								
								var fullname = n[1] + ' ' + n[2] + ' ' + n[3];
								
									jQuery("#avatar").attr("src",cbimg +n[0]);
									jQuery("#photo").val(n[0]);
									jQuery("#jform_firstname").val(n[1]);
									jQuery("#jform_middlename").val(n[2]);
									jQuery("#jform_lastname").val(n[3]);
									jQuery("#jform_phone").val(n[4]);
									jQuery("#address_line_1").val(n[5]);
									jQuery("#address_line_2").val(n[6]);
									jQuery("#address_line_3").val(n[7]);
									jQuery("#address_city_name").val(n[8]);
									jQuery("#address_state_name").val(n[9]);
									jQuery("#address_zip_code").val(n[10]);
									jQuery("#address_country_name").val(n[11]);
									jQuery("#jform_ticaregion").val(n[12]).trigger("liszt:updated");	
									//jQuery("#jform_ticaregion").val(n[12]);
									jQuery("#jform_email").val(n[13]);
									jQuery("#jform_fullname").val(fullname);	
									jQuery("#jform_status").val(n[14]).trigger("liszt:updated");	
									jQuery("#jform_airport").text(n[15]);
									jQuery("#jform_judge_level").val(n[16]).trigger("liszt:updated");	
									jQuery("#jform_licensed").val(n[17]);
									jQuery("#jform_judge_abbreviation").val(n[18]);
									jQuery("#jform_distinguished").val(n[19]);
									jQuery("#jform_instructor").val(n[20]);
									jQuery("#jform_merit").val(n[21]);
									jQuery("#jform_emeritus").val(n[22]);
									
							}	
						});	
					});	
				var userid = '<?php echo $this->item->user_id;?>';
	
				if(userid)
					{ 
						jQuery('#jform_user_id').prop('disabled', true).trigger("liszt:updated");
					}	
			});
</script>

<script type="text/javascript">
    js = jQuery.noConflict();
	js(document).ready(function(){
        
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task === 'judge.cancel'){
            Joomla.submitform(task, document.getElementById('judge-form'));
        } else{
            if (task !== 'judge.cancel' && document.formvalidator.isValid(document.id('judge-form'))) {
                Joomla.submitform(task, document.getElementById('judge-form'));
            } else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>  

<form action="<?php echo JRoute::_('index.php?option=com_judges&layout=edit&id=' . (int) $this->item->id); ?>" method="post" 
enctype="multipart/form-data" name="adminForm" id="judge-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">
				<?php if ($this->item->user_id) { ?>
					<input type="hidden" name="user_id" value="<?php echo $this->item->user_id; ?>" />
				<?php } else { ?>
					<?php echo $this->form->renderField('user_id'); ?>
				<?php } ?>
				
				<?php echo $this->form->renderField('firstname'); ?>
				<?php echo $this->form->renderField('middlename'); ?>
				<?php echo $this->form->renderField('lastname'); ?>
				<?php echo $this->form->renderField('fullname'); ?>
				<?php echo $this->form->renderField('email'); ?>
				<?php echo $this->form->renderField('phone'); ?>
				<?php echo $this->form->renderField('ticaregion'); ?>
				<div class="control-group" id="locationField">
					<div class="control-label">Search Address</div>
					<div class="controls">
						<input id="autocomplete" placeholder="Enter your address"
							onFocus="geolocate()" type="text"></input>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">Address 1</div>
					<div class="controls">
						<input class="field" name="address_line_1" id="address_line_1" value="<?php echo $this->item->cb_address1;?>" readonly="readonly"></input>
						<input type="hidden"class="field" id="route" disabled="true"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Address 2</div>
					<div class="controls">
						<input class="field" name="address_line_2" id="address_line_2" value="<?php echo $this->item->cb_address2;?>" readonly="readonly"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Address 3</div>
					<div class="controls">
						<input class="field" name="address_line_3" id="address_line_3" value="<?php echo $this->item->cb_address3;?>" readonly="readonly"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">City</div>
					<div class="controls">
						<input class="field" name="address_city_name" id="address_city_name" value="<?php echo $this->item->cb_city;?>" readonly="readonly"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">State</div>
					<div class="controls">
						<input class="field" name="address_state_name" id="address_state_name" value="<?php echo $this->item->cb_state;?>" readonly="readonly"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Zip code</div>
					<div class="controls">
						<input class="field" name="address_zip_code" id="address_zip_code" value="<?php echo $this->item->cb_zip;?>" readonly="readonly"></input>
					</div>	
				</div>
				<div class="control-group">
					<div class="control-label">Country</div>
					<div class="controls">
						<input class="field" name="address_country_name" id="address_country_name"  value="<?php echo $this->item->cb_country;?>" readonly="readonly"></input>
					</div>	
				</div>
				<input type="hidden" class="field"  id="lat"  name="lat" value="<?php ?>"></input>
				<input type="hidden" class="field" id="lng"  name="lng" value="<?php ?>"></input>
				
				<?php echo $this->form->renderField('judge_abbreviation'); ?>
				<?php echo $this->form->renderField('judgestatus'); ?>
				<?php echo $this->form->renderField('judgelevel'); ?>
				<?php echo $this->form->renderField('licensed'); ?>
				<?php echo $this->form->renderField('licensed_until'); ?>
				<?php //if($this->item->cb_airport){?>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_JUDGES_AIRPORT_LABEL');?></div>
					<div class="controls">
						<span id="jform_airport" value="<?php ?>" name="jform_airport"> </span>
						<?php echo $this->item->cb_airport; ?>
					</div>	
				</div>
				<?php //} ?>
				<?php //echo $this->form->renderField('airport'); ?>
				<?php echo $this->form->renderField('judge_of_merit'); ?>
				<?php echo $this->form->renderField('judge_emeritus'); ?>
				<?php echo $this->form->renderField('distinguished_judge'); ?>
				<?php echo $this->form->renderField('ring_instructor'); ?>
				<?php echo $this->form->renderField('school_instructor'); ?>
				<?php echo $this->form->renderField('genetics_instructor'); ?>
				<?php echo $this->form->renderField('international'); ?>
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
        </div>

		<input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
		<input type="hidden" name="view" value="judge" />
        <input type="hidden" name="task" value="" /> 
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googlemapkey;?>&libraries=places&callback=initAutocomplete"
        async defer></script>
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZPlyYCPaqOOmX2JARADPh_eSL-li_fU4&libraries=places&callback=initAutocomplete"
        async defer></script-->
<!--script type = "text/javascript" src = "//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" ></script-->

 <script>
     
	var latitude;	
	var longitude;
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        administrative_area_level_2: 'short_name',
        sublocality_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        
        document.getElementById('address_line_1').value = '';
        document.getElementById('address_line_2').value = '';
		document.getElementById('address_line_3').value = '';
		document.getElementById('address_city_name').value = '';
		document.getElementById('address_country_name').value = '';
		document.getElementById('address_state_name').value = '';
		document.getElementById('address_zip_code').value = '';
		document.getElementById('lat').value = '';
		document.getElementById('lng').value = '';
        
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
			
			if(addressType == 'street_number') 
				{
						var address1 = place.address_components[i].short_name;
						
						if(address1)
						{
							document.getElementById('address_line_1').value = address1;
						}	
				}
			if(addressType == 'route') 
				{
						var route = place.address_components[i].long_name;
						if(!address1)
						{
							address1 = '';
						}
						var address = address1 + ' ' + route;
						if(address)
						{
							document.getElementById('address_line_1').value = address;
						}	
				}
			if(addressType == 'locality') 
				{
						var city = place.address_components[i].short_name;
				
						document.getElementById('address_city_name').value = city;
				}
			if(addressType == 'sublocality_level_1') 
				{
						var address2 = place.address_components[i].short_name;
				
						document.getElementById('address_line_2').value = address2;
				}
			if(addressType == 'sublocality_level_2') 
				{
						var address3 = place.address_components[i].short_name;
				
						document.getElementById('address_line_3').value = address3;
				}
			if(addressType == 'country') 
				{
						var country = place.address_components[i].long_name;
				
						document.getElementById('address_country_name').value = country;
				}
			if(addressType == 'administrative_area_level_1') 
				{
						var state = place.address_components[i].long_name;
				
						document.getElementById('address_state_name').value = state;
				}
			if(addressType == 'postal_code') 
				{
						var zipcode = place.address_components[i].long_name;
				
						document.getElementById('address_zip_code').value = zipcode;
				}
			if(addressType = 'lat') 
			{
				var lat = place.geometry.location.lat();
				if(lat)
				{
					document.getElementById('lat').value = lat;
				}
			}
		   if(addressType = 'lng') 
			{
				var lng = place.geometry.location.lng();
				if(lng)
				{
					document.getElementById('lng').value = lng;
				}
			}
		
        }		
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
            
          });
          
        }
      }
    </script>




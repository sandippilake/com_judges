<?php
defined('_JEXEC') or die('Restricted Access');

JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_judges/assets/style.css');
require_once('components/com_judges/helpers/judges.php');

$app = JFactory::getApplication();
$params = JComponentHelper::getParams('com_judges');
$usergroup = $params->get('admingroup');
$judgegroup = $params->get('judgegroup');

$user = JFactory::getUser();
$groups = isset($user->groups) ? $user->groups : array();


JPluginHelper::importPlugin('content');
$content_params = JComponentHelper::getParams('com_content');
// snippet code
		$breed_snippet = new stdClass();
		$breed_snippet->text = '{snippet judges-header-text}';
		$offset = 0;
		$app->triggerEvent('onContentPrepare', array ('com_judges.judges', &$breed_snippet, &$content_params, $offset));	
		
?>
<style>

.judge-addjudge{
    float: right;
    margin: 10px;
    width: 100%;
    text-align: right;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="system">
	<div class="item">
		<header>
			<h1 class="title"><?php echo JText::_('COM_JUDGES_TICA_JUDGES');?></h1>
		</header>

		<div class="content">
			<div class="content_div">
				<?php echo $breed_snippet->text; ?>
				<?php /*<p>Acceptance into, or advancement within The International Cat Association’s Judging Program 
					will be considered only at regularly scheduled Board Meetings and will be considered only 
					upon applicant furnishing proof of having met all requirements at each level as set forth in the 
					<a target="_blank" href="<?php echo JUri::base();?>images/pdf/publications/jud_pro.pdf">TICA Judging Program</a>.
					All judges are available to judge internationally unless otherwise noted.
				</p>

				<ul>
					<li>
						<a target="_blank" href="<?php echo JUri::base();?>images/judges/TheWayWeJudge.mp4"> 
							Watch a video about our judging program
						</a>
					</li>
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_k2&view=item&layout=item&id=96'); ?>">
							View a list of our honored judges
						</a>
					</li>
				</ul>
				*/ ?>
				<div class="tbljud">
				<?php
					echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'name-page'));
					echo JHtml::_('bootstrap.addTab', 'myTab', 'name-page', JText::_('COM_JUDGES', true));
						$i = 0;
						?>
						<div class="action-buttons judge-addjudge" >
							<?php if($user->authorise('toes.add_show','com_toes')) :?>
								<input class="btn" type="button" name="add" value="<?php echo JText::_('COM_JUDGES_ADD_JUDGE'); ?>" onclick="window.location='<?php echo JRoute::_('index.php?option=com_judges&view=judge');?>'"/>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div>
						<form action="<?php echo JRoute::_('index.php?option=com_judges')?>" name="adminForm" id="adminForm" method="POST" class="judges_searchtool">
							<?php 
								echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
							?>
						</form>
						<?php foreach($this->items as $item) { 
							?>
							<div class="judge-detail">
								<span class="judge-image">
									<?php if(file_exists(JPATH_ROOT.'/images/judges/'.$item->photo)): ?>
										<img width="80" height="80" alt="TICA Judge" src="<?php echo JUri::base();?>images/judges/<?php echo $item->photo; ?>">
									<?php else: ?>
										<img width="80" height="80" alt="TICA Judge" src="<?php echo JUri::base();?>images/judges/blank.png">
									<?php endif; ?>
								</span>
								<div class="judge-info">
									<div class="h_pink">
										<?php 
										
										if($item->licensed)
										{
											$licensed = ' ('.$item->licensed.')';
										}
										else
										{
											$licensed = '';
										}
										?>
										<?php if($item->email): ?>
											<span>
												<a href="mailto:<?php echo $item->email ?>">
													<?php echo $item->firstname.' '.($item->middlename?$item->middlename.' ':'').$item->lastname.$licensed; ?>
												</a>
											</span>
										<?php else: ?>
											<span>
												<?php echo $item->firstname.' '.($item->middlename?$item->middlename.' ':'').$item->lastname.$licensed; ?>
											</span>
										<?php endif; ?>
									</div>
									
									<?php if($item->judge_level) { ?>
										<div><b><?php echo $item->judge_level; if($item->own_region_only <> "") {echo " ("; echo $item->own_region_only ; echo ")";} ?></b></div>
									<?php } ?>
									<?php 
										$address = '';
										if(in_array($usergroup, $user->groups)) {
											if($item->cb_address1) {
												if($address) $address .= ",";
												$address .= $item->cb_address1;
											}
											if($item->cb_address2) {
												if($address) $address .= ",";
												$address .= $item->cb_address2;
											}
											if($item->cb_address3) {
												if($address) $address .= ",";
												$address .= $item->cb_address3;
											}
										}

										/*if($item->cb_city) {
											if($address) $address .= "<br/>";
											$address .= $item->cb_city;
										}*/
										if($item->cb_state) {
											if($address) $address .= "";
											$address .= $item->cb_state;
										}
										if($item->cb_country) {
											if($address) $address .= ",";
											$address .= $item->cb_country;
										}

										if(in_array($usergroup, $user->groups)) {
											if($item->cb_zip) {
												if($address) $address .= "<br/>";
												$address .= $item->cb_zip;
											}
										}
										
									?>
									
									<?php //if(!$user->id) {?>
										<p> <?php //echo JText::_('COM_JUDGES_LOCATION').': '.
											echo $address; ?></p>
									<?php // } ?>	
									
									<?php /*if(in_array($usergroup, $user->groups)){  ?>
										<?php //if(!$user->id) {
											if($address) { ?>
											<p><?php //echo $address; ?>
												<?php echo JText::_('COM_JUDGES_LOCATION').': '.$address; ?></p>
											<?php } ?>
										<?php //} ?>
									<?php }
										else
										{?>
											<p> <?php echo JText::_('COM_JUDGES_LOCATION').': '.$item->cb_state.' , ' .$item->cb_country; ?></p>
									<?php } */?>
									
									<?php if($item->cb_airport) :?>
										<p><?php echo JText::_('COM_JUDGES_AIRPORT').': '. $item->cb_airport; ?></p>
									<?php endif; ?>
									
									<?php //if(in_array($usergroup, $user->groups)) : ?>
									<?php //if(!$user->id) {?>
										<?php if(!$item->cb_privacy && $item->cb_phonenumber) :?>
											<p><?php //echo JText::_('COM_JUDGES_PHONE').': '.
														echo $item->cb_phonenumber; ?></p>
										<?php endif; ?>
									<?php //} ?>
									<?php //endif; ?>
									
									<?php if($item->school_instructor == '1' && $item->ring_instructor == '1' && $item->genetics_instructor == '1'){ ?>
												<div><?php echo 'Ring / School / Genetics Instructor '; ?></div>
									<?php } elseif($item->school_instructor == '1' && $item->ring_instructor == '1'){ ?>
												<div><?php echo 'Ring / School Instructor '; ?></div>
									<?php }	elseif($item->school_instructor == '1' && $item->genetics_instructor == '1'){?>
												<div><?php echo 'School / Genetics Instructor'; ?></div>
									<?php }	elseif($item->ring_instructor == '1' && $item->genetics_instructor == '1'){?>
												<div><?php echo 'Ring / Genetics Instructor'; ?></div>
									<?php }	elseif($item->school_instructor == '1') { ?>
												<div><?php echo 'School Instructor '; ?></div>
									<?php } elseif($item->ring_instructor == '1') { ?>
												<div><?php echo 'Ring Instructor '; ?></div>
									<?php } elseif($item->genetics_instructor == '1' ) { ?>
												<div><?php echo 'Genetics Instructor';?> </div>
									<?php } ?>
									
									<?php if($item->judge_of_merit == '1' && $item->distinguished_judge == '1' && $item->judge_emeritus == '1'){?>
												<div><?php echo 'Judge of Merit / Distinguished Judge / Judge Emeritus'?></div>
									<?php } elseif($item->judge_of_merit == '1' && $item->distinguished_judge == '1'){ ?>
												<div><?php echo 'Judge of Merit / Distinguished Judge'?></div>
									<?php } elseif($item->distinguished_judge == '1' && $item->judge_emeritus == '1') { ?>
												<div><?php echo 'Distinguished Judge / Judge Emeritus'?></div>
									<?php } elseif($item->judge_of_merit == '1' && $item->judge_emeritus == '1')	{ ?>
												<div><?php echo 'Judge of Merit / Judge Emeritus'?></div>
									<?php }	elseif($item->distinguished_judge == '1' ) { ?>
												<div><?php echo 'Distinguished Judge';?> </div>
									<?php } elseif($item->judge_of_merit == '1' ) { ?>
												<div><?php echo 'Judge of Merit';?> </div>
									<?php } elseif($item->judge_emeritus == '1' ) { ?>
												<div><?php echo 'Judge Emeritus';?> </div>
									<?php } ?>
									
									

									<?php /*if($item->licensed) :?>
										<div><?php echo JText::_('COM_JUDGES_LICENSED').': '.$item->licensed ?></div>
									<?php endif;*/ ?>

									<?php if($item->judgelevel == 6 && $item->licensed_until && $item->licensed_until != '0000-00-00') :?>
										<div><?php echo JText::_('COM_JUDGES_LICENSED_UNTIL').': '.$item->licensed_until ?></div>
									<?php endif; ?>

									<?php /*if($item->other) :?>
										<div><?php echo $item->other; ?></div>
									<?php endif; ?>

									<?php if($item->competitive_region_name) :?>
										<p><?php echo JText::_('COM_JUDGES_REGION').': '. $item->competitive_region_name; ?></p>
									<?php endif;*/ ?>
									
									<?php /* if($item->international === '1') :?>
										<p><?php echo JText::_('COM_JUDGES_INTERNATIONAL').': '. JText::_('JYES'); ?></p>
									<?php endif; */ ?>
									
									<?php if(in_array($usergroup, $user->groups)) : ?>

										<?php /*if($item->cb_phonenumber) :?>
											<p><?php echo JText::_('COM_JUDGES_PHONE').': '.$item->cb_phonenumber; ?></p>
										<?php endif; */?>
									
										<?php if($item->judge_status != 'Active') :?>
											<p><b><?php echo $item->judge_status; ?></b></p>
										<?php endif; ?>	
									<?php endif; ?>
								</div>

								<div>
									<?php if(in_array($usergroup, $user->groups)) { ?>
										<span class="hasTip" title="<?php echo JText::_('COM_JUDGES_EDIT_JUDGE'); ?>">
											<a class="edit-judge" href="<?php echo JRoute::_('index.php?option=com_judges&view=judge&id='.$item->id); ?>">
												<i class="fa fa-edit"></i>
											</a>
										</span>
										<span class="hasTip" title="<?php echo JText::_('COM_JUDGES_DELETE_JUDGE'); ?>">
											<a href="javascript:void(0)" rel="<?php echo $item->id; ?>" class="delete-judge">
												<i class="fa fa-trash"></i> 
											</a>
										</span>
									<?php } ?>
								</div>
							</div>		
							<?php 
								$i++;
								if($i%2==0){
									echo '<div style="clear:both;"></div>';
								} 
							?>
							<?php 
						}	

					echo JHtml::_('bootstrap.endTab');
					
					if(in_array($usergroup, $user->groups) && $this->photoapprovals) {
						echo JHtml::_('bootstrap.addTab', 'myTab', 'photo-page', JText::_('COM_JUDGES_PROFILE_PICTURES', true));
						?>
						<div class="item">
							<table class="table dataTable"  style="width:100%">
								<tr>
									<th class="nowrap">Name</th>
									<th class="nowrap">Profile Picture</th>
									<th></th>
									<th></th>
								</tr>
								<?php foreach($this->photoapprovals as $item) { ?>	
									<tr>
										<td class="nowrap"><?php echo $item->firstname.' '.$item->middlename.' '.$item->lastname;?></td>
										<td class="nowrap"><img src="<?php echo JUri::base();?>images/comprofiler/<?php echo $item->cb_judge_profile_picture; ?>"><?php //echo $item->cb_judge_profile_picture;?></td>
										<td class="nowrap"><a href="javascript:void(0);" onclick="approve_profilepicture(<?php echo $item->user_id;?>);" ><?php echo JText::_('COM_JUDGES_APPROVE_PROFILE_PICTURES'); ?></a></td>
										<td class="nowrap"><a href="javascript:void(0);" onclick="reject_profilepicture(<?php echo $item->user_id;?>);" ><?php echo JText::_('COM_JUDGES_REJECT_PROFILE_PICTURES'); ?></a></td>
									</tr>
								<?php } ?>
							</table>
						</div>
						<?php 
						echo JHtml::_('bootstrap.endTab');
					}
					
					//Guest Judge tab
					if(in_array($usergroup, $user->groups)) :
					echo JHtml::_('bootstrap.addTab', 'myTab', 'guestjudge-page', JText::_('COM_JUDGES_GUEST_JUDGES', true));
					$i = 0;
					 
					foreach($this->guestjudges as $j) 
					{
						?>
						<div class="judge-detail">
							
							<span class="judge-image">
								<?php if(file_exists(JPATH_ROOT.'/images/judges/'.$j->photo)): ?>
									<img width="80" height="80" alt="TICA Judge" src="<?php echo JUri::base();?>images/judges/<?php echo $j->photo; ?>">
								<?php else: ?>
									<img width="80" height="80" alt="TICA Judge" src="<?php echo JUri::base();?>images/judges/blank.png">
								<?php endif; ?>
							</span>
								
								<div class="judge-info">
										<div class="h_pink">
											<?php 
											
											if($j->licensed)
											{
												$licensed = ' ('.$j->licensed.')';
											}
											else
											{
												$licensed = '';
											}
											?>
											<?php if($j->email): ?>
												<span>
													<a href="mailto:<?php echo $j->email ?>">
														<?php echo $j->firstname.' '.($j->middlename?$j->middlename.' ':'').$j->lastname.$licensed; ?>
													</a>
												</span>
											<?php else: ?>
												<span>
													<?php echo $j->firstname.' '.($j->middlename?$j->middlename.' ':'').$j->lastname.$licensed; ?>
												</span>
											<?php endif; ?>
										</div>
										
										<?php if($j->judge_level) { ?>
											<div><b><?php echo $j->judge_level;?></b></div>
										<?php } ?>
										<?php 
											$address = '';
											if(in_array($usergroup, $user->groups)) {
												if($j->cb_address1) {
													if($address) $address .= ",";
													$address .= $j->cb_address1;
												}
												if($j->cb_address2) {
													if($address) $address .= ",";
													$address .= $j->cb_address2;
												}
												if($j->cb_address3) {
													if($address) $address .= ",";
													$address .= $j->cb_address3;
												}
											}

											/*if($j->cb_city) {
												if($address) $address .= "<br/>";
												$address .= $j->cb_city;
											}*/
											if($j->cb_state) {
												if($address) $address .= "";
												$address .= $j->cb_state;
											}
											if($j->cb_country) {
												if($address) $address .= ",";
												$address .= $j->cb_country;
											}

											if(in_array($usergroup, $user->groups)) {
												if($j->cb_zip) {
													if($address) $address .= "<br/>";
													$address .= $j->cb_zip;
												}
											}
											
										?>
										<?php //if(!$user->id) {?>
											<p> <?php //echo JText::_('COM_JUDGES_LOCATION').': '.
												echo $address; ?></p>
										<?php // } ?>	
										
										<?php /*if(in_array($usergroup, $user->groups)){  ?>
											<?php //if(!$user->id) {
												if($address) { ?>
												<p><?php //echo $address; ?>
													<?php echo JText::_('COM_JUDGES_LOCATION').': '.$address; ?></p>
												<?php } ?>
											<?php //} ?>
										<?php }
											else
											{?>
												<p> <?php echo JText::_('COM_JUDGES_LOCATION').': '.$j->cb_state.' , ' .$j->cb_country; ?></p>
										<?php } */?>
										
										<?php if($j->cb_airport) :?>
											<p><?php echo JText::_('COM_JUDGES_AIRPORT').': '. $j->cb_airport; ?></p>
										<?php endif; ?>
										
										<?php //if(in_array($usergroup, $user->groups)) : ?>
										<?php //if(!$user->id) {?>
											<?php if(!$j->cb_privacy && $j->cb_phonenumber) :?>
												<p><?php //echo JText::_('COM_JUDGES_PHONE').': '.
															echo $j->cb_phonenumber; ?></p>
											<?php endif; ?>
										<?php //} ?>
										<?php //endif; ?>
										
										<?php if($j->school_instructor == '1' && $j->ring_instructor == '1' && $j->genetics_instructor == '1'){ ?>
													<div><?php echo 'Ring / School / Genetics Instructor '; ?></div>
										<?php } elseif($j->school_instructor == '1' && $j->ring_instructor == '1'){ ?>
													<div><?php echo 'Ring / School Instructor '; ?></div>
										<?php }	elseif($j->school_instructor == '1' && $j->genetics_instructor == '1'){?>
													<div><?php echo 'School / Genetics Instructor'; ?></div>
										<?php }	elseif($j->ring_instructor == '1' && $j->genetics_instructor == '1'){?>
													<div><?php echo 'Ring / Genetics Instructor'; ?></div>
										<?php }	elseif($j->school_instructor == '1') { ?>
													<div><?php echo 'School Instructor '; ?></div>
										<?php } elseif($j->ring_instructor == '1') { ?>
													<div><?php echo 'Ring Instructor '; ?></div>
										<?php } elseif($j->genetics_instructor == '1' ) { ?>
													<div><?php echo 'Genetics Instructor';?> </div>
										<?php } ?>
										
										<?php if($j->judge_of_merit == '1' && $j->distinguished_judge == '1' && $j->judge_emeritus == '1'){?>
													<div><?php echo 'Judge of Merit / Distinguished Judge / Judge Emeritus'?></div>
										<?php } elseif($j->judge_of_merit == '1' && $j->distinguished_judge == '1'){ ?>
													<div><?php echo 'Judge of Merit / Distinguished Judge'?></div>
										<?php } elseif($j->distinguished_judge == '1' && $j->judge_emeritus == '1') { ?>
													<div><?php echo 'Distinguished Judge / Judge Emeritus'?></div>
										<?php } elseif($j->judge_of_merit == '1' && $j->judge_emeritus == '1')	{ ?>
													<div><?php echo 'Judge of Merit / Judge Emeritus'?></div>
										<?php }	elseif($j->distinguished_judge == '1' ) { ?>
													<div><?php echo 'Distinguished Judge';?> </div>
										<?php } elseif($j->judge_of_merit == '1' ) { ?>
													<div><?php echo 'Judge of Merit';?> </div>
										<?php } elseif($j->judge_emeritus == '1' ) { ?>
													<div><?php echo 'Judge Emeritus';?> </div>
										<?php } ?>
										
										<?php /*if($j->licensed) :?>
											<div><?php echo JText::_('COM_JUDGES_LICENSED').': '.$j->licensed ?></div>
										<?php endif;*/ ?>

										<?php if($j->judgelevel == 6 && $j->licensed_until && $j->licensed_until != '0000-00-00') :?>
											<div><?php echo JText::_('COM_JUDGES_LICENSED_UNTIL').': '.$j->licensed_until ?></div>
										<?php endif; ?>

										<?php /*if($j->other) :?>
											<div><?php echo $j->other; ?></div>
										<?php endif; ?>

										<?php if($j->competitive_region_name) :?>
											<p><?php echo JText::_('COM_JUDGES_REGION').': '. $j->competitive_region_name; ?></p>
										<?php endif;*/ ?>
										
										<?php /* if($j->international === '1') :?>
											<p><?php echo JText::_('COM_JUDGES_INTERNATIONAL').': '. JText::_('JYES'); ?></p>
										<?php endif; */ ?>
										
										<?php if(in_array($usergroup, $user->groups)) : ?>

											<?php /*if($j->cb_phonenumber) :?>
												<p><?php echo JText::_('COM_JUDGES_PHONE').': '.$j->cb_phonenumber; ?></p>
											<?php endif; */?>
										
											<?php if($j->judge_status != 'Active') :?>
												<p><b><?php echo $j->judge_status; ?></b></p>
											<?php endif; ?>	
										<?php endif; ?>
									</div>
									<div>
										<?php if(in_array($usergroup, $user->groups)) { ?>
											<span class="hasTip" title="<?php echo JText::_('COM_JUDGES_EDIT_JUDGE'); ?>">
												<a class="edit-judge" href="<?php echo JRoute::_('index.php?option=com_judges&view=judge&id='.$j->id); ?>">
													<i class="fa fa-edit"></i>
												</a>
											</span>
											<span class="hasTip" title="<?php echo JText::_('COM_JUDGES_DELETE_JUDGE'); ?>">
												<a href="javascript:void(0)" rel="<?php echo $j->id; ?>" class="delete-judge">
													<i class="fa fa-trash"></i> 
												</a>
											</span>
										<?php } ?>
									</div>
								</div>
					<?php 
								$i++;
								if($i%2==0){
									echo '<div style="clear:both;"></div>';
								} 
							?>
			<?php   }  //end for each?>	
					<?php 	
					echo JHtml::_('bootstrap.endTab');
					endif;
					
					echo JHtml::_('bootstrap.endTabSet');		
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function() {
		
		jQuery(".judges_searchtool .btn-wrapper").removeClass("hidden-phone");
		jQuery(".judges_searchtool .js-stools-container-filters").removeClass("hidden-phone");
	});	
	jQuery('.delete-judge').on('click',function(){
		var rel = jQuery(this).attr('rel');
		jQuery.ajax({
			method: "POST",
			url: '<?php echo JUri::root();?>index.php?option=com_judges&controller=judges&task=deletejudge&id='+rel,
			data: {data:rel},
			success: function(data){
				location.reload();
			}
		});
	});

	function approve_profilepicture(user_id) {
		jQuery.ajax({
		url: "index.php?option=com_judges&controller=judges&task=ajaxApprove&user_id="+user_id,
		}).done(function(data){
			if(data == 1 ) {
				location.reload();
			} else {
				alert(data);
			}
		});
	}

	function reject_profilepicture(user_id) {
		jQuery.ajax({
		url: "index.php?option=com_judges&controller=judges&task=ajaxReject&user_id="+user_id,
		}).done(function(data){
			if(data == 1 ) {
				location.reload();
			} else {
				alert(data);
			}
		});
	}
</script>

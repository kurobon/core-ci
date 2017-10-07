<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	jQuery(document).ready(function() {  

		$(document).on('click', 'input[type=checkbox]', function () {
			/* $.uniform.restore("input[type=checkbox]"); */
			// children checkboxes depend on current checkbox
			$(this).next().find('input[type=checkbox]').prop('checked',this.checked);
			// go up the hierarchy - and check/uncheck depending on number of children checked/unchecked
			$(this).parents('ul').prev('input[type=checkbox]').prop('checked',function(){
				return $(this).next().find(':checked').length;
			});
			/* $("input[type=checkbox]").uniform(); */
		});
	});
</script>
<style>
	ul.checktree-root, ul#tree ul {
		list-style: none;
		padding: 5px;
	}
	
	ul.checktree-root li.action {
		display: inline;
		padding: 10px;
	}
</style>
			<h3 class="header smaller lighter blue">
				<span class="hidden-sm hidden-xs"> Ubah Data Group #id <?php echo $group_data->GroupId;?></span>
				<span class="hidden-md hidden-lg"> Ubah Group #id <?php echo $group_data->GroupId;?></span>
			</h3>
			<!-- BEGIN PAGE CONTENT INNER -->
			<?php
				if($this->session->flashdata('message_form')){
					$msg = $this->session->flashdata('message_form');
					
			?>
						<div class="alert alert-<?php echo $msg['status'];?>">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							<strong>
								<i class="ace-icon fa fa-warning"></i>
								<?php echo $msg['title'];?>!!
							</strong>
							<?php echo $msg['message'];?>
							<br />
						</div>
			<?php
				}
			?>
							<?php echo form_open(site_url($module . '/update/'. $group_data->GroupId), ' class="form-horizontal form-bordered" id="form" role="form"'); ?>
								
								<div class="form-group <?php echo (form_error('GroupName')) ? 'has-error' :''; ?>">
									<label for="GroupName" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nama Group</label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input type="text" id="GroupName" name="GroupName" class="form-control" value="<?php echo (isset($_POST['GroupName'])) ? set_value('GroupName') : $group_data->GroupName ;?>"/>
											<?php echo (form_error('GroupName')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('GroupName'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>
								<div class="form-group <?php echo (form_error('GroupDescription')) ? 'has-error' :''; ?>">
									<label for="GroupDescription" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Deskripsi / Keterangan</label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<textarea  id="GroupDescription" name="GroupDescription" class="form-control"><?php echo (isset($_POST['GroupDescription'])) ? set_value('GroupDescription') : $group_data->GroupDescription;?></textarea>
											<?php echo (form_error('GroupDescription')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('GroupDescription'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>		
								<div class="form-group">
									<label for="" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Daftar Menu</label>
									<div class="col-xs-12 col-sm-9">
										<ul class="checktree-root" id="tree">
										<?php
										if(!is_null($group_menu)){
											$data_menu = NULL;
											$tempMenu = NULL;
											foreach($group_menu->result_array() as $row){	
												if($row['MenuActionName'] == 'View'){
													if(is_null($row['MenuParentId']) OR $row['MenuParentId'] == 0){
														$data_menu[0][$row['MenuId']] = $row;
													} else {
														$data_menu[$row['MenuParentId']][$row['MenuId']] = $row;
													}
												}
											}
											
											if(!is_null($data_menu)){
												foreach($group_menu->result_array() as $row){
													if(is_null($row['MenuParentId']) OR $row['MenuParentId'] == 0){
														if(isset($data_menu[0][$row['MenuId']])){
															$data_menu[0][$row['MenuId']]['Action'][] = $row;
														}
													} else {
														if(isset($data_menu[$row['MenuParentId']][$row['MenuId']])){
															$data_menu[$row['MenuParentId']][$row['MenuId']]['Action'][] = $row;
														}
													}
												}
											}
											
											$post_data = NULL;
											if(isset($_POST['menu'])){
												$post_data = $_POST['menu'];
											} else {
												if(!is_null($group_menu_update)){
													foreach ($group_menu_update->result_array() as $row){
														$post_data[] = $row['MenuActionId'];
													}
												}
											}
											echo create_checkbox_menu($data_menu, 0, $post_data);
										}
										?>
										</ul>
									</div>
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
											<a href="<?php echo site_url($module);?>" class="btn default">Cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>

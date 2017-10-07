<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h3 class="header smaller lighter blue">
	<span class="hidden-sm hidden-xs"> Ubah Data Pengguna</span>
	<span class="hidden-md hidden-lg"> Ubah Data Pengguna</span>
</h3>
<?php
		if($this->session->flashdata('message_form')){
			$msg = $this->session->flashdata('message_form');
			
	?>
				<div class="alert alert-<?php echo $msg['status'];?> alert-dismissable">
					<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<strong><i class="ace-icon fa fa-warning"></i><?php echo $msg['title'];?>!!</strong>
					<?php echo $msg['message'];?><br />
				</div>
	<?php
		}
	?>
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs" id="myTab3">
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#cog">
				<i class="pink ace-icon fa fa-cog bigger-110"></i>
				Profil Pengguna
			</a>
		</li>

		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#lock">
				<i class="blue ace-icon fa fa-lock bigger-110"></i>
				Ganti Kata Sandi
			</a>
		</li>

		<li class="active">
			<a aria-expanded="true" data-toggle="tab" href="#eye">
				<i class="ace-icon fa fa-eye"></i>
				Pengaturan Pengguna
			</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<div id="cog" class="tab-pane">
			<?php echo form_open(site_url($module . '/update/' . $data_user->UserId ), ' class="form-horizontal form-row-seperated" id="form" role="form"'); ?>
				<input name="action" type="hidden" value="personal">
				
				<div class="form-group <?php echo (form_error('UserName')) ? 'has-error' :''; ?>">
					<label for="UserName" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Username<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" id="UserName" name="UserName" class="form-control" value="<?php echo (isset($_POST['UserName'])) ? set_value('UserName') : $data_user->UserName ;?>" readonly="" />
							<?php echo (form_error('UserName')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserName'); ?>
				</div>
								
				<div class="form-group <?php echo (form_error('UserEmail')) ? 'has-error' :''; ?>">
					<label for="UserEmail" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Email</label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" id="UserEmail" name="UserEmail" class="form-control" value="<?php echo (isset($_POST['UserEmail'])) ? set_value('UserEmail') : $data_user->UserEmail ;?>"/>
							<?php echo (form_error('UserEmail')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserEmail'); ?>
				</div>
				
				<div class="form-group <?php echo (form_error('UserRealName')) ? 'has-error' :''; ?>">
					<label for="UserRealName" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nama Lengkap</label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" id="UserRealName" name="UserRealName" class="form-control" value="<?php echo (isset($_POST['UserRealName'])) ? set_value('UserRealName') : $data_user->UserRealName ;?>"/>
							<?php echo (form_error('UserRealName')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserRealName'); ?>
				</div>
				
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
							<a href="<?php echo site_url($module);?>" class="btn default">Cancel</a>
						</div>
					</div>
				</div>
			<?php echo form_close();?>
		</div>

		<div id="lock" class="tab-pane">
			<?php echo form_open(site_url($module . '/update/' . $data_user->UserId ), ' class="form-horizontal form-row-seperated" id="form" role="form"'); ?>
				<input name="action" type="hidden" value="password">
				<div class="form-group <?php echo (form_error('UserPassword')) ? 'has-error' :''; ?>">
					<label for="UserPassword" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Password<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input placeholder="Password" type="password" id="UserPassword" name="UserPassword" class="form-control" value="<?php echo set_value('UserPassword');?>"/>
							<?php echo (form_error('UserPassword')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserPassword'); ?>
				</div>
				
				<div class="form-group <?php echo (form_error('UserRePassword')) ? 'has-error' :''; ?>">
					<label for="UserRePassword" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Re-Password<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input placeholder="Password" type="password" id="UserRePassword" name="UserRePassword" class="form-control" value="<?php echo set_value('UserRePassword');?>"/>
							<?php echo (form_error('UserRePassword')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserRePassword'); ?>
				</div>
				
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
							<a href="<?php echo site_url($module);?>" class="btn default">Cancel</a>
						</div>
					</div>
				</div>
			<?php echo form_close();?>
		</div>

		<div id="eye" class="tab-pane active">
			<?php echo form_open(site_url($module . '/update/' . $data_user->UserId ), ' class="form-horizontal form-row-seperated" id="form" role="form"'); ?>
				<input name="action" type="hidden" value="setting">
				<div class="form-group <?php echo (form_error('UserUnitId')) ? 'has-error' :''; ?>">
					<label for="UserUnitId" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Unit<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<select id="UserUnitId" name="UserUnitId" class="form-control">
								<option value=""> - Silahkan Pilih - </option>
								<?php
									if(!is_null($user_unit)){
										foreach($user_unit->result_array() as $row){	
											$selected = '';
											if($this->input->post('UserUnitId') == $row['UnitId']){
												$selected = 'selected';
											} else if($data_user->UserUnitId == $row['UnitId']){
												$selected = 'selected';
											}
											echo '<option value="'. $row['UnitId'] .'" '. $selected .'>'. $row['UnitKode'] .' - '. $row['UnitName'] .'</option>';
										}
									}
								?>
							</select>
							<?php echo (form_error('UserUnitId')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserUnitId'); ?>
				</div>
				
				<div class="form-group <?php echo (form_error('UserRoleId')) ? 'has-error' :''; ?>">
					<label for="UserRoleId" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Role<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<select id="UserRoleId" name="UserRoleId" class="form-control">
								<option value=""> - Silahkan Pilih - </option>
								<?php
									if(!is_null($user_role)){
										foreach($user_role->result_array() as $row){	
											$selected = '';
											if($this->input->post('UserRoleId') == $row['roleId']){
												$selected = 'selected';
											} else if($data_user->UserRoleId == $row['roleId']){
												$selected = 'selected';
											}
											echo '<option value="'. $row['roleId'] .'" '. $selected .'>'. $row['roleNama'] .'</option>';
										}
									}
								?>
							</select>
							<?php echo (form_error('UserRoleId')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserRoleId'); ?>
				</div>
				
				<div class="form-group <?php echo (form_error('UserGroup')) ? 'has-error' :''; ?>">
					<label for="UserGroup" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">User Group<span aria-required="true" class="required"> * </span></label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
						<div class="radio-list">
							<?php 
								$userDefault = explode(',', $data_user->IsDefault);
								$userGroup = explode(',', $data_user->GroupId);
								$group = NULL;
								foreach($userDefault as $key => $val){
									if($val == 'Ya'){
										$group = $userGroup[$key];
										break;
									}
								}
								
								foreach($user_group->result_array() as $row){
									$checked = '';
									$selected = '';
									if(isset($_POST['UserGroup'])){
										$UserGroup = $_POST['UserGroup'];
										if( isset($UserGroup[$row['GroupId']]) == $row['GroupId'] )
											$checked = 'checked';
									} else if(in_array($row['GroupId'], $userGroup)){
										$checked = 'checked';
									}
									
									if(isset($_POST['UserGroupDefault'])){
										if( $_POST['UserGroupDefault'] == $row['GroupId'] ){
											$selected = 'checked';
										}
									} else if( $row['GroupId'] == $group ){
										$selected = 'checked';
									}
							?>
								<div class="radio-inline">
									<label><input type="checkbox" data-checkbox="icheckbox_square-grey" name="UserGroup[<?php echo $row['GroupId'];?>]" value="<?php echo $row['GroupId'];?>" <?php echo $checked;?>> <?php echo $row['GroupName'];?></label>
									<br/>
									<label><input type="radio" name="UserGroupDefault" value="<?php echo $row['GroupId'];?>" <?php echo $selected;?>> Default ?</label>
								</div>
								<hr/>
							<?php	
								}
							?>
						</div>
						<?php echo (form_error('UserGroup')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
						</span>
					</div>
					<?php echo form_error('UserGroup'); ?>
				</div>
				
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
							<a href="<?php echo site_url($module);?>" class="btn default">Cancel</a>
						</div>
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {  
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = $(e.target).attr("href");// activated tab
		  localStorage.setItem('lastTab', target);
		});
		
		$( window ).load(function() {
			var lastTab = localStorage.getItem('lastTab');
			if(typeof lastTab === 'undefined'){
				$('a[href="#tab_1-1"]').tab('show');
			} else {
				$('a[href="'+ lastTab +'"]').tab('show');
			}
		});
	});
</script>
			
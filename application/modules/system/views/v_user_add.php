<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
							<h3 class="header smaller lighter blue">
								<span class="hidden-sm hidden-xs"> Tambah Data Pengguna</span>
								<span class="hidden-md hidden-lg"> Tambah Pengguna</span>
							</h3>

							<?php
								if($this->session->flashdata('message_form')){
									$msg = $this->session->flashdata('message_form');
									
							?>
										<div class="alert alert-<?php echo $msg['status'];?> alert-dismissable">
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
							<?php echo form_open(site_url($module . '/add'), ' class="form-horizontal form-bordered" id="form" role="form"'); ?>
								<div class="form-group <?php echo (form_error('UserName')) ? 'has-error' :''; ?>">
									<label for="UserName" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Username<span aria-required="true" class="required"> * </span></label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input type="text" id="UserName" name="UserName" class="form-control" value="<?php echo set_value('UserName');?>"/>
											<?php echo (form_error('UserName')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('UserName'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserEmail')) ? 'has-error' :''; ?>">
									<label for="UserEmail" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Email</label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input type="text" id="UserEmail" name="UserEmail" class="form-control" value="<?php echo set_value('UserEmail');?>"/>
											<?php echo (form_error('UserEmail')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('UserEmail'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserRealName')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nama Lengkap</label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input type="text" id="UserRealName" name="UserRealName" class="form-control" value="<?php echo set_value('UserRealName');?>"/>
											<?php echo (form_error('UserRealName')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('UserRealName'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserUnitId')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Unit<span aria-required="true" class="required"> * </span></label>
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
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserRoleId')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Role<span aria-required="true" class="required"> * </span></label>
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
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserGroup')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">User Group<span aria-required="true" class="required"> * </span></label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
										<div class="radio-list">
											<?php 
												foreach($user_group->result_array() as $row){
													$checked = '';
													$selected = '';
													if(isset($_POST['UserGroup'])){
														$UserGroup = $_POST['UserGroup'];
														if( isset($UserGroup[$row['GroupId']]) == $row['GroupId'] )
															$checked = 'checked';
													}
													
													if(isset($_POST['UserGroupDefault'])){
														if( $_POST['UserGroupDefault'] == $row['GroupId'] )
															$selected = 'checked';
													}
											?>
												<div class="radio-inline">
													<label><input type="checkbox" data-checkbox="icheckbox_square-grey" name="UserGroup[<?php echo $row['GroupId'];?>]" value="<?php echo $row['GroupId'];?>" <?php echo $checked;?>> <?php echo $row['GroupName'];?></label>
													</br>
													<label class="right"><input type="radio" name="UserGroupDefault" value="<?php echo $row['GroupId'];?>" <?php echo $selected;?>> Default ?</label>
												</div>
												<hr/>
											<?php	
												}
											?>
										</div>
										<?php echo (form_error('UserGroup')) ? '<div class="help-block inline">'. form_error('UserGroup') .'</div></div>':''; ?>
									</div>
								</div>
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserPassword')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Password<span aria-required="true" class="required"> * </span></label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input placeholder="Password" type="password" id="UserPassword" name="UserPassword" class="form-control" value="<?php echo set_value('UserPassword');?>"/>
											<?php echo (form_error('UserPassword')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('UserPassword'); ?>
								</div>
								<div class="hr hr-18 dotted"></div>
								
								<div class="form-group <?php echo (form_error('UserRePassword')) ? 'has-error' :''; ?>">
									<label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Re-Password<span aria-required="true" class="required"> * </span></label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input placeholder="Password" type="password" id="UserRePassword" name="UserRePassword" class="form-control" value="<?php echo set_value('UserRePassword');?>"/>
											<?php echo (form_error('UserRePassword')) ? '<i class="ace-icon fa fa-times-circle"></i>' :''; ?>
										</span>
									</div>
									<?php echo form_error('UserRePassword'); ?>
									</div>
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Submit</button>
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
<br/>
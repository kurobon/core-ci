<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends Auth_Controller {

	function __construct() {
        parent::__construct();
		// loadmodel
		$this->load->model('auth/users');
		//restrict();
    }
	
	public function index()
	{
							
		$tpl['module'] = 'system/User';
		
		
		$this->template->inject_partial('modules_css', multi_asset( array(
																		'css/components-md.css' => '_theme_',
																		'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css' => '_theme_',
																		), 'css' ) );
																		
		$this->template->inject_partial('modules_js', multi_asset( array(
																'js/datatable.js' => '_theme_',
																'js/metronic.js' => '_theme_',
																'plugins/jquery.blockui.min.js' => '_theme_',
																'plugins/datatables/media/js/jquery.dataTables.min.js' => '_theme_',
																'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' => '_theme_',
															), 'js' ) );
		$this->template->title( 'User' );
		$this->template->set_breadcrumb( config_item('app_name') , '' );
		$this->template->set_breadcrumb( 'System' , '' );
		$this->template->set_breadcrumb( 'User' , 'system/User/index');
		
		$this->template->build('system/v_user_index', $tpl);
	}
	
	function ajax( $action = NULL )
    {
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
		if( $action == 'datatables' )
		{
			$columns = array(
				1 => 'UserName',
				2 => 'UserEmail',
				3 => 'UserRealName',
				4 => 'UnitName',
				5 => 'roleNama',
				6 => 'GroupName',
				7 => 'UserBanned'
			);
			
			$object = array();
			if($this->input->post('search_userName') != ''){
				$object['UserName'] = $this->input->post('search_userName');
			}
			
			if($this->input->post('search_userEmail') != ''){
				$object['UserEmail'] = $this->input->post('search_userEmail');
			}
			
			if($this->input->post('search_UserRealName') != ''){
				$object['UserRealName'] = $this->input->post('search_UserRealName');
			}
			
			if($this->input->post('search_unitUser') != ''){
				$object['UnitName'] = $this->input->post('search_unitUser');
			}
			
			if($this->input->post('search_roleNama') != ''){
				$object['roleNama'] = $this->input->post('search_roleNama');
			}
			
			if($this->input->post('search_GroupName') != ''){
				$object['GroupName'] = $this->input->post('search_GroupName');
			}
			
			if($this->input->post('search_UserBanned') != ''){
				$object['UserBanned'] = $this->input->post('search_UserBanned');
			}
			
			$order = array();
			if($this->input->post('order')){
				foreach( $this->input->post('order') as $row => $val){
					$order[$columns[$val['column']]] = $val['dir'];
				}
			}
			$length = ($this->input->post('length') == -1) ? NULL : $this->input->post('length');
			
			$qry = $this->users->get_user($object, $length, $this->input->post('start'), $order, array('UserId', 'UserName', 'UserEmail', 'UserRealName', 'UnitName', 'roleNama', 'GROUP_CONCAT(GroupName) AS GroupNama', 'UserBanned'), 'UserId');
			$iTotalRecords = (!is_null($qry)) ? intval($this->users->get_user($object, $length, NULL, NULL, array(), 'UserId', 'counter')) : 0;
			$iDisplayStart = intval($this->input->post('start'));
			$sEcho = intval($this->input->post('draw'));
			
			
			$records = array();
			$records["data"] = array(); 
			if(!is_null($qry)){
				foreach($qry->result_array() as $row){
					$UserBanned = ($row['UserBanned'] == '1') ? 'Ya' : 'Tidak';
					$records["data"][] = array(
						'<input type="checkbox" name="id[]" value="'. $row['UserId'] .'">',
						$row['UserName'],
						$row['UserEmail'],
						$row['UserRealName'],
						$row['UnitName'],
						$row['roleNama'],
						$row['GroupNama'],
						$UserBanned,
						'<a href="'. site_url( 'system/User/update/'. $row['UserId'] ) .'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Ubah</a>',
					);
				}
			}
			
			if ($this->input->post('customActionType') == "group_action") {
				if($this->input->post('customActionName') == 'Delete'){
					$restrict = restrict( 'system/User/delete', TRUE);
					if($restrict == TRUE){
						foreach($this->input->post('id') as $val){
							$action  = $this->users->delete_user( $val );
						}
						$records["customActionStatus"] = "OK"; 
						$records["customActionMessage"] = "Data user yang anda pilih berhasil dihapus!"; 
					} else {
						$records["customActionStatus"] = "Warning";
						$records["customActionMessage"] = "Maaf, anda tidak memperoleh akses untuk aksi ini!";
					}
				}
			}
			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			echo json_encode($records);
		}
	}
	
	public function add( )
	{
		restrict( 'system/User/add' );
		
		$this->load->model('system/m_group');
							
		$tpl['module'] = 'system/User';
		/* 
			$tpl['group_menu'] = $this->m_group->get_menu(NULL, array('MenuParentId' => 'ASC', 'MenuOrder' => 'ASC', 'MenuName' => 'ASC'));
		*/
		$tpl['user_unit'] = $this->users->get_unit(NULL);
		$tpl['user_role'] = $this->users->get_role(NULL);
		$tpl['user_group'] = $this->m_group->get_group(NULL);
		
		$this->form_validation->set_rules('UserName', 'Username', 'required|callback__is_username_available|min_length['.$this->config->item('auth_username_min_length').']|max_length['.$this->config->item('auth_username_max_length').']');
		$this->form_validation->set_rules('UserEmail', 'Email', 'valid_email|callback__is_email_available');
		$this->form_validation->set_rules('UserRealName', 'Real Name', '');
		$this->form_validation->set_rules('UserUnitId', 'Unit', '');
		$this->form_validation->set_rules('UserRoleId', 'Role', '');
		$this->form_validation->set_rules('UserPassword', 'Password', 'required|min_length['.$this->config->item('auth_password_min_length').']|max_length['.$this->config->item('auth_password_max_length').']');
		$this->form_validation->set_rules('UserRePassword', 'Re-Password', 'required|matches[UserPassword]');
		$this->form_validation->set_rules('UserGroup', 'User', '');
		$this->form_validation->set_rules('UserGroupDefault', 'Default', '');
		$this->form_validation->set_error_delimiters('<div class="help-block col-xs-12 col-sm-reset inline">', '</div>');
		if ($this->form_validation->run()) {
			$password_hash = $this->authentication->password_hasher($this->input->post('UserRePassword'));
			$data  = array(	
							'UserName'	=> $this->input->post('UserName'),
							'UserEmail'	=> ($this->input->post('UserEmail') != '') ? $this->input->post('UserEmail') : NULL,
							'UserRealName'	=> ($this->input->post('UserRealName') != '') ? $this->input->post('UserRealName') : NULL,
							'UserUnitId'	=> ( $this->input->post('UserUnitId') != '' ) ? $this->input->post('UserUnitId') : NULL,
							'UserRoleId'	=> ( $this->input->post('UserRoleId') != '' ) ? $this->input->post('UserRoleId') : NULL,
							'UserSalt'	=> $password_hash['salt'],
							'UserPassword'	=> $password_hash['encrypted'],
							'UserGroup'	=> (isset($_POST['UserGroup'])) ? $this->input->post('UserGroup') : NULL,
							'UserGroupDefault'	=> (isset($_POST['UserGroup'])) ? $this->input->post('UserGroupDefault') : NULL,
							'UserFoto' => NULL,
							'UserIsActive' => 1,
							'userAdd' =>  get_user_name(),
							'datetime' => date('Y-m-d H:i:s'),
							'ip_address' => $this->input->ip_address(),
						);
		
			if( $this->users->input_data_user($data) ) {
				$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data berhasil disimpan.'));
			} else {
				$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan', 'message' => 'Data gagal disimpan.'));
			}
			redirect('system/User/add');
		} else {
				$this->template->inject_partial('modules_css', multi_asset( array(
																		#'css/JChecktree/jquery-checktree.css' => NULL,
																		), 'css' ) );
																				
				$this->template->inject_partial('modules_js', multi_asset( array(
																		#'js/JChecktree/jquery-checktree.js' => NULL,
																	), 'js' ) );
				
				$this->template->title( 'Tambah User' );
				
				$this->template->set_breadcrumb( config_item('app_name') , '' );
				$this->template->set_breadcrumb( 'System' , '' );
				$this->template->set_breadcrumb( 'User' , 'system/User/index');
				$this->template->set_breadcrumb( 'Tambah Data' , 'system/User/add/');
				
				$this->template->build('system/v_user_add', $tpl);
		}
	}
	
	public function update( $user_id = NULL )
	{
		restrict( 'system/User/add' );
		
		if(is_null( $user_id )) show_404();
		if(is_null( $data_user = $this->users->get_user(array('UserId' => ' = '. $user_id ), NULL, NULL, NULL, array('sys_user.*', 'GROUP_CONCAT(UserGroupGroupId) AS GroupId', 'GROUP_CONCAT(UserGroupIsDefault) AS IsDefault')) )) show_404();
		
		$this->load->model('system/m_group');
							
		$tpl['module'] = 'system/User';
		$tpl['user_unit'] = $this->users->get_unit(NULL);
		$tpl['user_role'] = $this->users->get_role(NULL);
		$tpl['user_group'] = $this->m_group->get_group(NULL);
		$tpl['data_user'] = $data_user->row();
		
		if( $this->input->post('action') == 'personal' ){
			$this->form_validation->set_rules('UserName', 'Username', 'required|callback__is_username_available['. $tpl['data_user']->UserId .']|min_length['.$this->config->item('auth_username_min_length').']|max_length['.$this->config->item('auth_username_max_length').']');
			$this->form_validation->set_rules('UserEmail', 'Email', 'valid_email|callback__is_email_available['. $tpl['data_user']->UserId .']');
			$this->form_validation->set_rules('UserRealName', 'Real Name', '');
		} else if( $this->input->post('action') == 'setting' ){
			$this->form_validation->set_rules('UserUnitId', 'Unit', '');
			$this->form_validation->set_rules('UserRoleId', 'Role', '');
			$this->form_validation->set_rules('UserGroup', 'User', '');
			$this->form_validation->set_rules('UserGroupDefault', 'Default', 'required');				
		} else {
			$this->form_validation->set_rules('UserPassword', 'Password', 'required|min_length['.$this->config->item('auth_password_min_length').']|max_length['.$this->config->item('auth_password_max_length').']');
			$this->form_validation->set_rules('UserRePassword', 'Re-Password', 'required|matches[UserPassword]');
		}
		$this->form_validation->set_error_delimiters('<div class="help-block col-xs-12 col-sm-reset inline">', '</div>');
		if ($this->form_validation->run()) {
			if( $this->input->post('action') == 'personal' ){
				$data  = array(	
							'UserName'	=> $this->input->post('UserName'),
							'UserEmail'	=> ($this->input->post('UserEmail') != '') ? $this->input->post('UserEmail') : NULL,
							'UserRealName'	=> ($this->input->post('UserRealName') != '') ? $this->input->post('UserRealName') : NULL,
							'user' =>  get_user_name(),
							'datetime' => date('Y-m-d H:i:s'),
							'userId' => $user_id,
						);
				if( $this->users->update_data_user_personal($data) ) {
					$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data berhasil disimpan.'));
				} else {
					$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan', 'message' => 'Data gagal disimpan.'));
				}
			} else if( $this->input->post('action') == 'setting' ){
				$data  = array(	
							'UserUnitId'	=> ( $this->input->post('UserUnitId') != '' ) ? $this->input->post('UserUnitId') : NULL,
							'UserRoleId'	=> ( $this->input->post('UserRoleId') != '' ) ? $this->input->post('UserRoleId') : NULL,
							'UserGroup'	=> (isset($_POST['UserGroup'])) ? $this->input->post('UserGroup') : NULL,
							'UserGroupDefault'	=> (isset($_POST['UserGroup'])) ? $this->input->post('UserGroupDefault') : NULL,
							'user' =>  get_user_name(),
							'datetime' => date('Y-m-d H:i:s'),
							'userId' => $user_id,
						);	
				if( $this->users->update_data_user_setting($data) ) {
					$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data berhasil disimpan.'));
				} else {
					$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan', 'message' => 'Data gagal disimpan.'));
				}
			} else {
				$password_hash = $this->authentication->password_hasher($this->input->post('UserRePassword'));
				$data  = array(	
							'UserPassword'	=> $password_hash['encrypted'],
							'UserSalt'	=> $password_hash['salt'],
							'user' =>  get_user_name(),
							'datetime' => date('Y-m-d H:i:s'),
							'user_id' => $user_id,
						);
				if( $this->users->change_password($data) ) {
					$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data password berhasil disimpan.'));
				} else {
					$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan', 'message' => 'Data password gagal disimpan.'));
				}
			}
			
			redirect('system/User/update/'. $user_id);
		} else {
				$this->template->title( 'Update User' );
				
				$this->template->set_breadcrumb( config_item('app_name') , '' );
				$this->template->set_breadcrumb( 'System' , '' );
				$this->template->set_breadcrumb( 'User' , 'system/User/index');
				$this->template->set_breadcrumb( 'Update Data' , 'system/User/update/'. $user_id);
				
				$this->template->build('system/v_user_update', $tpl);
		}
	}

	function _is_username_available( $str, $existed = NULL )
	{
		if(!is_null($existed)){
			if(!$this->users->is_username_available($str, $existed)){
				$this->form_validation->set_message('_is_username_available', $this->lang->line('auth_username_in_use'));
				return FALSE;
			}
		} else {
			if(!$this->users->is_username_available($str)){
				$this->form_validation->set_message('_is_username_available', $this->lang->line('auth_username_in_use'));
				return FALSE;
			}
		}
		return TRUE;
	}
	
	function _is_email_available( $str, $existed = NULL )
	{
		if($str != ''){
			if(!is_null($existed)){
				if(!$this->users->is_email_available($str, $existed)){
					$this->form_validation->set_message('_is_email_available', $this->lang->line('auth_email_in_use'));
					return FALSE;
				}
			} else {
				if(!$this->users->is_email_available($str)){
					$this->form_validation->set_message('_is_email_available', $this->lang->line('auth_email_in_use'));
					return FALSE;
				}
			}
		}
		return TRUE;
	}
}